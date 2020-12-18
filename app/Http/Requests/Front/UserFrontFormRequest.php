<?php

namespace App\Http\Requests\Front;

use Auth;
use App\Http\Requests\Request;

class UserFrontFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = Auth::user()->id;
		$id_str = ',' . $id;
		$password = '';

        return [
            'first_name' => 'required',
            //'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email' . $id_str . '|email',
            'password' => $password,
            'father_name' => 'required',
            'date_of_birth' => 'required',
            'gender_id' => 'required',
            'marital_status_id' => 'required',
            'nationality_id' => 'required',
            'national_id_card_number' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'mobile_num' => 'required',
            'job_experience_id' => 'required',
            'career_level_id' => 'required',
            'industry_id' => 'required',
            'functional_area_id' => 'required',
            'current_salary' => 'required',
            'expected_salary' => 'required',
            'salary_currency' => 'required',
            'street_address' => 'required',
            'image' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('First Name is required'),
'middle_name.required' => __('Middle Name is required'),
'last_name.required' => __('Last Name is required'),
'email.required' => __('Email is required'),
'email.email' => __('The email must be a valid email address'),
'email.unique' => __('This Email has already been taken'),
'password.required' => __('Password is required'),
'password.min' => __('The password should be more than 3 characters long'),
'father_name.required' => __('Father Name is required'),
'date_of_birth.required' => __('Date of birth is required'),
'gender_id.required' => __('Please select gender'),
'marital_status_id.required' => __('Please select marital status'),
'nationality_id.required' => __('Please select nationality'),
'national_id_card_number.required' => __('National ID card# required'),
'country_id.required' => __('Please select country'),
'state_id.required' => __('Please select state'),
'city_id.required' => __('Please select city'),
'phone.required' => __('Please enter phone'),
'mobile_num.required' => __('Please enter mobile number'),
'job_experience_id.required' => __('Please select experience'),
'career_level_id.required' => __('Please select career level'),
'industry_id.required' => __('Please select industry'),
'functional_area_id.required' => __('Please select functional area'),
'current_salary.required' => __('Please enter current salary'),
'expected_salary.required' => __('Please enter expected salary'),
'salary_currency.required' => __('Please select salary currency'),
'street_address.required' => __('Please enter street address'),
'image.image' => __('Only images can be uploaded'),
        ];
    }

}
