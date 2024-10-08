<!---------- Bread Crumb Area Start ---------->
<?php include "bundle_header.php"; ?>
<!---------- Bread Crumb Area End ---------->
<!-- Start Tutor list -->
<section class="pt-50 pb-120">
    <div class="container">
    <!-- Search Results & Input -->
    <div class="bundle-search-container d-flex justify-content-between mb-5 py-3 px-4 rounded-5 d-flex align-items-center">
        <p class="searchResult fs-6">
            <?php if(isset($search_string)): ?>
                <span><?php echo site_phrase('found_number_of_bundles'); ?> : <?php echo count($course_bundles->result_array()); ?></span>
            <?php else: ?>
                <span><?php echo site_phrase('showing_on_this_page'); ?> : <?php echo count($course_bundles->result_array()); ?></span>
            <?php endif; ?>
        </p>
        <form action="<?php echo site_url('course_bundles/search/query'); ?>" method="get">
            <div class="s_search">
                <input type="text" class="form-control border-0" name="string" value="<?php if(isset($search_string)) echo $search_string; ?>" placeholder="<?php echo site_phrase('search_for_bundle'); ?>"/>
                <span class="d-flex align-items-center"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>
        </form>
    </div>
    <!-- Items -->
    <div class="row">
        <?php foreach($course_bundles->result_array() as $bundle):
            $instructor_details = $this->user_model->get_all_user($bundle['user_id'])->row_array();
            $course_ids = json_decode($bundle['course_ids']);
            sort($course_ids);
        ?>
        <div class="col-12 mb-4">
            <div class="sbundle-items p-4 rounded-3">
                <div class="bundle-head d-flex justify-content-between align-items-center flex-wrap px-0 pt-2">
                    <a href="<?php echo site_url('bundle_details/'.$bundle['id'].'/'.slugify($bundle['title'])); ?>">
                        <div class="title d-flex align-items-center g-12">
                            <h4 class="name"><?php echo preg_match('/^{{.*}}$/', $bundle['title'], $string) ? get_phrase(trim(substr($bundle['title'], 2, -2))) : $bundle['title']; ?></h4>
                            <p class="info"><?php echo count($course_ids).' '.site_phrase('courses'); ?></p>
                        </div>
                    </a>
                    <p class="price d-flex flex-column align-items-center">
                        <span class="price"><?php echo $bundle['price']; ?></span>
                        <span class="currency text-dark" style="line-height: 0.8;"><?php echo currency(); ?></span>
                    </p>
                </div>
                <style type="text/css">
                    .bundle-body{
                        overflow-y: hidden !important;
                    }
                    .bundle-body:hover{
                        overflow-y: auto !important;
                    }
                </style>
                <div class="bundle-body px-0 pt-2">
                <ul class="d-flex flex-wrap gap-2">
                <?php $total_courses_price = 0; ?>
                <?php foreach($course_ids as $key => $course_id):
                        ++$key;
                        $this->db->where('id', $course_id);
                        $this->db->where('status', 'active');
                        $course_details = $this->db->get('course')->row_array();

                        if ($course_details['is_free_course'] != 1):
                            if ($course_details['discount_flag'] != 1)
                                $total_courses_price += $course_details['price'];
                            else{
                                $total_courses_price += $course_details['discounted_price'];
                            }
                        endif;
                        if($key <= count($course_ids)): ?>
                        <li class="col-md-5 flex-fill">
                            <div class="sbundle-item">
                                <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>" target="_blank">
                                    <div class="content">
                                        <div class="img"><img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" /></div>
                                        <div class="d-flex flex-column">
                                            <h3 class="fw-400 title"><?php echo $course_details['title']; ?></h3>
                                            <div class="price fw-400 text-16px text-muted"><?php echo currency($course_details['price']); ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                </div>
                <div class="row d-flex flex-row justify-content-end gap-2">
                    <?php $is_purchase = $this->db->where('user_id', $this->session->userdata('user_id'))->where('bundle_id', $bundle['id'])->get('bundle_payment')->num_rows();?>
                    <?php if($is_purchase > 0):?>
                    <a href="<?php echo base_url('home/my_bundles')?>" class="bundle-foot rounded-5 py-3 px-5"><?php echo get_phrase('My Bundles')?></a>
                    <?php endif?>
                    <a href="<?php echo site_url('bundle_details/'.$bundle['id'].'/'.slugify($bundle['title'])); ?>" class="bundle-foot rounded-5 py-3 px-5"><?php echo get_phrase('Bundle Details')?></a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <div class="col-md-12 text-center">
            <?php if($course_bundles->num_rows() <= 0):
                echo site_phrase('no_result_found').' !';
            endif; ?>
        </div>
        <nav>
            <?php echo $this->pagination->create_links(); ?>
        </nav>
       
    </div>
    </div>
</section>
<!-- End Tutor list -->

<?php include "course_bundle_scripts.php"; ?>