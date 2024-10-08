<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">


<?php
$bootcamp_modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp_details['id'])->result_array();
?>

<div class="row">
    <div class="col-12">
        <?php if (count($bootcamp_modules) > 0) : ?>
            <div class="modules">
                <div class="accordion accordion-flush" id="module_list">
                    <?php
                    foreach ($bootcamp_modules as $module) :
                        $class_per_module = $CI->bootcamp_model->get_table('bootcamp_live_class', 'module_id-' . $module['id']);
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header m-0" id="module_<?php echo $module['id'] ?>">
                                <button class="accordion-button collapsed px-0 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-module_<?php echo $module['id'] ?>" aria-expanded="false" aria-controls="flush-module_<?php echo $module['id'] ?>">
                                    <div class="module-item d-flex align-items-center justify-content-between">
                                        <div class="title d-flex align-items-center">
                                            <span class="module_expand_icon">
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                            <h5 class="module_title">
                                                <span><?php echo $module['title']; ?></span>
                                            </h5>
                                        </div>


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
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-module_<?php echo $module['id'] ?>" class="accordion-collapse collapse" aria-labelledby="module_<?php echo $module['id'] ?>" data-bs-parent="#module_list">

                                <div class="accordion-body p-0 ps-3">
                                    <?php
                                    $live_class = $CI->bootcamp_model->get_table('bootcamp_live_class', 'module_id-' . $module['id'])->result_array();
                                    ?>

                                    <?php if (count($live_class) > 0) : ?>
                                        <?php foreach ($live_class as $class) : ?>
                                            <div class="curriculum-class d-flex align-items-center">
                                                <span class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="16" height="16">
                                                        <path d="M12,10c1.1,0,2,.9,2,2s-.9,2-2,2-2-.9-2-2,.9-2,2-2Zm8.49,10.49c4.68-4.68,4.68-12.29,0-16.97-.39-.39-1.02-.39-1.41,0s-.39,1.02,0,1.41c3.9,3.9,3.9,10.24,0,14.14-.39,.39-.39,1.02,0,1.41,.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Zm-3.54-3.54c1.32-1.32,2.05-3.08,2.05-4.95s-.73-3.63-2.05-4.95c-.39-.39-1.02-.39-1.41,0s-.39,1.02,0,1.41c.94,.94,1.46,2.2,1.46,3.54s-.52,2.59-1.46,3.54c-.39,.39-.39,1.02,0,1.41,.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Zm-12.02,3.54c.39-.39,.39-1.02,0-1.41-3.9-3.9-3.9-10.24,0-14.14,.39-.39,.39-1.02,0-1.41s-1.02-.39-1.41,0C-1.16,8.19-1.16,15.81,3.51,20.49c.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Zm3.54-3.54c.39-.39,.39-1.02,0-1.41-1.95-1.95-1.95-5.12,0-7.07,.39-.39,.39-1.02,0-1.41s-1.02-.39-1.41,0c-2.73,2.73-2.73,7.17,0,9.9,.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Z" />
                                                    </svg>
                                                </span>
                                                <div class="class-title">
                                                    <?php echo $class['title']; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p class="mb-3"><?php echo get_phrase('No_class_in_this_module.'); ?></p>
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

<style>
    .course-decription #myTab {
        margin: 0;
    }
</style>