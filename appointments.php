<?php
    session_start();
    include ("config.php");
    $userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
    $appt_data = $connection->prepare("SELECT * FROM appointments WHERE user_id=:user_id");
    $appt_data->bindParam("user_id", $userId, PDO::PARAM_INT);
    $appt_data->execute();

?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width,initial-scale=1.0" name="viewport">
        <title>DevCurt - Appointments</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>


            function JS_delete_item(id){
                if (confirm('Are you sure you want to delete this item?')) {
                    window.location.href = 'delete.php?id='+id;
                }
            }

            function jumpMenu(selObj){
                window.location.href =selObj.options[selObj.selectedIndex].value;

            }

        </script>
    </head>

    <body>
        <nav class="topnav" id="topnav">

            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>

            <a name="signout" href="logout.php">Sign Out</a>
            <a href="user.php?uid=<?php echo $_SESSION['user_id'];?>" >Back to User Dashboard</a>
            <h1 class="nav-title">DevCurt</h1>
        </nav>

        <h1>Appointments</h1>

        <section>
            <h2>Scheduled</h2>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>ID: </th>
                        <th>Date: </th>
                        <th>Time: </th>
                        <th>Reason: </th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appt_data as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['appt_date']; ?></td>
                        <td><?php echo $row['appt_time']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><a href="edit.php">Edit</a></td>
                        <td><a class="delete" href="javascript:JS_delete_item(<?php echo $row['id']; ?>);">Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
        <br>
        <button><a href="book_appt.php?uid=<?php echo $userId;?>">Book Appointment</a></button>

        <script>
            function myFunction() {
                const x = document.getElementById("topnav");
                if (x.className == "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
    </body>
</html>
