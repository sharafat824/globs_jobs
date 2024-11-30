<!doctype html>
<html lang="zxx">
   
   <body>
      
      <?php include APPPATH . 'views/includes/header.php'; ?>
      <div class="page-banner-area item-bg-two">
         <div class="d-table">
            <div class="d-table-cell">
               <div class="container">
                  <div class="page-banner-content">
                     <h2>Profile Authentication</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="profile-authentication-area ptb-100">
         <div class="container">
            <div class="profile-authentication-tabs">
               <div class="authentication-tabs-list">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item"> 
                        <a class="nav-link <?php if($page==1){?>  active <?php }?>" id="register-tab " data-bs-toggle="tab" href="#register" role="tab" aria-controls="register">Register</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link  <?php if($page==2){?> active <?php }?>" id="login-tab" data-bs-toggle="tab" href="#login" role="tab" aria-controls="login">Login</a>
                     </li>
                     
                     <li class="nav-item">
                        <a class="nav-link" id="reset-password-tab" data-bs-toggle="tab" href="#reset-password" role="tab" aria-controls="reset-password">Reset Password</a>
                     </li>
                  </ul>
               </div>
               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade <?php if($page==2){?> show active <?php }?>" id="login" role="tabpanel">
                     <div class="aess-authentication-form">
					 
                        <?php echo form_open('Manage_login/login'); ?>
                           <div class="form-group">
                              <input type="email" class="form-control" placeholder="Enter your email" name="emailid" required>
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                           </div>
                           <div class="row align-items-center">
                              <div class="g-recaptcha" data-sitekey="6LefTjslAAAAAFlYwtqSO1L5cqOD_8ccKkCJBAm7"></div>
                           </div>
                           <button type="submit" class="default-btn">Log In <i class="flaticon-send"></i></button>
                        </form>
                        
                     </div>
                  </div>
                  <div class="tab-pane fade <?php if($page==1){?> show active <?php }?>" id="register" role="tabpanel">
                     <div class="aess-authentication-form">
                        <?php echo form_open('Manage_login/register'); ?>
                           
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                           <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="3" checked>
                           <label class="btn btn-outline-primary" for="btnradio1">Register as Company</label>

                           <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="2">
                           <label class="btn btn-outline-primary" for="btnradio2">Register as Candidate</label>

                        </div>
                       

                           <div class="form-group mt-3">
                              <input type="email" class="form-control" name="emailid" placeholder="Enter your email" required>
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control" name="password" placeholder="Password" required>
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                           </div>
                           <div class="row align-items-center">
                              <div class="g-recaptcha" data-sitekey="6LefTjslAAAAAFlYwtqSO1L5cqOD_8ccKkCJBAm7"></div>
                           </div>
                           <button type="submit" class="default-btn">Register <i class="flaticon-send"></i></button>
                        </form>
                        
                     </div>
                  </div>
                  <div class="tab-pane fade" id="reset-password" role="tabpanel">
                     <div class="aess-authentication-form">
                        <?php echo form_open('Manage_login/email_forgot_password'); ?>
                           <div class="form-group">
                              <input type="email" class="form-control" name="emailid" placeholder="Enter  email" required>
                           </div>
                           <div class="row align-items-center">
                              <div class="g-recaptcha" data-sitekey="6LefTjslAAAAAFlYwtqSO1L5cqOD_8ccKkCJBAm7"></div>
                           </div>
                           <button type="submit" class="default-btn">Submit Now <i class="flaticon-send"></i></button>
                        </form>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
         <?php include APPPATH . 'views/includes/d-footer.php'; ?>
   </body>
</html>
