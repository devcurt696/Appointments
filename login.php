<?php
    session_start();
    include("config.php");
    if (isset($_POST['login'])) {
       $username = $_POST['username'];
       $password = $_POST['password'];
       $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
       $query->bindParam("username", $username, PDO::PARAM_STR);
       $query->execute();
       $result = $query->fetch(PDO::FETCH_ASSOC);
       if (!$result) {
           echo '<p class="error">Username and/or password is not correct!</p>';
       } else {
           if (password_verify($password, $result['password'])) {
               $_SESSION['user_id'] = $result['user_id'];
               echo '<p class="success">Logged in successfully!</p>';
           } else {
               echo '<p class="error">Username or password incorrect!</p>';
           }
       }

       if(!isset($_SESSION['user_id'])) {
           header('Location: login.php');
           exit;
       } else {
           $userId = $_SESSION['user_id'];
           header("Location: user.php?uid=$userId");
           exit;
       }
    }

?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width,initial-scale=1.0" name="viewport">
        <title>Login</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="images/icons8-schedule-30.png">
    </head>

    <body>
        <nav class="topnav" id="topnav">
            <h1 class="nav-title"><img src="images/icons8-schedule-30.png" alt="schedule" style="height: 40px; width: 45px;"/>SchedulePro</h1>
        </nav>
        <br>
        <h1>User Login</h1>
        <form method="post">
            <div class="form-element">
                <label>Username: <input type="text" name="username" pattern="[a-zA-Z0-9]+" required/></label>
            </div>
            <div class="form-element">
                <label>Password: <input type="password" name="password" required/></label>
            </div>

            <button type="submit" name="login" value="login">Log In</button>
            <br>

                <p>Not a user? <a href="register.php">Register</a> </p>
            <p>Forgot your password? <a href="resetPassword.php">Reset Password</a> </p>
        </form>
    </body>
</html>