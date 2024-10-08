<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">
<div class="tab-pane" id="seo">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="website_keywords"><?php echo get_phrase('meta_keywords'); ?></label>
                <div class="col-md-10">
                    <input type="text" class="form-control bootstrap-tag-input" id="meta_keywords" name="meta_keywords" data-role="tagsinput" style="width: 100%;" value="<?php echo $bootcamp_details['meta_keywords']; ?>" placeholder="<?php echo get_phrase('write_a_keyword_and_then_press_enter_button'); ?>" . />
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="meta_description"><?php echo get_phrase('meta_description'); ?></label>
                <div class="col-md-10">
                    <textarea name="meta_description" class="form-control"><?php echo $bootcamp_details['meta_description']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>