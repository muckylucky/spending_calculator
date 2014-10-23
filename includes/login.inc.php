        <?php # login page
		$page_title = 'Login';
		include ('header.html');
		// Print any errors if there are any
		
		if ( !empty($errors) ) {
			echo '<h1>Error!</h1>
				<p class="error">The following errors occurred:<br />';
			
			foreach ($errors as $msg) {
				echo ' - $msg<br />\n';
			} // FOREACH ERRORS
			echo '</p><p>Please try again.</p>';
		}
		
		// Display the form:
		
		?>
        
        <form class="form-horizontal" id="login" name="login" method="post" action="login.php">
        
            <fieldset>
                <div class="control-group">  
                    <label for="username" class="control-label" >Username</label>
                    <div class="controls">
                    	<input name="username" type="text" required size="15" maxlength="20" />
                    </div>
				</div>
        		<div class="control-group">
                    <label for="password1" class="control-label" >Password </label>
                    <div class="controls">
                    	<input name="password1" type="password" required size="10" maxlength="20" />
					</div>
				</div>
                    
            </fieldset>
            <div class="control-group">
                <div class="controls">
		            <button type="submit" class="btn btn-primary" name="submit">Log in</button>
                </div>
            </div>
            <input type="hidden" name="submitted" value="TRUE" />
        </form>

		<?php
		include ('includes/footer.html');

		?>