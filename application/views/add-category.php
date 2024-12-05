<div class="">
   
<div class="breadcrumb-area">
    <h1>Add Category</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
        <li class="item"><a href="<?php echo base_url() ?>Categories">Categories</a></li>
        <li class="item">Add Category</li>
    </ol>
</div>

   <div class="job-list-area">
        <div class="container my-profile-box">
            <div class="section-title">
               <h4 class="mt-3">Add Category</h4>
            </div>
             <div>
             <!-- <form id="contactForm" action="Category/addcategory" method="post"> -->
                  <?php echo form_open('Categories/addcategory'); ?>
                        <div class="row">
                           <div class="col-lg-6 col-md-6">
                              <div class="form-group">
                              <label class="form-label" for="category_name">Category name</label>
                                 <input type="text" class="form-control" name='category_name' placeholder="Your Name" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-6">
                              <div class="form-group">
                              <label class="form-label" for="title">Title</label>
                                 <input type="text" class="form-control" name='title' placeholder="Title for category" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>

                           <div class="col-lg-12  mt-3">
                              <div class="form-group">
                              <label class="form-label" for="description">Description</label>
                                 <input type="text" class="form-control" name='description' placeholder="Description for category" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                          
                           
                        </div>
                        <div class="col-lg-12  text-center " >
                              <button type="submit" class="default-btn ext-center" >Add</button>
                              
                           </div>
            </form>
             </div>
            
               
        </div>
    </div>
</div> 