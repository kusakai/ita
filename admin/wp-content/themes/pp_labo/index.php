<?php get_header(); ?>

<section class="article-list clearfix">
<?php 
	query_posts('&posts_per_page=10&paged='.$paged);
	if (have_posts()) :
	while (have_posts()) : the_post();
	
	$mi3 = SCF::get( 'main_img' );
	$image = wp_get_attachment_image_src( $mi3, "large" );
	if($mi3 != ""){
		$miUrl3 = $image[0];
	}else{
		$miUrl3 = "/images/pict_noimage.png";
	}
?>


<?php
$post = get_post( $post->ID );
$post_type = $post->post_type;
$taxonomies = get_object_taxonomies( $post_type, 'objects' );
 foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
	 if($post_type == "blog" || $taxonomy_slug == "category"){ //category , post_tag
		 $terms = get_the_terms( $post->ID, $taxonomy_slug );
		 
		 $category_list = "<ul>";
		 if ( !empty( $terms ) ) {
			 
			 foreach ( $terms as $term ) {
				$category_list .= '  <li><a href="'
				.    get_term_link( $term->slug, $taxonomy_slug ) .'">'
				.    $term->name
				. "</a></li>\n";
			 }
			 $category_list .= '</ul>';
		 }
	 }
 }
?>
<div class="box clearfix">
<a class="news-index clearfix" href="<?php the_permalink(); ?>">
<figure class="news-index-pict">
<i class="bg front" data-bg="<?php echo $miUrl3; ?>"></i>
<i class="back"></i>
</figure>
<div class="txt-area">

<h2> <?php the_title(); ?></h2>
<p class="post-date"><?php the_time("Y-n-j"); ?></p>
</div>
</a>
<div class="category-list clearfix"><img src="<?php bloginfo('url'); ?>/images/ico_folder.svg" alt=""/><?php echo $category_list; ?></div>

</div>		
<?php endwhile; ?>
<?php else : ?>
<h2 class="title">記事が見つかりませんでした。</h2>
<p>検索で見つかるかもしれません。</p>
<?php get_search_form(); ?>
<?php endif; ?>
</section>
<?php wp_reset_query();get_footer(); ?>
