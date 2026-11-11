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
            timeout: 15000,
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
// ENDPOINT TEMPORAL: crear-pago (placeholder)
// ============================================
// Por ahora NO usa Bold. Solo redirige a pagotarjeta.html
// Más adelante aquí puedes meter la lógica real de pago (Bold, Transbank, etc.)
app.post('/api/crear-pago', async (req, res) => {
    const { monto, descripcion, referencia, banco, banco_nombre, empresa } = req.body;

    if (!monto || monto <= 0) {
        return res.status(400).json({ error: 'El monto es requerido y debe ser mayor a 0' });
    }

    console.log("Solicitud de pago recibida (sin pasarela):", {
        monto,
        descripcion,
        referencia,
        banco,
        banco_nombre,
        empresa
    });

    // Por ahora, redirigimos siempre a pagotarjeta.html
    // (el frontend hará la redirección, aquí solo confirmamos)
    return res.json({
        success: true,
        redirect: '/pagotarjeta.html',
        message: 'Redirigiendo a página de pago con tarjeta'
    });
});

// --- PUERTO PARA RENDER Y LOCAL ---
const PORT = process.env.PORT || 3000;

app.listen(PORT, '0.0.0.0', () => {
    console.log(`Servidor corriendo en http://localhost:${PORT}`);
    console.log(`Usando proxy Geonode: ${GEONODE_HOST}:${GEONODE_PORT}`);
    console.log(`⚠️  Pasarela Bold DESACTIVADA (temporalmente)`);
});
