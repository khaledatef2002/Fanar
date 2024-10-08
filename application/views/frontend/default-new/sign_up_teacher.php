<?php if (get_frontend_settings('recaptcha_status')) : ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<!---------- Header Section End  ---------->
<section class="sign-up sign-up-teacher py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-11 d-flex justify-content-center">
                <div class="sing-up-right p-3 rounded-4">
                    <h3 class="fs-1 text-center"><?php echo get_phrase('Sign Up teacher'); ?></h3>
                    <p class="text-center"><?php echo get_phrase('teacher - Explore, learn, and grow with us. Enjoy a seamless and enriching educational journey. Lets begin!') ?></p>

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


                    <form action="<?php echo site_url('login/register_teacher') ?>" method="post" enctype="multipart/form-data">
                        <div class="d-flex flex-sm-row flex-column gap-4 w-100">
                            <div class="mb-sm-4 flex-fill">
                                <div class="position-relative">
                                    <label class="mb-1 ps-3" for="first_name"><?php echo get_phrase('First Name'); ?><span class="text-danger">*</span>:</label>
                                    <input class="form-control ps-3" id="first_name" type="text" name="first_name" required>
                                </div>
                            </div>
                            <div class="mb-4 flex-fill">
                                <div class="position-relative">
                                    <label class="mb-1 ps-3" for="last_name"><?php echo get_phrase('Last Name'); ?><span class="text-danger">*</span>:</label>
                                    <input class="form-control ps-3" id="last_name" type="text" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="mb-1 ps-3"><?php echo get_phrase('Your email'); ?><span class="text-danger">*</span>:</label>
                                <input class="form-control ps-3" id="email" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="mb-1 ps-3"><?php echo get_phrase('Password') ?><span class="text-danger">*</span>:</label>
                                <!-- <i class="fa-solid fas fa-eye cursor-pointer" onclick="if($('#password').attr('type') == 'text'){$('#password').attr('type', 'password');}else{$('#password').attr('type', 'text');} $(this).toggleClass('fa-eye'); $(this).toggleClass('fa-eye-slash') " style="right: 20px; left: unset;"></i> -->
                                <input class="form-control ps-3" id="password" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="mb-5">
                            <h5 class="mb-1"><?php echo get_phrase('Phone'); ?><span class="text-danger">*</span>:</h5>
                            <div class="select-box mb-5">
                                <div class="selected-option">
                                    <div class="country_data d-flex align-items-center column-gap-1">
                                        <span id="default-country-icon" class="ms-2"></span>&nbsp;
                                        <strong id="default-tel-code">+971</strong>
                                    </div>
                                    <input class="form-control" id="phone" type="number" name="phone" placeholder="<?php echo get_phrase('Enter your phone number'); ?>" required>
                                    <input type="hidden" name="tel_code" id="tel_code" value="+971">
                                </div>
                                <div class="options">
                                    <ol id="countries_list"></ol>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="mb-5">
                            <h5 class="mb-1"><?php echo get_phrase('CV'); ?><span class="text-danger">*</span>: <small>(doc, docs, pdf, txt, png, jpg, jpeg)</small></h5>
                            <div class="position-relative">
                                <input class="form-control ps-3" id="document" type="file" name="document" required>
                                <small><?php echo get_phrase('Provide some documents about your qualifications'); ?></small>
                            </div>
                        </div>
                        <!-- Country -->
                        <div class="mb-4">
                            <h5 class="mb-1"><?php echo get_phrase('country'); ?><span class="text-danger">*</span>:</h5>
                            <div class="position-relative">
                                <select class="form-control ps-3" name="country" required>
                                    <option disabled selected>--<?php echo get_phrase('please_choose_your_country'); ?>--</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 d-flex flex-wrap w-100">
                            <h5><?php echo get_phrase('gender'); ?><span class="text-danger">*</span>:</h5>
                            <div class="position-relative d-flex justify-content-evenly flex-fill">
                                <div>
                                    <input id="male-input" type="radio" name="gender" value="1" required>
                                    <label for="male-input"><?php echo get_phrase('male'); ?></label>
                                </div>
                                <div>
                                    <input id="fe-male-input" type="radio" name="gender" value="0" required>
                                    <label for="fe-male-input"><?php echo get_phrase('fe-male'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="mb-4 flex-fill">
                                <h5 class="mb-2"><?php echo get_phrase('mother_language'); ?><span class="text-danger">*</span>:</h5>
                                <div class="position-relative d-flex flex-column gap-2 ms-4">
                                    <div>
                                        <input id="mother-lang-english-input" type="radio" name="mother_lang" value="0" required>
                                        <label for="mother-lang-english-input"><?php echo get_phrase('english'); ?></label>
                                    </div>
                                    <div>
                                        <input id="mother-lang-arabic-input" type="radio" name="mother_lang" value="1" required>
                                        <label for="mother-lang-arabic-input"><?php echo get_phrase('arabic'); ?></label>
                                    </div>
                                    <div>
                                        <input id="mother-lang-french-input" type="radio" name="mother_lang" value="2" required>
                                        <label for="mother-lang-french-input"><?php echo get_phrase('french'); ?></label>
                                    </div>
                                    <div>
                                        <input id="mother-lang-other-input" type="radio" name="mother_lang" value="3" required>
                                        <label for="mother-lang-other-input"><?php echo get_phrase('other'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 flex-fill">
                                <h5 class="mb-1"><?php echo get_phrase('other_language'); ?><span class="text-danger">*</span>:</h5>
                                <div class="position-relative d-flex flex-column gap-2 ms-4">
                                    <div>
                                        <input id="other-lang-english-input" type="checkbox" name="other_lang[]" value="0">
                                        <label for="other-lang-english-input"><?php echo get_phrase('english'); ?></label>
                                    </div>
                                    <div>
                                        <input id="other-lang-arabic-input" type="checkbox" name="other_lang[]" value="1">
                                        <label for="other-lang-arabic-input"><?php echo get_phrase('arabic'); ?></label>
                                    </div>
                                    <div>
                                        <input id="other-lang-french-input" type="checkbox" name="other_lang[]" value="2">
                                        <label for="other-lang-french-input"><?php echo get_phrase('french'); ?></label>
                                    </div>
                                    <div>
                                        <input id="other-lang-spanish-input" type="checkbox" name="other_lang[]" value="3">
                                        <label for="other-lang-spanish-input"><?php echo get_phrase('spanish'); ?></label>
                                    </div>
                                    <div>
                                        <input id="other-lang-other-input" type="checkbox" name="other_lang[]" value="4">
                                        <label for="other-lang-other-input"><?php echo get_phrase('other'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 d-flex flex-wrap w-100">
                            <h5><?php echo get_phrase('teacher_apply_as'); ?><span class="text-danger">*</span>:</h5>
                            <div class="position-relative d-flex justify-content-evenly flex-fill">
                                <div>
                                    <input id="full-time-input" type="radio" name="apply_as" value="1" required>
                                    <label for="full-time-input"><?php echo get_phrase('full-time-tutor'); ?></label>
                                </div>
                                <div>
                                    <input id="part-time-input" type="radio" name="apply_as" value="0" required>
                                    <label for="part-time-input"><?php echo get_phrase('part-time-tutor'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 w-100">
                            <h5><?php echo get_phrase('teacher_subjects'); ?><span class="text-danger">*</span>:</h5>
                            <div class="position-relative ms-4 d-flex flex-wrap">
                                <div class="d-flex flex-column gap-3 col-6">
                                    <div>
                                        <input id="arabic-input" type="checkbox" name="subjects[]" value="0">
                                        <label for="arabic-input"><?php echo get_phrase('arabic'); ?></label>
                                    </div>
                                    <div>
                                        <input id="english-input" type="checkbox" name="subjects[]" value="1">
                                        <label for="english-input"><?php echo get_phrase('english'); ?></label>
                                    </div>
                                    <div>
                                        <input id="math-input" type="checkbox" name="subjects[]" value="2">
                                        <label for="math-input"><?php echo get_phrase('math'); ?></label>
                                    </div>
                                    <div>
                                        <input id="science-input" type="checkbox" name="subjects[]" value="3">
                                        <label for="science-input"><?php echo get_phrase('science'); ?></label>
                                    </div>
                                    <div>
                                        <input id="physics-input" type="checkbox" name="subjects[]" value="4">
                                        <label for="physics-input"><?php echo get_phrase('physics'); ?></label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-3 col-6">
                                    <div>
                                        <input id="chemistry-input" type="checkbox" name="subjects[]" value="5">
                                        <label for="chemistry-input"><?php echo get_phrase('chemistry'); ?></label>
                                    </div>
                                    <div>
                                        <input id="biology-input" type="checkbox" name="subjects[]" value="6">
                                        <label for="biology-input"><?php echo get_phrase('biology'); ?></label>
                                    </div>
                                    <div>
                                        <input id="islamic-input" type="checkbox" name="subjects[]" value="7">
                                        <label for="islamic-input"><?php echo get_phrase('islamic'); ?></label>
                                    </div>
                                    <div>
                                        <input id="robotics-input" type="checkbox" name="subjects[]" value="8">
                                        <label for="robotics-input"><?php echo get_phrase('robotics'); ?></label>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 col-12">
                                    <div class="d-flex align-items-center gap-1">
                                        <input id="others-input" type="checkbox" name="subjects[]" value="other">
                                        <label for="others-input"> <?php echo get_phrase('others'); ?>: </label>
                                    </div>
                                    <input type="text" name="other-subjects" class="form-control ps-2">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 d-flex flex-wrap w-100">
                            <h5><?php echo get_phrase('how_to_conduct'); ?><span class="text-danger">*</span>:</h5>
                            <div class="position-relative d-flex justify-content-evenly flex-fill">
                                <div>
                                    <input id="online-input" type="radio" name="how_to_conduct" value="0" required>
                                    <label for="online-input"><?php echo get_phrase('online'); ?></label>
                                </div>
                                <div>
                                    <input id="in-person-input" type="radio" name="how_to_conduct" value="1" required>
                                    <label for="in-person-input"><?php echo get_phrase('in-person'); ?></label>
                                </div>
                                <div>
                                    <input id="both-input" type="radio" name="how_to_conduct" value="2" required>
                                    <label for="both-input"><?php echo get_phrase('both'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                                <h5 class="mb-1"><?php echo get_phrase('prefered-school-level'); ?><span class="text-danger">*</span>:</h5>
                                <div class="position-relative d-flex flex-column gap-2 ms-3">
                                    <div>
                                        <input id="elementary-school-input" type="checkbox" name="prefered_school[]" value="0">
                                        <label for="elementary-school-input"><?php echo get_phrase('elementary-school'); ?></label>
                                    </div>
                                    <div>
                                        <input id="middle-school-input" type="checkbox" name="prefered_school[]" value="1">
                                        <label for="middle-school-input"><?php echo get_phrase('middle-school'); ?></label>
                                    </div>
                                    <div>
                                        <input id="high-school-input" type="checkbox" name="prefered_school[]" value="2">
                                        <label for="high-school-input"><?php echo get_phrase('high-school'); ?></label>
                                    </div>
                                    <div>
                                        <input id="university-school-input" type="checkbox" name="prefered_school[]" value="3">
                                        <label for="university-school-input"><?php echo get_phrase('university-school'); ?></label>
                                    </div>
                                </div>
                            </div>
                        <div class="mb-4 d-flex flex-wrap w-100">
                            <h5><?php echo get_phrase('are_you_committed_to_any_other_job_now'); ?>:</h5>
                            <div class="position-relative d-flex justify-content-evenly flex-fill">
                                <div>
                                    <input id="yes-input" type="radio" name="other_jobs" value="1">
                                    <label for="yes-input"><?php echo get_phrase('yes'); ?></label>
                                </div>
                                <div>
                                    <input id="no-input" type="radio" name="other_jobs" value="0">
                                    <label for="no-input"><?php echo get_phrase('no'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 d-flex flex-wrap w-100">
                            <h5><?php echo get_phrase('do-you-have-experince-in'); ?>:</h5>
                            <div class="position-relative d-flex justify-content-evenly flex-fill">
                                <div>
                                    <input id="special-input" type="radio" name="experince" value="1">
                                    <label for="special-input"><?php echo get_phrase('special-education'); ?></label>
                                </div>
                                <div>
                                    <input id="early-input" type="radio" name="experince" value="0">
                                    <label for="early-input"><?php echo get_phrase('early-education'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="mb-1 ps-3"><?php echo get_phrase('experince-years'); ?><span class="text-danger">*</span>:</label>
                                <input class="form-control ps-3" id="experince-years" type="number" min="0" name="experince-years" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <label class="mb-1 ps-3"><?php echo get_phrase('how-did-you-hear'); ?><span class="text-danger">*</span>:</label>
                                <input class="form-control ps-3" id="reference" type="text" name="reference" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5><?php echo get_phrase('message'); ?>:</h5>
                            <div class="position-relative">
                                <textarea class="form-control px-3" name="message" placeholder="<?php echo get_phrase('enter your message'); ?>"></textarea>
                            </div>
                        </div>
                        <?php if (get_frontend_settings('recaptcha_status')) : ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                        <?php endif; ?>

                        <div class="log-in">
                            <button type="submit" class="btn rounded-5 my-2">
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

<script>
    $(document).ready(function(){
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(data => {
                data.forEach(element => {
                    $("select[name='country']").append(`
                        <option value="${element.cca2}">${element.name.common}</option>
                    `)
                    console.log(element)
                });
            })
            .catch(error => console.error('Error fetching countries:', error));
    })
</script>