<div class="">
   <div class="job-list-area">
        <div class="container my-profile-box">
            <div class="section-title">
               <h2>Add Category</h2>
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

                           <div class="col-lg-6 col-md-6 mt-3">
                              <div class="form-group">
                              <label class="form-label" for="description">Description</label>
                                 <input type="text" class="form-control" name='description' placeholder="Description for category" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                          
                           <div class="col-lg-6 col-md-6  text-center mt-5" >
                              <button type="submit" class="default-btn ext-center" >Add</button>
                              
                           </div>
                        </div>
            </form>
             </div>
            
               
        </div>
    </div>
</div> 