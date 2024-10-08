<?php if (get_frontend_settings('recaptcha_status')) : ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<!---------- Header Section End  ---------->
<section class="sign-up py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-11 d-flex justify-content-center">
                <div class="sing-up-right p-3 rounded-4">
                    <h3 class="fs-1 text-center"><?php echo get_phrase('Log In'); ?></h3>
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

                    <form action="<?php echo site_url('login/validate_login') ?>" method="post">
                        <div class="mb-5">
                            <div class="position-relative">
                                <label for="email" class="ps-3"><?php echo get_phrase('Your email'); ?></label>
                                <input class="form-control ps-3" id="email" type="email" name="email">
                            </div>
                        </div>
                        <div class="">
                            <div class="position-relative">
                                <label for="password" class="ps-3"><?php echo get_phrase('Password') ?></label>
                                <!-- <i class="fa-solid fas fa-eye cursor-pointer" onclick="if($('#password').attr('type') == 'text'){$('#password').attr('type', 'password');}else{$('#password').attr('type', 'text');} $(this).toggleClass('fa-eye'); $(this).toggleClass('fa-eye-slash') " style="right: 20px; left: unset;"></i> -->
                                <input class="form-control ps-3" id="password" type="password" name="password">
                            </div>
                            <small class="w-100">
                                <a class="text-end w-100 text-muted forget-password mt-4" href="<?php echo site_url('login/forgot_password_request'); ?>"><?php echo get_phrase('Forgot password?'); ?></a>
                            </small>
                        </div>
                        <?php if (get_frontend_settings('recaptcha_status')) : ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                        <?php endif; ?>
                        <div class="log-in">
                            <button type="submit" class="btn rounded-5 my-2">
                                <?php echo get_phrase('Log in') ?>
                            </button>
                        </div>
                    </form>

                    <div class="another text-center">
                        <p class="mb-0">
                            <?php echo get_phrase('Don`t have an account?') ?>
                            <a href="<?php echo site_url('sign_up') ?>"><?php echo get_phrase('Sign up') ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(isset($_SESSION['instructor_success'])): ?>

    <div class="modal show" id="commingSoon" tabindex="-1" aria-modal="true" role="dialog" style="display: block;background: #00000085;">
        <div class="modal-dialog h-100 d-flex justify-content-center align-items-center m-0 mx-auto">
            <div class="modal-content bg-white">
                <div class="modal-body text-center py-4 px-4 text-dark">
                    <i class="fa-regular fa-circle-check text-success fs-1"></i>
                    <h2><?php echo $_SESSION['instructor_success']; ?></h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#commingSoon').hide()"><?php echo get_phrase('close'); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>