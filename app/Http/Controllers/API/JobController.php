<?php

namespace App\Http\Controllers\API;

use App\Job;
use App\JobApply;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /*
    200, for success request
    201, for success creating
    */
    public $successStatus = 200;

    public function __construct()
    {

    }

    //CANDIDATE APPLYING JOB
    public function apply(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'job_slug'=>'required',
          'cv_id' => 'required',
          'current_salary' => 'required',
          'expected_salary' => 'required',
          'salary_currency' => 'required',
        ]);
      if ($validator->fails()) {
          return response()->json(['valid error'=>$validator->errors()], 401);
      }
      $id = Auth::user()->id;
      $job = Job::where('slug', 'like', $request->job_slug)->first();

      $jobApply = new JobApply();
      $jobApply->user_id = $id;
  		$jobApply->job_id = $job->id;
  		$jobApply->cv_id = $request->post('cv_id');
  		$jobApply->current_salary = $request->post('current_salary');
  		$jobApply->expected_salary = $request->post('expected_salary');
  		$jobApply->salary_currency = $request->post('salary_currency');
  		$jobApply->save();
      $success = 'Thank you!, successfully applied !';
      return response()->json(['success'=>$success], 201);
    }

    // CANDIDATE LISTING JOB APLICANT
    public function viewJobList()
    {
      $id = Auth::user()->id;
      return response()->json(['success'=>$success], $this->successStatus);
    }

    public function typename()
    {
      // code...
    }
}
