<?php
if (isset($userInfo) != NULL) {
    
    
} else {
    $add_edit = 'Add';
    $category = $catInfo;
    $form = form_open('Area/update_job');
}
?>


   <div class="">
      <div class="breadcrumb-area">
         <h1>Post a New Job</h1>
         <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Home</a></li>
            <li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item">Post a New Job</li>
         </ol>
      </div>
      <div class="post-a-new-job-box">
         <h3>Post Your Job</h3>
         <?php echo form_open('Job/update_job'); ?>
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="form-group" >
                     <label>Job Title</label>
                     <input type="text" class="form-control" name="title" placeholder="Job Title Here" required="required">
                  </div>
               </div>
               <div class="col-lg-12 col-md-12">
                  <div class="form-group" >
                     <label>Job Description</label>
                     <textarea cols="30" rows="6" name="description" placeholder="Short description..." class="form-control" required="required"></textarea>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Job Category</label>
                     <select class="selectize-filter" name="category" id="category" required="required">
                        <option value="">Select</option>
                        <?php
                            if(!empty($category))
                            {
                                foreach ($category as $c)
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
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Required career level for this job?</label>
                     <select class="selectize-filter" name="career" required="required">
                        <option value="">Select</option>
                        <option value="1">Basic</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Advance</option>
                     </select>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
					      <label>No. of Vacancies</label> 
					         <input type="text" class="form-control" name="positions" placeholder="Number of Vacancy" required="required">
				
				 </div>
               </div>

               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
					      <label>Salary</label> 
					         <input type="text" class="form-control" name="job_price" placeholder="Job Price With Work" required="required">
				
				 </div>
               </div>

               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                      <label>Apply last date</label>
                    <input type="date" class="form-control" name="apply-date" placeholder="apply date" required="required">
                  </div>
               </div>
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Year Experiences of experience required?</label>
                     <select class="selectize-filter" name="experience" required="required">
                        <option value="">Select</option >
						<option value="1">Fresh</option>
						<option value="2">1 Year Experience</option>
						<option value="3">2 Year Experience</option>
						<option value="4">3 Year Experience</option>
                     </select>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Job Type</label>
                     <select class="selectize-filter" name="type">
                        <option value="">Select</option>
                        <option value="1">part Time</option>
                        <option value="2">Full Time</option>
                        <option value="3">Seasonal</option>
                        <option value="4">Temporary</option>
                        <option value="5">Leased</option>
                     </select>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Country</label>
                     <select class="form-control" required="required" name="country" id="country">
                           <option value="">Select</option>
                           <?php
                              $country_list = array(1,2,3,4);
                              if(!empty($countryInfo))
                              {
                                 foreach ($countryInfo as $c)
                                 {
                                       // if(in_array($c->id, $country_list)){

                                       ?>
                           <option value="<?php echo $c->id ?>"
                              <?php if ($userInfo->c_country == $c->id) {echo "selected";}?>>
                              <?php echo $c->country_name ?></option>
                           <?php
                                       // }
                                 }
                              }
                              ?>
                     </select>
                  </div>
                  </div>
               <div class="col-xl-6 col-lg-12 col-md-12">
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control" required="required" name="city" id="town">
                        <option value="">Select</option>
                        <?php
                            if(!empty($cityInfo))
                            {
                                foreach ($cityInfo as $c)
                                {
                                    ?>
                                    
                        <option value="<?php echo $c->id ?>"
                            <?php if ($userInfo->c_city == $c->id) {echo "selected";}?>><?php echo $c->city_name ?>
                        </option>
                        <?php
                                }
                            }
                            ?>
                    </select>
                </div>
                  <!-- city dropdown -->
               </div>
               <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                     <label>Complete Address</label>
                     <input type="text" required="required" class="form-control" name="address" id="current_address" placeholder="32, Wales Street, New York, USA">
                  </div>
                  <input type="hidden" name="job_lat" id="job_lat" />
                  <input type="hidden" name="job_long" id="job_long" />
               </div>
               <?php $CI =& get_instance();
               $statusDetails = $CI->Manage_Dashboard_Model->getCompanyStatus();
               if($statusDetails->status == 1){
               ?>

               <div class="col-lg-12 col-md-12">
                  <button type="submit" class="default-btn default-btn-0">Post A Job <i class="flaticon-send"></i></button>
               </div>
               <?php } ?>
            </div>
         </form>
      </div>
      
   </div>
   <script type="text/javascript">
    window.initMap = initMap;
    function initMap() {
        var input = document.getElementById('current_address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions({
            // country: ["pk"],
        });
        // se
        autocomplete.setTypes(['address']);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            for (var i = 0; i < place.address_components.length; i++) {
                for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "street_number") {
                        var street_number = place.address_components[i].long_name;
                    }
                    if (place.address_components[i].types[j] == "route") {
                        var route = place.address_components[i].long_name;
                    }
                    if (place.address_components[i].types[j] == "postal_town") {
                        // document.getElementById('current_city').value = place.address_components[i].long_name;
                    }
                    if (place.address_components[i].types[j] == "postal_code") {
                        // document.getElementById('current_zip').value = place.address_components[i].long_name;
                    }
                }
            }
            const current_lat = document.getElementById("job_lat").value = place.geometry['location'].lat();
            const current_long = document.getElementById("job_long").value = place.geometry['location'].lng();
        });
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7x6ggsvFSD0nUYf9YCFZ7SnJKVvJ5KY&callback=initMap&libraries=drawing,places&v=weekly"
    defer
></script>