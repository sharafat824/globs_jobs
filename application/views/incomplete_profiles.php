<div class="">
<div class="breadcrumb-area">
<h1>Incomplete Profiles</h1>
<ol class="breadcrumb">
<li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Home</a></li>
<li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
<li class="item">Incomplete Profiles</li>
</ol>
</div>
   <div class="job-list-area">
        <div class="container">
            <div class="section-title">
               <h2>Incomplete Profiles</h2>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>UserRole</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (count($employees)):
                    $cnt = 1;
                    foreach ($employees as $row):
                        $encrypted_id = $this->encrypt->encode($row->user_email);
                        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
                ?>
                    <tr>
                        
                        <td><?php echo $row->user_email ?></td>
                        <td>Employee</td>
                        <td>
                            <a href="<?php echo base_url(); ?>Manage_Incomplete_Profiles/send_profile_email/<?php echo $encrypted_id; ?>"  class="default-btn default-btn-0" > SendEmail <i class="flaticon-list-1"></i></a>
                        </td>
                    </tr>
                <?php
                    endforeach;
                    endif;
                ?>
                <?php
                if (count($employers)):
                    $cnt = 1;
                    foreach ($employers as $row):
                        $encrypted_id = $this->encrypt->encode($row->user_email);
                        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
                ?>
                    <tr>
                        
                        <td><?php echo $row->user_email ?></td>
                        <td>Employer</td>
                        <td>
                            <a href="<?php echo base_url(); ?>Manage_Incomplete_Profiles/send_profile_email/<?php echo $encrypted_id; ?>"  class="default-btn  default-btn-0" > SendEmail <i class="flaticon-list-1"></i></a>
                        </td>
                    </tr>
                <?php
                    endforeach;
                    endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
