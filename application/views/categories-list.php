<div class="">
       
<div class="breadcrumb-area">
		<h1>Categories</h1>
		<ol class="breadcrumb">
			
			<li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
			<li class="item">Categories</li>
		</ol>
	</div>
   <div class="job-list-area">
        <div class="container">
            <div class="section-title">
               <h2>Categories</h2>
            </div>
              <div>
              
    
            <span style="float:right;">

                <a href="<?php echo base_url(); ?>categories/add_category/"  class="default-btn" > Add </a>

                </span>
	</div>
                
              </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>CategoryName</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (count($categories)):
                    $cnt = 1;
                    foreach ($categories as $row):
                        $encrypted_id = $this->encrypt->encode($row->id);
                        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
                ?>
                    <tr class="categories">
                        
                        <td><?php echo $cnt ?></td>
                        <td><?php echo $row->category_name ?></td>
                        <td><?php echo $row->title ?></td>
                        <td><?php echo $row->description ?></td>
                        <td class="d-flex gap-2">
                            <a href="<?php echo base_url(); ?>Categories/getcategory/<?php echo $encrypted_id; ?>"  class="option-btn text-center" ><i class="ri-pencil-line"></i> </a>

                            <a href="<?php echo base_url(); ?>Categories/deletecategory/<?php echo $encrypted_id; ?>"  class="option-btn text-center" >  <i class="ri-delete-bin-line"></i>
                            </a>
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

