<?php

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

  public function checkLogin($user_email, $pass) {
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




    public function post_new_job($company_id, $title,$description,$category,$career,$no_of_postions,$city,
    $experience,$address,$start_time,$end_time,$date_time,$approve,$type) {


      $stmt = $this->conn->prepare("INSERT INTO jobs(company_id, title,description,
        category,career,no_of_postions,city,
        experience,address,start_time,end_time,date_time,approve,type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssssssssssssss", $company_id, $title,$description,$category,$career,$no_of_postions,$city,
        $experience,$address,$start_time,$end_time,$date_time,$approve,$type);
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
      ,$c_about_company,$c_country,$c_city,$c_address,$status) {

        // $st = $this->conn->prepare("SELECT user_id from user_jobs WHERE user_id = ? and job_id = ?");
        // $st->bind_param("ss",$user_id,$job_id);
        // $st->execute();
        // $st->store_result();
        //
        // if($st->num_rows>0){
        //   return FALSE;
        // }else{

        $stmt = $this->conn->prepare("INSERT INTO
          employer_profile(user_id,company_name,company_logo,c_mail,c_phone,c_website,c_team_size,c_about_company,
            c_country,c_city,c_address,status)
            values(?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bind_param("ssssssssssss", $user_id,$company_name,$company_logo,$c_mail,$c_phone,$c_website,$c_team_size
            ,$c_about_company,$c_country,$c_city,$c_address,$status);

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
          $uk_driving_licence,$status) {

            // $st = $this->conn->prepare("SELECT user_id from user_jobs WHERE user_id = ? and job_id = ?");
            // $st->bind_param("ss",$user_id,$job_id);
            // $st->execute();
            // $st->store_result();
            //
            // if($st->num_rows>0){
            //   return FALSE;
            // }else{

            $stmt = $this->conn->prepare("INSERT INTO
              employee_profile(user_id,category_id,profile_pic,first_name,last_name,
                gender,birth_date,address,town,country,post_code,email,phone,birth_city,
                nationality,insurance_no,passport_pic,utilitybill_pic,resident_pic,e_contact_name,
                e_contact_relation,e_contact_phone,badge_type,badge_number,badge_expiry,badge_pic,
                bank_sort_code,account_number,name_of_account,utr_number,visa_required,
                uk_driving_licence,status)
                values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                $stmt->bind_param("sssssssssssssssssssssssssssssssss", $user_id,$category_id,$profile_pic,$first_name,$last_name,
                $gender,$birth_date,$address,$town,$country,$post_code,$email,$phone,$birth_city,
                $nationality,$insurance_no,$passport_pic,$utilitybill_pic,$resident_pic,$e_contact_name,
                $e_contact_relation,$e_contact_phone,$badge_type,$badge_number,$badge_expiry,$badge_pic,
                $bank_sort_code,$account_number,$name_of_account,$utr_number,$visa_required,
                $uk_driving_licence,$status);

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
                $stmt = $this->conn->prepare("SELECT * FROM job_category");
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
                $stmt = $this->conn->prepare("SELECT * FROM country");
                $stmt->execute();
                $status = $stmt->get_result();
                return $status;
              }


              public function get_cities() {
                //   $stmt = $this->conn->prepare("SELECT u.id as chef,u.name,r.chef_id,r.rated,rm.id,rm.user_id,rm.user_images
                // FROM users u,ratings r,recipe_media rm WHERE r.chef_id=u.id or rm.user_id=u.id GROUP by u.id ");
                $stmt = $this->conn->prepare("SELECT * FROM city");

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



                        private function generateApiKey() {
                          return md5(uniqid(rand(), true));
                        }

                      }

                      ?>
