<?php ini_set('display_errors', 1); ?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="<?= site_url('addons/bundle/add_course_bundle'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4><?= get_phrase('bundle_add_form'); ?></h4>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="bundle_title"><?php echo get_phrase('title'); ?> <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="bundle_title" name = "title" placeholder="<?php echo get_phrase('course_bundle_title'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="select_bundle_courses"><?php echo get_phrase('select_courses'); ?> <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <?php
                                $user_id = $this->session->userdata('user_id');
                                $courses = $this->crud_model->get_courses_by_user_id($user_id)['active']->result_array();
                            ?>
                            <select name="course_ids[]" id="select_bundle_courses" onchange="current_price_of_selected_courses(this)" class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." required>
                                <?php foreach($courses as $course): ?>
                                    <option value="<?= $course['id']; ?>"><?= $course['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-muted" id="current_price_of_the_courses"><?= get_phrase('current_price_of_the_courses_is').' '.currency('0'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="price"><?php echo get_phrase('bundle_price'); ?> <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="price" name = "price" placeholder="<?php echo get_phrase('price'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="subscription_limit"><?php echo get_phrase('subscription_renew_days'); ?> <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="subscription_limit" name = "subscription_limit" placeholder="<?php echo get_phrase('count_day'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="sub_category_id"><?php echo get_phrase('category'); ?><span class="required">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control select2" data-toggle="select2" name="sub_category_id" id="sub_category_id" required>
                                <option value=""><?php echo get_phrase('select_a_category'); ?></option>
                                <?php foreach ($categories->result_array() as $category): ?>
                                    <optgroup label="<?php echo $category['name']; ?>">
                                        <?php $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                                        foreach ($sub_categories as $sub_category): ?>
                                            <option value="<?php echo $sub_category['id']; ?>"><?php echo $sub_category['name']; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted"><?php echo get_phrase('select_sub_category'); ?></small>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="banner">
                            <?php if(get_frontend_settings('theme') == 'default-new'): ?>
                                <?php echo get_phrase('Thumbnail'); ?>
                            <?php else: ?>
                                <?php echo get_phrase('Banner'); ?>
                            <?php endif; ?>
                        </label>
                        <div class="col-md-9">
                            <input type="file" class="form-control" id="banner" name = "banner">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="bundle_details"><?php echo get_phrase('bundle_details'); ?></label>
                        <div class="col-md-9">
                            <textarea name="bundle_details" id = "bundle_details" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right"><?= get_phrase('create_bundle'); ?></button>
                    </div>
                </form>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
<script>
    "use strict";
    $(document).ready(function () {
        initSummerNote(['#bundle_details']);
    });
</script>
<?php include 'course_bundle_script.php'; ?>