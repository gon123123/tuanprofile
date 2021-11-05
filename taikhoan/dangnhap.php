<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://github.com/gon123123/gon123123/blob/master/LOGO.JPG?raw=true" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>LOGIN</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        box-sizing: border-box;
        background-color: rgb(221, 221, 23);
        background-image: url(https://github.com/gon123123/gon123123/blob/master/mau-vang.jpg?raw=true);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .box__center {
        display: flex;
        margin-top: 10%;
        justify-content: center;
        align-items: center;
    }

    .login {
        width: 50%;
        min-width: 360px;
        margin: 10px;
        background: rgba(0, 0, 0, 0.09);
        color: #fff;
        padding: 20px;
        transition: 0.35s;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    .login:hover {
        box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.5);
    }

    .login .font {
        font-size: 2.5rem;
        text-align: center;
        text-shadow: 10px 3px 10px #fff;
    }

    .login input,
    label {
        margin: 5px 0px 0px 0px;
        outline: none;
    }

    .login input {
        border-radius: 0;
        color: #fff;
        padding: 20px;
        border: 0.5px solid #fff;
        background-color: transparent;

    }

    .login input:focus {
        outline: none;
        background-color: transparent;
    }

    .login input[type="submit"] {
        background-color: #ff0157;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px 15px;
        border-radius: 2px;
        border: none;
    }

    .link {
        margin: auto;
        /* display: flex;
        justify-content: center;
        align-items: center; */
    }
    .link a{
        color: #fff;
        text-decoration: none;
        border-bottom: 0.5px solid #fff;
    }

    .error {
        font-size: 13px;
        font-style: italic;
        color: red;
        margin: 5px 0px;
    }
</style>

<body>
    <div class="container box__center">
        <div class="login">
            <form action="" class="was-validated md-form" method="post">
                <br>
                <p class="font">LOGIN</p>

                <label for="">Name</label>
                <input class="form-control border " name="emaildn" type="email" value="<?php echo (isset($_SESSION['email']))?$_SESSION['email'] : ""  ;?>" placeholder="Email" required>
                <span class="error">*<?php if (!empty($errorEmaildn)) echo $errorEmaildn ?></span> <br>
                <label for="">Password</label>
                <input class="form-control border" name="passdn" type="password" value="<?php echo (isset($_SESSION['pas']))?$_SESSION['pas'] : ""  ;?>" placeholder="Password" required>
                <span class="error">*<?php if (!empty($errorP1dn)) echo $errorP1dn ?></span> <br>
                <input type="submit" name="submit" class="btn btn-info" value="Log In">
                <p class="link"> <a href="?submit=dang ky">no account ? registration</a></p>
            </form>
        </div>
    </div>
</body>

</html>