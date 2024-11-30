<?php
$page_title = 'User Data';
$heading = 'Manage User';
$button = 'Add User';


$city = $cityInfo;
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
                <li class="breadcrumb-item active" aria-current="page">Manage User</li>
            </ol>
        </div>
        <!--page-header closed-->


        <!--row open-->
        <div class="row">
            <div class="col-12 col-sm-12">

                <div class="card">
                    <div class="row">
                        <div class="col-md-6 mb-3">

                            <h4 style="margin-left:30px; margin-top:50px;">Manage User</h4>

                        </div>
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-primary pull-right" style="margin-top:50px; margin-right:30px" ;
                                display:block;>
                                <a href="<?php echo site_url('User/addNew') ?>"
                                    style="color:#fff; text-decoration:none;">Add User</a>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')) { ?>
                        <p onload="myFunction()"></p>
                        <?php } ?>

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Username</th>
                                        <th>Action</th>
                                        <th>Change Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($userInfo)) :
                                        $cnt = 1;
                                        foreach ($userInfo as $row) :
                                            $encrypted_id = $this->encrypt->encode($row->id);
                                            $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
                                            ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo $row->username ?></td>
                                        <td align="center">
                                            <?php echo anchor("User/addNew/{$encrypted_id}", ' ', 'class="fa fa-edit fa-lg"') ?>&nbsp;
                                            <?php echo anchor("User/deleteuser/{$encrypted_id}", ' ', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog();")) ?>
                                        </td>
                                        <td align="center">
                                            <?php echo anchor("User/changePassword/{$encrypted_id}", 'Change Password','') ?>
                                        </td>
                                    </tr>
                                    <?php
                                            $cnt++;
                                        endforeach;
                                    else :
                                        ?>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--row closed-->


    </section>
</div>
<!--app-content closed-->