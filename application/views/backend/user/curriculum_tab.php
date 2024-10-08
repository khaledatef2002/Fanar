<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">


<style>
#module_badge {
    position: absolute;
    top: -20px;
    left: 0;
}

</style>

<?php
$CI    = &get_instance();
$CI->load->database();
$modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp_details['id'], 'asc')->result_array();

?>
<div class="tab-pane" id="curriculum">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <div class="col-xl-12 mb-4 text-center mt-3">
                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1"
                        onclick="showAjaxModal('<?php echo site_url('addons/bootcamp/module/form/' . $bootcamp_details['id']); ?>', '<?php echo get_phrase('add_new_module'); ?>')"><i
                            class="mdi mdi-plus"></i>
                        <?php echo get_phrase('add_module'); ?></a>
                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1"
                        onclick="showLargeModal('<?php echo site_url('addons/bootcamp/live_class/form/' . $bootcamp_details['id']); ?>', '<?php echo get_phrase('add_live_class'); ?>')"><i
                            class="mdi mdi-plus"></i>
                        <?php echo get_phrase('add_live_class'); ?></a>
                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1"
                        onclick="showLargeModal('<?php echo site_url('addons/bootcamp/module/sort/' . $bootcamp_details['id']); ?>', '<?php echo get_phrase('sort_sections'); ?>')"><i
                            class="mdi mdi-plus"></i>
                        <?php echo get_phrase('sort_section'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-2"></div>

        <div class="col-xl-8" id="module-container">
            <?php foreach ($modules as $key => $module) :
                $schedule = '';
                if ($module['restricted_by'] == 'start_date' && $module['class_start'] != '') {
                    $schedule = 'Available from ' . date('d-M, H:i a', $module['class_start']);
                } elseif ($module['restricted_by'] == 'date_range' && ($module['class_start'] != '' && $module['class_end'] != '')) {
                    $schedule = 'Available from ' . date('d-M, H:i a', $module['class_start']) . ' to ' . date('d-M, H:i a', $module['class_end']);
                }
            ?>
            <div class="card bg-light text-seconday on-hover-action mb-5" id="section-<?php echo $module['id']; ?>">
                <div class="card-body">
                    <?php if (isset($schedule)) : ?>
                    <span class="badge badge-danger" id="module_badge"><?php echo $schedule; ?></span>
                    <?php endif; ?>

                    <h5 class="card-title" class="mb-3" style="min-height: 45px;">
                        <span class="font-weight-light">
                            <?php echo get_phrase('module') . ' ' . ++$key; ?>
                        </span>:
                        <?php echo $module['title']; ?>
                        <div class="row justify-content-center alignToTitle float-right display-none" id="widgets-of-section-<?php echo $module['id']; ?>">
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button"
                                onclick="showLargeModal('<?php echo site_url('addons/bootcamp/live_class/sort/' . $module['id']); ?>', '<?php echo get_phrase('sort_class'); ?>')"><i
                                    class="mdi mdi-sort-variant"></i> <?php echo get_phrase('sort_class'); ?></button>
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button"
                                onclick="showAjaxModal('<?php echo site_url('addons/bootcamp/module/edit/' . $module['id']); ?>', '<?php echo get_phrase('edit_module'); ?>')"><i
                                    class="mdi mdi-sort-variant"></i> <?php echo get_phrase('edit'); ?></button>
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-sm" name="button"
                                onclick="confirm_modal('<?php echo site_url('addons/bootcamp/module/delete/' . $module['id']); ?>');"><i
                                    class="mdi mdi-window-close"></i><?php echo get_phrase('delete'); ?></button>
                        </div>
                    </h5>

                    <div class="clearfix"></div>
                    <?php $live_class = $CI->bootcamp_model->get_table('bootcamp_live_class', 'module_id-' . $module['id'], 'sorted')->result_array(); ?>
                    <?php foreach ($live_class as $key => $class) : ?>
                    <div class="col-md-12">
                        <div class="card text-secondary on-hover-action mb-2 w-100" id="<?php echo 'lesson-' . $class['id']; ?>">
                            <div class="card-body thinner-card-body">
                                <?php
                                        $this->db->where('live_class_id', $class['id']);
                                        $this->db->order_by('id', 'DESC');
                                        $check_class = $this->db->get('bootcamp_online_class')->row_array();

                                        $class_status = 'upcoming';
                                        if (isset($check_class)) {
                                            $class_status = $check_class['status'];
                                        }
                                        if (($class['class_schedule'] - (60 * 15)) > time()) {
                                            $class_status = 'upcoming';
                                        }
                                        ?>

                                <div class="card-widgets display-none" id="widgets-of-lesson-<?php echo $class['id']; ?>">
                                    <?php if (time() >= ($class['class_schedule'] - (60 * 15)) && time() <= $class['estimated_time']) : ?>
                                    <a href="<?php echo site_url('addons/bootcamp/online_class/' . $class['title'] . '/' . $class['id']) ?>" data-toggle="tooltip"
                                        title="<?php echo get_phrase('join_class'); ?>"><i class="mdi mdi-access-point"></i></a>
                                    <?php endif; ?>
                                    <a href="javascript: void(0);"
                                        onclick="showLargeModal('<?php echo site_url('addons/bootcamp/resource/form/' . $class['id']); ?>', '<?php echo get_phrase('add_resource'); ?>')"
                                        data-toggle="tooltip" title="<?php echo get_phrase('resource'); ?>"><i class="mdi mdi-package-variant"></i></a>
                                    <a href="javascript: void(0);"
                                        onclick="showLargeModal('<?php echo site_url('addons/bootcamp/live_class/edit/' . $class['id']); ?>', '<?php echo get_phrase('edit_live_class'); ?>')"
                                        data-toggle="tooltip" title="<?php echo get_phrase('edit'); ?>"><i class="mdi mdi-pencil-outline"></i></a>
                                    <a href="javascript: void(0);" onclick="confirm_modal('<?php echo site_url('addons/bootcamp/live_class/delete/' . $class['id']); ?>');" data-toggle="tooltip"
                                        title="<?php echo get_phrase('delete'); ?>"><i class="mdi mdi-window-close"></i></a>
                                </div>
                                <h5 class="card-title mb-0">
                                    <?php if ($class['status'] == 'upcoming') : ?>
                                    <span class="badge badge-warning text-white"><?php echo ucfirst($class['status']); ?></span>
                                    <?php elseif ($class['status'] == 'live') : ?>
                                    <span class="badge badge-danger"><?php echo ucfirst($class['status']); ?></span>
                                    <?php elseif ($class['status'] == 'completed') : ?>
                                    <span class="badge badge-success"><?php echo ucfirst($class['status']); ?></span>
                                    <?php endif; ?>
                                    <?php echo $class['title']; ?>
                                </h5>
                                <p class="class_schedule m-0">
                                    <span>Schedule: </span>
                                    <span><?php echo date('m-d-Y H:i a', $class['class_schedule']); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
