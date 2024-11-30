<?php
require_once '../include/DbHandler.php';
require '.././libs/Slim/Slim.php';
require_once '../include/PHPMailer/class.phpmailer.php';
// require '.././libs/phpmailer';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

function authenticate(\Slim\Route $route) {
  // Getting request headers
  $headers = apache_request_headers();
  $response = array();
  $app = \Slim\Slim::getInstance();

  // Verifying Authorization Header
  if (isset($headers['authorization'])) {
    $db = new DbHandler();

    // get the api key
    $api_key = $headers['authorization'];
    // validating api key
    if (!$db->isValidApiKey($api_key)) {
      // api key is not present in users table
      $response["error"] = true;
      $response["message"] = "Access Denied. Invalid Api key";
      echoRespnse(401, $response);
      $app->stop();
    } else {
      global $user_id;
      // get user primary key id
      $user_id = $db->getUserId($api_key);
    }
  } else {
    // api key is missing in header
    $response["error"] = true;
    $response["message"] = "Api key is misssing";
    echoRespnse(400, $response);
    $app->stop();
  }
}

/**
* ----------- METHODS WITHOUT AUTHENTICATION ---------------------------------
*/


$app->post('/Login', function() use ($app) {

  verifyRequiredParams(array('user_email', 'password'));

  $email = $app->request()->post('user_email');
  $password = $app->request()->post('password');
  // $user_path = 'http://knorr.adaxiomdemo.com/images/';
  $response = array();

  $db = new DbHandler();
  // check for correct email and password
  $result = $db->checkLogin($email, $password);
  if ($result['id']!='') {
    // get the user by email
    // $user = $db->getUserByEmail_1($email,$recipe_id);

    $response["error"] = false;// restaurant_id
    $response['message'] = 'Login successfully';
    $response['id'] = $result['id'];
    $response['user_email'] = $email;
    // $response['password'] = $password;
    $response['role'] = $result['role_name'];

  } else {
    $response['error'] = true;
    $response['message'] = 'Login failed. Incorrect credentials';
  }
  echoRespnse(200, $response);
});





$app->post('/Signup', function() use ($app) {
  verifyRequiredParams(array('user_email', 'password','user_role'));
  $user_email = trim($app->request()->post('user_email'),'"');
  $password = trim($app->request()->post('password'),'"');
  $user_role = trim($app->request()->post('user_role'),'"');
  // if($_FILES["image_1"]["name"]!=NULL)
  //
  // 	{
  //                  $image_1 = uniqid().time().rand().'.'.pathinfo($_FILES["image_1"]["name"], PATHINFO_EXTENSION);
  //
  // $temp_name = $_FILES["image_1"]["tmp_name"];
  //
  // 		$upload  = move_uploaded_file($temp_name,'../images/'.$image_1);
  //
  //
  //                     }
  $response = array();
  $db = new DbHandler();
  $result = $db->sign_up($user_email, $password,$user_role);

  if ($result['id'] != '') {
    $response['id'] = $result['id'];
    $response["error"] = false;
    $response["message"] = "You are successfully registered Information";
  }

  else if ($result == USER_CREATE_FAILED) {
    $response["error"] = true;
    $response["message"] = "Oops! An error occurred while registereing Information";
  } else if ($result == FALSE) {
    $response["error"] = true;
    $response["message"] = "Sorry, this Information already existed";
  }
  echoRespnse(200, $response);
});





// Get All Roles

$app->get('/Categories'  , function() use ($app){
  $db = new DbHandler();
  $response = array();
  $rawQuery = $db->get_cat();

  while($result = $rawQuery->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['name'] = $result['category_name'];
    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Data Found';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});





// Get All Roles

$app->get('/Roles'  , function() use ($app){
  // $user_path = 'http://knorr.adaxiomdemo.com/images/';
  // $recipe_path = 'http://knorr.adaxiomdemo.com/recipe_images/';
  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->get_roles();
  //echoRespnse(200,$campaign_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['role_name'] = $result['role_name'];
    array_push($response,$tmp);

  }

  if($response!=NULL){
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }else{
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Role Available';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});






// Get All Cities

$app->get('/Countries'  , function() use ($app){
  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->get_countries();

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['country_name'] = $result['country_name'];
    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    // sendEmail();
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Country Available';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});





// Get All Cities

$app->get('/Cities'  , function() use ($app){
  // $user_path = 'http://knorr.adaxiomdemo.com/images/';
  // $recipe_path = 'http://knorr.adaxiomdemo.com/recipe_images/';
  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->get_cities();
  //echoRespnse(200,$campaign_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['city_name'] = $result['city_name'];
    $tmp['region_id'] = $result['region_id'];
    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No City Available';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});





// Get Company Profile status

$app->get('/ComProfileStatus/:com_id'  , function($com_id) use ($app){
  $db = new DbHandler();
  $response= array();
  $user_id = $db->get_com_profile_status($com_id);

  while($result = $user_id->fetch_assoc()){
    // $tmp = array();

    $tmp['status'] = $result['status'];
    $response = $tmp;

  }

  if($response!=NULL){
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['status'] = $tmp['status'];
    echoRespnse(200,$output);
  }
  else
  {
    // $tmp = array();
    $output['error'] = true;
    $output['message'] = 'Something went wrong while getting profile status';
    // array_push($response,$tmp);
    echoRespnse(200,$output);
  }
});





// Get Candidate Profile status

$app->get('/CanProfileStatus/:user_id'  , function($user_id) use ($app){
  $db = new DbHandler();
  $response= array();
  $user_id = $db->get_cand_profile_status($user_id);

  while($result = $user_id->fetch_assoc()){

    $tmp['status'] = $result['status'];
    $response = $tmp;

  }

  if($response!=NULL){
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['status'] = $tmp['status'];
    echoRespnse(200,$output);
  }
  else
  {
    // $tmp = array();
    $output['error'] = true;
    $output['message'] = 'Something went wrong while getting profile status';
    // array_push($response,$tmp);
    echoRespnse(200,$output);
  }
});






// Get All Jobs

$app->get('/AllJobs'  , function() use ($app){
  // $user_path = 'http://knorr.adaxiomdemo.com/images/';
  // $recipe_path = 'http://knorr.adaxiomdemo.com/recipe_images/';
  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->get_all_jobs();
  //echoRespnse(200,$campaign_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['title'] = $result['title'];
    $tmp['description'] = $result['description'];
    $tmp['career'] = $result['career'];
    $tmp['no_of_postions'] = $result['no_of_postions'];
    $tmp['experience'] = $result['experience'];
    $tmp['address'] = $result['address'];
    $tmp['start_time'] = $result['start_time'];
    $tmp['end_time'] = $result['end_time'];
    $tmp['date_time'] = $result['date_time'];
    $tmp['approve'] = $result['approve'];
    $tmp['type'] = $result['type'];

    $tmp['category'] = $result['category_name'];
    $tmp['city'] = $result['city_name'];
    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Role Available';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});




$app->post('/PostNewJob', function() use ($app) {

  verifyRequiredParams(array('company_id', 'title','description','category','career',
  'no_of_postions','city','experience','address','start_time','end_time','date_time','approve','type'));

  $company_id = $app->request()->post('company_id');
  $title = $app->request()->post('title');
  $description = $app->request()->post('description');
  $category = $app->request()->post('category');
  $career = $app->request()->post('career');
  $no_of_postions = $app->request()->post('no_of_postions');
  $city = $app->request()->post('city');
  $experience = $app->request()->post('experience');
  $address = $app->request()->post('address');
  $start_time = $app->request()->post('start_time');
  $end_time = $app->request()->post('end_time');
  $date_time = $app->request()->post('date_time');
  $approve = $app->request()->post('approve');
  $type = $app->request()->post('type');


  $response = array();
  $db = new DbHandler();

  $result = $db->post_new_job($company_id, $title,$description,$category,$career,$no_of_postions,$city,
$experience,$address,$start_time,$end_time,$date_time,$approve,$type);

  if ($result == TRUE) {
    $response["error"] = false;
    $response["message"] = "Posted Job Successfully";
  } else if ($result == FALSE) {
    $response["error"] = true;
    $response["message"] = "Something went wrong";
  }
  echoRespnse(200, $response);
});





// Get All Jobs

$app->get('/ComJobs/:com_id'  , function($com_id) use ($app){
  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->get_com_jobs($com_id);
  //echoRespnse(200,$campaign_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['company_id'] = $result['company_id'];
    $tmp['title'] = $result['title'];
    $tmp['description'] = $result['description'];
    $tmp['career'] = $result['career'];
    $tmp['no_of_postions'] = $result['no_of_postions'];
    $tmp['experience'] = $result['experience'];
    $tmp['address'] = $result['address'];
    $tmp['start_time'] = $result['start_time'];
    $tmp['end_time'] = $result['end_time'];
    $tmp['date_time'] = $result['date_time'];
    $tmp['approve'] = $result['approve'];
    $tmp['type'] = $result['type'];

    $tmp['category'] = $result['category_name'];
    $tmp['city'] = $result['city_name'];
    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $output['error'] = true;
    $output['message'] = 'No Data Found';
    // $output['data'] = $response;
    echoRespnse(200,$output);
  }
});





// Get Company PROFILE

$app->get('/ComProfile/:com_id'  , function($com_id) use ($app){

$image_path = 'http://aesands.com/aess/sservices/DIR/images/';

  $db = new DbHandler();
  $response = array();
  $user_id = $db->get_com_profile($com_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['user_id'] = $result['user_id'];
    $tmp['company_logo'] = $result['company_logo'];
    if($result['company_logo']!=''){$tmp['company_logo'] = $image_path.$result['company_logo'];}else{$tmp['company_logo'] ="";}
    $tmp['company_name'] = $result['company_name'];
    $tmp['mail'] = $result['c_mail'];
    $tmp['phone'] = $result['c_phone'];
    $tmp['website'] = $result['c_website'];
    $tmp['team_size'] = $result['c_team_size'];
    $tmp['about_company'] = $result['c_about_company'];
    $tmp['address'] = $result['c_address'];
    $tmp['status'] = $result['status'];

    $tmp['city'] = $result['city_name'];
    $tmp['country'] = $result['country_name'];
    $response = $tmp;

  }
  if($response != NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $output['error'] = true;
    $output['message'] = 'Please update your profile first';
    // $output['data'] = $response;
    echoRespnse(200,$output);
  }
});




// Get Category Jobs

$app->get('/CatJobs/:cat_id'  , function($cat_id) use ($app){
  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->get_cat_jobs($cat_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['title'] = $result['title'];
    $tmp['description'] = $result['description'];
    $tmp['career'] = $result['career'];
    $tmp['no_of_postions'] = $result['no_of_postions'];
    $tmp['experience'] = $result['experience'];
    $tmp['address'] = $result['address'];
    $tmp['start_time'] = $result['start_time'];
    $tmp['end_time'] = $result['end_time'];
    $tmp['date_time'] = $result['date_time'];
    $tmp['approve'] = $result['approve'];
    $tmp['type'] = $result['type'];

    $tmp['category'] = $result['category_name'];
    $tmp['city'] = $result['city_name'];
    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    // $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Data Found';
    // array_push($response,$tmp);
    echoRespnse(200,$tmp);
  }
});




// Get All User Jobs

$app->get('/AppliedJobs/:user_id'  , function($user_id) use ($app){

  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->all_user_jobs($user_id);
  //echoRespnse(200,$campaign_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['id'] = $result['id'];
    $tmp['user_id'] = $result['user_id'];
    $tmp['job_id'] = $result['job_id'];
    $tmp['short_list'] = $result['short_list'];

    // $tmp['id'] = $result['id'];
    $tmp['title'] = $result['title'];
    $tmp['description'] = $result['description'];
    $tmp['career'] = $result['career'];
    $tmp['no_of_postions'] = $result['no_of_postions'];
    $tmp['experience'] = $result['experience'];
    $tmp['address'] = $result['address'];
    $tmp['start_time'] = $result['start_time'];
    $tmp['end_time'] = $result['end_time'];
    $tmp['date_time'] = $result['date_time'];
    $tmp['approve'] = $result['approve'];
    $tmp['type'] = $result['type'];

    $tmp['category'] = $result['category_name'];
    $tmp['city'] = $result['city_name'];

    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    // $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Data Found';
    // array_push($response,$tmp);
    echoRespnse(200,$tmp);
  }
});




// Apply Job

$app->post('/ApplyJob', function() use ($app) {

  verifyRequiredParams(array('user_id', 'job_id','short_list'));

  $user_id = $app->request()->post('user_id');
  $job_id = $app->request()->post('job_id');
  $short_list = $app->request()->post('short_list');


  $response = array();
  $db = new DbHandler();

  $result = $db->apply_job($user_id, $job_id,$short_list);

  if ($result == TRUE) {
    $response["error"] = false;
    $response["message"] = "Successfully applied for this job";
  } else if ($result == FALSE) {
    $response["error"] = true;
    $response["message"] = "You already applied for this job";
  }
  echoRespnse(200, $response);
});





// Post Employee Profile

$app->post('/UpdateEmpProfile', function() use ($app) {

  verifyRequiredParams(array('user_id','category_id','first_name','last_name',
  'gender','birth_date','address','town','country','post_code','email','phone','birth_city',
  'nationality','insurance_no','e_contact_name',
  'e_contact_relation','e_contact_phone','badge_type','badge_number','badge_expiry',
  'bank_sort_code','account_number','name_of_account','utr_number','visa_required',
  'uk_driving_licence','status'
  ));

  $user_id = $app->request()->post('user_id');
  $category_id = $app->request()->post('category_id');
  // $c_mail = $app->request()->post('profile_pic');
  $first_name = $app->request()->post('first_name');
  $last_name = $app->request()->post('last_name');
  $gender = $app->request()->post('gender');
  $birth_date = $app->request()->post('birth_date');
  $address = $app->request()->post('address');
  $town = $app->request()->post('town');
  $country = $app->request()->post('country');
  $post_code = $app->request()->post('post_code');
  $email = $app->request()->post('email');
  $phone = $app->request()->post('phone');
  $birth_city = $app->request()->post('birth_city');
  $nationality = $app->request()->post('nationality');
  $insurance_no = $app->request()->post('insurance_no');
  // $c_country = $app->request()->post('passport_pic');
  // $c_city = $app->request()->post('utilitybill_pic');
  // $c_address = $app->request()->post('resident_pic');
  $e_contact_name = $app->request()->post('e_contact_name');
  $e_contact_relation = $app->request()->post('e_contact_relation');
  $e_contact_phone = $app->request()->post('e_contact_phone');
  $badge_type = $app->request()->post('badge_type');
  $badge_number = $app->request()->post('badge_number');
  $badge_expiry = $app->request()->post('badge_expiry');
  // $c_about_company = $app->request()->post('badge_pic');
  $bank_sort_code = $app->request()->post('bank_sort_code');
  $account_number = $app->request()->post('account_number');
  $name_of_account = $app->request()->post('name_of_account');
  $utr_number = $app->request()->post('utr_number');
  $visa_required = $app->request()->post('visa_required');
  $uk_driving_licence = $app->request()->post('uk_driving_licence');
  $status = $app->request()->post('status');

  if($_FILES["profile_pic"]["name"]!=NULL)
  {
    $profile_pic = uniqid().time().rand().'.'.pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
    $temp_name = $_FILES["profile_pic"]["tmp_name"];
    $upload  = move_uploaded_file($temp_name,'../images/'.$profile_pic);
  }

  if($_FILES["passport_pic"]["name"]!=NULL)
  {
    $passport_pic = uniqid().time().rand().'.'.pathinfo($_FILES["passport_pic"]["name"], PATHINFO_EXTENSION);
    $temp_name = $_FILES["passport_pic"]["tmp_name"];
    $upload  = move_uploaded_file($temp_name,'../images/'.$passport_pic);
  }
  if($_FILES["utilitybill_pic"]["name"]!=NULL)
  {
    $utilitybill_pic = uniqid().time().rand().'.'.pathinfo($_FILES["utilitybill_pic"]["name"], PATHINFO_EXTENSION);
    $temp_name = $_FILES["utilitybill_pic"]["tmp_name"];
    $upload  = move_uploaded_file($temp_name,'../images/'.$utilitybill_pic);

  }
  if($_FILES["resident_pic"]["name"]!=NULL)
  {
    $resident_pic = uniqid().time().rand().'.'.pathinfo($_FILES["resident_pic"]["name"], PATHINFO_EXTENSION);
    $temp_name = $_FILES["resident_pic"]["tmp_name"];
    $upload  = move_uploaded_file($temp_name,'../images/'.$resident_pic);

  }
  if($_FILES["badge_pic"]["name"]!=NULL)
  {
    $badge_pic = uniqid().time().rand().'.'.pathinfo($_FILES["badge_pic"]["name"], PATHINFO_EXTENSION);
    $temp_name = $_FILES["badge_pic"]["tmp_name"];
    $upload  = move_uploaded_file($temp_name,'../images/'.$badge_pic);

  }


  $response = array();
  $db = new DbHandler();

  $result = $db->emp_profile($user_id,$category_id,$profile_pic,$first_name,$last_name,
  $gender,$birth_date,$address,$town,$country,$post_code,$email,$phone,$birth_city,
  $nationality,$insurance_no,$passport_pic,$utilitybill_pic,$resident_pic,$e_contact_name,
  $e_contact_relation,$e_contact_phone,$badge_type,$badge_number,$badge_expiry,$badge_pic,
  $bank_sort_code,$account_number,$name_of_account,$utr_number,$visa_required,
  $uk_driving_licence,$status);

  if ($result == TRUE) {
    $response["error"] = false;
    $response["message"] = "Successfully updated profile";
  } else if ($result == FALSE) {
    $response["error"] = true;
    $response["message"] = "Something went wrong";
  }
  echoRespnse(200, $response);
});












// Post Company Profile

$app->post('/UpdateComProfile', function() use ($app) {

  verifyRequiredParams(array('user_id','company_name',
  'c_mail','c_phone','c_website','c_team_size'
  ,'c_about_company','c_country','c_city','c_address','status'));

  $user_id = $app->request()->post('user_id');
  // $job_id = $app->request()->post('company_logo');
  $company_name = $app->request()->post('company_name');
  $c_mail = $app->request()->post('c_mail');
  $c_phone = $app->request()->post('c_phone');
  $c_website = $app->request()->post('c_website');
  $c_team_size = $app->request()->post('c_team_size');
  $c_about_company = $app->request()->post('c_about_company');
  $c_country = $app->request()->post('c_country');
  $c_city = $app->request()->post('c_city');
  $c_address = $app->request()->post('c_address');
  $status = $app->request()->post('status');

  if($_FILES["company_logo"]["name"]!=NULL)
  {
    $company_logo = uniqid().time().rand().'.'.pathinfo($_FILES["company_logo"]["name"], PATHINFO_EXTENSION);
    $temp_name = $_FILES["company_logo"]["tmp_name"];
    $upload  = move_uploaded_file($temp_name,'../images/'.$company_logo);

  }


  $response = array();
  $db = new DbHandler();

  $result = $db->com_profile($user_id,$company_name,$company_logo,$c_mail,$c_phone,$c_website,$c_team_size
  ,$c_about_company,$c_country,$c_city,$c_address,$status);

  if ($result == TRUE) {
    $response["error"] = false;
    $response["message"] = "Successfully updated profile";
  } else if ($result == FALSE) {
    $response["error"] = true;
    $response["message"] = "Something went wrong";
  }
  echoRespnse(200, $response);
});









// Get All Assigned Employee for any job

$app->get('/AllAssEmp/:job_id'  , function($job_id) use ($app){

$image_path = 'http://aesands.com/aess/sservices/DIR/images/';

  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $user_id = $db->all_assigned_emp($job_id);
  //echoRespnse(200,$campaign_id);

  while($result = $user_id->fetch_assoc())
  {
    $tmp = array();

    $tmp['user_id'] = $result['user_id'];
    $tmp['job_id'] = $result['job_id'];
    $tmp['profile_pic'] = $result['profile_pic'];
    if($result['profile_pic']!=''){$tmp['profile_pic'] = $image_path.$result['profile_pic'];}else{$tmp['profile_pic'] ="";}
    $tmp['first_name'] = $result['first_name'];
    $tmp['last_name'] = $result['last_name'];
    $tmp['gender'] = $result['gender'];
    $tmp['birth_date'] = $result['birth_date'];
    $tmp['address'] = $result['address'];
    $tmp['post_code'] = $result['post_code'];
    $tmp['email'] = $result['email'];
    $tmp['phone'] = $result['phone'];
    $tmp['insurance_no'] = $result['insurance_no'];
    $tmp['city_name'] = $result['city_name'];
    $tmp['country_name'] = $result['country_name'];
    $tmp['nationality'] = $result['nationality'];
    $tmp['category_name'] = $result['category_name'];

    array_push($response,$tmp);

  }
  if($response!=NULL)
  {
    $output['error'] = false;
    $output['message'] = 'Data Found';
    $output['data'] = $response;
    echoRespnse(200,$output);
  }
  else
  {
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'No Data Found';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});







// Simple Post Api

$app->post('/checkin', function() use ($app) {
  // check for required params
  verifyRequiredParams(array('time', 'imei',));

  // reading post params
  //$userInfo =  $app->request->post();

  $time = $app->request()->post('time');
  $imei = $app->request()->post('imei');

  $response = array();

  $db = new DbHandler();
  // check for correct email and password
  $db->checkIn($time, $imei);
  // get the user by email
  //  $user = $db->getUserByEmail_1($user_name);

  if ($db == TRUE) {
    $response["error"] = false;
    $response["message"] = "You are successfully Check In";
  } else if ($db == USER_CREATE_FAILED) {
    $response["error"] = true;
    $response["message"] = "Oops! An error occurred while registereing Information";
  } else if ($db == USER_ALREADY_EXISTED) {
    $response["error"] = true;
    $response["message"] = "Sorry, this Information already existed";
  }
  // echo json response
  echoRespnse(201, $response);
});

// end




//push Notification

$app->post('/push_notification', function() use ($app){
  verifyRequiredParams(array('query_id'));
  $response = array();
  $query_id = $app->request->post('query_id');
  $db = new DbHandler();
  $result = $db->send_notification($query_id);
  //echoRespnse(200,$result);
  if($result==true)
  {
    $response['error'] = false;
    $response['message'] = "MESSAGE SENT SUCCESSFULLY";
    echoRespnse(200,$response);
  }
  else
  {
    $response['error'] = false;
    $response['message'] = "INVALID  EMAIL";
    echoRespnse(200,$response);
  }
});

$app->get('/city'  , function() use ($app){

  $db = new DbHandler();
  $response = array();
  $date_array = array();
  $city_id = $db->city();
  //echoRespnse(200,$campaign_id);

  while($result = $city_id->fetch_assoc())
  {
    $tmp = array();
    $tmp['error'] = false;
    $tmp['id'] = $result['id'];
    $tmp['city_name'] = $result['city_name'];
    array_push($response,$tmp);


  }

  if($response!=NULL)
  {
    echoRespnse(200,$response);
  }
  else
  {
    $tmp = array();
    $tmp['error'] = true;
    $tmp['message'] = 'STILL NO CITY';
    array_push($response,$tmp);
    echoRespnse(200,$response);
  }
});




function sendEmail(){
  $this->load->library('phpmailer_lib');
  // PHPMailer object
  $mail = $this->phpmailer_lib->load();

  // SMTP configuration
  $mail->isSMTP();
  $mail->Host = 'mail.aegiseagles.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'career@aegiseagles.com';
  $mail->Password = 'y[eq^1oRPgDp';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;


  $mail->setfrom('career@aegiseagles.com', 'Aess Support');
  //$mail->addreplyto('no-reply@example.com', 'noreply');

  // Add a recipient
  $mail->addAddress('fazal.rasool@adsells.biz');
  //
  // // Add cc or bcc
  // $mail->addcc('cc@example.com');
  // $mail->addbcc('bcc@example.com');

  // Email subject
  $mail->Subject = 'Requested Password';

  // Set email format to HTML
  // $mail->isHTML(true);

  // Email body content
  $mailContent = "Requested Approval
  Your New Password is: "."";
  $mail->Body = $mailContent;

  // Send email
  if(!$mail->send()){
    echo 'Message could not be sent.';
    return 'Mailer Error: ' . $mail->ErrorInfo;
  }else{
    return 'Message has been sent';
  }
}






/*** Verifying required params posted or not */

function verifyRequiredParams($required_fields) {
  $error = false;
  $error_fields = "";
  $request_params = array();
  $request_params = $_REQUEST;
  // Handling PUT request params
  if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $app = \Slim\Slim::getInstance();
    parse_str($app->request()->getBody(), $request_params);
  }
  foreach ($required_fields as $field) {
    if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
      $error = true;
      $error_fields .= $field . ', ';
    }
  }

  if ($error) {
    // Required field(s) are missing or empty
    // echo error json and stop the app
    $response = array();
    $app = \Slim\Slim::getInstance();
    $response["error"] = true;
    $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
    echoRespnse(400, $response);
    $app->stop();
  }
}

function get_current_url() {

  $protocol = 'http';
  if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
    $protocol .= 's';
    $protocol_port = $_SERVER['SERVER_PORT'];
  } else {
    $protocol_port = 80;
  }

  $host = $_SERVER['HTTP_HOST'];
  $port = $_SERVER['SERVER_PORT'];
  $request = $_SERVER['PHP_SELF'];
  $query = isset($_SERVER['argv']) ? substr($_SERVER['argv'][0], strpos($_SERVER['argv'][0], ';') + 1) : '';

  $toret = $protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . dirname($request . (empty($query) ? '' : '?' . $query)).'/';

  return $toret;
}

/**
* Echoing json response to client
* @param String $status_code Http response code
* @param Int $response Json response
*/
function echoRespnse($status_code, $response) {
  $app = \Slim\Slim::getInstance();
  // Http response code
  $app->status($status_code);

  // setting response content type to json
  $app->contentType('application/json');

  echo json_encode($response);
}


$app->run();

?>
