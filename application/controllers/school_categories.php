<?php
if (count($sub_categories) > 0) :
    foreach ($sub_categories as $key => $sub_category) :
?>
        <div class="item-container col-lg-3 col-6 px-2 mb-2">
            <div class="subcat-item rounded-2 p-3" data-id="<?php echo $sub_category['id']; ?>" role="button">
                <?php echo $sub_category['name']; ?>
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

<script>
    $(".subcat-item").click(function() {
        // Get data from some input field, for example
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
</script>