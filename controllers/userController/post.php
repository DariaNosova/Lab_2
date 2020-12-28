<?php
require_once "../../Daos/user.php";
require_once "../../Daos/UserDao.php";

$login = $_POST['login'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['e-mail'];
$url = $_POST['url'];
$role = $_POST['role'];

$user = new User($login, $password, $firstname, $lastname, $email, $role, $url);

$UserDao = new UserDao();
$UserDao->createUser($user);

echo "success";

