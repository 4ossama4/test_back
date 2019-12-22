<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

//----models----
use App\Category;
use App\Image;
use Lang;
use File;
class CategoryController extends Controller
{

    //---- ---- get all categories--------
    public function index()
    {

        $status_success = Lang::get('categories.SUCCESS');
        $status_error = Lang::get('categories.ERROR');

        $message_success = Lang::get('categories.MESSAGE_SUCCESS');
        $message_error = Lang::get('categories.MESSAGE_ERROR');

        try {
            $categories=Category::with('image')->paginate(10);
            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'categories' => $categories]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>$status_error,
                'message'=>$message_error,
                'categories' => null]);
        }
        
    }

    
    public function create(){}

    //--------- ADD Category -----------
    public function store(CategoryRequest $request)
    {
        $status_success = Lang::get('categories.SUCCESS');
        $status_error = Lang::get('categories.ERROR');

        $message_success = Lang::get('categories.MESSAGE_STORE_CAT_SUCCESS');

        try {

            $category=new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'category' => $category]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>$status_error,
                'message'=>$th,
                'category' => null]);
        }
        
    }

    
    //---- ---- get  category by slug--------
    public function show($slug)
    {

        $status_success = Lang::get('categories.SUCCESS');
        $status_error = Lang::get('categories.ERROR');

        $message_success = Lang::get('categories.MESSAGE_SUCCESS_SHOW');
        $message_error = Lang::get('categories.MESSAGE_ERROR_SHOW');

        try {
            $category=Category::where('slug',$slug)->first();
            
            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'category' => $category]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>$status_error,
                'message'=>$th,
                'category' => null]);
        }
    }

    
    public function edit($id){}

    
    public function update(Request $request,$slug)
    {
        $status_success = Lang::get('categories.SUCCESS');
        $status_error = Lang::get('categories.ERROR');

        $message_success = Lang::get('categories.MESSAGE_UPDATE_CAT_SUCCESS');

        try {

            $category=Category::where('slug',$slug)->first();
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'status'=>$status_success,
                'message'=>$message_success,
                'category' => $category]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>$status_error,
                'message'=>$th,
                'category' => null]);
        }
    }

    // -----------delete category-------
    public function destroy($slug)
    {
        $status_success = Lang::get('categories.SUCCESS');
        $status_error = Lang::get('categories.ERROR');

        $message_success = Lang::get('categories.MESSAGE_DELETE_CAT_SUCCESS');

        try {

            $category=Category::where('slug',$slug)->first();
            $category->delete();

            $image=Image::where('imageable_id',$category->id)->first();
            $image->delete();

            //delete image 
            $image_path = storage_path('app/public/images/' . $image->file_name);
            if(File::exists($image_path)) {
                File::delete($image_path);
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
