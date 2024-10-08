<?php $total = $bundle_details['price']; ?>
<!-- Checking if user entered a non empty coupon code -->
<?php if (isset($coupon_code) && !empty($coupon_code)) : ?>
    <!-- Check if coupon is not expired -->
    <?php $coupon_details = $this->crud_model->get_coupon_details_by_code($coupon_code)->row_array(); ?>
    <!-- Appling Conditions -->
    <?php $appliable = $this->coupon_model->is_coupon_conditions_appliable_bundle($coupon_code, $bundle_details['id']); ?>
    <!-- Check if Coupon Conditions is valid -->
    <?php if($appliable): ?>
        <!-- Get Discount Price And Echo Success -->
        <?php $coupon_discounted_price = $this->coupon_model->calc_discount_bundle($coupon_code, $bundle_details['id']); ?>
        <div class="alert alert-success text-13px text-center py-2" role="alert">
            <?php if($coupon_details['discount_type'] == 'percent'): ?>
                <?php echo get_phrase('You received').' '.currency($coupon_discounted_price).' ('.$coupon_details['discount']; ?>%) <?php echo site_phrase('coupon discount'); ?>
            <?php else: ?>
                <?php echo get_phrase('You received').' '.currency($coupon_discounted_price); ?> <?php echo site_phrase('coupon discount'); ?>
            <?php endif; ?>
        </div>
        <!-- Calc new price -->
        <?php
            $total = $total - $coupon_discounted_price;
            $total = ($total > 0) ? $total : 0;
            $this->session->set_userdata('bundle_applied_coupon', $coupon_code);
        ?>
    <?php else: ?>
        <div class="alert alert-danger text-13px text-center py-2 d-block" role="alert">
            <?php echo $this->coupon_model->get_error(); ?>
            <?php $this->session->set_userdata('bundle_applied_coupon', null); ?>
        </div>
    <?php endif; ?>
<!-- Checking if user entered empty copoun code -->
<?php elseif(isset($coupon_code) && empty($coupon_code)): ?>
    <div class="alert alert-danger text-13px text-center py-2" role="alert">
        <?php echo get_phrase('please enter your coupon code'); ?>
        <?php $this->session->set_userdata('applied_coupon', null); ?>
    </div>
<?php else: ?>
    <?php $this->session->set_userdata('applied_coupon', null); ?>
<?php endif; ?>
<h1 class="fw-500 m-0 p-0 d-flex align-items-center"><?php echo currency($total); ?> <?php if(isset($coupon_discounted_price) && !empty($coupon_discounted_price)) { ?><p class="fw-300 m-0 ms-2 p-0 fs-4 text-decoration-line-through text-danger"><?php echo $bundle_details['price']; ?></p><?php } ?></h1>