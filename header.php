<!DOCTYPE html>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!--Needs to be changed!!-->
</head>
<body>
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">Web Site Builder</a></li>

        <?php
        #Public links
        session_start();
        if (empty($_SESSION['email'])) {
            echo '<li><a href="registration.php">Registration</a></li>
                  <li><a href="login.php">Login</a></li>';
        }
        #Private links
        else {
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>
</nav>