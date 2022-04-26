<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php
        // remove all session variables
        session_unset();
        unset($_SESSION['sess_user']);
        unset($_SESSION['sess_pass']);
        session_destroy();
        header('location:loginpage.php');
        ?>
    </body>
</html>