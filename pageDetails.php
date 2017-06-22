<?php
    $pageTitle = 'Add A New Page';
    require_once ('header.php');
?>
<main class="container">
    <h1>Add A Page</h1>
<?php
    if (!empty($_GET['pageID']))
        $pageID = $_GET['pageID'];
    else
        $pageID = null;

    $title = null;
    $content = null;

?>
    <form method="post" action="savePage.php" enctype="multipart/form-data">
        <fieldset class="form-group">
            <label for="title" class="col-sm-1">Title:*</label>
            <input name="title" id="title" required placeholder="Page Title" size="40"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="content" class="col-sm-1">Content:*</label>
            <textarea name="content" id="content" placeholder="Add Content" maxlength="10000" rows="10" cols="100"></textarea>
        </fieldset>
        <input name="pageID" id="pageID" value="<?php echo $pageID ?>" type="hidden">
        <button class="btn btn-success col-sm-offset-1">Save Page</button>
    </form>
</main>
<?php require_once ('footer.php') ?>
