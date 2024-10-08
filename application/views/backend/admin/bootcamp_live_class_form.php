<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">


<?php
$url = 'addons/bootcamp/live_class/add';
$schedule = time();
if (isset($live_class)) {
    $url = 'addons/bootcamp/live_class/update/' . $live_class['id'];
    $bootcamp_id = $live_class['bootcamp_id'];
    $schedule = $live_class['class_schedule'];
}
$CI    = &get_instance();
$CI->load->database();
$modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp_id)->result_array();
?>

<form action="<?php echo site_url($url); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="bootcamp_id" value="<?php echo $bootcamp_id ?>">
    <?php if (isset($live_class)) : ?>
        <input type="hidden" name="old_schedule" value="<?php echo $live_class['class_schedule'] ?>">
    <?php endif; ?>
    <div class="form-group">
        <label for="live_class_title"><?php echo get_phrase('Title'); ?></label>
        <input type="text" name="title" class="form-control" id="live_class_title" <?php if (isset($live_class)) : ?> value="<?php echo $live_class['title']; ?>" <?php else : ?> placeholder="Live class title" <?php endif; ?>>
    </div>

    <div class="form-group">
        <label><?php echo get_phrase('class_schedule'); ?></label>
        <input type="datetime-local" name="class_schedule" class="form-control" <?php if (isset($live_class)) : ?> value="<?php echo date('Y-m-d H:i', $live_class['class_schedule']) ?>" <?php endif; ?>>
    </div>

    <div class="form-group">
        <label><?php echo get_phrase('estimated_time'); ?></label>
        <input type="datetime-local" name="estimated_time" class="form-control" <?php if (isset($live_class)) : ?> value="<?php echo date('Y-m-d H:i', $live_class['estimated_time']) ?>" <?php endif; ?>>
    </div>

    <div class="form-group">
        <label><?php echo get_phrase('module'); ?></label>
        <select class="form-control select2" data-toggle="select2" name="module_id">


            <?php if (isset($live_class)) : ?>
                <option value="<?php echo $live_class['module_id']; ?>"><?php echo $live_class['module_title']; ?></option>
            <?php else : ?>
                <option value="">Select a module</option>
            <?php endif; ?>


            <?php foreach ($modules as $module) : ?>
                <option value="<?php echo $module['id']; ?>"><?php echo $module['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="form-group">
        <label><?php echo get_phrase('status'); ?></label>
        <div class="d-flex align-items-center class_status_selector mb-2 gap-3">
            <div class="form-check">
                <input type="radio" class="form-check-input d-inline-flex" id="upcoming" name="status" value="upcoming" <?php if (isset($live_class) && $live_class['status'] == 'upcoming') : ?> checked <?php else : ?> checked <?php endif; ?>>
                <label class="form-check-label" for="upcoming"><?php echo get_phrase('upcoming'); ?></label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input d-inline-flex" id="live" name="status" value="live" <?php if (isset($live_class) && $live_class['status'] == 'live') : ?> checked <?php endif; ?>>
                <label for="live" class="form-check-label"><?php echo get_phrase('live'); ?></label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input d-inline-flex" id="completed" name="status" value="completed" <?php if (isset($live_class) && $live_class['status'] == 'completed') : ?> checked <?php endif; ?>>
                <label for="completed" class="form-check-label"><?php echo get_phrase('completed'); ?></label>
            </div>
        </div>
    </div>

    <div class="form-group"></div>
    <label><?php echo get_phrase('summary'); ?></label>
    <textarea name="description" id="description" class="form-control"><?php if (isset($live_class)) : echo $live_class['description'];
                                                                        endif; ?></textarea>
    </div>

    <div class="form-group mt-3 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary"><?php echo get_phrase('Save'); ?></button>
    </div>
</form>

<script>
    $(document).ready(function() {
        initSummerNote(['#description']);
        initSelect2(['#section_id', '#lesson_type', '#lesson_provider', '#lesson_provider_for_mobile_application']);
        initTimepicker();

        // HIDING THE SEARCHBOX FROM SELECT2
        $('select').select2({
            minimumResultsForSearch: -1
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        'use strict';
        $('.date-range-with-time').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
        });
    });
</script>

<style type="text/css">
    .calendar-time select {
        color: #787878 !important;
    }

    .class_status_selector {
        gap: 20px;
    }
</style>