<?php
session_start();
include("config.php");
$userId = $_SESSION['user_id'];
if (isset($_POST['book'])) {
    $apptDate = $_POST['appt_date'];
    $apptTime = $_POST['appt_time'];
    $reason = $_POST['reason'];

    $data = [
            'appt_date' => $apptDate,
            'appt_time' => $apptTime,
            'reason' => $reason,
            'user_id' => $userId
    ];
    $query = $connection->prepare("INSERT INTO appointments (appt_date, appt_time, reason, user_id) VALUES (:appt_date, :appt_time, :reason, :user_id)");

    $result = $query->execute($data);

    if ($result) {
        echo '<p class="error">Success! Appointment booked</p>';
        header("Location: appointments.php?uid=$userId");
    } else {
        echo '<p class="error">Unknown error!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width,initial-scale=1.0" name="viewport">
        <title>SchedulePro - Book Appointment</title>
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="images/icons8-schedule-30.png">
    </head>
    <body>
    <nav class="topnav" id="topnav">
        <a href="javascript:void(0);" class="icon" onclick="toggleResponsive()">
            <i class="fa fa-bars"></i>
        </a>

        <a name="signout" href="logout.php">Sign Out</a>
        <a href="appointments.php?uid=<?php echo $userId; ?>">Appointments</a>
        <h1 class="nav-title"><img src="images/icons8-schedule-30.png" alt="schedule" style="height: 35px; width: 40px;"/>SchedulePro</h1>
    </nav>

    <br>

    <h2>Schedule an appointment: </h2>
    <section>
        <form method="post" action="">

            <label for="appt_date">Date: <input type="date" name="appt_date" placeholder="mm/dd/yyyy" required/></label>
            <br>
            <label for="appt_time">Time: <input type="time" name="appt_time" required/></label>
            <br>
            <label for="reason">Reason: <textarea name="reason" minlength="10" maxlength="50" required></textarea></label>
            <br>
            <button type="submit" name="book" value="book">Schedule</button>
        </form>


    </section>
    <script>
        function toggleResponsive() {
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