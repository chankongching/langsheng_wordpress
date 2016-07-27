<?php
    
    /* Template Name: One Page */

	get_header(); 
	
    get_template_part("themepart", "home");
    get_template_part("themepart", "about");
    get_template_part("themepart", "portfolio");
    get_template_part("themepart", "team");
    get_template_part("themepart", "general-news-holder");
	get_template_part("themepart", "contact");

	get_footer(); 
    
?>