$(document).ready(function(){

	//Swiper options
	var h_options = {
		loop:true,
		grabCursor: true,
		keyboardControl: true
	}
    //The main vertical page swiper
    var swiperN1=$('.v-swiper').swiper({slidesPerSlide:1,keyboardControl: true,grabCursor:true,mode:'vertical',mousewheelControl: true});

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