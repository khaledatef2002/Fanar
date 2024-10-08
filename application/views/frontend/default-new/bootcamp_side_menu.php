<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">
<form action="<?php echo site_url('addons/bootcamp/bootcamp_list'); ?>" method="get" id="bootcamp_filter_form">

    <div class="course-all-category m-0">
        <div class="course-category">
            <h3><?php echo get_phrase('bootcamps'); ?></h3>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="category" value="all" id="all_bootcamps" <?php if ($selected_category == 'all') : ?> checked <?php endif; ?>>
                <label class="form-check-label" for="all_bootcamps">
                    <div class="category-heading">
                        <span class="text-13px"><?php echo get_phrase('All bootcamps') ?></span>
                    </div>
                    <span>(<?php
                            $all_bootcamps = $this->db->get('bootcamp')->num_rows();
                            echo $all_bootcamps; ?>)
                    </span>
                </label>
            </div>

            <div class="webdesign webdesign-category">
                <?php foreach ($categories->result_array() as $category) : ?>
                    <?php
                    $has_bootcamp = $this->db->where('category', $category['id'])->get('bootcamp');
                    $modifyed_title = strtolower(implode('-', explode(' ', $category['category_name'])));
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="<?php echo $modifyed_title; ?>" name="category" id="bootcamp-<?php echo $category['id']; ?>" <?php if ($selected_category == $category['category_name']) : ?>checked<?php endif; ?>>
                        <label class="form-check-label" for="bootcamp-<?php echo $category['id']; ?>">
                            <div class="category-heading">
                                <span class="text-13px"><?php echo $category['category_name']; ?></span>
                            </div>
                            <span>(<?php echo $has_bootcamp->num_rows(); ?>)</span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <?php if ($searched_keyword != '') : ?>
        <input type="hidden" name="search" value="<?php echo $searched_keyword; ?>">
    <?php endif; ?>
</form>

<script>
    $(document).ready(function() {
        $('input[type=radio]').click(function(e) {
            $('#bootcamp_filter_form').submit();
        });
    });
</script>