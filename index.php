<?php

/**
* Plugin Name: Photolok® Login
* Plugin URI: 
* Description: Photolok® Login with WordPress.
* Version: 1.1
* Author: Netlok.
* Author URI: https://netlok.com/
*/

#ini_set("display_errors", 1);

$styleFile = plugins_url( 'assets/style.css?1.0.30', __FILE__ );
$scriptFile = plugins_url( 'assets/photolok-script.js?1.0.3', __FILE__ );

define("photolokClientId", get_option('photolok_client_id'));
define("photolokClientSecret", get_option('photolok_client_secret'));
define("photolokRedirectEndpoint", get_option('photolok_redirect_endpoint'));
define("site_url", get_site_url());
define("admin_site_url", get_site_url()."/wp-admin");

wp_enqueue_style( 'my-css', $styleFile );
wp_enqueue_script('photolok-script', $scriptFile, array('jquery'), false, true );

// remove version from scripts and styles

function remove_version_scripts_styles($src) 
{
    if (strpos($src, 'photolok')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

function photolok_login() 
{
    ob_start();
    photolok_wplogin_form_button();
    return ob_get_clean();   
}

add_shortcode( 'photolok_login', 'photolok_login' );
add_filter('style_loader_src', 'remove_version_scripts_styles', 9999);

//add_action( 'login_form', 'photolok_wplogin_form_button' );
add_action( 'login_message', 'photolok_wplogin_form_button' );
add_action( 'login_message', 'wordpress_login_text' );
add_action( 'login_form', 'manipulate_login_type' );
add_action('init', 'login_text_init');

function login_text_init() 
{
	if(!get_option('photolok_login_text')){
  		update_option('photolok_login_text', 'Photolok® Login');
	}
}

/* Add / Replace Login in Admin Page */

function manipulate_login_type()
{
	$login_type = get_option('photolok_login_option');
	if($login_type == "replace_login")
	{
		$loginHtml = "<style type='text/css'>";
		$loginHtml .= "#loginform p, .user-pass-wrap, #login #nav a { display: none; }";
		$loginHtml .= "</style>";
		$loginHtml .= "<a href='javascript:void(0)' class='wp_default_login_class'>WordPress Login</a>";
		echo $loginHtml;
	}
}

/* Add / Replace Login in Admin Page */

function photolok_wplogin_form_button()
{
	if(!is_user_logged_in())
	{
		$photolokClientId = get_option('photolok_client_id');
		$photolokClientSecret = get_option('photolok_client_secret');
		$photolokRedirectEndpoint = get_option('photolok_redirect_endpoint');
		$photolokAccessTokenEndpoint = get_option('photolok_access_token_endpoint');
		$photolokAuthUrl = $photolokAccessTokenEndpoint . "?response_type=code&client_id=".$photolokClientId."&redirect_uri=".$photolokRedirectEndpoint;

		$loginText = "Photolok® Login";

		if(get_option('photolok_login_text'))
		{
			$loginText = get_option('photolok_login_text');
		}

		echo "<div class='photolok_login'><a href='".$photolokAuthUrl."'><img src='".plugins_url( 'assets/login-screen-img.svg', __FILE__ )."' />".$loginText."</a></div>";	
	}
}

function wordpress_login_text()
{
	echo '<h2 class="wordpress-login-text">WordPress Login</h2>';	
}

add_action('admin_menu', 'photolok_setup_menu');

function photolok_setup_menu()
{
    add_menu_page( 'Photolok® Login Page', 'Photolok® Login', 'manage_options', 'photolok-plugin', 'photolok_plugin_settings_page' );
    add_action( 'admin_init', 'register_photolok_plugin_settings' );
}

function register_photolok_plugin_settings() 
{
	//register our settings

	register_setting( 'photolok-plugin-settings-group', 'photolok_client_id' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_client_secret' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_access_token_endpoint' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_user_info_endpoint' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_token_info_endpoint' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_redirect_endpoint' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_login_text' );
	register_setting( 'photolok-plugin-settings-group', 'photolok_login_option' );
}

function photolok_plugin_settings_page()
{
	extract(shortcode_atts(array(
	    'file' => 'default'
	), $params));

	include(ABSPATH . "wp-content/plugins/photolok/$file.php");
}

function photolok_oauth_redirect_validate()
{
	if(isset($_GET['code']) && $_GET['code'])
	{
		$photolokTokenEndpoint = get_option('photolok_access_token_endpoint');

		$url = "https://api.photolok.net/oauth/token";
		$fields = array(
			'client_id' => photolokClientId,
			'client_secret' => photolokClientSecret,
			'redirect_uri' => photolokRedirectEndpoint,
			'grant_type' => 'authorization_code',
			'code' => $_GET['code']
		);

		$i=1;

		foreach($fields as $key=>$value) 
		{ 
			if($i < count($fields))
				$fields_string .= $key.'='.$value.'&'; 
			else
				$fields_string .= $key.'='.$value;
			$i++;
		}	
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-www-form-urlencoded'
	    ));

		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$result = curl_exec($ch);
		$errNo = curl_errno($ch);
		$err = curl_error($ch);
		curl_close($ch);
		
		$resultObject = json_decode($result);

		if(is_object($resultObject))
		{
			if(isset($resultObject->access_token) && $resultObject->access_token)
			{
				$photolokTokenInfoEndpoint = get_option('photolok_token_info_endpoint');
				$url = $photolokTokenInfoEndpoint;
				$accessToken = $resultObject->access_token;
				$ch1 = curl_init();
				
				curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer '.$accessToken
                ));

				curl_setopt($ch1,CURLOPT_URL, $url);
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
				
				$result1 = curl_exec($ch1);
				curl_close($ch1);

				$resultObject1 = json_decode($result1);
				$flag = 0;
					
				if(is_object($resultObject1))
				{
					if(isset($resultObject1->username) && $resultObject1->username)
					{		
						$username = $resultObject1->username;
						$_SESSION["photolok_username"] = $username;
						$user = get_user_by('email',$username);
						if(is_object($user) && $user->ID)
						{
							wp_set_current_user($user->ID);
							wp_set_auth_cookie($user->ID);
							$user  = get_user_by( 'ID',$user->ID );
							do_action( 'wp_login', $user->user_login, $user );
							wp_redirect( home_url() );
							exit;
						}
						else
						{
							$_SESSION["show_message"] = 'yes';
							$html = "The following unmatched email address is trying to login.  Contact Photolok.";
							$html .= "<br>"; 
							$html .= $username; 
							$subject = "Unmatched Email";
							$to = 'PhotolokSupport@netlok.com';
							$body = $html;
							$headers = 'Content-Type: text/html; charset=UTF-8';
							wp_mail( $to, $subject, $body, $headers );
							wp_redirect( home_url() );
							exit;
						}
					}
				}			
			}
		}
			//close connection
	}
}

function start_session()
{
	if ( !session_id() ) {
    	session_start( [
        	'read_and_close' => true,
    	] );
	}
}
	
add_action("init", "start_session", 1);
add_action( 'init', 'photolok_oauth_redirect_validate' );
add_action('init','display_message');

function display_message()
{
	if(isset($_SESSION["show_message"]) && $_SESSION["show_message"] == 'yes'){
		add_filter( 'the_content', 'display_alert_message' );
	}
}

function display_alert_message( $content ) 
{
	if($_SESSION["show_message"] == 'yes')
	{
		$content .= "<script type='text/javascript'>alert('User account not found for ".$_SESSION["photolok_username"]."');</script>";

		unset($_SESSION['show_message']);
		unset($_SESSION["photolok_username"]);

	}
	return $content;
}
	
include(ABSPATH . "wp-content/plugins/photolok/widgets.php");
include(ABSPATH . "wp-content/plugins/photolok/custommenu.php");

?>