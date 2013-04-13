$(function(){
	
	//Main Swiper
	var swiper = new Swiper('.swiper1', {
		loop:true,
		grabCursor: true
	});
	var swiper = new Swiper('.swiper2', {
		loop:true,
		grabCursor: true
	});
	//Navigation arrows
	$('.arrow-left').click(function(e) {
        e.preventDefault()
		swiper.swipePrev()
    });
	$('.arrow-right').click(function(e) {
        e.preventDefault()
		swiper.swipeNext()
    });
})