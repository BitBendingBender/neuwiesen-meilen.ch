/** Import Stylesheet base. See webpack config. */
import 'normalize.css/normalize.css';
import 'swiper/swiper-bundle.css';
import './css/style.scss';

/** Import dependencies here */
import $ from 'jquery';
import Swiper from 'swiper/bundle';

/**
 * Global Object which is exposed to global window
 */
window.neuwiesen = new (function () {

    /**
     * This is the Constructor.
     * @constructor
     */
    var neuwiesen = function () {

        this.swipersToUpdate = [];

        this.initBlockSliderText();
        this.initBlockBildRaster();
        this.initAccordeons();
        this.initApartmentAccordions();
        this.initSectionAccordions();
        this.initMisc();

    }

    /**
     * Add methods here, these are inheritable.
     */
    neuwiesen.prototype = {

        initBlockSliderText() {

            let $modules = $('.block-slider-text');

            if (!$modules.length) return; // bail

            let _this = this;

            $modules.each(function () {

                let swiper = new Swiper($(this).find('.swiper').get(0), {
                    loop: true,
                    spaceBetween: 15,
                    slidesPerView: 1.1,
                    centeredSlides: true,
                    navigation: {
                        prevEl: $(this).find('.swiper-button-prev').get(0),
                        nextEl: $(this).find('.swiper-button-next').get(0),
                    },
                    breakpoints: {
                        768: {
                            spaceBetween: 20,
                            slidesPerView: 2,
                        }
                    }
                });

                _this.swipersToUpdate.push(swiper);

            });

        },

        initBlockBildRaster() {

            let $modules = $('.block-bild-raster');

            if (!$modules.length) return; // bail

            let _this = this;

            $modules.each(function () {

                let swiper = new Swiper($(this).find('.swiper').get(0), {
                    loop: true,
                    spaceBetween: 15,
                    slidesPerView: 1.1,
                    centeredSlides: true,
                    navigation: {
                        prevEl: $(this).find('.swiper-button-prev').get(0),
                        nextEl: $(this).find('.swiper-button-next').get(0),
                    },
                    breakpoints: {
                        768: {
                            loop: true,
                            slidesPerView: 2,
                            spaceBetween: 20,
                            centeredSlides: true,
                        },
                        1024: {
                            loop: false,
                            centeredSlides: false,
                            slidesPerView: 3,
                            spaceBetween: 20,
                        }
                    }
                });

                _this.swipersToUpdate.push(swiper);

            });

        },

        // TODO: Implement auto closing of other acc.
        initApartmentAccordions() {

            let $accordions = $('.apartment-accordion');

            if(!$accordions.length) return;

            $accordions.each(function() {

                let $accordion = $(this);

                $('.accordion-opener', this).on('click', function() {

                    if($accordion.hasClass('accordion-open')) {
                        $accordion.find('.accordion-content').stop().hide();
                        $accordion.removeClass('accordion-open');
                    } else {
                        $accordion.find('.accordion-content').stop().show();
                        $accordion.addClass('accordion-open');
                    }

                });

            });

        },

        /**
         * Init function for Accordeons.
         */
        initAccordeons: function () {

            var $accordeons = $('.accordeon');

            // bail
            if (!$accordeons.length) return;

            $('.accordeon-head', $accordeons).on('click', function () {

                // first close others but this
                $('.accordeon-head', $accordeons).not($(this)).parent().removeClass('open').find('.accordeon-content').slideUp(100);

                $(this).parent().toggleClass('open').find('.accordeon-content').slideToggle(100);

            });

        },

        /**
         * Init function for Accordeons.
         */
        initSectionAccordions: function () {

            let $accordions = $('.page-section');

            // bail
            if (!$accordions.length) return;

            let _this = this;

            $('.section-title', $accordions).on('click', function () {

                let _$this = $(this);

                // first close others but this
                $(this).parent().toggleClass('open').find('.outer-section-content').stop().slideToggle(200);

                // update swiper slides after displaying
                for(let i = 0; i < _this.swipersToUpdate.length; ++i) {
                    _this.swipersToUpdate[i].loopDestroy();
                    _this.swipersToUpdate[i].loopCreate();
                }

            });

        },

        /**
         * Miscellanious stuff
         */
        initMisc: function () {

            $('a[href*="#"]').on('click', function (e) {

                if (hashChange($(this).attr('href'))) {
                    e.preventDefault();
                    return false;
                }

            });

            // on load, try to hashChange and scroll to position
            $(window).on('load', function () {

                hashChange(window.location.href);

                // if any element error or success defined, scroll to that elem parent section
                if ($('.errors, .success').length > 0) {
                    $('body, html').animate({scrollTop: $('.errors, .success').first().parents('section').offset().top + (window.innerWidth < 786 ? -100 : -40)});
                }

            });

        }
    }

    /**
     * Little helping function that scrolls to gibven hrefString position
     * and closes menu if open.
     * @param hrefString
     * @returns {boolean}
     */
    function hashChange(hrefString) {

        if (hrefString.indexOf('#') !== -1) {

            var hash = '#' + hrefString.split('#')[1];

            if (hash === '#') return;

            var $elem = $(hash);

            if ($elem.length) {

                setTimeout(function () {

                    let offset = 0;

                    $('body, html').animate({scrollTop: $elem.offset().top + offset}, 100);

                    // if is accordeon head, click it
                    if ($elem.hasClass('accordeon-head')) {
                        $elem.trigger('click');
                    }

                    // if is accordeon head, click it
                    if ($elem.find('> .section-title').length) {
                        $elem.find('> .section-title').trigger('click');
                    }

                }, 5);

                return true;
            }
        }

        return false;
    }

    // return the main class
    return neuwiesen;

}());