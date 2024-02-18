<?php
require_once('scripts/AdminLogin.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badwa Admins</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" type="image/x-icon" href="..\admin\public\images\icon-nav\azul.ico" sizes="32x32 azul.ico">
    
    <style>
        body {
            background-color: #f8f9fa; /* Ajoutez une couleur de fond si nécessaire */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 mt-5">
            <!--- formulaire de connexion -->
            <div class="login-form bg-light p-4">
                <h1 class="text-success text-center">Admin Panel</h1>
                <p class="text-danger text-center"><?= $login ?? ''; ?></p>
                <form method="post">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="emailAddress">
                        <p class="text-danger"><?= $validateLogin['emailErr'] ?? ''; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="email">Mot de passe</label>
                        <input type="password" class="form-control" name="pass">
                        <p class="text-danger"><?= $validateLogin['passErr'] ?? ''; ?></p>
                    </div>

                    <div class="row">
                    <button type="submit" name="login" class="btn btn-success btn-block">Connexion</button>
                </form>
            </div>
            <!---- formulaire de connexion -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
