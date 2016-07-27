<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
	<ul class="lang list-unstyled visible hidden-xs">
        <?php echo langsheng_custom_language_switcher(); ?>
    </ul>
    <div class="container">
        <?php
            $menuItems = wp_get_nav_menu_items(2);
            $homePageID = langsheng_current_language_post_id(6, 'page');
            $homeUrl = get_permalink($homePageID);
        ?>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><i class="fa fa-bars"></i></button>
            <a class="navbar-brand page-scroll" href="<?php echo $homeUrl; ?>#home"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Logo"></a>
        </div>
        <?php 
            if($menuItems) { 
        ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            foreach ($menuItems as $key=>$menuItem) {
                                if(is_page($homePageID)){
                                    $homeActive = 'class="active"';
                                    $newsActive = "";
                                } else if(strpos($menuItem->url, "news")) {
                                    $newsActive = 'class="active"';
                                    $homeActive = "";
                                } else {
                                    $newsActive = "";
                                    $homeActive = "";
                                }
                                if($menuItem->url == "#home") {
                                    echo '<li ' . $homeActive . '>';
                                    echo     '<a class="page-scroll visible" href="' . $homeUrl . '#home"><i class="fa fa-home"></i></a>';
                                    echo '</li>';
                                } elseif(strpos($menuItem->url, "#") === false) {
                                    echo '<li><a href="' . $menuItem->url . '" target="_blank">' . $menuItem->title . '</a></li>';
                                } else {
                                    echo '<li '. $newsActive .'><a class="page-scroll" href="' . $homeUrl . $menuItem->url . '">' . $menuItem->title . '</a></li>';
                                } 
                            }
                        ?>
                        <li class="hidden visible-xs">
                            <ul class="dropdown">
                                <li><strong>Language:</strong></li>
                                <?php echo langsheng_custom_language_switcher(); ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
        <?php 
            } 
        ?>
    </div>
    <!-- /.container-fluid -->
</nav>