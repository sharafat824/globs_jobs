<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<div class="">

<div class="breadcrumb-area">
<h1>All Users</h1>
<ol class="breadcrumb">
<li class="item"><a href="dashboard.html">Home</a></li>
<li class="item"><a href="dashboard.html">Dashboard</a></li>
<li class="item">All Users</li>
</ol>
</div>

<div class="all-applicants-box">

                <div class="card">
                    <div class="row">
                        <div class="col-md-6 mb-3">

                            <h4 style="margin-left:30px; margin-top:50px;">Manage User</h4>

                        </div>
                        <div class="col-md-6 mb-3">
                            <?php //if (authorize($_SESSION["access"]["ADMIN"]["User"]["create"])) { ?>

                                <button class="default-btn pull-right" style="margin-top:50px; border:none; margin-right:30px"; display:block;>
                                        <a href="<?php echo site_url('User/addNew') ?>" style="color:#fff; text-decoration:none;">Add User</a>
                                </button>

                            <?php //} ?>			
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
                                        <th>Email</th>
                                        <th>Action</th>
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
                                                <td><?php echo htmlentities($row->user_name) ?></td>
                                                <td><?php echo htmlentities($row->user_email) ?></td>
                                                
                                                <td class="text-center">
                                                    <?php //if (authorize($_SESSION["access"]["ADMIN"]["User"]["delete"])) { ?>
                                                        <?php echo anchor("User/deleteuser/{$encrypted_id}", '<button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User" type="button"><i class="ri-delete-bin-line"></i></button>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog3();")) ?>

                                                    <?php //} ?>

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
