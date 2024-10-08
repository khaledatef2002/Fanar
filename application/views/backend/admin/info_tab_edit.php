<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">


<?php

$faq_title = !empty($bootcamp_details['faqs']) ? json_decode($bootcamp_details['faqs']) : [];
$faq_description = !empty($bootcamp_details['faq_descriptions']) ? json_decode($bootcamp_details['faq_descriptions']) : [];

$faqs = [];
for ($i = 0; $i < count($faq_title); $i++) {
    $faqs[$faq_title[$i]] = $faq_description[$i];
}

?>

<div class="tab-pane" id="info">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="faq"><?php echo get_phrase('bootcamp_faq'); ?></label>
                <div class="col-md-10">
                    <div id="faq_area">
                        <?php $faq_counter = 0; ?>
                        <?php foreach ($faqs as $faq_title => $faq_description) : ?>
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $faq_title; ?>" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                        <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"><?php echo $faq_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="">
                                    <?php if ($faq_counter == 0) : ?>
                                        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendFaq()"> <i class="fa fa-plus"></i> </button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFaq(this)"> <i class="fa fa-minus"></i> </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $faq_counter++; ?>
                        <?php endforeach; ?>

                        <?php if ($faq_counter == 0) : ?>
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                        <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendFaq()"> <i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div id="blank_faq_field">
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                        <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFaq(this)"> <i class="fa fa-minus"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-3 pt-2">
                <label class="col-md-2 col-form-label" for="requirements"><?php echo get_phrase('requirements'); ?></label>
                <div class="col-md-10">
                    <div id="requirement_area">
                        <?php if (count(json_decode($bootcamp_details['requirements'])) > 0) : ?>
                            <?php
                            $counter = 0;
                            foreach (json_decode($bootcamp_details['requirements']) as $requirement) : ?>
                                <?php if ($counter == 0) :
                                    $counter++; ?>
                                    <div class="d-flex mt-2">
                                        <div class="flex-grow-1 px-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>" value="<?php echo $requirement; ?>">
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendRequirement()"> <i class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="d-flex mt-2">
                                        <div class="flex-grow-1 px-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>" value="<?php echo $requirement; ?>">
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeRequirement(this)"> <i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendRequirement()"> <i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div id="blank_requirement_field">
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeRequirement(this)"> <i class="fa fa-minus"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-3 pt-2">
                <label class="col-md-2 col-form-label" for="outcomes"><?php echo get_phrase('outcomes'); ?></label>
                <div class="col-md-10">
                    <div id="outcomes_area">
                        <?php if (count(json_decode($bootcamp_details['outcomes'])) > 0) : ?>
                            <?php
                            $counter = 0;
                            foreach (json_decode($bootcamp_details['outcomes']) as $outcome) : ?>
                                <?php if ($counter == 0) :
                                    $counter++; ?>
                                    <div class="d-flex mt-2">
                                        <div class="flex-grow-1 px-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="outcomes[]" placeholder="<?php echo get_phrase('provide_outcomes'); ?>" value="<?php echo $outcome; ?>">
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="d-flex mt-2">
                                        <div class="flex-grow-1 px-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="outcomes[]" placeholder="<?php echo get_phrase('provide_outcomes'); ?>" value="<?php echo $outcome; ?>">
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeOutcome(this)"> <i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="outcomes[]" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div id="blank_outcome_field">
                            <div class="d-flex mt-2">
                                <div class="flex-grow-1 px-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="outcomes[]" id="outcomes" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeOutcome(this)"> <i class="fa fa-minus"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>