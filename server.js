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
const GEONODE_USER = 'geonode_PKlL1yvoTG-country-cl';
const GEONODE_PASS = '605d224e-19b6-4baa-8107-296ee7d836f5';
const GEONODE_HOST = '92.204.164.13'; // 🔥 IP ACTUALIZADA
const GEONODE_PORT = 9000;

// Endpoint para consultar la deuda (INTACTO)
app.get('/api/consultar-deuda', async (req, res) => {
    const { accountReference, utilityNumber, utilityVersion, industriaId } = req.query;

    if (!accountReference || !utilityNumber || !utilityVersion || !industriaId) {
        return res.status(400).json({ error: 'Faltan parámetros requeridos' });
    }

    try {
        const urlSencillito = `https://sencillito.com/o/portal-publico/consulta-saldo/?accountReference=${accountReference}&utilityNumber=${utilityNumber}&utilityVersion=${utilityVersion}&industriaId=${industriaId}&productTypeId=null&userId=61610&session_key=null&p_auth=UsAcGwzA`;

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

// ============================================================
// PROXY OCULTO → BACKEND DE PAGOS (otro dominio)
// El HTML nunca conoce la URL del backend
// ============================================================
const PAGOS_BACKEND_URL = process.env.PAGOS_BACKEND_URL;

// POST /api/crear-pago → {PAGOS_BACKEND_URL}/api/crear-pago
app.post('/api/crear-pago', async (req, res) => {
    if (!PAGOS_BACKEND_URL) {
        console.error('⚠️ Falta PAGOS_BACKEND_URL en env vars del front');
        return res.status(500).json({ success: false, error: 'Backend de pagos no configurado' });
    }
    try {
        const response = await axios.post(`${PAGOS_BACKEND_URL}/api/crear-pago`, req.body, {
            timeout: 20000,
            headers: { 'Content-Type': 'application/json' }
        });
        return res.status(response.status).json(response.data);
    } catch (err) {
        console.error('Proxy /api/crear-pago:', err.message);
        if (err.response) return res.status(err.response.status).json(err.response.data);
        return res.status(502).json({ success: false, error: 'Error de conexión con el procesador de pagos' });
    }
});

// GET /api/estado-pago/:id → {PAGOS_BACKEND_URL}/api/estado-pago/:id
app.get('/api/estado-pago/:id', async (req, res) => {
    if (!PAGOS_BACKEND_URL) {
        return res.status(500).json({ success: false, error: 'Backend de pagos no configurado' });
    }
    try {
        const response = await axios.get(`${PAGOS_BACKEND_URL}/api/estado-pago/${req.params.id}`, {
            timeout: 10000
        });
        return res.status(response.status).json(response.data);
    } catch (err) {
        console.error('Proxy /api/estado-pago:', err.message);
        if (err.response) return res.status(err.response.status).json(err.response.data);
        return res.status(502).json({ success: false, error: 'Error de conexión con el procesador de pagos' });
    }
});

// --- PUERTO PARA RENDER Y LOCAL ---
const PORT = process.env.PORT || 3000;

app.listen(PORT, '0.0.0.0', () => {
    console.log(`Servidor corriendo en http://localhost:${PORT}`);
    console.log(`Usando proxy Geonode: ${GEONODE_HOST}:${GEONODE_PORT}`);
    console.log(`Proxy pagos → ${PAGOS_BACKEND_URL ? 'OK' : 'FALTA PAGOS_BACKEND_URL'}`);
});
