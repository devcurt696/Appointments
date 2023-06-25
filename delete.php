<?php
include("config.php");

   if(isset($_GET['id']) && $_GET['id'] != '') {
       $id = $_GET['id'];
       $stmt = $connection->prepare("DELETE FROM appointments WHERE id=:id");
       $stmt->bindParam(':id', $id, PDO::PARAM_INT);
       $stmt->execute();
       header("Location: appointments.php");
   } else {
       echo 'error';
   }



?>