<?php
session_start();
include('database.php');
if (empty($_SESSION['sess_user'])) {
    header('location:login.php');
}
// include('db_connection.php');
$sql = "SELECT * FROM users WHERE id='" . $_SESSION['id'] . "'";
// print_r($sql);exit;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// echo '<pre>';
// print_r($row);exit;
if (isset($_POST['submit'])) {
    $e = 0;
    $oldpass_errors = "";
    if (empty($_POST['currentPassword'])) {
        $e = 1;
        $oldpass_errors = 'Current password is required';
    }
    $newpass_errors = "";
    if (empty($_POST['newPassword'])) {
        $e = 1;
        $newpass_errors = 'New Password is required';
    }
    $confirmpass_errors = "";
    if (empty($_POST['confirmPassword'])) {
        $e = 1;
        $confirmpass_errors = 'Confirm Password is required';
    }
    if ($e == 0) {
        $sid = $_SESSION["id"];
        // print_r($sid);
        $dbpassword =  $row["password"];
        print_r($dbpassword);
        $old_password = $_POST['currentPassword'];
        print_r($old_password);
        $new_password = $_POST['newPassword'];
        // print_r($new_password );
        $confirm_password = $_POST['confirmPassword'];
        // print_r($confirm_password );
        $err_newoldpass = "";
        $err_oldpass = "";

        if (md5($old_password) == $dbpassword) {
            if ($new_password ==  $confirm_password) {
                $encrypt_confirmpass = md5($confirm_password);
                $sql = "UPDATE users SET password='$encrypt_confirmpass' WHERE id=$sid";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['message'] = 'Record updated successfully';
                    header("Location:welcomepage.php");
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                $conn->close();
            } else {
                $err_newoldpass = "new Password and confirm Password  is not correct";
            }
        } else {
            $err_oldpass = "old Password is not correct";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        .card {
            background-color: azure;
        }
    </style>
</head>

<body>

    <div class="container">

        <span class="anchor" id="formChangePassword"></span>


 



        <div><?php if (isset($message)) {
                    echo $message;
                } ?></div>
        <div class="container">
            <h2 style=text-align:center;>changepassword form</h2>
            <form class="form" role="form" method="post" autocomplete="off">

                <div class="form-group row">
                    <label for="inputPasswordOld" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="currentPassword" value=<?php if (isset($_POST['currentPassword'])) {
                                                                                                        echo $_POST['currentPassword'];
                                                                                                    } ?>>
                        <span class="text-danger"><?php if (!empty($oldpass_errors)) echo  $oldpass_errors; ?><?php if (!empty($err_oldpass)) echo  $err_oldpass; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPasswordNew" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="newPassword" value=<?php if (isset($_POST['newPassword'])) {
                                                                                                    echo $_POST['newPassword'];
                                                                                                } ?>>
                        <span class="text-danger"><?php if (!empty($newpass_errors)) echo  $newpass_errors; ?></span>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="inputPasswordNewVerify" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="confirmPassword">
                        <span class="text-danger"><?php if (!empty($confirmpass_errors)) echo  $confirmpass_errors; ?><?php if (!empty($err_newoldpass)) echo  $err_newoldpass; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="submit" name="submit">
                    </div>
                </div>
            </form>


        </div>
</body>

</html>