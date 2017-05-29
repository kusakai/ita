<?php query_posts($query_string .'&posts_per_page=10&paged='.$paged);?>

<?php get_header(); ?>
<section class="article-list clearfix">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
	$category = get_the_category( $post->ID );
	$cat_id   = $category[0]->cat_ID;
	$cat_name = $category[0]->cat_name;
	$cat_slug = $category[0]->category_nicename;
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
<div class="box clearfix">
<a class="news-index clearfix" href="<?php the_permalink(); ?>">
<figure class="news-index-pict"><i class="bg" data-bg="<?php echo $miUrl3; ?>"></i></figure>
<div class="txt-area">
<p class="category"><span>カテゴリー ></span> <?php echo $cat_name; ?></p>
<h2> <?php the_title(); ?></h2>
<p class="post-date"><?php the_time("Y-n-j"); ?></p>
</div>
</a>
<?php the_tags( '<ul class="tag clearfix"><li>', '</li><li>', '</li></ul>' ); ?>

</div>		
<?php endwhile; ?>
<?php else : ?>
<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p>
<?php get_search_form(); ?>
<?php endif; ?>
</section>
<?php wp_reset_query();get_footer(); ?>
