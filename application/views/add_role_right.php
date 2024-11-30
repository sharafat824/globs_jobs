<?php
$form = form_open('Manage_role/updateRights');
?>

<div class="container-fluid content-area">

        <!--page-header open-->
        <div class="page-header">
            <h4></h4>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Manage_dashboard" class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-light-color">Administration</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Manage_role" class="text-light-color">Manage Role</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Role Right</li>
            </ol>
        </div>
        <!--page-header closed-->

        <!--row open-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Role Right</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')) { ?><p onload="myFunction()"></p>
                        <?php } ?>

                        <?php $this->load->helper("form"); ?>
                        <?php echo $form; ?>
                        



                        <div class="form-group">
                            <label>Role Right Name</label>
                            <input type="text" name="module" class="form-control" id="validationCustom02" placeholder="Enter Module"  required>
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

</div>
