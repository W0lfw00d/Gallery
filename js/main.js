
$(function(){
	
	//Swiper options
	var options = {
		loop:true,
		grabCursor: true,
	}
	//Main Swiper
	var swiper1 = new Swiper('.swiper1', options);
	var swiper2 = new Swiper('.swiper2', options);
	var swiper3 = new Swiper('.swiper3', options);
	//Navigation arrows
	$('.swiper1 .arrow-left').click(function(e) {
        e.preventDefault()
		swiper1.swipePrev()
    });
	$('.swiper1 .arrow-right').click(function(e) {
        e.preventDefault()
		swiper1.swipeNext()
    });
	//Navigation arrows
	$('.swiper2 .arrow-left').click(function(e) {
        e.preventDefault()
		swiper2.swipePrev()
    });
	$('.swiper2 .arrow-right').click(function(e) {
        e.preventDefault()
		swiper2.swipeNext()
    });
})