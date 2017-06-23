<?php
    $pageTitle = '404'; #To show the title in a browser tab
    require_once ('header.php');
    echo '<main class="container"> <!--It is possible to use the echo string function to print HTML to the screen-->
                <h1>This link is broken =/</h1>
                <img height="400" src="images/lostInTheMatrix.jpg">
            </main>';
    require_once ('footer.php');
?>