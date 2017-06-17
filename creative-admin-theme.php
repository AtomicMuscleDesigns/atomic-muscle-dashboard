<?php

/*
Plugin Name: Atomic Muscle Dashboard Theme
Plugin URI: www.atomicmuscle.design
Description: A New Wordpress Dashboard Layout
Author: Atomic Muscle Designs
Version: 0.1.0
Author URI: www.atomicmuscle.design
*/

//* Custom Wordpress Admin Theme *//

function sat_enqueue_custom_admin_theme() {
    wp_enqueue_style( 'sat-enqueue-custom-admin-theme', plugins_url( 'wp-admin.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'sat_enqueue_custom_admin_theme' );


//* Remove unwanted dashboard widgets *//

function atomicmuscle_remove_dashboard_widgets() {
	
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // quick draft
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WP news
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity
		
}
add_action( 'wp_dashboard_setup', 'atomicmuscle_remove_dashboard_widgets' );
remove_action( 'welcome_panel', 'wp_welcome_panel' );

//* Add theme info box into WordPress Dashboard *//

function b3m_add_dashboard_widgets() {
  wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'b3m_theme_info');
}
add_action('wp_dashboard_setup', 'b3m_add_dashboard_widgets' );
 
function b3m_theme_info() {
  echo "<ul>
  <li><strong>Developed By:</strong> Atomic Muscle Designs</li>
  <li><strong>Website:</strong> <a href='http://www.atomicmuscle.design'>www.atomicmuscle.design</a></li>
  <li><strong>Contact:</strong> <a href='mailto:support@atomicmuscle.design'>support@atomicmuscle.design</a></li>
  </ul>";
}


//* Add new dashboard widgets *//

// add metabox
function atomicmuscle_add_dashboard_widgets() {
	
	wp_add_dashboard_widget( 'atomicmuscle_welcome', 'Welcome to Your Website', 'atomicmuscle_welcome_widget_callback' );
	
}
add_action( 'wp_dashboard_setup', 'atomicmuscle_add_dashboard_widgets' );

// callback function
function atomicmuscle_welcome_widget_callback() {
	
	_e( '<p>Below is a list of resources to get your website going, let us know if you have any questions!.</p>', 'atomicmuscle' );
	_e ( '<p>For more information see our <a href="https://www.atomicmuscle.design">main website</a>.</p>', 'atomicmuscle' );
	
}


//* Add logo to the top of admin screens *//

function atomicmuscle_admin_logo() {
	
	echo '<a href="https://www.atomicmuscle.design" title=""><img src="' . plugins_url( 'images/Atomic-Muscle-Logo3.png', __FILE__ ) . '" /></a>';
	
}
add_action( 'admin_notices', 'atomicmuscle_admin_logo' );


//* Change lost password and username notification *//

function login_error_override()
{
    return 'Your user name or password is incorrect.';
}

add_filter('login_errors', 'login_error_override');


//* Change the URL of the WordPress login logo *//

function b3m_url_login_logo(){
    return get_bloginfo( 'wpurl' );
}
add_filter('login_headerurl', 'b3m_url_login_logo');


//* Change login logo hover text *//

function b3m_login_logo_url_title() {
  return 'Powered by Atomic Muscle Designs';
}
add_filter( 'login_headertitle', 'b3m_login_logo_url_title' );


//* Modify the admin footer text *//

function b3m_modify_footer_admin () {
  echo '<span id="footer-thankyou">Powered by <a href="http://www.atomicmuscle.design" target="_blank">Atomic Muscle Designs</a></span>';
}
add_filter('admin_footer_text', 'b3m_modify_footer_admin');


//* Removes The Wordpress Icon From The Admin Bar *//

function remove_wp_logo() {
global $wp_admin_bar;
$wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'remove_wp_logo' );


//* Adds Custom Links To The Admin Bar *//

function add_sumtips_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'client dashboard',
	'title' => __( ''),
	'href' => __(''),
	) );
}
add_action('admin_bar_menu', 'add_sumtips_admin_bar_link',100);
/* The add_action # is the menu position: 
10 = Before the WP Logo 
15 = Between the logo and My Sites 
25 = After the My Sites menu 
100 = End of menu 
*/  

//* Changes The Default Greeting *//

function replace_howdy( $wp_admin_bar ) {
$my_account=$wp_admin_bar->get_node('my-account');
$newtitle = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
$wp_admin_bar->add_node( array(
'id' => 'my-account',
'title' => $newtitle,
) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );