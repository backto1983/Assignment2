<?php
    $pageTitle = '404';
    $content = 'My Page Data';
    require_once ('header.php');
    echo '<main class="container">
                <h1>This link is broken =/</h1>
                <img height="400" src="images/lostInTheMatrix.jpg">
                <p>'.$content.'</p> <!--?????-->
            </main>';
    require_once ('footer.php');
?>