$(document).ready(function(){

    //toggles the display of the extra information text
    $('.info_logo').click(function(){
        var parent = $(this).parent();
        parent.find('.info').fadeToggle();
        var captionText = parent.find('.caption');
        captionText.toggleClass('invisible');
        if( captionText.hasClass('invisible') ) {
            //loop through all the scrollbars to reinit them
            //TODO: only call 'resizeFix()' on the current scrollbar/swiper
            for (var i = infoScrollbars.length - 1; i >= 0; i--) {
                infoScrollbars[i].resizeFix();
            };
        }
    });

	//Swiper options
	var h_options = {
		loop:true,
		grabCursor: true,
		keyboardControl: true
	};

    var infoScrollbars = new Array();
    $('.swiper-text-scroll').each(function(){
        var current = $(this);
        var tsw = current.swiper( {
                        //Text scroll/swiper options
                        scrollContainer:true,
                        mousewheelControl : true,
                        mode:'vertical',
                        //Enable Scrollbar
                        scrollbar: {
                          //pass the scrollbar as  jquery object or it will only get the first in the DOM
                          container: current.find('.swiper-scrollbar'),
                          hide: true,
                          draggable: false
                        }
                    });
        //collect all the scrollswipers to resize them when you actually show them
        infoScrollbars[infoScrollbars.length] = tsw;
    });

    //The main vertical page swiper
    var swiperN1 = $('.v-swiper').swiper( {
                                            slidesPerSlide:1,
                                            keyboardControl: true,
                                            preventLinks: false,
                                            grabCursor:true,
                                            mode:'vertical',
                                            mousewheelControl: true
                                        });
    //add actions to the up/down buttons
    $('.arrow-down').click(function(e) {
        e.preventDefault();
        swiperN1.swipePrev();
    });
    $('.arrow-up').click(function(e) {
        e.preventDefault();
        swiperN1.swipeNext();
    });

    //All horizontal gallery swipers
    $('.h-swiper').each(function(){
        var current = $(this);
        var sw = current.swiper( h_options );
        current.find('.arrow-left').click(function(e) {
            e.preventDefault();
            sw.swipePrev();
        });
        current.find('.arrow-right').click(function(e) {
            e.preventDefault();
            sw.swipeNext();
        });
    });

});

/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT / GPLv2 License.*/
(function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),k=Math.abs(l.z),(!a.orientation||a.orientation===180)&&(i>7||(k>6&&j<8||k<8&&j>6)&&i>5)?h&&n():h||m()}var b=navigator.userAgent;if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1))return;var c=a.document;if(!c.querySelector)return;var d=c.querySelector("meta[name=viewport]"),e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0,i,j,k,l;if(!d)return;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)})(this);
