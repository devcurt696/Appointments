<?php
const User = 'root';
const Password = '';

const Host = 'localhost';
const DB = 'login_form';

try {
    $connection = new PDO("mysql:host=".Host.";dbname=".DB, User, Password);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}