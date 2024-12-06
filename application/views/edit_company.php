<?php
if (isset($userInfo) && $userInfo != NULL) {
    $company_logo = $userInfo->company_logo;
    $company_name = $userInfo->company_name;
    $email = $userInfo->c_mail;
    $phone = $userInfo->c_phone;
    $website = $userInfo->c_website;
    $about_company = $userInfo->c_about_company;
    $address = $userInfo->c_address;
    $city_name = $userInfo->ccity_name;
    $country_name = $userInfo->cocountry_name;
}
?>

<body>
    <div class="container py-5 ">
    <div class="breadcrumb-area">
         <h1>Company Information</h1>
         <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item"><a href="<?php echo base_url()?>Company/allcompany">All company</a></li>
            <li class="item">Company Information</li>
         </ol>
      </div>
        <div class="card shadow-lg my-profile-box">
            <div class="">
                <h2 class="mt-3 px-5 all-applicants-h2">Edit Company Information</h2>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('Company/UpdateCompanyAdmin'); ?>
                <input type="hidden" name="company_id" value="<?php echo $userInfo->id; ?>">
                <div class="row">
                    <!-- Left Section: Logo and Details -->
                    <div class="col-lg-4 mb-md-4">
                    <div class="form-group">

                        <label for="company_name">Company Name</label>
                        <div class="text-center">
                            <!-- <img src="<?php echo base_url() ?>employee_images/<?php echo $company_logo ?>" alt="Company Logo" id="company_logo_image" class="img-thumbnail mb-3"> -->
                            <input type="file" name="file11" id="company_logo" class="form-control">
                        </div>
                        </div>

                        <div class="form-group ">
                            <label for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="<?php echo $company_name; ?>" class="form-control mt-md-4">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" value="<?php echo $website; ?>" class="form-control mt-md-4">
                        </div>
                    </div>
                    <input type="hidden" name="previous_country" value="<?php echo $userInfo->c_country?>">
                    <input type="hidden" name="previous_city" value="<?php echo $userInfo->c_city?>">
                    <!-- Right Section: Contact Info -->
                    <div class="col-lg-8">
                        <!-- <h5 class="text-primary mb-3"><i class="bi bi-person-lines-fill"></i> Contact Information</h5> -->
                        <div class="row">
                            <div class="col-md-6 mb-md-3">
                        <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-6 mb-md-3">
                        <div class="form-group">
                                <label for="companyemail">Email</label>
                                <input type="email" name="email" id="companyemail" value="<?php echo $email; ?>" class="form-control">
                            </div>
                            </div>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control"><?php echo $address; ?></textarea>
                        </div> -->
                        <div class="row">
                            <div class="col-md-6 mb-md-3">
                                <div class="form-group">
                                    <?php
                                    if (!empty($userInfo)) {
                                        $CI = &get_instance();
                                        $country_data = $CI->Candidate_Model->getCountryInfo($userInfo->c_country);
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
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <?php
                                    if (!empty($userInfo)) {
                                        $CI = &get_instance();
                                        $city_data = $CI->Candidate_Model->getCityInfo($userInfo->c_city);
                                    ?>
                                        <label>TOWN/CITY <strong style="color:green">(
                                                <?php echo $city_data->city_name ?>)
                                            </strong></label>
                                    <?php } else { ?>
                                        <label>CITY*</label>
                                    <?php } ?>
                                    <select class="form-control" id="town" name="city" <?php if (empty($userInfo)) { ?>
                                        required="required"
                                        <?php } ?>>
                                        <option value="">Select City</option>
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
                       
                        <div class="form-group mb-3">
                            <label for="about_company">About Company</label>
                            <textarea name="about_company" id="about_company" class="form-control"><?php echo $about_company; ?></textarea>
                        </div>
                        </div>
                        <button type="submit" class="default-btn my-3">Save Changes</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>