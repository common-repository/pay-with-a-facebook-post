<?php
/*
Plugin Name: Pay With A Facebook Post
Plugin URI: http://www.paywithafacebookpost.com
Description: This plugin enables the system from www.paywithafacebookpost.com to work with Wordpress.
Pay With a Facebook Post provides an easy to use and free system to pay with a facebook post for digital goods, for example ebooks, songs or movie teasers.
All you need to have is an ID from www.paywithafacebookpost.com.
Version: 1.0
Author: Paul Goldberg
Author URI: http://www.paywithafacebookpost.com
License: GPL
Stable Tag: 1.0
*/

// unsere klasse
class plgPayWithAFacebookPost {
	var $id	= null;
	var $img = false;
	var $class = null;

	function __construct($content) {
		$this->content = $content;
	    $this->id = get_option('fbpay_id');  
    	$this->img = get_option('fbpay_img');  	
    	$this->class = get_option('fbpay_class');
    }

	// entry point for the content
	public function replaceContent() {
    	return $this->_doReplacement();
	}

	// shows a link in the admin menu
	public function admin_actions() {
		$menutitle = '<img src="' . get_bloginfo('url')  . '/wp-content/plugins/paywithafacebookpost/img/paywithfb.png" alt="" />' ;
		add_options_page($menutitle . " Pay With A Facebook Post", $menutitle . " Pay With A Facebook Post", 8, basename(__FILE__), array("plgPayWithAFacebookPost","admin"));
	}
	
	// includes our admin form
	public function admin() {
		include_once("paywithafacebookpost_admin.php");
	}

	protected function _doReplacement() {
		$regex = '<a.*class=([\'\"]?)'.$this->class.'\1\s*(id=([\'\"]?)([0-9a-zA-Z]*)\3)?.*>(.*)<\/a>';
		return preg_replace_callback("#$regex#i", array(&$this,'_hasID'), $this->content);
	}
	
	protected function _hasID($matches){
		$id = ($matches[4] != "")? $matches[4]:$this->id;
		$img = ($this->img)?"<img src=\"" . plugins_url('/img/paywithfbpost.png', __FILE__) . "\" border=0>":$matches[5];
		return "<a href=\"javascript:fb_newWindow('http://www.paywithafacebookpost.com/pay/$id','fbpay')\">$img</a>";
	}
}

function plugin_paywithafacebookpost($content) {
	$plg = new plgPayWithAFacebookPost($content);
	return $plg->replaceContent();
}

function plugin_paywithafacebookpost_scripts() {
	wp_enqueue_script('paywithafacebookpost',
		plugins_url('/scripts/paywithafacebookpost.js', __FILE__));
}

add_action('the_content', "plugin_paywithafacebookpost");  
add_action('admin_menu', array('plgPayWithAFacebookPost', 'admin_actions'));
add_action('wp_enqueue_scripts', 'plugin_paywithafacebookpost_scripts');

?>