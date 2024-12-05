<?php
if (isset($userInfo) != NULL) {
    $encrypted_id = $this->encrypt->encode($userInfo->id);
    $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
    $profile_pic = $userInfo->profile_pic;
    $name = $userInfo->first_name;
    $last_name = $userInfo->last_name;
    $gender = $userInfo->gender;
    $birth_date = $userInfo->birth_date;
    $address = $userInfo->address;
    $city_name = $userInfo->ccity_name;
    $country_name = $userInfo->cocountry_name;
    $post_code = $userInfo->post_code;
    $email = $userInfo->email;
    $phone = $userInfo->phone;
    $birth_city = $userInfo->c1city_name;
    $nationality = $userInfo->co1country_name;
    $insurance_no = $userInfo->insurance_no;
    $passport_pic = $userInfo->passport_pic;
    $utilitybill_pic = $userInfo->utilitybill_pic;
    $resident_pic = $userInfo->resident_pic;
    $e_contact_name = $userInfo->e_contact_name;
    $e_contact_relation = $userInfo->e_contact_relation;
    $e_contact_phone = $userInfo->e_contact_phone;
    $badge_type = $userInfo->badge_type;
    $badge_number = $userInfo->badge_number;
    $badge_expiry = $userInfo->badge_expiry;
    $badge_pic = $userInfo->badge_pic;
    $bank_sort_code = $userInfo->bank_sort_code;
    $account_number = $userInfo->account_number;
    $name_of_account = $userInfo->name_of_account;
    $utr_number = $userInfo->utr_number;
    $visa_required = $userInfo->visa_required;
    $uk_driving_licence = $userInfo->uk_driving_licence;
    $status = $userInfo->status;
    $file_resume = $userInfo->file_resume;
    $file_portfolio_video = $userInfo->file_portfolio_video;
}
?>

<body>
    <div class="candidates-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="candidates-details-sticky">
                        <div class="candidates-details-information">
                            <div class="information-box">
                                <h1 class="mb-4 text-center">Edit User Information</h1>
                                <?= form_open_multipart('user/update_user_info', ['method' => 'POST']) ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Personal Details -->
                                            <div class="col-md-6 mb-3">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?= set_value('first_name', $name ?? '') ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?= set_value('last_name', $last_name ?? '') ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select id="gender" name="gender" class="form-select">
                                                    <option value="Male" <?= set_select('gender', 'Male', $gender == 'Male') ?>>Male</option>
                                                    <option value="Female" <?= set_select('gender', 'Female', $gender == 'Female') ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="birth_date" class="form-label">Birth Date</label>
                                                <input type="date" id="birth_date" name="birth_date" class="form-control" value="<?= set_value('birth_date', $birth_date ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" id="address" name="address" class="form-control" value="<?= set_value('address', $address ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Contact Information -->
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" value="<?= set_value('email', $email ?? '') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" id="phone" name="phone" class="form-control" value="<?= set_value('phone', $phone ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Emergency Contact -->
                                            <div class="col-md-6 mb-3">
                                                <label for="e_contact_name" class="form-label">Emergency Contact Name</label>
                                                <input type="text" id="e_contact_name" name="e_contact_name" class="form-control" value="<?= set_value('e_contact_name', $e_contact_name ?? '') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="e_contact_relation" class="form-label">Relationship</label>
                                                <input type="text" id="e_contact_relation" name="e_contact_relation" class="form-control" value="<?= set_value('e_contact_relation', $e_contact_relation ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="e_contact_phone" class="form-label">Emergency Contact Phone</label>
                                                <input type="text" id="e_contact_phone" name="e_contact_phone" class="form-control" value="<?= set_value('e_contact_phone', $e_contact_phone ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-success btn-lg">Save Changes</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>