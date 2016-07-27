<?php
    $PostID = langsheng_current_language_post_id(35);
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
        section.portfolio h1.title {
            font-size: <?php echo $boldFont; ?>px;
            line-height: <?php echo $boldFont+6; ?>px;
        }
    </style>
<?php 
    }
    if ($paragraphFont) {
?>
    <style>
        section.portfolio p {
            font-size: <?php echo $paragraphFont; ?>px;
            line-height: <?php echo $paragraphFont+9; ?>px;
        }
    </style>
<?php 
    } 
?>

<!-- Portfolio Grid Section -->
<section id="section-portfolio" class="portfolio anchorTags" <?php echo $backgroundStyle ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
                <h1 class="title">
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
                    $thePostSubTitle = get_field("subtitle", $thePost->ID);
                    if($thePostSubTitle) {
                ?>
                        <h2><?php echo $thePostSubTitle; ?></h2>
                        <p>&nbsp;</p>
                <?php 
                    }
                ?>
                <?php echo apply_filters('the_content', $thePost->post_content); ?>
                <p class="visible hidden-xs">&nbsp;</p>
            </div>
        </div>

        <?php
            // Reset $post Data
            wp_reset_postdata();
            // Get Portfolios for In Page Display
            $portfolioArgs = array(
                'post_type' => 'portfolio_type',
                'posts_per_page' => -1,
                'suppress_filters' => 0,
                'orderby' => 'order',
                'order' => 'ASC',
            );
            $portfolioTypes = new WP_Query( $portfolioArgs );            
        ?>

        <div class="row">
            <?php 
                while ( $portfolioTypes->have_posts() ) { 
                    $portfolioTypes->the_post(); 
                    global $post; 
                    $portfolioImage = get_field("on_page_image", $post->ID);
            ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h3><?php echo $post->post_title; ?></h3>
                        <a href="#" class="portfolioItemOnPage" data-toggle="modal" data-target="#portfolio-<?php echo $post->post_name; ?>">
                            <img src="<?php echo $portfolioImage["url"]; ?>" class="image-full">
                            <div class="portfolioOverlay"><i class="fa fa-plus"></i></div>
                        </a>
                    </div>
            <?php 
                } 
            ?>
        </div>    
    </div>
</section>

<!-- Portfolio Modals -->
<?php
    
    // Reset $post Data
    wp_reset_postdata();
    // Get Portfolios for Modals
    $portfolioTypes = new WP_Query( $portfolioArgs );            
    while ( $portfolioTypes->have_posts() ) { 
        $portfolioTypes->the_post(); 
        global $post; 
        $portfolioBackground = get_field("background_image", $post->ID);
        $portfolioCompanies = get_field("portfolio_included_companies", $post->ID);
        if(is_array($portfolioCompanies) && count($portfolioCompanies)){
            usort($portfolioCompanies, function($a, $b) {
                return $a->menu_order > $b->menu_order;
            });
        }
        if($portfolioBackground) {
            $backgroundStyle = 'style="background-image: url(' . $portfolioBackground["url"] . ');"';
        } else {
            $backgroundStyle = "";
        }
?>
        <div class="portfolio-modal modal fade" id="portfolio-<?php echo $post->post_name; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="stickyBackground" <?php echo $backgroundStyle; ?>></div>
            <div class="modal-dialog" role="document">
                <div class="modal-content" <?php if($backgroundStyle != "") { echo 'style="background-color: transparent;"'; } ?> >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ion ion-android-close"></i></button>
                    <div class="modal-body">
                        <h1><?php echo $post->post_title; ?></h1>
                        <?php 
                            echo apply_filters('the_content', $post->post_content);
                            foreach($portfolioCompanies as $key => $company) {
                                $companyImage = get_field("company_image", $company->ID);
                                $companyLink = get_field("company_link", $company->ID);
                        ?>
                                <article class="clearfix">
                                    <h1>
                                        <a <?php echo ($companyLink != "") ? 'href="'. $companyLink . '" class="companyLinkText" target="_blank"' : 'class="companyLinkText"' ; ?>">
                                            <?php echo $company->post_title; ?>
                                        </a>
                                    </h1>
                                    <?php echo apply_filters('the_content', $company->post_content); ?>
                                    <a <?php echo ($companyLink != "") ? 'href="'. $companyLink . '" class="companyLinkImage" target="_blank"' : 'class="companyLinkImage"' ; ?>">
                                        <img src="<?php echo $companyImage["url"]; ?>" alt="<?php echo $company->post_title; ?>" class="image-full">
                                    </a>
                                </article>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>


