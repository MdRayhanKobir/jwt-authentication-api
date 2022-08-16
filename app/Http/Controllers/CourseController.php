<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $id=auth()->user()->id;
        $data=User::find($id)->courses;

        return response()->json([
            'status'=>1,
            'message'=>'total courses information',
            'courses'=>$data
        ],200);

    }

    // delete course delete method api
    public function delete($id){

        $user_id=auth()->user()->id;
        if(Course::where(
            ['id'=>$id,
            'user_id'=>$user_id
            ])->exists()){

                $data=Course::find($id);
                $data->delete();

                return response()->json([
                        'status'=>1,
                        'message'=>'course successfully delete'
                ],200);

            }else{
                return response()->json([
                    'status'=>1,
                    'message'=>'course could not found'
                ],404);
            }

    }
}
