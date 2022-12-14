<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*

Plugin Name: BA Header Cart Items
Description: Verbindet Hybris-Userinformationen mit Wordpress und stellt Shortcodes zur Nutung bereit.
Version: 1.0.0
Author: KP Family
Author URI: https://www.babyartikel.de/magazin

*/

/* Plugin-Code UNTERhalb dieser Zeile */

function wp_ba_header_cart_items_json() {
	
	$babyartikelCookie = $_COOKIE['www-babyartikel-de'];
	$babyartikelCookie = 'ee14d2261f769398f77746ee7feac1a3'; // this line only used in localhost

	// Create a stream
	$opts = array(
		'http'=>array(
		'method'=>"GET",
		'header'=>"Accept-language: en\r\n" .
					"Cookie: www-babyartikel-de=".$babyartikelCookie
		)
	);
	
	$context = stream_context_create($opts);
	// Open the file using the HTTP headers set above
	//$json = json_decode(file_get_contents('https://www.babyartikel.de/wordpress-api', false, $context));
	$json = json_decode('{"product_compare_count":0,"cart_count":0,"wishlist_count":0}'); // this line only used in localhost
	return $json;
}

function wp_ba_header_cart_items_wishlist() {
	$json = wp_ba_header_cart_items_json();
	if (!$json->wishlist_count) $json->wishlist_count=0;
	return $json->wishlist_count;
}
add_shortcode('wp_ba_header_cart_items_wishlist', 'wp_ba_header_cart_items_wishlist' );

function wp_ba_header_cart_items_cartlist() {
	$json = wp_ba_header_cart_items_json();
	if (!$json->cart_count) $json->cart_count=0;
	return $json->cart_count;
}
add_shortcode('wp_ba_header_cart_items_cartlist', 'wp_ba_header_cart_items_cartlist' );

function wp_ba_header_cart_items_comparisonlist() {
	$json = wp_ba_header_cart_items_json();
	if (!$json->product_compare_count) $json->product_compare_count=0;
	return $json->product_compare_count;
}
add_shortcode('wp_ba_header_cart_items_comparisonlist', 'wp_ba_header_cart_items_comparisonlist' );
	
?>