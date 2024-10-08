<ul class="navbar-nav main-nav-wrap mb-lg-0 align-items-center d-block">
    <li class="nav-item">
    <a class="nav-link text-nowrap text-center" href="<?php echo site_url('/home/courses'); ?>" id="navbarDropdown1">
        <span><?php echo get_phrase("Header-courses"); ?></span>
    </a>
    <ul class="navbarHover">
        <?php
        $categories = $this->crud_model->get_categories()->result_array();
        foreach ($categories as $key => $category) : ?>
        <li class="dropdown-submenu">
            <a href="<?php echo site_url('home/courses?category=' . slugify($category['slug'])) ?>">
            <span class="icons"><i class="<?php echo $category['font_awesome_class']; ?>"></i></span>
            <span class="text-cat"><?php echo preg_match('/^{{.*}}$/', $category['name'], $string) ? get_phrase(trim(substr($category['name'], 2, -2))) : $category['name']; ?></span>
            <span class="has-sub-category ms-auto"><i class="fa-solid fa-angle-right"></i></span>
            </a>
            <ul class="sub-category-menu">
            <?php
            $sub_categories = $this->crud_model->get_sub_categories($category['id']);
            foreach ($sub_categories as $sub_category) : ?>
                <li class="py-1"><a href="<?php echo site_url('home/courses?category=' . slugify($sub_category['slug'])) ?>"><?php echo preg_match('/^{{.*}}$/', $sub_category['name'], $string) ? get_phrase(trim(substr($sub_category['name'], 2, -2))) : $sub_category['name']; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
        <li>
        <a href="<?php echo site_url('home/courses'); ?>">
            <i class="fas fa-list-ul px-2"></i>
            <?php echo get_phrase('All Courses'); ?>
        </a>
        </li>
    </ul>
    </li>
</ul>

<!-- Bundles -->
<?php if (count($bundles) > 0): ?>
  <div class="accordion-item">
    <h2 class="accordion-header my-0" id="headingTwo">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <?php echo get_phrase('bundles'); ?>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
            <?php
        foreach ($bundles as $key => $bundle) :
        ?>
            <div class="item-container col-lg-3 col-6 px-2 mb-2">
                <a class="d-block" href="<?php echo site_url('bundle_details/' . rawurlencode(slugify($bundle->title)) . '/' . $bundle->id); ?>">
                    <div class="subcat-item rounded-2 p-3" role="button">
                        <?php echo $bundle->title; ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>