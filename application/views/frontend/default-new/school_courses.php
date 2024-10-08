<?php if (count($courses) > 0 || count($bundles) > 0) : ?>
  <?php if (count($courses) > 0): ?>
    <div class="tabs-container px-5 py-4 rounded-4">
        <p class="text-center fs-4 mb-4"><?php echo get_phrase('choose_material'); ?></p>
        <div class="row align-items-center">
            <?php foreach ($courses as $key => $course) : ?>
                <div class="item-container col-lg-3 col-6 px-md-4 mb-2" role="button">
                    <div class="course-item d-block bg-white rounded-2 px-3 py-4 d-flex flex-column align-items-center gap-3" href="<?php echo site_url('home/course/' . rawurlencode(slugify($course->title)) . '/' . $course->id); ?>">
                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course->id); ?>" style="max-width: 100%;" class="rounded-2">
                        <p class="text-center"><?php echo $course->title; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center d-flex align-items-center justify-content-between mt-3">
            <button id="back_to_subcategories_tab" class="btn rounded-5 px-5 py-3"><?php echo get_phrase('back'); ?></button>
            <button class="course-next-step next-step btn rounded-5 px-5 py-3"><?php echo get_phrase('show'); ?></button>
        </div>
    </div>
   <?php else: ?>
    <div class="tabs-container px-5 py-4 rounded-4">
        <div class="text-center d-flex align-items-center justify-content-between mt-3">
            <button id="back_to_subcategories_tab" class="btn rounded-5 px-5 py-3"><?php echo get_phrase('back'); ?></button>
            <button class="course-next-step next-step btn rounded-5 px-5 py-3"><?php echo get_phrase('show'); ?></button>
        </div>
    </div>
  <?php endif; ?>
  <?php if (count($bundles) > 0): ?>
    <h2 class="fs-2 text-center text-dark mt-4 mb-2 col-md-10 mx-auto">او قم بالحصول على جميع مواد صفك باشتراك واحد ووفر اكثر من 80%</h2>
    <div class="row mt-3">
        <?php 
          foreach($bundles as $bundle):
            $instructor_details = $this->user_model->get_all_user($bundle->user_id)->row_array();
            $course_ids = json_decode($bundle->course_ids);
            sort($course_ids);
        ?>
        <div class="col-12 mb-4">
            <div class="sbundle-items p-4 rounded-3">
                <div class="bundle-head d-flex justify-content-between align-items-center flex-wrap px-0 pt-2">
                    <a href="<?php echo site_url('bundle_details/'.$bundle->id.'/'.slugify($bundle->title)); ?>">
                        <div class="title d-flex align-items-center g-12">
                            <h4 class="name"><?php echo preg_match('/^{{.*}}$/', $bundle->title, $string) ? get_phrase(trim(substr($bundle->title, 2, -2))) : $bundle->title; ?></h4>
                            <p class="info"><?php echo count($course_ids).' '.site_phrase('courses'); ?></p>
                        </div>
                    </a>
                <p class="price d-flex flex-column align-items-center">
                    <span class="price"><?php echo $bundle->price; ?></span>
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
                    <?php $is_purchase = $this->db->where('user_id', $this->session->userdata('user_id'))->where('bundle_id', $bundle->id)->get('bundle_payment')->num_rows();?>
                    <?php if($is_purchase > 0):?>
                    <a href="<?php echo base_url('home/my_bundles')?>" class="bundle-foot rounded-5 py-3 px-5"><?php echo get_phrase('My Bundles')?></a>
                    <?php endif?>
                    <a href="<?php echo site_url('bundle_details/'.$bundle->id.'/'.slugify($bundle->title)); ?>" class="bundle-foot rounded-5 py-3 px-5"><?php echo get_phrase('Bundle Details')?></a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
  <?php endif; ?>
<?php else : ?>
    <div class="tabs-container px-5 py-4 rounded-4">
        <p class="text-center fs-4 mb-4"><?php echo get_phrase('choose_material'); ?></p>
        <div class="text-center">
            No Data Found
        </div>
        <div class="text-center d-flex align-items-center justify-content-between mt-3">
            <button id="back_to_subcategories_tab" class="btn rounded-5 px-5 py-3"><?php echo get_phrase('back'); ?></button>
        </div>
    </div>
<?php endif; ?>

<script>
    $("#back_to_subcategories_tab").click(function() {
        tab_navigator("#stage2-tab")
    })
    $(".course-item").click(function() {
        // $(".course-next-step[data-selected='1'").removeAttr('data-selected')
        // $(this).attr("data-selected", '1')
        var link = $(this).attr("href");
        window.location = link
    });
    // $("button.course-next-step").click(function(){
    //     // Get data from some input field, for example
    //     var link = $(".course-item[data-selected='1'").attr("href");
    //     window.location = link
    // })
</script>