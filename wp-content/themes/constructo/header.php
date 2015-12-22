<?php global $anps_options_data; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<script src="//use.typekit.net/kac4vdw.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
    <script async src="https://i.simpli.fi/dpx.js?cid=43313&action=100&segment=hillcrest&m=1&sifi_tuid=21387"></script>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php anps_is_responsive(false); ?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php anps_theme_styles(); ?>
	<?php anps_theme_after_styles(); ?>
	<?php wp_head(); ?>
	<!-- Start of Leadin Embed -->
	<script type="text/javascript" src="//js.leadin.com/js/v1/1625837.js" id="LeadinEmbed-1625837" crossorigin="use-credentials" async defer></script>
	<!-- End of Leadin Embed -->
</head>
<body <?php body_class(anps_is_responsive(true) . anps_boxed());?><?php anps_body_style();?>>
    <?php 
    $coming_soon = get_option('coming_soon', '0');
    if($coming_soon=="0"||is_super_admin()) : ?> 
	<div class="site-wrapper">
    <?php endif; ?>
		<?php anps_get_header(); ?>