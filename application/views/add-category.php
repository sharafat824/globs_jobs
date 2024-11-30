<div class="">
   <div class="job-list-area">
        <div class="container">
            <div class="section-title">
               <h2>Add Category</h2>
            </div>
             <div>
             <!-- <form id="contactForm" action="Category/addcategory" method="post"> -->
                  <?php echo form_open('Categories/addcategory'); ?>
                        <div class="row">
                           <div class="col-lg-6 col-md-6">
                              <div class="form-group">
                                 <input type="text" class="form-control" name='category_name' placeholder="Your Name" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-6">
                              <div class="form-group">
                                 <input type="text" class="form-control" name='title' placeholder="Title for category" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-6">
                              <div class="form-group">
                                 <input type="text" class="form-control" name='description' placeholder="Description for category" required data-error="Please enter your name">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                          
                           <div class="col-lg-6 col-md-6">
                              <button type="submit" class="default-btn">Add</button>
                              
                           </div>
                        </div>
            </form>
             </div>
            
               
        </div>
    </div>
</div> 