<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">


<div class="tab-pane" id="info">
    <div class="row">
        <div class="col-12">
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="faq"><?php echo get_phrase('bootcamp_faq'); ?></label>
                <div class="col-md-10">
                    <div id="faq_area">

                        <div class="d-flex mt-2">
                            <div class="flex-grow-1 px-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                    <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                </div>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendFaq()"> <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
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
                        <div class="d-flex mt-2">
                            <div class="flex-grow-1 px-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                </div>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendRequirement()"> <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
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
                        <div class="d-flex mt-2">
                            <div class="flex-grow-1 px-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="outcomes[]" id="outcomes" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                </div>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
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