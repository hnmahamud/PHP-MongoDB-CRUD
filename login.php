<?php

session_start();

if(isset($_POST['submit'])){

    require_once __DIR__ . "/vendor/autoload.php";

    $collection = (new MongoDB\Client)->mongotest->users;

    $id = $_POST['id'];
    $password = $_POST['password'];
    $query = $collection->findOne(['id' => $id, 'password' => $password]);

    $_SESSION['id'] = $id;

    if(empty($query)){
        echo "<script type='text/javascript'>alert('Do not match!')</script>";
    }
    else {
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/log-reg.css">
</head>
<body>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <h1>Login</h1>
        </div>

        <form method="POST">
            <input type="number" id="id" class="fadeIn second" name="id" placeholder="ID">
            <input type="password" id="password" class="fadeIn fourth" name="password" placeholder="Password">
            <input type="submit" class="fadeIn fourth" name="submit" value="Submit">
        </form>

        <div id="formFooter">
            <a class="underlineHover" href="registration.php">Registration</a>
        </div>
    </div>
</div>
</body>
</html>