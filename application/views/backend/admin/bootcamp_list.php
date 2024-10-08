<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">


<?php
$CI    = &get_instance();
$CI->load->database();
?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('bootcamp_list'); ?>
                    <a href="<?php echo site_url('addons/bootcamp/action/form'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_bootcamp'); ?></a>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('bootcamp_list'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('bootcamp'); ?></th>
                                <th><?php echo get_phrase('category'); ?></th>
                                <th><?php echo get_phrase('module_and_class'); ?></th>
                                <th><?php echo get_phrase('price'); ?></th>
                                <th><?php echo get_phrase('enrolled'); ?></th>
                                <th><?php echo get_phrase('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($bootcamps->result_array() as $key => $bootcamp) :
                                $owner_details = $CI->bootcamp_model->get_table('users', $bootcamp['owner_id'])->row_array();
                                $category = $CI->bootcamp_model->get_table('bootcamp_category', $bootcamp['category'])->row_array();
                                $enrolment = $CI->bootcamp_model->bootcamp_enrollment($bootcamp['id'], 'bootcamp');
                            ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td>
                                        <strong><a href="<?php echo site_url('addons/bootcamp/action/edit/' . $bootcamp['id']) ?>"><?php echo ellipsis($bootcamp['title']); ?></a></strong><br>
                                        <small class="text-muted"><?php echo get_phrase('Owner') . ': <b>' . $owner_details['first_name'] . ' ' . $owner_details['last_name'] . '</b>'; ?></small>
                                    </td>
                                    <td><?php echo $category['category_name']; ?></td>
                                    <td>
                                        <?php
                                        $modules = $CI->bootcamp_model->get_table('bootcamp_modules', 'bootcamp_id-' . $bootcamp['id'])->num_rows();
                                        $classes = $CI->bootcamp_model->get_table('bootcamp_live_class', 'bootcamp_id-' . $bootcamp['id'])->num_rows();
                                        ?>
                                        <small class="text-muted"><?php echo '<b>' . get_phrase('module') . '</b>: ' . $modules; ?></small>
                                        <small class="text-muted"><?php echo '<b>' . get_phrase('class') . '</b>: ' . $classes; ?></small><br>

                                    </td>
                                    <td>
                                        <?php if ($bootcamp['is_free'] == 0) : ?>
                                            <?php if ($bootcamp['discount_flag'] == 1) : ?>
                                                <h5>
                                                    <span class="fw-500 text-secondary badge badge-dark-lighten">
                                                        <del><?php echo currency($bootcamp['price']); ?></del>
                                                    </span>
                                                    <span class="fw-500 text-secondary badge badge-dark-lighten">
                                                        <?php echo currency($bootcamp['price'] - $bootcamp['discounted_price']); ?>
                                                    </span>
                                                    </h6>
                                                <?php else : ?>
                                                    <span class="badge badge-dark-lighten"><?php echo currency($bootcamp['price']); ?></span>
                                                <?php endif; ?>
                                            <?php elseif ($bootcamp['is_free'] == 1) : ?>
                                                <span class="badge badge-success-lighten"><?php echo get_phrase('free'); ?></span>
                                            <?php endif; ?>
                                    </td>

                                    <td><?php echo $enrolment; ?></td>

                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo site_url('addons/bootcamp/action/edit/' . $bootcamp['id']) ?>" class="dropdown-item"> <?php echo get_phrase('edit_bootcamp'); ?></a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript: void(0);" onclick="confirm_modal('<?php echo site_url('addons/bootcamp/action/delete/' . $bootcamp['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>