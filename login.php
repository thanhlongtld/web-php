<?php
session_start();

if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
    header("Location: ../index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper rounded">
        <div id="register" class="w-50 m-auto">
            <h2 class="text-center">Đăng nhập</h2>
            <form id="login-form" method="post" action="./actions/login.php">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                </div>

                <?php
                if (isset($_SESSION['error'])) {
                ?>
                    <p class="text-danger"><?php echo $_SESSION['error'] ?></p>
                <?php
                    unset($_SESSION['error']);
                }

                ?>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>