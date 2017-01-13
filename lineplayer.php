<?php
/*
Plugin Name: Line Player
Plugin URI: 
Description: 简单的音乐播放器
Version: 1.0.1
Author: hades
Author URI: http://blog.mayuko.cn
License: GPL
*/


// 引入css
function wpb_adding_styles() {
	echo "<link href='".plugins_url('css/lineplayer.css', __FILE__)."' rel='stylesheet'>";
}

add_action('wp_head', 'wpb_adding_styles');

// 引入js
function wpb_adding_lineplayer_js() {
	wp_register_script('lineplayer_js', plugins_url('js/lineplayer.js', __FILE__), array('jquery'),null, true);
	wp_enqueue_script('lineplayer_js');
}

add_action('wp_enqueue_scripts', 'wpb_adding_lineplayer_js');

function wpb_adding_play_js() {
	wp_register_script('play_js', plugins_url('js/play.js', __FILE__), array('jquery'),null, true);
	wp_enqueue_script('play_js');
}

add_action('wp_enqueue_scripts', 'wpb_adding_play_js');

//加载player
add_shortcode('lp','line_player');
function line_player($atts,$content='') {  
	extract(shortcode_atts(array('src'=>'0','autoplay'=>'0'), $atts));
	if($autoplay == 1){
		$isAuto = 'autoplay="autoplay"';
	}else{
		$isAuto = '';
	}
	$result = '
	<audio src="'.$src.'" preload="none" controls="controls" '.$isAuto.'></audio>
	';
	return $result;
}  

add_filter('init',line_player); 
?>