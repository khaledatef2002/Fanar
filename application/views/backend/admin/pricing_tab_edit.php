<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">
<div class="tab-pane" id="pricing">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="form-group row mb-3">
                <div class="offset-md-2 col-md-10">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="is_free" id="is_free_course" value="1" <?php if ($bootcamp_details['is_free'] == 1) echo 'checked'; ?> onclick="togglePriceFields(this.id)">
                        <label class="custom-control-label" for="is_free_course"><?php echo get_phrase('check_if_this_is_a_free_nodule'); ?></label>
                    </div>
                </div>
            </div>

            <div class="paid-course-stuffs">
                <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="price"><?php echo get_phrase('module_price') . ' (' . currency_code_and_symbol() . ')'; ?></label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="price" name="price" min="0" placeholder="<?php echo get_phrase('enter_module_price'); ?>" value="<?php echo $bootcamp_details['price']; ?>" required>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="offset-md-2 col-md-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="discount_flag" id="discount_flag" value="1" <?php if ($bootcamp_details['discount_flag'] == 1) echo 'checked'; ?>>
                            <label class="custom-control-label" for="discount_flag"><?php echo get_phrase('check_if_this_module_has_discount'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="discounted_price"><?php echo get_phrase('discounted_price') . ' (' . currency_code_and_symbol() . ')'; ?></label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" name="discounted_price" id="discounted_price" onkeyup="calculateDiscountPercentage(this.value)" value="<?php echo $bootcamp_details['discounted_price']; ?>" min="0">
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
                        <input type="radio" id="lifetime_expiry_period" name="expiry_period" class="custom-control-input" value="lifetime" onchange="checkExpiryPeriod(this)" <?php if ($bootcamp_details['expiry_period'] == 'lifetime') echo 'checked'; ?>>
                        <label class="custom-control-label" for="lifetime_expiry_period"><?php echo get_phrase('Lifetime'); ?></label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="limited_expiry_period" name="expiry_period" class="custom-control-input" value="limited_time" onchange="checkExpiryPeriod(this)" <?php if ($bootcamp_details['expiry_period'] == 'limited_time') echo 'checked'; ?>>
                        <label class="custom-control-label" for="limited_expiry_period"><?php echo get_phrase('Limited time'); ?></label>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-3" id="number_of_month" style="<?php if ($bootcamp_details['expiry_period'] == '') echo 'display: none'; ?>">
                <label class="col-md-2 col-form-label"><?php echo get_phrase('Number of month'); ?></label>
                <div class="col-md-10">
                    <input class="form-control" type="number" name="number_of_month" min="1" value="<?php echo $bootcamp_details['number_of_month']; ?>">
                    <small class="badge badge-light"><?php echo get_phrase('After purchase, students can access the module until your selected time.'); ?></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var expiry_period = "<?php echo $bootcamp_details['expiry_period'] ?>";
        if (expiry_period == 'lifetime') {
            $('#number_of_month').css('display', 'none');
        }
    });
</script>