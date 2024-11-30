<?php
    $add_edit = 'Add';
    $form = form_open_multipart('Main/addBusinessTypeDB');
?>

<!--app-content open-->
<div class="container content-area">
    <section class="section">

        <!--page-header open-->
        <div class="page-header">
            <h4></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>Manage_dashboard"
                        class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Main/BusinessType"
                        class="text-light-color">Business Type</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $add_edit; ?> Business Type</li>
            </ol>
        </div>
        <!--page-header closed-->

        <!--row open-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo $add_edit; ?> Business Type</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $form; ?>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="validationCustom02"
                                placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label>Module</label>
                            <select class="form-control" name="module" required>
                                <option value="">Select Module</option>
                                <?php
                                if (!empty($modules)) {
                                    foreach ($modules as $row) {
                                        ?>
                                <option value="<?php echo $row->id ?>"><?php echo $row->display_name ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="checkbox mb-2">

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