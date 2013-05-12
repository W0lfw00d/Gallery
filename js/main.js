
$(function(){
	
	//Swiper options
	var h_options = {
		loop:true,
		grabCursor: true,
		keyboardControl: true
	}
	//Main Swiper
	/*
	
	var swiper1 = new Swiper('.swiper1', h_options);
	var swiper2 = new Swiper('.swiper2', h_options);
	var swiper3 = new Swiper('.swiper3', h_options);
	*/
	//Navigation arrows
	/*
	  $('.swiper1 .arrow-left').click(function(e) {
        e.preventDefault()
		swiper1.swipePrev()
    });
	$('.swiper1 .arrow-right').click(function(e) {
        e.preventDefault()
		swiper1.swipeNext()
    });
	$('.swiper2 .arrow-left').click(function(e) {
        e.preventDefault()
		swiper2.swipePrev()
    });
	$('.swiper2 .arrow-right').click(function(e) {
        e.preventDefault()
		swiper2.swipeNext()
    });
	$('.swiper3 .arrow-left').click(function(e) {
        e.preventDefault()
		swiper3.swipePrev()
    });
	$('.swiper3 .arrow-right').click(function(e) {
        e.preventDefault()
		swiper3.swipeNext()
    });
	*/
var swiperN1=$('.v-swiper').swiper({slidesPerSlide:1,keyboardControl: true,grabCursor:true,mode:'vertical',mousewheelControl: true});
//var swiperN2=$('.h-swiper').swiper(h_options);
	$('.h-swiper').each(function(){
		$(this).swiper( h_options );
/*		
		var current = $(this);
		sw = current.swiper( h_options );
		current.find('.arrow-left').click(function(e) {
			e.preventDefault()
			sw.swipePrev()
		});
		current.find('.arrow-right').click(function(e) {
			e.preventDefault()
			sw.swipeNext()
		});
*/
	})
})
