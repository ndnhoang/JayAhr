<?php
// show contact
add_filter( 'widget_text', 'do_shortcode' );
add_shortcode('show_contact','show_contact');
function show_contact(){
    global $jayahr_option; 
    $phone  = $jayahr_option['phone'];
    $email  = $jayahr_option['email'];
    ob_start();
    if ($phone || $email) : ?>
        <ul>
            <?php if ($phone) : ?>
                <li><a href=tell:<?php echo $phone; ?>><?php echo $phone; ?></a></li>
            <?php endif; ?>
            <?php if ($email) : ?>
                <li><a href=mailto:<?php echo $email; ?>><?php echo $email; ?></a></li>
            <?php endif; ?>
        </ul>
    <?php endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//show socials
add_shortcode('show_socials_icon','show_socials_icon');
function show_socials_icon(){
    global $jayahr_option; 
    ob_start();?>
    <ul>
        <?php if( !empty($jayahr_option['social-email']) ): ?>
        <li><a class="email" href="<?php echo $jayahr_option['social-email']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri().'/images/email-icon.png'; ?>" alt="email"></a></li>
        <?php endif; ?>
        <?php if( !empty($jayahr_option['instagram']) ): ?>
        <li><a class="instagram" href="<?php echo $jayahr_option['instagram']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri().'/images/instagram-icon.png'; ?>" alt="instagram"></a></li>
        <?php endif; ?>
        <?php if( !empty($jayahr_option['facebook']) ): ?>
        <li><a class="facebook" href="<?php echo $jayahr_option['facebook']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri().'/images/facebook-icon.png'; ?>" alt="facebook"></a></li>
        <?php endif; ?>
    </ul>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//partners
add_shortcode('partners','show_partner');
function show_partner(){
    $query = new WP_Query(array(
        'post_type' => 'partners',
        'orderby' => 'date',
        'order'=>'desc',
        'post_status' => 'publish'
    ));
    ob_start();
    if($query->have_posts()):
        echo '<div id="slide-partners" class="owl-carousel">';
        while($query->have_posts()): $query->the_post();
            if(has_post_thumbnail())
                $url_img =  wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            else
                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
            if(get_the_excerpt()!="")
                $link = trim(get_the_excerpt());
            else
                $link = "#";
            ?>
            <a href="<?php echo $link?>" target="_blank" class="item"><img src="<?php echo crop_img(204,121,$url_img);?>" alt="<?php the_title()?>"></a>
        <?php endwhile;
        wp_reset_query();
        echo '</div>';
    endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//customer
add_shortcode('customer','show_customer');
function show_customer(){
    $query = new WP_Query(array(
        'post_type' => 'customer',
        'orderby' => 'date',
        'order'=>'desc',
        'post_status' => 'publish'
    ));
    ob_start();
    if($query->have_posts()): 
        echo '<div class="customer-content">';
        while($query->have_posts()): $query->the_post();
            if(has_post_thumbnail())
                $url_img =  wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            else
                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
            $fileName = pathinfo($url_img, PATHINFO_FILENAME);?>
            <div class="item">
                <div class="item-wrapper">
                    <div id="thumb-name" class="row">
                        <div class="col-md-3 thumb"><img src="<?php echo $url_img?>" alt="<?php echo $fileName?>"/></div>
                        <div class="col-md-9 name">
                            <h4><?php the_title()?></h4>
                            <?php the_excerpt()?>
                        </div>
                    </div>
                    <div class="desc"><?php echo wp_trim_words(get_the_content(),50);?></div>
                </div> 
            </div>           
        <?php endwhile;
        wp_reset_query();
        echo '</div>';
    endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//partners
add_shortcode('why_us','why_us');
function why_us(){
    ob_start();
    if(have_rows('why_choose_us')):        
        echo '<ul class="list">';       
            while (have_rows('why_choose_us')): the_row();
                $img = get_sub_field("home_we_icon");
                $title = get_sub_field("home_we_text"); ?>
                <li>
                    <img src="<?php echo $img['url']?>" alt="<?php echo $img['filename']?>"/>
                    <div class="desc"><?php echo $title?></div>
                </li>
            <?php endwhile;
        echo '</ul>';
    endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//get new post
add_shortcode('get_new_post','get_new_post');
function get_new_post($atts, $content = null){
    extract(shortcode_atts(array(
        'title'  => '',
        'number' => -1
    ), $atts));
    $query = new WP_Query(array(
        'post_type' => 'post',
        'orderby' => 'date',
        'order'=>'desc',
        'post_status' => 'publish',
        'posts_per_page' => $number,
        'orderby'        => 'meta_value_num',
        'order'          => 'desc',
        'meta_key'       => 'postview_number',
    ));
    ob_start();
    if($query->have_posts()): 
        echo '<div class="list-item" id="list-new-post">';
        while($query->have_posts()): $query->the_post();
            if(has_post_thumbnail())
                $url_img =  wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            else
                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
            $fileName = pathinfo($url_img, PATHINFO_FILENAME);?>
            <div class="item">
                <a class="thumb" href="<?php the_permalink(); ?>"><img src="<?php echo crop_img(60,60,$url_img);?>" alt="<?php echo $fileName?>"/></a>
                <div class="name">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
                    <span class="view"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo get_view(get_the_ID()).__(" lượt xem"); ?></span>
                </div>
            </div>           
        <?php endwhile;
        wp_reset_query();
        echo '</div>';
    endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//get category 
add_shortcode('get_categories_sidebar', 'get_categories_sidebar');
function get_categories_sidebar($atts, $content = null)
{
    ob_start();
    $terms = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => 0
    ));
    $current_id = get_queried_object_id(); ?>
    <ul class="list-tax">     
        <?php foreach($terms as $term) { if($current_id == $term->term_id){$class= "active";}else{$class= "";} ?>
            <li class="<?php echo $class; ?>"><a href="<?php echo get_term_link($term->term_id); ?>"><i class="fa fa-location-arrow" aria-hidden="true"></i><?php echo $term->name; ?></a></li>
        <?php } ?>    
    </ul>
    <?php $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;
}
//partners
add_shortcode('show_bigsale','show_bigsale');
function show_bigsale(){
    global $wpdb;
    $data = $wpdb->get_results("select * from wp_partner_adv where type = 'Chương trình khuyến mãi' order by number asc, ID desc LIMIT 0, 1");
    echo '<div class="list-sale">';
    if ($data) : $temp = 0;
        foreach ($data as $item) : 
        	$temp = $item->ID;
            $url_img = $item->image;
            if($url_img == '')
                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
            else
                $url_img = home_url().'/'.$url_img;
            ?>
            <div class="item first-item">
                <div class="img"><a href="<?php echo home_url().'/tim-chuong-trinh-khuyen-mai?km='.$item->ID; ?>"><img src="<?php echo crop_img(600,260,$url_img); ?>" alt=""/></a></div>
                <div class="info">
                    <h3 class="title"><a href="<?php echo home_url().'/tim-chuong-trinh-khuyen-mai?km='.$item->ID; ?>"><?php echo $item->title; ?></a></h3>
                    <p class="card">Loại thẻ: <span><?php echo $item->card; ?></span></p>
                    <p class="company">Tổ chức phát hành: <span><?php echo $item->company; ?></span></p>
                    <p class="fee">Phí: <span><?php echo $item->price; ?></span></p>
                    <p class="area">Khu vực: <span><?php echo $item->area; ?></span></p>
                </div>
            </div>
        <?php endforeach;
    endif;
    $data = $wpdb->get_results("select * from wp_partner_adv where type = 'Chương trình khuyến mãi' and ID <> ".$temp." order by number asc, ID desc LIMIT 0, 15");
    if ($data) : 
    	echo '<div class="row">';
    	echo '<div class="slide-item">';
	    	echo '<div class="owl-carousel">';
		        foreach ($data as $item) : 
		            $url_img = $item->image;
		            if($url_img == '')
		                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
		            else
		                $url_img = home_url().'/'.$url_img;
		            ?>
		            <div class="item not-first-item">
		                <div class="img"><a href="<?php echo home_url().'/tim-chuong-trinh-khuyen-mai?km='.$item->ID; ?>"><img src="<?php echo crop_img(180,190,$url_img); ?>" alt=""/></a></div>
		                <div class="info">
		                    <h3 class="title"><a href="<?php echo home_url().'/tim-chuong-trinh-khuyen-mai?km='.$item->ID; ?>"><?php echo $item->title; ?></a></h3>
		                    <p class="card">Loại thẻ: <span><?php echo $item->card; ?></span></p>
		                    <p class="company">Tổ chức phát hành: <span><?php echo $item->company; ?></span></p>
		                    <p class="fee">Phí: <span><?php echo $item->price; ?></span></p>
		                    <p class="area">Khu vực: <span><?php echo $item->area; ?></span></p>
		                </div>
		            </div>
		        <?php endforeach;
		    echo '</div>';
		echo '</div>';
		echo '</div>';
    endif;
	echo '</div>';
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//partners
add_shortcode('get_golden_partners','get_golden_partners');
function get_golden_partners(){
    global $wpdb;
    $data = $wpdb->get_results("select * from wp_partner_adv where type = 'Đối tác vàng' order by number asc, ID desc LIMIT 0, 1");
    echo '<div class="list-sale">';
    if ($data) : $temp = 0;
        foreach ($data as $item) : 
        	$temp = $item->ID;
            $url_img = $item->image;
            if($url_img == '')
                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
            else
                $url_img = home_url().'/'.$url_img;
            ?>
            <div class="item first-item">
                <div class="img"><a href="<?php echo home_url().'/tim-doi-tac?dt='.$item->ID; ?>"><img src="<?php echo crop_img(600,260,$url_img); ?>" alt=""/></a></div>
                <div class="info">
                    <h3 class="title"><a href="<?php echo home_url().'/tim-doi-tac?dt='.$item->ID; ?>"><?php echo $item->title; ?></a></h3>
                    <p class="card">Loại thẻ: <span><?php echo $item->card; ?></span></p>
                    <p class="company">Tổ chức phát hành: <span><?php echo $item->company; ?></span></p>
                    <p class="fee">Phí: <span><?php echo $item->price; ?></span></p>
                    <p class="area">Khu vực: <span><?php echo $item->area; ?></span></p>
                </div>
            </div>
        <?php endforeach;
    endif;
    $data = $wpdb->get_results("select * from wp_partner_adv where type = 'Đối tác vàng' and ID <> ".$temp." order by number asc, ID desc LIMIT 0, 15");
    if ($data) : 
    	echo '<div class="row">';
    	echo '<div class="slide-item">';
	    	echo '<div class="owl-carousel">';
		        foreach ($data as $item) : 
		            $url_img = $item->image;
		            if($url_img == '')
		                $url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
		            else
		                $url_img = home_url().'/'.$url_img;
		            ?>
		            <div class="item not-first-item">
		                <div class="img"><a href="<?php echo home_url().'/tim-doi-tac?dt='.$item->ID; ?>"><img src="<?php echo crop_img(180,190,$url_img); ?>" alt=""/></a></div>
		                <div class="info">
		                    <h3 class="title"><a href="<?php echo home_url().'/tim-doi-tac?dt='.$item->ID; ?>"><?php echo $item->title; ?></a></h3>
		                    <p class="card">Loại thẻ: <span><?php echo $item->card; ?></span></p>
		                    <p class="company">Tổ chức phát hành: <span><?php echo $item->company; ?></span></p>
		                    <p class="fee">Phí: <span><?php echo $item->price; ?></span></p>
		                    <p class="area">Khu vực: <span><?php echo $item->area; ?></span></p>
		                </div>
		            </div>
		        <?php endforeach;
		    echo '</div>';
		echo '</div>';
		echo '</div>';
    endif;
    echo '</div>';
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}