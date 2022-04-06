<?php

session_start();
include('database.php');
if (isset($_POST['submit']))
//   echo $_POST;exit;
{   
    $e = 0;
    $username_errors = "";
    if (empty($_POST['username'])) {
        $e = 1;
        $username_errors = 'Username is required';
    }
    $password_errors = "";
    if (empty($_POST['password'])) {
        $e = 1;
        $password_errors = 'Password is required';
    }
    if ($e == 0) {
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $err_pass = "";
        $err_user = "";
        $sqlquery = "SELECT * FROM users WHERE name='$userName' ";
        $result = $conn->query($sqlquery);
        $row = $result->fetch_assoc();
       
        //  print_r($row);exit;
        $dbTableName = $row['name'];
        // print_r($dbTableName);exit;
        $dbTablePassword = $row['password'];
        //  print_r($dbTablePassword);exit;

        if ($userName == $dbTableName) {
             if (md5($password) == $dbTablePassword) {
               
                    // print_r($password);

                $_SESSION['sess_user'] = $row['name'];

                $_SESSION['sess_pass'] = $row['password_user'];
                $_SESSION['id'] = $row['id'];
                header("Location:welcomepage.php");
            } else {
                $err_pass = "Invalid  Password!";
            }
        } else {
            $err_user = "Invalid Username";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title>Login</title>
    <style>
        /* form {
            width: 50%;
            margin: auto;
            border: 2px solid black;
            padding: 40px;
            border-radius: 30px;
            margin-top: 100px;
            background-color: white;
            border: none;

        }

        body {
            background-image: url("./img/gradientback2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        } */
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-6">
        <h2 style=text-align:center;>Log in</h2>
                <form  action="" method="POST">
                <div class="message text-danger"></div>
                <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Username</label>
                   
                   <input type="text" name="username" class="form-control mt-3" placeholder="Enter Username" value=<?php if (isset($_POST['username'])) {
                                                                                                                        echo $_POST['username'];
                                                                                                                    } ?>>
                    <span class="text-danger"><?php if (!empty($username_errors)) echo  $username_errors; ?><?php if (!empty($err_user)) echo  $err_user; ?></span>

                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control mt-3" placeholder="Enter Password" value=<?php if (isset($_POST['password'])) {
                                                                                                                            echo $_POST['password'];
                                                                                                                        } ?>>
                    <span class="text-danger"><?php if (!empty($password_errors)) echo  $password_errors; ?><?php if (!empty($err_pass)) echo  $err_pass; ?></span>

                </div>
                <br>
                <button type="submit" value="submit" name="submit" >LOGIN</button>
                <a style="float: right;" href="ajaxform.php" class="mt-3">Register</a>
            </form>
        </div>
    </div>
</body>

</html>