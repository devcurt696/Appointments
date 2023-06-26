<?php
session_start();
include("config.php");

if (isset($_POST['changePass'])) {
    $id = isset($_GET['uid']) ? trim($_GET['uid']) : '';
    $newPassword = $_POST['new_password'];
    $password_hash = password_hash($newPassword, PASSWORD_BCRYPT);
    $update = $connection->prepare("UPDATE users SET password = :password WHERE user_id=:id");
    $update->bindParam("password", $password_hash, PDO::PARAM_STR);
    $update->bindParam('id', $id);
    $update->execute();
    header("Location: login.php");
}




?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width,initial-scale=1.0" name="viewport">
        <title>Change Password</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <h1>Change Password</h1>
        <form method="post">

            <div class="form-element">
                <label>id: <?php echo $_GET['uid']?></label>
            </div>
            <div class="form-element">
                <label>New Password: <input type="password" name="new_password" required/></label>
            </div>

            <button type="submit" name="changePass" value="change">Change Password</button>
            <br>


        </form>
    </body>
</html>