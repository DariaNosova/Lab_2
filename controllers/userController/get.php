<?php
require_once "../../Daos/UserDao.php";
$userDao = new UserDao();
$login = $_POST['login'];
$userDao->getByLogin($login);