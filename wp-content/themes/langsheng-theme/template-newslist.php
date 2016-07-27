<?php
    /* Template Name: News List */
    get_header();
?>

<section class="internal-news white">
    <div class="lang-sheng-news white">
        <div class="container new-news-block">
            
            <div class="new-title">
                <h1><?php the_title(); ?></h1>
            </div>
            
            <?php
                // Reset $post Data
                wp_reset_postdata();
                // Pagination
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                // Get News
                $newsArgs = array(
                    'post_type'        => 'news',
                    'posts_per_page'   => 6,
                    'suppress_filters' => 0,
                    'orderby'          => 'order',
                    'order'            => 'ASC',
                    'paged'            => $paged,
                );
                $news = new WP_Query( $newsArgs );
            ?>

            <ul class="list-unstyled news-list row">
                <?php
                    while ( $news->have_posts() ) { 
                        $news->the_post(); 
                        global $post;
                        $newsDateDay = date_i18n("d", strtotime(get_field("news_date", $post->ID)));
                        $newsDateMonth = date_i18n("F", strtotime(get_field("news_date", $post->ID)));
                        $newsDateYear = date_i18n("Y", strtotime(get_field("news_date", $post->ID)));
                        $newsImage = get_field("news_image", $post->ID);
                        $newsShowImageInFull = get_field("show_image_in_read_more", $post->ID);
                        $newsReadMore = get_field("read_more_text", $post->ID);
                        $newsDisplay = get_field("news_display", $post->ID);
                        $newsContentLeft = get_field("left_column_text", $post->ID);
                        $newsContentRight = get_field("right_column_text", $post->ID);
                        $newsContentSingle = get_field("single_column_text", $post->ID);
                ?>
                        <li class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
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
                                            <small><?php echo $newsReadMore; ?></small>
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
            
            <!-- pagination here -->
            <?php
                if (function_exists(custom_pagination)) {
                    custom_pagination($news->max_num_pages, "", $paged);
                }
            ?>
            
        </div>
    </div>
</section>

<?php 
	get_footer();
?>