<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

  public function checkLogin($user_email, $pass, $fcm_token, $device_type) {
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt = $this->conn->prepare("SELECT u.id,u.user_email,u.password,r.role_name FROM users u LEFT JOIN roles r
      ON u.user_role = r.id WHERE u.user_email = ?");
      $stmt->bind_param("s" ,$user_email);
      $stmt->execute();
      $stmt->bind_result($id,$user_email,$password,$role_name);
      $user = array();
      $stmt->store_result();
      if($stmt->num_rows > 0){
        $stmt->fetch();
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
        $isPasswordCorrect = password_verify($pass, $hashed_password);
        if($isPasswordCorrect){
          $user["id"] = $id;
          $user["user_email"] = $user_email;
          // $user["password"] = $password;
          $user["role_name"] = $role_name;
          $stmt->close();
          $updat = $this->conn->prepare("UPDATE users SET fcm_token='".$fcm_token."', device_type ='".$device_type."' WHERE id='".$id."'");
          $updat->execute();
          return $user;
        }else{
          $stmt->close();
          return FALSE;
        }

      }else{
        $stmt->close();
        return FALSE;
      }


      //   $stmt = $this->conn->prepare("SELECT * FROM JOBS");
      //
      //    $stmt->execute();
      // $status = $stmt->get_result();
      // return $status;



      //
      //     if ($stmt->num_rows > 0) {
      //
      //
      //         $stmt->fetch();
      // 	$user["id"] = $id;
      // $user["name"] = $name;
      // $image = $this->conn->prepare("SELECT user_images,id from recipe_media where user_id = '".$id."'");
      // $image->execute();
      // $image->bind_result($user_images,$id);
      // $image->fetch();
      // $user["user_images"] = $user_images;
      // $image->close();
      // $rat = $this->conn->prepare("SELECT rated,id from ratings where chef_id = '".$id."'");
      // $rat->execute();
      // $rat->bind_result($rated,$id);
      // $rat->fetch();
      // $user["rated"] = $rated;
      //             $rat->close();
      //             $city = $this->conn->prepare("SELECT city_name,id from city where id = '".$city_id."'");
      // $city->execute();
      // $city->bind_result($city_name,$city_1);
      // $city->fetch();
      // $user["city_name"] = $city_name;
      //             $user["city_id"] = $city_1;
      //             $city->close();
      //
      //         $stmt->close();
      //     	return $user;
      //
      //     } else {
      //         $stmt->close();
      //
      //         // user not existed with the email
      //         return FALSE;
      //     }
    }

    public function response(){
      $stmt = $this->conn->prepare("SELECT recipe_name,recipe_ingredients,recipe_steps from recipe where id = '".$recipe_id."'");
      $stmt->execute();
      $status = $stmt->get_result();
      return $status;
    }




  public function sign_up($user_email, $password,$user_role) {
      $st = $this->conn->prepare("SELECT user_email from users WHERE user_email = ? ");
      $st->bind_param("s",$user_email);
      $st->execute();
      $st->store_result();
      if($st->num_rows>0){
        return FALSE;

      }else{
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users(user_email,password,user_role) values(?,?,?)");
        $stmt->bind_param("sss", $user_email, $password,$user_role);
        $stmt->execute();
        $stmt->store_result();
        $id= $stmt->insert_id;
        $result['id'] = $id;
        return $result;
      }
    }
    
    
    public function deleteEmployeeUser($user_id){
        
        $stmt_1 = $this->conn->prepare("delete from users where id=?");
        $stmt_1->bind_param('s', $user_id);
        if($stmt_1->execute()){
            $stmt = $this->conn->prepare("delete from employee_profile where user_id=?");
            $stmt->bind_param('s', $user_id);
            if($stmt->execute()){
                return true;
            }   
        }
        
    }
    
    public function deleteEmployerUser($user_id){
        
        $stmt_1 = $this->conn->prepare("delete from users where id=?");
        $stmt_1->bind_param('s', $user_id);
        if($stmt_1->execute()){
            $stmt = $this->conn->prepare("delete from employer_profile where user_id=?");
            $stmt->bind_param('s', $user_id);
            if($stmt->execute()){
                return true;
            }
        }
        
    }




    public function post_new_job($company_id, $title,$description,$category,$career,$no_of_postions,$city,
    $experience,$address,$start_time,$end_time,$date_time,$approve,$type,$apply_date,$country,$job_price) {


      $stmt = $this->conn->prepare("INSERT INTO jobs(company_id, title,description,
        category,career,no_of_postions,city,
        experience,address,start_time,end_time,date_time,approve,type,apply_date,country,job_price) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssssssssssssss", $company_id, $title,$description,$category,$career,$no_of_postions,$city,
        $experience,$address,$start_time,$end_time,$date_time,$approve,$type,$apply_date,$country,$job_price);
        $stmt->execute();
        $stmt->store_result();
        $apply_id = $stmt->insert_id;

        if ($apply_id != 0) {
          $stmt->close();
          return TRUE;
        }else{
          $stmt->close();
          return FALSE;
        }

      }





      public function apply_job($user_id, $job_id, $short_list) {

        $st = $this->conn->prepare("SELECT user_id from user_jobs WHERE user_id = ? and job_id = ?");
        $st->bind_param("ss",$user_id,$job_id);
        $st->execute();
        $st->store_result();

        if($st->num_rows>0){
          return FALSE;
        }else{

          $stmt = $this->conn->prepare("INSERT INTO user_jobs(user_id,job_id,short_list) values(?,?,?)");

          $stmt->bind_param("sss", $user_id,$job_id,$short_list);
          $stmt->execute();
          $stmt->store_result();
          $apply_id = $stmt->insert_id;
          $stmt->close();
          return TRUE;

          // if ($apply_id != 0) {
          //   $stmt->close();
          //   return TRUE;
          // }else{
          //   $stmt->close();
          //   return FALSE;
          // }
        }
      }



      public function com_profile($user_id, $company_name,$company_logo,$c_mail,$c_phone,$c_website,$c_team_size
      ,$c_about_company,$c_country,$c_city,$c_address,$status,$registration_no) {

        $st = $this->conn->prepare("DELETE from employer_profile WHERE user_id = ? ");
        $st->bind_param("s",$user_id);
        $st->execute();
        // $st->store_result();
        //
        // if($st->num_rows>0){
        //   return FALSE;
        // }else{
        

        $stmt = $this->conn->prepare("INSERT INTO
          employer_profile(user_id,company_name,company_logo,c_mail,c_phone,c_website,c_team_size,c_about_company,
            c_country,c_city,c_address,status,registration_number)
            values(?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bind_param("sssssssssssss", $user_id,$company_name,$company_logo,$c_mail,$c_phone,$c_website,$c_team_size
            ,$c_about_company,$c_country,$c_city,$c_address,$status, $registration_no);

            $stmt->execute();
            $stmt->store_result();
            $apply_id = $stmt->insert_id;
            $stmt->close();
            if ($apply_id != 0) {
              return TRUE;
            }else{
              return FALSE;
            }

            // }
          }




          public function emp_profile($user_id,$category_id,$profile_pic,$first_name,$last_name,
          $gender,$birth_date,$address,$town,$country,$post_code,$email,$phone,$birth_city,
          $nationality,$insurance_no,$passport_pic,$utilitybill_pic,$resident_pic,$e_contact_name,
          $e_contact_relation,$e_contact_phone,$badge_type,$badge_number,$badge_expiry,$badge_pic,
          $bank_sort_code,$account_number,$name_of_account,$utr_number,$visa_required,
          $uk_driving_licence,$status, $file_resume, $file_portfolio_video) {

            $st = $this->conn->prepare("DELETE from employee_profile WHERE user_id = ? ");
            $st->bind_param("s",$user_id);
            $st->execute();
            

            $stmt = $this->conn->prepare("INSERT INTO
              employee_profile(user_id,category_id,profile_pic,first_name,last_name,
                gender,birth_date,address,town,country,post_code,email,phone,birth_city,
                nationality,insurance_no,passport_pic,utilitybill_pic,resident_pic,e_contact_name,
                e_contact_relation,e_contact_phone,badge_type,badge_number,badge_expiry,badge_pic,
                bank_sort_code,account_number,name_of_account,utr_number,visa_required,
                uk_driving_licence,status,file_resume,file_portfolio_video)
                values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                $stmt->bind_param("sssssssssssssssssssssssssssssssssss", $user_id,$category_id,$profile_pic,$first_name,$last_name,
                $gender,$birth_date,$address,$town,$country,$post_code,$email,$phone,$birth_city,
                $nationality,$insurance_no,$passport_pic,$utilitybill_pic,$resident_pic,$e_contact_name,
                $e_contact_relation,$e_contact_phone,$badge_type,$badge_number,$badge_expiry,$badge_pic,
                $bank_sort_code,$account_number,$name_of_account,$utr_number,$visa_required,
                $uk_driving_licence,$status, $file_resume, $file_portfolio_video);

                $stmt->execute();
                $stmt->store_result();
                $apply_id = $stmt->insert_id;
                $stmt->close();
                if ($apply_id != 0) {
                  return TRUE;
                }else{
                  return FALSE;
                }

                // }
              }



              //Add_recipe

              //
              // public function add_recipe($recipe_name, $recipe_ingredients,$recipe_steps,$user_id,$category_id,$image_3) {
              //
              //
              //
              //     $stmt = $this->conn->prepare("INSERT INTO recipe(recipe_name,recipe_ingredients,recipe_steps,catagory_id) values(?,?,?,?)");
              //
              //     $stmt->bind_param("ssss", $recipe_name, $recipe_ingredients,$recipe_steps,$category_id);
              //     $stmt->execute();
              //     $stmt->store_result();
              //     $recipe_id= $stmt->insert_id;
              //
              //
              //
              //
              //     $user_image = $this->conn->prepare("INSERT INTO user_recipe(recipe_id,user_id) values('".$recipe_id."','".$user_id."')");
              //      $user_image->execute();
              //      $user_image->store_result();
              //
              //      $user_image = $this->conn->prepare("INSERT INTO images(image_path,recipe_id) values('".$image_3."','".$recipe_id."')");
              //      $user_image->execute();
              //      $user_image->store_result();
              //
              //
              //
              //     return TRUE;
              //
              //
              // }









              public function checkIn($time, $imei) {
                // fetching user by email
                $stmt = $this->conn->prepare("INSERT INTO checkin(time,imei) values(?,?)");

                $stmt->bind_param("ss", $time,$imei);

                $stmt->execute();

                //        $stmt->bind_result($cnic);

                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                  // Found user with the email
                  // Now verify the password

                  $stmt->fetch();

                  $stmt->close();
                  //            $updat = $this->conn->prepare("UPDATE users SET market_mall='".$market_mall."' WHERE user_name='".$user_name."'");
                  //            $updat->execute();
                  // User password is correct
                  return TRUE;

                }
              }


              public function get_cat() {
                $stmt = $this->conn->prepare("SELECT * FROM job_category order by category_name asc");
                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }




              public function get_roles() {
                //   $stmt = $this->conn->prepare("SELECT u.id as chef,u.name,r.chef_id,r.rated,rm.id,rm.user_id,rm.user_images
                // FROM users u,ratings r,recipe_media rm WHERE r.chef_id=u.id or rm.user_id=u.id GROUP by u.id ");
                $stmt = $this->conn->prepare("SELECT * FROM roles");

                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }


              public function get_countries() {
                $stmt = $this->conn->prepare("SELECT * FROM country order by country_name asc");
                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }


              public function get_useremail($user_id) {
                $like = $this->conn->prepare("SELECT u.user_email FROM users u WHERE u.id='".$user_id."'");
                $like->execute();
                $like->bind_result($user_email);
                $like->fetch();
                $likes['user_email'] = $user_email;
                $like->close();
                return $likes;
          
              }
              
              public function getJobStatus($can_id, $job_id) {
                $like = $this->conn->prepare("SELECT u.short_list FROM user_jobs u WHERE u.user_id='".$can_id."' and u.job_id='".$job_id."'");
                $like->execute();
                $like->bind_result($short_list);
                if ($like->fetch()) {
                    $likes['status'] = 1;
                    $like->close();
                }else{
                    $likes['status'] = 0;
                }
                return $likes;
          
              }
              
              

              public function get_cities() {
                //   $stmt = $this->conn->prepare("SELECT u.id as chef,u.name,r.chef_id,r.rated,rm.id,rm.user_id,rm.user_images
                // FROM users u,ratings r,recipe_media rm WHERE r.chef_id=u.id or rm.user_id=u.id GROUP by u.id ");
                $stmt = $this->conn->prepare("SELECT * FROM city order by city_name asc");

                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }



              public function get_com_profile_status($com_id) {
                $stmt = $this->conn->prepare("SELECT c.status FROM employer_profile c WHERE c.user_id='".$com_id."'");
                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }


              public function get_cand_profile_status($user_id) {
                $stmt = $this->conn->prepare("SELECT c.status FROM employee_profile c WHERE c.user_id='".$user_id."'");
                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }



            public function get_all_jobs() {

                $stmt = $this->conn->prepare("SELECT
                  j.id,j.title, j.description,j.no_of_postions,j.experience,j.address, j.start_time, j.end_time, j.date_time, j.approve, j.type,j.career,
                  c.city_name,
                  jc.category_name
                  FROM jobs j
                  LEFT JOIN city c ON j.city = c.id
                  LEFT JOIN job_category jc ON j.category = jc.id");

                  $stmt->execute();
                  $status = $stmt->get_result();
                  return $status;
                }


                public function get_com_profile($com_id) {

                  $stmt = $this->conn->prepare("SELECT
                    p.id,p.user_id, p.company_logo,p.company_name,p.c_mail,p.c_phone,
                    p.c_website, p.c_team_size, p.c_about_company,p.status,p.c_address,
                    c.city_name,
                    co.country_name
                    FROM employer_profile p
                    LEFT JOIN city c ON p.c_city = c.id
                    LEFT JOIN country co ON p.c_country = co.id
                    WHERE p.user_id='".$com_id."'");

                    $stmt->execute();
                    $status = $stmt->get_result();
                    return $status;
                  }
                  
                  
                  
                    public function get_can_profile($com_id) {

                    $stmt = $this->conn->prepare("SELECT
                      p.id,p.user_id ,p.profile_pic,p.first_name,p.last_name,p.gender, p.file_portfolio_video, p.file_resume,
                      p.birth_date, p.address, p.town,p.post_code,p.email,p.phone,p.nationality,
                      p.insurance_no,p.passport_pic,p.utilitybill_pic,p.resident_pic,p.e_contact_name,
                      p.e_contact_relation,p.e_contact_phone,p.badge_type,p.badge_number, p.badge_expiry,p.badge_pic,
                      p.bank_sort_code,p.account_number,p.name_of_account, p.utr_number, p.visa_required, p.uk_driving_licence,
                      p.status,
                      ca.category_name,
                      c.city_name,
                      co.country_name
                      FROM employee_profile p
                      LEFT JOIN job_category ca ON p.category_id = ca.id
                      LEFT JOIN city c ON p.birth_city = c.id
                      LEFT JOIN country co ON p.country = co.id
                      WHERE p.user_id='".$com_id."'");

                      $stmt->execute();
                      $status = $stmt->get_result();
                      return $status;
                    }
                    
                    



                  public function get_com_jobs($com_id) {

                    $stmt = $this->conn->prepare("SELECT
                      j.id,j.company_id,j.title, j.description,j.no_of_postions,j.experience,j.address, j.start_time, j.end_time, j.date_time, j.approve, j.type,j.career,
                      c.city_name,
                      jc.category_name
                      FROM jobs j
                      LEFT JOIN city c ON j.city = c.id
                      LEFT JOIN job_category jc ON j.category = jc.id
                      WHERE j.company_id='".$com_id."'");

                      $stmt->execute();
                      $status = $stmt->get_result();
                      return $status;
                    }




                    public function get_cat_jobs($cat_id) {

                      $stmt = $this->conn->prepare("SELECT
                        j.id,j.title, j.description,j.no_of_postions,j.experience,j.address, j.start_time, j.end_time, j.date_time, j.approve, j.type,j.career,
                        c.city_name,
                        jc.category_name
                        FROM jobs j
                        LEFT JOIN city c ON j.city = c.id
                        LEFT JOIN job_category jc ON j.category = jc.id
                        WHERE j.category='".$cat_id."'");

                        $stmt->execute();
                        $status = $stmt->get_result();
                        return $status;
                      }




                      public function all_user_jobs($user_id) {
                        // $stmt = $this->conn->prepare("SELECT * FROM user_jobs WHERE user_id='".$user_id."'");

                        $stmt = $this->conn->prepare("SELECT uj.id, uj.user_id, uj.job_id, uj.short_list,
                          j.title, j.description,j.no_of_postions,j.experience,j.address, j.start_time, j.end_time, j.date_time, j.approve, j.type,j.career,
                          c.city_name,
                          jc.category_name
                          FROM user_jobs uj
                          LEFT JOIN jobs j ON uj.job_id = j.id
                          LEFT JOIN city c ON j.city = c.id
                          LEFT JOIN job_category jc ON j.category = jc.id
                          WHERE user_id='".$user_id."'"
                        );


                        $stmt->execute();
                        $status = $stmt->get_result();
                        return $status;
                      }



                      public function all_assigned_emp($job_id) {

                        $stmt = $this->conn->prepare("SELECT u.user_id, u.job_id,
                          e.profile_pic, e.first_name,e.last_name,
                          e.gender,e.birth_date,e.address,
                          e.post_code, e.email, e.phone,e.insurance_no,
                          c.city_name,
                          co.country_name,
                          cou.country_name as nationality,
                          jc.category_name
                          FROM user_jobs u
                          LEFT JOIN employee_profile e ON u.user_id = e.user_id
                          LEFT JOIN city c ON e.birth_city = c.id
                          LEFT JOIN job_category jc ON e.category_id = jc.id
                          LEFT JOIN country co ON e.country = co.id
                          LEFT JOIN country cou ON e.town = cou.id
                          WHERE job_id = '".$job_id."' AND short_list ='1'"
                        );


                        $stmt->execute();
                        $status = $stmt->get_result();
                        return $status;
                        }





                      public function get_queries() {
                        $stmt = $this->conn->prepare("SELECT q.id as query_id,q.user_id,q.query,u.id,u.name,rm.user_id,rm.user_images
                          FROM queries q,recipe_media rm,users u
                          WHERE rm.user_id=q.user_id and u.id=q.user_id");
                          $stmt->execute();
                          $status = $stmt->get_result();
                          return $status;
                        }


                        public function catagory()

                        {
                          $stmt = $this->conn->prepare("SELECT * FROM food_category");

                          $stmt->execute();
                          $status = $stmt->get_result();
                          return $status;
                        }
                        public function city()

                        {
                          $stmt = $this->conn->prepare("SELECT * FROM city");

                          $stmt->execute();
                          $status = $stmt->get_result();
                          return $status;
                        }



                        //to get user_ratings

                        public function get_rated($user_id)

                        {
                          $rating = $this->conn->prepare("SELECT rated FROM ratings WHERE chef_id  = '".$user_id."'");
                          $rating->execute();
                          $rating->bind_result($rated);
                          $rating->fetch();
                          $rate['rated'] = $rated;
                          $rating->close();
                          return $rate;
                        }

                        //to get recipe_likes

                        public function get_likes($recipe_id)

                        {
                          $like = $this->conn->prepare("SELECT count(id) as total_likes  FROM recipe_likes WHERE recipe_id  = '".$recipe_id."'");
                          $like->execute();
                          $like->bind_result($total_likes);
                          $like->fetch();
                          $likes['total_likes'] = $total_likes;
                          $like->close();
                          return $likes;
                        }

                        //to get recipe_comment

                        public function get_comments($recipe_id)

                        {
                          $comment = $this->conn->prepare("SELECT count(id) as total_comment  FROM comment WHERE recipe_id  = '".$recipe_id."'");
                          $comment->execute();
                          $comment->bind_result($total_comments);
                          $comment->fetch();
                          $comments['total_comments'] = $total_comments;
                          $comment->close();
                          return $comments;
                        }

                        //send_notification

                        public function send_notification($query_id)
                        {

                          $st = $this->conn->prepare("SELECT q.id,q.user_id,u.id,u.fcm_token FROM users u,queries q WHERE q.id  = '".$query_id."' and q.user_id = u.id");
                          $st->execute();
                          $st->bind_result($token,$qid,$user_id,$usid,$fcm_token);
                          $st->fetch();
                          $msg['token'] = $fcm_token;
                          $st->close();

                          //array( "cFFUV5U79rA:APA91bFmb9YCbP_yqLH3FGIai-1PfcvWZbSdundbeKoht2hvDXHLmQlH7yHcK75np_CP7BiHvIgwzxfJxj5RnPTU3EGTiDhhAdUO4s5bFRtJ6kwQ9fAOh9NRkw8YzSe4l-pp-BV_rOop")
                          // Replace with the real server API key from Google APIs
                          $apiKey = "AAAAX4hB5-E:APA91bFdUCKd1YQNERzcoBr_lL6xtTqo-S0_xm4PqCEkLaGJ97zXeq6ijO7m0VPLnkz1iJ_jP00BGQvAjsvl8zarEC38fQEn23JiDz2BMsBtFE0LwONfVNdC_AIjqItPBG8bEqj0HGhe";

                          // Replace with the real client registration IDs
                          $registrationIDs = array($msg['token']);

                          // Message to be sent
                          $send_msg = "Hello Fazal ";

                          // Set POST variables
                          $url = 'https://fcm.googleapis.com/fcm/send';

                          $fields = array(
                            'registration_ids' => $registrationIDs,
                            'data' => array( "message" => $send_msg ),
                          );
                          $headers = array(
                            'Authorization: key=' . $apiKey,
                            'Content-Type: application/json'
                          );

                          // Open connection
                          $ch = curl_init();

                          // Set the URL, number of POST vars, POST data
                          curl_setopt( $ch, CURLOPT_URL, $url);
                          curl_setopt( $ch, CURLOPT_POST, true);
                          curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
                          //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));

                          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                          // curl_setopt($ch, CURLOPT_POST, true);
                          // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));

                          // Execute post
                          $result = curl_exec($ch);

                          // Close connection
                          curl_close($ch);
                          // print the result if you really need to print else neglate thi
                          if($msg['token']!=NULL)
                          {
                            return true;
                          }
                          else
                          {
                            return false;
                          }
                        }


                        //to get query likes

                        public function get_query_likes($query_id)

                        {
                          $query_like = $this->conn->prepare("SELECT count(id) as total_query_likes  FROM query_likes WHERE query_id  = '".$query_id."'");
                          $query_like->execute();
                          $query_like->bind_result($total_query_likes);
                          $query_like->fetch();
                          $query_likes['total_query_likes'] = $total_query_likes;
                          $query_like->close();
                          return $query_likes;
                        }

                        //to get query comments

                        public function get_query_comments($query_id)

                        {
                          $query_comment = $this->conn->prepare("SELECT count(id) as total_query_comments  FROM query_comments WHERE query_id  = '".$query_id."'");
                          $query_comment->execute();
                          $query_comment->bind_result($total_query_comments);
                          $query_comment->fetch();
                          $query_comments['total_query_comments'] = $total_query_comments;
                          $query_comment->close();
                          return $query_comments;
                        }
                        
                        
 public function send_email($email = null, $subject = null, $content = null)
    {
        $msg_1 = $content ;
        $message = '
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
        <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="x-apple-disable-message-reformatting">
          <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
          <title></title>
          
            <style type="text/css">
              @media only screen and (min-width: 620px) {
          .u-row {
            width: 600px !important;
          }
          .u-row .u-col {
            vertical-align: top;
          }
        
          .u-row .u-col-100 {
            width: 600px !important;
          }
        
        }
        
        @media (max-width: 620px) {
          .u-row-container {
            max-width: 100% !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
          }
          .u-row .u-col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
          }
          .u-row {
            width: calc(100% - 40px) !important;
          }
          .u-col {
            width: 100% !important;
          }
          .u-col > div {
            margin: 0 auto;
          }
        }
        body {
          margin: 0;
          padding: 0;
        }
        
        table,
        tr,
        td {
          vertical-align: top;
          border-collapse: collapse;
        }
        
        p {
          margin: 0;
        }
        
        .ie-container table,
        .mso-container table {
          table-layout: fixed;
        }
        
        * {
          line-height: inherit;
        }
        
        a[x-apple-data-detectors="true"] {
          color: inherit !important;
          text-decoration: none !important;
        }
        
        table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_heading_6 .v-font-size { font-size: 30px !important; } #u_content_heading_6 .v-color { color: #ffb633 !important; } #u_content_divider_4 .v-container-padding-padding { padding: 5px 10px 10px !important; } #u_content_heading_4 .v-font-size { font-size: 14px !important; } #u_content_heading_4 .v-color { color: #ffffff !important; } #u_content_heading_5 .v-font-size { font-size: 31px !important; } }
            
        .msg7806954374213565862 table, .msg7806954374213565862 td {
            color: #fff ;
        }    
        </style>
          
          
        
        <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #e7e7e7;color: #000000">
          <!--[if IE]><div class="ie-container"><![endif]-->
          <!--[if mso]><div class="mso-container"><![endif]-->
          <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #e7e7e7;width:100%" cellpadding="0" cellspacing="0">
          <tbody>
          <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #e7e7e7;"><![endif]-->
            
        
        <div class="u-row-container" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #000000;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="background-color: #000000;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="padding-right: 0px;padding-left: 0px;" align="center">
              
              <img align="center" border="0" src="https://jobsglob.com/assets/images/image-3.png" alt="" title="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 384px;" width="384"/>
              
            </td>
          </tr>
        </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_6" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:25px 10px 5px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h1 class="v-color v-font-size" style="margin: 0px; color: #ffffff !important; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: "Playfair Display",serif; font-size: 30px;">
            <strong style="color: #ffffff !important;">'.$subject.'</strong>
          </h1>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_divider_4" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="23%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 2px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
            <tbody>
              <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                  <span>&#160;</span>
                </td>
              </tr>
            </tbody>
          </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_4" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h1 class="v-color v-font-size" style="margin: 0px; color: #ffffff !important; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 16px;">
            &nbsp;<br /><strong style="color: #ffffff !important;">'.$content.'</strong>&nbsp;
          </h1>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="23%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 2px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
            <tbody>
              <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                  <span>&#160;</span>
                </td>
              </tr>
            </tbody>
          </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_5" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h1 class="v-color v-font-size" style="margin: 0px; color: #ffb633; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: "Playfair Display",serif; font-size: 33px;">
          </h1>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 50px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div class="v-color" style="color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 22px; line-height: 30.8px;"><strong><span style="font-family: Montserrat, sans-serif; line-height: 30.8px; font-size: 22px;">'.date('d-m-Y').'</span></strong></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #090706;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="background-color: #090706;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
        <div align="center">
          <div style="display: table; max-width:73px;">
          
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 5px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://www.facebook.com/jobsglob" title="Facebook" target="_blank">
                  <img src="https://jobsglob.com/assets/images/image-1.png" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://instagram.com/jobsglob" title="Instagram" target="_blank">
                  <img src="https://jobsglob.com/assets/images/image-2.png" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            
          </div>
        </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 30px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div class="v-color" style="color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;"></span></p>
        <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;">All rights reserved. JobsGlob.com</span></p>
        <p style="font-size: 14px; line-height: 140%;">&nbsp;</p>
        <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;">Preferences | <a href="https://jobsglob.com/">View in browser</a></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
          </tr>
          </tbody>
          </table>
          <!--[if mso]></div><![endif]-->
          <!--[if IE]></div><![endif]-->
        </body>
        
        </html>
        
        ';
    //     $from = "mailto:career@aegiseagles.com";
    //     // echo $email;exit();
    //     $headers = "From:" . $from;
    //     $headers .= "MIME-Version: 1.0\r\n";
    //     $headers .= "Content-type: text/html\r\n";
		// if(!mail($email, $subject, $message, $headers)) {
    //         echo 'Message could not be sent.';
    //         return 'Mailer Error: ';
    //     } else {
    //         return 'Message has been sent';
    //     }
		
        require_once 'phpmailer/Exception.php';
        require_once 'phpmailer/PHPMailer.php';
        require_once 'phpmailer/SMTP.php';
    
        $mail = new PHPMailer(true);
        // // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host = 'smtp.titan.email';
        // $mail->Host = 'smtp.gmail.com';//celebration to honor 40 Years of Hard Work and Service
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@jobsglob.com';
        // $mail->Username = 'm.kashifchli@gmail.com';
        // $mail->Password = 'eysizjbhekdgkudz';
        $mail->Password = '*u}!Uq8M\jj^pu-';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setfrom('noreply@jobsglob.com', 'JobsGlob Support');
        // $mail->addreplyto('no-reply@example.com', 'noreply');

        // // Add a recipient
        $mail->addAddress($email);

        // // Email subject
        $mail->Subject = $subject;

        // // Set email format to HTML
        $mail->isHTML(true);

        // // Email body content
        $mailContent = "<p><b>" . $content . "</b></p>";
        $mail->Body = $message;

        // // Send email
        if (!$mail->send()) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }
    
     public function send_email_new_quote($name, $email, $phone, $address, $numbertype, $eventtype, $quantity, $city, $duration, $price, $productName, $productPrice, $price_quoted)
    {
        
		$msg_1 = 'Name: <b>'.$name.'</b></br>
		    Email: <b>'.$email.'</b></br>
		    Phone: <b>'.$phone.'</b></br>
		    Address: <b>'.$address.'</b></br>
		    EventType: <b>'.$eventtype.'</b></br>
		    NumberType: <b>'.$numbertype.'</b></br>
		    Quantity: <b>'.$quantity.'</b></br>
		    City: <b>'.$city.'</b></br>
		    Duration: <b>'.$duration.'</b></br>
		    Price: <b>'.$price.'</b></br>
		    ProductName: <b>'.$productName.'</b></br>
		    ProductPrice: <b>'.$productPrice.'</b></br>
		    PriceQuoted: <b>'.$price_quoted.'</b></br>
		    ' ;
	    $subject = "New Quote Request";
        require_once 'phpmailer/Exception.php';
        require_once 'phpmailer/PHPMailer.php';
        require_once 'phpmailer/SMTP.php';
    
        $mail = new PHPMailer(true);
        // // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host = 'smtp.fastmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@letterhirelondon.com';
        $mail->Password = '8p328u57fjx5kweu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setfrom('info@letterhirelondon.com', 'New  Quote');
        $mail->addAddress('info@letterhirelondon.com');
        // $mail->addAddress('tanveerahmad45666@gmail.com');
        // $mail->addAddress('muhammad.kashif@adaxiomtech.com');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mailContent = "<p><b>" . $msg_1 . "</b></p>";
        $mail->Body = $msg_1;
        if (!$mail->send()) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }



                        private function generateApiKey() {
                          return md5(uniqid(rand(), true));
                        }

                      }

                      ?>
