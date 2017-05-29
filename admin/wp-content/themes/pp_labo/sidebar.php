<!-- SIDE_CONTENTS -->

<?php
$user_id = get_the_author_meta( 'ID' );
?>


<?php if(is_single()) : ?>

<div class="profile">
<?php 
	echo get_avatar( $user_id,"200" );
?>
	<p class="name"><?php the_author_nickname(); ?></p>
	<p><?php the_author_description(); ?></p>
	<p><a href="<?php the_author_url(); ?>" target="_blank"><?php the_author_url(); ?></a></p>
	
	
<div class="user-article">
<h3>This user post</h3>
<ul>
<?php query_posts('&author='.$user_id.'&posts_per_page=5&paged='.$paged);?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
<?php else : ?>
<li>記事がありません。</li>
<?php endif; ?>
</ul>
</div>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>	


<div class="side-category">
<h3>Categories</h3>
<ul class="clearfix">
<?php wp_list_categories('title_li='); ?>
</ul>
</div>



<div class="snsBox">
    <div class="fb-like" data-href="http://life-fun.info/article/index/0/93?utm_source=facebook&amp;utm_medium=social" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div><!--- fb-like --->

<div class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="http://life-fun.info/article/index/0/93?utm_source=twitter&amp;utm_medium=social" data-text="LIFE:秋田のワンコたち。ミニピンの小さなカップル　せんべいくんときなこちゃん" data-via="LIFE___FUN">Tweet</a></div><!--- twitter --->

<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-href="http://life-fun.info/article/index/0/93?utm_source=googleplus&amp;utm_medium=social"></div>

<div class="bookmark"><a href="http://life-fun.info/article/index/0/93?utm_source=hatena&amp;utm_medium=social" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a></div><!--- bookmark --->

<div class="pocket"><a data-save-url="/article/index/0/93" data-pocket-label="pocket" data-pocket-count="vertical" class="pocket-btn" data-lang="en"></a></div>

</div><!--- snsBox --->

<h3>新着ブログ</h3>

<div class="newBlog clearfix">

<?php query_posts($query_string .'&posts_per_page=5&paged='.$paged);?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
$mi3 = SCF::get( 'main_img' );
$image = wp_get_attachment_image_src( $mi3, "large" );
if($mi3 != ""){
	$miUrl3 = $image[0];
}else{
	$miUrl3 = "/images/pict_noimage.png";
}
?>

<div class="b clearfix">
<a href="<?php the_permalink(); ?>">
<figure class="news-index-pict"><i class="bg" data-bg="<?php echo $miUrl3; ?>"></i></figure>
<div class="info">
<div class="inner">
<h4><?php the_title(); ?></h4>
<p class="date"><?php the_time('Y年m月d日'); ?></p>
</div>
</div>
</a>
</div>

<?php endwhile; ?>

<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>	
</div>


<h3>アーカイブ</h3>
<nav>
<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
<option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
</select>
</nav>


<!-- /SIDE_CONTENTS -->
