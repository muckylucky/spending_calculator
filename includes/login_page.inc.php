<?php

	$page_title = 'Login';
	
	include('includes/header.html');
	
    if ( !empty($errors) ) {
        echo '<h1>Error!</h1>
              <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";	
        }
		echo '</p>';
    }
	
?>


<h1>Login</h1>

<form action="login.php" method="post" class="form-horizontal" autocomplete="on">
	<fieldset>
      <div class="control-group">  
              <label for="email"  class="control-label">Email address: </label>
              <div class="controls">
                  <input type="email" name="email" size="20" maxlength="80" required />
              </div>
      </div>
      <div class="control-group">  
              <label for="password" class="control-label">Password: </label>
              <div class="controls">
                  <input type="password" name="password" size="20" maxlength="20" required />
              </div>
      </div>
      <div class="control-group">  
      		<div class="controls">
            		<label class="checkbox">
						<input type="checkbox" name="remember" value="yes"> Remember me </label>
                        <br />
                  <input type="submit" name="submit" value="login" class="btn btn-primary" />

			</div>
      </div>
    <input type="hidden" name="submitted" value="TRUE" />
    
	</fieldset>
    <div class="control-group">
        <div class="controls">
            <p>Not registered? Then sign-up here:</p>
            <a href="register.php" class="btn">Register</a>
        </div>
    </div>
</form>


<?php
	include('includes/footer.html');
?>