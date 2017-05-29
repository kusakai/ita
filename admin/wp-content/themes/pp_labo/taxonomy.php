

<?php get_header(); ?>

<div class="co clearfix">
<div class="coL">
<p>taxonomy</p>
<ul><?php wp_list_categories(array('taxonomy' => 'bookcat','title_li' => '','show_count' => true)); ?></ul>
<ul><?php wp_get_archives(array('post_type' => 'books','type' => 'monthly','show_post_count' => true));?></ul>

</div>
<div class="coR">
<p><?php echo $query_string ?></p>
<!-- 
<p>
<?php
//echo $query_string
$post = get_page($page_id);
echo $post->post_name; //スラッグ
echo $post->post_title; //タイトル
echo $post->post_date; //作成日
echo $post->guid; //URL
echo $post->post_excerpt; //抜粋
echo $post->post_content; //本文
?>
</p>
-->

<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts($query_string .'&posts_per_page=5&paged='.$paged);
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
	$attachment_id = get_field('メイン写真',$post->ID);
	$size = "full"; // (thumbnail, medium, large, full or custom size)
	$image = wp_get_attachment_image_src( $attachment_id, $size );
	$attachment = get_post( get_field('image') );
	$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	$image_title = $attachment->post_title;
?>

<div class="clearfix">
<p class="imgL"><img src="<?php echo $image[0]; ?>" width="100%" alt="<?php echo $alt; ?>" title="<?php echo $image_title; ?>" /></p>
<p>Categories: <?php echo get_the_term_list( $post->ID, 'bookcat' ); ?></p>
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>の詳細へ"><?php the_title(); ?></a></h2>
<p><?php echo mb_substr(strip_tags($post-> post_content),0,30).'...'; ?></p>
<p><a href="<?php echo get_the_author_link(); ?>"><?php the_author(); ?></a>（<?php the_author_posts(); ?>）</p>
<p>Written by: <?php the_author_link(); ?></p>
</div>

<?php endwhile; ?>

<?php else : ?>

<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p><br />
<?php get_search_form(); ?>

<?php endif; ?>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

</div>
</div>

<?php get_footer(); ?>
