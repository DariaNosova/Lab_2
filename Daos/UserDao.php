<?php
include_once "user.php";
include_once "connection.php";

class UserDao
{
    const GET_ALL = "SELECT * FROM `userdata`";
    const GET_BY_LOGIN = "SELECT * FROM `userdata` WHERE `login` = ?";
    const INSERT_USER = "INSERT INTO `userdata`(`login`, `password`, `firstname`, `lastname`, `e-mail`, `role`, `url`) VALUES (?,?,?,?,?,?,?)";
    const UPDATE_USER = "UPDATE `userdata` SET `login`=?, `password`=?, `firstname` = ?, `lastname` = ?, `e-mail` = ?, `role` = ?, `url` = ? WHERE `id` = ?";
    const DELETE_USER = "DELETE FROM `userdata` WHERE `id` = ?";

    function createUser(User $user) {
        $conn = OpenCon();
        $stmt = $conn->prepare(self::INSERT_USER);
        $stmt->bind_param("sssssss", $user->login,
            $user->password,
            $user->firstname,
            $user->lastname,
            $user->email,
            $user->role,
            $user->url);
        $stmt->execute() or die("query wasn't executed" . $stmt->error);
        CloseCon($conn);
    }

    function getAll() {
        $conn = OpenCon();
        $result = $conn->query(self::GET_ALL);
        $response = array();

        while ($row = $result->fetch_assoc()) {
            $user = new User($row["login"], $row["password"], $row["firstname"], $row["lastname"], $row["e-mail"], $row["role"], $row["url"]);
            $user->id = $row["id"];
            array_push($response, $user);
        }
        echo json_encode($response);
        CloseCon($conn);
    }

    function getByLogin($login) {
        $conn = OpenCon();
        $stmt = $conn->prepare(self::GET_BY_LOGIN);
        $stmt->bind_param("s", $login);
        $stmt->execute() or die("query wasn't executed" . $stmt->error);
        $result = $stmt->get_result();
        $response = array();

        while ($row = $result->fetch_assoc()) {
            $user = new User($row["login"], $row["password"], $row["firstname"], $row["lastname"], $row["e-mail"], $row["role"], $row["url"]);
            $user->id = $row["id"];
            array_push($response, $user);
        }
        echo json_encode($response);
        CloseCon($conn);
    }

    function updateUser(User $user) {
        $conn = OpenCon();
        $stmt = $conn->prepare(self::UPDATE_USER);
        $stmt->bind_param("ssssssss", $user->login,
            $user->password,
            $user->firstname,
            $user->lastname,
            $user->email,
            $user->role,
            $user->url,
            $user->id);
        $stmt->execute() or die("query wasn't executed" . $stmt->error);
        CloseCon($conn);
        echo "success";
    }

    function deleteUser($id) {
        $conn = OpenCon();
        $stmt = $conn->prepare(self::DELETE_USER);
        $stmt->bind_param("s", $id);
        $stmt->execute() or die("query wasn't executed" . $stmt->error);
        CloseCon($conn);
        echo "success";
    }

}

    function changeAvatarByMail($email, $url)
    {
    $connection = $this->getSqlConnection();
    $stmt = $connection->prepare(self::UPDATE_FILE_NAME_SQL_QUERY);
    $stmt->bind_param('ss', $url, $email);
    $stmt->execute() or die('Запрос не удался: ' . $stmt->error);
    $this->closeSqlConnection($connection);
    return true;
    }