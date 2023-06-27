<?php
session_start();
include("config.php");
    $userId = isset($_SESSION['user_id']) ? trim($_SESSION['user_id']) : '';
   if(isset($_GET['id']) && $_GET['id'] != '') {
       $appointmentId = $_GET['id'];
       $stmt = $connection->prepare("DELETE FROM appointments WHERE id=:id");
       $stmt->bindParam('id', $appointmentId, PDO::PARAM_INT);
       $stmt->execute();
       header("Location: appointments.php?uid=$userId");
   } else {
       echo 'error';
   }



?>