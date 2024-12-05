<?php

$add_edit = 'Add';
$city = $cityInfo;
$country = $countryInfo;
if (!empty($userInfo)) {
    $form = form_open_multipart('Candidate/updateCandidate');
} else {
    $form = form_open_multipart('Candidate/addingCandidate');
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
        <?php echo $form; ?>
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Job Category</label>
                    <select class="form-control" name="category" id="category"
                        onchange="showDiv('hidden_div', this)" required="required">
                        <option value="">Select</option>
                        <?php
                        if (!empty($catInfo)) {
                            foreach ($catInfo as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>"
                                    <?php if ($userInfo->category_id == $c->id) {
                                        echo "selected";
                                    } ?>>
                                    <?php echo $c->category_name ?></option>
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
                        <img src="<?php echo base_url() . "employee_images/" . $userInfo->profile_pic; ?>" width="100px"
                            height="100px" />
                    <?php } ?>
                </div>


            </div>
            <div class="col-lg-5 col-md-5">


                <div class="form-group">
                    <label>Profile Pic</label>
                    <input type="file" class="form-control" name="file11" placeholder="" required="required">
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
                    <input type="date" class="form-control" value="<?php echo $userInfo->birth_date; ?>" placeholder=""
                        name="birth_date" required="required">
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Address*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->address; ?>" name="address"
                        placeholder="Address" required="required">
                </div>
            </div>



            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Country*</label>
                    <select class="form-control" id="country" name="country" required="required">
                        <option value="">Select Country</option>
                        <?php
                        if (!empty($country)) {
                            foreach ($country as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>"
                                    <?php if ($userInfo->country == $c->id) {
                                        echo "selected";
                                    } ?>><?php echo $c->country_name ?>
                                </option>
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
                    <select class="form-control" id="town" name="town" required="required">
                        <option value="">Select Town/City</option>
                        <?php
                        if (!empty($city)) {
                            foreach ($city as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>" <?php if ($userInfo->town == $c->id) {
                                                                            echo "selected";
                                                                        } ?>>
                                    <?php echo $c->city_name ?></option>
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
                    <label>Country Of Birth</label>
                    <select class="form-control" name="nationality" id="nationality" required="required">
                        <option value="">Select Country</option>
                        <?php
                        if (!empty($country)) {
                            foreach ($country as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>"
                                    <?php if ($userInfo->nationality == $c->id) {
                                        echo "selected";
                                    } ?>>
                                    <?php echo $c->country_name ?></option>
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
                    <select class="form-control" name="birth_city" id="birth_city" required="required">
                        <option value="">Select Town/City</option>
                        <?php
                        if (!empty($city)) {
                            foreach ($city as $c) {
                        ?>
                                <option value="<?php echo $c->id ?>"
                                    <?php if ($userInfo->birth_city == $c->id) {
                                        echo "selected";
                                    } ?>><?php echo $c->city_name ?>
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
                    <label>NATIONAL INSURANCE NUMBER*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->insurance_no; ?>"
                        name="insurance_no" placeholder="" required="required">
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>UTR NUMBER ( IF SELF EMPLOYED )</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->utr_number; ?>"
                        name="utr_number" placeholder="" required="required">
                </div>
            </div>


            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>VISA REQUIRED*</label>
                    <select class="form-control" name="visa" required="required">
                        <option value="" disabled selected>Select</option>
                        <option <?php if ($userInfo->visa_required == 1) {
                                    echo "selected";
                                } ?> value="1">Yes</option>
                        <option <?php if ($userInfo->visa_required == 2) {
                                    echo "selected";
                                } ?> value="2">No</option>

                    </select>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>DO YOU HOLD A VALID UK DRIVING LICENSE*</label>
                    <select class="form-control" name="licence" required="required">
                        <option value="" disabled selected>Select</option>
                        <option <?php if ($userInfo->uk_driving_licence == 1) {
                                    echo "selected";
                                } ?> value="1">Yes
                        </option>
                        <option <?php if ($userInfo->uk_driving_licence == 2) {
                                    echo "selected";
                                } ?> value="2">No
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if (!empty($userInfo->passport_pic)) { ?>
                        <img src="<?php echo base_url() . "employee_images/" . $userInfo->passport_pic; ?>" width="100px"
                            height="100px" />
                    <?php } ?>
                </div>


            </div>
            <div class="col-xl-5 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>PHOTO OF PASSPORT OR DRIVING LICENCE</label>
                    <input type="file" class="form-control" name="file1" placeholder="">
                </div>
            </div>
            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if (!empty($userInfo->utilitybill_pic)) { ?>
                        <img src="<?php echo base_url() . "employee_images/" . $userInfo->utilitybill_pic; ?>" width="100px"
                            height="100px" />
                    <?php } ?>
                </div>


            </div>
            <div class="col-xl-5 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>PHOTO OF RECENT UNTILITY BILL OR BANK STATEMENT</label>
                    <input type="file" class="form-control" name="file2" placeholder="">
                </div>
            </div>
            <div class="col-lg-1 col-md-1">


                <div class="form-group">
                    <?php if (!empty($userInfo->resident_pic)) { ?>
                        <img src="<?php echo base_url() . "employee_images/" . $userInfo->resident_pic; ?>" width="100px"
                            height="100px" />
                    <?php } ?>
                </div>


            </div>
            <div class="col-xl-5 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>RESIDENT PERMIT PHOTO (IF NOT UK CITIZEN)</label>
                    <input type="file" class="form-control" name="file3" placeholder="">
                </div>
            </div>

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

            <div id="hidden_div" class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <h3>Badge Details</h3>
                    <br>
                </div>

                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BADGE TYPE*</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->badge_type; ?>"
                            name="badge_type" id="hello" placeholder="">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BADGE NUMBER*</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo->badge_number; ?>"
                            name="badge_number" placeholder="">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>EXPIRY DATE*</label>
                        <input type="date" class="form-control" value="<?php echo $userInfo->badge_expiry; ?>"
                            name="expiry_date" placeholder="">
                    </div>
                </div>


                <div class="col-lg-1 col-md-1">


                    <div class="form-group">
                        <?php if (!empty($userInfo->badge_pic)) { ?>
                            <img src="<?php echo base_url() . "employee_images/" . $userInfo->badge_pic; ?>" width="100px"
                                height="100px" />
                        <?php } ?>
                    </div>


                </div>
                <div class="col-xl-5 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>BADGE PHOTO*</label>
                        <input type="file" class="form-control" name="file4" placeholder="">
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
                    <input type="text" class="form-control" value="<?php echo $userInfo->bank_sort_code; ?>"
                        name="sort_code" placeholder="" required="required">
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>ACCOUNT NUMBER*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->account_number; ?>"
                        name="account_number" placeholder="" required="required">
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>NAME OF ACCOUNT*</label>
                    <input type="text" class="form-control" value="<?php echo $userInfo->name_of_account; ?>"
                        name="account_name" placeholder="" required="required">
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