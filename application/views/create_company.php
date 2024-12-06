<body>
<div class="breadcrumb-area mb-0 mx-3">
		<h1>Create Company </h1>
		<ol class="breadcrumb">
			
			<li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item"><a href="<?php echo base_url()?>Company/company">All Companies</a></li>
            <li class="item">Create Company User</li>
		</ol>
	</div>
    <div class="container py-5">
        <?php if (isset($errors)): ?>
            <div class="alert alert-danger">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>
        <div class="card shadow-lg">
            <div class=" bg-primary text-white">
                <h3 class="mb-0 text-white text-center p-3">Create Company</h3>
            </div>
            <div class="card-body my-profile-box">
                <!-- Form to Create User -->
                <?php echo form_open_multipart('Company/StoreUserAndCompany'); ?>

                <!-- User Information -->
                <h5 class="text-secondary mb-3">User Information</h5>
                <div class="row">
                    <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="company_logo">Company Logo</label>
                        <div class="input-group">
                            <input type="file" name="file11" id="company_logo" class="form-control" accept="image/*">
                            <label class="default-btn" for="company_logo" style="padding: 18px; cursor: pointer;">Upload </label>
                        </div>
                       </div>
                        <small class="form-text text-muted">Upload a logo image (JPG, PNG, GIF).</small>
                        <img id="logo-preview" src="" alt="Logo Preview" style="display:none; margin-top: 10px; max-width: 200px;">
                    </div>
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
                <!-- Company Information -->
                <h5 class="text-secondary  mb-4">Company Information</h5>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label class="mb-1" for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" required>
                            </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label class="mb-1" for="registration_number">Registration Number</label>
                                <input type="text" name="registration_number" id="registration_number" class="form-control">
                            </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label class="mb-1" for="website">Website</label>
                                <input type="text" name="website" id="website" class="form-control">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label class="mb-1" for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label class="mb-1" for="companyemail">Email</label>
                                <input type="email" name="email" id="companyemail" class="form-control" required>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="mb-1" for="country">Country*</label>
                                <select class="form-control" id="country" name="country" required>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="mb-1" for="city">City*</label>
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
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="address">Address</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="team_size">Team Size</label>
                            <input type="text" name="team_size" id="team_size" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="about_company">About Company</label>
                            <textarea name="about_company" id="about_company" class="form-control"></textarea>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label class="mb-1"  for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1"  for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control">
                        </div> -->
                        <div class="text-center "> 

                            <button type="submit" class="btn  default-btn w-100 mt-3">Create User and Company</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('company_logo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('logo-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the preview image
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = ''; // Clear the preview if no file is selected
                preview.style.display = 'none'; // Hide the preview image
            }
        });
    </script>
</body>