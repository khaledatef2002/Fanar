<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/coupons'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><?php echo get_phrase('back_to_coupons'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <form class="required-form d-flex col-12" action="<?php echo site_url('admin/coupons/add'); ?>" method="post" enctype="multipart/form-data">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        <h4 class="mb-3 header-title"><?php echo get_phrase('coupon_add_form'); ?></h4>

                        <div class="form-group">
                            <label for="code"><?php echo get_phrase('coupon_code'); ?><span class="required">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="code" name="code" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('generate_a_random_coupon_code'); ?>" onclick="generateARandomCouponCode()"><i class="mdi mdi-sync"></i> <?php echo get_phrase('generate_random'); ?></button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="discount"><?php echo get_phrase('discount'); ?></label>
                            <div class="input-group">
                                <input type="number" name="discount" id="discount" class="form-control" value="0" min="1">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-percent"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex">
                            <label class="mb-0 mr-2"><?php echo get_phrase('discount type'); ?>:</label>
                            <div class="d-flex align-items-center">
                                <div class="mr-4">
                                    <label class="mb-0" for="discount_type1"><?php echo get_phrase('discount type percent'); ?></label>
                                    <input name="discount_type" id="discount_type1" value="percent" type="radio">
                                </div>
                                <div>
                                    <label class="mb-0" for="discount_type2"><?php echo get_phrase('discount type fixed'); ?></label>
                                    <input name="discount_type" id="discount_type2" value="fixed" type="radio">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expiry_date"><?php echo get_phrase('expiry_date'); ?><span class="required">*</span></label>
                            <input type="text" name="expiry_date" class="form-control date" id="expiry_date" data-toggle="date-picker" data-single-date-picker="true">
                        </div>

                        <div class="form-group">
                            <div class="d-flex">
                                <label><?php echo get_phrase('coupon min activator'); ?>:</label>
                                <div class="form-check">
                                    <input type="checkbox" name="enable_drip_content" value="1" id="toggleCheckbox" data-switch="primary">
                                    <label for="toggleCheckbox" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>
                            <div id="toggleInput" class="form-group mt-1" style="display: none;">
                                <input type="text" name="min" class="form-control" id="additionalInput" placeholder="<?php echo get_phrase('enter min coupon order'); ?>">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary"><?php echo get_phrase("submit"); ?></button>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
        <div class="col-xl-5">
            <div class="card category-condition-container">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>شروط التصنيفات</h4>
                    <div class="form-group d-flex align-items-center mb-0">
                        <div class="form-check d-flex align-items-center">
                            <input class="condition_switcher" type="checkbox" name="category_condition" value="1" id="category_condition" data-switch="primary">
                            <label class="mb-0" for="category_condition" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group row mx-auto justify-content-center">
                        <div class="flex-fill">
                            <select class="form-control select2" data-toggle="select2" name="category_id" id="category_id">
                                <option value=""><?php echo get_phrase('select_a_category'); ?></option>
                                <?php foreach ($categories->result_array() as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo preg_match('/^{{.*}}$/', $category['name'], $string) ? get_phrase(trim(substr($category['name'], 2, -2))) : $category['name']; ?>    
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                    <hr>
                    <div class="condition_list">
                    </div>
                </div>
            </div>
            <div class="card sub-category-condition-container">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>شروط التصنيفات الفرعية</h4>
                    <div class="form-group d-flex align-items-center mb-0">
                        <div class="form-check d-flex align-items-center">
                            <input class="condition_switcher" type="checkbox" name="sub_category_condition" value="1" id="sub_category_condition" data-switch="primary">
                            <label class="mb-0" for="sub_category_condition" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group row mx-auto justify-content-center">
                        <div class="flex-fill">
                            <select class="form-control select2" data-toggle="select2" name="sub_category_id" id="sub_category_id">
                                <option value=""><?php echo get_phrase('select_a_sub_category'); ?></option>
                                <?php foreach ($categories->result_array() as $category): ?>
                                    <optgroup label="<?php echo preg_match('/^{{.*}}$/', $category['name'], $string) ? get_phrase(trim(substr($category['name'], 2, -2))) : $category['name']; ?>">
                                        <?php $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                                        foreach ($sub_categories as $sub_category): ?>
                                            <option value="<?php echo $sub_category['id']; ?>">
                                                <?php echo preg_match('/^{{.*}}$/', $sub_category['name'], $string) ? get_phrase(trim(substr($sub_category['name'], 2, -2))) : $sub_category['name']; ?> 
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                    <hr>
                    <div class="condition_list">
                    </div>
                </div>
            </div>
            <div class="card bundle-condition-container">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>شروط الحزم الدراسية</h4>
                    <div class="form-group d-flex align-items-center mb-0">
                        <div class="form-check d-flex align-items-center">
                            <input class="condition_switcher" type="checkbox" name="bundle_condition" value="1" id="bundle_condition" data-switch="primary">
                            <label class="mb-0" for="bundle_condition" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group row mx-auto justify-content-center">
                        <div class="flex-fill">
                            <select class="form-control select2" data-toggle="select2" name="bundle_id" id="bundle_id">
                                <option value=""><?php echo get_phrase('select_a_bundle'); ?></option>
                                <?php foreach ($bundles->result_array() as $bundle): ?>
                                    <option value="<?php echo $bundle['id']; ?>"><?php echo $bundle['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                    <hr>
                    <div class="condition_list">
                    </div>
                </div>
            </div>
            <div class="card student-condition-container">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>شروط الطلاب</h4>
                    <div class="form-group d-flex align-items-center mb-0">
                        <div class="form-check d-flex align-items-center">
                            <input class="condition_switcher" type="checkbox" name="student_condition" value="1" id="student_condition" data-switch="primary">
                            <label class="mb-0" for="student_condition" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group row mx-auto justify-content-center">
                        <div class="flex-fill">
                            <select class="form-control select2" data-toggle="select2" name="student_id" id="student_id">
                                <option value=""><?php echo get_phrase('select_a_student'); ?></option>
                                <?php foreach ($students->result_array() as $student): ?>
                                    <option value="<?php echo $student['id']; ?>"><?php echo $student['first_name'] . " " . $student['last_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                    <hr>
                    <div class="condition_list">
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function generateARandomCouponCode() {
        var randomCouponCode;
        randomCouponCode = randomString(7);
        $('#code').val(randomCouponCode);
    }

    function randomString(len) {
        var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return [...Array(len)].reduce(a => a + p[~~(Math.random() * p.length)], '');
    }
</script>
<script>
    function condition_item_remover(me){
        $(me).parent().remove()
    }
  $(document).ready(function(){
    $('#toggleCheckbox').change(function(){
      if($(this).is(':checked')){
        $('#toggleInput').slideDown();
      } else {
        $('#toggleInput').slideUp();
        $("#toggleInput input").val("0")
      }
    });
    $(".condition_switcher").change(function(){
        var status = $(this).prop('checked')
        if(status == true)
        {
            $(this).parent().parent().parent().parent().find('.card-body').show()
        }
        else
        {
            $(this).parent().parent().parent().parent().find('.card-body .condition_list').html("")
            $(this).parent().parent().parent().parent().find('.card-body').hide()
        }
    })

    $(".category-condition-container .card-body button").click(function(){
        var id = $(this).parent().find("select option:selected").val()
        var name = $(this).parent().find("select option:selected").text()
        if(id)
        {
            $(this).parent().parent().find(".condition_list").append(`
                <div class="condition_item mb-2 border rounded d-flex justify-content-between align-items-center px-2 py-1">
                    <input type="hidden" name="condition_category[]" value="${id}">
                    <p class="mb-0">${name}</p>
                    <span class="text-danger" style="cursor:pointer;" onclick="condition_item_remover(this)">X</span>
                </div>
            `)
            $(this).parent().find("select").val('').trigger('change');
        }
        else
        {
            $.NotificationApp.send("<?php echo get_phrase('notify_wrong_title'); ?>", '<?php echo get_phrase('please_choose_category'); ?>', "top-right", "rgba(0,0,0,0.2)", "error");
        }
    })

    $(".sub-category-condition-container .card-body button").click(function(){
        var id = $(this).parent().find("select option:selected").val()
        var name = $(this).parent().find("select option:selected").text()
        if(id)
        {
            $(this).parent().parent().find(".condition_list").append(`
                <div class="condition_item mb-2 border rounded d-flex justify-content-between align-items-center px-2 py-1">
                    <input type="hidden" name="condition_sub_category[]" value="${id}">
                    <p class="mb-0">${name}</p>
                    <span class="text-danger" style="cursor:pointer;" onclick="condition_item_remover(this)">X</span>
                </div>
            `)
            $(this).parent().find("select").val('').trigger('change');
        }
        else
        {
            $.NotificationApp.send("<?php echo get_phrase('notify_wrong_title'); ?>", '<?php echo get_phrase('please_choose_sub_category'); ?>', "top-right", "rgba(0,0,0,0.2)", "error");
        }
    })

    $(".bundle-condition-container .card-body button").click(function(){
        var id = $(this).parent().find("select option:selected").val()
        var name = $(this).parent().find("select option:selected").text()
        if(id)
        {
            $(this).parent().parent().find(".condition_list").append(`
                <div class="condition_item mb-2 border rounded d-flex justify-content-between align-items-center px-2 py-1">
                    <input type="hidden" name="condition_bundle[]" value="${id}">
                    <p class="mb-0">${name}</p>
                    <span class="text-danger" style="cursor:pointer;" onclick="condition_item_remover(this)">X</span>
                </div>
            `)
            $(this).parent().find("select").val('').trigger('change');
        }
        else
        {
            $.NotificationApp.send("<?php echo get_phrase('notify_wrong_title'); ?>", '<?php echo get_phrase('please_choose_bundle'); ?>', "top-right", "rgba(0,0,0,0.2)", "error");
        }
    })

    $(".student-condition-container .card-body button").click(function(){
        var id = $(this).parent().find("select option:selected").val()
        var name = $(this).parent().find("select option:selected").text()
        if(id)
        {
            $(this).parent().parent().find(".condition_list").append(`
                <div class="condition_item mb-2 border rounded d-flex justify-content-between align-items-center px-2 py-1">
                    <input type="hidden" name="condition_student[]" value="${id}">
                    <p class="mb-0">${name}</p>
                    <span class="text-danger" style="cursor:pointer;" onclick="condition_item_remover(this)">X</span>
                </div>
            `)
            $(this).parent().find("select").val('').trigger('change');
        }
        else
        {
            $.NotificationApp.send("<?php echo get_phrase('notify_wrong_title'); ?>", '<?php echo get_phrase('please_choose_student'); ?>', "top-right", "rgba(0,0,0,0.2)", "error");
        }
    })
  });
</script>