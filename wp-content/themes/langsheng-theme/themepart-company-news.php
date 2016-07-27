<?php
    $PostID = langsheng_current_language_post_id(340);
    $thePost = get_post($PostID);

    $backgroundType = get_field("background_type", $thePost->ID);
    $backgroundImage = get_field("background_image", $thePost->ID);
    if($backgroundImage && $backgroundType != "none") {
       $backgroundStyle = 'style="background-image: url(' . $backgroundImage["url"] . ');"';
    } else {
        $backgroundStyle = "";
    }
?>

<?php 
    $boldFont = get_field("bold_font_size", $thePost->ID);
    $paragraphFont = get_field("paragraph_font_size", $thePost->ID);
    if ($boldFont) {
    
?>
    <style>
        section.news h1.title {
            font-size: <?php echo $boldFont; ?>px;
            line-height: <?php echo $boldFont+6; ?>px;
        }
    </style>
<?php 
    }
    if ($paragraphFont) {
?>
    <style>
        section.news p {
            font-size: <?php echo $paragraphFont; ?>px;
            line-height: <?php echo $paragraphFont+9; ?>px;
        }
    </style>
<?php 
    } 
?>

<p class="hidden visible-xs">&nbsp;</p><p class="hidden visible-xs">&nbsp;</p>
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="inside">
        <div class="new-title">
            <h1>
                <?php
                    $thePostTitle = get_field("special_title", $thePost->ID);
                    if($thePostTitle){
                        echo $thePostTitle;
                    } else{
                        echo $thePost->post_title;
                    }
                ?>
            </h1>
            <?php
                // Reset $post Data
                wp_reset_postdata();
                // Get News
                $companyNewsArgs = array(
                    'post_type' => 'company_news',
                    'posts_per_page' => 4,
                    'suppress_filters' => 0,
                    'orderby' => 'order',
                    'order' => 'ASC',
                );
                $companyNews = new WP_Query( $companyNewsArgs );
            ?>
        </div>

        <ul class="list-unstyled news-list row">
            <?php
                while ( $companyNews->have_posts() ) { 
                    $companyNews->the_post(); 
                    global $post;
                    $newsDateDay = date_i18n("d", strtotime(get_field("news_date", $post->ID)));
                    $newsDateMonth = date_i18n("F", strtotime(get_field("news_date", $post->ID)));
                    $newsDateYear = date_i18n("Y", strtotime(get_field("news_date", $post->ID)));
                    $newsImage = get_field("news_image", $post->ID);
                    $newsReadMore = get_field("read_more_text", $post->ID);
                    $newsDisplay = get_field("news_display", $post->ID);
                    $newsContentLeft = get_field("left_column_text", $post->ID);
                    $newsContentRight = get_field("right_column_text", $post->ID);
                    $newsContentSingle = get_field("single_column_text", $post->ID);
            ?>
                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="<?php the_permalink(); ?>">
                            <span class="image" style="background-image:url(<?php echo $newsImage["url"]; ?>);">
                                <span class="date"><?php echo $newsDateDay; ?><small><?php echo $newsDateMonth; ?></small></span>
                            </span>
                            <span class="table-div">
                                <span class="table-div-cell">
                                    <h2><?php the_title(); ?></h2>
                                    <?php 
                                        if($newsDisplay == "two") { 
                                            echo custom_field_excerpt($newsContentLeft);
                                        } else {
                                            echo custom_field_excerpt($newsContentSingle);
                                        }
                                    ?>
                                    <span class="arrow">
                                        <?php echo $newsReadMore; ?>
                                        <span class="readMoreArrows"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
            <?php
                }
            ?>
        </ul>
        <?php
            $newsListPageID = langsheng_current_language_post_id(348, 'page');
            $newsListViewAllText = get_field("view_all_button_text", $newsListPageID);
        ?>
        <a href="<?php echo get_permalink($newsListPageID); ?>" class="load-more">
            <?php echo $newsListViewAllText; ?> <img src="<?php bloginfo('template_url'); ?>/images/nav-arrow-right-grey.png" alt="#">
        </a>  

    </div>
</div>

