<?php

    if ( !empty($errors) ) {
        echo '<h1>Error!</h1>
              <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";	
        }
    }

?>
<h1>Login</h1>

<form action="login.php" method="post">
    <ul>
        <li>
            <label for="email">Email address: <input type="email" name="email" size="20" maxlength="80" /></label>
        </li>
        <li>
            <label for="password">Password: <input type="email" name="password" size="20" maxlength="20" /></label>
        </li>
        <li>
            <input type="submit" name="submit" value="login" />
        </li>
        <input type="hidden" name="submitted" value="TRUE" />
    </ul>
</form>
