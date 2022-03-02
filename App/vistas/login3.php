<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/css/styles.css">
</head>

<body>
    <section class="login-dark">
        <form method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a>
        </form>
    </section>
    <script src="<?php echo RUTA_URL ?>/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>