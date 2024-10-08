<div class="tab-pane" id="basic">
    <div class="row">
        <div class="col-12">
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="title"><?php echo get_phrase('bootcamp_title'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="short_description"><?php echo get_phrase('short_description'); ?></label>
                <div class="col-md-10">
                    <textarea name="short_description" id="short_description" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="description"><?php echo get_phrase('description'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <textarea name="description" id="summernote-basic" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="category"><?php echo get_phrase('category'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <select class="form-control select2" data-toggle="select2" name="category" id="category" required>
                        <option value=""><?php echo get_phrase('select_a_category'); ?></option>
                        <?php foreach ($categories->result_array() as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted"><?php echo get_phrase('select_category'); ?></small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2"><?php echo get_phrase('start_date'); ?></label>
                <div class="col-md-10">
                    <input type="date" name="start_date" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>