	<?php
		$page_title = 'Register';
		include ('includes/header.html');

	?>
        <h1>Spending calculator</h1>
        <p>This calculator is for you to keep a track of your spending since you last got paid. You enter spending as and when you spend money and then you can query what you have spent in the last month. If you opt to enter your pay then the calculator will let you know how much of your wages you have spent.</p>
        <hr />
        <h2>Interested? Then register now</h2>
        <?php # registration page
		require_once ('includes/mysqli_connect.php');
		if ( isset($_POST['submitted']) ) {
			$errors = array(); // Initialise error array
			
			//Check for username
			if ( empty($_POST['username']) ) {
				$errors[] = 'You did not enter a username.';	
			} else {
				// Check usernme is not already registered
				$un = trim( ($_POST['username']) );	
				$unamequery = "SELECT * FROM users WHERE username = '$un'";
				
				$ru = @mysqli_query ($dbc, $unamequery);
				$row = mysqli_fetch_array($ru, MYSQLI_ASSOC);

				if ($row['username'] == $un) {
					$errors[] = 'Username already taken. Please try again.';
					$un = '';
				}
				
			}
			//Check for first name
			if ( empty($_POST['first_name']) ) {
				$errors[] = 'You did not enter your first name.';	
			} else {
				$fn = trim( ($_POST['first_name']) );	
			}		
			//Check for last name
			if ( empty($_POST['last_name']) ) {
				$errors[] = 'You did not enter your last name.';	
			} else {
				$ln = trim( ($_POST['last_name']) );	
			}
		
			//Check for email address
			if ( empty($_POST['email']) ) {
				$errors[] = 'You did not enter your email address.';	
			} else {
				$e = trim( ($_POST['email']) );	
			}
			
			//Check for a password and match against the confirmed password
			if ( !empty($_POST['password1']) ) {
				if ($_POST['password1'] != $_POST['password2']) {
					$errors[] = 'Your password did not match the confirmed password.';	
				} else {
					$p = trim($_POST['password1']);	
				}
			} else {
				$errors[] = 'You forgot to enter your password.';	
			}
			
			//Check they have selected a pay day
			if ( empty($_POST['pay-day']) && !isset($_POST['pay-last']) ) {
				$errors[] = 'You need to enter the day your wages get paid.';	
			} else {
				if ( !empty($_POST['pay-day']) ) {
					$pay = 	$_POST['pay-day'];
				} else {
					$pay = $_POST['pay-last'];
				}
			}
			
			if ( empty($errors) ) {
				// Register the user in the database
				
				//Make the query to add the new user			
				$q = "INSERT INTO users (username, first_name, last_name, email, password, payday) VALUES ('$un', '$fn', '$ln', '$e', SHA1('$p'), '$pay' )";
				
				//Now query to get the newly created ID of that user
				//Need this to create the spending table
				$q2 = "SELECT user_id FROM users WHERE username = '$un'";
				
				$r = @mysqli_query ($dbc, $q);
				$r2 = @mysqli_query ($dbc, $q2);
				
				//Run the user id query so we can access the user_id to create their spending table
				$row2 = $row = mysqli_fetch_array($r2, MYSQLI_ASSOC);
				if ($r) {
					echo '<h1>Thank you!</h1>
						  <p>You are now registered.</p>
						  <a class="btn" href="login.php">Login</a>';	
				} else {
					echo '<h1>System error</h1>
						  <p class="error">You could not be registered due to a system error.</p>';
					// Debugging message
					echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';	
				} // End of if ($r) IF
				
				if ($row2) {
					
					// If the user was created succesfully then create the table
					$q3 = "CREATE TABLE `monthly_spends_" . $row2['user_id'] . "` (
						`id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT ,
						`title` VARCHAR( 60 ) NOT NULL ,
						`amount` DECIMAL( 8, 2 ) NOT NULL ,
						`category` VARCHAR( 60 ) NOT NULL ,
						`description` VARCHAR( 200 ) NOT NULL ,
						`time` DATETIME NOT NULL ,
						PRIMARY KEY (  `id` )
						) ENGINE = MYISAM ;";
						
					$r3 = mysqli_query($dbc, $q3);
					
					if (!$r3) {
					echo '<h2>Error</h2>
						<p class="error">Could not create the new user table. Please try again1.</p>';	
						echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q3 . '</p>';	
						exit();
					}
					
				} else {
					echo '<h2>Error</h2>
						<p class="error">Could not create the new user table. Please try again2.</p>';	
				}
			
			mysqli_close($dbc); //Close the DB connection
			exit(); // Quit the script
		
			} else {
				
				//Report errors
				echo '<h1>Error!</h1>
					  <p class="error">The following error(s) occurred:<br />';
				foreach ($errors as $msg) {
					echo " - $msg<br />\n";	
				}
				
				echo '</p><p>Please try again.</p><p><br /></p>';
			} // End of if (empty($errors)) IF
			
		} // End of main submit conditional
		?>
        <form class="form-horizontal" id="register" name="register" method="post" action="register.php">
        
            <fieldset>
                <div class="control-group">  
                    <label for="username" class="control-label" >Username</label>
                    <div class="controls">
                    	<input name="username" type="text" required size="15" maxlength="20" />
                    </div>
				</div>
                <div class="control-group">  
                    <label for="first_name" class="control-label" >First name</label>
                    <div class="controls">
                    	<input name="first_name" type="text" required size="15" maxlength="20"  />
                    </div>
				</div>
                <div class="control-group">
	                <label for="last_name" class="control-label" >Last name</label>
                    <div class="controls"> 
                    	<input name="last_name" type="text" required size="15" maxlength="40" />
                    </div>
                </div>
                <div class="control-group">
                    <label for="email" class="control-label" >Email address </label>
                    <div class="controls">
                    	<input name="email" type="text" required size="20" maxlength="80" />
					</div>
				</div>
        		<div class="control-group">
                    <label for="password1" class="control-label" >Password </label>
                    <div class="controls">
                    	<input name="password1" type="password" required size="10" maxlength="20" />
					</div>
				</div>
        		<div class="control-group">
                    <label for="password2" class="control-label" >Confirm password </label>
                    <div class="controls">
                    	<input name="password2" type="password" required size="10" maxlength="20" />
					</div>
				</div>
                    
            </fieldset>
            
            <fieldset id="pay">
                <div class="control-group">  
                	<h3>When do you get paid?</h3>
                    <p>In order to keep track of your spending since the day you last got paid you need to select from the options below.</p>
                    <label for="pay-last" class="control-label">Last day of the month</label>
                    <div class="controls">
                        <input type="checkbox" name="pay-last" value="last"> <strong>OR...</strong>
                    </div>
                        
				</div>
                
                <div class="control-group">
                    <label for="first_name" class="control-label" >On the :</label>
                    <div class="controls">
                    	<input name="pay-day" type="number" size="2" maxlength="2" min="1" max="31" placeholder="DD" class="input-mini" />
                        <span><span id="nth">th</span> of every month </span>
                    </div>
                </div>
            </fieldset>
            
            <div class="control-group">
                <div class="controls">
		            <button type="submit" class="btn btn-primary" name="submit">Register</button>
                    <span> Or </span>
                    <a href="login.php" class="btn">Login</a>
                </div>
            </div>
            <input type="hidden" name="submitted" value="TRUE" />
        </form>
        
	<?php
	include ('includes/footer.html');
	?>
