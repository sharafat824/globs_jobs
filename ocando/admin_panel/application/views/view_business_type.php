<div class="container content-area">
    <section class="section">

        <!--page-header open-->
        <div class="page-header">
            <h4 class="page-title"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Manage_dashboard"
                        class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Business Type</li>
            </ol>
        </div>
        <!--page-header closed-->





        <!--row open-->
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="row">
                        <div class="col-md-6 mb-3">

                            <h4 style="margin-left:30px; margin-top:50px;">Business Type</h4>

                        </div>
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-primary pull-right" style="margin-top:50px; margin-right:30px" ;
                                display:block;>
                                <a href="<?php echo site_url('Main/addBusinessType') ?>"
                                    style="color:#fff; text-decoration:none;">Add Business Type</a>
                            </button>
                        </div>
                    </div>
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Module</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
if (count($details)):
    $cnt = 1;
    foreach ($details as $row):
        $encrypted_id = $this->encrypt->encode($row->id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
        ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row->name) ?></td>
                                        <td><?php echo htmlentities($row->display_name) ?></td>
                                        <td>
                                            <?php echo anchor("Main/deleteBusinessType/{$encrypted_id}", ' ', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog();")) ?>
                                        </td>

                                    </tr>
                                    <?php
        $cnt++;
    endforeach;
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