<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en-ca">
    <head>
        <meta charset="UTF-8">
        <title>Saving Page</title>
    </head>
    <body>
    <?php
        $pageID = $_POST['pageID'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        require_once('db.php');

        if (!empty($pageID)) {
            #SQL statement used to update information edited in the DB
            $sql = "UPDATE pages SET title = :title, content = :content WHERE pageID = :pageID";
        }
        #Put information inserted in the form from "pageDetails" into the "pages" DB
        else {
            $sql = "INSERT INTO pages (title, content) VALUES (:title, :content)";
        }

        echo $sql;

        $cmd = $conn->prepare($sql);
        #Parameter binding to avoid sql injections
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 40);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR, 10000);

        if (!empty($pageID))
            $cmd->bindParam('pageID', $pageID, PDO::PARAM_INT);

        try { #Block used to throw a potential exception and run the code
            $cmd->execute();
        }
        catch (Exception $e) { #All "try" blocks need a catch block, in order to catch an exception
            if (strpos($e->getMessage(), 'Integrity constraint violation: 1048') == true) {
            }
        }

        $conn = null;
        header('location:pagesList.php');
    ?>
    </body>
</html>
<?php ob_flush(); ?>