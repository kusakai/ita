<?php get_header(); ?>

<div class="panNavi">
<ul>
<li><a href="<?php bloginfo('url'); ?>/blog/">PPブログ</a></li>
<li><a href="./"><?php single_term_title( ); ?></a></li>
</ul>
</div>

<div class="mainContents clearfix">
<div class="mainL2">
<div class="sideMenu">
<h3 class="ulcTitle t02">PPブログ</h3>
<ul class="sideNavi">
<?php echo sideNavigation('blogcat');?>
</ul>
</div>
<?php get_sidebar(); ?>
</div>

<div class="mainR">

<?php query_posts($query_string .'&posts_per_page=999&paged='.$paged);?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="indexBlogBox">
<a href="<?php the_permalink(); ?>">

<?php $categoryImg = getBlogCategoryImg(get_the_terms($post->ID, 'blogcat'));?>
    
<p class="cate"><?php echo $categoryImg; ?></p>
<div class="indexBlogBoxSub clearfix">
<p class="img"><?php echo getImgData(get_field('thumbnail',$post->ID),"100%","medium"); ?></p>
<div class="textCo">
<h3><span><?php the_time('Y/m/d'); ?></span><br><?php the_title(); ?></h3>
<p class="txt"><?php echo $post->summary; ?></p>
<p class="altor"><?php echo get_avatar(get_the_author_id(), 25); ?><?php the_author(); ?></p>
</div>
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
</div>

<?php get_footer(); ?>
