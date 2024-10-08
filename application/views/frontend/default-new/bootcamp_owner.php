<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">
<?php

$owner = $CI->bootcamp_model->get_table('users', $bootcamp_details['owner_id'])->row_array();

?>

<div class="instructor">
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-4 col-4">
            <div class="instructor-img">
                <img src="<?php echo $this->user_model->get_user_image_url($bootcamp_details['owner_id']); ?>">
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-8">
            <div class="instructor-text">
                <h2 class="text-black ms-0 fw-600"><?php echo $owner['first_name'] . ' ' . $owner['last_name']; ?></h2>
                <p class="ms-0 text-15px font-inter-light ellipsis-line-2"><?php echo $owner['title']; ?></p>
                <div class="ellipsis-line-2 font-inter-light"><?php echo ($owner['biography']) ? strip_tags($owner['biography']) : ''; ?></div>
            </div>
            <div class="instructor-icon mt-3">
                <?php foreach (json_decode($owner['social_links'], true) as $key => $social_link) : ?>
                    <?php if (!$social_link) continue; ?>
                    <a href="<?php echo $social_link; ?>">
                        <?php if ($key == 'facebook') : ?>
                            <i class="fa-brands fa-facebook-f" data-bs-toggle="tooltip" title="<?php echo get_phrase('Facebook'); ?>"></i>
                        <?php elseif ($key == 'twitter') : ?>
                            <i class="fa-brands fa-twitter" data-bs-toggle="tooltip" title="<?php echo get_phrase('Twitter'); ?>"></i>
                        <?php elseif ($key == 'linkedin') : ?>
                            <i class="fa-brands fa-linkedin" data-bs-toggle="tooltip" title="<?php echo get_phrase('Linkedin'); ?>"></i></a>
                <?php endif; ?>
                </a>
            <?php endforeach; ?>
            </div>
            <!-- <a class="btn btn-primary py-2 btn-sm" href="<?php echo site_url('home/instructor_page/' . $owner_id) ?>" target="_blank"><?php echo get_phrase('View Profile'); ?></a> -->
        </div>
    </div>
</div>