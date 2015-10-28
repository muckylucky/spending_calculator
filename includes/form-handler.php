<?php
session_start();
if ( !isset($_SESSION['user_id']) ) {
	require_once ('includes/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("location: $url");
	exit();
}
		
		
		$page_title = 'Spending updated';
		include ('includes/header.html');
		
        if ( isset($_POST['start']) ) {
            $startTime = $_POST['start'];
            echo '<p>Thank you for contacting me on ' . date('g:i a(T)') . ' on ' . date('l F j, Y') . '.<p>';
            echo '<p><strong>It took ' . (time() - $startTime) . ' seconds for you to complete the form.</strong><p>';
        }
        
        
        if ( isset($_POST['submitted']) ) {
				// load in include file according to local/live environment
				if ( !@include('includes/mysqli_connect.php') ) {
					require_once ('mysqli_connect.php');
				} else {
                	require_once ('includes/mysqli_connect.php');
				}                
				
				if ( !empty($_REQUEST['spend-title']) ) {
                    $title = mysqli_real_escape_string($dbc, strip_tags($_REQUEST['spend-title']) );
                    echo '<p>Title: ' . $title . '<p>';
        
                } else {
                    echo '<h1>ERROR - not submitted</h1>';
                    $title = NULL;
                    echo '<p class="error">Please enter a title.</p>';	
                }
                
                if ( !empty($_REQUEST['spend-amount']) && is_numeric($_REQUEST['spend-amount']) ) {
                    
                    $amount = mysqli_real_escape_string($dbc, (float) $_REQUEST['spend-amount']);
                    echo '<p>Amount: ' . $amount . '<p>';
        
                } if ( !empty($_REQUEST['spend-amount']) && !is_numeric($_REQUEST['spend-amount']) ) {
                    echo '<h1>ERROR - not submitted</h1>';
                    $amount = NULL;
                    echo '<p class="error">Please enter a <em>numeric</em> amount.</p>';	
                    
                } elseif (empty($_REQUEST['spend-amount'])) {
                    echo '<h1>ERROR - not submitted</h1>';
                    $amount = NULL;
                    echo '<p class="error">Please enter an amount.</p>';
                        
                }
                
                if ( !empty($_REQUEST['spend-category']) ) {
                    
                    $category = mysqli_real_escape_string($dbc, strip_tags($_REQUEST['spend-category']) );
                    echo '<p>Category: ' . $category . '<p>';
        
                } else {
                    echo '<h1>ERROR - not submitted</h1>';
                    $category = NULL;
                    echo '<p class="error">Please select a category.</p>';	
                    
                }
                
                if ( !empty($_REQUEST['spend-description']) ) {
                    
                    $description = mysqli_real_escape_string($dbc, strip_tags($_REQUEST['spend-description']) );
                                echo '<p>' . $description . '<p>';
        
                } else {
                    $description = '';
                }
                
                if ( isset($title) && isset($amount) && isset($category) ) {
                    
                    $query = "INSERT INTO monthly_spends_" . $_SESSION['user_id'] . " (id, title, amount, category, description, time) VALUES (NULL, '$title', '$amount', '$category', '$description', NOW() )";
        
                    $r = mysqli_query($dbc, $query);
                    if ($r) {
                        echo '<h1>Spending updated</h1>';
                    } 
                } else {
                    echo '<h1>ERROR - not submitted</h1>';
                }
            echo '<a href="calc.php" class="btn">Back</a>';
            mysqli_close($dbc);
        
        } else {
			echo '<h1>Error!</h1>
				<p class="error">You have accessed this page in error.</p>
				<p><a href="index.php" class="btn btn-primary">Back to the calculator</a>';
		}

		include ('includes/footer.html');
