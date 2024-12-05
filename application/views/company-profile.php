<?php

    $add_edit = 'Add';
    $city = $cityInfo;
	$country = $countryInfo;
	//print_r ($cityInfo);
    if(!empty($userInfo)){
        $form = form_open_multipart('Company/updatecompany');
    }
    else{
        $form = form_open_multipart('Company/addingcompany');
    }
    


?>

<div class="">
    <div class="breadcrumb-area">
        <h1>Company Profile</h1>
        <ol class="breadcrumb">
            
            <li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item">Company Profile</li>
        </ol>
    </div>
    <div class="my-profile-box">
        <h3>Profile Details</h3>
        <?php echo  $form; ?>
        <div class="row align-items-center">
            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if(!empty($userInfo->company_logo)){ ?>
                    <img src="<?php echo base_url() . "employee_images/" . $userInfo->company_logo; ?>" width="100px"
                        height="100px" />
                    <?php } ?>
                </div>


            </div>
            <div class="col-lg-5 col-md-5">

                <?php if(empty($userInfo->company_logo)){ ?>
                <div class="form-group">
                    <label>Company Logo</label>
                    <input type="file" class="form-control" name="file11" placeholder="" required="required">
                </div>
                <?php }else{ ?>
                <div class="form-group">
                    <label>Company Logo</label>
                    <input type="file" class="form-control" name="file11" placeholder="">
                </div>
                <?php } ?>

            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Company name</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->company_name ;?> " name="name"
                        placeholder="Company name" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Registration Number</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->registration_number; ?> " name="registration_number"
                        placeholder="Enter Registration Number " required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" value="<?php echo $userInfo->c_mail ;?> " name="email"
                        placeholder="Email address" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->c_phone ;?> " name="phone"
                        placeholder="+88 (123) 123456" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->c_website ;?> " name="website"
                        placeholder="Website" required="required">
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>About Company</label>
                    <textarea cols="30" rows="6" name="about" required="required"
                        value="<?php echo $userInfo->c_about_company ;?> "
                        placeholder="Short description about company..."
                        class="form-control"><?php echo $userInfo->c_about_company ;?> </textarea>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Country</label>
                   <select class="form-control" required="required" name="country" id="country">
                        <option value="">Select</option>
                        <?php
                            $country_list = array(1,2,3,4);
                            if(!empty($country))
                            {
                                foreach ($country as $c)
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
                            if(!empty($city))
                            {
                                foreach ($city as $c)
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
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Complete Address</label>
                    <input type="text" required="required" class="form-control"
                        value="<?php echo $userInfo->c_address ;?> " name="address" id="current_address" placeholder="Complete Address">
                </div>
                <input type="hidden" name="company_lat" id="company_lat" />
                <input type="hidden" name="company_long" id="company_long" />
            </div>

            <div class="col-lg-12 col-md-12">
                <button type="submit" class="default-btn">Submit Now <i class="flaticon-send"></i></button>
            </div>
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
            const current_lat = document.getElementById("company_lat").value = place.geometry['location'].lat();
            const current_long = document.getElementById("company_long").value = place.geometry['location'].lng();
        });
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7x6ggsvFSD0nUYf9YCFZ7SnJKVvJ5KY&callback=initMap&libraries=drawing,places&v=weekly"
    defer
></script>