<?php

namespace App\Http\Controllers\API;

//Model Auth
use App\Company;
use App\User;
use App\FavouriteJob;

//Provider setting
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /*
    200, for success request
    201, for success creating
    */
    public $successStatus = 200;

    // GET COMPANY LOGO
    public function companyimage($id_company)
    {
      $company = Company::where('id','=',$id_company)->active()->first();
      $logo = (string)$company->logo;
      $logo = (!empty($logo))? $logo:'no-no-image.gif';
      // $src = (string)$company->printCompanyImage();
      // $src = \ImgUploader::print_image("company_logos/$logo", $width, $height, '/admin_assets/no-image.png', $company->name)
      // $src_arr = explode(" ",(string)$src);
      $path = "company_logos/$logo";
      $no_image_path = 'admin_assets/no-image.png';
      if(file_exists($path)){
        return response()->file($path);
      }else{
        return response()->file($no_image_path);
      }
      // return response()->json(['data'=>$logo]);

    }    
}
