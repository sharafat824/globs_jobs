
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
            onclick="clearFlashError()"></button>
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
        <h1>Create Employee</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item"><a href="<?php echo base_url() ?>Manage_applicant">Manage applicant</a></li>
            <li class="item">Create Employee</li>
        </ol>
    </div>
    <div class="my-profile-box">
       
        <?php echo form_open_multipart('Candidate/StoreCandidateAdmin'); ?>

        <div class="my-profile-box">
            <h3 class="px-3">Create employee</h3>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="clearFlashError()"></button>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                <h6 class="text-secondary mb-3">User Information</h6>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                        <label class="mb-1" for="user_name">User Name</label>
                        <input type="text" name="user_name" id="user_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="mb-1" for="user_email">User Email</label>
                        <input type="email" name="user_email" id="user_email" class="form-control" required>
                    </div>
                    </div>
                    <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="mb-1" for="user_password">Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" required>
                    </div>
                    </div>
                </div>
                <div class="row">
                <h6 class="text-secondary mb-3">Profile</h6>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Job Category*</label>
                            <select class="form-control" name="category" id="category"
                                required="required">
                                <option value="">Select</option>
                                <?php
                                if (!empty($categories)) {
                                    foreach ($categories as $c) {
                                ?>
                                        <option value="<?php echo $c->id ?>" <?php if ($userInfo->category_id == $c->id) {
                                                                                    echo "selected";
                                                                                } ?>>
                                            <?php echo $c->category_name ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>First Name*</label>
                            <input type="text" class="form-control" name="f_name" placeholder="FIRST NAME" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Last Name*</label>
                            <input type="text" class="form-control" name="l_name" placeholder="LAST NAME" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Gender*</label>
                            <select class="form-control" name="gender" required="required">
                                <option value="">Select</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Date Of Birth*</label>
                            <input type="date" id="datepicker" class="form-control" name="birth_date" required="required">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Address*</label>
                            <input type="text" class="form-control" name="address" placeholder="Address" id="current_address" required="required">
                            <input type="hidden" name="employee_lat" id="employee_lat" />
                            <input type="hidden" name="employee_long" id="employee_long" />
                        </div>
                    </div>

                    <!-- Country and City selection -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Country*</label>
                            <select class="form-control" id="country" name="country" required="required">
                                <!-- Populate countries dynamically if needed -->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>TOWN/CITY*</label>
                            <select class="form-control" id="town" name="town" required="required">
                                <!-- Populate cities dynamically -->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>POST CODE*</label>
                            <input type="number" class="form-control" name="post_code" placeholder="Post Code" required="required">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Email*</label>
                            <input type="email" class="form-control" name="email" placeholder="hello@andysmith.com" required="required">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Phone*</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone number" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Country Of Birth*</label>
                            <select class="form-control" id="nationality" name="nationality" required="required">
                                <!-- Populate countries dynamically if needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                        <label>TOWN/CITY OF BIRTH*</label>
                        <select class="form-control" id="birth_city" name="birth_city" required="required">
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>National Insurance Number*</label>
                            <input type="number" class="form-control" name="insurance_no" placeholder="National Insurance Number" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Profile Pic</label>
                            <input type="file" class="form-control" name="file11" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Upload Resume</label>
                            <input type="file" class="form-control" name="file_resume" required="required">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Upload Portfolio Video</label>
                            <input type="file" class="form-control" name="file_portfolio_video" accept="video/mp4">
                        </div>
                    </div>

                    <div class="col-md-12 col-12 text-center mt-3 mb-4">
                        <button type="submit" class=" default-btn ">Create employee</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
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
</body>

</html>
<script>