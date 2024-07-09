<?php 
$mysql = new mysqli("MySQL-8.0", "root", "", "dbkin"); 
$mysql->query("SET NAMES 'utf8'");

session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
if(isset($_POST["login"])) {
    $email = test_input($_POST["email"]);
    $pass = md5(test_input($_POST["pass"]));
    $accounts = [];
    $limitation = $mysql->query("SELECT * from accounts WHERE email='$email' limit 1");
    while ($row = mysqli_fetch_assoc($limitation)){
        $accounts[] = array(
            'email'=> $row['email'],
            'pass'=> $row['pass'],
        );
    }
    if (count($accounts) > 0) {
        if ($pass == $accounts[0]['pass']) {
            $_SESSION['email'] = $email;
            unset($_SESSION["AUTH_ERR"]);
            header('location: /');
        } else {
            $_SESSION["AUTH_ERR"] = 3;
            header('location: index.php');
        }
    } else {
        $_SESSION["AUTH_ERR"] = 2;
        header('location: index.php');
    }
}

if(isset($_POST["register"])) {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $pass = md5(test_input($_POST["pass"]));
    $accounts = [];
    $limitation = $mysql->query("SELECT * from accounts WHERE name='$name' limit 1");
    while ($row = mysqli_fetch_assoc($limitation)){
        $accounts[] = array(
            "name"=> $row["name"],
            "email"=> $row["email"],
            "pass"=> $row["pass"],
            );
        }
        if (count($accounts) > 0) {
            $_SESSION["AUTH_ERR"] = 1;
            header('location: index.php');
        } else {
            $mysql->query("INSERT INTO  accounts (name, email, pass) VALUES('".$name."', '".$email."', '".$pass."')");
            header('location: index.php');
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        session_start();
        unset($_SESSION['email']);
        session_destroy();
        echo 'success';
    }