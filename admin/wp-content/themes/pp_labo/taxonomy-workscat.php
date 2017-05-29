<?php get_header(); ?>

<h1>Taxonoy-Works</h1>

<?php echo $query_string ?>
<?php query_posts($query_string.'&posts_per_page=-1');?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
	$category = get_the_category( $post->ID );
	$cat_id   = $category[0]->cat_ID;
	$cat_name = $category[0]->cat_name;
	$cat_slug = $category[0]->category_nicename;
?>
<div>

<?php
$place = SCF::get( 'place' );
$comment = SCF::get( 'comment' );
$data = SCF::get( 'data' );
$main_photo = SCF::get( 'main_photo' );
?>

<h3><?php the_title(); ?></h3>
<p><?php echo $place; ?></p>
<p><?php echo $comment; ?></p>
<p><?php echo $data; ?></p>

<?php echo getImgData2($main_photo,'300','','full'); ?>
</div>


<?php endwhile; ?>

<?php else : ?>

<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>

<?php endif; ?>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

<?php get_footer(); ?>


<?php get_footer(); ?>