<?php get_header(); ?>

<div class="panNavi">
<ul>
<li><a href="<?php bloginfo('url'); ?>/blog/">PPブログ</a></li>
<li><a href="../"><?php echo get_the_author_meta( 'display_name', get_query_var( 'author' ) ); ?></a></li>
</ul>
</div>

<div class="mainContents clearfix">
<div class="mainL2">
<div class="sideMenu">
<h3 class="ulcTitle t02">制作実績</h3>
<ul class="sideNavi">
<?php echo sideNavigation('blogcat');?>
</ul>

</div>
<?php get_sidebar(); ?>
</div>

<div class="mainR">

<?php query_posts("post_type=blog&".$query_string);?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="indexBlogBox">
<a href="<?php the_permalink(); ?>">

<?php
	$attachment_id = get_field('thumbnail',$post->ID);
	$size = "full"; // (thumbnail, medium, large, full or custom size)
	$image = wp_get_attachment_image_src( $attachment_id, $size );
	$attachment = get_post( get_field('image') );
	$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	$image_title = $attachment->post_title;
		
	$terms = get_the_terms($post->ID, 'blogcat');
	if ( !empty($terms) ) {
	if ( !is_wp_error( $terms ) ) {
		foreach( $terms as $term ) {
			$cateName =  $term->name;
			}
		}
	}
	
	if($cateName == "ウェブ"){$cateImg = "blog_ico_01.png";
	}else if($cateName == "グラフィック"){$cateImg = "blog_ico_02.png";
	}else if($cateName == "イベント"){$cateImg = "blog_ico_03.png";
	}else if($cateName == "お知らせ"){$cateImg = "blog_ico_04.png";
	}else if($cateName == "おもしろ"){$cateImg = "blog_ico_05.png";
	}else if($cateName == "生活"){$cateImg = "blog_ico_06.png";
	}else if($cateName == "お役立ち"){$cateImg = "blog_ico_07.png";
	}
	?>
    
<p class="cate"><img src="<?php bloginfo('url'); ?>/images/<?php echo $cateImg; ?>" width="70" height="29"></p>
<div class="indexBlogBoxSub clearfix">
<p class="img"><img src="<?php echo $image[0]; ?>" width="100%" alt="<?php echo $alt; ?>" title="<?php echo $image_title; ?>" /></p>
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
