<?php $enrolments = $this->user_model->my_courses()->result_array(); ?>
<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>

<!-------- Wish List body section start ------>
<section class="wish-list-body ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="my-course-1-full-body rounded-4">
                    <h1 class="fs-2"><?php echo get_phrase('Courses'); ?></h1>
                    <div class="row">
                        <?php foreach ($enrolments as $enrolment) :
                            $course_details = $this->crud_model->get_course_by_id($enrolment['course_id'])->row_array();
                            $instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
                            $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
                            $lectures = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz']);
                            $quizzes = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz']);
                            $watch_history = $this->crud_model->get_watch_histories($this->session->userdata('user_id'), $course_details['id'])->row_array();
                            $course_progress = isset($watch_history['course_progress']) ? $watch_history['course_progress'] : 0;
                        ?>
                            <div class="col-lg-12 col-md-12 col-sm-6 col-12 mb-5">
                                <div class="my-course-1-full-body-card p-3 rounded-4">
                                    <div class="my-course-1-img position-relative">
                                        <div class="overley fs-1">
                                            <?php echo $course_progress ." %"; ?>
                                        </div>
                                        <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="">
                                    </div>
                                    <div class="my-course-1-text pt-1">
                                        <div class="my-course-1-text-heading">
                                            <h3 class="fs-4"><?php echo $course_details['title']; ?></h3>
                                            <div class="rating">
                                                <?php $my_rating = $this->crud_model->get_user_specific_rating('course', $course_details['id']); ?>
                                                <div class="d-flex align-items-center">
                                                    <div class="star m-0">
                                                        <i class="fa-solid fa-star me-2 <?php if ($my_rating['rating'] >= 0) echo 'gold'; ?>"></i>
                                                        <?php echo $my_rating['rating']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="child-icon">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle py-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                        <li>
                                                            <a class="dropdown-item py-2" href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']); ?>"><?php echo get_phrase('Go to course page') ?></a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item py-2" href="<?php echo site_url('home/instructor_page/' . $course_details['creator']) ?>"><?php echo get_phrase('Author profile') ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="my-course-1-lesson-text mb-0">
                                            <div class="icon-1">
                                                <p><i class="far fa-play-circle"></i> <?php echo get_phrase('Lectures') . ' ' . $lectures->num_rows(); ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="far fa-question-circle"></i> <?php echo get_phrase('Quizzes') . ' ' . $quizzes->num_rows(); ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="fa-regular fa-clock"></i> <?php echo $course_duration; ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="fa-regular fa-user"></i> <?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></p>
                                            </div>
                                        </div>
                                        <div class="my-course-1-lesson-text mb-2">
                                            <?php if ($enrolment['expiry_date'] > 0 && $enrolment['expiry_date'] < time()) : ?>
                                                <div class="icon-1 mt-0">
                                                    <p><i class="fa-solid fa-calendar"></i> <?php echo get_phrase('Expired') ?> - <b style="color: var(--bs-code-color);"><?php echo date('d M Y, H:i A', $enrolment['expiry_date']); ?></b></p>
                                                </div>
                                            <?php else : ?>
                                                <?php if ($enrolment['expiry_date'] == 0) : ?>
                                                    <div class="icon-1 mt-0">
                                                        <p><i class="fa-solid fa-calendar"></i> <?php echo get_phrase('Expiry period') ?> - <b class="text-success text-uppercase"><?php echo get_phrase('Lifetime Access'); ?></b></p>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="icon-1 mt-0">
                                                        <p><i class="fa-solid fa-calendar"></i> <?php echo get_phrase('Expiration On') ?> - <b><?php echo date('d M Y, H:i A', $enrolment['expiry_date']); ?></b></p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="my-course-1-skill">
                                            <div class="skill-bar-container">
                                                <div class="skill-bar" style="width: <?php echo $course_progress; ?>%; animation: unset"></div>
                                            </div>
                                        </div>

                                        <?php include 'live_class_scadule.php'; ?>

                                        <div class="my-course-1-last d-flex justify-content-end">
                                            <div class="my-course-1-btn pt-2">
                                                <?php if ($enrolment['expiry_date'] > 0 && $enrolment['expiry_date'] < time()) : ?>
                                                    <a class="btn py-2 px-5 text-white rounded-5" href="#" onclick="actionTo('http://localhost/academy/academy_6.0/home/handle_buy_now/<?php echo $course_details['id']; ?>')">
                                                        <?php echo get_phrase('Join again'); ?>
                                                    </a>
                                                <?php else : ?>
                                                    <a class="btn py-2 px-5 text-white rounded-5" href="<?php echo site_url('home/lesson/' . slugify($course_details['title']) . '/' . $course_details['id']) ?>">
                                                        <?php echo get_phrase('Start Now'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------- wish list bosy section end ------->