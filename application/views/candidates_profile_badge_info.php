<?php

$add_edit = 'Add';
$city = $cityInfo;
$country = $countryInfo;
if(!empty($userInfo)){
    $form = form_open_multipart('Candidate/updateCandidateBadgeInfo');
}
else{
    $form = form_open_multipart('Candidate/addingCandidateBadgeInfo');
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

        <div id="hidden_div" class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <h3>Badge Details</h3>
                    <br>
                </div>

                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BADGE TYPE</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->badge_type; ?>"
                            name="badge_type" id="hello" placeholder="">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BADGE NUMBER </label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->badge_number; ?>"
                            name="badge_number" placeholder="">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>EXPIRY DATE </label>
                        <input type="date" class="form-control" value="<?php echo $userInfo->badge_expiry; ?>"
                            name="expiry_date" placeholder="">
                    </div>
                </div>


                <div class="col-lg-1 col-md-1">


                    <div class="form-group">
                        <?php if(!empty($userInfo->badge_pic)){ ?>
                        <img src="<?php echo base_url() . "employee_images/" . $userInfo->badge_pic; ?>" width="100px"
                            height="100px" />
                        <?php } ?>
                    </div>


                </div>
                <div class="col-xl-5 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BADGE PHOTO*</label>
                        <input type="file" class="form-control" name="file4" placeholder="" accept="image/*">
                    </div>
                </div>
            </div>
            <div style="display:none;">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <h3>Financial Details</h3>
                    <br>
                </div>
                
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BANK SORT CODE</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->bank_sort_code; ?>"
                            name="sort_code" placeholder="">
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>ACCOUNT NUMBER</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->account_number; ?>"
                            name="account_number" placeholder="">
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>NAME OF ACCOUNT</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->name_of_account; ?>"
                            name="account_name" placeholder="">
                    </div>
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