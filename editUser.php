<?php
    $pageTitle = 'Edit User';
    require_once ('header.php');
    if (!empty($_GET['email']))
        $email = $_GET['email'];
    if (!empty($email)) { //If email is not empty, connect to the DB located in AWS host; used to edit information
        require_once ('db.php');
        $sql = "SELECT * FROM users WHERE email = :email"; #Select all information inside "users" table
        $cmd = $conn->prepare($sql); #Protect the DB by preventing SQL injection attacks
        $cmd->bindParam(':email', $email, PDO::PARAM_STR); #Binds a PHP variable ($email), with a corresponding named placeholder (email) in the SQL statement (line 9) that was used to prepare the statement
        $cmd->execute();
        $users = $cmd->fetch(); #Fetchs the next row from a result set associated with a PDO statement object
        $conn = null; #Close the connection with the DB
        #Populate the row with the information inserted in the form by associating PHP variables with SQL named placeholders
        $email = $users['email'];
        $username = $users['username'];
        $birthday = $users['birthday'];
    }
?>
    <h1>Edit User</h1>
    <form method="post" action="saveEdit.php">
    <fieldset class="form-group">
        <label for="email" class="col-sm-1">Email: *</label>
        <input name="email" id="email" type="email" required placeholder="email@email.com" value="<?php echo $email ?>"/>
    </fieldset>
    <fieldset class="form-group">
        <label for="username" class="col-sm-1">User Name: </label>
        <input name="username" id="username" placeholder="your name" value="<?php echo $username ?>"/>
    </fieldset>
    <fieldset class="form-group">
        <label for="birthday" class="col-sm-1">Birthday: </label>
        <input name="birthday" id="birthday" type="date" min="1900-01-01" placeholder="Birthday" value="<?php echo $birthday ?>"/>
    </fieldset>
    <input name="oldEmail" value="<?php echo $email ?> type="hidden">
    <button class="btn btn-success col-sm-offset-1">Save</button>
<?php
    require_once ('footer.php');
?>