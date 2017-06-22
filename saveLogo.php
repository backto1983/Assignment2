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

        //check if the $fileName is null, but there is an entry in the DB
        if (!empty($headerLogoID) && empty($headerLogoFileName))
        {
            require ('db.php');
            $sql = "SELECT headerLogo FROM logo WHERE headerLogoID = :headerLogoID";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':headerLogoID',$headerLogoID, PDO::PARAM_INT);
            $cmd->execute();
            $file = $cmd->fetch();
            $headerLogoFileName = $file['headerLogo'];
        }
        else {
            //Check to ensure that the file uploaded is an image
            $validFileTypes = ['image/jpg', 'image/png', 'image/svg', 'image/gif', 'image/jpeg'];
            $headerLogoFileType = mime_content_type($headerLogoFileTmpLocation);
            //store the file on our server
            if (in_array($headerLogoFileType, $validFileTypes)) {
                $headerLogoFileName = "uploads/" . uniqid("", true) . "-" . $headerLogoFileName;
                move_uploaded_file($headerLogoFileTmpLocation, $headerLogoFileName);
            }
        }

        require_once ('db.php');

        if (!empty($headerLogoID)){
            $sql = "UPDATE logo SET headerLogo = :headerLogo WHERE headerLogoID = headerLogoID";
        }
        else {
            $sql = "INSERT INTO logo (headerLogo) VALUES (:headerLogo)";
        }

        //step 3 - prepare the SQL command and bind the arguments to prevent SQL injection
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':headerLogo',$headerLogoFileName, PDO::PARAM_STR, 100);

        if (!empty($headerLogoID))
            $cmd->bindParam(':headerLogoID', $headerLogoID, PDO::PARAM_INT);
        //step 4 - execute
        $cmd->execute();
        //step 5 - disconnect from database
        $conn = null;
        //step 6 - redirect to the default page
        header('location:default.php');
    ?>
    </body>
</html>
