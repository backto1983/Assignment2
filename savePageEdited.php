<!DOCTYPE html>
<html lang="en-ca">
    <head>
        <meta charset="UTF-8">
        <title>Registering User</title>
    </head>
    <body>
    <?php
        $title = $_POST['title']; #Association of php variables with information posted in the "editUser" php file
        $content = $_POST['content'];
        $ok = true;

    if ($ok) {
        try {
            require_once('db.php');
            #SQL statement used to update information edited in the DB
            $sql = "UPDATE pages SET title = :title, content = :content WHERE pageID = :pageID";
            $cmd = $conn->prepare($sql);
            #Parameter binding to avoid sql injections
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 40);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR, 10000);

            $cmd->execute();
            $conn = null;
            header('location:pagesList.php');
        }
        catch (exception $e) {
            mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
            header('location:error.php');
        }
    }
    ?>
    </body>
</html>