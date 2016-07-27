<?php
    $PostID = langsheng_current_language_post_id(90);
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
        section.team h1.title {
            font-size: <?php echo $boldFont; ?>px;
            line-height: <?php echo $boldFont+6; ?>px;
        }
    </style>
<?php 
    }
    if ($paragraphFont) {
?>
    <style>
        section.team p {
            font-size: <?php echo $paragraphFont; ?>px;
            line-height: <?php echo $paragraphFont+9; ?>px;
        }
    </style>
<?php 
    } 
?>

<!-- Team Section -->
<section id="section-team" class="team anchorTags" <?php echo $backgroundStyle ?>>
    <div class="container">
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
            // Reset $post Data
            wp_reset_postdata();
            // Get Teams
            $teamArgs = array(
                'post_type' => 'team',
                'posts_per_page' => -1,
                'suppress_filters' => 0,
                'orderby' => 'order',
                'order' => 'ASC',
            );
            $teams = new WP_Query( $teamArgs );            
        
            while ( $teams->have_posts() ) { 
                $teams->the_post(); 
                global $post;
                $teamID = $post->ID;
        ?>
            <h3><?php echo $post->post_title; ?></h3>
            <div class="row">
                <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                    <div class="row">
                        <?php    
                            // Reset $post Data
                            wp_reset_postdata();
                            // Get Team Members
                            $teamMembersArgs = array(
                                'post_type' => 'team_member',
                                'posts_per_page' => -1,
                                'suppress_filters' => 0,
                                'meta_query'    => array(
                                    array(
                                        'key'       => 'member_belongs_to_team',
                                        'value'     => $teamID,
                                        'compare'   => 'LIKE',
                                    )
                                ),
                                'orderby' => 'order',
                                'order' => 'ASC',
                            );
                            $teamMembers = new WP_Query( $teamMembersArgs );
                            while ( $teamMembers->have_posts() ) { 
                                $teamMembers->the_post(); 
                                global $post;
                                $teamRole = get_field("team_member_role", $post->ID);
                                $teamImage = get_field("team_member_image", $post->ID);
                        ?>        
                                <div class="col-md-4 col-sm-4 col-xs-12 team-member" data-toggle="modal" data-target="#team-member-<?php echo $post->post_name; ?>">
                                    <div class="image imageBackgroundFix" style="background-image: url(<?php echo $teamImage["url"]; ?>);">
                                        <img src="<?php echo $teamImage["url"]; ?>" alt="<?php echo $post->post_title; ?>" class="image-auto">
                                    </div>
                                    <div class="clearfix"></div>
                                    <span><?php echo $post->post_title; ?><small><?php echo $teamRole; ?></small></span>
                                </div>
                        <?php 
                            }
                        ?>
                    </div>  
                </div>
            </div>
        <?php
            }
        ?>    
    </div>
</section>

<!-- Team Modals  -->
<?php    
    // Reset $post Data
    wp_reset_postdata();
    // Get Portfolios for In Page Display
    $teamMembersArgs = array(
        'post_type' => 'team_member',
        'posts_per_page' => -1,
        'suppress_filters' => 0,
        'orderby' => 'order',
        'order' => 'ASC',
    );
    $teamMembers = new WP_Query( $teamMembersArgs );
    while ( $teamMembers->have_posts() ) { 
        $teamMembers->the_post(); 
        global $post;
        $teamRole = get_field("team_member_role", $post->ID);
        $teamImage = get_field("team_member_image", $post->ID);
?>

        <div class="team-modal modal fade" id="team-member-<?php echo $post->post_name; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ion ion-android-close"></i></button>
                    <div class="modal-body">
                        <div class="image imageBackgroundFix" style="background-image: url(<?php echo $teamImage["url"]; ?>);">
                            <img src="<?php echo $teamImage["url"]; ?>" alt="<?php echo $post->post_title; ?>">
                        </div>
                        <h1><?php echo $post->post_title; ?></h1>
                        <span class="teamRole"><?php echo $teamRole; ?></span>
                        <?php echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

