<?php
/*
Template Name: sample
*/
?>
<?php get_header(); ?>

<div class="column-wrappar-right clearfix">
<div class="cwr-right">

<div class="sideMenu">
<?php get_sidebar(); ?>
</div>
</div>

<div class="cwr-main">
<div class="co">



<section class="article">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
$categories = get_the_category();
$separator = ' ';
$output = '';
if ( $categories ) {
	foreach( $categories as $category ) {
		$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' 
			. esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) 
			. '">' . $category->cat_name . '</a>' . $separator;
	}
}
?>

<?php
$mi3 = SCF::get( 'main_img' );
$image = wp_get_attachment_image_src( $mi3, "large" );
if($mi3 != ""){
	$miUrl3 = $image[0];
}else{
	$miUrl3 = "/images/pict_noimage.png";
}
?>

	<figure><i class="bg" data-bg="<?php echo $miUrl3; ?>"></i></figure>
	<div class="title">
		<h1><?php the_title(); ?></h1>
		<p class="date"><?php the_time('Y年m月d日'); ?> / カテゴリー : <?php echo trim( $output, $separator ); ?></p>
		<?php the_tags( '<ul class="clearfix"><li>', '</li><li>', '</li></ul>' ); ?>
	</div>

	
	<div class="entry">
	<?php the_content(); ?>
	</div>
	
	<div class="prevNext clearfix">
		<ul class="clearfix">
		<li><?php  
		$prev_poxt = get_previous_post();  
		if (!empty( $prev_poxt  )):  
		echo '<a href="',get_permalink( $prev_poxt->ID ),'" class="prev">PREV</a>';
		else:
		endif;  
		?></li>

		<li><a href="<?php bloginfo('url'); ?>/news/" class="index"><img src="<?php bloginfo('url'); ?>/images/ico_index.svg" alt=""/><br>INDEX</a></li>
		<li><?php  
		$next_post = get_next_post();  
		if (!empty( $next_post )):  
		echo '<a href="',get_permalink( $next_post->ID ),'" class="next">NEXT</a>'; 
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
<?php wp_reset_query(); ?>	
</section>

<section class="recommend">
<h1>Reccomend</h1>
<div class="container clearfix">
<?php
$arr = get_the_tags($post->ID);
$tag_id = "";

if( $arr != ""){
	foreach ( $arr as $tag ) {
	$tag_id .= $tag -> term_id;
	$tag_id .= ",";
	}
}
$args = array(
	'tag_id' => $tag_id,
	'posts_per_page' => 8,
	'orderby' => 'rand',
	);
query_posts($args);
?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
$categories = get_the_category();
$separator = ' ';
$output = '';
if ( $categories ) {
	foreach( $categories as $category ) {
		$output .= '<span>'.$category->cat_name.'</span>';
	}
}
?>

<?php
$mi3 = SCF::get( 'main_img' );
$image = wp_get_attachment_image_src( $mi3, "large" );
if($mi3 != ""){
	$miUrl3 = $image[0];
}else{
	$miUrl3 = "/images/pict_noimage.png";
}
?>

<div class="box">
<a href="<?php the_permalink(); ?>">
<p class="cate"><?php echo trim( $output, $separator ); ?></p>
<figure><i class="bg" data-bg="<?php echo $miUrl3; ?>"></i></figure>
<div class="txt">
<h2><?php the_title(); ?></h2>
<p class="date"><img src="<?php bloginfo('url'); ?>/images/ico_click.svg" alt=""/><?php the_time('Y年m月d日'); ?></p>
</div>

</a>
</div>

<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
</div>
</section>


</div>
</div>
<?php get_footer(); ?>
