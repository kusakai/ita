
<?php get_header(); ?>
<?php query_posts( $query_string.'&posts_per_page=10&paged='.$paged);?>
<?php echo $query_string ?>

<div class="ulcTitle">
<p class="img"><img src="<?php bloginfo('url'); ?>/images/case/case_main.png" alt=""></p>
<h2><img src="<?php bloginfo('url'); ?>/images/case/case_maintit_01.png" alt="施工事例"></h2>
</div>

<div class="caseContents">

<p class="caseTxt">これまで施工した実例をご紹介いたします。</p>
<div class="indexCase clearfix">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
	$category = get_the_category( $post->ID );
	$cat_id   = $category[0]->cat_ID;
	$cat_name = $category[0]->cat_name;
	$cat_slug = $category[0]->category_nicename;
?>

<?php
$place = SCF::get( 'place' );
$comment = SCF::get( 'comment' );
$data = SCF::get( 'data' );
$main_photo = SCF::get( 'main_photo' );
?>


<div class="box">
<?php echo the_terms(get_the_ID(), 'works');?>

<a href="<?php the_permalink(); ?>">
<p class="img imgfix"><?php echo getImgData2($main_photo,'','','full'); ?></p>
<div class="titleBox">
<p class="add"><?php echo $place; ?></p>
<h3><?php the_title(); ?></h3>
</div>
</a>
</div>
<?php endwhile; ?>
<?php else : ?>

<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>

<?php endif; ?>
</div>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>


</div>

<?php get_footer(); ?>
