<!-- Add the jQuery and jQuery UI libraries -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<?php 

    isset($searched_word) ? "" : $searched_word = "";
    isset($searched_main_category) ? "" : $searched_main_category = array();
    isset($searched_sub_category) ? "" : $searched_sub_category = array();
    isset($searched_price_type) ? "" : $searched_price_type = array();
    isset($searched_tution_class_type) ? "" : $searched_tution_class_type = array();
    isset($searched_tutors) ? "" : $searched_tutors = array();
    isset($searched_duration) ? "" : $searched_duration = array();
    isset($searched_price) ? "" : $searched_price = "";
    isset($highest_price) ? "" : $highest_price = 100;
    isset($price_min) ? "" : $price_min = 1;
    isset($price_max) ? "" : $price_max = $highest_price + 10;


?>

<style>
    .ui-slider-horizontal .ui-slider-range {
        height: 25%;
        background: #754ffe;
        top:8px;
    }
    .ui-slider-horizontal .ui-slider-handle {
        top: 4px;
    }
    .ui-slider .ui-slider-handle {
        touch-action: none;
        border-radius: 50%;
        cursor: pointer;
        width: 15px;
        height: 15px;
        cursor: default;
    }
    .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, .ui-button:hover, .ui-button:focus {
        border: 1px solid #c5c5c5;
        background: #f6f6f6;
    }
    .ui-widget.ui-widget-content {
        border: none !important;

    }
    #price-range-slider{
        position: relative;
    }
    #price-range-slider:after {
        position: absolute;
        content: "";
        top: 6px;
        left: 0;
        width: 100%;
        height: 33%;
        background: #e9ecef;
        border-radius:5px;
    }
    .s_Sidebar_checkbox_one input {;
        border: none;
    }
    .ui-slider-handle:focus{
        border-color:#754ffe !important; 
        outline: none;
    }
    .slider-control{
    margin-top: 5px;
    margin-bottom:15px;
    }
    .slider-control input:focus{
        outline:none;
    }
    .slider-control input{
        width: 50px;
        height: 100%;
        color: #676C7D;
        text-align:center;
        border:none;
        outline:none;
    }
    .separator {
        font-size: 20px;
        color: #676C7D;
    }
    .s_Sidebar_checkbox_one .form-check-input{
        border: 1px solid rgba(0,0,0,.25);
    }
</style>


<div class="list_of_tuitions_header py-4">
    <div class="container"> 
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-column justify-content-evenly align-items-start">
                <span class="badge fs-6 py-2 px-4"><?php echo get_phrase('fanar-platform'); ?></span>
                <h4 class="title fs-1 my-3"><?php echo get_phrase('list-of-tuitions-title'); ?></h4>
            </div>
        </div>
    </div>
</div>
<!-- Start Tutor list -->
<section class="list_of_tuitions_content pt-50 pb-120">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-4 col-md-5">

                <form id="filter_data" action="<?php echo site_url('tutor/filter'); ?>" method="get">
                    <div class="sidebar-header mb-3">
                        <div class="title d-flex justify-content-between align-items-center p-3">
                            <h4><?php echo get_phrase('Filters'); ?></h4>
                            <div class="icon"><img loading="lazy" src="assets/frontend/default-new/image/icon/filter.svg" alt="" /></div>
                        </div>
                        <div class="sidebar-card p-3 pb-1">
                            <div class="s_search mb-20">
                                <?php $value = "";
                                if ($searched_word != "") {
                                $value = $searched_word;
                                } ?>
                                <input type="search" class="form-control" name="searched_word" placeholder="Search" value="<?= $value ?>">
                                <span><img loading="lazy" src="assets/frontend/default-new/image/icon/s_search.svg" alt="" /></span>
                            </div>

                            <?php if (!empty($searched_main_category)) :
                                foreach ($searched_main_category as  $main_categories) : ?>

                                    <input type="hidden" name="searched_main_category[]" value="<?= $main_categories ?>">
                            <?php endforeach;
                            endif; ?>

                            <?php if (!empty($searched_sub_category)) :
                                foreach ($searched_sub_category as  $sub_categories) : ?>

                                    <input type="hidden" name="searched_sub_category[]" value="<?= $sub_categories ?>">
                            <?php endforeach;
                            endif; ?>

                            <?php if (!empty($searched_price_type)) :
                                foreach ($searched_price_type as  $price) : ?>

                                    <input type="hidden" name="searched_price_type[]" value="<?= $price ?>">
                            <?php endforeach;
                            endif; ?>

                            <?php if (!empty($searched_tution_class_type)) :
                                foreach ($searched_tution_class_type as  $tution_class_type) : ?>

                                    <input type="hidden" name="searched_tution_class_type[]" value="<?= $tution_class_type ?>">
                            <?php endforeach;
                            endif; ?>

                            <?php if (!empty($searched_tutors)) :
                                foreach ($searched_tutors as  $tutor) : ?>

                                    <input type="hidden" name="searched_searched_tutors[]" value="<?= $tutor ?>">
                            <?php endforeach;
                            endif; ?>

                            <?php if (!empty($searched_duration)) :
                                foreach ($searched_duration as  $duration) : ?>

                                    <input type="hidden" name="searched_searched_duration[]" value="<?= $duration ?>">
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="searched_word" placeholder="Search" value="<?= $value ?>">

                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Price Range') ?></h4>
                        <div class="slider-control d-flex align-items-center">
                            <div class="input-field d-flex align-items-center justify-content-evenly gap-3 px-3">
                                <input type="number" class="col-5 py-2" name='price_max' placeholder="<?php echo get_phrase('max_price'); ?>" onchange="document.getElementById('filter_data').submit();" value="<?= (isset($_GET['price_max']) && !empty($_GET['price_max'])) ? $_GET['price_max']: ''; ?>" id="price-range2">
                                <input type="number" class="col-5 py-2" name='price_min' placeholder="<?php echo get_phrase('min_price'); ?>" onchange="document.getElementById('filter_data').submit();" value="<?= (isset($_GET['price_min']) && !empty($_GET['price_min'])) ? $_GET['price_min']: ''; ?>" id="price-range1">
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Tuition type') ?></h4>
                        <div class="s_Sidebar_checkbox_one pb-12">
                            <input id="online" name="searched_tution_class_type[]" class="form-check-input" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="1" <?php if (in_array(1, $searched_tution_class_type)) echo 'checked' ?>>
                            <label class="form-check-label" for="online"><?= get_phrase('Online') ?></label>
                        </div>
                        <div class="s_Sidebar_checkbox_one">
                            <input id="in_Person" name="searched_tution_class_type[]" class="form-check-input" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="2" <?php if (in_array(2, $searched_tution_class_type)) echo 'checked' ?>>
                            <label class="form-check-label" for="in_Person"><?= get_phrase('In Perosn') ?></label>
                        </div>
                    </div>
                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Main category') ?></h4>
                        <?php
                        if ($data_base_main_category->num_rows() > 0) :
                            $data_base_main_category = $data_base_main_category->result_array();
                            $main_cat_counter = 0;
                            foreach ($data_base_main_category as $category) :
                                $unique_main = "main_cat_" . $category['id'];
                        ?>
                            <div class="s_Sidebar_checkbox_one pb-12">
                                <input id="<?= $unique_main ?>" class="form-check-input" value="<?= $category['id'] ?>" <?php if (in_array($category['id'], $searched_main_category)) echo 'checked'; ?> name="searched_main_category[]" onchange="document.getElementById('filter_data').submit()" type="checkbox">
                                <label class="form-check-label" for="<?= $unique_main ?>"><?= get_phrase($category['name']) ?></label>
                            </div>
                            <?php endforeach;
                        endif; ?>
                    </div>
                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Sub category') ?></h4>
                        <?php
                        if ($data_base_sub_category->num_rows() > 0) :
                            $data_base_sub_category = $data_base_sub_category->result_array();
                            $sun_cat_counter = 0;
                            foreach ($data_base_sub_category as $category) :
                                $unique_sub = "sub_cat_" . $category['id'];
                                
                                ?>
                            <div class="s_Sidebar_checkbox_one pb-12">
                                <input id="<?= $unique_sub ?>" class="form-check-input" value="<?= $category['id'] ?>" name="searched_sub_category[]" <?php if (in_array($category['id'], $searched_sub_category)) echo 'checked'; ?> onchange="document.getElementById('filter_data').submit()" type="checkbox"> <label for="<?= $unique_sub ?>">
                                    <label class="form-check-label" for="<?= $unique_sub ?>"><?= get_phrase($category['name']) ?></label>
                                </div>
                                <?php endforeach;
                        endif; ?>
                    </div>
                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Tuition type') ?></h4>
                        <div class="s_Sidebar_checkbox_one pb-12">
                            <input id="hourly" class="form-check-input" name="searched_price_type[]" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="hourly" <?php if (in_array('hourly', $searched_price_type)) echo 'checked' ?>>
                            <label class="form-check-label" for="hourly"><?= get_phrase('Hourly') ?></label>
                        </div>
                        <div class="s_Sidebar_checkbox_one">
                            <input id="fixed" class="form-check-input" name="searched_price_type[]" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="fixed" <?php if (in_array('fixed', $searched_price_type)) echo 'checked' ?>>
                            <label class="form-check-label" for="fixed"><?= get_phrase('Fixed') ?></label>
                        </div>
                    </div>
                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Tutors') ?></h4>
                        <?php
                        if (!empty($tutors)) :
                            $tutor_count = 0;
                            foreach ($tutors as $tutor) :
                                $tutor = $this->db->get_where('users', array('id' => $tutor))->row_array();
                                
                                $unique_id = "tutor_" . $tutor['id'];
                                ?>
                            <div class="s_Sidebar_checkbox_one pb-12">
                                <input id="<?= $unique_id ?>" class="form-check-input" name="searched_tutors[]" <?php if (in_array($tutor['id'], $searched_tutors)) echo 'checked' ?> onchange="document.getElementById('filter_data').submit()" value="<?= $tutor['id'] ?>" type="checkbox">
                                <label class="form-check-label" for="<?= $unique_id ?>"><?= get_phrase($tutor['first_name'] . " " . get_phrase($tutor['last_name'])) ?></label>
                            </div>
                            <?php endforeach;
                        endif; ?>
                    </div>
                    <div class="sidebar-card rounded-4 p-3 mb-3">
                        <h4 class="mb-20 s_Sidebar_title_one s_bar"><?= get_phrase('Tution availability') ?></h4>
                        <div class="s_Sidebar_checkbox_one pb-12">
                            <input id="single_time" class="form-check-input" name="searched_duration[]" onchange="document.getElementById('filter_data').submit()" value="1" type="checkbox" <?php if (in_array("1", $searched_duration)) echo 'checked' ?>>
                            <label class="form-check-label" for="single_time"><?= get_phrase('Single Time') ?></label>
                        </div>
                        <div class="s_Sidebar_checkbox_one">
                            <input id="selected_days" class="form-check-input" name="searched_duration[]" onchange="document.getElementById('filter_data').submit()" value="0" type="checkbox" <?php if (in_array("0", $searched_duration)) echo 'checked' ?>>
                            <label class="form-check-label" for="selected_days"><?= get_phrase('Selected Days ') ?></label>
                        </div>
                    </div>
                </form>
            </div>



            <!-- Course list -->
            <div class="col-lg-8 col-md-7">
                <?php if ($up_coming_schedules->num_rows() > 0) : 
                    $up_coming_schedules = $up_coming_schedules->result_array(); 
                ?>
                    <?php foreach ($up_coming_schedules as $schedule) :

                        $total_review = $this->tutor_booking_model->get_tutor_review($schedule['tutor_id']);
                        $number_of_rating = $total_review->num_rows();
                        $tutor_rating = 0;

                        if ($total_review->num_rows() > 0) {
                            $rating_count = $total_review->result_array();

                            foreach ($rating_count as $rating) {
                                $tutor_rating += $rating['rating'];
                            }

                            $tutor_rating = $tutor_rating / $number_of_rating;
                            $tutor_rating = round($tutor_rating, 1);
                        }
                    ?>
                        <div class="s_course_item_one mb-24 justify-content-between">
                            <?php $tutor = $this->db->get_where('users', array('id' => $schedule['tutor_id']))->row_array(); ?>
                            <div class="teacher-info d-flex flex-column flex-fill">
                                <div class="d-flex gap-3">
                                    <div class="img">
                                        <img loading="lazy" class="rounded" height="100px" src="<?php echo $this->user_model->get_user_image_url($tutor['id']) ?>" alt="" />
                                    </div>
                                    <div class="teacher-info-text d-flex flex-column gap-1 justify-content-center">
                                        <h4 class="name"><?= get_phrase($tutor['first_name'] . " " . get_phrase($tutor['last_name'])) ?></h4>
                                        <div class="rating d-flex align-items-center">
                                            <ul class="d-flex me-1">
                                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                                    <?php if ($i <= $number_of_rating) : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-12px"></i></li>
                                                    <?php else : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-12px"></i></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </ul>
                                            <p class="text-13px mt-5px fw-bold me-1"><?= get_phrase($tutor_rating) ?></p>
                                            <p class="text-9px mt-5px">(<?= $number_of_rating.' '.get_phrase('reviews') ?>)</p>
                                        </div>
                                        <p class="info fs-6"><?= $schedule['title']; ?></p>
                                        <!-- Button -->
                                        <?php
                                            $date_for_search_schedule = strtotime(Date('Y-m-d\TH:i'));
                                            $this->db->where('start_time > ', $date_for_search_schedule);
                                            $this->db->where('booking_id', $schedule['id']);
                                            $this->db->where('status', 0);
                                            $schedule_count = $this->db->get('tutor_schedule')->num_rows();
                                        ?>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <?php 
                                        if ($schedule['tution_class_type'] == 1)
                                            $c_type = "online";
                                        elseif ($schedule['tution_class_type'] == 2)
                                            $c_type = "in person";
                                        elseif ($schedule['tution_class_type'] == 3)
                                            $c_type = "online & offline";
                                    ?>
                                    <?php $category_name = $this->db->get_where('tutor_category', array('id' => $schedule['category_id']))->row('name'); ?>
                                    <?php $sub_category_name = $this->db->get_where('tutor_category', array('id' => $schedule['sub_category_id']))->row('name'); ?>
                                    
                                    <ul class="s_course_tag_list d-flex flex-wrap g-12">
                                        <li><span class="s_course_tag"><?= get_phrase($category_name) ?></span></li>
                                        <li><span class="s_course_tag"><?= get_phrase($sub_category_name) ?></span></li>
                                        <li><span class="s_course_tag"><?= get_phrase($c_type) ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content flex-fill">
                                <div class="d-flex flex-column gap-4 align-items-center">
                                    <p class="price fs-1"><?= currency($schedule['price']) ?></p>
                                    <p class="type fs-5"><?= get_phrase($schedule['price_type'])  ?></p>
                                    <a href="<?php echo site_url('schedules_bookings/' . $schedule['tutor_id']); ?>" class="schedule-no text-center mt-1 rounded-5 px-4 py-2"><?= get_phrase('Available schedules') ?> : <?= get_phrase($schedule_count + 1) ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else : ?>
                    <div class=" text-center mt-5">
                        <img loading="lazy" class="mb-3 mt-5 " width="180px" src="<?php echo base_url("assets/frontend/default-new/tutor_booking/new/image/no_result_found.png"); ?>" />
                        

                        <br>
                        <span class="">
                        <?= get_phrase('No_result_found')?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>


        </div>
    </div>
</section>

<!-- Modal HTML -->
<div class="modal" id="commingSoon" tabindex="-1">
  <div class="modal-dialog h-100 d-flex justify-content-center align-items-center m-0 mx-auto">
    <div class="modal-content bg-white">
      <div class="modal-body text-center py-4 px-4 text-dark">
        <h2><?php echo get_phrase('service_comming_soon'); ?></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo get_phrase('close'); ?></button>
      </div>
    </div>
  </div>
</div>

<script>
//   $(document).ready(function(){
//     $('#commingSoon').modal('show');
//   });
</script>
<script>
    "use strict";
    $(document).ready(function() {
        $("#filter_data").on("change", "input:checkbox", function() {
            $("#filter_data").submit();
        });
    });

    $(function() {
        // Set the minimum and maximum values for the slider
        var minPrice = 0;
        var maxPrice = <?= $highest_price + 10 ?>;

        // Set the default values for the slider
        var defaultMin = <?= (int)$price_min ?>;
        var defaultMax = <?= (int)$price_max ?>;

        // Initialize the slider with the default values
        $("#price-range").val(defaultMin + " - " + defaultMax);
        $("#price-range-slider").slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [defaultMin, defaultMax],
        slide: function(event, ui) {
            $("#price-range1").val(ui.values[0]);
            $("#price-range2").val(ui.values[1]);

            // Call the onchange event and submit the form
            document.getElementById('filter_data').submit();
        }
        });
    });
</script>

