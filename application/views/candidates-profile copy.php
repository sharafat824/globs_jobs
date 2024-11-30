<?php

    $add_edit = 'Add';
    $city = $cityInfo;
	$country = $countryInfo;
	//print_r ($cityInfo);
    $form = form_open_multipart('Candidate/updateCandidate');
?>
   
      <div class="">
         <div class="navbar-area">
            <div class="main-responsive-nav">
               <div class="main-responsive-menu">
                  <div class="responsive-burger-menu d-lg-none d-block">
                     <span class="top-bar"></span>
                     <span class="middle-bar"></span>
                     <span class="bottom-bar"></span>
                  </div>
               </div>
            </div>
            
         </div>
         <div class="breadcrumb-area">
            <h1>My Profile</h1>
            <ol class="breadcrumb">
               <li class="item"><a href="candidates-dashboard.html">Home</a></li>
               <li class="item"><a href="candidates-dashboard.html">Dashboard</a></li>
               <li class="item">My Profile</li>
            </ol>
         </div>
         <div class="my-profile-box">
            <h3>Profile Details</h3>
            <?php echo form_open_multipart('Candidate/updateCandidate'); ?>
               <div class="row">
			   
				<div class="col-xl-12 col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Job Category</label>
                     <select class="selectize-filter" name="category" id="category"  onchange="showDiv('hidden_div', this)" required>
                        <option value="">Select</option>
                        <?php
                            if(!empty($catInfo))
                            {
                                foreach ($catInfo as $c)
                                {
                                    ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->category_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                         
                        </select>
                     </select>
                  </div>
               </div>
                  <div class="col-lg-6 col-md-6">
                     
                        
                        <div class="form-group">
                        <label>Profile Pic</label>
                        <input type="file" class="form-control" name="file11" placeholder="" required>
                     </div>
                        
                     
                  </div>
                  
                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>FIRST NAME*</label>
                        <input type="text" class="form-control" name="f_name" placeholder="FIRST NAME" required>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>LAST NAME*</label>
                        <input type="text" class="form-control" name="l_name" placeholder="LAST NAME" required>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>GENDER*</label>
                        <select class="selectize-filter" name="gender" required>
						   <option value="">Select</option>
                           <option value="1">Male</option>
                           <option value="2">female</option>
                           <option value="3">other</option>
                           
                        </select>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" class="form-control" placeholder="" name="birth_date" required>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                     </div>
                  </div>

                  

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>State*</label>
						<select class="selectize-filter" name="country" required>
                           <option value="">Select Town/City</option>
                           <?php
                            if(!empty($country))
                            {
                                foreach ($country as $c)
                                {
                                    ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->country_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                     </div>
                  </div>
				  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>TOWN/CITY*</label>
						<select class="selectize-filter" name="town" required>
                           <option value="">Select Town/City</option>
                           <?php
                            if(!empty($city))
                            {
                                foreach ($city as $c)
                                {
                                    ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->city_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                     </div>
                  </div>

                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>POST CODE*</label>
                        <input type="text" class="form-control" name="post_code" placeholder="Post Code">
                     </div>
                  </div>


                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="hello@andysmith.com">
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="+88 (123) 123456">
                     </div>
                  </div>
                  

                   <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>State</label>
						<select class="selectize-filter" name="nationality" required>
                           <option value="">Select Country</option>
                           <?php
                            if(!empty($country))
                            {
                                foreach ($country as $c)
                                {
                                    ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->country_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                     </div>
                  </div>
				  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>TOWN/CITY OF BIRTH*</label>
						<select class="selectize-filter" name="birth_city" required>
                           <option value="">Select Town/City</option>
                           <?php
                            if(!empty($city))
                            {
                                foreach ($city as $c)
                                {
                                    ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->city_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                     </div>
                  </div>

                   <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>NATIONAL INSURANCE NUMBER*</label>
                        <input type="text" class="form-control" name="insurance_no" placeholder="">
                     </div>
                  </div>

                   <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>UTR NUMBER ( IF SELF EMPLOYED )</label>
                        <input type="text" class="form-control" name="utr_number" placeholder="">
                     </div>
                  </div>


                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>VISA REQUIRED*</label>
                        <select class="selectize-filter" name="visa">
                           <option value="">Visa Required</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                           
                        </select>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>DO YOU HOLD A VALID UK DRIVING LICENSE*</label>
                        <select class="selectize-filter" name="licence">
                           <option value="">Visa Required</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>PHOTO OF PASSPORT OR DRIVING LICENCE*</label>
                        <input type="file" class="form-control" name="file1" placeholder="" required>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>PHOTO OF RECENT UNTILITY BILL OR BANK STATEMENT*</label>
                        <input type="file" class="form-control" name="file2" placeholder="" required>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>RESIDENT PERMIT PHOTO (IF NOT UK CITIZEN)</label>
                        <input type="file" class="form-control"  name="file3" placeholder="" required>
                     </div>
                  </div>

                  <div class="col-xl-12 col-lg-12 col-md-12">
                     <h3>Emergency Contact Details</h3>
                     <br>
                  </div>

                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>NAME*</label>
                        <input type="text" class="form-control" name="e_name" placeholder="">
                     </div>
                  </div>

                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>RELATION*</label>
                        <input type="text" class="form-control" name="e_relation" placeholder="">
                     </div>
                  </div>

                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>PHONE*</label>
                        <input type="text" class="form-control" name="e_phone" placeholder="">
                     </div>
                  </div>
				  
				  <div id="hidden_div" class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12" >
                     <h3>Badge Details</h3>
                     <br>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>BADGE TYPE*</label>
                        <input type="text" class="form-control" name="badge_type" id="hello" placeholder="">
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>BADGE NUMBER*</label>
                        <input type="text" class="form-control" name="badge_number" placeholder="">
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>EXPIRY DATE*</label>
                        <input type="date" class="form-control"  name="expiry_date" placeholder="">
                     </div>
                  </div>

                 

                  <div class="col-xl-6 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>BADGE PHOTO*</label>
                        <input type="file" class="form-control" name="file4" placeholder="" >
                     </div>
                  </div>
				  </div>
				  
                  <div class="col-xl-12 col-lg-12 col-md-12">
                     <h3>Financial Details</h3>
                     <br>
                  </div>

                   <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>BANK SORT CODE*</label>
                        <input type="text" class="form-control" name="sort_code" placeholder="">
                     </div>
                  </div>

                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>ACCOUNT NUMBER*</label>
                        <input type="text" class="form-control" name="account_number" placeholder="">
                     </div>
                  </div>

                  <div class="col-xl-4 col-lg-12 col-md-12">
                     <div class="form-group">
                        <label>NAME OF ACCOUNT*</label>
                        <input type="text" class="form-control" name="account_name" placeholder="">
                     </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                     <button type="submit" class="default-btn">Save Change <i class="flaticon-send"></i></button>
                  </div>

               </div>
			   
            </form>
         </div>
         
      </div>
      
	

	
	
 </body>
</html>