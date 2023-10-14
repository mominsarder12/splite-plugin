

(function ($) {

    /**
     * 
     * @param {*} $scope 
     * @param {*} $ 
     * logo carousel settings dynamically
     */

    var logoCarousel = function ($scope, $) {
        var $_this = $scope.find('.carousel-class');
        var $currentID = '#' + $_this.attr('id'),
            $loop = $_this.data('loop'),
            $nav = $_this.data('nav'),
            $dots = $_this.data('dots'),
            $margin = $_this.data('margin');

        var owl = $($currentID);
        owl.owlCarousel({
            loop: $loop,
            margin: $margin,
            nav: $nav,
            dots: $dots,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
        })
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/logo_carousel.default', logoCarousel);
    });




})(jQuery);






