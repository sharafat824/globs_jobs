<?php $page_title = 'Add User'; $heading = 'Manage User'; 

$add_edit = 'Add';
$form = form_open_multipart('User/addNewUser');

?>
<div class="breadcrumb-area"> 
<h1>All Users</h1>
<ol class="breadcrumb">

<li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
<li class="item"><a href="<?php echo base_url() ?>User">User</a></li>
<li class="item">All Users</li>
</ol>
</div>
<div class="my-profile-box">
   <div class="job-list-area">
        <div class="container">
            <div class="section-title mt-3">
               <h5>Add User</h5>
            </div>
                <?php echo $form; ?>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>User Name*</label>
                                <input type="text" class="form-control"
                                    name="user_name" placeholder="" required="required">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>User Email*</label>
                                <input type="text" class="form-control"
                                    name="user_email" placeholder="" required="required">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>User Password*</label>
                                <input type="password" class="form-control"
                                    name="user_password" placeholder="" required="required">
                            </div>
                        </div>
                        
                    </div>
                     <div class="text-center"> 
                    <button class="btn default-btn" type="submit">Submit</button></div>   
                </form>
            </div> 
        </div>
    </div>
</div> 