<div class="photolok-page">

	<img src="<?php echo plugins_url( 'assets/logo.svg', __FILE__ ) ?>">
	<p>Photolok Login replaces passwords with photos. Photolok is simple, fast, and provides businesses with a cost-effective, user-friendly solution that protects against hackers. To see how it works, <a href="https://netlok.com/how-it-works/" target="_blank">click here</a>.</p>

	<div class="form-box">
		<div class="left-form">
			<div class="blue-menu">
				<ul>
					<li class="logo-name"><a class="active">Photolok®</a></li>
					<li><a href="#oauthConnection" class="active">OAuth Connection</a></li>
					<li><a href="#wordpressSetup">WordPress Setup</a></li>
					<li><a href="https://netlok.com/support/wordpress/" target="_blank">Support</a></li>
				</ul>
			</div>

			<form method="post" action="options.php">
				<h3 id="oauthConnection">OAuth Connection</h3>
				<p>These values will be sent to you by Photolok.</p>
			    <?php settings_fields( 'photolok-plugin-settings-group' ); ?>
			    <?php do_settings_sections( 'photolok-plugin-settings-group' ); ?>
			    <table class="form-table">
			        <tr valign="top">
			        	<th scope="row">Client ID</th>
			        	<td><input type="text" name="photolok_client_id" value="<?php echo esc_attr( get_option('photolok_client_id') ); ?>" />
			        		<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Client ID</div>
								</div>
			        	</td>
			        </tr>
			        <tr valign="top">
			        	<th scope="row">Client Secret</th>
			        	<td><input type="password" name="photolok_client_secret" value="<?php echo esc_attr( get_option('photolok_client_secret') ); ?>" />
			        		<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Client Secret</div>
								</div>
			        	</td>
			        </tr>
			        <tr valign="top" class="accordion">
			        	<th scope="row" colspan="2">Advanced Options</th>
			        </tr>
			        <tr valign="top" class="panel" style="display: none;">
			        	<th scope="row" colspan="2">
			        		<table class="form-table">
				        		<tr valign="top">
						        	<th scope="row">Access Token Endpoint</th>
						        	<td><input type="text" name="photolok_access_token_endpoint" value="<?php echo esc_attr( get_option('photolok_access_token_endpoint') ); ?>" />
						        		<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Access Token Endpoint</div>
								</div>
						        	</td>
						        </tr>
						        <tr valign="top">
						        	<th scope="row">User Info Endpoint</th>
						        	<td><input type="text" name="photolok_user_info_endpoint" value="<?php echo esc_attr( get_option('photolok_user_info_endpoint') ); ?>" />
						        		<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">User Info Endpoint</div>
								</div>
						        	</td>
						        </tr>
						        <tr valign="top">
						        	<th scope="row">Token Info Endpoint</th>
						        	<td><input type="text" name="photolok_token_info_endpoint" value="<?php echo esc_attr( get_option('photolok_token_info_endpoint') ); ?>" />
						        		<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Token Info Endpoint</div>
								</div>
						        	</td>
						        </tr>
						        <tr valign="top">
						        	<th scope="row">Redirect/Callback Endpoint</th>
						        	<td><input type="text" name="photolok_redirect_endpoint" value="<?php echo esc_attr( get_option('photolok_redirect_endpoint') ); ?>" />
						        		<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Redirect/Callback Endpoint</div>
								</div>
						        	</td>
						        </tr>
				        	</table>
			        	</th>
			        	
			        </tr>
			        
			    </table>
			    
			    <?php submit_button('Save'); ?>

			    <p>
					After saving, you can verify your settings using an active Photolok account by opening a new private browser window and visiting <a href="<?php echo site_url() . '/wp-login.php' ?>" target="_blank">this site's login page</a>. Then you are ready to begin requesting Photolok accounts for your site's users via the Contact Us form on this page. To make the login option easier, use the choices below as you see fit.
				</p>

			<!-- </form>

			<form method="post" action="options.php"> -->
				<h3 id="wordpressSetup">WordPress Setup</h3>
				<p>Customize your site</p>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<th scope="row">
								<label>Login Text</label>
							</th>
							<td>
								<input type="text" name="photolok_login_text" value="<?php echo esc_attr( get_option('photolok_login_text') ); ?>" class="regular-text">
								<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Login Text</div>
								</div>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label>Login Option</label>
							</th>
							<td>
								<select name="photolok_login_option" class="postform" value="<?php echo get_option('photolok_login_option') ; ?>">
									<option value="replace_login" <?php if(get_option('photolok_login_option') == 'replace_login'){ ?>selected = 'selected' <?php } ?>>Replace Login</option>
									<option value="add_login" <?php if(get_option('photolok_login_option') == 'add_login'){ ?>selected = 'selected' <?php } ?>>Add Login</option>
								</select>
								<div class="tooltip">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path></svg>
									<div class="tooltip-content">Login Option</div>
								</div>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label>Login Shortcode</label>
							</th>
							<td>
								<p>[photolok_login]</p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label>Other Options</label>
							</th>
							<td>
								<p class="add-link">Add login options in your theme using a <a href="<?php echo admin_url( 'widgets.php', 'https' ); ?>">custom widget</a>, or add a <a href="<?php echo admin_url( 'nav-menus.php', 'https' ); ?>">menu item.</a></p>
							</td>
						</tr>
					</tbody>
				</table>
				<?php //submit_button(); ?>
			</form>
			
		</div>

		<div class="right-form">
			<h3>Contact Us</h3>
			<P>For questions or to add or remove a member from your photolok account.</P>
			<form method="post" action="<?php echo plugins_url('photolok/sendtophotolok.php'); ?>">
				<input type="text" name="requester_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Requester's Email*" class="regular-text" required>
				<input type="text" name="requester_phone" placeholder="Requester's Phone" class="regular-text" required>
				
				<h3>Photolok User Edit</h3>
				
				<select name="request_type" class="postform">
					<option value="Add New Photolok User">Add New Photolok User</option>
					<option value="Modify Existing Photolok User">Modify Existing Photolok User</option>
					<option value="Delete/Disable User">Temporarily Disable Photolok User</option>
					<option value="Maintain List of Users">Permanently Delete Photolok User</option>
				</select>
				
				<input type="text" name="first_name" placeholder="First Name" class="regular-text" required>
				<input type="text" name="last_name" placeholder="Last Name" class="regular-text" required>
				<input type="text" name="user_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email" class="regular-text" required>
				<input type="text" name="user_phone" placeholder="Phone" class="regular-text" required>

				<textarea class="large-text" name="additional_message" rows="3" placeholder="Additional Message"></textarea>
				
				<input type="submit" class="blue-button" name="submit" value="send" />

				<?php 
					if(isset($_GET['success']) && $_GET['success'] == "true")
					{ 
				?>
			    		<div class="success-message message">
							<span>Email sent successfully to Photolok Support</span>

							<!-- <a href="#" class="close-btn"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg>
							</a> -->
						</div>
			    <?php
					}
					elseif(isset($_GET['error']) && $_GET['error'] == "true"){
				?>	
						<div class="error-message message">
							<span>Some error occurred while sending email.</span>

							<!-- <a href="#" class="close-btn"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg>
							</a> -->
						</div>
				<?php } ?>
				
				<p class="last-notes">This form plus basic info about your WordPress site will be sent to Photolok and is covered by our <a href="https://netlok.com/privacy-policy/" target="_blank">privacy policy</a>. If you have multiple edits to send, either submit this form multiple times or email a list to <a href="mailto:photoloksupport@netlok.com">Photoloksupport@netlok.com</a> (for each user, include First and Last Name; Email; Phone; and either Add, Disable or Modify).</p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	 var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "table-row") {
          panel.style.display = "none";
        } else {
          panel.style.display = "table-row";
        }
      });
    }
</script>