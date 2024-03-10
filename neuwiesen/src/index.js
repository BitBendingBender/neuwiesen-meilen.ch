/** Import Stylesheet base. See webpack config. */
import 'normalize.css/normalize.css';
import 'swiper/swiper-bundle.css';
import './css/style.scss';

/** Import dependencies here */
import $ from 'jquery';
import Swiper from 'swiper';

/**
 * Global Object which is exposed to global window
 */
window.neuwiesen = new (function() {

    /**
     * This is the Constructor.
     * @constructor
     */
    var neuwiesen = function() {

        this.initAccordeons();
        this.initMisc();

    }

    /**
     * Add methods here, these are inheritable.
     */
    neuwiesen.prototype = {

        /**
         * Init function for Accordeons.
         */
        initAccordeons: function() {

            var $accordeons = $('.accordeon');

            // bail
            if(!$accordeons.length) return;

            $('.accordeon-head', $accordeons).on('click', function() {

                // first close others but this
                $('.accordeon-head', $accordeons).not($(this)).parent().removeClass('open').find('.accordeon-content').slideUp();

                $(this).parent().toggleClass('open').find('.accordeon-content').slideToggle();

            });

        },

        /**
         * Miscellanious stuff
         */
        initMisc: function() {

            $('a[href*="#"]').on('click', function(e) {

                if(hashChange($(this).attr('href'))) {
                    e.preventDefault();
                    return false;
                }

            });

            // on load, try to hashChange and scroll to position
            $(window).on('load', function () {

                hashChange(window.location.href);

                // if any element error or success defined, scroll to that elem parent section
                if($('.errors, .success').length > 0) {
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

        if(hrefString.indexOf('#') !== -1) {

            var hash = '#' + hrefString.split('#')[1];

            if(hash === '#') return;

            var $elem = $(hash);

            if($elem.length) {

                setTimeout(function() {

                    let offset = -$('.logo-header').outerHeight() - 30;

                    $('body, html').animate({scrollTop: $elem.offset().top + offset});
                    $('header').removeClass('open');

                    // if is accordeon head, click it
                    if($elem.hasClass('accordeon-head')) {
                        $elem.trigger('click');
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