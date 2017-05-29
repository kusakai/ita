
<?php get_header(); ?>
<div class="ulcTitle">
<h2>WORKS</h2>
</div>

<!-- 
<div class="caseCate clearfix">
<h4>カテゴリー:</h4>
<?php taxonomy('workscat'); ?>
</div>
-->

<div class="caseContents">


<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
$place = SCF::get( 'place' );
$text = SCF::get( 'text' );
$data = SCF::get( 'data' );
$main_photo = SCF::get( 'main_photo' );
?>

<div class="caseCo clearfix">
<div class="title">
<p class="place"><?php echo $place; ?></p>
<h3><?php the_title(); ?></h3>
</div>
<p class="mainImg"><?php echo getImgData2($main_photo,'','','full'); ?></p>

<div class="comment">
<p><?php echo nl2br($text); ?></p>
</div>



<div class="thumImg clearfix">
<ul id="lightGallery" class="photoGallery clearfix">
<?php
$repeat_group = SCF::get( 'photos' );
foreach ( $repeat_group as $fields ) {
	
	$image = wp_get_attachment_image_src( $fields['photos'], 'large' );
	echo '<li data-src="'.$image[0].'"><span class="imgfix">'.getImgData2($fields['thumbnail'],'300','','full').'</span> <br >';
	echo $fields['photo_caption'].'</li>';
	
	/*
	echo '<div class="box">';
	echo '<p class="img"><a href="'.$image[0].'">'.getImgData2($fields['photo'],'300','','full').'</a></p>';
	echo '<p class="txt">'.$fields['photo_caption'].'</p>';
	echo '</div>';
	*/
}
?>
</ul>
</div>

<div class="prevNext clearfix">
<ul>
<li><?php  
$prev_poxt = get_previous_post();  
if (!empty( $prev_poxt  )):  
echo '<a href="',get_permalink( $prev_poxt->ID ),'" class="next">前へ記事</a>';
else:
endif;  
?></li>

<li><a href="<?php bloginfo('url'); ?>/works/">事例紹介TOP</a></li>
<li><?php  
$next_post = get_next_post();  
if (!empty( $next_post )):  
echo '<a href="',get_permalink( $next_post->ID ),'" class="prev">次の記事</a>'; 
else:
endif;  
?> </li>
</ul>
</div>
<?php endwhile; ?>
<?php else : ?>
<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>
<?php endif; ?>




<div class="caseNew clearfix">
<div class="sub">
<h3>新着施工事例</h3>

<div class="list clearfix">
<?php query_posts('post_type=works&posts_per_page=4&paged='.$paged);?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="box">
<?php
$place = SCF::get( 'place' );
$comment = SCF::get( 'comment' );
$data = SCF::get( 'data' );
$main_photo = SCF::get( 'main_photo' );
?>
<a href="<?php the_permalink(); ?>">
<p class="mainImg"><?php echo getImgData2($main_photo,'','','full'); ?></p>
<p class="place"><?php echo $place; ?></p>
<h4><?php the_title(); ?></h4>
</a>
</div>

<?php endwhile; ?>
<?php else : ?>

<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>

<?php endif; ?>

</div>
</div>
</div>



</div>


<link type="text/css" rel="stylesheet" href="<?php bloginfo('url'); ?>/lightgallery/css/lightgallery.css" />
<script src="<?php bloginfo('url'); ?>/lightgallery/js/lightgallery.js"></script>
<script type="text/javascript">
jQuery(function($){
    $("#lightGallery").lightGallery();
	$("#lightGallery2").lightGallery();
	$("#lightGallery3").lightGallery();
	$("#lightGallery4").lightGallery();
});
</script>
<?php get_footer(); ?>
