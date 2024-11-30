<?php
date_default_timezone_set("Asia/Karachi");
/**
 * Class to handle all db operations
 * @link URL Tutorial link
 */
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /* ------------- `device_imei_1` table method ------------------ */

public function registerUser($data){
        // print_r($data);exit;
        $query = $this->conn->prepare("INSERT INTO users(first_name,last_name,email,phone_no,password,fcm_token,api_key,role,otp_code,created_date_time) VALUES (?,?,?,?,?,?,?,?,?,?) ");
        $query->bind_param('ssssssssss',$data['first_name'],$data['last_name'],$data['email'],$data['phone_no'],$data['password'],$data['fcm_token'],$data['api_key'],$data['role'],$data['otp_code'],$data['created_date_time']);
        $query->execute();
        $insert_id = $query->insert_id;
        $query->close();

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("s", $insert_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;

}
public function checkEmail($email) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $data['user_id'] = $user_id;
        $stmt->close();
        return $data;
}
public function checkEmailForgot($email) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT id,email,email_verify_otp FROM users WHERE (email = ? or phone_no = ?) ");
        $stmt->bind_param("ss", $email,$email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id,$email,$email_verify_otp);
        $stmt->fetch();
        $data['user_id'] = $user_id;
        $data['email'] = $email;
        $data['email_verify_otp'] = $email_verify_otp;
        $stmt->close();
        return $data;
}
public function checkPhone($phone_no) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE phone_no = ? ");
        $stmt->bind_param("s", $phone_no);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $data['user_id'] = $user_id;
        $stmt->close();
        return $data;
}
public function checkOTP($otp_code,$phone_no) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE phone_no = ? and otp_code = ?");
        $stmt->bind_param("ss", $phone_no,$otp_code);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $data['user_id'] = $user_id;
        $stmt->close();
        return $data;
}
public function updateOTPCode($otp_code,$phone_no,$verification) 
{
        $error[] = "";
        if($verification == 1){
                $stmt = $this->conn->prepare("UPDATE users SET otp_code = ? , verification = ? WHERE phone_no = ?");
                $stmt->bind_param('sss',$otp_code,$verification,$phone_no);
        }else{
                $stmt = $this->conn->prepare("UPDATE users SET otp_code = ? WHERE phone_no = ? and verification = ? ");
                $stmt->bind_param('sss',$otp_code,$phone_no,$verification);  
        }
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error["message"] = "success";
                
        }else{
                $error["message"] = "failure";
        }
        return $error;
}
public function fetchUser($phone_no) 
{
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone_no = ?");
        $stmt->bind_param("s", $phone_no);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
}
public function getloginDetails($email) 
{
        $stmt = $this->conn->prepare("SELECT password,verification,status FROM users WHERE (email = ? or phone_no = ?) ");
        $stmt->bind_param("ss", $email,$email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($password,$verification,$status);
        $numrows = $stmt->num_rows;
        $stmt->fetch();
        $user = array();
        if ($numrows > 0) {
                $user["password"] = $password;
                $user["verification"] = $verification;
                $user["status"] = $status;
                $stmt->close();
                return $user;
        }
        else{
                return NULL;
        }
}
public function getlogin($email,$password,$fcm_token) {

        if($fcm_token != ""){
                $stmt_fcm = $this->conn->prepare("UPDATE users SET fcm_token = ? WHERE (email = ? or phone_no = ?) and password = ? ");
                $stmt_fcm->bind_param('ssss',$fcm_token,$email,$email,$password);  
                $updateFCM = $stmt_fcm->execute();
                $stmt_fcm->close();
        }
        

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE (email = ? or phone_no = ?) and password = ?");
        $stmt->bind_param("sss", $email,$email,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
} 
public function checkUser($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ? ");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
}
public function updateUserPassword($data) 
{
        $error[] = "";
        
        $stmt = $this->conn->prepare("UPDATE users SET first_name = ? , last_name = ? , address = ? , postal_code = ? , password = ? WHERE id = ?");
        $stmt->bind_param('ssssss',$data['first_name'],$data['last_name'],$data['address'],$data['postal_code'],$data['password'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error["message"] = "success";
                
        }else{
                $error["message"] = "failure";
        }
        return $error;
}
public function updateUser($data) 
{
        $error[] = "";
        
        $stmt = $this->conn->prepare("UPDATE users SET first_name = ? , last_name = ? , address = ? , postal_code = ? WHERE id = ?");
        $stmt->bind_param('sssss',$data['first_name'],$data['last_name'],$data['address'],$data['postal_code'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error["message"] = "success";
                
        }else{
                $error["message"] = "failure";
        }
        return $error;
}
public function updateUserEmailPassword($data) 
{
        $error[] = "";
        
        $stmt = $this->conn->prepare("UPDATE users SET first_name = ? , last_name = ? , address = ? , postal_code = ? , password = ?, image_path = ? WHERE id = ?");
        $stmt->bind_param('sssssss',$data['first_name'],$data['last_name'],$data['address'],$data['postal_code'],$data['password'],$data['image_path'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error["message"] = "success";
                
        }else{
                $error["message"] = "failure";
        }
        return $error;
}
public function updateUserEmail($data) 
{
        $error[] = "";
        
        $stmt = $this->conn->prepare("UPDATE users SET first_name = ? , last_name = ? , address = ? , postal_code = ? , image_path = ? WHERE id = ?");
        $stmt->bind_param('ssssss',$data['first_name'],$data['last_name'],$data['address'],$data['postal_code'],$data['image_path'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error["message"] = "success";
                
        }else{
                $error["message"] = "failure";
        }
        return $error;
}

public function updateUserEmailOTP($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ? WHERE id = ?");
        $stmt->bind_param('ss',$data['email_verify_otp'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function updateUserEmailForgotOTP($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ? WHERE (email = ? or phone_no = ?)");
        $stmt->bind_param('sss',$data['email_verify_otp'],$data['email'],$data['email']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function updateEmailOTPVerification($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ?,email_verification = ? WHERE id = ?");
        $stmt->bind_param('sss',$data['email_verify_otp'],$data['email_verification'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function updateChangeEmailOTP($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ?,email_verification = ?,email = ? WHERE id = ?");
        $stmt->bind_param('ssss',$data['email_verify_otp'],$data['email_verification'],$data['email'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function updateUserPasswordOTP($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ?,password = ? WHERE id = ?");
        $stmt->bind_param('sss',$data['email_verify_otp'],$data['password'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function updateUserForgotPasswordOTP($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ?,password = ? WHERE (email = ? or phone_no = ?)");
        $stmt->bind_param('ssss',$data['email_verify_otp'],$data['password'],$data['email'],$data['email']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function updateUserAccountOTP($data) 
{
        $stmt = $this->conn->prepare("UPDATE users SET email_verify_otp = ?,status = ? WHERE id = ?");
        $stmt->bind_param('sss',$data['email_verify_otp'],$data['status'],$data['user_id']);        
        
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
                $error = true;
                
        }else{
                $error= false;
        }
        return $error;
}
public function getLikes($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM likes WHERE user_id = ? ");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}	


//VALIDATION APIKEY
public function isValidApiKey($api_key,$user_id) 
{
        $stmt = $this->conn->prepare("SELECT id from users WHERE api_key = ? and id = ?");
        $stmt->bind_param("ss", $api_key,$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
}
//EMAIL 
function send_email($to, $subject, $body){
        
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'm.kashifchli@gmail.com';
        $mail->Password = 'eysizjbhekdgkudz';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->Subject = $subject;	
        $mail->setfrom('support@ocando.com', 'Ocando Support');
        $mail->addreplyto('no-reply@example.com', 'noreply');
        $mail->AddAddress($to, 'Message');        
        $mail->isHTML(true);                
        $mail->MsgHTML($body);
        try {
                $mail->send();
                return true;
        } catch (Exception $e) {
                return $e;
        }
}

public function getMainData() 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM modules");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}

public function getCategory() 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT t.id,t.name,t.module as module_id,m.table_name,m.display_name FROM category t LEFT JOIN modules m ON t.module=m.id ");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}

public function getBusinessType() 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT t.id,t.name,t.module as module_id,m.table_name,m.display_name FROM business_type t LEFT JOIN modules m ON t.module=m.id ");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}

public function getTableData($table) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE status = 1 ");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}

public function insertBusinessHub($post) {
        $query = $this->conn->prepare("INSERT INTO business_hub (business_name, profession_type, category_id, category_name, business_type_id, business_type_name, location_address, city, province, postal_code, intersection, longitude, latitude, website, email, phone_no, mobile_no, whatsapp_no, days, start_time, end_time, verified_license, license_no, starting_price, list_languages, years_in_business, business_tags, location_tags, description, images, fb_link, tiktok_link, instagram_link, youtube_link, linkden_link, pinterest_link, twitter_link, google_link, blog_link, created_by, created_date, created_date_time, status) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)");
        $query->bind_param('sssssssssssssssssssssssssssssssssssssssssss',
            $post['business_name'],
            $post['profession_type'],
            $post['category_id'],
            $post['category_name'],
            $post['business_type_id'],
            $post['business_type_name'],
            $post['location_address'],
            $post['city'],
            $post['province'],
            $post['postal_code'],
            $post['intersection'],
            $post['longitude'],
            $post['latitude'],
            $post['website'],
            $post['email'],
            $post['phone_no'],
            $post['mobile_no'],
            $post['whatsapp_no'],
            $post['days'],
            $post['start_time'],
            $post['end_time'],
            $post['verified_license'],
            $post['license_no'],
            $post['starting_price'],
            $post['list_languages'],
            $post['years_in_business'],
            $post['business_tags'],
            $post['location_tags'],
            $post['description'],
            $post['images'],
            $post['fb_link'],
            $post['tiktok_link'],
            $post['instagram_link'],
            $post['youtube_link'],
            $post['linkden_link'],
            $post['pinterest_link'],
            $post['twitter_link'],
            $post['google_link'],
            $post['blog_link'],
            $post['created_by'],
            $post['created_date'],
            $post['created_date_time'],
            $post['status']
        );
        $query->execute();
        $insert_id = $query->insert_id;
        $query->close();
    
        // $stmt = $this->conn->prepare("SELECT * FROM business_hub WHERE id = ?");
        // $stmt->bind_param("i", $insert_id);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $data = $result->fetch_assoc();
        // $stmt->close();
    
        return $insert_id;
    }

    public function saveCard($card_number,$cardholder_name,$expiration_date,$cvv,$user_id){
        // print_r($data);exit;
        $query = $this->conn->prepare("INSERT INTO cards (card_number,cardholder_name,expiration_date,cvv,user_id) VALUES (?,?,?,?,?) ");
        $query->bind_param('sssss',$card_number,$cardholder_name,$expiration_date,$cvv,$user_id);
        $query->execute();
        $insert_id = $query->insert_id;
        $query->close();

        return $insert_id;

}
public function getCard($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE user_id = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}
public function saveTransaction($transaction_no,$card_id,$amount,$payment_medium,$status,$user_id){
        $date = date('Y-m-d H:i:s');
        $query = $this->conn->prepare("INSERT INTO transactions (transaction_no,card_id,amount,payment_medium,status,date_created,user_id) VALUES (?,?,?,?,?,?,?) ");
        $query->bind_param('sssssss',$transaction_no,$card_id,$amount,$payment_medium,$status,$date,$user_id);
        $query->execute();
        $insert_id = $query->insert_id;
        $query->close();

        return $insert_id;

}
public function getTransaction($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE user_id = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}
public function getCardByID($card_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE card_id = ? ");
        $stmt->bind_param('s',$card_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}
public function getPlans() 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM subscription_plans");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}
public function getSubscription($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM subscriptions WHERE user_id = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
        $stmt->close();

        return $data;
}

public function checkPayment($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM subscriptions WHERE user_id = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 
        $data = $row;
        
        $stmt->close();

        return $data;
}
public function checkSubscriptionValidity($user_id) 
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT * FROM subscriptions WHERE user_id = ? and end_date > '".date('Y-m-d')."' ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 
        $data = $row;
        
        $stmt->close();

        return $data;
}
public function checkAds($user_id,$table)
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT id FROM $table WHERE created_by = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 
        $data = $row;
        
        $stmt->close();

        return $data;
}

public function checkMaxAds($user_id,$table)
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT COUNT(id) as ads FROM $table WHERE created_by = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 
        $adCount = $row['ads'];
        $stmt->close();

        $stmt_sub = $this->conn->prepare("SELECT plan_id FROM subscriptions WHERE user_id = ? ");
        $stmt_sub->bind_param('s',$user_id);
        $stmt_sub->execute();
        $result_sub = $stmt_sub->get_result();
        $rowSub = $result_sub->fetch_assoc(); 
        $dataSub = $rowSub['plan_id'];
        $stmt_sub->close();

        $stmt_plan = $this->conn->prepare("SELECT no_ads FROM subscription_plans WHERE id = ? ");
        $stmt_plan->bind_param('s',$dataSub);
        $stmt_plan->execute();
        $result_plan = $stmt_plan->get_result();
        $rowPlan = $result_plan->fetch_assoc(); 
        $adAllowed = $rowPlan['no_ads']+1;
        $stmt_plan->close();

        if($adCount == $adAllowed){
                return false;
        }else{
                return true;
        }
}

public function checkAdsCount($user_id)
{
        $data = array();
        $stmt = $this->conn->prepare("SELECT COUNT(id) as ads FROM business_hub WHERE created_by = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 
        $adCount = $row['ads'];
        $stmt->close();

        $stmt_sub = $this->conn->prepare("SELECT plan_id FROM subscriptions WHERE user_id = ? ");
        $stmt_sub->bind_param('s',$user_id);
        $stmt_sub->execute();
        $result_sub = $stmt_sub->get_result();
        $rowSub = $result_sub->fetch_assoc(); 
        $dataSub = $rowSub['plan_id'];
        $stmt_sub->close();
        if(!empty($dataSub)){
                $stmt_plan = $this->conn->prepare("SELECT no_ads FROM subscription_plans WHERE id = ? ");
                $stmt_plan->bind_param('s',$dataSub);
                $stmt_plan->execute();
                $result_plan = $stmt_plan->get_result();
                $rowPlan = $result_plan->fetch_assoc(); 
                $adAllowed = $rowPlan['no_ads']+1;
                $stmt_plan->close();

                if($adCount == $adAllowed){
                        $data['ad_count'] = $adCount;
                        $data['ad_allowed'] = $adAllowed;
                        $data['plan_mode'] = "Paid";
                        $data['status'] = "inactive";
                        $data['message'] = "Max Ads limit reached. Upgrade your subscription plan to place more ads.";
                }else{
                        $data['ad_count'] = $adCount;
                        $data['ad_allowed'] = $adAllowed;
                        $data['plan_mode'] = "Paid";
                        $data['status'] = "active";
                        $data['message'] = "";
                }
        }else{
                if($adCount == 1){
                        $data['ad_count'] = $adCount;
                        $data['ad_allowed'] = 1;
                        $data['plan_mode'] = "Free";
                        $data['status'] = "inactive";
                        $data['message'] = "Free ad limit reached. To add more Ads purchase a subscription plan.";
                }else{
                        $data['ad_count'] = $adCount;
                        $data['ad_allowed'] = 1;
                        $data['plan_mode'] = "Free";
                        $data['status'] = "active";
                        $data['message'] = "";
                }
                
        }
        
        return $data;
}

public function saveSubscription($plan_id,$user_id,$start_date,$end_date,$status){

        $stmt = $this->conn->prepare("SELECT subscription_id FROM subscriptions WHERE user_id = ? ");
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 
        $subscription_id = $row['subscription_id'];
        $stmt->close();

        if(empty($subscription_id)){
                $query = $this->conn->prepare("INSERT INTO subscriptions (plan_id,user_id,start_date,end_date,status) VALUES (?,?,?,?,?) ");
                $query->bind_param('sssss',$plan_id,$user_id,$start_date,$end_date,$status);
                $query->execute();
                $query->close();

                return true;   
        }else{
                $stmt_update = $this->conn->prepare("UPDATE subscriptions SET start_date = ?,end_date = ?,status =?,plan_id = ? WHERE subscription_id = ? ");
                $stmt_update->bind_param('sssss',$start_date,$end_date,$status,$plan_id,$subscription_id);   
                $result = $stmt_update->execute();
                $stmt_update->close();
                return true;
        }
        

}
	
}

?>