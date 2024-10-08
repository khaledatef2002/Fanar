<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">
<?php
$CI    = &get_instance();
$CI->load->database();
?>

<section class="wish-list-body message bootcamp_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="bootcamps my-course-1-full-body">
                    <h1 class="mt-4"><?php echo get_phrase('Bootcamp'); ?></h1>
                    <?php if (count($bootcamps) > 0) : ?>
                        <div class="container g-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="bootcamps">
                                        <?php foreach ($bootcamps as $bootcamp) :
                                            $bootcamp_modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp['id']);
                                            $live_classes = $CI->bootcamp_model->get_table('bootcamp_live_class', 'bootcamp_id-' . $bootcamp['id']);

                                        ?>
                                            <a href="<?php echo site_url('addons/bootcamp/my_bootcamp/' . $bootcamp['id']); ?>" class="d-block bootcamp">
                                                <div class="row align-items-center">
                                                    <div class="col-3">
                                                        <div class="bootcamp_thumbnail">
                                                            <img src="<?php echo base_url() . 'uploads/bootcamp/bootcamp_thumbnail/' . $bootcamp['bootcamp_thumbnail'] ?>" alt="" width="100%">
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="bootcamp_description d-flex align-items-center justify-content-between">
                                                            <div class="">
                                                                <h4 class="bootcamp_title"><?php echo $bootcamp['title']; ?></h4>
                                                                <span class="">
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
                                                                    <?php echo $live_classes->num_rows() . ' ' . get_phrase('live_class'); ?>
                                                                </span>
                                                                <span class="ms-4"><?php echo get_phrase('starts') . ': ' . date('d M, Y H:i', $bootcamp['start_date']); ?></span>
                                                            </div>

                                                            <div class="arrow-right">
                                                                <i class="fas fa-angle-right"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>