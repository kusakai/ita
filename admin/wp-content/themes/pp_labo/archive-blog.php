<?php get_header(); ?>
<?php query_posts($query_string .'&posts_per_page=10&paged='.$paged);?>


<div class="ulcTitle">
<h2>BLOG</h2>
</div>


<p style="text-align:center; padding-top:85px;">
<?php if(is_month()) : ?>
アーカイブ：<?php echo single_month_title(); ?>
<?php elseif(is_category()): ?>
カテゴリー：<?php echo single_cat_title(); ?>
<?php elseif(is_tax()): ?>
カテゴリー：<?php echo single_term_title(); ?>
<?php endif; ?>
</p>

<div class="blogList clearfix">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
	$category = get_the_category( $post->ID );
	$cat_id   = $category[0]->cat_ID;
	$cat_name = $category[0]->cat_name;
	$cat_slug = $category[0]->category_nicename;
?>


<div class="box">
<a href="<?php the_permalink(); ?>">
<p class="img"><?php echo getImgData2(SCF::get( 'main_img' ),'300','','full'); ?></p>

<p class="date"><?php the_time('j'); ?><br><span><?php echo get_post_time('m'); ?><br><?php echo get_post_time('Y'); ?></span></p>
<h3><?php the_title(); ?></h3>
</a>
</div>

<?php endwhile; ?>

<?php else : ?>

<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>

<?php endif; ?>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

</div>


<?php get_footer(); ?>