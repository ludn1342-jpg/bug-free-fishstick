const express = require('express');
const axios = require('axios');
const cors = require('cors');
const path = require('path');
const fs = require('fs');

const app = express();
app.use(cors());
app.use(express.json());

// ⚡ API KEY DE SCRAPERAPI
const SCRAPER_API_KEY = '8d4950206f69c5a23509deafb2c7011b';

// ============================================================
// 1. INTERCEPTOR DE HTML (Arregla las imágenes sin tocar los HTML)
// ============================================================
app.use(async (req, res, next) => {
    if (!req.path.endsWith('.html') && req.path !== '/') return next();
    const filePath = req.path === '/' ? path.join(__dirname, 'index.html') : path.join(__dirname, req.path);
    
    try {
        if (fs.existsSync(filePath)) {
            let html = fs.readFileSync(filePath, 'utf8');
            // Reemplaza las imágenes de Sencillito por el proxy local
            html = html.replace(/src="(https:\/\/sencillito\.com\/documents\/[^"]+)"/g, 'src="/img-proxy?url=$1"');
            return res.send(html);
        }
        next();
    } catch (error) {
        next();
    }
});

app.use(express.static(path.join(__dirname)));

// ============================================================
// 2. PROXY DE IMÁGENES (ScraperAPI)
// ============================================================
app.get('/img-proxy', async (req, res) => {
    const imageUrl = req.query.url;
    if (!imageUrl || !imageUrl.startsWith('https://sencillito.com/')) {
        return res.status(400).send('URL no válida');
    }

    try {
        const scraperUrl = `http://api.scraperapi.com?api_key=${SCRAPER_API_KEY}&url=${encodeURIComponent(imageUrl)}`;
        const response = await axios.get(scraperUrl, {
            responseType: 'arraybuffer',
            timeout: 20000
        });

        res.setHeader('Content-Type', response.headers['content-type'] || 'image/png');
        res.setHeader('Cache-Control', 'public, max-age=86400'); // Caché 24h
        res.send(response.data);
    } catch (error) {
        console.error('Error img-proxy:', error.message);
        res.setHeader('Content-Type', 'image/gif');
        res.send(Buffer.from('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'base64'));
    }
});

// ============================================================
// 3. CONSULTA DE DEUDA (ScraperAPI)
// ============================================================
app.get('/api/consultar-deuda', async (req, res) => {
    const { accountReference, utilityNumber, utilityVersion, industriaId } = req.query;

    if (!accountReference || !utilityNumber || !utilityVersion || !industriaId) {
        return res.status(400).json({ error: 'Faltan parámetros requeridos' });
    }

    const urlSencillito = `https://sencillito.com/o/portal-publico/consulta-saldo/?accountReference=${accountReference}&utilityNumber=${utilityNumber}&utilityVersion=${utilityVersion}&industriaId=${industriaId}&productTypeId=null&userId=61610&session_key=null&p_auth=UsAcGwzA`;

    try {
        const scraperUrl = `http://api.scraperapi.com?api_key=${SCRAPER_API_KEY}&url=${encodeURIComponent(urlSencillito)}`;
        const response = await axios.get(scraperUrl, { timeout: 25000 });
        res.json(response.data);
    } catch (error) {
        console.error("Error consultar-deuda (ScraperAPI):", error.message);
        res.status(500).json({ error: 'No se pudo consultar la deuda. Intenta más tarde.' });
    }
});

// ============================================================
// 4. PROXY PARA PAGOS (Intacto)
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
    console.log(`ScraperAPI Key → OK`);
    console.log(`Proxy pagos → ${PAGOS_BACKEND_URL ? 'OK' : 'FALTA PAGOS_BACKEND_URL'}`);
});
