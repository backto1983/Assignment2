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
        <?php
        try {
            require_once('db.php');

            $headerLogo = null;

            $sql = "SELECT headerLogo FROM logo ORDER BY headerLogoID DESC LIMIT 1";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':headerLogoID', $headerLogoID, PDO::PARAM_INT);
            $cmd->execute();
        }
        catch (exception $e) {
            mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
            header('location:error.php');
        }

        $headerLogo = $cmd->fetch();

        ?>
        <li><img height="60" width="60" src="<?php echo $headerLogo['headerLogo'] ?>" id="headerLogo" title="Header Logo"></li>
        <li><a href="mainPublicSite.php" class="navbar-brand">Web Site Builder</a></li>

        <?php
        #Public links; they appear even when not logged in
        session_start();
        if (empty($_SESSION['email'])) { #Function used to initiate a session using a parameter

            try {
                require_once('db.php');
                $sql = "SELECT pageID, title, content FROM pages ORDER BY pageId";
                $cmd = $conn->prepare($sql);
                $cmd->execute();
            }
            catch (exception $e) {
                mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
                header('location:error.php');
            }

            $contents = $cmd->fetchAll();
            foreach ($contents as $content) { #Loop through page titles and print in the navbar
                #Use a querystring parameter that indicates which pageID is being requested
                echo '<li><a href="default.php?pageID=' . $content['pageID'] . '" class="button">' . $content['title'] . '</a></li>';
            }

            $conn = null;

            echo '<li><a href="registration.php">Registration</a></li>
                          <li><a href="login.php">Login</a></li>';
        }
        #Private links; only appear if you're logged
        else {
            echo '<li><a href="registeredUsers.php">Registered Users</a></li>';
            echo '<li><a href="controlPanel.php">Control Panel</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';

            #Add the user name to the navigation bar
            echo '<li><div class="navbar-text pull-right">' . $_SESSION['email'] . '</div></li>';
        }
        ?>
    </ul>
</nav>
