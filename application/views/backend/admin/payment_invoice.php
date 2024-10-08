<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">

<?php
$CI    = &get_instance();
$CI->load->database();

$buyer_details = $CI->bootcamp_model->get_table('users', $payment_info['user_id'])->row_array();
$bootcamp_owner = $CI->bootcamp_model->get_table('users', $payment_info['owner_id'])->row_array();
?>
<section class="invoice">
    <div class="container print-content">
        <div id="printdivcontent">
            <div class="invoice-heading mt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <h3 class="text-uppercase mb-4"><?php echo get_phrase('invoice') ?></h3>
                        <div class="invoice-no">
                            <h5 class="invoice-color mb-4"><?php echo get_phrase('Invoice ID') ?> : #<?php echo $payment_info['id']; ?></h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="invioce-logo d-flex justify-content-end">
                            <a href="#"><img src="<?php echo base_url('uploads/system/') . get_frontend_settings('dark_logo'); ?>" alt="" style="height: 55px; width: auto;"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice-bill mb-4">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-8">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <p><?php echo get_phrase('Billed To') ?>:</p>
                                <h5><?php echo $buyer_details['first_name'] . ' ' . $buyer_details['last_name']; ?></h5>
                                <h6><?php echo $buyer_details['email']; ?></h6>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <p><?php echo get_phrase('Date Of Issue') ?>:</p>
                                <h5><?php echo date('d-M-Y', $payment_info['request_date']) ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-4">
                        <div class="invoice-total text-end">
                            <p><?php echo get_phrase('Invoice Total') ?></p>
                            <h5><?php echo currency($payment_info['price']); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice-dec">
                <div class="invoice-bill--scroll-bar">
                    <table class="table">
                        <thead class="invoice-2-table-head">
                            <tr>
                                <th class="pe-5" scope="col">
                                    <h5><?php echo get_phrase('Bootcamp title'); ?></h5>
                                </th>
                                <th scope="col">
                                    <h5><?php echo get_phrase('Instructor'); ?></h5>
                                </th>
                                <th scope="col">
                                    <h5 class="text-end"><?php echo get_phrase('QTY') ?></h5>
                                </th>
                                <th scope="col">
                                    <h5 class="text-end"><?php echo get_phrase('Price') ?></h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <p><?php echo $payment_info['title']; ?></p>
                                </th>
                                <td>
                                    <p><?php echo $bootcamp_owner['first_name'] . ' ' . $bootcamp_owner['last_name']; ?></p>
                                </td>
                                <td>
                                    <p class="text-end">1</p>
                                </td>
                                <td>
                                    <p class="text-end"><?php echo currency($payment_info['price']) ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="invoice-2-payment">
                    <div class="row">
                        <div class="col-6">
                            <h5><?php echo get_phrase('Paid By'); ?>:</h5>
                            <h5><a href="#"><?php echo ucfirst($buyer_details['first_name']) . '  ' . ucfirst($buyer_details['last_name']); ?></a></h5>
                        </div>
                        <div class="col-6">
                            <div class="row justify-content-end">
                                <div class="col-lg-6 col-12">
                                    <div class="invoice-2-last-total">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                                <h5><?php echo get_phrase('Subtotal') ?></h5>
                                                <h5><?php echo get_phrase('Tax'); ?></h5>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                                <h5 class="text-end">:</h5>
                                                <h5 class="text-end">:</h5>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 pe-0">
                                                <h5><?php echo currency($payment_info['price']); ?></h5>
                                                <h5><?php echo currency(00); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="invoice-right-total">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                                <h5 class="invoice-ml text-end"><?php echo get_phrase('Grand Total') ?></h5>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                                <h5 class="text-end">:</h5>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 pe-0">
                                                <h5 class="text-end"><?php echo currency($payment_info['price']); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="print-btn print-d-none">
            <a class="watch-video px-3" href="<?php echo site_url('home/purchase_history') ?>"><?php echo get_phrase('Back'); ?></a>
            <a href="#" class="watch-video d-flex align-items-center gap-5 px-2" id="print-div">
                <span class="mdi mdi-printer"></span>
                <span>
                    <?php echo get_phrase('Print'); ?>
                </span>
            </a>
        </div>
    </div>
</section>


<style>
    .watch-video {
        padding: 8px 12px;
        color: #754FFE;
        font-size: 13px;
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
        color: #fff !important;
        display: inline-block !important;
    }

    .watch-video:hover {
        color: #fff;
        box-shadow: 0px 1px 10px #754FFE80;
    }
</style>

<script type="text/javascript">
    document.getElementById("print-div").addEventListener("click", function() {
        var printContents = document.getElementById('printdivcontent').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>