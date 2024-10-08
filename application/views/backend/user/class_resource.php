<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">


<form action="<?php echo site_url('addons/bootcamp/resource/add/' . $class_id); ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="class_id" class="form-control" id="attach_link" value="<?php echo $class_id; ?>" hidden>


    <div class="d-flex align-items-center resource_type_selector mb-2">
        <div class="form-check">
            <input type="radio" class="form-check-input d-inline-flex" id="upload_file" name="resource_type" checked>
            <label class="form-check-label" for="upload_file">Upload file</label>
        </div>

        <div class="form-check">
            <input type="radio" class="form-check-input d-inline-flex" id="class_record" name="resource_type">
            <label for="class_record" class="form-check-label">Class record</label>
        </div>
    </div>

    <div class="form-group select_file">
        <div class="">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="resource" name="resource" onchange="changeTitleOfImageUploader(this)">
                    <label class="custom-file-label" for="resource"><?php echo get_phrase('choose_a_file'); ?></label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo get_phrase('add'); ?></button>
    </div>
</form>


<?php if (count($resource_details) > 0) : ?>
<div class="row resource">
    <div class="col-12">
        <h5>Resources</span></h5>
    </div>
    <?php foreach ($resource_details as $key => $resource) : ?>
    <div class="col-md-12">
        <div class="card text-secondary on-hover-action mb-2 w-100">
            <div class="card-body thinner-card-body d-flex justify-content-between align-items-center">
                <h6 class="m-0"><?php echo ++$key; ?>: <?php echo $resource['resource']; ?></h6>
                <div class="resource_actions d-flex align-items-center gap-2">
                    <a href="<?php echo site_url('addons/bootcamp/download/' . $resource['type'] . '/' . $resource['id']); ?>" data-toggle="tooltip" data-placement="top"
                        title="<?php echo get_phrase('Download'); ?>"><span class="mdi mdi-download text-dark"></span></a>
                    <a href="javascript: void(0);" onclick="confirm_modal('<?php echo site_url('addons/bootcamp/resource/delete/' . $resource['id']); ?>');" data-toggle="tooltip"
                        title="<?php echo get_phrase('delete'); ?>"><i class="mdi mdi-window-close text-dark"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<style>
.resource .thinner-card-body {
    padding: .65rem;
    border: 1px solid #00000010;
    border-radius: 5px;
}

.resource_type_selector .form-check:nth-child(1) {
    margin-right: 30px;
}

</style>

<script>
$(document).ready(function() {
    $('#class_record').click(function(e) {
        $('.select_file input').val('');
        $('.custom-file-label').text('Choose a file');
        $('.select_file input').attr('name', 'class_record');
        $('.select_file input').attr('accept', 'video/*');
    });

    $('#upload_file').click(function(e) {
        $('.select_file input').val('');
        $('.custom-file-label').text('Choose a file');
        $('.select_file input').attr('name', 'resource');
        $('.select_file input').attr('accept', '.all');
    });
});
</script>
