<?php
	if ( !class_exists('Photolok_Custom_Menu')) {
	    class Photolok_Custom_Menu {
	        public function add_nav_menu_meta_boxes() {
	        	add_meta_box(
	        		'photolok_login_nav_link',
	        		__('Photolok® Login'),
	        		array( $this, 'nav_menu_link'),
	        		'nav-menus',
	        		'side',
	        		'low'
	        	);
	        }

	    public function nav_menu_link() 
	    {
	       	$loginText = "Photolok® Login";

			if(get_option('photolok_login_text'))
			{
				$loginText = get_option('photolok_login_text');
			}
	        $photolokClientId = get_option('photolok_client_id');
			$photolokClientSecret = get_option('photolok_client_secret');
			$photolokRedirectEndpoint = get_option('photolok_redirect_endpoint');
			$photolokAccessTokenEndpoint = get_option('photolok_access_token_endpoint');			
			$photolokAuthUrl = $photolokAccessTokenEndpoint . "?response_type=code&client_id=".$photolokClientId."&redirect_uri=".$photolokRedirectEndpoint;

?>
	        	<div id="posttype-photolok-login" class="posttypediv">
	        		<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
	        			<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
	        				<li>
	        					<label class="menu-item-title">
	        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Login Text
	        					</label>
	        					<!-- <input type="text" name="menu-item[-1][menu-item-title]" /> --> 
	        					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
	        					<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="<?php echo $loginText ?>">
	        					<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php echo $photolokAuthUrl ?>">
	        					<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="photolok-login-pop">
	        				</li>
	        			</ul>
	        		</div>
	        		<p class="button-controls">
	        			<span class="add-to-menu">
	        				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-photolok-login">
	        				<span class="spinner"></span>
	        			</span>
	        		</p>
	        	</div>
<?php 
	    	}
	    }
	}
	$custom_nav = new Photolok_Custom_Menu;
	add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));
?>
