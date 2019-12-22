<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Course;
use Lang;
use Intervention\Image\Facades\Image;
class ImageController extends Controller
{
    public function index()
    {
        
    }

  
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $status_success = Lang::get('courses.SUCCESS');
        $status_error = Lang::get('courses.ERROR');
        $message_success = Lang::get('courses.MESSAGE_SUCCESS_UPLOAD');

        try {

            if($request->resource  == 'courses' ){
                $model=Course::findOrFail($request->resource_id) ;
            }else{
                $model=Category::findOrFail($request->resource_id) ;
            }

            $filename = basename($request->image);
            
            copy($request->image,storage_path('app/public/images/' . $filename));
            $model->image()->create(['url'=>$request->image,'file_name'=>$filename]);

            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'image' => $model->image]);

        } catch (\Throwable $th) {
            return response()->json([
                'status'=>$status_error,
                'message'=>$th]);
        }
       
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
