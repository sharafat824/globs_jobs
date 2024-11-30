<?php $page_title = 'Change Password'; $heading = 'Manage User'; 

    $form = form_open_multipart('User/editPassword');

?>

                <!--app-content open-->
                <div class="container content-area">
                    <section class="section">

                        <!--page-header open-->
                        <div class="page-header">
                            <h4 class="page-title"></h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Manage_dashboard" class="text-light-color">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url()?>User" class="text-light-color">Change Password</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $userInfo->username; ?></li>
                            </ol>
                        </div>


<!--row open-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $userInfo->username; ?></h4>
            </div>
            <div class="card-body">
                <?php $this->load->helper("form"); ?>
                <?php echo $form; ?>
                
                        <input type="hidden" class="form-control" name="u_userid"  value="<?php echo $userInfo->id; ?>" id="u_userid"  required>
                
                    
                    <div class="form-group">
                        <label>Previous Password</label>
                        <input type="password" name="previous_password"  class="form-control" id="validationCustom03" placeholder="Enter Previous password" required>
                        <div class="invalid-feedback">
                            Please Enter Valid Password
                    </div>
                    </div>  
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password"  class="form-control" id="validationCustom03" placeholder="Enter New password" required>
                        <div class="invalid-feedback">
                            Please Enter Valid Password
                    </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password"  class="form-control" id="validationCustom03" placeholder="Confirm password" required>
                        <div class="invalid-feedback">
                            Please Enter Valid Password
                    </div>
                    </div>      
                        
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--row closed-->


 </section>
                </div>

         
                <!--app-content closed-->