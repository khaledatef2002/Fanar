<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">

<?php

$CI    = &get_instance();
$CI->load->database();

$categories = $CI->bootcamp_model->get_table('bootcamp_category');

$url = site_url('addons/bootcamp/action/create');
$title = 'add_new_bootcamp';
$title_2 = 'bootcamp_add_form';

if (isset($bootcamp_details)) {
    $url = site_url('addons/bootcamp/action/update/' . $bootcamp_id);
    $title = 'edit_bootcamp';
    $title_2 = 'bootcamp_edit_form';
}
?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase($title); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase($title_2); ?></h4>

                <form class="required-form" action="<?php echo $url; ?>" enctype="multipart/form-data" method="post">
                    <div id="progressbarwizard">
                        <?php include 'tab_menu.php'; ?>

                        <div class="tab-content b-0 mb-0">
                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                            </div>

                            <?php if (isset($bootcamp_details)) : ?>
                                <?php include 'curriculum_tab.php'; ?>
                                <?php include 'basic_tab_edit.php'; ?>
                                <?php include 'info_tab_edit.php'; ?>
                                <?php include 'pricing_tab_edit.php'; ?>
                                <?php include 'media_tab_edit.php'; ?>
                                <?php include 'seo_tab_edit.php'; ?>
                            <?php else : ?>
                                <?php include 'basic_tab.php'; ?>
                                <?php include 'info_tab.php'; ?>
                                <?php include 'pricing_tab.php'; ?>
                                <?php include 'media_tab.php'; ?>
                                <?php include 'seo_tab.php'; ?>
                            <?php endif; ?>
                            <?php include 'finish_tab.php'; ?>


                            <ul class="list-inline mb-0 wizard text-center">
                                <li class="previous list-inline-item">
                                    <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a>
                                </li>
                                <li class="next list-inline-item">
                                    <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initSummerNote(['#description']);
        togglePriceFields('is_free_course');
    });
</script>

<script type="text/javascript">
    var blank_faq = jQuery('#blank_faq_field').html();
    var blank_outcome = jQuery('#blank_outcome_field').html();
    var blank_requirement = jQuery('#blank_requirement_field').html();
    jQuery(document).ready(function() {
        jQuery('#blank_faq_field').hide();
        jQuery('#blank_outcome_field').hide();
        jQuery('#blank_requirement_field').hide();
    });

    function appendFaq() {
        jQuery('#faq_area').append(blank_faq);
    }

    function removeFaq(faqElem) {
        jQuery(faqElem).parent().parent().remove();
    }

    function appendOutcome() {
        jQuery('#outcomes_area').append(blank_outcome);
    }

    function removeOutcome(outcomeElem) {
        jQuery(outcomeElem).parent().parent().remove();
    }

    function appendRequirement() {
        jQuery('#requirement_area').append(blank_requirement);
    }

    function removeRequirement(requirementElem) {
        jQuery(requirementElem).parent().parent().remove();
    }

    function priceChecked(elem) {
        if (jQuery('#discountCheckbox').is(':checked')) {

            jQuery('#discountCheckbox').prop("checked", false);
        } else {

            jQuery('#discountCheckbox').prop("checked", true);
        }
    }

    function topCourseChecked(elem) {
        if (jQuery('#isTopCourseCheckbox').is(':checked')) {

            jQuery('#isTopCourseCheckbox').prop("checked", false);
        } else {

            jQuery('#isTopCourseCheckbox').prop("checked", true);
        }
    }

    function isFreeCourseChecked(elem) {

        if (jQuery('#' + elem.id).is(':checked')) {
            $('#price').prop('required', false);
        } else {
            $('#price').prop('required', true);
        }
    }

    function calculateDiscountPercentage(discounted_price) {
        if (discounted_price > 0) {
            var actualPrice = jQuery('#price').val();
            if (actualPrice > 0) {
                var reducedPrice = actualPrice - discounted_price;
                var discountedPercentage = 100 - ((reducedPrice / actualPrice) * 100);
                if (discountedPercentage > 0) {
                    jQuery('#discounted_percentage').text(discountedPercentage.toFixed(2) + '%');

                } else {
                    jQuery('#discounted_percentage').text('<?php echo '0%'; ?>');
                }
            }
        }
    }

    $('.on-hover-action').mouseenter(function() {
        var id = this.id;
        $('#widgets-of-' + id).show();
    });
    $('.on-hover-action').mouseleave(function() {
        var id = this.id;
        $('#widgets-of-' + id).hide();
    });
</script>



<style media="screen">
    body {
        overflow-x: hidden;
    }
</style>