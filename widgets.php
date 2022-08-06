<?php



function photolok_load_widget() {

    register_widget( 'photolok_widget' );

}

add_action( 'widgets_init', 'photolok_load_widget' );



class photolok_widget extends WP_Widget 

{  

	function __construct() 

	{

		parent::__construct(

			'photolok_widget', 

			__('Photolok® Widget', 'photolok_widget_domain'), 

			array( 'description' => __( 'Photolok Plugin Widget', 'photolok_widget_domain' ), ) 

		);

	}

    

	public function widget( $args, $instance ) 

	{

		$loginText = "Photolok® Login";



		if(get_option('photolok_login_text'))

		{

			$loginText = get_option('photolok_login_text');

		}



		$title = apply_filters( 'widget_title', $instance['title'] );



		if($title)

			$loginText = $title;			



		if(!is_user_logged_in())

		{

			$photolokClientId = get_option('photolok_client_id');

			$photolokClientSecret = get_option('photolok_client_secret');

			$photolokRedirectEndpoint = get_option('photolok_redirect_endpoint');

			$photolokAccessTokenEndpoint = get_option('photolok_access_token_endpoint');

			$photolokAuthUrl = $photolokAccessTokenEndpoint . "?response_type=code&client_id=".$photolokClientId."&redirect_uri=".$photolokRedirectEndpoint;



			echo "<div class='photolok_login'><a href='".$photolokAuthUrl."'><img src='".plugins_url( 'assets/login-screen-img.svg', __FILE__ )."' />".$loginText."</a></div>";	

		}

	}

          

	public function form( $instance ) 

	{

		if ( isset( $instance[ 'title' ] ) ) {

			$title = $instance[ 'title' ];

		}

		else {

			$title = 'Photolok® Login';



			if(get_option('photolok_login_text'))

				$title = get_option('photolok_login_text');



			$title = __( $title, 'photolok_widget_domain' );

		}

?>

		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 



			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

		</p>

<?php 

	}

      

	public function update( $new_instance, $old_instance ) 

	{

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;

	}

} 

?>