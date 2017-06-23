<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <?php
        $headerLogoID = $_POST['headerLogoID'];
        $headerLogoFileName = $_FILES['headerLogo']['name'];
        $headerLogoFileType = $_FILES['headerLogo']['type'];
        $headerLogoFileTmpLocation = $_FILES['headerLogo']['tmp_name'];

        #Check if $headerLogoID is not null
        if (!empty($headerLogoID) && empty($headerLogoFileName)) {
            require ('db.php');
            $sql = "SELECT headerLogo FROM logo WHERE headerLogoID = :headerLogoID";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':headerLogoID',$headerLogoID, PDO::PARAM_INT);
            $cmd->execute();
            $file = $cmd->fetch();
            $headerLogoFileName = $file['headerLogo'];
        }
        else {
            #Check to ensure that the file uploaded is an image
            $validFileTypes = ['image/jpg', 'image/png', 'image/svg', 'image/gif', 'image/jpeg'];
            $headerLogoFileType = mime_content_type($headerLogoFileTmpLocation);
            #Store the file on the server
            if (in_array($headerLogoFileType, $validFileTypes)) {
                $headerLogoFileName = "uploads/" . uniqid("", true) . "-" . $headerLogoFileName;
                move_uploaded_file($headerLogoFileTmpLocation, $headerLogoFileName);
            }
        }

        require_once ('db.php');

        if (!empty($headerLogoID)){ #Situation which the logo is being updated
            $sql = "UPDATE logo SET headerLogo = :headerLogo WHERE headerLogoID = headerLogoID";
        }
        else {
            $sql = "INSERT INTO logo (headerLogo) VALUES (:headerLogo)";
        }

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':headerLogo',$headerLogoFileName, PDO::PARAM_STR, 100);

        if (!empty($headerLogoID))
            $cmd->bindParam(':headerLogoID', $headerLogoID, PDO::PARAM_INT);

        $cmd->execute();
        $conn = null;
        header('location:mainPublicSite.php');
    ?>
    </body>
</html>
