const express = require('express');
const axios = require('axios');
const cors = require('cors');
const path = require('path');

const app = express();
app.use(cors());
app.use(express.json());

// Servir los archivos estáticos (HTML, CSS, JS locales)
app.use(express.static(path.join(__dirname)));

// ============================================================
// 1. ENDPOINT PARA LAS IMÁGENES (Evita el hotlinking)
// ============================================================
app.get('/img-proxy', async (req, res) => {
    const imageUrl = req.query.url;
    
    // Validar que sea una URL de Sencillito
    if (!imageUrl || !imageUrl.startsWith('https://sencillito.com/')) {
        return res.status(400).send('URL no válida');
    }

    try {
        // Render descarga la imagen y se la sirve al navegador como si fuera propia
        const response = await axios.get(imageUrl, {
            responseType: 'arraybuffer',
            timeout: 15000,
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Referer': 'https://sencillito.com/'
            }
        });

        res.setHeader('Content-Type', response.headers['content-type']);
        res.setHeader('Cache-Control', 'public, max-age=86400'); // Caché por 1 día
        res.send(response.data);
    } catch (error) {
        console.error('Error img-proxy:', error.message);
        // Si falla, devolvemos una imagen transparente de 1x1 para que no se rompa el diseño
        res.setHeader('Content-Type', 'image/gif');
        res.send(Buffer.from('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'base64'));
    }
});

// ============================================================
// 2. ENDPOINT PARA CONSULTAR DEUDA (Sin Geonode)
// ============================================================
app.get('/api/consultar-deuda', async (req, res) => {
    const { accountReference, utilityNumber, utilityVersion, industriaId } = req.query;

    if (!accountReference || !utilityNumber || !utilityVersion || !industriaId) {
        return res.status(400).json({ error: 'Faltan parámetros requeridos' });
    }

    try {
        const urlSencillito = `https://sencillito.com/o/portal-publico/consulta-saldo/?accountReference=${accountReference}&utilityNumber=${utilityNumber}&utilityVersion=${utilityVersion}&industriaId=${industriaId}&productTypeId=null&userId=61610&session_key=null&p_auth=UsAcGwzA`;

        // Intentamos directo (sin Geonode). A veces Sencillito permite IPs de Render.
        const response = await axios.get(urlSencillito, {
            timeout: 15000,
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept': 'application/json, text/plain, */*',
                'Referer': 'https://sencillito.com/'
            }
        });

        res.json(response.data);

    } catch (error) {
        console.error("Error al consultar deuda:", error.message);

        // Si Sencillito bloquea la IP de Render, intentamos con Geonode (por si acaso)
        try {
            const responseProxy = await axios.get(urlSencillito, {
                timeout: 15000,
                headers: {
                    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept': 'application/json, text/plain, */*'
                },
                proxy: {
                    protocol: 'http',
                    host: '92.204.164.13',
                    port: 9000,
                    auth: { username: 'geonode_PKlL1yvoTG-country-cl', password: '605d224e-19b6-4baa-8107-296ee7d836f5' }
                }
            });
            res.json(responseProxy.data);
        } catch (errorProxy) {
            res.status(500).json({ error: 'No se pudo consultar la deuda (Directo y Proxy fallaron)' });
        }
    }
});

// ============================================================
// 3. PROXY PARA PAGOS (Intacto)
// ============================================================
const PAGOS_BACKEND_URL = process.env.PAGOS_BACKEND_URL;

app.post('/api/crear-pago', async (req, res) => {
    if (!PAGOS_BACKEND_URL) return res.status(500).json({ success: false, error: 'Backend no configurado' });
    try {
        const response = await axios.post(`${PAGOS_BACKEND_URL}/api/crear-pago`, req.body, { timeout: 20000 });
        return res.status(response.status).json(response.data);
    } catch (err) {
        if (err.response) return res.status(err.response.status).json(err.response.data);
        return res.status(502).json({ success: false, error: 'Error de conexión' });
    }
});

app.get('/api/estado-pago/:id', async (req, res) => {
    if (!PAGOS_BACKEND_URL) return res.status(500).json({ success: false, error: 'Backend no configurado' });
    try {
        const response = await axios.get(`${PAGOS_BACKEND_URL}/api/estado-pago/${req.params.id}`, { timeout: 10000 });
        return res.status(response.status).json(response.data);
    } catch (err) {
        if (err.response) return res.status(err.response.status).json(err.response.data);
        return res.status(502).json({ success: false, error: 'Error de conexión' });
    }
});

// ============================================================
// START
// ============================================================
const PORT = process.env.PORT || 3000;
app.listen(PORT, '0.0.0.0', () => {
    console.log(`Servidor corriendo en puerto ${PORT}`);
    console.log(`Proxy pagos → ${PAGOS_BACKEND_URL ? 'OK' : 'FALTA PAGOS_BACKEND_URL'}`);
});
