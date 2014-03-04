<div class="swiper-container v-swiper">
	<div class="swiper-wrapper">
		@foreach ($galleries as $gallery)
			<div class="swiper-slide">
				@include('gallery.horizontal')
			</div>
		@endforeach
	</div>
</div>

<div id="vertical-nav">
  <a class="arrow-up" href="#">&#9660;</a>
  <a class="arrow-down" href="#">&#9650;</a>
</div>
