<?php
    get_header();
?>

<!-- Default Page -->
<section class="newsList">
    <div class="container fullNewsHolder">
        <?php
            while ( have_posts() ) { 
                the_post(); 
                $newsDate = date_i18n("F d, Y", strtotime(get_field("news_date", $post->ID)));
                $newsImage = get_field("news_image", $post->ID);
                $newsShowImageInFull = get_field("show_image_in_read_more", $post->ID);
                $newsReadMore = get_field("read_more_text", $post->ID);
                $newsDisplay = get_field("news_display", $post->ID);
                $newsContentLeft = get_field("left_column_text", $post->ID);
                $newsContentRight = get_field("right_column_text", $post->ID);
                $newsContentSingle = get_field("single_column_text", $post->ID);
        ?>
                <div class="row fullNews">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1><?php echo $post->post_title; ?></h1>
                        <span class="date"><?php echo $newsDate; ?></span>
                        <div class="clearfix"></div>
                        <div class="row">
                            <?php if($newsDisplay == "two") { ?>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if($newsShowImageInFull) { ?>
                                        <img src="<?php echo $newsImage["url"]; ?>" alt="<?php echo $post->post_title; ?>" class="image-auto">
                                        <p>&nbsp;</p>
                                    <?php } ?>
                                    <?php echo apply_filters('the_content', $newsContentLeft); ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php echo apply_filters('the_content', $newsContentRight); ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php if($newsShowImageInFull) { ?>
                                        <div class="text-center">
                                            <img src="<?php echo $newsImage["url"]; ?>" alt="<?php echo $post->post_title; ?>" class="image-auto image-align-center">
                                        </div>
                                        <p>&nbsp;</p>
                                    <?php } ?>
                                    <?php echo apply_filters('the_content', $newsContentSingle); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
</section>

<?php 
	get_footer();
?>