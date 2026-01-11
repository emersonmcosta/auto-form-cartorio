<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela de Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
        }

        /* Coluna esquerda */
        .left {
            width: 50%;
            background-color: #f4f4f4;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            overflow: hidden;
        }

        /* Imagem com opacidade */
        .left::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('img/cartorios.png') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.35; /* ajuste aqui */
            z-index: 0;
        }

        .left h1 {
            font-size: 36px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            color: #000;
        }

        .left p {
            font-size: 18px;
            line-height: 1.5;
            position: relative;
            z-index: 1;
            color: #000;
        }

        /* Coluna direita */
        .right {
            width: 50%;
            background-color: #547269ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #1f2f2a;
            padding: 40px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            color: #fff;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            max-width: 100px;
        }

        .login-card input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            outline: none;
        }

        .login-card button {
            width: 100%;
            padding: 12px;
            background-color: #ffffff;
            color: #1f2f2a;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-card button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Spinner */
        .spinner {
            width: 18px;
            height: 18px;
            border: 3px solid #1f2f2a;
            border-top: 3px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #333;
            color: #fff;
            padding: 14px 20px;
            border-radius: 6px;
            opacity: 0;
            transform: translateY(-20px);
            transition: 0.4s;
            z-index: 9999;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast.success { background: #2e7d32; }
        .toast.error { background: #c62828; }

        /* Responsivo */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left, .right {
                width: 100%;
                height: 50%;
            }
        }
    </style>
</head>
<body>

    <div class="left">
        <h1>Bem-vindo</h1>
        <p>Faça login para acessar o sistema e continuar sua experiência.</p>
    </div>

    <div class="right">
        <div class="login-card">

            <div class="logo">
                <img src="{{ asset('img/logo-branco.png') }}" alt="Logo">
            </div>

            <input type="text" id="username" placeholder="Usuário">
            <input type="password" id="password" placeholder="Senha">

            <button id="loginBtn">
                <span id="btnText">Entrar</span>
                <div class="spinner" id="spinner"></div>
            </button>

        </div>
    </div>

    <div id="toast" class="toast"></div>

    <script>
        const loginBtn = document.getElementById('loginBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        const toast = document.getElementById('toast');

        function showToast(message, type = 'success') {
            toast.textContent = message;
            toast.className = `toast show ${type}`;
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        loginBtn.addEventListener('click', async () => {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (!username || !password) {
                showToast('Informe usuário e senha', 'error');
                return;
            }

            loginBtn.disabled = true;
            spinner.style.display = 'block';
            btnText.textContent = 'Entrando';

            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' , 'X-CSRF-Token': '{{ csrf_token() }}'},
                    body: JSON.stringify({ username, password })
                });

                if (response.status === 200) {
                    showToast('Login realizado com sucesso!', 'success');
                    window.location.href = '/admin';
                } else if (response.status === 422) {
                    showToast('Usuário ou senha inválidos', 'error');
                } else {
                    showToast('Erro interno. Tente novamente.', 'error');
                }
            } catch (e) {
                showToast('Erro de conexão com o servidor', 'error');
            } finally {
                loginBtn.disabled = false;
                spinner.style.display = 'none';
                btnText.textContent = 'Entrar';
            }
        });
    </script>

</body>
</html>
