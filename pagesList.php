<?php
    #Get title from DB
    require_once ('header.php');
?>
<main class="container">
    <h1>List Of Pages</h1>
<?php
    $pageTitle = 'List Of Pages';
    require_once ('db.php');
    $sql = "SELECT * FROM pages"; #Select all information inside "users" table
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $pages = $cmd->fetchAll(); #Fetchs all information contained in "users" table to create an array
    $conn = null;
    #Use of "echo" function to print a table on the web page
    echo '<table class="table table-striped table-hover"><tr> <!--Added classes to table tag to customize it-->
                      <th>Title</th> <!--Table headers for all information that can be inserted using the form-->
                      <th>Content</th>';

    if (!empty($_SESSION['email'])){
        echo '<th>Edit</th>
              <th>Delete</th>';
    }
    echo '</tr>';
    #Data stored in the "users" SQL table is used to populate the new table through the use of a "foreach" loop
    foreach ($pages as $page) {
        #Another "echo" is used to print data below the headers, associating each header with its type of information
        echo '<tr><td>'.$page['title'].'</td> 
                  <td>'.$page['content'].'</td>';
        if (!empty($_SESSION['email'])) {
            #Buttons to edit and delete information about users; the delete button, after pressed, shows a confirmation dialog box
            echo '<th><a href="editPage.php?pageID=' . $page['pageID'] . '" class="btn btn-xs btn-primary">Edit</a></th>
                  <td><a href="deletePage.php?pageID=' . $page['pageID'] . '" class="btn btn-xs btn-danger confirmation">Delete</a></td></tr>';
        }
        echo '</tr>';
    }
    echo '</table>';
    require_once ('footer.php');
?>
</main>
