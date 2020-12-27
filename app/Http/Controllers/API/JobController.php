<?php

namespace App\Http\Controllers\API;


//Model Auth
use App\Job;
use App\JobApply;
use App\FavouriteJob;

//Provider setting
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

    // CANDIDATE FAVORITE THE JOB
    public function favoritingJob(Request $request)
    {

      $validator = Validator::make($request->all(), [
          'job_slug'=>'required',
        ]);
      if ($validator->fails()) {
          return response()->json(['valid error'=>$validator->errors()], 401);
      }

      $data['job_slug'] = $request->job_slug;
      $data['user_id'] = Auth::user()->id;
      $data_save = FavouriteJob::create($data);

      $success = 'Job has been added in favorites list';
      return response()->json(['success'=>$success], 201);
    }

    //VIEWING APLLICANTS JOB
    public function viewAplliedJob(Request $request)
    {
      $myAppliedJobIds = Auth::user()->getAppliedJobIdsArray();
  		$jobs = Job::whereIn('id', $myAppliedJobIds)-get();

      return response()->json(['success'=>$jobs], $this->successStatus);
    }
}
