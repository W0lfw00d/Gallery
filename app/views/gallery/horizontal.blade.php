<div class="gallery"> 
  <div class="gallery_wrapper"> 
      <div class="swiper-container h-swiper">
          <a class="arrow-left" href="#">&#9664;</a> 
          <a class="arrow-right" href="#">&#9654;</a>
          
          <div class="swiper-wrapper">

            @foreach ($gallery->slides as $slide)
             
              @if ($slide->contentType_id==1)
                {{-- TODO: check if file exists? --}}
                {{--@if(file_exists($siteData['settings']['galleryUploadDir'].'/large/'.$slide->content)) --}}
                  @include('gallery.imageSlide')
              @elseif ($slide->contentType_id==3)
                @include('gallery.videoSlide')
              @else
                @include('gallery.textSlide')
              @endif
             
            @endforeach
          </div>
      </div>
      @if ($gallery->caption != "")
        <section class="project_info">
            <div class="caption">
              <b>{{$gallery->caption}}</b>
            </div>
            <div class="info hide">
              <div class="info_content">
                <div class="text">
                  {{ $gallery->info }}
                </div>
              </div>
            </div>
            <div class="info_logo">
              {{ HTML::image('img/info.png') }}
            </div>
        </section>
        
      @endif
  </div>
  
</div>