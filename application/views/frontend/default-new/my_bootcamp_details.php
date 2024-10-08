<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">

<?php
$CI    = &get_instance();
$CI->load->database();

$all_classes = $CI->bootcamp_model->get_table('bootcamp_live_class', 'bootcamp_id-' . $bootcamp_details['id']);
$bootcamp_modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp_details['id'])->result_array();

$get_schedule = $this->db->where('bootcamp_id', $bootcamp_details['id'])->get('bootcamp_live_class')->result_array();
$schedules = array_column($get_schedule, 'class_schedule');
sort($schedules);
$close_schedule = date('M-d, Y', current($schedules));
?>

<?php include "courses_bundle_header.php"; ?>


<section class="wish-list-body bootcamp_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="my-course-1-full-body">
                    <div class="container g-0">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-3">
                                <div class="bootcamp_thumbnail">
                                    <img src="<?php echo base_url() . 'uploads/bootcamp/bootcamp_thumbnail/' . $bootcamp_details['bootcamp_thumbnail'] ?>" alt="bootcamp_details_thumbnail">
                                </div>
                            </div>

                            <div class="col-md-9">
                                <h4 class="bootcamp_title d-flex align-items-center justify-content-between">
                                    <span><?php echo $bootcamp_details['title']; ?></span>
                                    <a href="<?php echo site_url('addons/bootcamp/my_bootcamp'); ?>" class="e_btn"><?php echo get_phrase('back') ?></a>
                                </h4>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-13px">
                                        <span>
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_1278)">
                                                    <path d="M4.28076 7.73047C5.38376 7.73047 6.28076 6.83347 6.28076 5.73047C6.28076 4.62747 5.38376 3.73047 4.28076 3.73047C3.17776 3.73047 2.28076 4.62747 2.28076 5.73047C2.28076 6.83347 3.17776 7.73047 4.28076 7.73047ZM4.28076 4.73047C4.83226 4.73047 5.28076 5.17897 5.28076 5.73047C5.28076 6.28197 4.83226 6.73047 4.28076 6.73047C3.72926 6.73047 3.28076 6.28197 3.28076 5.73047C3.28076 5.17897 3.72926 4.73047 4.28076 4.73047ZM7.78076 12.2305C7.78076 12.507 7.55676 12.7305 7.28076 12.7305C7.00476 12.7305 6.78076 12.507 6.78076 12.2305C6.78076 10.852 5.65926 9.73047 4.28076 9.73047C2.90226 9.73047 1.78076 10.852 1.78076 12.2305C1.78076 12.507 1.55676 12.7305 1.28076 12.7305C1.00476 12.7305 0.780762 12.507 0.780762 12.2305C0.780762 10.301 2.35076 8.73047 4.28076 8.73047C6.21076 8.73047 7.78076 10.301 7.78076 12.2305ZM12.7808 3.23047V7.23047C12.7808 8.60897 11.6593 9.73047 10.2808 9.73047H8.28076C8.00476 9.73047 7.78076 9.50697 7.78076 9.23047V8.23047C7.78076 7.95397 8.00476 7.73047 8.28076 7.73047H9.78076C10.0568 7.73047 10.2808 7.95397 10.2808 8.23047V8.73047C11.1078 8.73047 11.7808 8.05747 11.7808 7.23047V3.23047C11.7808 2.40347 11.1078 1.73047 10.2808 1.73047H5.51326C4.97926 1.73047 4.48126 2.01797 4.21376 2.48097C4.07526 2.71997 3.76976 2.80247 3.53076 2.66297C3.29126 2.52497 3.20976 2.21897 3.34826 1.97997C3.79426 1.20947 4.62376 0.730469 5.51376 0.730469H10.2813C11.6598 0.730469 12.7808 1.85197 12.7808 3.23047Z" fill="#6E798A" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1_1278">
                                                        <rect width="12" height="12" fill="white" transform="translate(0.780762 0.730469)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <span><?php echo $all_classes->num_rows(); ?></span>
                                        <span><?php echo get_phrase('live_class'); ?></span>
                                    </div>

                                    <div class="text-13px">
                                        <span><?php echo get_phrase('start_date:'); ?></span>
                                        <span><?php echo date('d-M, Y', $bootcamp_details['start_date']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <?php if (count($bootcamp_modules) > 0) : ?>
                                    <div class="modules">
                                        <div class="accordion accordion-flush" id="module_list">
                                            <?php
                                            foreach ($bootcamp_modules as $key => $module) :
                                                $class_per_module = $CI->bootcamp_model->get_table('bootcamp_live_class', 'module_id-' . $module['id']);
                                                $lock = NULL;
                                                if ($module['restricted_by'] == 'date_range' && (time() < $module['class_start'] || time() > $module['class_end'])) {
                                                    $lock = 'enable';
                                                } elseif ($module['restricted_by'] == 'start_date' && time() < $module['class_start']) {
                                                    $lock = 'enable';
                                                }
                                            ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header m-0" id="module_<?php echo $module['id'] ?>">
                                                        <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-module_<?php echo $module['id'] ?>" aria-expanded="false" aria-controls="flush-module_<?php echo $module['id'] ?>">
                                                            <div class="module-item d-flex align-items-center justify-content-between">
                                                                <div class="title d-flex align-items-center">
                                                                    <span class="module_expand_icon">
                                                                        <i class="fas fa-chevron-down"></i>
                                                                    </span>
                                                                    <h5 class="module_title">
                                                                        <span><?php echo $module['title']; ?></span>
                                                                    </h5>
                                                                </div>

                                                                <?php if (isset($lock)) : ?>
                                                                    <i class="fa-solid fa-lock pe-3"></i>
                                                                <?php else : ?>
                                                                    <span class="icon">
                                                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_1_1278)">
                                                                                <path d="M4.28076 7.73047C5.38376 7.73047 6.28076 6.83347 6.28076 5.73047C6.28076 4.62747 5.38376 3.73047 4.28076 3.73047C3.17776 3.73047 2.28076 4.62747 2.28076 5.73047C2.28076 6.83347 3.17776 7.73047 4.28076 7.73047ZM4.28076 4.73047C4.83226 4.73047 5.28076 5.17897 5.28076 5.73047C5.28076 6.28197 4.83226 6.73047 4.28076 6.73047C3.72926 6.73047 3.28076 6.28197 3.28076 5.73047C3.28076 5.17897 3.72926 4.73047 4.28076 4.73047ZM7.78076 12.2305C7.78076 12.507 7.55676 12.7305 7.28076 12.7305C7.00476 12.7305 6.78076 12.507 6.78076 12.2305C6.78076 10.852 5.65926 9.73047 4.28076 9.73047C2.90226 9.73047 1.78076 10.852 1.78076 12.2305C1.78076 12.507 1.55676 12.7305 1.28076 12.7305C1.00476 12.7305 0.780762 12.507 0.780762 12.2305C0.780762 10.301 2.35076 8.73047 4.28076 8.73047C6.21076 8.73047 7.78076 10.301 7.78076 12.2305ZM12.7808 3.23047V7.23047C12.7808 8.60897 11.6593 9.73047 10.2808 9.73047H8.28076C8.00476 9.73047 7.78076 9.50697 7.78076 9.23047V8.23047C7.78076 7.95397 8.00476 7.73047 8.28076 7.73047H9.78076C10.0568 7.73047 10.2808 7.95397 10.2808 8.23047V8.73047C11.1078 8.73047 11.7808 8.05747 11.7808 7.23047V3.23047C11.7808 2.40347 11.1078 1.73047 10.2808 1.73047H5.51326C4.97926 1.73047 4.48126 2.01797 4.21376 2.48097C4.07526 2.71997 3.76976 2.80247 3.53076 2.66297C3.29126 2.52497 3.20976 2.21897 3.34826 1.97997C3.79426 1.20947 4.62376 0.730469 5.51376 0.730469H10.2813C11.6598 0.730469 12.7808 1.85197 12.7808 3.23047Z" fill="#6E798A" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_1_1278">
                                                                                    <rect width="12" height="12" fill="white" transform="translate(0.780762 0.730469)" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                        <span class="module_details"><?php echo $class_per_module->num_rows(); ?> live class</span>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-module_<?php echo $module['id'] ?>" class="accordion-collapse collapse <?php if (($key + 1) == 1) : ?> show <?php endif; ?>" aria-labelledby="module_<?php echo $module['id'] ?>" data-bs-parent="#module_list">
                                                        <?php
                                                        $live_class = $CI->bootcamp_model->get_table('bootcamp_live_class', 'module_id-' . $module['id'])->result_array();
                                                        ?>

                                                        <div class="accordion-body pt-0">
                                                            <?php if (count($live_class) > 0) : ?>
                                                                <?php if (isset($lock)) : ?>
                                                                    <p><?php echo get_phrase('this_is_content_is_currently_locked.'); ?></p>
                                                                    <p class="d-flex align-items-center gap-3 text-12px fw-600">
                                                                        <span class="badge bg-secondary">
                                                                            <?php if ($module['restricted_by'] == 'start_date') : ?>
                                                                                <?php echo get_phrase('from') . ' '; ?><?php echo date('d-M, Y', $module['class_start']); ?>
                                                                            <?php elseif ($module['restricted_by'] == 'date_range') : ?>

                                                                                <?php echo get_phrase('from'); ?>
                                                                                <?php echo date('d-M, Y', $module['class_start']); ?>
                                                                                <?php echo get_phrase('to'); ?>
                                                                                <?php echo date('d-M, Y', $module['class_end']); ?>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </p>
                                                                <?php endif; ?>
                                                                <?php foreach ($live_class as $class) : ?>
                                                                    <?php if (isset($lock)) : ?>
                                                                        <div class="class-title p-0 py-2">
                                                                            <?php echo $class['title']; ?>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="class">
                                                                            <?php
                                                                            $this->db->where('live_class_id', $class['id'])->order_by('id', 'DESC');
                                                                            $check_class = $this->db->get('bootcamp_online_class')->row_array();
                                                                            $class_status = isset($check_class) ? $check_class['status'] : 'upcoming';
                                                                            if ($class['class_schedule'] - (60 * 15) > time()) {
                                                                                $class_status = 'upcoming';
                                                                            }
                                                                            ?>

                                                                            <div class="class_schedule">
                                                                                <?php if ($class['status'] == 'live') : ?>
                                                                                    <span class="badge bg-danger text-10px"><?php echo ucfirst($class['status']); ?></span>
                                                                                <?php elseif ($class['status'] == 'completed') : ?>
                                                                                    <span class="badge bg-success text-10px opacity-75"><?php echo ucfirst($class['status']); ?></span>
                                                                                <?php elseif ($class['status'] == 'upcoming') : ?>
                                                                                    <span class="badge bg-warning text-10px"><?php echo ucfirst($class['status']); ?></span>
                                                                                <?php endif; ?>
                                                                                <span class="text-14px text-dark"><?php echo date('M-d-Y', $class['class_schedule']); ?></span>

                                                                            </div>

                                                                            <div class="class-title">
                                                                                <?php echo $class['title']; ?>
                                                                            </div>

                                                                            <div class="class-action">
                                                                                <?php
                                                                                $this->db->where('live_class_id', $class['id'])->order_by('id', 'desc');
                                                                                $class_status = $this->db->get('bootcamp_online_class')->row_array();
                                                                                ?>

                                                                                <?php if (time() >= ($class['class_schedule'] - (60 * 15)) && time() <= $class['estimated_time']) : ?>
                                                                                    <a href="<?php echo site_url('addons/bootcamp/join_class/' . $class['title'] . '/' . $class['id']); ?>" class="join-now">Join now</a>
                                                                                <?php endif; ?>


                                                                                <?php
                                                                                $this->db->select('id, resource');
                                                                                $this->db->where(['class_id' => $class['id'], 'type' => 'class_record']);
                                                                                $this->db->order_by('id', 'desc');
                                                                                $class_records = $this->db->get('bootcamp_resources')->result_array();
                                                                                ?>
                                                                                <?php if (!empty($class_records)) : ?>
                                                                                    <div class="class-resource" id="record-<?php echo $class['id']; ?>">
                                                                                        <button class="e_btn exp-btn record-btn" id="record-btn-<?php echo $class['id']; ?>">
                                                                                            <span><?php echo get_phrase('watch_video'); ?></span>
                                                                                            <span class="down-arrow"><i class="fa-solid fa-caret-down"></i></span>
                                                                                        </button>

                                                                                        <ul class="class-dropdown" id="class-list-<?php echo $class['id']; ?>">
                                                                                            <?php foreach ($class_records as $index => $record) : ?>
                                                                                                <li class="watch-video-<?php echo $class['id']; ?>" title="<?php echo $record['resource']; ?>">
                                                                                                    <a href="<?php echo site_url('addons/bootcamp/watch_video/' . $record['resource'] . '/' . $record['id']); ?>" class="w-100 list-item">
                                                                                                        <span><?php echo $record['resource']; ?></span>
                                                                                                        <span><i class="fa-solid fa-circle-play"></i></span>
                                                                                                    </a>
                                                                                                </li>
                                                                                            <?php endforeach; ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                                <?php
                                                                                $this->db->select('id, resource');
                                                                                $this->db->where(['class_id' => $class['id'], 'type' => 'resource']);
                                                                                $this->db->order_by('id', 'desc');
                                                                                $resources = $this->db->get('bootcamp_resources')->result_array();
                                                                                ?>
                                                                                <?php if (!empty($resources)) : ?>
                                                                                    <div class="class-resource" id="resource-<?php echo $class['id']; ?>">
                                                                                        <button class="e_btn exp-btn resource-btn" id="resource-btn-<?php echo $class['id']; ?>">
                                                                                            <span><?php echo get_phrase('resource'); ?></span>
                                                                                            <span class="down-arrow"><i class="fa-solid fa-caret-down"></i></span>
                                                                                        </button>

                                                                                        <ul class="class-dropdown" id="class-list-<?php echo $class['id']; ?>">
                                                                                            <?php foreach ($resources as $index => $resource) : ?>
                                                                                                <li class="resource-<?php echo $resource['id'] ?>" title="<?php echo $resource['resource']; ?>">
                                                                                                    <a href="<?php echo site_url('addons/bootcamp/download/resource/' . $resource['id'] . '/' . $resource['id']) ?>" class="w-100 list-item">
                                                                                                        <span><?php echo $resource['resource']; ?></span>
                                                                                                        <span><i class="fa-solid fa-circle-down"></i></span>
                                                                                                    </a>
                                                                                                </li>
                                                                                            <?php endforeach; ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <p><?php echo get_phrase('no_class_is_available') ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .modal-header {
        padding: 0 0 12px !important;
        border-bottom: 1.5px solid #676C7D;
        margin-bottom: 12px;
    }

    .modal-content {
        padding: 16px !important;
    }

    .modal-footer {
        display: none !important;
    }

    .modal-header .title~button:active {
        background: #8B0000;
    }

    .modal-header .title~button {
        background: red;
        border: none;
        border-radius: 4px !important;
    }
</style>

<script>
    $(document).ready(function() {
        // Toggle the dropdown content when clicking on a button
        $(".exp-btn").on("click", function(event) {
            event.stopPropagation();

            const container = $(this).closest(".class-resource");
            const menu = container.find(".class-dropdown");

            menu.toggleClass("active");
            $(this).toggleClass("active");

            var c = $(this).parent().siblings().find('.class-dropdown').removeClass('active');
        });

        // Hide the dropdown content when clicking outside of any button
        $(document).on("click", function(event) {
            const target = $(event.target);

            $(".class-resource").each(function() {
                const container = $(this);
                const menu = container.find(".class-dropdown");

                if (!container.is(target) && container.has(target).length === 0) {
                    menu.removeClass("active");
                    container.find(".exp-btn").removeClass("active");
                }
            });
        });
    });
</script>