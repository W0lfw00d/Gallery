<?php

use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;


class ImageLibraryAdminController extends AdminController {

    private $imagine;

    public function __construct()
    {
        parent::__construct();
        $this->imagine = new \Imagine\Gd\Imagine();
    }

    public function index()
    {

        return "nothing to see here";
    }

    //save a new image
    public function postImage()
    {
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );
     
        $validation = Validator::make($input, $rules);
     
        if ($validation->fails())
        {
            return Response::make($validation->errors->first(), 400);
        }

        $file = Input::file('file');
        $uploadDir = Input::get('uploadDir');
        $filename = $file->getClientOriginalName();
        $directory = public_path().$this->settings[$uploadDir];
        $uploadSuccess = Input::file('file')->move($directory, $filename);

        if( $uploadSuccess ) {
            $this->resize($directory, $filename, "thumb");
            $this->resize($directory, $filename, "small");
            $this->resize($directory, $filename, "medium");
            $this->resize($directory, $filename, "large");
            return Response::json($filename, 200);
        } else {
            return Response::json('error'.$debug, 400);
        }
    }

    /*
    *   This resizes a image and save it in it's type directory
    *   TODO: make this better...
    */
    private function resize($directory, $filename, $type) {

        $this->imagine = new \Imagine\Gd\Imagine();
        $image = $this->imagine->open($directory.'/'.$filename);
        switch ($type) {
            case 'thumb':
                $resizedImg = $image->thumbnail(new Imagine\Image\Box(100, 100));
                $resizedImg->save($directory.'/thumb/'.$filename);
                break;
            case 'small':
                $resizedImg = $image->thumbnail(new Imagine\Image\Box(400, 400));
                $resizedImg->save($directory.'/small/'.$filename);
                break;
            case 'medium':
                $resizedImg = $image->thumbnail(new Imagine\Image\Box(750, 750));
                $resizedImg->save($directory.'/medium/'.$filename);
                break;
            case 'large':
                $resizedImg = $image->thumbnail(new Imagine\Image\Box(1200, 1200));
                $resizedImg->save($directory.'/large/'.$filename);
                break;
            default:
                break;
        }
    }


    public function destroy(){

    }
}