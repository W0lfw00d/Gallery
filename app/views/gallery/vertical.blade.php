<div class="swiper-container v-swiper">
	<div class="swiper-wrapper">
		@foreach ($galleries as $gallery)
			<div class="swiper-slide">
				@include('gallery.horizontal')
			</div>
		@endforeach
	</div>
</div>