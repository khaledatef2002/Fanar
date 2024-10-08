<?php include "breadcrumb.php"; ?>

<?php $website_faqs = json_decode(get_frontend_settings('website_faqs'), true); ?>
<?php if(count($website_faqs) > 0 || true): ?>
<!---------- Questions Section Start  -------------->
<section class="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-12 d-flex align-items-center">
                <div class="faq-img d-none d-md-inline-block">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/faq2.jpg') ?>">
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="faq-accrodion">
                    <div class="faq-acc-heading">
                        <h4><?php echo get_phrase('FAQS') ?></h4>
                        <h1><?php echo get_phrase('Looking for answers?') ?></h1>
                    </div>
                    <div class="accordion" id="accordionFaq">
                        <!-- Faq 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading1'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel1'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel1'; ?>">
                                    <?php echo get_phrase('faq_h_1'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel1'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading1'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_1')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading2'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel2'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel2'; ?>">
                                    <?php echo get_phrase('faq_h_2'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel2'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading2'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_2')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading3'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel3'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel3'; ?>">
                                    <?php echo get_phrase('faq_h_3'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel3'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading3'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_3')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading4'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel4'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel4'; ?>">
                                    <?php echo get_phrase('faq_h_4'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel4'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading4'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_4')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading5'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel5'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel5'; ?>">
                                    <?php echo get_phrase('faq_h_5'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel5'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading5'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_5')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 6 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading6'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel6'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel6'; ?>">
                                    <?php echo get_phrase('faq_h_6'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel6'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading6'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_6')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 7 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading7'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel7'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel7'; ?>">
                                    <?php echo get_phrase('faq_h_7'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel7'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading7'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_7')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 8 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading8'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel8'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel8'; ?>">
                                    <?php echo get_phrase('faq_h_8'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel8'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading8'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_8')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 9 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading9'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel9'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel9'; ?>">
                                    <?php echo get_phrase('faq_h_9'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel9'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading9'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_9')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 10 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading10'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel10'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel10'; ?>">
                                    <?php echo get_phrase('faq_h_10'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel10'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading10'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_10')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 11 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading11'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel11'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel11'; ?>">
                                    <?php echo get_phrase('faq_h_11'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel11'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading11'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_11')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 12 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading12'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel12'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel12'; ?>">
                                    <?php echo get_phrase('faq_h_12'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel12'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading12'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_12')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Faq 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo 'faqItemHeading13'; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel13'; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel13'; ?>">
                                    <?php echo get_phrase('faq_h_13'); ?>
                                </button>
                            </h2>
                            <div id="<?php echo 'faqItempanel13'; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading13'; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br(get_phrase('faq_p_13')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Questions Section End  -------------->
<?php endif; ?>