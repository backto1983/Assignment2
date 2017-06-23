<?php
    $pageTitle = 'Login';
    require_once ('header.php');
?>
<h1>Login</h1>
<?php
    if (!empty($_GET['invalid'])) #If statement used to show different warnings to users trying to login
        echo '<div class="alert alert-danger" id="message">Either email or password was incorrect</div>';
    else
        echo '<div class="alert alert-info" id="message">Log into your account</div>';
?>
    <!--This form will post all the information inserted here to be validated in another php file-->
    <form method="post" action="validate.php">
    <fieldset class="form-group">
        <label for="email" class="col-sm-1">Email:</label>
        <input name="email" id="email" required type="email" placeholder="email@email.com">
    </fieldset>

    <fieldset class="form-group">
        <label for="password"  class="col-sm-1">Password:</label>
        <input name="password" id="password" required type="password" placeholder="password">
    </fieldset>

    <fieldset class="form-group col-sm-offset-1">
        <button class="btn btn-success">Login</button>
    </fieldset>
</form>
<?php require_once ('footer.php') ?>