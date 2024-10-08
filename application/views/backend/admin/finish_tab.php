<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">

<div class="tab-pane" id="finish">
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?> !</h3>

                <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_just_one_click_away'); ?></p>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()" name="button"><?php echo get_phrase('submit'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>