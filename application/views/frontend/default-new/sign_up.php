<?php if (get_frontend_settings('recaptcha_status')) : ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<!---------- Header Section End  ---------->
<section class="sign-up py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-11 d-flex justify-content-center">
                <div class="sing-up-right p-3 rounded-4">
                    <h3 class="fs-1 text-center"><?php echo get_phrase('Sign Up'); ?></h3>
                    <p class="text-center mb-4"><?php echo get_phrase('Explore, learn, and grow with us. Enjoy a seamless and enriching educational journey. Lets begin!') ?></p>

                    <div class="social-media">
                        <div class="row">
                            <div class="col-md-12 text-center">
                            <?php if (get_settings('fb_social_login')) : ?>
                                <!-- <button type="button" class="btn btn-primary"><a href="#"><img loading="lazy" src="image/facebook.png"> Facebook</a></button> -->
                                <?php include "facebook_login.php"; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if (get_settings('fb_social_login')){ ?> <h5 class="or text-center mb-5"><?php echo get_phrase('Or') ?></h5> <?php } ?>

                    <form action="<?php echo site_url('login/register') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="ps-3" for="first_name"><?php echo get_phrase('First Name'); ?></label>
                                <input class="form-control ps-3" id="first_name" type="text" name="first_name" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="ps-3" for="last_name"><?php echo get_phrase('Last Name'); ?></label>
                                <input class="form-control ps-3" id="last_name" type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="ps-3" for="email"><?php echo get_phrase('Your email'); ?></label>
                                <input class="form-control ps-3" id="email" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="ps-3" for="password"><?php echo get_phrase('Password') ?></label>
                                <!-- <i class="fa-solid fas fa-eye cursor-pointer" onclick="if($('#password').attr('type') == 'text'){$('#password').attr('type', 'password');}else{$('#password').attr('type', 'text');} $(this).toggleClass('fa-eye'); $(this).toggleClass('fa-eye-slash') " style="right: 20px; left: unset;"></i> -->
                                <input class="form-control ps-3" id="password" type="password" name="password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5><?php echo get_phrase('Phone'); ?></h5>
                            <div class="select-box">
                                <div class="selected-option">
                                    <div class="country_data d-flex align-items-center column-gap-1">
                                        <span id="default-country-icon" class="ms-2"></span>&nbsp;
                                        <strong id="default-tel-code">+971</strong>
                                    </div>
                                    <input class="form-control" id="phone" type="number" name="phone" placeholder="<?php echo get_phrase('Enter your phone number'); ?>">
                                    <input type="hidden" name="tel_code" id="tel_code" value="+971">
                                </div>
                                <div class="options">
                                    <ol id="countries_list"></ol>
                                </div>
                            </div>
                        </div>

                        <?php if (get_frontend_settings('recaptcha_status')) : ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                        <?php endif; ?>

                        <div class="log-in">
                            <button type="submit" class="btn rounded-5 my-3">
                                <?php echo get_phrase('Sign Up') ?>
                            </button>
                        </div>
                    </form>

                    <div class="another text-center">
                        <p class="mb-0">
                            <?php echo get_phrase('Already you have an account?') ?>
                            <a href="<?php echo site_url('login') ?>"><?php echo get_phrase('Log In') ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>