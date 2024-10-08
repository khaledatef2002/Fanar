<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$lessons = $this->crud_model->get_lessons('course', $course_details['id']);
$instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
$course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
$number_of_enrolments = $this->crud_model->enrol_history($course_details['id'])->num_rows();
$total_rating =  $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
$number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();
if ($number_of_ratings > 0) {
    $average_ceil_rating = ceil($total_rating / $number_of_ratings);
} else {
    $average_ceil_rating = 0;
}
?>
<!---------- Banner Start ---------->
<section>
    <div class="bread-crumb courses-details py-3">
        <div class="container">
            <div class="d-flex flex-wrap-reverse align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 pe-4">
                    <div class="courses-details-1st-text">
                        <span class="badge fs-6 py-2 px-4"><?php echo get_phrase('fanar-platform'); ?></span>
                        <h1 class="mb-2 mt-3"><?php echo $course_details['title']; ?></h1>
                        <p class="mb-3 fs-6"><?php echo $course_details['short_description']; ?></p>
                        <div class="review">
                            <div class="row ">
                                <div class="col-12 course-heading-info">
                                    <div class="info-tag">
                                        <div class="icon">
                                            <ul>
                                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                                    <?php if ($i <= $average_ceil_rating) : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-15px  mt-7px"></i></li>
                                                    <?php else : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-15px  mt-7px"></i></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                                <p class="text-15px mt-1 fw-bold"><?php echo $average_ceil_rating; ?></p>&nbsp;
                                                <p class="text-12px mt-1">(<?php echo $number_of_ratings . ' ' . get_phrase('Reviews'); ?>)</p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 course-heading-info">
                                    <div class="info-tag">
                                        <p><i class="far fa-calendar-alt text-15px mt-7px"></i></p>
                                        <p class="text-12px mt-5px me-1"><?php echo get_phrase('Last Updated'); ?></p>
                                        <p class="text-15px mt-1">
                                            <?php if ($course_details['last_modified'] > 0) : ?>
                                                <?php echo date('D, d-M-Y', $course_details['last_modified']); ?>
                                            <?php else : ?>
                                                <?php echo date('D, d-M-Y', $course_details['date_added']); ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="info-tag">
                                        <i class="fa-regular fa-user text-15px mt-7px"></i>
                                        <p class="text-15px mt-1"><?php echo $number_of_enrolments ?> <?php echo get_phrase('Enrolled'); ?></p>
                                    </div>
                                    <div class="info-tag">
                                        <i class="fas fa-language text-15px mt-8px"></i>
                                        <p class="text-15px mt-1"><?php echo ucfirst($course_details['language']); ?></p>
                                    </div>
                                </div>
                                <div class="col-12 course-heading-info mb-3">
                                    <div class="info-tag">
                                        <img loading="lazy" width="25px" height="25px" class="rounded-circle object-fit-cover me-1" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>">
                                        <p class="text-15px mt-1">
                                            <a class="created-by-instructor" href="<?php echo site_url('home/instructor_page/' . $course_details['creator']); ?>"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="course-right-section">
                        <div class="course-card">
                            <div class="card-img">
                                <div class="courses-card-image">
                                    <div class="card-video-icon" onclick="lesson_preview('<?php echo site_url('home/course_preview/' . $course_details['id']); ?>', '<?php echo get_phrase($course_details['title']) ?>')">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
        
                                    <img loading="lazy" class="w-100" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>">
        
                                    <div class="courses-icon <?php if (in_array($course_details['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course_details['id']; ?>">
                                        <i class="fa-solid fa-heart me-2 cursor-pointer checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/' . $course_details['id']); ?>')"></i>
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

<!--------- course Decription Page Start ------>
<section class="course-decription py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 order-1">
                <div class="course-right-section">
                    <div class="course-card rounded-4">
                        <div class="ammount d-flex flex-column">
                            <h3 class="fs-5 p-0 mb-2 mt-2"><?php echo get_phrase('get_the_course'); ?></h3>
                            <?php if ($course_details['is_free_course']) : ?>
                                <h1 class="fw-500"><?php echo get_phrase('Free'); ?></h1>
                            <?php elseif ($course_details['discount_flag']) : ?>
                                <h1 class="fw-500"><?php echo currency($course_details['discounted_price']); ?></h1>
                                <h3 class="fw-500"><del><?php echo currency($course_details['price']); ?></del></h3>
                            <?php else : ?>
                                <h1 class="fw-500"><?php echo currency($course_details['price']); ?></h1>
                            <?php endif; ?>
                            <!-- <a href="<?php echo base_url('home/compare?course-1=' . slugify($course_details['title']) . '&course-id-1=' . $course_details['id']); ?>" title="<?php echo get_phrase('Compare this course') ?>" data-bs-toggle="tooltip" class="ms-auto py-2">
                                <img loading="lazy" width="18px" src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>" style="filter: invert(1);">
                            </a> -->
                        </div>
                        <!-- button -->
                        <div class="button">
                            <?php $cart_items = $this->session->userdata('cart_items'); ?>
                            <?php if (is_purchased($course_details['id'])) : ?>
                                <?php if ($course_details['is_free_course'] != 1) : ?>
                                    <a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id'] . '?gift=1'); ?>')" class="rounded-5"><?php echo get_phrase('Gift someone else'); ?></a>
                                <?php endif; ?>
                                <a href="<?php echo site_url('home/lesson/' . slugify($course_details['title']) . '/' . $course_details['id']) ?>" class="rounded-5"><?php echo get_phrase('Start Now'); ?></a>
                            <?php else : ?>
                                <?php if ($course_details['is_free_course'] == 1) : ?>
                                    <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_details['id']); ?>" class="rounded-5"><?php echo get_phrase('Enroll Now'); ?></a>
                                <?php else : ?>

                                    <a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id']); ?>')" class="rounded-5"><?php echo get_phrase('Buy Now'); ?></a>
                                    <!-- Cart button -->
                                    <a id="added_to_cart_btn_<?php echo $course_details['id']; ?>" class="rounded-5 <?php if (!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?> active" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>');"><?php echo get_phrase('Remove from cart'); ?></a>
                                    <a id="add_to_cart_btn_<?php echo $course_details['id']; ?>" class="rounded-5 <?php if (in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>'); "><?php echo get_phrase('Add to cart'); ?></a>
                                    <!-- Cart button ended-->

                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (addon_status('affiliate_course')) : // course_addon start  adding
                                $CI    = &get_instance();
                                $CI->load->model('addons/affiliate_course_model');
                                $is_affiliattor = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
                                if ($is_affiliattor == 1) :
                                    $user_data = $CI->affiliate_course_model->get__affiliator_status_table_info_by_user_id($this->session->userdata('user_id'));
                            ?>

                                    <a class="btn-custom_coursepage text-decoration-none fw-600 hover-shadow-1 d-inline-block" href="#myModel" data-bs-toggle="modal" data-bs-target="#myModel" id="shareBtn" data-bs-placement="top"><i class="fas fa-user-plus"></i> <?php echo site_phrase('Share and Earn'); ?></a>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <hr class="mx-5">
                        
                        <div class="enrol">
                            <div class="icon">
                                <i class="fa-solid fa-signal"></i>
                                <h4><?php echo $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?></h4>
                            </div>
                        </div>
                        <?php if ($course_duration) : ?>
                            <div class="enrol">
                                <div class="icon">
                                    <i class="fa-solid fa-clock"></i>
                                    <h4><?php echo $course_duration; ?></h4>
                                </div>
                            </div>
                         <?php endif; ?>
                        <div class="enrol">
                            <div class="icon">
                                <i class="fa-solid fa-circle-play"></i>
                                <h4><?php echo get_phrase('Lectures') ?></h4>
                                <h4><?php echo $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?></h4>
                            </div>
                        </div>

                        <?php $number_of_quiz = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz'])->num_rows(); ?>
                        <?php if ($number_of_quiz > 0) : ?>
                            <div class="enrol">
                                <div class="icon">
                                    <i class="fa-brands fa-teamspeak"></i>
                                    <h4><?php echo get_phrase('Quizzes') ?></h4>
                                    <h4><?php echo $number_of_quiz; ?></h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- <div class="enrol">
                            <div class="icon">
                                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-2.png') ?>">
                                <h4><?php echo get_phrase('Skill level') ?></h4>
                            </div>
                            <h5><?php echo get_phrase($course_details['level']); ?></h5>
                        </div> -->

                        <div class="enrol">
                            <div class="icon">
                                <i class="fa-solid fa-medal"></i>
                                <h4>
                                    <?php if ($course_details['expiry_period'] <= 0) : ?>
                                        <?php echo get_phrase('Lifetime') ?>
                                    <?php else : ?>
                                        <?php echo $course_details['expiry_period'] . ' ' . get_phrase('Months'); ?>
                                    <?php endif; ?>
                                </h4>
                            </div>
                        </div>
                        <?php if (addon_status('certificate')) : ?>
                            <div class="enrol">
                                <div class="icon">
                                    <i class="fa-solid fa-certificate"></i>
                                    <h4><?php echo get_phrase('Certificate') ?>: </h4>
                                    <h4><?php echo get_phrase('Yes') ?></h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- <?php
                        if (isset($user_data['unique_identifier'])) :
                            $ref = $user_data['unique_identifier'];
                        else :
                            $ref = '';
                        endif;
                        ?>
                        <div class="w-100 px-4 pb-2 text-center">
                            <?php $share_url = site_url('home/course/' . slugify($course_details['title']) . '/' . $course_details['id']); ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #316FF6;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Facebook'); ?>" data-bs-placement="top">
                                <i class="fab fa-facebook text-20px"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $course_details['title']; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #1DA1F2;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Twitter'); ?>" data-bs-placement="top">
                                <i class="fab fa-twitter text-20px"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $share_url; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #128c7e;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Whatsapp'); ?>" data-bs-placement="top">
                                <i class="fab fa-whatsapp text-20px"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?url=<?php echo $share_url; ?>&title=<?php echo $course_details['title']; ?>&summary=<?php echo $course_details['short_description']; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #0077b5;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Linkedin'); ?>" data-bs-placement="top">
                                <i class="fab fa-linkedin text-20px"></i>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 order-2">
                <div class="course-left-side">
                    <ul class="nav nav-tabs rounded-4 py-2" id="myTab" role="tablist">
                        <!-- Course Summry Tab -->
                        <!-- <?php if(!empty($course_details['description']) && count(json_decode($course_details['outcomes'])) > 0 && count(json_decode($course_details['requirements'])) && is_array(json_decode($course_details['faqs'], true)) && count(json_decode($course_details['faqs'])) > 0 ): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="course-overview-tab" data-bs-toggle="tab" data-bs-target="#course-overview" type="button" role="tab" aria-controls="course-overview" aria-selected="true">
                                <span class="ms-2"><?php echo get_phrase('Overview'); ?></span>
                            </button>
                        </li>
                        <?php endif; ?> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-5 py-2 px-5" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                                <span class="ms-2"><?php echo get_phrase('Curriculum') ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-5 py-2 px-5" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                <span class="ms-2"><?php echo get_phrase('Instructor') ?></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-5 py-2 px-5" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                                <span class="ms-2"><?php echo get_phrase('Reviews') ?></span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- <div class="tab-pane fade <?php echo (!empty($course_details['description']) && count(json_decode($course_details['outcomes'])) > 0 && count(json_decode($course_details['requirements'])) && is_array(json_decode($course_details['faqs'], true)) && count(json_decode($course_details['faqs'])) > 0 ) ? 'show active' : ''; ?>" id="course-overview" role="tabpanel" aria-labelledby="course-overview-tab">
                            <?php include "course_page_info_description.php"; ?>
                        </div> -->
                        <div class="tab-pane fade <?php echo (!empty($course_details['description']) && count(json_decode($course_details['outcomes'])) > 0 && count(json_decode($course_details['requirements'])) && is_array(json_decode($course_details['faqs'], true)) && count(json_decode($course_details['faqs'])) > 0 ) ? '' : 'show active'; ?>" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            <?php include "course_page_curriculum.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                            <?php include "course_page_instructor.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews">
                                <?php include "course_page_reviews.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--------- course Decription Page end ------>


<!-------- Related course section start ----->
<section class="courses grid-view-body course-details-card">
    <div class="container">
        <h1><?php echo get_phrase('Related Courses'); ?></h1>
        <div class="courses-card rounded-4 p-3">
            <div class="row">
                <?php $related_courses = $this->crud_model->get_related_courses($course_details['category_id'], $course_details['sub_category_id'], $course_details['id'], 12)->result_array(); ?>
                <?php foreach ($related_courses as $key => $course) :

                    $lessons = $this->crud_model->get_lessons('course', $course['id']);
                    $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
                    $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                    $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
                    if ($number_of_ratings > 0) {
                        $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                    } else {
                        $average_ceil_rating = 0;
                    }
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>" class="checkPropagation courses-card-body rounded-4 p-2 mb-0">
                            <div class="courses-card-image">
                                <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>">
                            </div>
                            <div class="courses-text">
                                <h5 class="mb-2"><?php echo $course['title']; ?></h5>
                                <div class="info d-flex align-items-center justify-content-between">
                                    <p class="mb-0">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.3316 1.81186L17.279 5.70075C17.9955 6.10179 18.0655 7.07767 17.4892 7.59113V14.0978C18.2412 14.9029 18.6448 15.5874 18.6448 16.2005C18.6448 17.2744 17.7808 18.145 16.715 18.145C15.6492 18.145 14.7852 17.2744 14.7852 16.2005C14.7852 15.5862 15.1904 14.9002 15.9453 14.0929V8.48701L15.5598 8.7028L15.5596 13.0283C15.5596 13.3122 15.4568 13.5863 15.2706 13.7994C14.1617 15.068 12.3177 15.6641 9.77008 15.6641C7.22243 15.6641 5.37848 15.068 4.26958 13.7994C4.08335 13.5863 3.98061 13.3122 3.98061 13.0282L3.98085 8.70392L2.25963 7.74045C1.46554 7.29594 1.46554 6.14525 2.25963 5.70075L9.207 1.81186C9.55671 1.6161 9.98194 1.6161 10.3316 1.81186ZM3.61719 6.71941L9.7698 10.1634L15.9224 6.71941L9.7698 3.27539L3.61719 6.71941ZM16.4921 15.8749C16.3744 16.0588 16.3281 16.1795 16.3281 16.1995C16.3281 16.4142 16.5009 16.5884 16.7141 16.5884C16.9273 16.5884 17.1001 16.4142 17.1001 16.1995C17.1001 16.1795 17.0538 16.0588 16.9361 15.8749C16.8753 15.78 16.8012 15.6773 16.7141 15.5674C16.6269 15.6773 16.5528 15.78 16.4921 15.8749ZM9.76901 11.7929C10.0959 11.793 10.4185 11.7095 10.7067 11.5482L14.015 9.69633L14.0148 12.8765C13.2292 13.6836 11.8288 14.1094 9.76918 14.1094C7.70955 14.1094 6.30916 13.6837 5.52358 12.8765L5.52376 9.69624L8.83224 11.5482C9.12008 11.7093 9.44241 11.7928 9.76901 11.7929Z" fill="#FF7468"/></svg>
                                        <?php echo get_phrase('lectures'); ?>
                                        <?php echo $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?>
                                    </p>
                                    <div class="review-icon mt-0 mb-1">
                                        <div class="review-icon-star mt-0">
                                            <ul class="d-flex">
                                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                                    <?php if ($i <= $average_ceil_rating) : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-12px px-0 ms-0 me-2px mt-0"></i></li>
                                                    <?php else : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-12px px-0 ms-0 me-2px mt-0"></i></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-------- Related course section end ----->


<?php if (addon_status('affiliate_course') && $is_affiliattor == 1) : ?>
    <?php include 'affiliate_course_modal.php';  // course_addon  single line /adding 
    ?>
<?php endif; ?>

<?php if (addon_status('team_training')) : ?>
    <?php include 'course_related_packages.php'; ?>
<?php endif; ?>