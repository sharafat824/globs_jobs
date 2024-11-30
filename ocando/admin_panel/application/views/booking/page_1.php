<div id="page_1">
    <!-- ALL THE M<AIN INPUT FIELDS FOR THE FORM -->
    <input type="hidden" id="postal_code" value="<?php echo $postalcode; ?>" />
    <input type="hidden" id="service_id" value="" />
    <div class="steps-bar-wrapper--brix">
        <div class="steps-bar---brix">
            <div class="form-step-number---brix completed---brix">1</div>
            <div class="form-step-progress-bar---brix">
                <div class="form-step-progress-bar---brix current-step---brix"></div>
            </div>
            <div class="form-step-number---brix">2</div>
            <div class="form-step-progress-bar---brix"></div>
            <div class="form-step-number---brix">3</div>
        </div>
        <div class="form-step-progress-bar-mobile---brix">
            <div class="form-step-progress-bar-mobile---brix step-1---brix"></div>
        </div>
    </div>

    <div class="form-content---brix">
        <div class="step-title-wrap---brix">
            <h3 class="step-title---brix">Hur kan vi hjälpa dig?</h3>
            <!-- <p class="step-paragraph---brix">Där du bor i <strong class="bold-text-3">Stockholm</strong>, erbjuder Zimpelt
            följande tjänster</p> -->
        </div>
        <div class="w-layout-grid grid-for-page-2 home-1">
            <!-- first button Hemstädning -->
            <?php
if (count($all_services)):
    $cnt = 1;
    foreach ($all_services as $row):
        $encrypted_id = $this->encrypt->encode($row->id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
        ?>

		            <div class="multi-step-form-grid-item---brix">
		                <label class="w-checkbox checkbox-item--brix">
		                    <div class="mainDiv w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"
		                        id="mainDiv_<?php echo $row->id; ?>"></div>
		                    <input type="check" class="radio" name="service_id" id="service_id"
		                        value="<?php echo $encrypted_id ?>" style="opacity:0;position:absolute;z-index:-1">
		                    <img src="<?php echo base_url() . "icons/" . $row->icon; ?>" alt="..."
		                        class="select-item-icon---brix">
		                    <span
		                        class="multi-step-form-label---brix no-margin---brix first-step w-form-label"><?php echo htmlentities($row->service_name) ?></span>
		                </label>
		            </div>
		            <?php $cnt++;
    endforeach;
endif;
?>
        </div>
        <div class="row mt-5">
            <div class="col-lg-7 col-md-7 col-sm-7"></div>
            <div class="col-lg-5 col-md-5 col-sm-5 text-end">
                <div class="right-button" id="page1_submit">
                    <div class="text-block-14 text-center">Fortsätt</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- First step page ends -->