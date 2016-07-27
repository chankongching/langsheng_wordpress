<?php 
	get_header(); 
?>

<!-- Default Page -->
<section id="contact" class="contact">
    <div class="container">
        <h1 class="title"><?php the_title(); ?></h1>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
				<?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php 
	get_footer(); 
?>