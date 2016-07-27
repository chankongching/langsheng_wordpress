<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    
    <head>

        <title>
            <?php 
                if ( is_category() ) { 
                    echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
                } elseif (is_front_page()) { 
                    bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );  
                } elseif ( is_tag() ) { 
                    echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
                } elseif ( is_archive() ) { 
                    wp_title(''); echo ' Archive | '; bloginfo( 'name' );
                } elseif ( is_search() ) { 
                    echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
                } elseif ( is_home() ) { 
                    bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
                }  elseif ( is_404() ) { 
                    echo 'Error 404 Not Found | '; bloginfo( 'name' );
                } elseif ( is_single() ) { 
                    echo wp_title(''); echo ' | '; bloginfo( 'description' ); 
                } else { 
                    echo wp_title(''); echo ' | '; bloginfo( 'description' ); 
                }
            ?>
        </title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php bloginfo('template_url'); ?>/images/favicon.png" rel="shortcut icon">

        <?php 
            $currentSiteLanguage = apply_filters('wpml_current_language', NULL);
            if($currentSiteLanguage != ""){
                echo '<script> var currentLanguage = "' . $currentSiteLanguage . '"; </script>';
            }
        ?>

        <?php 
            wp_head(); 
        ?>
    </head>
    
    <?php 
        $homePageID = langsheng_current_language_post_id(6, 'page'); 
    ?>
    <body class="index <?php echo $currentSiteLanguage; ?>">

        <?php get_template_part("themepart", "navigation"); ?>
        