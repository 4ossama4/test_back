<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use Lang;
use App\Course;
use App\Image;
use File;
class CourseController extends Controller
{
    
    //-------get all courses --------
    public function index()
    {
        $status_success = Lang::get('courses.SUCCESS');
        $status_error = Lang::get('courses.ERROR');

        $message_success = Lang::get('courses.MESSAGE_SUCCESS');
        $message_error = Lang::get('courses.MESSAGE_ERROR');

        try {
            $courses=Course::with('category')->with('image')->paginate(10);

            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'courses' => $courses]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>$status_error,
                'message'=>$th,
                'courses' => null]);
        }
    }

   
    public function create()
    {}

    
      //--------- ADD Course -----------
    public function store(CourseRequest $request)
    {
        
        $status_success = Lang::get('courses.SUCCESS');
        $status_error = Lang::get('courses.ERROR');

        $message_success = Lang::get('courses.MESSAGE_STORE_CAT_SUCCESS');

        try {

            $course=new Course();
            $course->name = $request->name;
            $course->category_id = $request->category_id;
            $course->description = $request->description;
            $course->save();

            if($request->image){
                $filename = basename($request->image);
                copy($request->image,storage_path('app/public/images/' . $filename));
                $course->image()->create(['url'=>$request->image,'file_name'=>$filename]);
            }

            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'course' => $course]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>$status_error,
                'message'=>$th,
                'course' => null]);
        }
    }

    // ---------get course by slug--------
    public function show($slug)
    {
        $status_success = Lang::get('courses.SUCCESS');
        $status_error = Lang::get('courses.ERROR');

        $message_success = Lang::get('courses.MESSAGE_SUCCESS_SHOW');
        $message_error = Lang::get('courses.MESSAGE_ERROR_SHOW');

        try {
            $course=Course::where('slug',$slug)->with('category')->first();
            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'category' => $course]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>$status_error,
                'message'=>$message_error,
                'category' => null]);
        }
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $slug)
    {
        $status_success = Lang::get('courses.SUCCESS');
        $status_error = Lang::get('courses.ERROR');

        $message_success = Lang::get('courses.MESSAGE_UPDATE_CAT_SUCCESS');

        try {

            $Course=Course::where('slug',$slug)->first();
            $Course->name = $request->name;
            $Course->save();

            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'Course' => $Course]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>$status_error,
                'message'=>$th,
                'Course' => null]);
        }
    }

    // -------delete course ---------
    public function destroy($slug)
    {
        $status_success = Lang::get('courses.SUCCESS');
        $status_error = Lang::get('courses.ERROR');

        $message_success = Lang::get('courses.MESSAGE_DELETE_CAT_SUCCESS');

        try {

            $course=Course::where('slug',$slug)->first();
            $course->delete();


            $image=Image::where('imageable_id',$course->id)->first();
            
            if($image){
                $image->delete();

                //delete image 
                $image_path = storage_path('app/public/images/' . $image->file_name);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            

            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>$status_error,
                'message'=>$th]);
        }
    }



}
