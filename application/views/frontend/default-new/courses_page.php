<?php
    $selected_category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $selected_price    = isset($_GET['price']) ? $_GET['price'] : 'all';
    $selected_level    = isset($_GET['level']) ? $_GET['level'] : 'all';
    $selected_language = isset($_GET['language']) ? $_GET['language'] : 'all';
    $selected_rating   = isset($_GET['rating']) ? $_GET['rating'] : 'all';
    $selected_sorting  = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'all';
?>

<section id="courses-header" class="text-center py-5">
    <div class="container py-4">
        <h1 class="text-dark fs-2 fw-bold mb-4"><?php echo get_phrase('courses_header'); ?></h1>
        <p class="text-dark fs-5"><?php echo get_phrase('courses_p'); ?></p>
    </div>
</section>

<section class="grid-view courses-list-view">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-9 col-md-9 col-sm-8"> 
                 <?php include 'courses_page_' . $layout . '_layout.php'; ?>

                 <?php if(count($courses) == 0): ?>
                    <div class="not-found w-100 text-center d-flex align-items-center flex-column">
                        <img loading="lazy" width="80px" src="<?php echo base_url('assets/global/image/not-found.svg'); ?>">
                        <h5><?php echo get_phrase('Course Not Found'); ?></h5>
                        <p><?php echo get_phrase('Sorry, try using more similar words in your search.') ?></p>
                    </div>
                 <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    function filterCourse(){
        //sorting value added to the filter form
        var sort_by = $('#sorting_select_input').val();
        $('#sorting_hidden_input').val(sort_by);

        $('#course_filter_form').submit();
    }
</script>