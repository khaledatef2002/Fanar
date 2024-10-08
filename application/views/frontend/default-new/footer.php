<!--------- footer Section Start--------------->
<section class="footer">
  <div class="container-fluid px-md-5">
    <div class="row">
      <div class="col-lg-3 col-sm-9 col-11 mb-lg-0 mx-auto mb-md-4 mb-5 d-flex flex-column align-items-md-start align-items-center">
        <img loading="lazy" src="<?php echo base_url('uploads/system/' . get_frontend_settings('light_logo')); ?>">
        <p class="mb-md-0 mb-3"><?php echo get_phrase('school-slogan'); ?></p>
        <div class="col-12 mt-3 lattest-news">
          <h1 class="fs-4"><?php echo get_phrase('Subscribe to our Newsletter'); ?></h1>
          <form class="ajaxForm resetable bg-white d-flex align-items-center rounded-3 px-2" action="<?php echo site_url('home/subscribe_to_our_newsletter'); ?>" method="post">
            <input type="email" class="form-control mb-0" id="subscribe_email" placeholder="<?php echo get_phrase('Enter your email address'); ?>" name="email">
            <button class="btn border-0 text-white rounded-3" type="submit"><?php echo get_phrase('subscribe'); ?></button>
          </form>
        </div>
      </div>
      <div class="col-lg-3 col-6 mb-lg-0 mb-4 d-flex flex-column align-items-center">
        <ul>
          <h1><?php echo site_phrase('useful_links'); ?></h1>
          <li><a class="nav-link" href="<?php echo site_url('school'); ?>"><?php echo get_phrase('school'); ?></a></li>
          <?php if (get_settings('allow_instructor') == 1) : ?>
            <li> <a href="<?php echo site_url('home/instructor'); ?>"><?php echo site_phrase('Become an instructor'); ?></a></li>
          <?php endif; ?>
          <li> <a href="<?php echo site_url('blog'); ?>"><?php echo site_phrase('blog'); ?></a></li> 
          <li> <a href="<?php echo site_url('home/faq'); ?>"><?php echo site_phrase('common-questions'); ?></a></li> 
          <li><a href="<?php echo site_url('home/courses'); ?>"><?php echo site_phrase('all_courses'); ?></a></li>
          <li><a href="<?php echo site_url('sign_up'); ?>"><?php echo site_phrase('sign_up'); ?></a></li>
          <?php $custom_page_menus = $this->crud_model->get_custom_pages('', 'footer'); ?>
          <?php foreach ($custom_page_menus->result_array() as $custom_page_menu) : ?>
            <li><a href="<?php echo site_url('page/' . $custom_page_menu['page_url']); ?>"><?php echo $custom_page_menu['button_title']; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-3 col-6 mb-lg-0 mb-4 d-flex flex-column align-items-center">
        <ul>
          <h1><?php echo site_phrase('help'); ?></h1>
          <li><a href="<?php echo site_url('home/contact_us'); ?>"><?php echo site_phrase('contact_us'); ?></a></li>
          <li><a href="<?php echo site_url('home/about_us'); ?>"><?php echo site_phrase('about_us'); ?></a></li>
          <li><a href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo site_phrase('privacy_policy'); ?></a></li>
          <li><a href="<?php echo site_url('home/terms_and_condition'); ?>"><?php echo site_phrase('terms_and_condition'); ?></a></li>
          <li><a href="<?php echo site_url('home/faq'); ?>"><?php echo site_phrase('FAQ'); ?></a></li>
          <li><a href="<?php echo site_url('home/refund_policy'); ?>"><?php echo site_phrase('refund_policy'); ?></a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-12 d-flex flex-lg-column flex-wrap-reverse justify-content-lg-between">
        <div class="col-lg-12 col-md-6 col-12 d-flex flex-column align-items-center">
          <p class="text-white fs-5 px-0 mb-3 text-center"><?php echo get_phrase('footer_our_social'); ?></p>
          <ul class="d-flex flex-wrap justify-content-center mb-4 gap-4 footer-social">
            <li>
              <a href="https://www.instagram.com/fanar.uae?igsh=MTVkOGp0dnVkZXdqdg%3D%3D&utm_source=qr"><i class="fa-brands fa-instagram fs-4"></i></a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/fanar-educational-platform-43b7b9305?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="fa-brands fa-linkedin fs-4"></i></a>
            </li>
            <li>
              <a href="https://www.tiktok.com/@fanar.uae?_t=8lnBhM7ENTk&_r=1"><i class="fa-brands fa-tiktok fs-4"></i></a>
            </li>
            <li>
              <a href="https://www.facebook.com/profile.php?id=61558707034225&mibextid=LQQJ4d"><i class="fa-brands fa-facebook-f fs-4"></i></a>
            </li>
            <li>
              <a href="https://snapchat.com/t/pADSKteR"><i class="fa-brands fa-snapchat fs-4"></i></a>
            </li>
            <li>
              <a href="https://youtube.com/@fanar.education?si=7Z4gLaWhb0jl9ugU"><i class="fa-brands fa-youtube fs-4"></i></a>
            </li>
          </ul>
        </div>
        <div class="col-lg-12 col-md-6 col-12 mb-md-0 mb-3 d-flex flex-column align-items-center">
          <p class="text-white fs-5 px-0 text-center mb-3"><?php echo get_phrase('footer_download_app'); ?></p>
          <div class="button-list mb-0 mt-2 d-flex align-items-center gap-3 justify-content-md-start justify-content-center">
            <a href="https://play.google.com/store/apps?hl=en&gl=US&pli=1"><img src="<?php echo base_url('assets/frontend/default-new/image/google-play.png') ?>" alt="" srcset="" height="30"></a>
            <a href="https://www.apple.com/jo/app-store/"><img src="<?php echo base_url('assets/frontend/default-new/image/app-store.png') ?>" alt="" srcset="" height="30"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <ul class="nav justify-content-center">
          <li class="nav-item m-0 mb-3">
            <a class="fs-5" target="_blank" href="<?php echo get_settings('footer_link'); ?>">
              <?php echo site_phrase(get_settings('footer_text')); ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!--------- footer Section End--------------->

<!-- PAYMENT MODAL -->
<!-- Modal -->
<?php
$paypal_info = json_decode(get_settings('paypal'), true);
$stripe_info = json_decode(get_settings('stripe_keys'), true);
if ($paypal_info[0]['active'] == 0) {
  $paypal_status = 'disabled';
} else {
  $paypal_status = '';
}
if ($stripe_info[0]['active'] == 0) {
  $stripe_status = 'disabled';
} else {
  $stripe_status = '';
}
?>