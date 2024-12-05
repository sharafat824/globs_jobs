<?php $page_title = 'User Table'; $heading = 'Manage User'; 

$u_userid = $userInfo->u_userid;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile_no = $userInfo->mobile_no;
$address = $userInfo->address;
$u_cnic = $userInfo->u_cnic;
$city_id = $userInfo->u_city_id;
$role_rolecode = $userInfo->u_rolecode;
$city = $cityInfo;

?>
<!--app-content open-->
                <div class="container content-area">
                    <section class="section">

                       <!--page-header open-->
                        <div class="page-header">
                            <h4 class="page-title"></h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url()?>User" class="text-light-color">User data</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
                            </ol>
                        </div>


<!--row open-->
<div class="row my-profile-box">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit User</h4>
            </div>
            <div class="card-body">
                <?php $this->load->helper("form"); ?>
                <?php echo form_open('User/editUser'); ?>
            <input type="hidden" class="form-control" name="u_userid"  value="<?php echo $u_userid; ?>" id="u_userid"  required>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name"  value="<?php echo $name; ?>" id="name" placeholder="Enter Name"  required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Mobile Number</label>
                            <input type="number" name="mobile_no" value="<?php echo $mobile_no ?>"  class="form-control" id="validationCustom02" placeholder="Enter Moblie Number"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" value="<?php echo $email; ?>"  class="form-control" id="validationCustom06" placeholder="Enter email" required>
                        <div class="invalid-feedback">
                            Please Enter Valid Email Address
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" value="<?php echo $address; ?>" class="form-control" id="validationCustom03" placeholder="Enter Address" required>
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Cnic Number</label>
                            <input type="number" name="u_cnic" value="<?php echo $u_cnic; ?>" class="form-control" id="validationCustom04" placeholder="Enter Cnic" required>
                            <div class="invalid-feedback">
                                Please provide a valid Cnic.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select class="form-control required" id="city" name="city">
                                            <option value="0">Select City</option>
                                            <?php
                                            if(!empty($city))
                                            {
                                                foreach ($city as $c)
                                                {
                                                    ?>
                                                    <option value="<?php echo $c->id ?>" <?php if($city_id == $c->id) {echo "selected=selected";} ?>><?php echo $c->city_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="city">Role</label>
                        <select class="form-control required" id="role" name="role">
                            <option value="0">Select Role</option>
                            <?php
                            if(!empty($role))
                            {
                                foreach ($role as $c)
                                {
                                    ?>
                                    <option value="<?php echo $c->role_rolecode ?>" <?php if($role_rolecode == $c->role_rolecode) {echo "selected=selected";} ?>><?php echo $c->role_rolename ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--row closed-->


 </section>
                </div>
                <!--app-content closed-->