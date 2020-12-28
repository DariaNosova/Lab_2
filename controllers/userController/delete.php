<?php
require_once "../../Daos/UserDao.php";
$id = $_POST['id'];
$userDao = new UserDao();
$userDao->deleteUser($id);