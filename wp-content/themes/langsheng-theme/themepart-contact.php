<?php
    $PostID = langsheng_current_language_post_id(120);
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
        section.contact h1.title {
            font-size: <?php echo $boldFont; ?>px;
            line-height: <?php echo $boldFont+6; ?>px;
        }
    </style>
<?php 
    }
    if ($paragraphFont) {
?>
    <style>
        section.contact p {
            font-size: <?php echo $paragraphFont; ?>px;
            line-height: <?php echo $paragraphFont+9; ?>px;
        }
    </style>
<?php 
    } 
?>

<!-- Contact Section -->
<section id="section-contact" class="contact anchorTags" <?php echo $backgroundStyle ?>>
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
            $thePostSubTitle = get_field("subtitle", $thePost->ID);
            if($thePostSubTitle) {
                echo apply_filters('the_content', $thePostSubTitle);
            }
        ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo apply_filters('the_content', $thePost->post_content); ?>
            </div>
        </div>
    </div>
</section>