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
        $stmt = $this->conn->prepare("SELECT password,verification FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($password,$verification);
        $numrows = $stmt->num_rows;
        $stmt->fetch();
        $user = array();
        if ($numrows > 0) {
                $user["password"] = $password;
                $user["verification"] = $verification;
                $stmt->close();
                return $user;
        }
        else{
                return NULL;
        }
}
public function getlogin($email,$password,$fcm_token) {

        if($fcm_token != ""){
                $stmt_fcm = $this->conn->prepare("UPDATE users SET fcm_token = ? WHERE email = ? and password = ? ");
                $stmt_fcm->bind_param('sss',$fcm_token,$email,$password);  
                $updateFCM = $stmt_fcm->execute();
                $stmt_fcm->close();
        }
        

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? and password = ?");
        $stmt->bind_param("ss", $email,$password);
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
	
}

?>