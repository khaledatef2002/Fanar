<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">

<ul class="nav nav-pills nav-justified form-wizard-header mb-3">
    <?php if (isset($bootcamp_details)) : ?>
        <li class="nav-item">
            <a href="#curriculum" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                <i class="mdi mdi-account-circle"></i>
                <span class=""><?php echo get_phrase('curriculum'); ?></span>
            </a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a href="#basic" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
            <i class="mdi mdi-fountain-pen-tip"></i>
            <span class="d-none d-sm-inline"><?php echo get_phrase('basic'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
            <i class="mdi mdi-information-outline"></i>
            <span class="d-none d-sm-inline"><?php echo get_phrase('info'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#pricing" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
            <i class="mdi mdi-currency-cny"></i>
            <span class="d-none d-sm-inline"><?php echo get_phrase('pricing'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#media" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
            <i class="mdi mdi-library-video"></i>
            <span class="d-none d-sm-inline"><?php echo get_phrase('Media'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#seo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
            <i class="mdi mdi-tag-multiple"></i>
            <span class="d-none d-sm-inline"><?php echo get_phrase('seo'); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
            <span class="d-none d-sm-inline"><?php echo get_phrase('finish'); ?></span>
        </a>
    </li>
</ul>