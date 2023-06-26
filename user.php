<?php
include("config.php");
session_start();

    $userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
    $select = $connection->prepare("SELECT name FROM users where user_id=$userId");

    $select->execute();
    $res = $select->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1.0" name="viewport">
    <title>DevCurt - User Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="topnav" id="topnav">
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

        <a name="signout" href="logout.php">Sign Out</a>
        <a href="appointments.php?uid=<?php echo $userId; ?>">Appointments</a>
        <h1 class="nav-title">DevCurt</h1>
    </nav>
    <br>
    <h1>Welcome to your devcurt profile, <?php echo $res['name'];?>!</h1>
    <p>Use the buttons below to manage your account.</p>
<br>
    <button><a href="resetPassword.php">Reset Password</a> </button>

    <br>
    <script>
        function myFunction() {
            var x = document.getElementById("topnav");
            if (x.className == "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
</body>
</html>