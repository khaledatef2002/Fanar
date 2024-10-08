<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">

<?php
$CI    = &get_instance();
$CI->load->database();

$instructor_details = $this->user_model->get_all_user($bootcamp_details['owner_id'])->row_array();
$number_of_enrollments = $CI->bootcamp_model->bootcamp_enrollment($bootcamp_details['id'], 'bootcamp');
$number_of_module = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp_details['id'])->num_rows();
$number_of_class = $CI->bootcamp_model->get_table('bootcamp_live_class', 'bootcamp_id-' . $bootcamp_details['id'])->num_rows();
?>

<!---------- Banner Start ---------->
<section>
    <div class="bread-crumb courses-details bootcamp_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="courses-details-1st-text">
                        <h1><?php echo $bootcamp_details['title']; ?></h1>
                        <p class="mb-3"><?php echo $bootcamp_details['short_description']; ?></p>
                        <div class="review">
                            <div class="row ">
                                <div class="col-12 course-heading-info mb-3">
                                    <div class="info top">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="16" height="16">
                                                <path fill="#fff" d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z" />
                                                <path fill="#fff" d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z" />
                                            </svg>
                                        </span>
                                        <p class="text-15px"><?php echo $number_of_enrollments ?> <?php echo get_phrase('Enrolled'); ?></p>
                                    </div>

                                    <div class="info top">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="16" height="16">
                                                <path fill="#fff" d="M19,2H18V1a1,1,0,0,0-2,0V2H8V1A1,1,0,0,0,6,1V2H5A5.006,5.006,0,0,0,0,7V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V7A5.006,5.006,0,0,0,19,2ZM2,7A3,3,0,0,1,5,4H19a3,3,0,0,1,3,3V8H2ZM19,22H5a3,3,0,0,1-3-3V10H22v9A3,3,0,0,1,19,22Z" />
                                                <circle fill="#fff" cx="12" cy="15" r="1.5" />
                                                <circle fill="#fff" cx="7" cy="15" r="1.5" />
                                                <circle fill="#fff" cx="17" cy="15" r="1.5" />
                                            </svg>
                                        </span>
                                        <p class="text-12px">
                                            <?php echo get_phrase('start'); ?>:
                                            <?php echo date('M-d, Y', $bootcamp_details['start_date']); ?>
                                        </p>
                                    </div>

                                    <div class="info top">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="16" height="16">
                                                <path fill="#fff" d="M23.808,20.197L15.741,1.557c-.52-1.276-1.979-1.895-3.259-1.371l-.926,.378c-.358,.146-.671,.368-.921,.649-.438-.726-1.234-1.212-2.142-1.212H2.5C1.122,0,0,1.121,0,2.5V21.5c0,1.379,1.122,2.5,2.5,2.5h5.993c1.378,0,2.5-1.121,2.5-2.5V5.689l7.265,16.79c.522,1.286,2.014,1.885,3.259,1.367l.925-.378c1.261-.486,1.906-2.026,1.366-3.271ZM12.505,6.666l3.704-1.51,5.37,12.411-3.704,1.511L12.505,6.666ZM1,6h3.993v12H1V6Zm4.993,0h4v12H5.993V6Zm4-3.5v2.5H5.993V1h2.5c.827,0,1.5,.673,1.5,1.5ZM2.5,1h2.493V5H1V2.5c0-.827,.673-1.5,1.5-1.5ZM1,21.5v-2.5h3.993v4H2.5c-.827,0-1.5-.673-1.5-1.5Zm7.493,1.5h-2.5v-4h4v2.5c0,.827-.673,1.5-1.5,1.5ZM11.934,1.489l.926-.378c.751-.31,1.642,.051,1.959,.832l.993,2.294-3.704,1.51-.997-2.304c-.312-.766,.057-1.643,.823-1.955Zm10.947,20.245c-.155,.369-.445,.656-.816,.808h0l-.925,.378c-.765,.312-1.643-.056-1.959-.829l-.907-2.096,3.704-1.511,.909,2.101c.152,.371,.15,.779-.005,1.149Z" />
                                            </svg>
                                        </span>
                                        <p class="text-12px">
                                            <?php echo get_phrase('modules'); ?>:
                                            <?php echo $number_of_module; ?>
                                        </p>
                                    </div>

                                    <div class="info top">
                                        <span>
                                            <svg width="16" height="16" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_1278)">
                                                    <path d="M4.28076 7.73047C5.38376 7.73047 6.28076 6.83347 6.28076 5.73047C6.28076 4.62747 5.38376 3.73047 4.28076 3.73047C3.17776 3.73047 2.28076 4.62747 2.28076 5.73047C2.28076 6.83347 3.17776 7.73047 4.28076 7.73047ZM4.28076 4.73047C4.83226 4.73047 5.28076 5.17897 5.28076 5.73047C5.28076 6.28197 4.83226 6.73047 4.28076 6.73047C3.72926 6.73047 3.28076 6.28197 3.28076 5.73047C3.28076 5.17897 3.72926 4.73047 4.28076 4.73047ZM7.78076 12.2305C7.78076 12.507 7.55676 12.7305 7.28076 12.7305C7.00476 12.7305 6.78076 12.507 6.78076 12.2305C6.78076 10.852 5.65926 9.73047 4.28076 9.73047C2.90226 9.73047 1.78076 10.852 1.78076 12.2305C1.78076 12.507 1.55676 12.7305 1.28076 12.7305C1.00476 12.7305 0.780762 12.507 0.780762 12.2305C0.780762 10.301 2.35076 8.73047 4.28076 8.73047C6.21076 8.73047 7.78076 10.301 7.78076 12.2305ZM12.7808 3.23047V7.23047C12.7808 8.60897 11.6593 9.73047 10.2808 9.73047H8.28076C8.00476 9.73047 7.78076 9.50697 7.78076 9.23047V8.23047C7.78076 7.95397 8.00476 7.73047 8.28076 7.73047H9.78076C10.0568 7.73047 10.2808 7.95397 10.2808 8.23047V8.73047C11.1078 8.73047 11.7808 8.05747 11.7808 7.23047V3.23047C11.7808 2.40347 11.1078 1.73047 10.2808 1.73047H5.51326C4.97926 1.73047 4.48126 2.01797 4.21376 2.48097C4.07526 2.71997 3.76976 2.80247 3.53076 2.66297C3.29126 2.52497 3.20976 2.21897 3.34826 1.97997C3.79426 1.20947 4.62376 0.730469 5.51376 0.730469H10.2813C11.6598 0.730469 12.7808 1.85197 12.7808 3.23047Z" fill="#fff"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1_1278">
                                                        <rect width="12" height="12" fill="white" transform="translate(0.780762 0.730469)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <p class="text-12px">
                                            <?php echo get_phrase('class'); ?>:
                                            <?php echo $number_of_class; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Banner Area End ---------->

<section class="course-decription bootcamp_description">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 order-2 order-lg-1">
                <div class="course-left-side mb-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bootcamp-nav-link active" id="course-overview-tab" data-bs-toggle="tab" data-bs-target="#course-overview" type="button" role="tab" aria-controls="course-overview" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18.666" viewBox="0 0 14 18.666">
                                    <g id="Group_8" data-name="Group 8" transform="translate(14 0) rotate(90)">
                                        <path id="Shape" d="M7,14.307l3.7,3.78c1.3,1.326,3.3.227,3.3-1.81V0H0V16.277c0,2.037,2,3.136,3.3,1.81ZM2,2.385V16.277l5-5.11,5,5.11V2.385Z" transform="translate(0 14) rotate(-90)" fill="#1e293b" fill-rule="evenodd" />
                                    </g>
                                </svg>
                                <span class="ms-2"><?php echo get_phrase('Overview'); ?></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bootcamp-nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                                <svg id="Group_13" data-name="Group 13" xmlns="http://www.w3.org/2000/svg" width="20" height="19.692" viewBox="0 0 20 19.692">
                                    <path id="Shape" d="M14,2.5a.5.5,0,0,0-.5-.5H2.5a.5.5,0,0,0-.5.5V16.028a.455.455,0,0,0,.658.407,3,3,0,0,1,2.683,0L7.553,17.54a1,1,0,0,0,.894,0l2.211-1.106a3,3,0,0,1,2.683,0A.455.455,0,0,0,14,16.028Zm2,16.691a.5.5,0,0,1-.724.447l-2.829-1.415a1,1,0,0,0-.894,0L9.342,19.329a3,3,0,0,1-2.683,0L4.447,18.224a1,1,0,0,0-.894,0L.724,19.638A.5.5,0,0,1,0,19.191V0H16Z" transform="translate(2)" fill="#1e293b" fill-rule="evenodd" />
                                    <g id="Shape-2" data-name="Shape" transform="translate(6 4)">
                                        <path id="_5D20F028-8654-4138-BE2C-2596CB0A8C99" data-name="5D20F028-8654-4138-BE2C-2596CB0A8C99" d="M1,0A1,1,0,0,0,1,2H3A1,1,0,0,0,3,0Z" fill="#1e293b" />
                                        <path id="CB5AF5FF-CA28-49F3-8207-42C293893700" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6)" fill="#1e293b" />
                                        <path id="ECA14E2E-A90F-4909-9E68-1DC1F5104902" d="M0,1A1,1,0,0,1,1,0H3A1,1,0,0,1,3,2H1A1,1,0,0,1,0,1Z" transform="translate(0 4)" fill="#1e293b" />
                                        <path id="_841F264B-A82E-487A-AEC1-CFCDCADF7975" data-name="841F264B-A82E-487A-AEC1-CFCDCADF7975" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6 4)" fill="#1e293b" />
                                        <path id="AD528B39-E6BD-4596-94B4-DC58311EEB90" d="M0,1A1,1,0,0,1,1,0H3A1,1,0,0,1,3,2H1A1,1,0,0,1,0,1Z" transform="translate(0 8)" fill="#1e293b" />
                                        <path id="_6CF152B9-DFD7-4CE1-B45B-12E7F5ED6D14" data-name="6CF152B9-DFD7-4CE1-B45B-12E7F5ED6D14" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6 8)" fill="#1e293b" />
                                    </g>
                                    <path id="Shape-3" data-name="Shape" d="M0,1A1,1,0,0,1,1,0H19a1,1,0,0,1,0,2H1A1,1,0,0,1,0,1Z" fill="#1e293b" />
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Curriculum') ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bootcamp-nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                <svg id="Group_12" data-name="Group 12" xmlns="http://www.w3.org/2000/svg" width="15.582" height="19.666" viewBox="0 0 15.582 19.666">
                                    <path id="Shape" d="M7.791,1.731a6.06,6.06,0,0,0-6.06,6.06V9.522A.866.866,0,1,1,0,9.522V7.791a7.791,7.791,0,0,1,15.582,0V9.522a.866.866,0,1,1-1.731,0V7.791A6.06,6.06,0,0,0,7.791,1.731Z" transform="translate(0 9.278)" fill="#1e293b" />
                                    <path id="Shape-2" data-name="Shape" d="M5.194,8.656A3.463,3.463,0,1,0,1.731,5.194,3.463,3.463,0,0,0,5.194,8.656Zm0,1.731A5.194,5.194,0,1,0,0,5.194,5.194,5.194,0,0,0,5.194,10.388Z" transform="translate(2.597)" fill="#1e293b" fill-rule="evenodd" />
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Instructor') ?></span>
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="course-overview" role="tabpanel" aria-labelledby="course-overview-tab">
                            <?php include "bootcamp_overview.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            <?php include "bootcamp_curriculum.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                            <?php include "bootcamp_owner.php"; ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- pricing card -->
            <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2">
                <div class="course-right-section">
                    <div class="course-card">
                        <div class="card-img">
                            <div class="courses-card-image">
                                <img class="w-100" src="<?php echo base_url() . 'uploads/bootcamp/bootcamp_thumbnail/' . $bootcamp_details['bootcamp_thumbnail']; ?>">
                            </div>
                        </div>

                        <div class="bootcamp-info">
                            <div class="ammount d-flex mb-3">
                                <?php if ($bootcamp_details['is_free']) : ?>
                                    <h1 class="fw-500"><?php echo get_phrase('Free'); ?></h1>
                                <?php elseif ($bootcamp_details['discount_flag']) : ?>
                                    <h1 class="fw-500"><?php echo currency($bootcamp_details['price'] - $bootcamp_details['discounted_price']); ?></h1>
                                    <h3 class="fw-500"><del><?php echo currency($bootcamp_details['price']); ?></del></h3>
                                <?php else : ?>
                                    <h1 class="fw-500"><?php echo currency($bootcamp_details['price']); ?></h1>
                                <?php endif; ?>
                            </div>

                            <span class="count_class">
                                <span class="icon">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1_1278)">
                                            <path d="M4.28076 7.73047C5.38376 7.73047 6.28076 6.83347 6.28076 5.73047C6.28076 4.62747 5.38376 3.73047 4.28076 3.73047C3.17776 3.73047 2.28076 4.62747 2.28076 5.73047C2.28076 6.83347 3.17776 7.73047 4.28076 7.73047ZM4.28076 4.73047C4.83226 4.73047 5.28076 5.17897 5.28076 5.73047C5.28076 6.28197 4.83226 6.73047 4.28076 6.73047C3.72926 6.73047 3.28076 6.28197 3.28076 5.73047C3.28076 5.17897 3.72926 4.73047 4.28076 4.73047ZM7.78076 12.2305C7.78076 12.507 7.55676 12.7305 7.28076 12.7305C7.00476 12.7305 6.78076 12.507 6.78076 12.2305C6.78076 10.852 5.65926 9.73047 4.28076 9.73047C2.90226 9.73047 1.78076 10.852 1.78076 12.2305C1.78076 12.507 1.55676 12.7305 1.28076 12.7305C1.00476 12.7305 0.780762 12.507 0.780762 12.2305C0.780762 10.301 2.35076 8.73047 4.28076 8.73047C6.21076 8.73047 7.78076 10.301 7.78076 12.2305ZM12.7808 3.23047V7.23047C12.7808 8.60897 11.6593 9.73047 10.2808 9.73047H8.28076C8.00476 9.73047 7.78076 9.50697 7.78076 9.23047V8.23047C7.78076 7.95397 8.00476 7.73047 8.28076 7.73047H9.78076C10.0568 7.73047 10.2808 7.95397 10.2808 8.23047V8.73047C11.1078 8.73047 11.7808 8.05747 11.7808 7.23047V3.23047C11.7808 2.40347 11.1078 1.73047 10.2808 1.73047H5.51326C4.97926 1.73047 4.48126 2.01797 4.21376 2.48097C4.07526 2.71997 3.76976 2.80247 3.53076 2.66297C3.29126 2.52497 3.20976 2.21897 3.34826 1.97997C3.79426 1.20947 4.62376 0.730469 5.51376 0.730469H10.2813C11.6598 0.730469 12.7808 1.85197 12.7808 3.23047Z" fill="#754FFE"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1_1278">
                                                <rect width="12" height="12" fill="white" transform="translate(0.780762 0.730469)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="module_details"><?php echo $number_of_class ?> live class</span>
                                </span>
                            </span>

                            <div class="pricing_info">
                                <h4 class="info-title mt-4"><?php echo get_phrase('in_this_course_you_get') ?>:</h4>
                                <div class="info">
                                    <p>
                                        <span>
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span><?php echo get_phrase('enrolled') ?></span>
                                        </span>

                                        <span><?php echo $number_of_enrollments; ?></span>
                                    </p>
                                </div>

                                <div class="info">
                                    <p>
                                        <span>
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span><?php echo get_phrase('module') ?></span>
                                        </span>

                                        <span><?php echo $number_of_module; ?></span>
                                    </p>
                                </div>

                                <div class="info">
                                    <p>
                                        <span>
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span><?php echo get_phrase('live_class') ?></span>
                                        </span>

                                        <span><?php echo $number_of_class; ?></span>
                                    </p>
                                </div>

                                <div class="info">
                                    <p>
                                        <span>
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span><?php echo get_phrase('resource') ?></span>
                                        </span>

                                        <span><?php echo get_phrase('yes') ?></span>
                                    </p>
                                </div>

                                <div class="info">
                                    <p>
                                        <span>
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span><?php echo get_phrase('class_record') ?></span>
                                        </span>

                                        <span><?php echo get_phrase('yes') ?></span>
                                    </p>
                                </div>
                            </div>

                            <?php if ($bootcamp_details['is_free'] == 1) : ?>
                                <a href="<?php echo site_url('addons/bootcamp/join_user/' . $bootcamp_details['id']); ?>" class="join-batch-btn">Join live batch</a>
                            <?php else : $is_purchased = $this->bootcamp_model->is_purchased($bootcamp_details['id']); ?>
                                <?php if ($is_purchased) : ?>
                                    <a href="<?php echo site_url('addons/bootcamp/my_bootcamp/' . $bootcamp_details['id']); ?>" class="join-batch-btn">Join live batch</a>
                                <?php else : ?>
                                    <a href="<?php echo site_url('addons/bootcamp/purchase/' . $bootcamp_details['id']); ?>" class="join-batch-btn d-flex align-items-center gap-3">
                                        <i class="fas fa-credit-card"></i>
                                        <span>
                                            <?php echo get_phrase('Buy Now'); ?>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--------- course Description Page end ------>

<style>
    .info.top p {
        color: #fff !important;
    }

    .info.top span {
        display: inline-flex;

    }

    .info.top {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .course-heading-info {
        gap: 16px;
    }

    .courses-card-image {
        position: relative !important;
        width: 100% !important;
        aspect-ratio: 16 / 9 !important;
        height: auto !important;
    }

    .pricing_info {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .info p {
        color: #1E293B !important;
        font-size: 15px;
        font-weight: 500;
        line-height: normal;
        letter-spacing: 0.3px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info p i {
        color: #754FFE;
    }

    .info-title {
        color: #1E293B !important;
        font-size: 16px;
        font-weight: 500;
        line-height: normal;
        letter-spacing: 0.32px;
    }

    .course-left-side {
        padding: 13px 30px;
    }

    .amount h1 {
        color: #1E293B !important;
        text-align: center;
        font-size: 34px;
        font-weight: 600 !important;
        line-height: normal;
    }

    span.share-bootcamp-btn {
        background: #fff;
        width: 35px;
        height: 35px;
        display: inline-block;
        position: relative;
        border-radius: 8px;
        border: 1.5px solid #647996;
    }

    span.share-bootcamp-btn svg {
        position: absolute;
        top: 50%;
        left: 49%;
        transform: translate(-53%, -50%);
        display: inline-flex;
    }

    .count_class {
        color: #1E293B !important;
        border-radius: 5px;
        background: rgba(234, 236, 240, 0.80);
        padding: 3px 8px;
        display: inline-block;
        cursor: default;
    }

    .course-right-section .course-card .ammount {
        padding: 0 !important;
    }

    .bootcamp-info {
        padding: 20px 10px;
    }

    .join-batch-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
        border-radius: 10px;
        background: #754FFE;
        color: #fff !important;
        padding: 20px 0;
        font-size: 15px;
        font-weight: 600;
        line-height: 15px;
    }

    .course-right-section .course-card .card-img img {
        padding: 0 !important;
    }

    .course-card {
        padding: 10px;
        overflow: hidden;
    }

    .courses-card-image img {
        width: 400px !important;
        aspect-ratio: 16/9 !important;
        object-fit: cover;
        object-position: center;
    }

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