<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">

<?php

$CI    = &get_instance();
$CI->load->database();
$bootcamp_category = $CI->bootcamp_model->get_table('bootcamp_category')->result_array();

?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="javascript: void(0);" onclick="showAjaxModal('<?php echo site_url('addons/bootcamp/category/form'); ?>', '<?php echo get_phrase('add_bootcamp_category') ?>')" class="btn btn-outline-primary btn-rounded alignToTitle mr-1"><i class=" mdi mdi-plus"></i> <?php echo get_phrase('add_category'); ?></a>
                </h4>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('bootcamp_category'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('category_name'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bootcamp_category as $key => $category) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $category['category_name']; ?></td>
                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript: void(0);" onclick="showAjaxModal('<?php echo site_url('addons/bootcamp/category/edit/' . $category['id']); ?>', '<?php echo get_phrase('edit_bootcamp_category') ?>')" class="dropdown-item"> <?php echo get_phrase('edit_category'); ?></a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript: void(0);" onclick="confirm_modal('<?php echo site_url('addons/bootcamp/category/delete/' . $category['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
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