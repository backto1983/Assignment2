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

                    $sql = "SELECT pageID, title, content FROM pages ORDER BY pageId";
                    $cmd = $conn->prepare($sql);
                    $cmd->execute();
                    $contents = $cmd->fetchAll();

                    foreach ($contents as $content) { #Loop through page titles and print in the navbar
                        #Use a querystring parameter that indicates which pageID is being requested
                        echo '<li><a href="default.php?pageId=' . $content['pageID'] . '" class="button">' . $content['title'] . '</a></li>';
                    }
                    $conn = null;

                    session_start();

                    if (empty($_SESSION['email'])) { #If not logged in, show only public links
                        echo '<li><a href="login.php">Log In</a></li>
                              <li><a href="registration.php">Register</a></li>';
                    }
                }
                catch (exception $e) {
                    mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
                    header('location:error.php');
                }
            ?>
        </ul>

        <!--Current Username-->
        <?php
            if (!empty($_SESSION['userId'])) {
                echo '<div><h3><center>' . $_SESSION['username'] . '</center></h3></div>';
            }
        ?>
        </nav>