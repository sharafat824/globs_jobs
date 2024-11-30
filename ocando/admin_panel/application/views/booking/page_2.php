<div id="page_2">
    <div class="steps-bar-wrapper--brix">
        <div class="steps-bar---brix">
            <div class="form-step-number---brix completed---brix">1</div>
            <div class="form-step-progress-bar---brix">
                <div class="form-step-progress-bar---brix complete-step---brix"></div>
            </div>
            <div class="form-step-number---brix completed---brix">2</div>
            <div class="form-step-progress-bar---brix">
                <div class="form-step-progress-bar---brix current-step---brix"></div>
            </div>
            <div class="form-step-number---brix">3</div>
            <!-- <div class="form-step-progress-bar---brix"></div> -->
            <!-- <div class="form-step-number---brix">4</div> -->
        </div>
        <div class="form-step-progress-bar-mobile---brix">
            <div class="form-step-progress-bar-mobile---brix step-2---brix"></div>
        </div>
    </div>

    <div class="form-content---brix">
        <div class="step-title-wrap---brix">
            <h3 class="step-title---brix">Lämna specifika önskemål</h3>
            <p class="step-paragraph---brix">Här för du möjligheten att specificera din förfrågan.</p>
        </div>
        <div class="val-1 block">
            <div class="val-1-block">
                <p class="medium-black bigger">1. Välj boarea</p>
            </div>
            <div class="text-input">
                <input type="text" class="text-field w-input mb-4" maxlength="256" placeholder="Fyll i din boarea (m²)"
                    id="Boyta" required="">
            </div>
            <div class="val-1-block">
                <p class="medium-black bigger">2. Välj tillval</p>
            </div>
            <div id="sub_services" class="w-layout-grid first-step-grid---brix uniform-space---brix val-1">
            </div>
        </div>
        <div class="val-2">
            <div class="val-1 block">
                <div class="input-field-wrap">
                    <div class="field-label bigger">3. Föreslå ett datum</div>
                    <div class="field-wrap">
                        <input type="text" class="text-field-left-icon w-input" autocomplete="off" maxlength="256"
                            name="Datum-2" data-name="Datum 2" placeholder="Välj datum" data-toggle="datepicker"
                            id="Datum-2">
                        <img loading="lazy" src="<?php echo base_url(); ?>assets_frontend\imgs\pic7.svg" alt="..."
                            class="field-icon">
                    </div>
                </div>
            </div>
            <div class="val-1-block">
                <p class="medium-black">Välj adress:</p>
            </div>
            <input type="text" class="text-field w-input mb-4" maxlength="256" name="Adress" data-name="Adress"
                placeholder="Fyll i din adress" id="Adress" required="">
            <div class="double-div mb-4">
                <input type="text" class="text-field w-input" maxlength="256" name="Adress-2" data-name="Adress 2"
                    placeholder="Våning" id="Adress-2" required="">
                <input type="text" class="text-field w-input" maxlength="256" name="Adress-2" data-name="Adress 2"
                    placeholder="Portkod / Porttelefon" id="Adress-2" required="">
            </div>
            <div class="val-1-block">
                <p class="medium-black">Välj din bostadstyp:</p>
            </div>
            <div class="w-layout-grid first-step-grid---brix uniform-space---brix val-1 _20">
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Lägenhet</span>
                    </label>
                </div>
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Villa/Radhus</span>
                    </label>
                </div>
            </div>
            <div class="val-1-block">
                <p class="medium-black">Har du hiss?</p>
            </div>
            <div class="w-layout-grid first-step-grid---brix uniform-space---brix val-1 _20">
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix "></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Liten<br> (+2
                            pers)</span>
                    </label>
                </div>
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Mellan<br> (+4
                            pers)</span>
                    </label>
                </div>
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Stor<br> (+6
                            pers)</span>
                    </label>
                </div>
            </div>
            <div class="val-1-block">
                <p class="medium-black">Välj tillgång till bostad:</p>
            </div>
            <div class="w-layout-grid first-step-grid---brix uniform-space---brix val-1 _20">
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Jag lämnar dörren
                            öppen</span>
                    </label>
                </div>
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Lämna nyckel på
                            kontor</span>
                    </label>
                </div>
                <div class="val-1">
                    <label class="w-checkbox checkbox-item--brix val-1">
                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix"></div>
                        <input type="checkbox" style="opacity:0;position:absolute;z-index:-1">
                        <span class="multi-step-form-label---brix no-margin---brix w-form-label">Jag öppnar upp på
                            plats</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-7 col-md-6 col-sm-6 text-start">
                <div class="left-button" id="page2_back">
                    <div class="text-block-14 text-center">Gå tillbaka</div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-6 text-end">
                <div class="right-button" id="page2_submit">
                    <div class="text-block-14 text-center">Fortsätt</div>
                </div>
            </div>
        </div>
    </div>
</div>