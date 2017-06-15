<!DOCTYPE html>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">Web Site Builder</a></li>

        <?php
        #Public links; they appear even when not logged in
        session_start();
        if (empty($_SESSION['email'])) { #Function used to initiate a session using a parameter
            echo '<li><a href="registration.php">Registration</a></li>
                  <li><a href="login.php">Login</a></li>';
        }
        #Private links; only appear if you're logged
        else {
            echo '<li><a href="registeredUsers.php">Registered Users</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>
</nav>