jQuery(document).ready(function($) {

    //Cyclone Slider Background Fix
    if ($('.cycloneslider').length > 0) {
        $('.cycloneslider .cycloneslider-slide').each(function(index, el) {
            var slideImage = $(this).find('img');
            var imageLink = slideImage.attr("src");
            $(this).css('background-image', "url('" + imageLink + "')");
            slideImage.remove();
            var theSlideCaption = $(this).find(".cycloneslider-caption");
            if (theSlideCaption.length > 0) {
                var captionTitle = $(this).find(".cycloneslider-caption-title").html();
                var captionText = $(this).find(".cycloneslider-caption-description").html();
                var theCaptionContainer = $('<div class="container"><div class="row"></div></div></div>');
                var colSize = (currentLanguage == "zh-hans") ? "col-md-7 col-sm-12 col-xs-12 " : "col-md-8 col-sm-12 col-xs-12 ";
                var theCol = $('<div class="' + colSize + 'col-xs-offset-0 pull-right text-left sliderCaptionHolder">');
                theCol.append(captionTitle).append("<p></p>");
                theCol.find("p").append(captionText);
                theCaptionContainer.find(".row").append(theCol);
                $(this).append(theCaptionContainer);
                $(this).find(".cycloneslider-caption").remove();
            }
        });
    }

    // Handle the sticky menu background/style
    if ($(window).scrollTop() > 10) {
        $('.navbar.navbar-default').addClass("navbar-shrink");
    }

    $(window).scroll(function() {
        if ($(this).scrollTop() > 10) {
            $('.navbar.navbar-default').addClass("navbar-shrink");
        } else {
            $('.navbar.navbar-default').removeClass("navbar-shrink");
        }
    });

    // Check if it is the home page
    var isHomePage = $("#section-home").length > 0;

    if(isHomePage) {

        // Detect and report animation of scroll
        var isAnimating = false;
        var sectionsTab;
        var resizeTimer;

        function handleMenuSelection(theHash) {
            var menuHolder = $(".nav.navbar-nav");
            var currentActiveMenuItem = menuHolder.find("li.active > a");
            var targetActiveMenuItem = menuHolder.find("li > a[href*='" + theHash + "']");
            if(currentActiveMenuItem != targetActiveMenuItem){
                currentActiveMenuItem.parent("li").removeClass('active');
                targetActiveMenuItem.parent("li").addClass('active');
                $(".nav.navbar-nav > li > a").trigger('blur');
            }
        }

        function calculateSections(){
            sectionsTab = [];
            $('.anchorTags').each(function (index, el) {
                var oneAnchorObject = {};
                oneAnchorObject.top = $(this).offset().top;
                oneAnchorObject.bottom = $(this).offset().top + $(this).height();
                oneAnchorObject.hash = "#" + $(this).attr('id').split("-")[1];
                sectionsTab.push(oneAnchorObject);
            }); 
        }

        // Handle Continuity For Translation Links
        function handleTranslateLinkContinuity () {
            var originalHash = window.location.hash;
            if(originalHash != "") {
                var originalLink = $(".langSwitcherLink:first").attr('href');
                if(originalLink.indexOf("#") != -1){
                    originalLink = originalLink.split("#")[0];
                    $(".langSwitcherLink").attr('href', originalLink + originalHash);
                } else {
                    $(".langSwitcherLink").attr('href', originalLink + originalHash);
                }
            }
        }
        
        // On page load first call
        handleTranslateLinkContinuity();
        // First load call
        calculateSections();
        
        // jQuery for page scrolling feature - requires jQuery Easing plugin
        $('a.page-scroll').on('click', function(event) {
            var $anchor = $(this);
            if($anchor.attr('href').indexOf("#") != -1) {
                var elementID = $anchor.attr('href').split("#")[1];
                var targetElement = $("#section-" + elementID);
                if(targetElement.length > 0){
                    event.preventDefault();
                    handleMenuSelection("#" + elementID);
                    isAnimating = true;
                    $('html, body').stop().animate({
                        scrollTop: targetElement.offset().top - 40,
                    }, 1500, 'easeInOutExpo', function(){
                        window.location.hash = elementID;
                        isAnimating = false;
                    });
                }
            }
        });

        if(window.location.hash != ""){
            $(".nav.navbar-nav li > a[href*='" + window.location.hash + "']").trigger('click');
        }

        // Handle hash on scroll
        var currentHash = window.location.hash;
        $(document).scroll(function () {
            if(!isAnimating) {
                var currentPosition = window.pageYOffset + 200;
                $.each(sectionsTab, function(index, oneAnchor) {
                    if (currentPosition > oneAnchor.top && currentPosition < oneAnchor.bottom && currentHash != oneAnchor.hash) {
                        window.location.hash = oneAnchor.hash;
                        currentHash = oneAnchor.hash;
                    }
                });
            }
        });

        $(window).on('resize', function(event) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function(){
                // Adjust sections height calculation
                calculateSections();
            }, 600);
        });

        $(window).on("hashchange", function(event){
            event.preventDefault();
            handleTranslateLinkContinuity();
            handleMenuSelection(window.location.hash);
        });

    }

    // jQuery for next / previous news links
    $('a.nextPrevNewsLinks').on('click', function(event) {
        var $anchor = $(this);
        var newModalId = $anchor.attr("href");
        $(".news-modal").modal('hide');
        setTimeout(function() { 
            $(newModalId).modal('show');
        }, 1000);
        $('.news-modal').modal('handleUpdate');
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').on("click", function() {
        $('.navbar-toggle:visible').trigger("click");
    });

});