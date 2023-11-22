<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital Control Panel - Login</title>
    <link rel="stylesheet" href="<?= base_url("control_panels/css/login.css") ?>">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>LOGIN</h2>
            <?php if(isset($msg)) echo '<p class="notif">'.$msg.'</p>';?>
            <form action="" method="POST">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="pass" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

</body>

</html>