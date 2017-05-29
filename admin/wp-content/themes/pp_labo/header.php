<!DOCTYPE HTML>
<html>
<head>
<title>PRODUCE PRO LABO</title>
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/css/style.css" />

<?php if(is_single()) : ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
$mi3 = SCF::get( 'main_img' );
$image = wp_get_attachment_image_src( $mi3, "large" );
if($mi3 != ""){
	$fb_img = $image[0];
}else{
	$fb_img = "/images/pict_noimage.png";
}
$fb_title = get_the_title();
$fb_url = get_permalink();
$fb_description = get_post_meta($post->ID, _aioseop_description, true);
?>
<?php endwhile; ?>
<?php endif; ?>
<?php else: ?>
<?php
$fb_img = get_home_url().'/images/fb.jpg';
$fb_title = 'ITA';
$fb_url = get_home_url();
$fb_description = '';
?>
<?php endif; ?>
<meta property="og:title" content="<?php echo $fb_title; ?>">
<meta property="og:url" content="<?php echo $fb_url; ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="ITA">
<meta property="og:image" content="<?php echo $fb_img; ?>">
<meta property="og:description" content="<?php echo $fb_description; ?>">
<link rel="shortcut icon" href="images/favicon.ico">
<!--[if lt IE 9]>
<script src="<?php bloginfo('url'); ?>/js/html5shiv.js"></script>
<![endif]-->
<?php if(is_home()) : ?>
<?php endif; ?>
<?php if(is_page()) : ?>
<?php endif; ?>
<?php wp_head(); ?>

</head>

<body>
<div class="menu-btn">
	<i></i>
</div>
<div class="column-wrappar-left clearfix">
<div class="cwl-left">
<header>
<div class="logo">
<figure>
<svg version="1.1" id="レイヤー_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
y="0px" viewBox="0 0 350 225" style="enable-background:new 0 0 350 225;" xml:space="preserve">
<g><g><g>
<path d="M272.4,170.4h-19v50.3h-62.8V86.4c0-26,7.1-46.2,21.3-60.5C226.1,11.5,246,4.3,271.6,4.3c24.7,0,43,6.5,54.9,19.6
c11.9,13,17.8,33.2,17.8,60.4v136.4h-62.8V88.5c0-8.2-1-14-2.9-17.2c-2-3.2-5.5-4.8-10.5-4.8c-9.8,0-14.7,7.3-14.7,22v26.3
L272.4,170.4z"/>
</g></g>
<g>
<path d="M48.2,77.2l0,142.9l-42.5,0l0-142.9L48.2,77.2z"/>
<path d="M139,118.3l0,101.9l-42.5,0l0-101.9l-32.6,0l0-41l107.5,0l0,41L139,118.3z"/>
</g>
</g>
</svg>
</figure>
<p>Innovative Things to Akita </p>
</div>

<nav>
<ul>
	<li><a href="<?php bloginfo('url'); ?>">HOME</a></li>
	<li><a href="<?php bloginfo('url'); ?>">DESIGN</a></li>
	<li><a href="<?php bloginfo('url'); ?>">CSS</a></li>
	<li><a href="<?php bloginfo('url'); ?>">HTML</a></li>
	<li><a href="<?php bloginfo('url'); ?>">Javascript</a></li>
	<li><a href="<?php bloginfo('url'); ?>">Other</a></li>
</ul>
</nav>

<div class="search-sns clearfix">
<?php get_search_form(); ?>
<ul class="side-sns">
	<li><img src="<?php bloginfo('url'); ?>/images/ico_facebook.svg" alt=""/></li>
	<li><img src="<?php bloginfo('url'); ?>/images/ico_twitter.svg" alt=""/></li>
	<li><img src="<?php bloginfo('url'); ?>/images/ico_insta.svg" alt=""/></li>
</ul>
</div>

</header>
</div>

<div class="cwl-main">
<div class="contents">