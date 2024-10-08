<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">


<div class="tab-pane" id="media">
    <div class="row justify-content-center">
        <?php
        $course_media_files = themeConfiguration(get_frontend_settings('theme'), 'course_media_files');
        $course_media_placeholders = themeConfiguration(get_frontend_settings('theme'), 'course_media_placeholders');
        foreach ($course_media_files as $course_media => $size) : ?>
            <div class="col-xl-12">
                <div class="form-group row mb-3">
                    <label class="col-sm-4 col-md-5 col-form-label" for="<?php echo $course_media; ?>_label"><?php echo get_phrase('bootcamp_thumbnail'); ?></label>
                    <div class="col-sm-8 col-md-7">
                        <div class="wrapper-image-preview" style="margin-left: -6px;">
                            <div class="box" style="width: 250px;">
                                <div class="js--image-preview" style="background-image: url(<?php echo base_url() . 'uploads/bootcamp/bootcamp_thumbnail/' . $bootcamp_details['bootcamp_thumbnail'] ?>); background-color: #F5F5F5;">
                                </div>
                                <div class="upload-options">
                                    <label for="<?php echo $course_media; ?>" class="btn"> <i class="mdi mdi-camera"></i> <?php echo get_phrase('bootcamp_thumbnail'); ?> <br>
                                        <small>(<?php echo $size; ?>)</small> </label>
                                    <input id="<?php echo $course_media; ?>" style="visibility:hidden;" type="file" class="image-upload" name="bootcamp_thumbnail" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>