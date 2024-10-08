<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">

<?php
$url = 'addons/bootcamp/module/add';
if (isset($module)) {
    $url = 'addons/bootcamp/module/update/' . $module['id'];
    $bootcamp_id = $module['bootcamp_id'];
    $start_date = $module['class_start'];
    $end_date = $module['class_end'];
} else {
    $start_date = time();
    $end_date = time();
}
?>

<form action="<?php echo site_url($url); ?>" method="post">
    <div class="form-group">
        <label for="module_name"><?php echo get_phrase('module_name'); ?></label>
        <input type="text" name="title" class="form-control" id="title" <?php if (isset($module)) : ?> value="<?php echo $module['title']; ?>" <?php else : ?> placeholder="Module name" <?php endif; ?> required>
        <input type="text" name="bootcamp_id" class="form-control" id="bootcamp_id" value="<?php echo $bootcamp_id; ?>" hidden>
    </div>

    <div class="form-group mb-3">
        <label><?php echo get_phrase('study_plan'); ?> <small class="text-muted">(<?php echo get_phrase('Optional'); ?>)</small></label>
        <input type="text" name="study_plan" class="form-control date date-range-with-time" data-toggle="date-picker" data-time-picker="true" data-locale="{'format': 'DD/MM hh:mm A'}">
    </div>

    <div class="form-group mb-3">
        <label><?php echo get_phrase('Restriction of study plan: '); ?></label>
        <br>
        <input type="radio" id="is_restricted_no" value="free" name="restricted_by" <?php if (isset($module)) : ?> <?php if ($module['restricted_by'] == 'free') : ?> checked <?php endif; ?> <?php else : ?> checked <?php endif; ?>>
        <label for="is_restricted_no"><?php echo get_phrase('No restriction'); ?></label>
        <br>
        <input type="radio" id="is_restricted_start_date" value="start_date" name="restricted_by" class="restriction" <?php if (isset($module) && $module['restricted_by'] == 'start_date') : ?> checked <?php endif; ?>>
        <label for="is_restricted_start_date" class="restriction">
            <?php echo get_phrase('Until the start date, keep this section locked'); ?>
        </label>
        <br>
        <input type="radio" id="is_restricted_date_range" value="date_range" name="restricted_by" class="restriction" <?php if (isset($module) && $module['restricted_by'] == 'date_range') : ?> checked <?php endif; ?>>
        <label for="is_restricted_date_range" class="restriction">
            <?php echo get_phrase('Keep this section open only within the selected date range'); ?>
        </label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo get_phrase('Save'); ?></button>
    </div>
</form>

<script type="text/javascript">
    $(function() {
        'use strict';
        $('.date-range-with-time').daterangepicker({
            timePicker: true,
            startDate: '<?php echo date('m/d/y 00:00:00', $start_date); ?>',
            endDate: '<?php echo date('m/d/y 00:00:00', $end_date); ?>',
            locale: {
                format: 'M/DD/YY hh:mm A'
            }
        });
    });
</script>

<style type="text/css">
    .calendar-time select {
        color: #787878 !important;
    }
</style>