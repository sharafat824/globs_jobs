<?php $page_title = 'Add User'; $heading = 'Manage User'; 

$add_edit = 'Add';
$form = form_open_multipart('User/addNewUser');

?>

<div class="">
   <div class="job-list-area">
        <div class="container">
            <div class="section-title">
               <h2>Add User</h2>
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
                    <br/>       
                    <button class="btn default-btn" type="submit">Submit</button>
                </form>
            </div> 
        </div>
    </div>
</div> 