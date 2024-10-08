<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">

<?php
$CI    = &get_instance();
$CI->load->database();
?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                </h4>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('payment_report'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('user_name'); ?></th>
                                <th><?php echo get_phrase('paid_amount'); ?></th>
                                <th><?php echo get_phrase('payment_method'); ?></th>
                                <th><?php echo get_phrase('date'); ?></th>
                                <th><?php echo get_phrase('print'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payment_reports as $key => $report) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $report['first_name'] . ' ' . $report['last_name']; ?></td>
                                    <td>
                                        <span class="badge badge-dark-lighten"><?php echo currency($report['price']); ?></span>
                                    </td>
                                    <td><?php echo ucfirst($report['payment_method']); ?></td>
                                    <td><?php echo date('d-M, Y', $report['request_date']); ?></td>
                                    <td>
                                        <a href="<?php echo site_url('addons/bootcamp/payment_report/' . $report['id']) ?>" class="watch-video">
                                            <?php echo get_phrase('invoice'); ?>
                                        </a>
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


<style>
    .watch-video {
        display: inline-block;
        padding: 8px 12px;
        color: #fff;
        font-size: 13px;
        border: 1px solid #754FFE !important;
        font-weight: 500;
        background: #754FFE;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        transition: .3s;
        -webkit-transition: .3s;
        -moz-transition: .3s;
        -ms-transition: .3s;
        -o-transition: .3s;
    }

    .watch-video:hover {
        color: white;
        box-shadow: 0px 1px 10px #754FFE80;
    }
</style>