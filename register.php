<?php
    session_start();
    include('config.php');
    $userId = 1;
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo '<p class="error">Email already in use!</p>';
        }

        if ($query->rowCount() == 0) {
            $userId++;
            $query = $connection->prepare("INSERT INTO users(user_id, name, username, email, password) VALUES (:user_id, :name, :username, :email,:password_hash)");
            $query->bindParam("user_id", $name, type: PDO::PARAM_INT);
            $query->bindParam("name", $name, type: PDO::PARAM_STR);
            $query->bindParam("username", $username, type: PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $result = $query->execute();

            if ($result) {
                echo '<p class="error">Registration Success!</p>';
            } else {
                echo '<p class="error">Unknown error!</p>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width,initial-scale=1.0" name="viewport">
       <title>Register</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="images/icons8-schedule-30.png">
    </head>

    <body>
        <nav class="topnav" id="topnav">
            <h1 class="nav-title"><img src="images/icons8-schedule-30.png" alt="schedule" style="height: 40px; width: 45px;"/>SchedulePro</h1>
        </nav>
        <br>
        <h1>User Registration</h1>

        <form method="post" action="">
            <div class="form-element">
                <label>name: <input type="text" name="name" required /></label
            </div>
            <div class="form-element">
                <label>Username: <input type="text" name="username" pattern="[a-zA-Z0-9]+" required /></label
            </div>
            <div class="form-element">
                <label>E-mail: <input type="Email" name="email" required /></label
            </div>
            <div class="form-element">
                <label>Password: <input type="password" name="password" required /></label
            </div>

            <br><br>
            <button type="submit" name="register" value="register">Register</button>
            <br>

            <p class="redirect">Already a user? <a href="login.php">Login</a> </p>

        </form>
    </body>
</html>