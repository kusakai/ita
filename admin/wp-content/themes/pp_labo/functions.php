<?php

remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'rel_canonical');


function custom_taxonomies_terms_links($ID){
 
  $post = get_post( $ID );
  $post_type = $post->post_type;
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = "";
      foreach ( $terms as $term ) {
        $out[] =
          '  <a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a>";
      }
      $out[] = "";
    }
  }

  return implode('', $out );
}

/* テキストエディタ非表示 */
add_action('admin_print_styles', 'admin_works_css_custom');
function admin_works_css_custom() {
global $typenow;
if($typenow == 'works'):
echo '<style>#postdivrich {display: none;}</style>';
endif;
}

/* カスタム投稿タイプ */
add_action( 'init', 'create_post_type' );
add_action( 'init', 'create_post_type2' );

function create_post_type() {
  register_post_type( 'works', /* post-type */
    array(
      'labels' => array(
        'name' => __( '施工事例' ),
        'singular_name' => __( '施工事例' )
      ),
	  'has_archive' => true,
	  'rewrite' => array( 'with_front' => false ),
      'public' => true,
      'menu_position' => 5,
    )
  );
  
/* ここから */
  register_taxonomy(
    'workscat', /* タクソノミーの名前 */
    'works', /* books投稿で設定する */
    array(
      'hierarchical' => true, /* 親子関係が必要なければ false */
      'update_count_callback' => '_update_post_term_count',
      'label' => '施工事例のカテゴリー',
      'singular_label' => '施工事例のカテゴリー',
      'public' => true,
      'show_ui' => true
    )
  );
/* ここまでを追加 */
}

function create_post_type2() {
  register_post_type( 'blog', /* post-type */
    array(
      'labels' => array(
        'name' => __( 'ブログ' ),
        'singular_name' => __( 'ブログ' )
      ),
	  'has_archive' => true,
	  'rewrite' => array( 'with_front' => false ),
      'public' => true,
      'menu_position' => 5,
    )
  );
  
/* ここから */
  register_taxonomy(
    'blogcat', /* タクソノミーの名前 */
    'blog', /* books投稿で設定する */
    array(
      'hierarchical' => true, /* 親子関係が必要なければ false */
      'update_count_callback' => '_update_post_term_count',
      'label' => 'ブログのカテゴリー',
      'singular_label' => 'ブログのカテゴリー',
      'public' => true,
      'show_ui' => true
    )
  );
/* ここまでを追加 */
}






global $my_archives_post_type;
add_filter( 'getarchives_where', 'my_getarchives_where', 10, 2 );
function my_getarchives_where( $where, $r ) {
  global $my_archives_post_type;
  if ( isset($r['post_type']) ) {
    $my_archives_post_type = $r['post_type'];
    $where = str_replace( '\'post\'', '\'' . $r['post_type'] . '\'', $where );
  } else {
    $my_archives_post_type = '';
  }
  return $where;
}
add_filter( 'get_archives_link', 'my_get_archives_link' );

function my_get_archives_link( $link_html ) {
  global $my_archives_post_type;
  if ( '' != $my_archives_post_type )
    $add_link .= '?post_type=' . $my_archives_post_type;
	$link_html = preg_replace("/href=\'(.+)\'\s/","href='$1".$add_link." '",$link_html);
 
  return $link_html;
}


function taxonomy($txn){
	$args = array( 'hide_empty=0' );

	$terms = get_terms( $txn, $args );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$count = count( $terms );
		$i = 0;
		$term_list = '<ul class="my_term-archive">';
		foreach ($terms as $term ) {
			$i++;
			$term_list .= '<li><a href="' . get_term_link( $term ) . '"';
			$term_list .= ' title="' . sprintf( __('View all post filed under %s', 'my_localization_domain' ), $term->name ) . '">';
			$term_list .= $term->name . '</a></li>';
			
		}
		$term_list .= '</ul>';
		echo $term_list;
	}
}

function getImgData2($field,$width,$height,$imgSize){
	$size = $imgSize; // (thumbnail, medium, large, full or custom size)
    $image = wp_get_attachment_image_src( $field, $size );
    $alt = get_post_meta($fields['img'], '_wp_attachment_image_alt', true);
    $image_title = $field->post_title;
	
	$w = "";
	$h = "";
	
	if($width != ""){
		$w = 'width="'.$width.'"';
	}
	if($height != ""){
		$h = 'height="'.$height.'"';
	}
	
	$imgSrc = '<img src="'.$image[0].'"'.$w.$h. 'alt="'.$alt.'" title="'.$image_title.'" />';
	
	return $imgSrc;

}

function getImgData($field,$width,$height,$imgSize){
	
	$attachment_id = $field;
	$size = $imgSize; // (thumbnail, medium, large, full or custom size)
	$image = wp_get_attachment_image_src( $attachment_id, $size );
	$attachment = get_post( get_field('image') );
	$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	$image_title = $attachment->post_title;
	
	$imgData = array(
		"image" => $image,
		"alt" => $alt,
		"title" => $image_title,
	);
	
	$w = "";
	$h = "";
	
	if($width != ""){
		$w = 'width="'.$width.'"';
	}
	if($height != ""){
		$h = 'height="'.$height.'"';
	}
	
	$imgSrc = '<img src="'.$imgData["image"][0].'"'.$w.$h. 'alt="'.$imgData["alt"].'" title="'.$imgData["title"].'" />';
	return $imgSrc;
}

function getWorksCategoryImg($terms){
	
	$wpURL = get_option('home');
	
	if ( !empty($terms) ) {
	if ( !is_wp_error( $terms ) ) {
		foreach( $terms as $term ) {
			$cateName =  $term->name;
			}
		}
	}
	
	if($cateName == "WEB"){$cateImg = "top_case_prt_01.png";
	}else if($cateName == "GRAPHIC"){$cateImg = "top_case_prt_02.png";
	}else if($cateName == "EVENT"){$cateImg = "top_case_prt_03.png";
	}else if($cateName == "PROMOTION"){$cateImg = "top_case_prt_04.png";
	}else if($cateName == "MOVIE"){$cateImg = "top_case_prt_05.png";
	}else if($cateName == "PHOTO"){$cateImg = "top_case_prt_06.png";
	}else if($cateName == "SHOP"){$cateImg = "top_case_prt_07.png";
	}else{$cateImg = "top_case_prt_05.png";}
	
	$categoryImgURL = '<img src="'.$wpURL.'/images/'.$cateImg.'">';
	return $categoryImgURL;
}

function getBlogCategoryImg($terms){
	
	$wpURL = get_option('home');
	
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
	}else{$cateImg = "blog_ico_07.png";
	}
	
	$categoryImgURL = '<img src="'.$wpURL.'/images/'.$cateImg.'">';
	return $categoryImgURL;
}

function nameCheck($name){
	
	if($name != "株式会社プロデュース・プロ"){
		$name .= " 様";
	}
	return $name;
}

function sideNavigation($cate){
	
	$terms = get_terms($cate);
	$tr = single_term_title( '' , false);
	$txt = "";
	
	foreach( $terms as $term ) {
		$termName = $term->name;
		$termCount = $term->count;
		$termSlug = $term->slug;
		
		if($termName == $tr){
			$txt .= '<li class="parent">';
		}else{
			$txt .= '<li>';
		}
		$txt .= '<a href="'.get_bloginfo('url').'/'.$cate.'/'.$termSlug.'/">'.$termName.'（'.$termCount.'）</a>';
		$txt .= '</li>'."\r\n";
	}
	return $txt;
}



function workerFunc() {
	
		$page = get_the_ID();
		$text = "";
		$ary = array('producer','director','designer','cameraman','writer');
		
		foreach( $ary as $value ) {
			$val = $value;
			$field = get_field($val,$page);
			
			if($field != null){
				$userID = $field[ID];
				$name = get_the_author_meta('display_name', $userID);
				$url = get_author_posts_url( $userID );
				$text .= '<p><strong>'.$val.'</strong> - <a href="'.$url.'">'.$name.'</a></p>'."\r\n";
			}
		}
		return $text;
}
add_shortcode('worker', 'workerFunc');

function commentFunc() {
	
		$page = get_the_ID();
		$text = '<p class="none">'.get_field("wcomment", $page).'</p>';
		return $text;
}
add_shortcode('comment', 'commentFunc');

function workAreaFunc() {
	
		$page = get_the_ID();
		$text = '<p>'.get_field("ryoiki", $page).'</p>';
		return $text;
}
add_shortcode('workarea', 'workAreaFunc');

function linkFunc() {
	
		$page = get_the_ID();
		$URL = get_field("linkURL", $page);
		if($URL != ""){
			$text = '<p class="url"><a href="'.$URL.'" target="_blank">'.$URL.'</a></p>';	
		}
		return $text;
}
add_shortcode('link', 'linkFunc');

function removePfunction() {
	remove_filter ('the_content', 'wpautop');
	the_content();	
}
add_shortcode('removeP', 'removePfunction');


//カスタム投稿タイプ用カレンダー(Custom Post Type Permalinks用)
function get_cpt_calendar($cpt, $initial = true, $echo = true) {
    global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
 
    $cptname = get_post_type_object($cpt)-> rewrite;
    if($cptname[slug]){
        $cptname = $cptname[slug];
    }else{
        $cptname = $cpt;
    }
 
 
     
    $cache = array();
    $key = md5( $m . $monthnum . $year );
    if ( $cache = wp_cache_get( 'get_calendar', 'calendar' ) ) {
        if ( is_array($cache) && isset( $cache[ $key ] ) ) {
            if ( $echo ) {
                echo apply_filters( 'get_calendar',  $cache[$key] );
                return;
            } else {
                return apply_filters( 'get_calendar',  $cache[$key] );
            }
        }
    }
 
    if ( !is_array($cache) )
        $cache = array();
 
    // Quick check. If we have no posts at all, abort!
    if ( !$posts ) {
        $gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = '$cpt' AND post_status = 'publish' LIMIT 1");
        if ( !$gotsome ) {
            $cache[ $key ] = '';
            wp_cache_set( 'get_calendar', $cache, 'calendar' );
            return;
        }
    }
 
    if ( isset($_GET['w']) )
        $w = ''.intval($_GET['w']);
 
    // week_begins = 0 stands for Sunday
    $week_begins = intval(get_option('start_of_week'));
 
    // Let's figure out when we are
    if ( !empty($monthnum) && !empty($year) ) {
        $thismonth = ''.zeroise(intval($monthnum), 2);
        $thisyear = ''.intval($year);
    } elseif ( !empty($w) ) {
        // We need to get the month from MySQL
        $thisyear = ''.intval(substr($m, 0, 4));
        $d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
        $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
    } elseif ( !empty($m) ) {
        $thisyear = ''.intval(substr($m, 0, 4));
        if ( strlen($m) < 6 )
                $thismonth = '01';
        else
                $thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
    } else {
        $thisyear = gmdate('Y', current_time('timestamp'));
        $thismonth = gmdate('m', current_time('timestamp'));
    }
 
    $unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
    $last_day = date('t', $unixmonth);
 
    // Get the next and previous month and year with at least one post
    $previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
        FROM $wpdb->posts
        WHERE post_date < '$thisyear-$thismonth-01'
        AND post_type = '$cpt' AND post_status = 'publish'
            ORDER BY post_date DESC
            LIMIT 1");
    $next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
        FROM $wpdb->posts
        WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
        AND post_type = '$cpt' AND post_status = 'publish'
            ORDER BY post_date ASC
            LIMIT 1");
 
 
    if($previous->month < 10){
        $pmonth = '0'.$previous->month;
    }else{
        $pmonth = $previous->month;
    }
    if($next->month < 10){
        $nmonth = '0'.$next->month;
    }else{
        $nmonth = $next->month;
    }
 
    /* translators: Calendar caption: 1: month name, 2: 4-digit year */
    $calendar_caption = _x('%1$s %2$s', 'calendar caption');
    $calendar_output = '<table id="wp-calendar">
    <caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
    <thead>
    <tr>';
 
    $myweek = array();
 
    for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
        $myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
    }
 
    foreach ( $myweek as $wd ) {
        $day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		if($day_name=='日')$day_name='Sun';
if($day_name=='月')$day_name='Mon';
if($day_name=='火')$day_name='Tue';
if($day_name=='水')$day_name='Wed';
if($day_name=='木')$day_name='Thu';
if($day_name=='金')$day_name='Fri';
if($day_name=='土')$day_name='Sat';
        $wd = esc_attr($wd);
		
		
        $calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
    }
 
    $calendar_output .= '
    </tr>
    </thead>
 
    <tfoot>
    <tr>';
 
    if ( $previous ) {
        $calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_bloginfo("url") .'/' .$cptname.'/date/'.$previous->year.'/'.$pmonth.'" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($previous->month), date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year)))) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
    } else {
        $calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
    }
 
    $calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';
 
    if ( $next ) {
        $calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_bloginfo("url") .'/' .$cptname.'/date/'.$next->year.'/'.$nmonth.'" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($next->month), date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) ) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
    } else {
        $calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
    }
 
    $calendar_output .= '
    </tr>
    </tfoot>
 
    <tbody>
    <tr>';
 
    // Get days with posts
    $dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
        FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
        AND post_type = '$cpt' AND post_status = 'publish'
        AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
    if ( $dayswithposts ) {
        foreach ( (array) $dayswithposts as $daywith ) {
            $daywithpost[] = $daywith[0];
        }
    } else {
        $daywithpost = array();
    }
 
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
        $ak_title_separator = "\n";
    else
        $ak_title_separator = ', ';
 
    $ak_titles_for_day = array();
    $ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
        ."FROM $wpdb->posts "
        ."WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' "
        ."AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' "
        ."AND post_type = '$cpt' AND post_status = 'publish'"
    );
    if ( $ak_post_titles ) {
        foreach ( (array) $ak_post_titles as $ak_post_title ) {
 
                /** This filter is documented in wp-includes/post-template.php */
                $post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );
 
                if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
                    $ak_titles_for_day['day_'.$ak_post_title->dom] = '';
                if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
                    $ak_titles_for_day["$ak_post_title->dom"] = $post_title;
                else
                    $ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
        }
    }
 
    // See how much we should pad in the beginning
    $pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
    if ( 0 != $pad )
        $calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';
 
    $daysinmonth = intval(date('t', $unixmonth));
    for ( $day = 1; $day <= $daysinmonth; ++$day ) {
        if($day < 10){
            $day2 = '0'.$day;
        }else{
            $day2 = $day;
        }
        if ( isset($newrow) && $newrow )
            $calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
        $newrow = false;
 
        if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
            $calendar_output .= '<td id="today">';
        else
            $calendar_output .= '<td>';
 
        if ( in_array($day, $daywithpost) ) // any posts today?
                $calendar_output .= '<a href="' . get_bloginfo("url") .'/' .$cptname.'/date/'.$thisyear.'/'.$thismonth.'/'.$day2.'" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
        else
            $calendar_output .= $day;
        $calendar_output .= '</td>';
 
        if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
            $newrow = true;
    }
 
    $pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
    if ( $pad != 0 && $pad != 7 )
        $calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';
 
    $calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";
 
    $cache[ $key ] = $calendar_output;
    wp_cache_set( 'get_calendar', $cache, 'calendar' );
 
    if ( $echo )
        echo apply_filters( 'get_calendar',  $calendar_output );
    else
        return apply_filters( 'get_calendar',  $calendar_output );
 
}

?>
<?php
//ページャー機能
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "&laquo; First";
         if($paged > 1 && $showitems < $pages) echo "&lsaquo; 
 
Previous";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems 
 
))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"".$i."";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 
 
1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "Last &raquo;";
         echo "</div>\n";
     }
}
?>