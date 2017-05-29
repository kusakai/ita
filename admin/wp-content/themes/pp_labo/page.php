<?php
/*
Template Name: page1
*/
?>

<?php
/*
Template Name: sample
*/
?>


<?php get_header(); ?>




<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="post">
<h2 class="title"><?php the_title(); ?></h2>

<?php the_content(); ?>
</div><!-- /.post -->

<?php endwhile; ?>
<?php else : ?>
<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>

<?php endif; ?>

<?php get_cpt_calendar('news'); ?></ul>


<?php get_footer(); ?>
