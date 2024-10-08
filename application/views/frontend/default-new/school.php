<section class="school-content py-5 px-3">
    <div class="row">
        <div class="header d-flex flex-column align-items-center">
            <h1 class="fs-1 mb-4 text-center"><?php echo get_phrase('academic_school_title'); ?></h1>
            <p class="fs-5 text-center"><?php echo get_phrase('academic_school_p'); ?></p>
        </div>
        <div class="container mt-5 custom-nav">
            <ul class="nav nav-tabs d-flex justify-content-between px-4 align-items-center mb-5 rounded-4 py-3" id="myTab" role="tablist">
                <li class="nav-item position-relative d-flex align-items-center gap-3" role="presentation">
                    <button class="nav-link active" id="stage1-tab" data-bs-target="#stage1" type="button" role="tab" aria-controls="stage1" aria-selected="true">
                        <p>1</p>
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <span><?php echo get_phrase('class'); ?></span>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item position-relative d-flex align-items-center gap-3" role="presentation">
                    <button class="nav-link" id="stage2-tab" data-bs-target="#stage2" type="button" role="tab" aria-controls="stage2" aria-selected="false">
                        <p>2</p>
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <span><?php echo get_phrase('semester'); ?></span>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item position-relative d-flex align-items-center gap-3" role="presentation">
                    <button class="nav-link" id="stage3-tab" data-bs-target="#stage3" type="button" role="tab" aria-controls="stage3" aria-selected="false">
                        <p>3</p>
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <span><?php echo get_phrase('material'); ?></span>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="stage1" role="tabpanel" aria-labelledby="stage1-tab">
                    <div class="tabs-container px-5 py-4 rounded-4">
                        <p class="text-center fs-4 mb-4"><?php echo get_phrase('choose_class'); ?></p>
                        <div class="categories row">
                            <?php
                            $categories = $this->crud_model->get_categories()->result_array();
                            if (count($categories) > 0) :
                                foreach ($categories as $key => $category) :
                            ?>
                                    <div class="item-container col-lg-3 col-6 px-md-4 mb-2">
                                        <div class="cat-item rounded-2 px-3 py-4 d-flex flex-column align-items-center gap-3" data-id="<?php echo $category['id']; ?>" role="button">
                                            <img src="<?php echo base_url("uploads/thumbnails/category_thumbnails/") . $category['thumbnail']; ?>" alt="">
                                            <p>
                                                <?php echo preg_match('/^{{.*}}$/', $category['name'], $string) ? get_phrase(trim(substr($category['name'], 2, -2))) : $category['name']; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <div class="text-center">
                                    <?php echo get_phrase('no_data_found'); ?>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="text-center">
                                <button class="cat-next-step next-step mt-3 btn rounded-5 px-5 py-3"><?php echo get_phrase('next-step'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="stage2" role="tabpanel" aria-labelledby="stage2-tab">
                    <div class="tabs-container px-5 py-4 rounded-4">
                        <p class="text-center fs-4 mb-4"><?php echo get_phrase('choose_semester'); ?></p>
                        <div id="stage2-loader" class="spinner-border text-primary mx-auto" role="status" style="display: block;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="sub_categories row">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="stage3" role="tabpanel" aria-labelledby="stage3-tab">
                    <div id="stage3-loader" class="spinner-border text-primary mx-auto" role="status" style="display: block;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="lessons row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $(".cat-item").click(function() {
            // $(".cat-item[data-selected='1'").removeAttr('data-selected')
            var id = $(this).attr("data-id");
            $(".sub_categories").hide()
            $("#stage2-loader").show()
            tab_navigator("#stage2-tab")
            $.ajax({
                url: "<?php echo base_url('school/get_sub_categories'); ?>",
                type: "POST",
                data: {
                    id
                }, // Send data to the server
                success: function(response) {
                    $(".sub_categories").html(response);
                    $(".sub_categories").show()
                    $("#stage2-loader").hide()
                }
            });
        });
        // $("button.cat-next-step").click(function(){
        //     // Get data from some input field, for example
        //     var id = $(".cat-item[data-selected='1'").attr("data-id");
        //     $(".sub_categories").hide()
        //     $("#stage2-loader").show()
        //     tab_navigator("#stage2-tab")
        //     $.ajax({
        //         url: "<?php echo base_url('school/get_sub_categories'); ?>",
        //         type: "POST",
        //         data: {
        //             id
        //         }, // Send data to the server
        //         success: function(response) {
        //             $(".sub_categories").html(response);
        //             $(".sub_categories").show()
        //             $("#stage2-loader").hide()
        //         }
        //     });
        // })
        <?php if(isset($_GET['class'])) { ?>
            var id = <?php echo $_GET['class']; ?>;
            $(".sub_categories").hide()
            $("#stage2-loader").show()
            tab_navigator("#stage2-tab")
            $.ajax({
                url: "<?php echo base_url('school/get_sub_categories'); ?>",
                type: "POST",
                data: {
                    id
                }, // Send data to the server
                success: function(response) {
                    $(".sub_categories").html(response);
                    $(".sub_categories").show()
                    $("#stage2-loader").hide()
                }
            });
        <?php } ?>
    });
</script>