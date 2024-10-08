<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">
<div class="tab-pane" id="pricing">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-group row mb-3">
                <div class="offset-md-2 col-md-10">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="is_free" id="is_free_course" value="1" onclick="togglePriceFields(this.id)">
                        <label class="custom-control-label" for="is_free_course"><?php echo get_phrase('check_if_this_is_a_free_nodule'); ?></label>
                    </div>
                </div>
            </div>

            <div class="paid-course-stuffs">
                <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="price"><?php echo get_phrase('course_price') . ' (' . currency_code_and_symbol() . ')'; ?></label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="price" name="price" placeholder="<?php echo get_phrase('enter_price'); ?>" min="0">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="offset-md-2 col-md-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="discount_flag" id="discount_flag" value="1">
                            <label class="custom-control-label" for="discount_flag"><?php echo get_phrase('check_if_this_module_has_discount'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="discounted_price"><?php echo get_phrase('discounted_price') . ' (' . currency_code_and_symbol() . ')'; ?></label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" name="discounted_price" id="discounted_price" onkeyup="calculateDiscountPercentage(this.value)" min="0">
                        <small class="text-muted"><?php echo get_phrase('this_module_has'); ?> <span id="discounted_percentage" class="text-danger">0%</span>
                            <?php echo get_phrase('discount'); ?></small>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label"><?php echo get_phrase('Expiry period'); ?></label>
                <div class="col-md-10 pt-2 d-flex">
                    <div class="custom-control custom-radio mr-2">
                        <input type="radio" id="lifetime_expiry_period" name="expiry_period" class="custom-control-input" value="lifetime" onchange="checkExpiryPeriod(this)" checked>
                        <label class="custom-control-label" for="lifetime_expiry_period"><?php echo get_phrase('Lifetime'); ?></label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="limited_expiry_period" name="expiry_period" class="custom-control-input" value="limited_time" onchange="checkExpiryPeriod(this)">
                        <label class="custom-control-label" for="limited_expiry_period"><?php echo get_phrase('Limited time'); ?></label>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-3" id="number_of_month" style="display: none">
                <label class="col-md-2 col-form-label"><?php echo get_phrase('Number of month'); ?></label>
                <div class="col-md-10">
                    <input class="form-control" type="number" name="number_of_month" min="1">
                    <small class="badge badge-light"><?php echo get_phrase('After purchase, students can access the course until your selected time.'); ?></small>
                </div>
            </div>
        </div>
    </div>
</div>