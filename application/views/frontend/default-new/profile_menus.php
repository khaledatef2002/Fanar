<?php
$this->db->where('receiver', $this->session->userdata('user_id'));
$this->db->where('read_status !=', 1);
$unreaded_message = $this->db->get('message')->num_rows();
?>

<div class="wish-list-search profile mb-5 rounded-4">
    <div class="student-profile-info my-0 mb-4">
        <img loading="lazy" class="profile-image" src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>">
        <h4 class="fs-4"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h4>
        <span><?php echo $user_details['email']; ?></span>
    </div>
    <div class="wish-list-course">
        <a class="btn-profile-menu <?php if($page_name == 'my_courses') echo 'active'; ?>" href="<?php echo site_url('home/my_courses'); ?>">
            <svg class="me-2" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 2.1265V15.1265M10 2.1265C8.832 1.3505 7.246 0.873497 5.5 0.873497C3.754 0.873497 2.168 1.3505 1 2.1265V15.1265C2.168 14.3505 3.754 13.8735 5.5 13.8735C7.246 13.8735 8.832 14.3505 10 15.1265M10 2.1265C11.168 1.3505 12.754 0.873497 14.5 0.873497C16.247 0.873497 17.832 1.3505 19 2.1265V15.1265C17.832 14.3505 16.247 13.8735 14.5 13.8735C12.754 13.8735 11.168 14.3505 10 15.1265" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo get_phrase('My Courses'); ?>
        </a>

        <?php if (addon_status('course_bundle')) : ?>
            <a class="btn-profile-menu <?php if ($page_name == 'my_bundles' || $page_name == 'bundle_invoice') echo 'active'; ?>" href="<?php echo site_url('home/my_bundles'); ?>">
                <svg class="me-2" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H5C5.53043 1 6.03914 1.21071 6.41421 1.58579C6.78929 1.96086 7 2.46957 7 3V5C7 5.53043 6.78929 6.03914 6.41421 6.41421C6.03914 6.78929 5.53043 7 5 7H3C2.46957 7 1.96086 6.78929 1.58579 6.41421C1.21071 6.03914 1 5.53043 1 5V3ZM11 3C11 2.46957 11.2107 1.96086 11.5858 1.58579C11.9609 1.21071 12.4696 1 13 1H15C15.5304 1 16.0391 1.21071 16.4142 1.58579C16.7893 1.96086 17 2.46957 17 3V5C17 5.53043 16.7893 6.03914 16.4142 6.41421C16.0391 6.78929 15.5304 7 15 7H13C12.4696 7 11.9609 6.78929 11.5858 6.41421C11.2107 6.03914 11 5.53043 11 5V3ZM1 13C1 12.4696 1.21071 11.9609 1.58579 11.5858C1.96086 11.2107 2.46957 11 3 11H5C5.53043 11 6.03914 11.2107 6.41421 11.5858C6.78929 11.9609 7 12.4696 7 13V15C7 15.5304 6.78929 16.0391 6.41421 16.4142C6.03914 16.7893 5.53043 17 5 17H3C2.46957 17 1.96086 16.7893 1.58579 16.4142C1.21071 16.0391 1 15.5304 1 15V13ZM11 13C11 12.4696 11.2107 11.9609 11.5858 11.5858C11.9609 11.2107 12.4696 11 13 11H15C15.5304 11 16.0391 11.2107 16.4142 11.5858C16.7893 11.9609 17 12.4696 17 13V15C17 15.5304 16.7893 16.0391 16.4142 16.4142C16.0391 16.7893 15.5304 17 15 17H13C12.4696 17 11.9609 16.7893 11.5858 16.4142C11.2107 16.0391 11 15.5304 11 15V13Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php echo get_phrase('Course Bundles'); ?>
            </a>
        <?php endif; ?>

        <?php if (addon_status('bootcamp')) : ?>
            <a class="btn-profile-menu <?php if ($page_name == 'my_bootcamp' || $page_name == 'my_bootcamp_details') echo 'active'; ?>" href="<?php echo site_url('addons/bootcamp/my_bootcamp'); ?>">
                <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.75 15L7 18L6 19H14L13 18L12.25 15M1 11H19M3 15H17C17.5304 15 18.0391 14.7893 18.4142 14.4142C18.7893 14.0391 19 13.5304 19 13V3C19 2.46957 18.7893 1.96086 18.4142 1.58579C18.0391 1.21071 17.5304 1 17 1H3C2.46957 1 1.96086 1.21071 1.58579 1.58579C1.21071 1.96086 1 2.46957 1 3V13C1 13.5304 1.21071 14.0391 1.58579 14.4142C1.96086 14.7893 2.46957 15 3 15Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php echo get_phrase('Bootcamp'); ?>
            </a>
        <?php endif; ?>

        <?php if (addon_status('team_training')) : ?>
            <a class="btn-profile-menu <?php if ($page_name == 'my_teams' || $page_name == 'my_selected_team') echo 'active'; ?>" href="<?php echo site_url('addons/team_training/my_teams'); ?>">
                <i class="fas fa-users me-2"></i>
                <?php echo get_phrase('My Teams'); ?>
            </a>
        <?php endif; ?>

        <?php if (addon_status('tutor_booking')) : ?>
            <a class="btn-profile-menu <?php if( $page_name=='booked_schedule_student' ) echo 'active'; ?>" href="<?php echo site_url('my_bookings'); ?>">
                <svg class="me-2" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 11.0044C14.4582 12.0322 11.7417 12.5589 9 12.5556C6.17067 12.5556 3.47111 12.0044 1 11.0044M12.5556 4.55556V2.77778C12.5556 2.30628 12.3683 1.8541 12.0349 1.5207C11.7015 1.1873 11.2493 1 10.7778 1H7.22222C6.75073 1 6.29854 1.1873 5.96514 1.5207C5.63175 1.8541 5.44444 2.30628 5.44444 2.77778V4.55556M9 9.88889H9.00889M2.77778 17H15.2222C15.6937 17 16.1459 16.8127 16.4793 16.4793C16.8127 16.1459 17 15.6937 17 15.2222V6.33333C17 5.86184 16.8127 5.40965 16.4793 5.07625C16.1459 4.74286 15.6937 4.55556 15.2222 4.55556H2.77778C2.30628 4.55556 1.8541 4.74286 1.5207 5.07625C1.1873 5.40965 1 5.86184 1 6.33333V15.2222C1 15.6937 1.1873 16.1459 1.5207 16.4793C1.8541 16.8127 2.30628 17 2.77778 17Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php echo get_phrase('Booked Tuition'); ?>
            </a>
        <?php endif; ?>

        <?php if(addon_status('ebook')): ?>
            <a class="btn-profile-menu <?php if($page_name == 'my_ebooks') echo 'active'; ?>" href="<?php echo site_url('home/my_ebooks'); ?>">
                <i class="fas fa-book me-2"></i>
                <?php echo get_phrase('My Ebooks'); ?>
            </a>
        <?php endif; ?>


        <a class="btn-profile-menu <?php if($page_name == 'my_wishlist') echo 'active'; ?>" href="<?php echo site_url('home/my_wishlist'); ?>">
            <svg class="me-2" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V19L8 15.5L1 19V3Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo get_phrase('Wishlist'); ?>
        </a>

        <a class="btn-profile-menu <?php if($page_name == 'my_messages') echo 'active'; ?>" href="<?php echo site_url('home/my_messages'); ?>">
            <svg class="me-2" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.55556 4.5H13.4444M4.55556 8H8.11111M9 15L5.44444 11.5H2.77778C2.30628 11.5 1.8541 11.3156 1.5207 10.9874C1.1873 10.6592 1 10.2141 1 9.75V2.75C1 2.28587 1.1873 1.84075 1.5207 1.51256C1.8541 1.18437 2.30628 1 2.77778 1H15.2222C15.6937 1 16.1459 1.18437 16.4793 1.51256C16.8127 1.84075 17 2.28587 17 2.75V9.75C17 10.2141 16.8127 10.6592 16.4793 10.9874C16.1459 11.3156 15.6937 11.5 15.2222 11.5H12.5556L9 15Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo get_phrase('Messages'); ?>
            <?php if($unreaded_message > 0): ?>
                <span class="badge bg-danger"><?php echo $unreaded_message; ?></span>
            <?php endif; ?>
        </a>

        <?php if (addon_status('affiliate_course')) :
            $CI    = &get_instance();
            $CI->load->model('addons/affiliate_course_model');
            $is_affilator = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
            if ($is_affilator == 1) : ?>
                <a class="btn-profile-menu <?php if ($page_name == 'affiliate_course_history') echo 'active'; ?>" href="<?php echo site_url('addons/affiliate_course/affiliate_course_history'); ?>">
                    <i class="fas fa-poll me-2"></i>
                    <?php echo site_phrase('Affiliate History '); ?>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <?php $is_affilator = 0; ?>
        <?php endif;?>

        <?php if($is_affilator == 1 || $user_details['is_instructor'] == 1): ?>
            <a class="btn-profile-menu <?php if ($page_name == 'payment_settings') echo 'active'; ?>" href="<?php echo site_url('home/payout_settings'); ?>">
                <i class="fa-solid fa-gear me-2"></i>
                <?php echo site_phrase('Payout Settings'); ?>
            </a>
        <?php endif; ?>

        <a class="btn-profile-menu <?php if($page_name == 'purchase_history') echo 'active'; ?>" href="<?php echo site_url('home/purchase_history'); ?>">
            <svg class="me-2" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1H2.77778L3.13333 2.77778M3.13333 2.77778H17L13.4444 9.88889H4.55556M3.13333 2.77778L4.55556 9.88889M4.55556 9.88889L2.51733 11.9271C1.95733 12.4871 2.35378 13.4444 3.14578 13.4444H13.4444M13.4444 13.4444C12.9729 13.4444 12.5208 13.6317 12.1874 13.9651C11.854 14.2985 11.6667 14.7507 11.6667 15.2222C11.6667 15.6937 11.854 16.1459 12.1874 16.4793C12.5208 16.8127 12.9729 17 13.4444 17C13.9159 17 14.3681 16.8127 14.7015 16.4793C15.0349 16.1459 15.2222 15.6937 15.2222 15.2222C15.2222 14.7507 15.0349 14.2985 14.7015 13.9651C14.3681 13.6317 13.9159 13.4444 13.4444 13.4444ZM6.33333 15.2222C6.33333 15.6937 6.14603 16.1459 5.81263 16.4793C5.47924 16.8127 5.02705 17 4.55556 17C4.08406 17 3.63187 16.8127 3.29848 16.4793C2.96508 16.1459 2.77778 15.6937 2.77778 15.2222C2.77778 14.7507 2.96508 14.2985 3.29848 13.9651C3.63187 13.6317 4.08406 13.4444 4.55556 13.4444C5.02705 13.4444 5.47924 13.6317 5.81263 13.9651C6.14603 14.2985 6.33333 14.7507 6.33333 15.2222Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo get_phrase('Purchase history'); ?>
        </a>

        <a class="btn-profile-menu <?php if($page_name == 'user_profile') echo 'active'; ?>" href="<?php echo site_url('home/profile/user_profile'); ?>">
            <svg class="me-2" width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.4286 4.55556C10.4286 5.49855 10.0673 6.40292 9.42437 7.06971C8.78138 7.73651 7.90931 8.11111 7 8.11111C6.09069 8.11111 5.21862 7.73651 4.57563 7.06971C3.93265 6.40292 3.57143 5.49855 3.57143 4.55556C3.57143 3.61256 3.93265 2.70819 4.57563 2.0414C5.21862 1.3746 6.09069 1 7 1C7.90931 1 8.78138 1.3746 9.42437 2.0414C10.0673 2.70819 10.4286 3.61256 10.4286 4.55556ZM7 10.7778C5.4087 10.7778 3.88258 11.4333 2.75736 12.6002C1.63214 13.7671 1 15.3498 1 17H13C13 15.3498 12.3679 13.7671 11.2426 12.6002C10.1174 11.4333 8.5913 10.7778 7 10.7778Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo get_phrase('Profile'); ?>
        </a>

        <a class="btn-profile-menu <?php if($page_name == 'user_credentials') echo 'active'; ?>" href="<?php echo site_url('home/profile/user_credentials'); ?>">
            <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 4.99708C13.5304 4.99708 14.0391 5.2078 14.4142 5.58287C14.7893 5.95794 15 6.46665 15 6.99709M19 6.99709C19.0003 7.93426 18.781 8.85846 18.3598 9.69563C17.9386 10.5328 17.3271 11.2597 16.5744 11.818C15.8216 12.3763 14.9486 12.7505 14.0252 12.9106C13.1018 13.0707 12.1538 13.0123 11.257 12.7401L9 14.9971H7V16.9971H5V18.9971H2C1.73478 18.9971 1.48043 18.8917 1.29289 18.7042C1.10536 18.5167 1 18.2623 1 17.9971V15.4111C1.00006 15.1459 1.10545 14.8916 1.293 14.7041L7.257 8.74009C7.00745 7.9151 6.93857 7.04603 7.05504 6.19203C7.17152 5.33803 7.47062 4.51915 7.93199 3.79113C8.39336 3.06311 9.00616 2.44303 9.72869 1.9731C10.4512 1.50318 11.2665 1.19444 12.1191 1.06789C12.9716 0.941345 13.8415 0.999968 14.6693 1.23977C15.4972 1.47957 16.2637 1.89492 16.9166 2.45755C17.5696 3.02018 18.0936 3.71688 18.4531 4.50022C18.8127 5.28357 18.9992 6.13518 19 6.99709Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo get_phrase('Account'); ?>
        </a>
    </div>
</div>