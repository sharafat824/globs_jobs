<?php

$add_edit = 'Add';
$city = $cityInfo;
$country = $countryInfo;
if (!empty($userInfo)) {

    $form = form_open_multipart('Candidate/updateCandidateBasicInfo');
} else {
    $form = form_open_multipart('Candidate/addingCandidateBasic');
}

?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="clearFlashError()"></button>
    </div>
<?php endif; ?>

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
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-5 "></div>
                <div class="col-md-6 mt-5 ">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                            aria-valuemax="100" style="width:<?php echo $profile_completnes; ?>%">
                            <?php echo $profile_completnes; ?>%
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5 "></div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addCandidate" role="button"
                        class="btn <?php if ($enable_button == " personal") {
                                        echo "btn-success";
                                    } else {
                                        echo "btn-primary";
                                    } ?>">Personal Info</a>
                </div>
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addInfoVisa" role="button"
                        class="btn <?php if ($enable_button == " visa") {
                                        echo "btn-success";
                                    } else {
                                        echo "btn-primary";
                                    }
                                    ?>">Visa Info</a>
                </div>
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addInfoEmergency" role="button"
                        class="btn <?php if ($enable_button == " emergency") {
                                        echo "btn-success";
                                    } else {
                                        echo "btn-primary";
                                    } ?>">Emergency Contact</a>
                </div>
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addInfoBadge" role="button"
                        class="btn <?php if ($enable_button == " badge") {
                                        echo "btn-success";
                                    } else {
                                        echo "btn-primary";
                                    }
                                    ?>">Badge Details</a>
                </div>
            </div>
        </div>
        <?php echo $form; ?>
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Job Category</label>
                    <select class="form-control" name="category" id="category" onchange="showDiv('hidden_div', this)"
                        required="required">
                        <option value="">Select</option>
                        <?php
                        if (!empty($catInfo)) {
                            foreach ($catInfo as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>" <?php if ($userInfo->category_id == $c->id) {
                                                                            echo
                                                                            "selected";
                                                                        } ?>>
                                    <?php echo $c->category_name ?>
                                </option>
                        <?php
                            }
                        }
                        ?>

                    </select>
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if (!empty($userInfo->profile_pic)) { ?>
                        <img src="<?php echo base_url() . " employee_images/" . $userInfo->profile_pic; ?>" width="100px"
                            height="100px" />
                    <?php } ?>
                </div>


            </div>
            <div class="col-lg-5 col-md-5">


                <div class="form-group">
                    <label>Profile Pic</label>
                    <?php if (!empty($userInfo->profile_pic)) { ?>
                        <input type="file" class="form-control" name="file11" placeholder="" accept="image/*">
                    <?php } else { ?>
                        <input type="file" class="form-control" name="file11" placeholder="" accept="image/*">
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if (!empty($userInfo->file_resume)) { ?>
                        <a href="<?php echo base_url() . " employee_images/" . $userInfo->file_resume; ?>" target="_blank">View Cv</a>
                    <?php } ?>
                </div>


            </div>

            <div class="col-lg-5 col-md-5">


                <div class="form-group">
                    <label>Upload Resume</label>
                    <?php if (!empty($userInfo->file_resume)) { ?>
                        <input type="file" class="form-control" name="file_resume" placeholder="">
                    <?php } else { ?>
                        <input type="file" class="form-control" name="file_resume" placeholder="" required="required">
                    <?php } ?>
                </div>


            </div>

            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if (!empty($userInfo->file_portfolio_video)) { ?>
                        <a href="<?php echo base_url() . " employee_images/" . $userInfo->file_portfolio_video; ?>"
                            target="_blank">Watch Video</a>
                    <?php } ?>
                </div>


            </div>

            <div class="col-lg-5 col-md-5">


                <div class="form-group">
                    <label>Upload Portfolio Video</label>
                    <?php if (!empty($userInfo->file_portfolio_video)) { ?>
                        <input type="file" class="form-control" name="file_portfolio_video" placeholder=""
                            accept="video/mp4">
                    <?php } else { ?>
                        <input type="file" class="form-control" name="file_portfolio_video" accept="video/mp4"
                            placeholder="">
                    <?php } ?>
                </div>


            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>FIRST NAME*</label>
                    <input type="text" class="form-control" name="f_name" value="<?php echo $userInfo->first_name; ?>"
                        placeholder="FIRST NAME" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>LAST NAME*</label>
                    <input type="text" class="form-control" name="l_name" value="<?php echo $userInfo->last_name; ?>"
                        placeholder="LAST NAME" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>GENDER*</label>
                    <select class="form-control" name="gender" required="required">
                        <option value="">Select</option>
                        <option <?php if ($userInfo->gender == 1) {
                                    echo "selected";
                                } ?> value="1">Male</option>
                        <option <?php if ($userInfo->gender == 2) {
                                    echo "selected";
                                } ?> value="2">female</option>
                        <option <?php if ($userInfo->gender == 3) {
                                    echo "selected";
                                } ?> value="3">other</option>

                    </select>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Date Of Birth*</label>
                    <input type="date" id="datepicker" class="form-control" value="<?php echo $userInfo->birth_date; ?>"
                        placeholder="" name="birth_date" required="required">
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Address*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->address; ?>" name="address"
                        placeholder="Address" id="current_address" required="required">
                    <input type="hidden" name="employee_lat" id="employee_lat" />
                    <input type="hidden" name="employee_long" id="employee_long" />
                </div>
            </div>



            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <?php
                    if (!empty($userInfo)) {
                        $CI = &get_instance();
                        $country_data = $CI->Candidate_Model->getCountryInfo($userInfo->country);
                    ?>
                        <label>Country <strong style="color:green">(
                                <?php echo $country_data->country_name ?>)
                            </strong></label>
                    <?php } else { ?>
                        <label>Country*</label>
                    <?php } ?>
                    <select class="form-control" id="country" name="country" <?php if (empty($userInfo)) { ?>
                        required="required"
                        <?php } ?>>

                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <?php
                    if (!empty($userInfo)) {
                        $CI = &get_instance();
                        $city_data = $CI->Candidate_Model->getCityInfo($userInfo->town);
                    ?>
                        <label>TOWN/CITY <strong style="color:green">(
                                <?php echo $city_data->city_name ?>)
                            </strong></label>
                    <?php } else { ?>
                        <label>TOWN/CITY*</label>
                    <?php } ?>
                    <select class="form-control" id="town" name="town" <?php if (empty($userInfo)) { ?>
                        required="required"
                        <?php } ?>>
                        <option value="">Select Town/City</option>
                        <?php
                        if (!empty($city)) {
                            foreach ($city as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>" <?php if ($userInfo->town == $c->id) {
                                                                            echo "selected";
                                                                        } ?>>
                                    <?php echo $c->city_name ?>
                                </option>
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
                    <input type="text" class="form-control" value="<?php echo $userInfo->post_code; ?>" name="post_code"
                        placeholder="Post Code" required="required">
                </div>
            </div>


            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Email*</label>
                    <input type="email" class="form-control" value="<?php echo $userInfo->email; ?>" name="email"
                        placeholder="hello@andysmith.com" required="required">
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Phone*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->phone; ?>" name="phone"
                        placeholder="+88 (123) 123456" required="required">
                </div>
            </div>


            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <?php
                    if (!empty($userInfo)) {
                        $CI = &get_instance();
                        $country_data = $CI->Candidate_Model->getCountryInfo($userInfo->nationality);
                    ?>
                        <label>Country Of Birth <strong style="color:green">(
                                <?php echo $country_data->country_name ?>)
                            </strong></label>
                    <?php } else { ?>
                        <label>Country Of Birth</label>
                    <?php } ?>
                    <select  class="form-control" name="nationality" id="nationality" <?php if (empty($userInfo)) { ?>
                        required="required"
                        <?php } ?>>
                        <option value="{{$userInfo->nationality}}" selected><?php $country_data->country_name ?></option>

                    </select>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <?php
                    if (!empty($userInfo)) {
                        $CI = &get_instance();
                        $city_data = $CI->Candidate_Model->getCityInfo($userInfo->birth_city);
                    ?>
                        <label>TOWN/CITY OF BIRTH* <strong style="color:green">(
                                <?php echo $city_data->city_name ?>)
                            </strong></label>
                    <?php } else { ?>
                        <label>TOWN/CITY OF BIRTH*</label>
                    <?php } ?>
                    <select class="form-control" name="birth_city" id="birth_city" <?php if (empty($userInfo)) { ?>
                        required="required"
                        <?php } ?>>

                    </select>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>NATIONAL INSURANCE NUMBER</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->insurance_no; ?>"
                        name="insurance_no" placeholder="">
                </div>
            </div>


        </div>
        <?php
        if (!empty($userInfo)) { ?>
            <div class="col-lg-12 col-md-12">
                <button type="submit" class="default-btn">Save Change <i class="flaticon-send"></i></button>
            </div>
        <?php  } else { ?>
            <div class="col-lg-12 col-md-12">
                <button type="submit" class="default-btn">Submit <i class="flaticon-send"></i></button>
            </div>
        <?php    } ?>


    </div>

    </form>
</div>

</div>
<script>
    function clearFlashError() {
        // Optional: Remove the alert from the DOM if needed
        document.getElementById('error-alert').remove();

        // Optional: Make an AJAX request to clear the server-side flashdata
        fetch('<?php echo base_url("Candidate/clearFlashError"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        }).catch((error) => {
            console.error('Error clearing flashdata:', error);
        });
    }
</script>
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
        autocomplete.addListener('place_changed', function() {
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
            const current_lat = document.getElementById("employee_lat").value = place.geometry['location'].lat();
            const current_long = document.getElementById("employee_long").value = place.geometry['location'].lng();
        });
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7x6ggsvFSD0nUYf9YCFZ7SnJKVvJ5KY&callback=initMap&libraries=drawing,places&v=weekly"
    defer></script>

</body>

</html>
<script>