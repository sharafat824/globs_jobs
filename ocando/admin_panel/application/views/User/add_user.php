<?php $page_title = 'Add User'; $heading = 'Manage User'; 

if($userInfo != NULL){
    $u_userid = $userInfo->id;
    $username = $userInfo->username;
    $password = $userInfo->password;
    $form = form_open_multipart('User/editUser');
    $add_edit = 'Edit';
    
}
else{
    $add_edit = 'Add';
    $username = "";
    $form = form_open_multipart('User/addNewUser');
}
?>

<!--app-content open-->
<div class="container content-area">
    <section class="section">

        <!--page-header open-->
        <div class="page-header">
            <h4 class="page-title"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Manage_dashboard"
                        class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>User" class="text-light-color">Manage
                        User</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $add_edit; ?> User</li>
            </ol>
        </div>


        <!--row open-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo $add_edit; ?> User</h4>
                    </div>
                    <div class="card-body">
                        <?php $this->load->helper("form"); ?>
                        <?php echo $form; ?>
                        <?php if($add_edit == 'Edit'){ ?>
                        <input type="hidden" class="form-control" name="u_userid" value="<?php echo $u_userid; ?>"
                            id="u_userid" required>
                        <?php } ?>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username"
                                id="username" placeholder="Enter Username" required>
                        </div>
                        <?php if($add_edit == 'Add'){ ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="validationCustom03"
                                placeholder="Enter password" required>
                            <div class="invalid-feedback">
                                Please Enter Valid Password
                            </div>
                        </div>
                        <?php } ?>
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