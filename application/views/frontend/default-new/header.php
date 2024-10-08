<!---------- Header Section start  ---------->
<?php $cart_items = $this->session->userdata('cart_items'); ?>
<?php $user_id = $this->session->userdata('user_id'); ?>
<?php $user_login = $this->session->userdata('user_login'); ?>
<?php $admin_login = $this->session->userdata('admin_login'); ?>
<?php if ($user_id > 0) {
  $user_details = $this->user_model->get_all_user($user_id)->row_array();
} ?>
<!---------- Header Section End  ---------->
<!-- Orange Nav -->
<nav class="search-nav py-3">
  <div class="d-flex justify-content-between container-fluid px-xl-5 px-lg-3">
    <div class="d-flex align-items-center social-links ms-xl-5 ms-lg-3">
      <ul class="d-flex gap-4 mb-0 list-style-none">
        <!-- Change Language -->
        <li class="me-3 bg-white rounded-3 px-3">
          <form action="#" method="POST" class="language-control select-box d-flex align-items-center">
            <i class="fa-solid fa-globe"></i>
            <select onchange="actionTo(`<?php echo site_url('home/switch_language/') ?>${$(this).val()}`)" class="border-0 nice-select w-auto px-0" style="background-color: transparent !important;">
              <?php
              $languages = $this->crud_model->get_all_languages();
              $selected_language = $this->session->userdata('language');
              foreach ($languages as $language) : ?>
                <?php if (trim($language) != "") : ?>
                  <option value="<?php echo strtolower($language); ?>" <?php if ($selected_language == $language) : ?>selected<?php endif; ?>><?php echo ucwords($language); ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </form>
        </li>
      </ul>
    </div>
    <div class="search d-flex gap-2">
      <li class="d-flex justify-content-center align-items-center ms-2">
        <!-- Cart List Area -->
        <div class="wisth_tgl_div">
          <div class="wisth_tgl_2div">
            <a class="menu_pro_cart_tgl text-dark fs-6 d-flex align-items-center gap-3 bg-white px-3 py-2 rounded-3">
              <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.750122 1.24991L2.83012 1.60991L3.79312 13.0829C3.87012 14.0199 4.65312 14.7389 5.59312 14.7359H16.5021C17.3991 14.7379 18.1601 14.0779 18.2871 13.1899L19.2361 6.63191C19.3421 5.89891 18.8331 5.21891 18.1011 5.11291C18.0371 5.10391 3.16412 5.09891 3.16412 5.09891" stroke="#1A162E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.1251 8.7948H14.8981" stroke="#1A162E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M5.15447 18.2025C5.45547 18.2025 5.69847 18.4465 5.69847 18.7465C5.69847 19.0475 5.45547 19.2915 5.15447 19.2915C4.85347 19.2915 4.61047 19.0475 4.61047 18.7465C4.61047 18.4465 4.85347 18.2025 5.15447 18.2025Z" fill="#1A162E" stroke="#1A162E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.4347 18.2025C16.7357 18.2025 16.9797 18.4465 16.9797 18.7465C16.9797 19.0475 16.7357 19.2915 16.4347 19.2915C16.1337 19.2915 15.8907 19.0475 15.8907 18.7465C15.8907 18.4465 16.1337 18.2025 16.4347 18.2025Z" fill="#1A162E" stroke="#1A162E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <p class="menu_number text-dark d-flex justify-content-center align-items-center" id="cartItemsCounter"><?php echo count($cart_items); ?></p>
            </a>
            <div class="menu_pro_wish">
              <div class="overflow-control" id="cartItems">
  
                <?php include "cart_items.php"; ?>
  
              </div>
              <div class="menu_pro_btn">
                <a href="<?php echo site_url('home/shopping_cart'); ?>" type="submit" class="btn fw-bold" style="background: #ffac51;">
                  <?php echo get_phrase('Checkout'); ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <select name="school_opener" id="" class="form-select collapse navbar-collapse show" style="font-size: 13px;">
        <option value="">المواد الدراسية</option>
        <?php
          $categories = $this->crud_model->get_categories()->result_array();
          foreach ($categories as $key => $category) : 
        ?>
          <option value="<?php echo $category['id']; ?>" <?php echo (isset($_GET['class']) && $_GET['class'] == $category['id']) ? 'selected' : ''; ?>><?php echo preg_match('/^{{.*}}$/', $category['name'], $string) ? get_phrase(trim(substr($category['name'], 2, -2))) : $category['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <div class="input-holder bg-white px-2 py-1 rounded-3 collapse navbar-collapse show">
        <div class="d-flex align-items-center h-100">
          <i class="fa-solid fa-magnifying-glass"></i>
          <form action="<?php echo site_url('home/courses'); ?>" method="get" class="flex-fill px-2">
            <input name="query" type="search" class="border-0 w-100 <?php echo isset($_GET['query']) ? 'focused':''; ?>" placeholder="<?php echo get_phrase('Search'); ?>" value="<?php echo isset($_GET['query']) ? $_GET['query']:''; ?>">
          </form>
        </div>
      </div>
      <li class="d-flex align-items-center ms-2 bg-white px-2 rounded-3">
        <i id="change-theme" class="fa-regular <?php echo $this->session->userdata('theme_mode') == 'dark-theme' ? 'fa-sun' : 'fa-moon'; ?> fs-4" role="button"></i>
      </li>
    </div>
  </div>
</nav>

<nav class="navbar main-nav navbar-expand-lg navbar-light px-xl-5 px-0 py-3">
  <div class="container-fluid px-xl-5 px-lg-3">
    <a href="<?php echo site_url(); ?>">
      <img src="<?php echo site_url('uploads/system/' . get_frontend_settings('dark_logo')) ?>" alt="" srcset="" height="40px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#mobile-menu" role="button">
      <i class="fa-solid fa-bars text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-xl-5 ms-lg-3 d-flex gap-4">
        <li class="text-center">
          <a class="nav-link" href="<?php echo site_url('school'); ?>"><?php echo get_phrase('school'); ?></a>
        </li>
        <li class="text-center">
          <a class="nav-link" href="<?php echo site_url('course_bundles'); ?>"><?php echo get_phrase('study-packages'); ?></a>
        </li>
        <li class="text-center">
          <a class="nav-link" href="<?php echo site_url('tutors'); ?>"><?php echo get_phrase('book-lesson'); ?></a>
        </li>
        <!-- <li class="text-center d-flex justiy-content-center align-items-center">
          <a class="nav-link mx-auto" href="<?php echo site_url('home/contact_us'); ?>"><?php echo get_phrase('contact-us'); ?></a>
        </li> -->
      </ul>
      <ul class="navbar-nav ms-auto d-flex gap-2">
        <div class="auth-buttons d-flex">
          <ul class="d-flex gap-2 mb-0 list-style-none">
            <?php if ($user_login) : ?>
              <?php if($user_details['is_instructor'] == 1): ?>
                <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2"><a href="<?php echo site_url('user/dashboard'); ?>"><?php echo site_phrase('Instructor Dashboard'); ?></a></li>
              <?php else: ?>
                <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2"><a class="dropdown-item text-center" href="<?php echo site_url('home/my_courses') ?>"><?php echo site_phrase('My Course') ?></a></li>
              <?php endif; ?>
            <?php elseif ($admin_login) : ?>
              <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2"><a class="dropdown-item text-center" href="<?php echo site_url('admin'); ?>"><?php echo get_phrase('Administration') ?></a></li>
            <?php endif; ?>
            <!-- Login/Register links -->
            <?php if (!$user_id) : ?>
              <a id="login-button" href="<?php echo site_url('login'); ?>"><button class="btn px-3"><?php echo get_phrase('Login'); ?></button></a>
              <a id="register-button" href="<?php echo site_url('sign_up'); ?>"><button class="btn px-4 rounded-5"><?php echo get_phrase('Join Now'); ?></button></a>
            <?php endif; ?>

            <?php if ($user_login && $user_details['is_instructor'] == 0) : ?>
              <li class="nav-item d-flex justify-content-center align-items-center">
                <!-- Wish List Area -->
                <div class="wisth_tgl_div">
                  <div class="wisth_tgl_2div">
                    <a class="menu_wisth_tgl mt-1 text-dark fs-6 mx-1 position-relative rounded-3 px-2">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.87187 11.5983C1.79887 8.24832 3.05287 4.41932 6.56987 3.28632C8.41987 2.68932 10.4619 3.04132 11.9999 4.19832C13.4549 3.07332 15.5719 2.69332 17.4199 3.28632C20.9369 4.41932 22.1989 8.24832 21.1269 11.5983C19.4569 16.9083 11.9999 20.9983 11.9999 20.9983C11.9999 20.9983 4.59787 16.9703 2.87187 11.5983Z" stroke="#1A162E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 6.70001C17.07 7.04601 17.826 8.00101 17.917 9.12201" stroke="#1A162E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                      <?php if (count($my_wishlist_items) > 0) : ?>
                        <p class="menu_number position-absolute" id="wishlistItemsCounter" style="top: -8px;left: -6px;font-size: 0.7rem;">
                          <?php echo count($my_wishlist_items); ?>
                        </p>
                      <?php endif; ?>
                    </a>
                    <div class="menu_pro_wish">
                      <div class="overflow-control" id="wishlistItems">
                        <?php include "wishlist_items.php"; ?>
                      </div>
                      <div class="menu_pro_btn">
                        <a href="<?php echo site_url('home/my_wishlist'); ?>" class="btn btn-primary text-white fw-bold" style="background: #ffac51;"><?php echo get_phrase('Go to wishlist'); ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="nav-item d-flex justify-content-center align-items-center">
                <!-- Notification Area -->
                <div class="wisth_tgl_div">
                  <div class="wisth_tgl_2div" id="headerNotification">
                    <?php include "notifications.php"; ?>
                  </div>
                </div>
              </li>
            <?php endif; ?>

            <?php if ($user_login || $admin_login) : ?>
              <!-- Profile Area -->
              <div class="menu_pro_tgl_div d-flex justify-content-center mx-md-2 mx-0 my-md-0 my-2">
                <div class="menu_pro_tgl-2div d-flex align-items-center m-0">
                  <div class="icon rounded-2">
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5C12 6.06087 11.5786 7.07828 10.8284 7.82843C10.0783 8.57857 9.06087 9 8 9C6.93913 9 5.92172 8.57857 5.17157 7.82843C4.42143 7.07828 4 6.06087 4 5C4 3.93913 4.42143 2.92172 5.17157 2.17157C5.92172 1.42143 6.93913 1 8 1C9.06087 1 10.0783 1.42143 10.8284 2.17157C11.5786 2.92172 12 3.93913 12 5ZM8 12C6.14348 12 4.36301 12.7375 3.05025 14.0503C1.7375 15.363 1 17.1435 1 19H15C15 17.1435 14.2625 15.363 12.9497 14.0503C11.637 12.7375 9.85652 12 8 12Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  </div>
                </div>
                <div class="menu_pro_tgl_bg">
                  <div class="path-pos d-flex flex-column">
                    <a href="#"><img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($user_id); ?>" alt="User Image" /></a>
                    <a href="#">
                      <h4><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></h4>
                    </a>
                    <p><?php echo $user_details['email']; ?></p>
                    <ul>
                      <?php if ($user_login) : ?>

                        <?php if ($user_details['is_instructor'] == 1) : ?>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('user/dashboard'); ?>"><i class="fas fa-columns"></i><?php echo site_phrase('Instructor Dashboard'); ?></a></li>
                        <?php endif; ?>

                        <?php if($user_details['is_instructor'] == 0): ?>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_courses'); ?>"><i class="far fa-gem"></i><?php echo site_phrase('my_courses'); ?></a></li>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_wishlist'); ?>"><i class="far fa-heart"></i><?php echo site_phrase('my_wishlist'); ?></a></li>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_messages'); ?>"><i class="far fa-envelope"></i><?php echo site_phrase('my_messages'); ?></a></li>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/purchase_history'); ?>"><i class="fas fa-shopping-cart"></i><?php echo site_phrase('purchase_history'); ?></a></li>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/profile/user_profile'); ?>"><i class="fas fa-user"></i><?php echo site_phrase('user_profile'); ?></a></li>
                        <?php endif; ?>
                        <?php if (addon_status('affiliate_course')) :
                          $CI    = &get_instance();
                          $CI->load->model('addons/affiliate_course_model');
                          $x = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
                          $is_affiliator = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));

                          if ($x == 0 && get_settings('affiliate_addon_active_status') == 1) : ?>


                            <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/affiliate_course/become_an_affiliator'); ?>"><i class="fas fa-user-plus"></i><?php echo site_phrase('Become_an_Affiliator'); ?></a></li>
                          <?php else : ?>
                            <?php if ($is_affiliator == 1) : ?>


                              <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/affiliate_course/affiliate_course_history '); ?>"><i class="fa fa-book"></i><?php echo site_phrase('Affiliation History'); ?></a></li>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if (addon_status('customer_support')) : ?>
                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/customer_support/user_tickets'); ?>"><i class="fas fa-life-ring"></i><?php echo site_phrase('support'); ?></a></li>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php if ($admin_login) : ?>
                        <li>
                          <a href="<?php echo site_url('admin'); ?>">
                            <i class="fas fa-location-arrow"></i>
                            <?php echo get_phrase('Administration'); ?>
                          </a>
                        </li>
                        <li>
                          <a href="<?php echo site_url('admin/manage_profile'); ?>">
                            <i class="fas fa-user"></i>
                            <?php echo get_phrase('Manage profile') ?>
                          </a>
                        </li>
                        <li>
                          <a href="<?php echo site_url('admin/system_settings'); ?>">
                            <i class="fas fa-cog"></i>
                            <?php echo get_phrase('Settings') ?>
                          </a>
                        </li>
                      <?php endif; ?>

                      <li>
                        <a href="<?php echo site_url('login/logout'); ?>">
                          <i class="fa-solid fa-arrow-right-from-bracket"></i>
                          <?php echo get_phrase('Log out'); ?>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </ul>
        </div>
      </ul>
    </div>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobile-menu" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <a href="<?php echo site_url(); ?>">
      <img src="<?php echo site_url('uploads/system/' . get_frontend_settings('dark_logo')) ?>" alt="" srcset="" height="40px">
    </a>
    <i class="fa-regular fa-circle-xmark text-white fs-3" data-bs-dismiss="offcanvas" aria-label="Close"></i>
  </div>
  <div class="offcanvas-body d-flex flex-column align-items-center">
    <ul class="d-flex w-100 justify-content-evenly mb-3 list-style-none social-media">
      <li class="d-flex align-items-center" role="button"><a class="text-dark fs-6" href="https://www.instagram.com/fanar.uae?igsh=MTVkOGp0dnVkZXdqdg%3D%3D&utm_source=qr"><i class="fa-brands fa-instagram"></i></a></li>
      <li class="d-flex align-items-center" role="button"><a class="text-dark fs-6" href="https://www.linkedin.com/in/fanar-educational-platform-43b7b9305?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="fa-brands fa-linkedin-in"></i></a></li>
      <li class="d-flex align-items-center" role="button"><a class="text-dark fs-6" href="https://www.tiktok.com/@fanar.uae?_t=8lnBhM7ENTk&_r=1"><i class="fa-brands fa-tiktok"></i></a></li>
      <li class="d-flex align-items-center" role="button"><a class="text-dark fs-6" href="https://www.facebook.com/profile.php?id=61558707034225&mibextid=LQQJ4d"><i class="fa-brands fa-facebook-f"></i></a></li>
      <li class="d-flex align-items-center" role="button"><a class="text-dark fs-6" href="https://snapchat.com/t/pADSKteR"><i class="fa-brands fa-snapchat"></i></a></li>
      <li class="d-flex align-items-center" role="button"><a class="text-dark fs-6" href="https://youtube.com/@fanar.education?si=7Z4gLaWhb0jl9ugU"><i class="fa-brands fa-youtube"></i></a></li>
    </ul>
    <div class="search mt-0">
      <div class="d-flex flex-column align-items-center input-holder bg-white px-1">
        <select name="school_opener" id="" class="form-select">
          <option value="">المواد الدراسية</option>
          <?php
            $categories = $this->crud_model->get_categories()->result_array();
            foreach ($categories as $key => $category) : 
          ?>
            <option  value="<?php echo $category['id']; ?>" <?php echo (isset($_GET['class']) && $_GET['class'] == $category['id']) ? 'selected' : ''; ?>><?php echo preg_match('/^{{.*}}$/', $category['name'], $string) ? get_phrase(trim(substr($category['name'], 2, -2))) : $category['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <div class="search-line py-1 d-flex align-items-center">
          <form action="<?php echo site_url('home/courses'); ?>" method="get" class="flex-fill px-2">
            <input name="query" type="search" class="border-0 w-100 <?php echo isset($_GET['query']) ? 'focused':''; ?>" placeholder="<?php echo get_phrase('Search'); ?>" value="<?php echo isset($_GET['query']) ? $_GET['query']:''; ?>">
          </form>
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
    </div>
    <ul class="navbar-nav d-flex gap-2 mt-2">
      <li class="text-center">
        <a class="nav-link" href="<?php echo site_url('school'); ?>"><?php echo get_phrase('school'); ?></a>
      </li>
      <li class="text-center">
        <a class="nav-link" href="<?php echo site_url('course_bundles'); ?>"><?php echo get_phrase('study-packages'); ?></a>
      </li>
      <li class="text-center">
        <a class="nav-link" href="<?php echo site_url('tutors'); ?>"><?php echo get_phrase('book-lesson'); ?></a>
      </li>
      <!-- <li class="text-center d-flex justiy-content-center align-items-center">
        <a class="nav-link mx-auto" href="<?php echo site_url('home/contact_us'); ?>"><?php echo get_phrase('contact-us'); ?></a>
      </li> -->
      <?php if ($user_login) : ?>
        <?php if($user_details['is_instructor'] == 1): ?>
          <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2"><a href="<?php echo site_url('user/dashboard'); ?>" class="text-dark fs-6"><?php echo site_phrase('Instructor Dashboard'); ?></a></li>
        <?php else: ?>
          <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2"><a class="dropdown-item text-center" href="<?php echo site_url('home/my_courses') ?>"><?php echo site_phrase('My Course') ?></a></li>
        <?php endif; ?>
      <?php elseif ($admin_login) : ?>
        <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2"><a class="dropdown-item text-center" href="<?php echo site_url('admin'); ?>"><?php echo get_phrase('Administration') ?></a></li>
      <?php endif; ?>
    </ul>
    <div class="auth-buttons d-flex">
      <ul class="d-flex gap-3 mb-0 list-style-none">
        <!-- Login/Register links -->
        <?php if (!$user_id) : ?>
          <a href="<?php echo site_url('sign_up'); ?>"><button class="btn bg-white px-3"><i class="fa-solid fa-right-to-bracket me-2"></i><?php echo get_phrase('Join Now'); ?></button></a>
          <a href="<?php echo site_url('login'); ?>"><button class="btn border text-white px-3"><i class="fa-solid fa-user me-2"></i><?php echo get_phrase('Login'); ?></button></a>
        <?php endif; ?>

        <?php if ($user_login && $user_details['is_instructor'] == 0) : ?>
          <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2">
            <!-- Wish List Area -->
            <div class="wisth_tgl_div">
              <div class="wisth_tgl_2div">
                <a class="menu_wisth_tgl mt-1 text-dark fs-6 mx-1 position-relative">
                  <i class="fa-regular fa-heart"></i>

                  <?php if (count($my_wishlist_items) > 0) : ?>
                    <p class="menu_number position-absolute" id="wishlistItemsCounter" style="top: -8px;left: -6px;font-size: 0.7rem;">
                      <?php echo count($my_wishlist_items); ?>
                    </p>
                  <?php endif; ?>
                </a>
                <div class="menu_pro_wish">
                  <div class="overflow-control" id="wishlistItems">
                    <?php include "wishlist_items.php"; ?>
                  </div>
                  <div class="menu_pro_btn">
                    <a href="<?php echo site_url('home/my_wishlist'); ?>" class="btn btn-primary text-dark fw-bold" style="background: #ffac51;"><?php echo get_phrase('Go to wishlist'); ?></a>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item d-flex justify-content-center align-items-center mx-md-2 mx-0 my-md-0 my-2">
            <!-- Notification Area -->
            <div class="wisth_tgl_div">
              <div class="wisth_tgl_2div" id="headerNotification">
                <?php include "notifications.php"; ?>
              </div>
            </div>
          </li>
        <?php endif; ?>

        <?php if ($user_login || $admin_login) : ?>
          <!-- Profile Area -->
          <div class="menu_pro_tgl_div d-flex justify-content-center mx-md-2 mx-0 my-md-0 my-2">
            <div class="menu_pro_tgl-2div d-flex align-items-center m-0">
              <a class="menu_pro_tgl profile-dropdown"><img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($user_id); ?>" alt="User Image" /></a>
            </div>
            <div class="menu_pro_tgl_bg">
              <div class="path-pos d-flex flex-column">
                <a href="#"><img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($user_id); ?>" alt="User Image" /></a>
                <a href="#">
                  <h4><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></h4>
                </a>
                <p><?php echo $user_details['email']; ?></p>
                <ul>
                  <?php if ($user_login) : ?>

                    <?php if ($user_details['is_instructor'] == 1) : ?>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('user/dashboard'); ?>"><i class="fas fa-columns"></i><?php echo site_phrase('Instructor Dashboard'); ?></a></li>
                    <?php endif; ?>

                    <?php if($user_details['is_instructor'] == 0): ?>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_courses'); ?>"><i class="far fa-gem"></i><?php echo site_phrase('my_courses'); ?></a></li>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_wishlist'); ?>"><i class="far fa-heart"></i><?php echo site_phrase('my_wishlist'); ?></a></li>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_messages'); ?>"><i class="far fa-envelope"></i><?php echo site_phrase('my_messages'); ?></a></li>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/purchase_history'); ?>"><i class="fas fa-shopping-cart"></i><?php echo site_phrase('purchase_history'); ?></a></li>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/profile/user_profile'); ?>"><i class="fas fa-user"></i><?php echo site_phrase('user_profile'); ?></a></li>
                    <?php endif; ?>
                    <?php if (addon_status('affiliate_course')) :
                      $CI    = &get_instance();
                      $CI->load->model('addons/affiliate_course_model');
                      $x = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
                      $is_affiliator = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));

                      if ($x == 0 && get_settings('affiliate_addon_active_status') == 1) : ?>


                        <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/affiliate_course/become_an_affiliator'); ?>"><i class="fas fa-user-plus"></i><?php echo site_phrase('Become_an_Affiliator'); ?></a></li>
                      <?php else : ?>
                        <?php if ($is_affiliator == 1) : ?>


                          <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/affiliate_course/affiliate_course_history '); ?>"><i class="fa fa-book"></i><?php echo site_phrase('Affiliation History'); ?></a></li>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php if (addon_status('customer_support')) : ?>
                      <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/customer_support/user_tickets'); ?>"><i class="fas fa-life-ring"></i><?php echo site_phrase('support'); ?></a></li>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if ($admin_login) : ?>
                    <li>
                      <a href="<?php echo site_url('admin'); ?>">
                        <i class="fas fa-location-arrow"></i>
                        <?php echo get_phrase('Administration'); ?>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('admin/manage_profile'); ?>">
                        <i class="fas fa-user"></i>
                        <?php echo get_phrase('Manage profile') ?>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('admin/system_settings'); ?>">
                        <i class="fas fa-cog"></i>
                        <?php echo get_phrase('Settings') ?>
                      </a>
                    </li>
                  <?php endif; ?>

                  <li>
                    <a href="<?php echo site_url('login/logout'); ?>">
                      <i class="fa-solid fa-arrow-right-from-bracket"></i>
                      <?php echo get_phrase('Log out'); ?>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>