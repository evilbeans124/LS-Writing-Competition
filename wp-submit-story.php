<?php
/**
 * WordPress User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package WordPress
 */

/** Make sure that the WordPress bootstrap has run before continuing. */
require( dirname(__FILE__) . '/wp-load.php' );
add_action( 'wp_head', 'wp_no_robots' );

require( dirname( __FILE__ ) . '/wp-blog-header.php' );

// Redirect to https login if forced to use SSL
if ( force_ssl_admin() && ! is_ssl() ) {
	if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
		wp_redirect( set_url_scheme( $_SERVER['REQUEST_URI'], 'https' ) );
		exit();
	} else {
		wp_redirect( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		exit();
	}
}
define("DBMS","mysql");
define("HOST","localhost");
$dns = DBMS.':host='.HOST.';dbname='.DB_NAME;
try {
    $pdo = new PDO($dns, DB_USER, DB_PASSWORD); //初始化一个PDO对象
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}
$pdo->exec("set names utf8");

function get_logged_in_user_id(){
 
	//没登陆，返回false;
	if(!is_user_logged_in()) return false;
	//登录了，返回当前用户ID。
	return get_current_user_id();
}
// echo '<a title="Login" href="'.wp_login_url(get_permalink()).'">'.wp_login_url(get_permalink());
if(!get_logged_in_user_id()){
	Header("Location:".site_url()."/wp-login.php");//?redirect_to=".site_url()."//wp-submit-story.php"
	//?redirect_to=http%3A%2F%2Ftest.yahao.me%2Flittlestar%2Findex.php%2F2017%2F04%2F05%2Fwelcome-to-this-site%2F
	exit;
}
// echo "current userid=".get_logged_in_user_id()."<BR>";
// echo "site url=".site_url()."<BR>";
/**
 * Output the login page header.
 *
 * @param string   $title    Optional. WordPress login Page title to display in the `<title>` element.
 *                           Default 'Log In'.
 * @param string   $message  Optional. Message to display in header. Default empty.
 * @param WP_Error $wp_error Optional. The error to pass. Default empty.
 */
function login_header( $title = 'Log In', $message = '', $wp_error = '' ) {
	global $error, $interim_login, $action;

	// Don't index any of these forms
	add_action( 'login_head', 'wp_no_robots' );

	add_action( 'login_head', 'wp_login_viewport_meta' );

	if ( empty($wp_error) )
		$wp_error = new WP_Error();

	// Shake it!
	$shake_error_codes = array( 'empty_password', 'empty_email', 'invalid_email', 'invalidcombo', 'empty_username', 'invalid_username', 'incorrect_password' );
	/**
	 * Filters the error codes array for shaking the login form.
	 *
	 * @since 3.0.0
	 *
	 * @param array $shake_error_codes Error codes that shake the login form.
	 */
	$shake_error_codes = apply_filters( 'shake_error_codes', $shake_error_codes );

	if ( $shake_error_codes && $wp_error->get_error_code() && in_array( $wp_error->get_error_code(), $shake_error_codes ) )
		add_action( 'login_head', 'wp_shake_js', 12 );

	$separator = is_rtl() ? ' &rsaquo; ' : ' &lsaquo; ';

	?><!DOCTYPE html>
	<!--[if IE 8]>
		<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" <?php language_attributes(); ?>>
	<![endif]-->
	<!--[if !(IE 8) ]><!-->
		<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php echo get_bloginfo( 'name', 'display' ) . $separator . $title; ?></title>
	<?php

	wp_enqueue_style( 'login' );
	
	/*
	 * Remove all stored post data on logging out.
	 * This could be added by add_action('login_head'...) like wp_shake_js(),
	 * but maybe better if it's not removable by plugins
	 */
	if ( 'loggedout' == $wp_error->get_error_code() ) {
		?>
		<script>if("sessionStorage" in window){try{for(var key in sessionStorage){if(key.indexOf("wp-autosave-")!=-1){sessionStorage.removeItem(key)}}}catch(e){}};</script>
		<?php
	}

	/**
	 * Enqueue scripts and styles for the login page.
	 *
	 * @since 3.1.0
	 */
	do_action( 'login_enqueue_scripts' );

	/**
	 * Fires in the login page header after scripts are enqueued.
	 *
	 * @since 2.1.0
	 */
	do_action( 'login_head' );

	if ( is_multisite() ) {
		$login_header_url   = network_home_url();
		$login_header_title = get_network()->site_name;
	} else {
		$login_header_url   = __( 'http://drzhidao.com/littlestar' );
		$login_header_title = __( 'LittleStar CISB Short Story Competition' );
	}

	/**
	 * Filters link URL of the header logo above login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $login_header_url Login header logo URL.
	 */
	$login_header_url = apply_filters( 'login_headerurl', $login_header_url );

	/**
	 * Filters the title attribute of the header logo above login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $login_header_title Login header logo title attribute.
	 */
	$login_header_title = apply_filters( 'login_headertitle', $login_header_title );

	$classes = array( 'login-action-' . $action, 'wp-core-ui' );
	if ( is_rtl() )
		$classes[] = 'rtl';
	if ( $interim_login ) {
		$classes[] = 'interim-login';
		?>
		<style type="text/css">html{background-color: transparent;}</style>
		<?php

		if ( 'success' ===  $interim_login )
			$classes[] = 'interim-login-success';
	}
	$classes[] =' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_locale() ) ) );

	/**
	 * Filters the login page body classes.
	 *
	 * @since 3.5.0
	 *
	 * @param array  $classes An array of body classes.
	 * @param string $action  The action that brought the visitor to the login page.
	 */
	$classes = apply_filters( 'login_body_class', $classes, $action );

	?>
	</head>
	<!--<body class="login <?php echo esc_attr( implode( ' ', $classes ) ); ?>">-->
	
	<?php
	get_header(); 
	/**
	 * Fires in the login page header after the body tag is opened.
	 *
	 * @since 4.6.0
	 */
	do_action( 'login_header' );
	?>
	
	<div id="submit_little_star_story" style="width: 90%;padding: 0 0 0;margin: auto;">
		<h1><a href="<?php echo esc_url( $login_header_url ); ?>" title="<?php echo esc_attr( $login_header_title ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	<?php

	unset( $login_header_url, $login_header_title );

	/**
	 * Filters the message to display above the login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $message Login message text.
	 */
	$message = apply_filters( 'login_message', $message );
	if ( !empty( $message ) )
		echo $message . "\n";

	// In case a plugin uses $error rather than the $wp_errors object
	if ( !empty( $error ) ) {
		$wp_error->add('error', $error);
		unset($error);
	}

	if ( $wp_error->get_error_code() ) {
		$errors = '';
		$messages = '';
		foreach ( $wp_error->get_error_codes() as $code ) {
			$severity = $wp_error->get_error_data( $code );
			foreach ( $wp_error->get_error_messages( $code ) as $error_message ) {
				if ( 'message' == $severity )
					$messages .= '	' . $error_message . "<br />\n";
				else
					$errors .= '	' . $error_message . "<br />\n";
			}
		}
		if ( ! empty( $errors ) ) {
			/**
			 * Filters the error messages displayed above the login form.
			 *
			 * @since 2.1.0
			 *
			 * @param string $errors Login error message.
			 */
			echo '<div id="login_error">' . apply_filters( 'login_errors', $errors ) . "</div>\n";
		}
		if ( ! empty( $messages ) ) {
			/**
			 * Filters instructional messages displayed above the login form.
			 *
			 * @since 2.5.0
			 *
			 * @param string $messages Login messages.
			 */
			echo '<p class="message">' . apply_filters( 'login_messages', $messages ) . "</p>\n";
		}
	}
} // End of login_header()

/**
 * Outputs the footer for the login page.
 *
 * @param string $input_id Which input to auto-focus
 */
function login_footer($input_id = '') {
	global $interim_login;

	// Don't allow interim logins to navigate away from the page.
	if ( ! $interim_login ): ?>
	<p id="backtoblog"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
		/* translators: %s: site title */
		printf( _x( '&larr; Back to %s', 'site' ), get_bloginfo( 'title', 'display' ) );
	?></a></p>
	<?php endif; ?>

	</div>

	<?php if ( !empty($input_id) ) : ?>
	<script type="text/javascript">
	try{document.getElementById('<?php echo $input_id; ?>').focus();}catch(e){}
	if(typeof wpOnload=='function')wpOnload();
	</script>
	<?php endif; ?>

	<?php
	/**
	 * Fires in the login page footer.
	 *
	 * @since 3.1.0
	 */
	do_action( 'login_footer' ); ?>
	<div class="clear"></div>
	</body>
	</html>
	<?php
}

/**
 * @since 3.0.0
 */
function wp_shake_js() {
?>
<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
function s(id,pos){g(id).left=pos+'px';}
function g(id){return document.getElementById(id).style;}
function shake(id,a,d){c=a.shift();s(id,c);if(a.length>0){setTimeout(function(){shake(id,a,d);},d);}else{try{g(id).position='static';wp_attempt_focus();}catch(e){}}}
addLoadEvent(function(){ var p=new Array(15,30,15,0,-15,-30,-15,0);p=p.concat(p.concat(p));var i=document.forms[0].id;g(i).position='relative';shake(i,p,20);});
</script>
<?php
}

/**
 * @since 3.7.0
 */
function wp_login_viewport_meta() {
	?>
	<meta name="viewport" content="width=device-width" />
	<?php
}



//
// Main
//

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'register';
// $errors = new WP_Error();

// if ( isset($_GET['key']) )
	// $action = 'resetpass';

// validate action so as to default to the login screen
if ( !in_array( $action, array( 'postpass', 'logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'register', 'login' ), true ) && false === has_filter( 'login_form_' . $action ) )
	$action = 'register';

nocache_headers();

header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));

if ( defined( 'RELOCATE' ) && RELOCATE ) { // Move flag is set
	if ( isset( $_SERVER['PATH_INFO'] ) && ($_SERVER['PATH_INFO'] != $_SERVER['PHP_SELF']) )
		$_SERVER['PHP_SELF'] = str_replace( $_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF'] );

	$url = dirname( set_url_scheme( 'http://' .  $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ) );
	if ( $url != get_option( 'siteurl' ) )
		update_option( 'siteurl', $url );
}

//Set a cookie now to see if they are supported by the browser.
$secure = ( 'https' === parse_url( wp_login_url(), PHP_URL_SCHEME ) );
setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure );
if ( SITECOOKIEPATH != COOKIEPATH )
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure );

/**
 * Fires when the login form is initialized.
 *
 * @since 3.2.0
 */
do_action( 'login_init' );
/**
 * Fires before a specified login form action.
 *
 * The dynamic portion of the hook name, `$action`, refers to the action
 * that brought the visitor to the login form. Actions include 'postpass',
 * 'logout', 'lostpassword', etc.
 *
 * @since 2.8.0
 */
do_action( "login_form_{$action}" );

$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
$interim_login = isset($_REQUEST['interim-login']);

switch ($action) {

default:
//start case of register
case 'register' :

	// print_r($_POST);
	if ( is_multisite() ) {
		/**
		 * Filters the Multisite sign up URL.
		 *
		 * @since 3.0.0
		 *
		 * @param string $sign_up_url The sign up URL.
		 */
		wp_redirect( apply_filters( 'wp_signup_location', network_site_url( 'wp-signup.php' ) ) );
		exit;
	}

	if ( !get_option('users_can_register') ) {
		wp_redirect( site_url('wp-login.php?registration=disabled') );
		exit();
	}

	$registration_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	/**
	 * Filters the registration redirect URL.
	 *
	 * @since 3.0.0
	 *
	 * @param string $registration_redirect The redirect destination URL.
	 */
	$redirect_to = apply_filters( 'registration_redirect', $registration_redirect );
	login_header(__('Registration Form'), '<p class="message register">' . __('<strong>Submit your story</strong>') . '</p>', $errors);
	echo "<div id='result' style='margin-top:20px;'><p>";
	$user_login = '';
	$user_email = '';
	
	if ( $http_post ) {
		$user_name = isset( $_POST['user_name'] ) ? $_POST['user_name'] : '';
		$user_email = isset( $_POST['user_email'] ) ? $_POST['user_email'] : '';
		$user_age = isset( $_POST['user_age'] ) ? intval($_POST['user_age']) : '';
		$user_id = isset( $_POST['user_id'] ) ? intval($_POST['user_id']) : '';
		$phone_number = isset( $_POST['phone_number'] ) ? $_POST['phone_number'] : '';
		$wechat_no = isset( $_POST['wechat_no'] ) ? $_POST['wechat_no'] : '';
		$school_name = isset( $_POST['school_name'] ) ? $_POST['school_name'] : '';
		// $file = isset( $_FILES['file'] ) ? $_FILES['file'] : '';
		// echo "<PRE>";
		// print_r($_FILES);
		// echo "</PRE>";
		$sql="SELECT * FROM ".$table_prefix."students WHERE user_name='$user_name' AND user_email='$user_email'";
		// echo $sql;
		$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		if(!$result){
			if ((($_FILES["your_story"]["type"] == "image/gif")
					|| ($_FILES["your_story"]["type"] == "image/jpeg")
					|| ($_FILES["your_story"]["type"] == "image/png")
					|| ($_FILES["your_story"]["type"] == "image/pjpeg")
					//|| ($_FILES["your_story"]["type"] == "application/octet-stream")//rar
					//|| ($_FILES["your_story"]["type"] == "application/x-zip-compressed")// application/x-zip-compressed      zip
				)
				&& ($_FILES["your_story"]["size"] < 2000000))
			{
			  if ($_FILES["your_story"]["error"] > 0)
			  {
				// echo "Return Code: " . $_FILES["your_story"]["error"] . "<br />";
			  }
			  else
			  {
				// echo "Upload: " . $_FILES["your_story"]["name"] . "<br />";
				// echo "Type: " . $_FILES["your_story"]["type"] . "<br />";
				// echo "Size: " . ($_FILES["your_story"]["size"] / 1024) . " Kb<br />";
				// echo "Temp file: " . $_FILES["your_story"]["tmp_name"] . "<br />";

				if (file_exists("wp-content/uploads/students/" . date('Ymd')."-".$_FILES["your_story"]["name"]))
				{
				  // echo $_FILES["your_story"]["name"] . " already exists. ";
				}
				else
				{
				  move_uploaded_file($_FILES["your_story"]["tmp_name"],"wp-content/uploads/students/" . date('Ymd')."-".$_FILES["your_story"]["name"]);
				  $your_story="wp-content/uploads/students/" . date('Ymd')."-".$_FILES["your_story"]["name"];
				  // echo "Stored in: " . "wp-content/uploads/students/" . $_FILES["your_story"]["name"];
				}
			  }
			}
			else
			{
			  // echo "Invalid file";
			  $your_story='';
			}
			$sql_insert="INSERT INTO ".$table_prefix."students
						 (`id`,`user_name`,`user_age`,`user_email`,`phone_number`,`wechat_no`,`school_name`,`your_story`,`user_id`,`addtime`)
						 VALUES(NULL,'$user_name','$user_age','$user_email','$phone_number','$wechat_no','$school_name','$your_story','$user_id',now())";
			$re=$pdo->query($sql_insert);
			if($re){
				echo "<h2>You have successfully submitted your information</h2>";
				?>
				<P><BR/><BR/></P>
				<p>
				<label for="user_name"><h3>Your Information is as below:</h3></label>
				</p>
				<p>
				<label for="user_name">Username:<br />
					<input type="text" name="user_name" id="user_name" class="input" value="<?php echo $user_name; ?>" size="20" disabled/></label>
				</p>
				<p>
				<label for="user_email">Email:<br />
					<input type="text" name="user_email" id="user_email" class="input" value="<?php echo $user_email; ?>" size="20" disabled/></label>
				</p>
				<p>
				<label for="user_age">Age:<br />
					<input type="text" name="user_age" id="user_age" class="input" value="<?php echo $user_age; ?>" size="20" disabled/></label>
				</p>
				<p>
				<label for="phone_number">Your Phone Number:<br />
					<input type="text" name="phone_number" id="phone_number" class="input" value="<?php echo $phone_number; ?>" size="20" disabled/></label>
				</p>
				<p>
				<label for="wechat_no">Your WeChat No:<br />
					<input type="text" name="wechat_no" id="user_name" class="input" value="<?php echo $wechat_no; ?>" size="20" disabled/></label>
				</p>
				<p>
				<label for="school_name">Your School Name:<br />
					<input type="text" name="school_name" id="school_name" class="input" value="<?php echo $school_name; ?>" size="20" disabled/></label>
				</p>
				<p>
				<label for="your_story">Your Story Document:<br />
				<?PHP
					if($your_story){
						echo "<img src='".$your_story."'>";
					}
					else{
						echo '<input type="text" name="your_story" id="your_story" class="input" value="" size="20" disabled/>';
					}
				?>
					</label>
				</p>
				<input type="hidden" name="user_id" value="<?PHP echo get_logged_in_user_id();?>">
				
		<?PHP
				
			}
			else{
				echo "<h2>You have failed to submit your information</h2>";
			}
		}
		else{
			echo "<h2>You have already submitted your information before!</h2>";
		}
		
		echo "<p></div>";
		// $errors = register_new_student($user_name, $user_email);
		// if ( !is_wp_error($errors) ) {
			// $redirect_to = !empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
			// wp_safe_redirect( $redirect_to );
			// exit();
		// }
	}
if(!$user_name){
	

	
?>
<form name="registerform" id="registerform" onsubmit="return checkForm();" action="<?php echo esc_url( site_url( 'wp-submit-story.php?action=register', 'login_post' ) ); ?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
	<p>
		<label for="user_name"><?php _e('Your Name') ?>*(required)<br />
		<input type="text" name="user_name" id="user_name" class="input" value="<?php echo esc_attr(wp_unslash($user_login)); ?>" size="35" /></label>
	</p>
	<p>
		<label for="user_email"><?php _e('Your Email') ?>*(required)<br />
		<input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( wp_unslash( $user_email ) ); ?>" size="35" /></label>
	</p>
	<p>
		<label for="user_age"><?php _e('Your Age') ?>*(required)<br />
		<input type="text" name="user_age" id="user_age" class="input" value="<?php echo esc_attr( wp_unslash( $age ) ); ?>" size="35" /></label>
	</p>
	<p>
		<label for="phone_number"><?php _e('Your Phone Number') ?>*(required)<br />
		<input type="text" name="phone_number" id="phone_number" class="input" value="<?php echo esc_attr( wp_unslash( $phone_number ) ); ?>" size="35" /></label>
	</p>
	<p>
		<label for="wechat_no"><?php _e('Your WeChat No') ?>*(required)<br />
		<input type="text" name="wechat_no" id="wechat_no" class="input" value="<?php echo esc_attr( wp_unslash( $wechat_no ) ); ?>" size="35" /></label>
	</p>
	<p>
		<label for="school_name"><?php _e('Your School Name') ?>*(required)<br />
		<input type="text" name="school_name" id="school_name" class="input" value="<?php echo esc_attr( wp_unslash( $school_name ) ); ?>" size="35" /></label>
	</p>
	<p>
		<label for="your_story"><?php _e('Your Story Document') ?><br />
		<input type="file" class="wpcf7-form-control wpcf7-file" name="your_story" id="your_story" class="input" value="<?php echo esc_attr( wp_unslash( $file ) ); ?>" size="25" /></label>
	</p>
	<input type="hidden" name="user_id" value="<?PHP echo get_logged_in_user_id();?>">
	<?php
	/**
	 * Fires following the 'Email' field in the user registration form.
	 *
	 * @since 2.1.0
	 */
	do_action( 'register_form' );
	?>
	<p id="reg_passmail"><?php //_e( 'Registration confirmation will be emailed to you.' ); ?></p>
	<br class="clear" />
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Register'); ?>" /></p>
</form>

<SCRIPT>
function checkForm(){
	var age=document.getElementById("user_age").value;
	var phone_number=document.getElementById("phone_number").value;
	var wechat_no=document.getElementById("wechat_no").value;
	var school_name=document.getElementById("school_name").value;
	var name=document.getElementById("user_name").value;
	if(school_name==""){
        alert("School name cannot be null");
        return false;
    }
	if(wechat_no==""){
        alert("Wechat no cannot be null");
        return false;
    }
	if(isNaN(user_age)){
        alert("Age cannot be null and must be a number");
        return false;
    }
	if(phone_number==""){
        alert("Phone Number cannot be null");
        return false;
    }
	if(name==""){
        alert("Username cannot be null");
        return false;
    }
    if(name.length<4||name.length>20 ){
        alert("Length of username should be between 4 - 20");
        return false;
    }
	/*
    for(var i=0;i<name.length;i++)
    {
         var charTest=name.toLowerCase().charAt(i);
         if( (!(charTest>='0' && charTest<='9')) &&  (!(charTest>='a' && charTest<='z'))  && (charTest!='_') )
         {
          alert("Username can only contains letters,numbers and _");
          return false;
          }
    }*/
	var strEmail=document.getElementById("user_email").value;
	var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
	var flag = reg.test(strEmail);
	//  mobile
	var sMobile = document.getElementById("phone_number").value;
	
    if(sMobile.length>0 && !(/^1[3|4|5|8][0-9]\d{4,8}$/.test(sMobile))){ 
        alert("Not a valid mobile phone number!"); 
        return false; 
    } 
	
	  
    if(flag){
        return true;
    }else{
		alert("email is not legal!");
        return false;
    }
}


//用户名非空+长度+合法性验证
function checkUserName(){
    var name = document.getElementById("user_name").value;
    if(name.value==""){
        alert("Username cannot be null");
        name.focus();
        return false;
    }
    if(name.value.length<4||name.value.length>20 ){
        alert("Length of username should be between 4 - 20");
        name.select();
        return false;
    }
    for(var i=0;i<name.value.length;i++)
      {
         var charTest=name.value.toLowerCase().charAt(i);
         if( (!(charTest>='0' && charTest<='9')) &&  (!(charTest>='a' && charTest<='z'))  && (charTest!='_') )
         {
          alert("Username can only contains letters,numbers and _");
          name.select();
          return false;
          }
      }
      return true;
}

//电子邮件验证
function checkEmail(){
    var strEmail=document.getElementById("user_email").value;
    var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
	var flag = reg.test(strEmail);
	return flag;
}

</SCRIPT>

<!--
<p id="nav">
 <a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a> |
<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?' ); ?></a> -->
</p>

<?php
login_footer('user_login');
}
break;
//end of case register
}// end action switch
function register_new_student($user_name, $user_email){
	global $pdo,$table_prefix;
	$sql="SELECT * FROM ".$table_prefix."students WHERE username='$username' AND user_email='$user_email'";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	print_r($result);
	if(!$result){
		
	}
	else{
		
	}
}