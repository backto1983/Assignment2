<?php
$pageTitle = 'Upload A Logo';
require_once ('header.php');
?>
<main class="container">
    <h1>Upload A Logo</h1>
<?php
    if (!empty($_GET['headerLogoID']))
        $headerLogoID = $_GET['headerLogoID'];
    else
        $headerLogoID = null;

    $headerLogo = null;

    require_once('db.php');

    $sql = "SELECT headerLogo FROM logo ORDER BY headerLogoID DESC LIMIT 1";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':headerLogoID', $headerLogoID, PDO::PARAM_INT);
    $cmd->execute();
    $headerLogo = $cmd->fetch();

?>
<form method="post" action="saveLogo.php"  enctype="multipart/form-data">
    <fieldset class="form-group">
        <label for="headerLogo" class="col-sm-1">Logo Img</label>
        <input name="headerLogo" id="headerLogo" type="file" />
    </fieldset>
    <input name="headerLogoID" id="headerLogoID" value="<?php echo $headerLogoID?>" type="hidden"/>
    <button class="btn btn-success col-sm-offset-1">Save</button>
</form>
<img height="300" width="300" src="<?php echo $headerLogo['headerLogo'] ?>" id="headerLogo" title="Header Logo">
<?php
require_once ('footer.php');
?>

