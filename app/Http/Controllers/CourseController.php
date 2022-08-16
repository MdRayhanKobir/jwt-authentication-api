<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //post method api
    public function courseEnrollment(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'total_videos'=>'required'
        ]);
         $data=new Course();
         $data->user_id=auth()->user()->id;
         $data->title=$request->title;
         $data->description=$request->description;
         $data->total_videos=$request->total_videos;
         $data->save();
          return response()->json([
            'status'=>1,
            'message'=>'successfully course enrollment'
          ],200);

    }

    // GET method api
    public function totalCourse(){

    }

    // delete course delete method api
    public function delete($id){

    }
}
