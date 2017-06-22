<?php
    $pageTitle = 'Registered Users';
    require_once ('header.php');
?>
    <h1>Registered Users</h1>
    <p><a href="registration.php">Register A New Admin</a></p>
<?php
    try {
        require_once ('db.php');
        $sql = "SELECT * FROM users"; #Select all information inside "users" table
        $cmd = $conn->prepare($sql);
        $cmd->execute();
    }
    catch (exception $e) {
        mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
        header('location:error.php');
    }

        $users = $cmd->fetchAll(); #Fetchs all information contained in "users" table to create an array
        $conn = null;

    #Use of "echo" function to print a table on the web page
    echo '<table class="table table-striped table-hover"><tr> <!--Added classes to table tag to customize it-->
                  <th>Email</th> <!--Table headers for all information that can be inserted using the form-->
                  <th>Username</th>
                  <th>Birthday</th>';
    if (!empty($_SESSION['email'])){
        echo '<th>Edit</th>
                  <th>Delete</th>';
    }
    echo '</tr>';
    #Data stored in the "users" SQL table is used to populate the new table through the use of a "foreach" loop
    foreach ($users as $user) {
        #Another "echo" is used to print data below the headers, associating each header with its type of information
        echo '<tr><td>'.$user['email'].'</td> 
                          <td>'.$user['username'].'</td>
                          <td>'.$user['birthday'].'</td>';
        if (!empty($_SESSION['email'])) {
            #Buttons to edit and delete information about users; the delete button, after pressed, shows a confirmation dialog box
            echo '<th><a href="editUser.php?email=' . $user['email'] . '" class="btn btn-xs btn-primary">Edit</a></th>
                          <td><a href="deleteUser.php?email=' . $user['email'] . '" class="btn btn-xs btn-danger confirmation">Delete</a></td></tr>';
        }
        echo '</tr>';
    }
    echo '</table>';
    require_once ('footer.php');
?>