<?php
if (count($sub_categories) > 0) :
    foreach ($sub_categories as $key => $sub_category) :
?>
        <div class="item-container col-lg-3 col-6 px-md-4 mb-2">
            <div class="subcat-item rounded-2 px-3 py-4 d-flex flex-column align-items-center gap-3" data-id="<?php echo $sub_category['id']; ?>" role="button">
                <img src="<?php echo base_url("uploads/thumbnails/category_thumbnails/") . $sub_category['sub_category_thumbnail']; ?>" alt=""> 
                <p><?php echo preg_match('/^{{.*}}$/', $sub_category['name'], $string) ? get_phrase(trim(substr($sub_category['name'], 2, -2))) : $sub_category['name']; ?></p>
            </div>
        </div>
    <?php
    endforeach;
?>
    <div class="text-center d-flex align-items-center justify-content-between mt-3">
        <button id="back_to_categories_tab" class="btn rounded-5 px-5 py-3"><?php echo get_phrase('back'); ?></button>
        <button class="subcat-next-step next-step btn rounded-5 px-5 py-3"><?php echo get_phrase('next-step'); ?></button>
    </div>
<?php
else :
    ?>
    <div class="text-center">
        <?php echo get_phrase('no_data_found'); ?>
        <div class="text-center d-flex align-items-center justify-content-between mt-3">
            <button id="back_to_categories_tab" class="btn rounded-5 px-5 py-3"><?php echo get_phrase('back'); ?></button>
        </div>
    </div>
<?php
endif;
?>

<script>
    $(".subcat-item").click(function() {
        // $(".subcat-item[data-selected='1'").removeAttr('data-selected')
        // $(this).attr("data-selected", '1')
        var id = $(this).attr("data-id");
        $(".lessons").hide()
        $("#stage3-loader").show()
        tab_navigator("#stage3-tab")
        $.ajax({
            url: "<?php echo base_url('school/get_courses'); ?>",
            type: "POST",
            data: {
                id
            }, // Send data to the server
            success: function(response) {
                $(".lessons").html(response);
                $(".lessons").show()
                $("#stage3-loader").hide()
            }
        });
    });
    // $(".subcat-next-step").click(function(){
    //     // Get data from some input field, for example
    //     var id = $(".subcat-item[data-selected='1'").attr("data-id");
    //     $(".lessons").hide()
    //     $("#stage3-loader").show()
    //     tab_navigator("#stage3-tab")
    //     $.ajax({
    //         url: "<?php echo base_url('school/get_courses'); ?>",
    //         type: "POST",
    //         data: {
    //             id
    //         }, // Send data to the server
    //         success: function(response) {
    //             $(".lessons").html(response);
    //             $(".lessons").show()
    //             $("#stage3-loader").hide()
    //         }
    //     });
    // })
    $("#back_to_categories_tab").click(function() {
        tab_navigator("#stage1-tab")
    })
</script>