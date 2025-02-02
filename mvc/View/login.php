<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-3">
                <div id="errors"></div>
                <form method="POST" autocomplete="off" id="login-form">
                    <div class="mb-3">
                        <label for="username" class="form-label">Identifiant</label>
                        <input type="text" class="form-control" id="username" name="username" required autocomplete="off" >
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="pass" name="pass" required autocomplete="off" >
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="index.php?component=quizzs" type="button" class="btn btn-primary">Retour</a>
                        <button type="button" class="btn btn-primary" name="valid_login" id="valid-login-btn">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./assets/js/services/login.js" type="module"></script>
    <script type="module">
        import {login} from "./Assets/js/services/login.js";

        document.addEventListener('DOMContentLoaded', () => {
            const validLoginBtn = document.querySelector('#valid-login-btn')
            const loginForm = document.querySelector('#login-form')
            const errorElement = document.querySelector('#errors')

            validLoginBtn.addEventListener('click', async () => {
                if (!loginForm.checkValidity()) {
                    loginForm.reportValidity()
                    return false
                }
                
                const loginResult = await login(loginForm.elements['username'].value, loginForm.elements.pass.value)
                
                if (loginResult.hasOwnProperty('authentication')){
                    document.location.href = 'index.php'
                } else if (loginResult.hasOwnProperty('errors')) {
                    const errors = []
                    for (let i = 0; i < loginResult.errors.length; i++) {
                        errors.push(`<div class="alert alert-danger" role="alert">${loginResult.errors[i]}</div>`)
                    }
                    errorElement.innerHTML = errors.join('')
                }
            })
        })
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }

        .form-label {
            font-weight: 500;
            color: #fff;
        }

        .form-control {
            border-radius: 5px;
            border: none;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            outline: none;
            box-shadow: none;
        }

        .btn-primary {
            background: #4A90E2;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #357ABD;
        }

        .alert-danger {
            background: rgba(255, 0, 0, 0.7);
            color: #fff;
            border: none;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</body>
</html>
