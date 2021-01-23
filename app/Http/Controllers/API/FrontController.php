<?php

namespace App\Http\Controllers\API;

//Model and traits
use App\Job;
use App\Traits\FetchJobs;
use App\Company;
use App\FunctionalArea;
use App\Country;
use App\CountryDetail;

//Provider setting
use Auth;
use Validator;
use DataTables;
use Carbon\Carbon;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    /*
    200, for success request
    201, for success creating
    */
    public $successStatus = 200;

    public function JobbySearch(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'search'=>'required',
        ]);
      $search = $request->query('search', '');
		  $job_titles = $request->query('job_title', array());
		  $company_ids = $request->query('company_id', array());
		  $industry_ids = $request->query('industry_id', array());
		  $job_skill_ids = $request->query('job_skill_id', array());
		  $functional_area_ids = $request->query('functional_area_id', array());
		  $country_ids = $request->query('country_id', '');
		  $state_ids = $request->query('state_id', array());
	    $city_ids = $request->query('city_id', array());
		  $is_freelance = $request->query('is_freelance', array());
		  $career_level_ids = $request->query('career_level_id', array());
		  $job_type_ids = $request->query('job_type_id', array());
		  $job_shift_ids = $request->query('job_shift_id', array());
		  $gender_ids = $request->query('gender_id', array());
		  $degree_level_ids = $request->query('degree_level_id', array());
		  $job_experience_ids = $request->query('job_experience_id', array());
      $salary_from = $request->query('salary_from', '');
      $salary_to = $request->query('salary_to', '');
		  $salary_currency = $request->query('salary_currency', '');
      $is_featured = $request->query('is_featured', 2);
      $order_by = $request->query('order_by', 'id');
		  $limit = 10;

      $jobs = $this->fetchJobs($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, $order_by, $limit);

    	/*****************************************************/

    	$jobTitlesArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.title');

  		/****************************************************/

  		$jobIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.id');

  		/*****************************************************/

  		$skillIdsArray = $this->fetchSkillIdsArray($jobIdsArray);

  		/*****************************************************/

  		$countryIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.country_id');

  		/*****************************************************/

  		$stateIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.state_id');

  		/*****************************************************/

  		$cityIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.city_id');

  		/*****************************************************/

  		$companyIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.company_id');

  		/*****************************************************/

  		$industryIdsArray = $this->fetchIndustryIdsArray($companyIdsArray);

  		/*****************************************************/


  		/*****************************************************/

  		$functionalAreaIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.functional_area_id');

  		/*****************************************************/

  		$careerLevelIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.career_level_id');

  		/*****************************************************/

  		$jobTypeIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_type_id');

  		/*****************************************************/

  		$jobShiftIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_shift_id');

  		/*****************************************************/

  		$genderIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.gender_id');

  		/*****************************************************/

  		$degreeLevelIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.degree_level_id');

  		/*****************************************************/

  		$jobExperienceIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids,$functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_experience_id');

  		/*****************************************************/

  		$seoArray = $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids);

  		/*****************************************************/

      $currencies = DataArrayHelper::currenciesArray();

  		/*****************************************************/

      return response()->json([
        'jobs'=> $jobs,
        'success'=>$success
      ], 200);
    }
}
