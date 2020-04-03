<?php

session_start();

if(isset($_POST['submit'])){

    require_once __DIR__ . "/vendor/autoload.php";

    $collection = (new MongoDB\Client)->mongotest->users;

    $id = $_POST['id'];
    $criteria = array("id"=> $id);
    $query = $collection->findOne($criteria);

    if(empty($query)){
        $insertOneResult = $collection->insertOne([
            'id' => $_POST['id'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ]);

        $_SESSION['success'] = "User created successfully";
        header("Location: login.php");
    }
    else {
        echo "<script type='text/javascript'>alert('ID already taken!')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/log-reg.css">
</head>
<body>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>Registration</h1>
        </div>

        <form method="POST">
            <input type="number" id="id" class="fadeIn second" name="id" placeholder="ID">
            <input type="text" id="username" class="fadeIn third" name="username" placeholder="Username">
            <input type="password" id="password" class="fadeIn fourth" name="password" placeholder="Password">
            <input type="submit" class="fadeIn fourth" name="submit" value="Submit">
        </form>

        <div id="formFooter">
            <a class="underlineHover" href="login.php">Login</a>
        </div>
    </div>
</div>
</body>
</html>