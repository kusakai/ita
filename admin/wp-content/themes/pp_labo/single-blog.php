<?php
/*
Template Name: sample
*/
?>


<?php get_header(); ?>

<div class="ulcTitle">
<h2>BLOG</h2>
</div>


<div class="blogCo clearfix">
<div class="bL">
<div class="blogcontents">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
	$category = get_the_category( $post->ID );
	$cat_id   = $category[0]->cat_ID;
	$cat_name = $category[0]->cat_name;
	$cat_slug = $category[0]->category_nicename;
?>
<?php
$main_img = SCF::get( 'main_img' );
?>

<p class="post-category category-<?php echo $cat_slug; ?>"><?php echo $cat_name; ?></p>
<p class="img"><?php echo getImgData2($main_img,'300','','full'); ?></p>


<?php
$term = get_the_terms($post_id, 'blogcat');
?>

<div class="titleBox clearfix">
<p class="date"><?php the_time('Y年m月d日'); ?> / カテゴリー : <?php echo $term[0]->name; ?></p>
<h3><?php the_title(); ?></h3>
</div>

<div class="entry">
<?php the_content(); ?>
</div>

<div class="prevNext clearfix">
<ul class="clearfix">
<li><?php  
$prev_poxt = get_previous_post();  
if (!empty( $prev_poxt  )):  
echo '<a href="',get_permalink( $prev_poxt->ID ),'" class="next">前へ記事</a>';
else:
endif;  
?></li>

<li><a href="<?php bloginfo('url'); ?>/news/">新着TOP</a></li>
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

</div>
</div>

<div class="bR">
<?php get_sidebar("blog"); ?>
</div>
</div>


<?php get_footer(); ?>
