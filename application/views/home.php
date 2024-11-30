<div class="main-banner-area-wrap">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="main-banner-content-wrap" data-speed="0.06" data-revert="true">
                    <h1 data-aos="fade-right" data-aos-delay="50" data-aos-duration="500">Explore the opportunity to get
                        your dream job</h1>
                    <!-- <p data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">Aegis Eagles is one of the most
                        significant supply chain challenges for high-value product industrialists and their logistics
                        service providers.</p> -->

                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="main-banner-wrap-image" data-speed="0.08" data-revert="true">
                    <img src="assets/images/main-banner/banner-three/banner-1.png" data-aos="fade-left"
                        data-aos-delay="50" data-aos-duration="500" data-aos-once="true" alt="image">
                </div>
            </div>
        </div>
    </div>
    <div class="main-banner-bg-shape">
        <img src="assets/images/main-banner/banner-three/banner-bg-shape.png" alt="image">
    </div>
</div>
<div class="top-category-area-without-color pt-100">
    <div class="container">
        <div class="section-title-wrap">
            <div class="row align-items-center">
                <div class="col-lg-9 col-md-12">
                    <div class="title-content">
                        <h2>Available Positions under Various Categories</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <!-- <div class="title-btn">
                        <a href="job-listing-1.html" class="default-btn">View All Category <i
                                class="flaticon-list-1"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
       <div class="row">
            
                 <?php 
                 if(count($categories)){
                   foreach ($categories as $row){
                 ?>
                 <div class="col-lg-4">
                 <a href="Welcome/all_jobs/<?php echo $row->id; ?>">   
                 <div class="top-category-card" style="text-align:center;">
                        <div class="category-image">
                            <img src="assets/images/category/category-3.png" alt="image">
                        </div>
                        <h3><a href="Welcome/all_jobs/<?php echo $row->id; ?>"><?php echo $row->category_name; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php $this->db->select('*');
                        $this->db->from('jobs');
                        $this->db->where('category',$row->id);
                        $this->db->where('deleted', NULL);
                        $this->db->where("approve", 1);
                        $query=$this->db->get();

                        echo ($query->num_rows());?></h3>
                    </div>
                   </a>
                </div>
                   <?php
                    }
                } ?>
        </div>
    </div>
</div>
<div class="job-seeker-area pt-100 pb-75">
    <div class="container">
        <div class="section-title">
            <h2>How Does JobsGlob Help the Job Seekers?</h2>
            <p>Find the best-suited position at JobsGlob to meet your career goals with the following simple steps.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="single-job-seeker-card">
                    <div class="seeker-image">
                        <img src="assets/images/job-seeker/seeker-1.png" alt="image">
                    </div>
                    <h3>Easy Registration</h3>
                    <div class="step">Step 1</div>
                </div>
                <div class="seeker-arrow-icon">
                    <img src="assets/images/job-seeker/layer-1.png" alt="image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-job-seeker-card">
                    <div class="seeker-image">
                        <img src="assets/images/job-seeker/seeker-2.png" alt="image">
                    </div>
                    <h3>Resume Submission</h3>
                    <div class="step">Step 2</div>
                </div>
                <div class="seeker-arrow-icon">
                    <img src="assets/images/job-seeker/layer-2.png" alt="image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-job-seeker-card">
                    <div class="seeker-image">
                        <img src="assets/images/job-seeker/seeker-3.png" alt="image">
                    </div>
                    <h3>Apply Jobs</h3>
                    <div class="step">Step 3</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="job-list-area pb-100">
    <div class="container">
        <div class="section-title">
            <h2>Ongoing Job Opportunities</h2>
            <p>Find the job of your interest that matches your profile and apply right away to avail one of the best opportunities in securities and services field.</p>
        </div>


        <div class="job-block-item">
            <div class="row align-items-center">
                <?php
				if (count($jobInfo)) :
					$cnt = 1;
					foreach ($jobInfo as $row) :
						$encrypted_id = $this->encrypt->encode($row->id);
						$encrypted_id=str_replace(array('/'), array('_'), $encrypted_id);
						?>
                <tr>
                    <div class="col-lg-12 col-sm-12">
                        <div class="job-list-inner-box">
                            <div class="row align-items-center">
                                <div class="col-lg-9">
                                    <div class="job-list-box">
                                        <div class="job-information">
                                            <div class="title-box">
                                                <h3>
                                                    <a
                                                        href="<?php echo base_url()?>Job/job_details/<?php echo $encrypted_id ?>">
                                                        <td><?php echo htmlentities($row->title) ?></td>
                                                    </a>
                                                </h3>
                                                <span>JobsGlob</span>
                                            </div>
                                            </br>
                                            <ul class="job-tag-list">
                                                <li>
                                                    <td><?php if($row->experience==1){
                                							echo "Fresh"; 
                                					   }
                                					   if($row->experience==2){
                                						   echo "OneYear Experience";
                                					   }
                                					   if($row->experience==3){
                                						  echo "TwoYear Experience";
                                					   }
                                					   if($row->experience==4){
                                						   echo "ThreeYear Experience";
                                						}
            										?></td>
                                                </li>

                                            </ul>
                                        </div>
                                        <ul class="location-information">
                                            <li><i class="ri-time-line"></i><?php if($row->career==1){
							
							echo "Basic"; 
					   }
					   if($row->career==2){
						   echo "Intermediate";
					   }
					   if($row->career==3){
						  echo "Advance";
					   }
									?></li>
                                            <li><i class="ri-map-pin-line"></i><?php echo htmlentities($row->address) ?>
                                            </li>
                                            <li><i class="ri-time-line"></i>
                                                <?php if($row->type==1) {
							
										 echo "PartTime"; 
									}
									if($row->type==2){
										echo "FullTime";
									}
									
									?></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php if($this->session->userdata['rolecode']=='') { ?>
                                <div class="col-lg-3">
                                    <div class="job-list-optional">
                                        <a href="<?php echo base_url()?>Manage_login" class="default-btn"> Apply Jobs <i
                                                class="flaticon-list-1"></i></a>
                                        <div class="save-text">

                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <tr>
                    &nbsp;

                    <?php
						$cnt++;
					endforeach;
				else :
					?>

                <tr>
                    <td colspan="6">No Record found</td>
                </tr>
                <?php
				endif;
				?>

            </div>
        </div>
    </div>
</div>
<div class="review-area ptb-100">
    <div class="container">
        <div class="review-title">
            <h2>Review Of The Users</h2>
            <!--<div class="layer-shape">-->
            <!--    <img src="assets/images/review/layer.png" alt="image">-->
            <!--</div>-->
        </div>
        <div class="review-slides owl-carousel owl-theme">
            <div class="review-single-card">
                <div class="review-info">
                    <div class="image">
                        <img src="assets/images/review/review-1.jpg" alt="image">
                    </div>
                    <div class="content">
                        <h3>Rebecca Johnson</h3>
                        <span>Security officer</span>
                        <div class="rating">
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    <i class="flaticon-left-quote"></i>
                    <p>JobsGlob is the best platform for naïve as well as experienced candidates. I registered myself on this portal and got the job of my interest in a minimal period. Thank You JobsGlob</p>
                </div>
            </div>
            <div class="review-single-card">
                <div class="review-info">
                    <div class="image">
                        <img src="assets/images/review/applicants-5.jpg" alt="image">
                    </div>
                    <div class="content">
                        <h3>Mark John</h3>
                        <span>Regional Manager</span>
                        <div class="rating">
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    <i class="flaticon-left-quote"></i>
                    <p>Being graduated with no job is a hell of stress. After wasting a lot of time on job hunting, one of my friends told me about JobsGlob that was the best decision of my life.</p>
                </div>
            </div>
            <div class="review-single-card">
                <div class="review-info">
                    <div class="image">
                        <img src="assets/images/review/applicants-3.jpg" alt="image">
                    </div>
                    <div class="content">
                        <h3>Andrew Parry</h3>
                        <span>Executive Manager</span>
                        <div class="rating">
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    <i class="flaticon-left-quote"></i>
                    <p>JobsGlob is the best platform for beginners who want to have a job right after their studies. I also am one of those who got this opportunity through the JobsGlob portal.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="blog-area pb-100 mt-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="blog-large-image">
                    <img src="assets/images/blog/blog-large.jpg" alt="image">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="blog-item-box">
                    <div class="content">
                        <h3>Read Our Article To Get <br> Tips & Tricks</h3>
                        <!--<div class="layer-shape">-->
                        <!--    <img src="assets/images/blog/layer.png" alt="image">-->
                        <!--</div>-->
                    </div>
                    <div class="blog-slides owl-carousel owl-theme">
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/2"><img
                                        src="assets/images/blog/blog-1.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/2">JobsGlob Will Help You To Hire In Month
                                        By Following
                                        Tips</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 24th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/2" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/3"><img
                                        src="assets/images/blog/blog-2.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/3">Whatever You Do, Make Sure It Will
                                        Make You Happy</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 25th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/3" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/1"><img
                                        src="assets/images/blog/blog-3.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/1">Points To Be Considered Before
                                        Accept Job Offer!</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 26th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/1" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/4"><img
                                        src="assets/images/blog/blog-4.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/4">How To Perform Well In A Group
                                        Discussion?</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 27th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/4" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/5"><img
                                        src="assets/images/blog/blog-5.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/5">3 Common Hiring Mistakes & How To
                                        Avoid Them</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 28th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/5" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/6"><img
                                        src="assets/images/blog/blog-6.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/6">General Working Rules For An Ideal
                                        Employer</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 21th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/6" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/7"><img
                                        src="assets/images/blog/blog-7.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/7">Important Things To Look For In A
                                        Great Resume</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 20th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/7" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                        <div class="blog-single-card">
                            <div class="blog-image">
                                <a href="<?php echo base_url(); ?>/Blog/index/8"><img
                                        src="assets/images/blog/blog-8.jpg" alt="image"></a>
                            </div>
                            <div class="blog-content">
                                <h3>
                                    <a href="<?php echo base_url(); ?>/Blog/index/8">Work Hard, Have Fun, And Make Your
                                        History</a>
                                </h3>
                                <span><i class="flaticon-calendar"></i> 11th February</span>
                                <a href="<?php echo base_url(); ?>/Blog/index/8" class="blog-btn">Read Article <i
                                        class="ri-arrow-right-s-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>