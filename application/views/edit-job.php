<div class="">
    <div class="breadcrumb-area">
        <h1>Edit Job</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item">Edit Job</li>
        </ol>
    </div>
    <div class="post-a-new-job-box">
        <h3>Edit Your Job</h3>
        <?php echo form_open('Job/updateJob'); ?>
        <input type="hidden" name="job_id" value="<?php echo $job->id; ?>"> <!-- Hidden Job ID -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Job Title Here" value="<?php echo $job->title; ?>" required="required">
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Job Description</label>
                    <textarea cols="30" rows="6" name="description" placeholder="Short description..." class="form-control" required="required"><?php echo $job->description; ?></textarea>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Job Category</label>
                    <select class="selectize-filter" name="category" id="category" required="required">
                        <option value="">Select</option>
                        <?php
                        if (!empty($catInfo)) {
                            foreach ($catInfo as $c) {
                                $selected = $c->id == $job->category ? 'selected' : '';
                                echo "<option value='{$c->id}' {$selected}>{$c->category_name}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Required Career Level for this Job?</label>
                    <select class="selectize-filter" name="career" required="required">
                        <option value="">Select</option>
                        <option value="1" <?php echo $job->career == 1 ? 'selected' : ''; ?>>Basic</option>
                        <option value="2" <?php echo $job->career == 2 ? 'selected' : ''; ?>>Intermediate</option>
                        <option value="3" <?php echo $job->career == 3 ? 'selected' : ''; ?>>Advance</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>No. of Vacancies</label>
                    <input type="text" class="form-control" name="positions" placeholder="Number of Vacancy" value="<?php echo $job->no_of_postions; ?>" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Salary</label>
                    <input type="text" class="form-control" name="job_price" placeholder="Job Price With Work" value="<?php echo $job->job_price; ?>" required="required">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Apply Last Date</label>
                    <input type="date" class="form-control" name="apply_date"
                        value="<?php echo isset($job->apply_date) ? date('Y-m-d', strtotime($job->apply_date)) : ''; ?>"
                        required="required">

                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Years of Experience Required?</label>
                    <select class="selectize-filter" name="experience" required="required">
                        <option value="">Select</option>
                        <option value="1" <?php echo $job->experience == 1 ? 'selected' : ''; ?>>Fresh</option>
                        <option value="2" <?php echo $job->experience == 2 ? 'selected' : ''; ?>>1 Year Experience</option>
                        <option value="3" <?php echo $job->experience == 3 ? 'selected' : ''; ?>>2 Year Experience</option>
                        <option value="4" <?php echo $job->experience == 4 ? 'selected' : ''; ?>>3 Year Experience</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Job Type</label>
                    <select class="selectize-filter" name="type">
                        <option value="">Select</option>
                        <option value="1" <?php echo $job->type == 1 ? 'selected' : ''; ?>>Part Time</option>
                        <option value="2" <?php echo $job->type == 2 ? 'selected' : ''; ?>>Full Time</option>
                        <option value="3" <?php echo $job->type == 3 ? 'selected' : ''; ?>>Seasonal</option>
                        <option value="4" <?php echo $job->type == 4 ? 'selected' : ''; ?>>Temporary</option>
                        <option value="5" <?php echo $job->type == 5 ? 'selected' : ''; ?>>Leased</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" required="required" name="country" id="cuntry">
                        <option value="">Select</option>
                        <?php
                        if (!empty($countryInfo)) {
                            foreach ($countryInfo as $c) {
                                $selected = $c->id == $job->country ? 'selected' : '';
                                echo "<option value='{$c->id}' {$selected}>{$c->country_name}</option>";
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
                        if (!empty($cityInfo)) {
                            foreach ($cityInfo as $c) {
                                $selected = $c->id == $job->city ? 'selected' : '';
                                echo "<option value='{$c->id}' {$selected}>{$c->city_name}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Complete Address</label>
                    <input type="text" required="required" class="form-control" name="address" id="current_address" placeholder="32, Wales Street, New York, USA" value="<?php echo $job->address; ?>">
                    <input type="hidden" name="job_lat" id="job_lat" value="<?php echo $job->job_lat; ?>" />
                    <input type="hidden" name="job_long" id="job_long" value="<?php echo $job->job_long; ?>" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <button type="submit" class="default-btn default-btn-0">Update Job <i class="flaticon-send"></i></button>
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
            const current_lat = document.getElementById("job_lat").value = place.geometry['location'].lat();
            const current_long = document.getElementById("job_long").value = place.geometry['location'].lng();
        });
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7x6ggsvFSD0nUYf9YCFZ7SnJKVvJ5KY&callback=initMap&libraries=drawing,places&v=weekly"
    defer></script>