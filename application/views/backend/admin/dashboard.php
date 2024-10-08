<?php
    $status_wise_courses = $this->crud_model->get_status_wise_courses();
    $number_of_courses = $status_wise_courses['pending']->num_rows() + $status_wise_courses['active']->num_rows();
    $number_of_lessons = $this->crud_model->get_lessons()->num_rows();
    $number_of_enrolment = $this->crud_model->enrol_history()->num_rows();
    $number_of_students = $this->user_model->get_user()->num_rows();
?>
<div class="row">
    <div class="col-xl-12">
        <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('dashboard'); ?></h4>
    </div><!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <!--begin:Item-->
                <?php if ($this->session->userdata('is_instructor') == 1 && !$this->session->userdata('admin_login')  || has_permission('course')) : ?>
                    <div class="col-3 flex-fill">
                        <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?= site_url($logged_in_user_role . '/course_form/add_course_shortcut'); ?>', '<?= get_phrase('create_course'); ?>')">
                            <i class="dripicons-archive text-20"></i>
                            <span class="w-100 d-block text-muted"><?= get_phrase('add_course'); ?></span>
                        </a>
                    </div>
                    <div class="col-3 flex-fill">
                        <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_types/add_shortcut_lesson'); ?>', '<?php echo get_phrase('add_new_lesson'); ?>')">
                            <i class="dripicons-media-next text-20"></i>
                            <span class="d-block text-muted"><?= get_phrase('add_lesson'); ?></span>
                        </a>
                    </div>    
                <?php endif; ?>
                <?php if ($this->session->userdata('admin_login') && has_permission('student')) : ?>
                    <div class="col-3 flex-fill">
                        <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/shortcut_add_student'); ?>', '<?php echo get_phrase('add_student'); ?>')">
                            <i class="dripicons-user text-20"></i>
                            <span class="w-100 d-block text-muted"><?= get_phrase('add_student'); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->userdata('admin_login') && has_permission('enrolment')) : ?>
                    <div class="col-3 flex-fill">
                        <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/shortcut_enrol_student'); ?>', '<?php echo get_phrase('enrol_a_student'); ?>')">
                            <i class="dripicons-network-3 text-20"></i>
                            <span class="d-block text-muted"><?= get_phrase('enrol_student'); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row d-flex column-gap-3">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <a href="<?php echo site_url('admin/courses'); ?>" class="text-secondary">
                        <div class="card shadow-none m-0">
                            <div class="card-body text-center">
                                <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                <h3><span><?php echo $number_of_courses; ?></span></h3>
                                <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_courses'); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <a href="<?php echo site_url('admin/courses'); ?>" class="text-secondary">
                        <div class="card shadow-none m-0">
                            <div class="card-body text-center">
                                <i class="dripicons-camcorder text-muted" style="font-size: 24px;"></i>
                                <h3><span><?php echo $number_of_lessons; ?></span></h3>
                                <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_lessons'); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <a href="<?php echo site_url('admin/enrol_history'); ?>" class="text-secondary">
                        <div class="card shadow-none m-0">
                            <div class="card-body text-center">
                                <i class="dripicons-network-3 text-muted" style="font-size: 24px;"></i>
                                <h3><span><?php echo $number_of_enrolment; ?></span></h3>
                                <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_enrolment'); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <a href="<?php echo site_url('admin/users'); ?>" class="text-secondary">
                        <div class="card shadow-none m-0">
                            <div class="card-body text-center">
                                <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                <h3><span><?php echo $number_of_students; ?></span></h3>
                                <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_student'); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div> <!-- end row -->
    </div> <!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-4"><?php echo get_phrase('admin_revenue_this_year'); ?></h4>

                <div class="mt-3 chartjs-chart" style="height: 320px;">
                    <canvas id="task-area-chart"></canvas>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4"><?php echo get_phrase('course_overview'); ?></h4>
                <div class="my-4 chartjs-chart" style="height: 202px;">
                    <canvas id="project-status-chart"></canvas>
                </div>
                <div class="row text-center mt-2 py-2">
                    <div class="col-6">
                        <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                        <h3 class="font-weight-normal">
                            <span><?php echo $status_wise_courses['active']->num_rows(); ?></span>
                        </h3>
                        <p class="text-muted mb-0"><?php echo get_phrase('active_courses'); ?></p>
                    </div>
                    <div class="col-6">
                        <i class="mdi mdi-trending-down text-warning mt-3 h3"></i>
                        <h3 class="font-weight-normal">
                            <span><?php echo $status_wise_courses['pending']->num_rows(); ?></span>
                        </h3>
                        <p class="text-muted mb-0"> <?php echo get_phrase('pending_courses'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card" id = 'unpaid-instructor-revenue'>
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('requested_withdrawal'); ?>
                    <a href="<?php echo site_url('admin/instructor_payout'); ?>" class="alignToTitle" id ="go-to-instructor-revenue"> <i class="mdi mdi-logout"></i> </a>
                </h4>
                <div class="table-responsive">
                    <table class="table table-centered table-hover mb-0">
                        <tbody>

                            <?php
                                $pending_payouts = $this->crud_model->get_pending_payouts()->result_array();
                                foreach ($pending_payouts as $key => $pending_payout):
                                $instructor_details = $this->user_model->get_all_user($pending_payout['user_id'])->row_array();
                            ?>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body" style="cursor: auto;"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></a></h5>
                                    <small><?php echo get_phrase('email'); ?>: <span class="text-muted font-13"><?php echo $instructor_details['email']; ?></span></small>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body" style="cursor: auto;"><?php echo currency($pending_payout['amount']); ?></a></h5>
                                    <small><span class="text-muted font-13"><?php echo get_phrase('requested_withdrawal_amount'); ?></span></small>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#unpaid-instructor-revenue').mouseenter(function() {
        $('#go-to-instructor-revenue').show();
    });
    $('#unpaid-instructor-revenue').mouseleave(function() {
        $('#go-to-instructor-revenue').hide();
    });
</script>
