<?php
include("config.php");
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$sql = "SELECT user_id, email FROM users WHERE email=:email";
$statement = $connection->prepare($sql);
$statement->bindParam("email", $email);
$statement->execute();
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);

if (empty($userInfo)) {
    echo 'Email not found!';
    exit;
}

$userEmail = $userInfo['email'];
$userId = $userInfo['user_id'];

$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);

$insertSql = "INSERT INTO password_reset_request (user_id, date_requested, token) VALUES (:user_id, :date_requested, :token)";
$statement = $connection->prepare($insertSql);

$statement->execute(array(
    "user_id" => $userId,
    "date_requested" => date('Y-m-d H:i:s'),
    "token" => $token
));

$passwordRequestId = $connection->lastInsertId();
$verifyScript = "http://localhost/Appointments/forgot_pass.php";
$linkToSend = $verifyScript . '?uid=' . $userId . '&id=' . $passwordRequestId . '&t=' . $token;
$mesage = "Hello $email - id: $userId, your link to reset  password $linkToSend";
mail($email,"Password reset", $mesage,);
header("Location: login.php");
?>