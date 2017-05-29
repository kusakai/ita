<!-- SIDE_CONTENTS -->

<h3>新着ブログ</h3>
<div class="newBlog clearfix">

<?php query_posts('post_type=blog&posts_per_page=3&paged='.$paged);?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="b clearfix">
<a href="<?php the_permalink(); ?>">
<p class="img"><?php echo getImgData2(SCF::get( 'main_img' ),'300','','full'); ?></p>
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

<h3>カテゴリー</h3>
<nav>
<ul class="clearfix">
<?php taxonomy('blogcat'); ?>
</ul>
</nav>

<h3>アーカイブ</h3>
<nav>
<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
<option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
<?php wp_get_archives('post_type=blog&type=monthly&format=option&show_post_count=1'); ?>
</select>
</nav>


<!-- /SIDE_CONTENTS -->
