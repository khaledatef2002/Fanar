<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">

<?php
$CI    = &get_instance();
$CI->load->database();

$categories = $CI->bootcamp_model->get_table('bootcamp_category');
?>

<?php include "breadcrumb.php"; ?>


<section class="grid-view courses-list-view m-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                <?php include "bootcamp_side_menu.php"; ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8">

                <div class="search-bootcamp mb-4">
                    <form action="<?php echo site_url('addons/bootcamp/bootcamp_list') ?>" method="get" class="d-flex gap-3 align-items-center">
                        <div class="form-element flex-grow-1">
                            <?php if ($selected_category != '') : ?>
                                <input type="hidden" name="category" value="<?php echo $selected_category; ?>">
                            <?php endif; ?>


                            <?php if (isset($searched_keyword)) : ?>
                                <input type="text" class="form-control" name="search" value="<?php echo $searched_keyword; ?>">
                            <?php else : ?>
                                <input type="text" class="form-control" name="search" placeholder="Search for bootcamp">
                            <?php endif; ?>
                        </div>
                        <div class="form-element">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

                <div class="bootcamps-card">

                    <?php if (count($bootcamps) > 0) : ?>
                        <div class="row">
                            <?php foreach ($bootcamps as $bootcamp) :
                                $live_class = $CI->bootcamp_model->get_table('bootcamp_live_class', 'bootcamp_id-' . $bootcamp['id']);
                                $is_purchased = $CI->bootcamp_model->is_purchased($bootcamp['id']);
                            ?>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                    <div class="bootcamp-card">
                                        <div class="live-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                                <ellipse cx="14.2485" cy="13.9239" rx="13.5171" ry="13.4874" fill="url(#paint0_radial_1_1754)" fill-opacity="0.51" />
                                                <ellipse cx="14.2482" cy="13.9231" rx="9.15364" ry="9.1335" fill="white" fill-opacity="0.88" />
                                                <path d="M26.6211 13.9235C26.6211 20.7411 21.082 26.2688 14.248 26.2688C7.414 26.2688 1.87489 20.7411 1.87489 13.9235C1.87489 7.10584 7.414 1.57812 14.248 1.57812C21.082 1.57812 26.6211 7.10584 26.6211 13.9235Z" stroke="white" stroke-width="0.5" />
                                                <ellipse cx="14.2487" cy="13.9258" rx="4.00986" ry="4.00104" fill="#F81C43" />
                                                <defs>
                                                    <radialGradient id="paint0_radial_1_1754" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(14.2485 13.9239) rotate(90) scale(13.4874 13.5171)">
                                                        <stop offset="0.640098" stop-color="white" />
                                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                                    </radialGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                        <a href="<?php echo site_url('addons/bootcamp/details/' . $bootcamp['id']); ?>" class="bootcamp-thumbnail">
                                            <img src="<?php echo base_url() . 'uploads/bootcamp/bootcamp_thumbnail/' . $bootcamp['bootcamp_thumbnail']; ?>">
                                        </a>
                                        <div class="bootcamp-details">
                                            <a href="<?php echo site_url('addons/bootcamp/details/' . $bootcamp['id']); ?>" class="ellipsis-line-2 bootcamp-title"><?php echo $bootcamp['title']; ?></a>

                                            <div class="d-flex justify-content-between align-items-center mb-3">

                                                <div class="live-classes">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                            <g clip-path="url(#clip0_1_1752)">
                                                                <path d="M4.04541 7.44334C5.14841 7.44334 6.04541 6.54831 6.04541 5.44774C6.04541 4.34717 5.14841 3.45214 4.04541 3.45214C2.94241 3.45214 2.04541 4.34717 2.04541 5.44774C2.04541 6.54831 2.94241 7.44334 4.04541 7.44334ZM4.04541 4.44994C4.59691 4.44994 5.04541 4.89745 5.04541 5.44774C5.04541 5.99803 4.59691 6.44554 4.04541 6.44554C3.49391 6.44554 3.04541 5.99803 3.04541 5.44774C3.04541 4.89745 3.49391 4.44994 4.04541 4.44994ZM7.54541 11.9334C7.54541 12.2093 7.32141 12.4323 7.04541 12.4323C6.76941 12.4323 6.54541 12.2093 6.54541 11.9334C6.54541 10.558 5.42391 9.43894 4.04541 9.43894C2.66691 9.43894 1.54541 10.558 1.54541 11.9334C1.54541 12.2093 1.32141 12.4323 1.04541 12.4323C0.76941 12.4323 0.54541 12.2093 0.54541 11.9334C0.54541 10.0082 2.11541 8.44114 4.04541 8.44114C5.97541 8.44114 7.54541 10.0082 7.54541 11.9334ZM12.5454 2.95324V6.94444C12.5454 8.31991 11.4239 9.43894 10.0454 9.43894H8.04541C7.76941 9.43894 7.54541 9.21593 7.54541 8.94004V7.94224C7.54541 7.66635 7.76941 7.44334 8.04541 7.44334H9.54541C9.82141 7.44334 10.0454 7.66635 10.0454 7.94224V8.44114C10.8724 8.44114 11.5454 7.76962 11.5454 6.94444V2.95324C11.5454 2.12806 10.8724 1.45654 10.0454 1.45654H5.27791C4.74391 1.45654 4.24591 1.74341 3.97841 2.20539C3.83991 2.44386 3.53441 2.52618 3.29541 2.38699C3.05591 2.24929 2.97441 1.94397 3.11291 1.70549C3.55891 0.936687 4.38841 0.45874 5.27841 0.45874H10.0459C11.4244 0.45874 12.5454 1.57777 12.5454 2.95324Z" fill="#754FFE" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_1752">
                                                                    <rect width="12" height="11.9736" fill="white" transform="translate(0.54541 0.45874)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>
                                                        <?php echo $live_class->num_rows(); ?>
                                                        <?php echo get_phrase('live_class'); ?>
                                                    </span>
                                                </div>

                                                <div class="bootcamp-schedule">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.02429 11.7303C9.79711 11.7303 12.0449 9.48741 12.0449 6.72069C12.0449 3.95399 9.79711 1.71113 7.02429 1.71113C4.25149 1.71113 2.00369 3.95399 2.00369 6.72069C2.00369 9.48741 4.25149 11.7303 7.02429 11.7303ZM7.02429 12.9826C10.4903 12.9826 13.3 10.179 13.3 6.72069C13.3 3.26231 10.4903 0.45874 7.02429 0.45874C3.55829 0.45874 0.748535 3.26231 0.748535 6.72069C0.748535 10.179 3.55829 12.9826 7.02429 12.9826Z" fill="#754FFE" />
                                                            <path d="M7.02455 2.96289C7.37115 2.96289 7.65212 3.24325 7.65212 3.58909V6.46069L9.03725 7.84276C9.28233 8.08731 9.28233 8.48379 9.03725 8.72834C8.79217 8.97288 8.39481 8.97288 8.14972 8.72834L6.58079 7.16285C6.46309 7.04541 6.39697 6.88614 6.39697 6.72006V3.58909C6.39697 3.24325 6.67795 2.96289 7.02455 2.96289Z" fill="#754FFE" />
                                                        </svg>
                                                    </span>
                                                    <span>
                                                        <?php echo date('M-d, Y', $bootcamp['start_date']); ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card-price">
                                                <?php if ($bootcamp['is_free']) : ?>
                                                    <h1 class="fw-500 text-success"><?php echo get_phrase('Free'); ?></h1>
                                                <?php elseif ($bootcamp['discount_flag']) : ?>
                                                    <h1 class="fw-500 text-secondary"><del><?php echo currency($bootcamp['price']); ?></del></h1>
                                                    <h1 class="fw-500"><?php echo currency($bootcamp['price'] - $bootcamp['discounted_price']); ?></h1>
                                                <?php else : ?>
                                                    <h1 class="fw-500"><?php echo currency($bootcamp['price']); ?></h1>
                                                <?php endif; ?>
                                            </div>

                                            <div class="card-btn">
                                                <a href="<?php echo site_url('addons/bootcamp/details/' . $bootcamp['id']); ?>"><?php echo get_phrase('view_details'); ?></a>


                                                <?php if ($is_purchased || $bootcamp['is_free'] == 1) : ?>
                                                    <a href="<?php echo site_url('addons/bootcamp/join_now/' . $bootcamp['id']) ?>"><?php echo get_phrase('join_now') ?></a>
                                                <?php else : ?>
                                                    <a href="<?php echo site_url('addons/bootcamp/purchase/' . $bootcamp['id']) ?>"><?php echo get_phrase('buy_now') ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="pagenation-items mb-0 mt-3">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="not-found w-100 text-center mt-5 pt-5 d-flex align-items-center flex-column h-100">
                            <img width="80px" src="<?php echo base_url('assets/global/image/not-found.svg'); ?>">
                            <h5><?php echo get_phrase('Bootcamp Not Found'); ?></h5>
                            <p><?php echo get_phrase('Sorry, try using more similar words in your search.') ?></p>
                        </div>
                    <?php endif; ?>
                </div>
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
  $(document).ready(function(){
    $('#commingSoon').modal('show');
  });
</script>
<style>
    .data-not-found {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;

    }

    .card-price {
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
    }

    .card-price h1 {
        font-size: 16px;
        line-height: 25px;
        font-weight: 500 !important;
        padding-right: 7px;
        transition: .5s;
        color: #1E293B;
    }
</style>