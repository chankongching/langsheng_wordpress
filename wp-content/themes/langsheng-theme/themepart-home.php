<?php
	$PostID = langsheng_current_language_post_id(14);
	$thePost = get_post($PostID);

	$backgroundImage = "";
	$backgroundType = get_field("background_type", $thePost->ID);
	
	if($backgroundType == "image") {
		$backgroundImage = get_field("background_image", $thePost->ID);
	    if($backgroundImage) {
	       $backgroundStyle = 'style="background-image: url(' . $backgroundImage["url"] . ');"';
	    }
	} elseif($backgroundType == "slider") {
		$backgroundSlider = get_field("section_slider", $thePost->ID);
	}
	
?>

<!-- Header -->

<?php if($backgroundType == "image" || $backgroundType == "none") { ?>

	<?php 
		$boldFont = get_field("bold_font_size", $thePost->ID);
		$paragraphFont = get_field("paragraph_font_size", $thePost->ID);
		if ($boldFont) {
		
	?>
		<style>
			header h1 {
			    font-size: <?php echo $boldFont; ?>px;
			    line-height: <?php echo $boldFont+6; ?>px;
			}
		</style>
	<?php 
		}
		if ($paragraphFont) {
	?>
		<style>
			header p {
			    font-size: <?php echo $paragraphFont; ?>px;
			    line-height: <?php echo $paragraphFont+9; ?>px;
			}
		</style>
	<?php 
		} 
	?>

	<header id="section-home" class="anchorTags" <?php echo $backgroundStyle; ?>>
	    <div class="container">
	        <div class="row">
	        	<div class="col-md-8 col-sm-12 col-xs-12 col-xs-offset-0 pull-right text-left">
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
						$thePostSubTitle = get_field("subtitle", $thePost->ID);
						if($thePostSubTitle) {
					?>
				            <h2><?php echo $thePostSubTitle; ?></h2>
				            <p>&nbsp;</p>
				    <?php 
					    }
					?>
		            <?php echo apply_filters('the_content', $thePost->post_content); ?>
		        </div>
		    </div>
	    </div>
	</header>

<?php } elseif($backgroundType == "slider") { ?>
	
	<?php 
		$boldFont = get_field("bold_font_size", $thePost->ID);
		$paragraphFont = get_field("paragraph_font_size", $thePost->ID);
		if ($boldFont) {
		
	?>
		<style>
			header .sliderHolder .sliderCaptionHolder h1 {
			    font-size: <?php echo $boldFont; ?>px;
			    line-height: <?php echo $boldFont+6; ?>px;
			}
		</style>
	<?php 
		}
		if ($paragraphFont) {
	?>
		<style>
			header .sliderHolder .sliderCaptionHolder p {
			    font-size: <?php echo $paragraphFont; ?>px;
			    line-height: <?php echo $paragraphFont+9; ?>px;
			}
		</style>
	<?php 
		} 
	?>
	
	<header id="section-home" class="anchorTags">
	    <div class="sliderHolder" >
			<?php echo do_shortcode('[cycloneslider id="'. $backgroundSlider->post_name .'"]'); ?>
		</div>
	</header>

<?php } ?>







