<?php
	ini_set("display_errors", 1);
	require_once("../../../wp-load.php");

	if(is_array($_POST) && count($_POST))
	{
		$html = "<table border='1' style='border-collapse: collapse;'>";
		
		$requester_email = "";

		if(isset($_POST['requester_email']) && $_POST['requester_email'] != "")
			$requester_email = $_POST['requester_email'].' <'.$_POST['requester_email'].'>';
		
		foreach ($_POST as $key => $value) 
		{
			if($key != 'submit')
				$html .= "<tr><td>".ucwords(str_replace('_', ' ', $key))."</td><td>".$value."</td></tr>";
		}
		$html .= "<table>";

		$subject = "Photolok Request";
		$to = 'PhotolokSupport@netlok.com';
		
		if(isset($_POST['request_type']) && $_POST['request_type'] != "")
		{
			$subject = $_POST['request_type'];
		}
		$body = $html;
		$headers[] = 'Content-Type: text/html; charset=UTF-8';

		if($requester_email)
			$headers[] = 'Reply-To: '.$requester_email;

		if(wp_mail( $to, $subject, $body, $headers ))
		{
			//$redirect = add_query_arg( 'my-form', 'success', $redirect );
			$request = $_SERVER["HTTP_REFERER"] . "&success=true";
			wp_redirect( $request );
			exit;
		}
		else
		{
			$request = $_SERVER["HTTP_REFERER"] . "&error=true";
			wp_redirect( $request );
			exit;	
		}
	}
?>