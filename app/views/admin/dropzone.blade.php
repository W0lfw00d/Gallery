{{-- ajax upload form --}}
<div id="uploadForm" class="collapse">
	{{ Form::open(array('action' => 'ImageLibraryAdminController@postImage',
						'files'=>true, 'class'=>'dropzone','id'=>'galleryDropzone'
						)) }}
		{{ Form::hidden('uploadDir','galleryUploadDir',array('id'=>'uploadDir')) }}
		{{ Form::hidden('uploadType','gallery',array('id'=>'uploadType')) }}
		{{ Form::hidden('typeImgBaseDir',Request::root().$siteData['settings']['galleryUploadDir'],array('id'=>'galleryImgBaseDir')) }}
		{{ Form::hidden('typeImgBaseDir',Request::root().$siteData['settings']['backgroundUploadDir'],array('id'=>'backgroundImgBaseDir')) }}
		{{ Form::hidden('typeImgBaseDir',Request::root().$siteData['settings']['foregroundUploadDir'],array('id'=>'foregroundImgBaseDir')) }}
		{{ Form::hidden('typeImgBaseDir',Request::root().$siteData['settings']['logoUploadDir'],array('id'=>'logoImgBaseDir')) }}
	{{ Form::close() }}
</div>