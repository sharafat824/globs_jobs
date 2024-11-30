<?php

$add_edit = 'Add';
$city = $cityInfo;
$country = $countryInfo;
if(!empty($userInfo)){
    $form = form_open_multipart('Candidate/updateCandidateEmergencyInfo');
}
else{
    $form = form_open_multipart('Candidate/addingCandidateEmergencyInfo');
}

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
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-5 "></div>
                <div class="col-md-6 mt-5 ">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $profile_completnes; ?>%">
                            <?php echo $profile_completnes; ?>%
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5 "></div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addCandidate" role="button" class="btn <?php if($enable_button=="personal"){ echo "btn-success"; }else{ echo "btn-primary";} ?>">Personal Info</a>
                </div>
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addInfoVisa" role="button" class="btn <?php if($enable_button=="visa"){ echo "btn-success"; }else{ echo "btn-primary";} ?>">Visa Info</a>
                </div>
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addInfoEmergency" role="button" class="btn <?php if($enable_button=="emergency"){ echo "btn-success"; }else{ echo "btn-primary";} ?>">Emergency Contact</a>
                </div>
                <div class="col-md-3 mt-5 ">
                    <a style="width:100%;" href="<?php echo base_url() ?>Candidate/addInfoBadge" role="button" class="btn <?php if($enable_button=="badge"){ echo "btn-success"; }else{ echo "btn-primary";} ?>">Badge Details</a>
                </div>
            </div>
        </div>
        <?php echo $form; ?>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <h3>Emergency Contact Details</h3>
                <br>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>NAME*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->e_contact_name; ?>"
                        name="e_name" placeholder="" required="required">
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>RELATION*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->e_contact_relation; ?>"
                        name="e_relation" placeholder="" required="required">
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>PHONE*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->e_contact_phone; ?>"
                        name="e_phone" placeholder="" required="required">
                </div>
            </div>

            <?php if(!empty($userInfo)){ ?>
                <div class="col-lg-12 col-md-12">
                    <button type="submit" class="default-btn">Save Change <i class="flaticon-send"></i></button>
                </div>
            <?php }else{ ?>
                <div class="col-lg-12 col-md-12">
                    <button type="submit" class="default-btn">Submit <i class="flaticon-send"></i></button>
                </div>
          <?php } ?>
        </div>
        </form>
    </div>

</div>


</body>

</html>