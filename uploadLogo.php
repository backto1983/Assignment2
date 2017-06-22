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
?>
<form method="post" action="saveLogo.php"  enctype="multipart/form-data">
    <fieldset class="form-group">
        <label for="headerLogo" class="col-sm-1">Logo Img</label>
        <input name="headerLogo" id="headerLogo" type="file" />
    </fieldset>
    <input name="headerLogoID" id="headerLogoID" value="<?php echo $headerLogoID?>" type="hidden"/>
    <button class="btn btn-success col-sm-offset-1">Save</button>
</form>
<img height="200" src=<?php echo $headerLogo ?>>
<?php
require_once ('footer.php');
?>

