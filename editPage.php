<?php
    $pageTitle = 'Edit Your Page';
    require_once ('header.php');
    if (!empty($_GET['pageID']))
        $pageID = $_GET['pageID'];

    try {
        if (!empty($pageID)) { //If email is not empty, connect to the DB; used to edit information
            require_once ('db.php');
            $sql = "SELECT * FROM pages WHERE pageID = :pageID"; #Select all information inside "pages" table
            $cmd = $conn->prepare($sql); #Protect the DB by preventing SQL injection attacks
            $cmd->bindParam(':pageID', $pageID, PDO::PARAM_INT); #Binds a PHP variable ($pageID), with a corresponding named placeholder (pageID) in the SQL statement (line 9) that was used to prepare the statement
            $cmd->execute();
            $page = $cmd->fetch(); #Fetchs the next row from a result set associated with a PDO statement object
            $conn = null; #Close the connection with the DB
            #Populate the row with the information inserted in the form by associating PHP variables with SQL named placeholders
            $title = $page['title'];
            $content = $page['content'];
        }
    }
        catch (exception $e) {
        mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
        header('location:error.php');
    }
?>
<main class="container">
    <h1>Edit Page</h1>
    <form method="post" action="savePageEdited.php" enctype="multipart/form-data">
        <fieldset class="form-group">
            <label for="title" class="col-sm-1">Title:*</label>
            <input name="title" id="title" required placeholder="Page Title" size="40" value="<?php echo $title ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="content" class="col-sm-1">Content:*</label>
            <textarea name="content" id="content" placeholder="Add Content" maxlength="10000" rows="10" cols="100"><?php echo $content ?></textarea>
        </fieldset>
        <input name="pageID" id="pageID" value="<?php echo $pageID ?>" type="hidden">
        <button class="btn btn-success col-sm-offset-1">Edit Page</button>
    </form>
</main>
<?php
require_once ('footer.php');
?>