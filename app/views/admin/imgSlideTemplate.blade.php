<div class="hide">
	{{-- prototype for slides --}}
	<li class="swap" id='imgSlideTemplate'>
	    <a href='#' class='thumbnail center-this'>
	        {{ HTML::image($siteData['settings']['galleryUploadDir'].'/thumb') }}
	    </a>
	    <input type='hidden' name='SlideId[]' value=''/>
	    <input type='hidden' name='slideContent[]' value=''/>
	    <input type='hidden' name='slideType[]' value='1'/>
	</li>
</div>