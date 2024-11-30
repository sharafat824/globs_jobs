<?php
date_default_timezone_set("Asia/Karachi");
require_once '../include/DbHandler.php';
require '.././libs/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// define('IMAGE_PATH', 'http://localhost/ocando/apis/Image/');
// define('USER_IMAGE_PATH', 'http://localhost/ocando/apis/Image/User/');
define('IMAGE_PATH', 'https://jobsglob.com/ocando/apis/Image/');
define('USER_IMAGE_PATH', 'https://jobsglob.com/ocando/apis/Image/User/');

function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    // Verifying Authorization Header
    if (isset($headers['Authorization']) && isset($headers['user_id'])) {
        $db = new DbHandler();

        // get the api key
        $api_key = $headers['Authorization'];
        $user_id = $headers['user_id'];
        // validating api key
        if (!$db->isValidApiKey($api_key,$user_id)) {
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Api key or User ID";
            echoRespnse(403, $response);
            $app->stop();
        } else {
            
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Authorization or user_id missing";
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * ----------- METHODS WITHOUT AUTHENTICATION ---------------------------------
 */
$app->get('/test', function() use ($app) {
    $response = array();
    $db = new DbHandler();
        $response["error"] = false;
        $response['message'] = "Test successfull";
        echoRespnse(200, $response);
});
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ Register API $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ 
$app->post('/register', function() use ($app) {
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('email','phone_no','password'));

    $first_name = $app->request->post('first_name');
    $last_name = $app->request->post('last_name');

    $email = $app->request->post('email');
    $checkEmail = $db->checkEmail($email);
    if($checkEmail['user_id'] != ""){
        $response['error'] = true;
        $response['message'] = 'Email already exists';
        return echoRespnse(409, $response);
    }
    $phone_no = $app->request->post('phone_no');
    $checkPhone = $db->checkPhone($phone_no);
    if($checkPhone['user_id'] != ""){
        $response['error'] = true;
        $response['message'] = 'Phone number already exists';
        return echoRespnse(409, $response);
    }
    $fcm_token = $app->request->post('fcm_token');

    $otp_code = 123456;

    $password = $app->request->post('password');
    if (strlen($password) < 4) {
        $response['error'] = true;
        $response['message'] = 'Password should contain at least 4 characters';
        return echoRespnse(400, $response);
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $api_key = md5(uniqid(rand(), true));

    $mainArray = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "phone_no" => $phone_no,
        "fcm_token" => $fcm_token,
        "otp_code" => $otp_code,
        "password" => $hashedPassword,
        "api_key" => $api_key,
        "role" => "user",
        "created_date_time" => date('Y-m-d H:i:s')
    );

    $user = $db->registerUser($mainArray);
    // print_r($user);exit;
    if ($user != NULL) {
        unset($user['password']);
        $response["error"] = false;
        $response['message'] = "User Registered Successfully";
        $response['user_data'] = $user;
        echoRespnse(201, $response);
    }
    else {
    $response['error'] = true;
    $response['message'] = 'Registeration failed.';
    echoRespnse(400, $response);
    }
});
$app->post('/verify_otp', function() use ($app) {
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('otp_code','phone_no'));

    $otp_code = $app->request->post('otp_code');
    $phone_no = $app->request->post('phone_no');

    $checkOTP = $db->checkOTP($otp_code,$phone_no);
    if($checkOTP['user_id'] == ""){
        $response['error'] = true;
        $response['message'] = 'Incorrect OTP';
        return echoRespnse(404, $response);
    }else{
        $update = $db->updateOTPCode(0,$phone_no,1);
        if($update['message'] == "success"){
            $userData = $db->fetchUser($phone_no);
            $response["error"] = false;
            $response['message'] = "OTP verified successfully";
            unset($userData['password']);
            $response['user_data'] = $userData;
            echoRespnse(200, $response);
        }else{
            $response['error'] = true;
            $response['message'] = 'Something went wrong';
            $response['user_data'] = array();
            return echoRespnse(400, $response);
        }
         
    }
    
});
$app->post('/resend_otp', function() use ($app) {
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('phone_no'));

    $phone_no = $app->request->post('phone_no');
    $otp_code = "654321";
    $update = $db->updateOTPCode($otp_code,$phone_no,0);

    if($update['message'] == "success"){
        $response["error"] = false;
        $response['message'] = "OTP resent successfully";
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'Something went wrong';
        return echoRespnse(400, $response);
    }
    
});
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ LOGIN API $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ 
$app->post('/login', function() use ($app) {
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('email', 'password'));

    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $fcm_token = $app->request->post('fcm_token');

    $password_check = $db->getloginDetails($email);
    $success_password = password_verify($password,$password_check['password']);
    if($success_password){
        $check_password=$password_check['password'];
    }
    else{
        $check_password="";
    }
    $deactivateArray = [];
    $userData = $db->getlogin($email,$check_password,$fcm_token);
    if($password_check['status'] == 1){
        $deactivateArray = array(
            "id"=>$userData['id'],
            "api_key"=>$userData['api_key'],
            "status"=>$userData['status']
        );
        $response['error'] = true;
        $response['message'] = 'Account Deactivated!';
        $response['user_data'] = $deactivateArray;
        echoRespnse(200, $response);
    }
    elseif ($password_check == NULL) {
        $response['error'] = true;
        $response['message'] = 'Email not found.';
        echoRespnse(404, $response);
    }
    else if($password_check['verification'] != 1){
        $response['error'] = true;
        $response['message'] = 'Unauthorized. OTP Verification Required.';
        unset($userData['password']);
        $response['user_data'] = $userData;
        echoRespnse(401, $response);  
    }
    else if ($userData != NULL) {
      $response["error"] = false;
      $response['message'] = "Login Successfully.";
      unset($userData['password']);
      $response['user_data'] = $userData;   
      echoRespnse(200, $response);
    }
    else {
     $response['error'] = true;
     $response['message'] = 'Login failed. Incorrect credentials';
     echoRespnse(404, $response);
    }
});

$app->post('/profile_edit','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('first_name','last_name','address'));

    $user_id = $headers['user_id'];
    $first_name = $app->request->post('first_name');
    $last_name = $app->request->post('last_name');
    $address = $app->request->post('address');
    $postal_code = $app->request->post('postal_code');

    $checkUser = $db->checkUser($user_id);

    $old_password = $app->request->post('old_password');
    $new_password = $app->request->post('new_password');
    $confirm_password = $app->request->post('confirm_password');
    if(!empty($old_password)){
        $success_password = password_verify($old_password,$checkUser['password']);
        if(!$success_password){
            $response['error'] = true;
            $response['message'] = 'Incorrect Old Password';
            return echoRespnse(400, $response);
        }else{
            if($new_password != $confirm_password){
                $response['error'] = true;
                $response['message'] = 'New Password do not match.';
                return echoRespnse(400, $response);
            }else{
                if (!preg_match("/^[a-zA-Z0-9]{4,}$/", $new_password)) {
                    $response['error'] = true;
                    $response['message'] = 'Password validation failed. Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
                    return echoRespnse(400, $response);
                }else{
                    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                }
            }
        }
    }

    //IMAGE 
    $output_dir = "../Image/User/";
        
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if ($extension == "jpg" || $extension == 'jpeg' || $extension == 'png') {
            $imageName = uniqid().time().rand().'.'.$extension;
            move_uploaded_file($_FILES["image"]["tmp_name"],$output_dir.$imageName);
            if(!empty($hashedPassword)){
                $mainArray = array(
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,
                    "postal_code" => $postal_code,
                    "password" => $hashedPassword,
                    "image_path" => USER_IMAGE_PATH.$imageName,
                    "user_id"=>$user_id
                );
                $update = $db->updateUserEmailPassword($mainArray);
            }else{
                $mainArray = array(
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,
                    "postal_code" => $postal_code,
                    "image_path" => USER_IMAGE_PATH.$imageName,
                    "user_id"=>$user_id
                );
                $update = $db->updateUserEmail($mainArray);
            }

        } else {
            $response['error'] = true;
            $response['message'] = 'Invalid Image type only PNG, JPG and JPEG allowed';
            return echoRespnse(403, $response);
        }
    }else{
        if(!empty($hashedPassword)){
            $mainArray = array(
                "first_name" => $first_name,
                "last_name" => $last_name,
                "address" => $address,
                "postal_code" => $postal_code,
                "password" => $hashedPassword,
                "user_id"=>$user_id
            );
            $update = $db->updateUserPassword($mainArray);
        }else{
            $mainArray = array(
                "first_name" => $first_name,
                "last_name" => $last_name,
                "address" => $address,
                "postal_code" => $postal_code,
                "user_id"=>$user_id
            );
            $update = $db->updateUser($mainArray);
        }
    }

    if($update['message'] == "success"){
        $getUser = $db->checkUser($user_id);
        $response["error"] = false;
        $response['message'] = "Profile updated Successfully";
        unset($getUser['password']);
        $response['user_data'] = $getUser;
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'Something went wrong';
        return echoRespnse(400, $response);
    }
});

$app->post('/email_verification','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    $user_id = $headers['user_id'];

    $checkUser = $db->checkUser($user_id);

    $otp = rand(100000, 999999);

    $message = "Your OTP is : ".$otp;

    $sendMail = $db->send_email($checkUser['email'],'Email Verification',$message);
    if($sendMail){
        $mainArray = array(
            "email_verify_otp" => $otp,
            "user_id"=>$user_id
        );
        $update = $db->updateUserEmailOTP($mainArray);
        $response["error"] = false;
        $response['message'] = "Email sent successfully";
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'Something went wrong';
        return echoRespnse(400, $response);
    }
});

$app->post('/email_otp_verification','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('otp_code'));

    $user_id = $headers['user_id'];
    $otp_code = $app->request->post('otp_code');

    $checkUser = $db->checkUser($user_id);

    if($checkUser['email_verify_otp'] == $otp_code){
        $mainArray = array(
            "email_verify_otp" => 0,
            "email_verification" => 1,
            "user_id"=>$user_id
        );
        $update = $db->updateEmailOTPVerification($mainArray);
        $response["error"] = false;
        $response['message'] = "Email verified successfully";
        $userData = $db->checkUser($user_id);
        unset($userData['password']);
        $response['user_data'] = $userData;
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'OTP does not match.';
        return echoRespnse(404, $response);
    }
});

$app->post('/email_change','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();
    $user_id = $headers['user_id'];
    verifyRequiredParams(array('email'));
    
    $email = $app->request->post('email');

    $checkEmail = $db->checkEmail($email);
    if($checkEmail['user_id'] != ""){
        $response['error'] = true;
        $response['message'] = 'Email already exists';
        return echoRespnse(409, $response);
    }

    $otp = rand(100000, 999999);

    $message = "Your OTP is : ".$otp;

    $sendMail = $db->send_email($email,'Email Verification',$message);
    if($sendMail){
        $mainArray = array(
            "email_verify_otp" => $otp,
            "user_id"=>$user_id
        );
        $update = $db->updateUserEmailOTP($mainArray);
        $response["error"] = false;
        $response['message'] = "OTP sent successfully for email change.";
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'Something went wrong';
        return echoRespnse(400, $response);
    }
});

$app->post('/email_change_otp','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('otp_code','email'));

    $user_id = $headers['user_id'];
    $otp_code = $app->request->post('otp_code');
    $email = $app->request->post('email');

    $checkUser = $db->checkUser($user_id);

    if($checkUser['email_verify_otp'] == $otp_code){
        $mainArray = array(
            "email_verify_otp" => 0,
            "email_verification" => 1,
            "email" =>$email,
            "user_id"=>$user_id
        );
        $update = $db->updateChangeEmailOTP($mainArray);
        $response["error"] = false;
        $response['message'] = "Email changed successfully";
        $userData = $db->checkUser($user_id);
        unset($userData['password']);
        $response['user_data'] = $userData;
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'OTP does not match.';
        return echoRespnse(404, $response);
    }
});
$app->post('/forgot_password', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();
    
    verifyRequiredParams(array('email'));
    
    $email = $app->request->post('email');

    $checkEmail = $db->checkEmailForgot($email);

    $otp = rand(100000, 999999);

    $message = "Your OTP is : ".$otp;

    $sendMail = $db->send_email($checkEmail['email'],'Password Change Verification',$message);
    if($sendMail){
        $mainArray = array(
            "email_verify_otp" => $otp,
            "email"=>$checkEmail['email']
        );
        $update = $db->updateUserEmailForgotOTP($mainArray);
        $response["error"] = false;
        $response['message'] = "OTP sent successfully for password change.";
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'Something went wrong';
        return echoRespnse(400, $response);
    }
});
$app->post('/forgot_change_otp', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('email','otp_code','password'));

    $email = $app->request->post('email');
    $otp_code = $app->request->post('otp_code');
    $password = $app->request->post('password');

    $checkEmail = $db->checkEmailForgot($email);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if($checkEmail['email_verify_otp'] == $otp_code){
        $mainArray = array(
            "email_verify_otp" => 0,
            "password" => $hashedPassword,
            "email"=>$email
        );
        $update = $db->updateUserForgotPasswordOTP($mainArray);

        $response["error"] = false;
        $response['message'] = "Password changed successfully";
        $userData = $db->checkUser($checkEmail['user_id']);
        unset($userData['password']);
        $response['user_data'] = $userData;
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'OTP does not match.';
        return echoRespnse(404, $response);
    }
});
$app->post('/deactivate_account','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();
    $user_id = $headers['user_id'];

    $checkUser = $db->checkUser($user_id);
    if($checkUser['status'] == 0){
        $subject = 'Deactivate Account.';
    }
    if($checkUser['status'] == 1){
        $subject = 'Reactivate Account.';
    }
    

    $otp = rand(100000, 999999);

    $message = "Your OTP is : ".$otp;

    $sendMail = $db->send_email($checkUser['email'],$subject,$message);
    if($sendMail){
        $mainArray = array(
            "email_verify_otp" => $otp,
            "user_id"=>$user_id
        );
        $update = $db->updateUserEmailOTP($mainArray);
        $response["error"] = false;
        $response['message'] = "OTP sent successfully to ".$subject;
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'Something went wrong';
        return echoRespnse(400, $response);
    }
});
$app->post('/deactivate_account_otp','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    verifyRequiredParams(array('otp_code'));

    $user_id = $headers['user_id'];
    $otp_code = $app->request->post('otp_code');

    $checkUser = $db->checkUser($user_id);

    if($checkUser['status'] == 0){
        $status = 1;
        $message = 'Account Deactivated Successfully.';
    }
    if($checkUser['status'] == 1){
        $status = 0;
        $message = 'Account Reactivated Successfully.';
    }
    
    if($checkUser['email_verify_otp'] == $otp_code){
        $mainArray = array(
            "email_verify_otp" => 0,
            "status" => $status,
            "user_id"=>$user_id
        );
        $update = $db->updateUserAccountOTP($mainArray);
        $response["error"] = false;
        $response['message'] = $message;
        if($status == 0){
            $userData = $db->checkUser($user_id);
            unset($userData['password']);
            $response['user_data'] = $userData;
        }
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'OTP does not match.';
        return echoRespnse(404, $response);
    }
});
//END Auth
/// Functinality
$app->get('/likes_list','authenticate', function() use ($app) {
    $headers = apache_request_headers();
    $response = array();
    $db = new DbHandler();

    $user_id = $headers['user_id'];

    $likes = $db->getLikes($user_id);
    if(!empty($likes)){
        for($i=0;$i<10;$i++){
            $a = $i+1;
            $likes[$i]['title'] = "Example Title ".$a." ";
            $likes[$i]['description'] = "Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
            $likes[$i]['post_creator'] = "Random User";
            $likes[$i]['post_image_url'] = IMAGE_PATH."ieat.jpg";
        }
        $response["error"] = false;
        $response['message'] = "Data found";
        $response['data'] = $likes;
        echoRespnse(200, $response);
    }else{
        $response['error'] = true;
        $response['message'] = 'No data found';
        return echoRespnse(404, $response);
    }
});

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
        $response["message"] = 'Missing required parameter: ' . substr($error_fields, 0, -2);
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

function compress_image($source_file, $target_file, $nwidth, $nheight, $quality) {

	//Return an array consisting of image type, height, widh and mime type.

	$image_info = getimagesize($source_file);

	if(!($nwidth > 0)) $nwidth = $image_info[0];

	if(!($nheight > 0)) $nheight = $image_info[1];

	



	/*echo '<pre>';

	print_r($image_info);*/

	if(!empty($image_info)) {

		switch($image_info['mime']) {

			case 'image/jpeg' :

				if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality

				// Create a new image from the file or the url.

				$image = imagecreatefromjpeg($source_file);

				$thumb = imagecreatetruecolor($nwidth, $nheight);

				//Resize the $thumb image

				imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);

				// Output image to the browser or file.

				return imagejpeg($thumb, $target_file, $quality); 

				

				break;

			

			case 'image/png' :

				if($quality == '' || $quality < 0 || $quality > 9) $quality = 6; //Default quality

				// Create a new image from the file or the url.

				$image = imagecreatefrompng($source_file);

				$thumb = imagecreatetruecolor($nwidth, $nheight);

				//Resize the $thumb image

				imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);

				// Output image to the browser or file.

				return imagepng($thumb, $target_file, $quality);

				break;

				

			case 'image/gif' :

				if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality

				// Create a new image from the file or the url.

				$image = imagecreatefromgif($source_file);

				$thumb = imagecreatetruecolor($nwidth, $nheight);

				//Resize the $thumb image

				imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);

				// Output image to the browser or file.

				return imagegif($thumb, $target_file, $quality); //$success = true;

				break;

				

			default:

				echo "<h4>Not supported file type!</h4>";

				break;

		}

	}

}

$app->run();

?>