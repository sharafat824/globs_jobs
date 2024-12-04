<?php
if (isset($userInfo) != NULL) {

$id = $userInfo->id;	
$category_name = $userInfo->category_name;
$title = $userInfo->title;
$description = $userInfo->description;

} 
?><div class="">
   <div class="job-list-area">
        <div class="container">
            <div class="section-title">
               <h2>Edit Category</h2>
            </div>
             <div>
             <!-- <form id="contactForm" action="Category/addcategory" method="post"> -->
                  <?php echo form_open('Categories/updatecategory'); ?>
                        <div class="row">
                           <div class="col-lg-6 col-md-6">
                           <input type="hidden" name="id" value="<?php echo $id; ?>"  />
                              <div class="form-group">
                                 <input type="text" class="form-control mb-3" name='category_name' required value="<?php echo $category_name; ?>">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-6 ">
                              <div class="form-group">
                                 <input type="text" class="form-control mb-3" name='title' required value="<?php echo $title; ?>">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
</div>
<div class="row mt-5">
                           <div class="col-lg-10  ">
                              <div class="form-group">
                                 <!-- <input type="text" class="form-control" name='description' required value="<?php echo $description; ?>"> -->
                                  <textarea
                                  class="form-control mb-3" name='description' required><?php echo htmlspecialchars($description); ?></textarea>
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                           <div class="col-lg-2 text-center">
                              <button type="submit" class="default-btn "; >Update</button >
                              
                           </div>
                        </div>
            </form>
             </div>
            
               
        </div>
    </div>
</div> 
