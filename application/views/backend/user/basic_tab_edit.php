<div class="tab-pane" id="basic">
    <div class="row">
        <div class="col-12">
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="title"><?php echo get_phrase('bootcamp_title'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo $bootcamp_details['title']; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="short_description"><?php echo get_phrase('short_description'); ?></label>
                <div class="col-md-10">
                    <textarea name="short_description" id="short_description" class="form-control"><?php echo $bootcamp_details['short_description']; ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="description"><?php echo get_phrase('description'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <textarea name="description" id="summernote-basic" class="form-control"><?php echo $bootcamp_details['description']; ?></textarea>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="category"><?php echo get_phrase('category'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <select class="form-control select2" data-toggle="select2" name="category" id="category" required>
                        <option value="<?php echo $bootcamp_details['category']; ?>"><?php echo $bootcamp_details['category_title']; ?></option>
                        <?php foreach ($categories->result_array() as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted"><?php echo get_phrase('select_category'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label" for="category"><?php echo get_phrase('start_date'); ?><span class="required">*</span></label>
                <div class="col-md-10">
                    <input type="datetime-local" name="start_date" class="form-control" value="<?php echo date('Y-m-d H:i', $bootcamp_details['start_date']) ?>">
                </div>
            </div>
        </div>
    </div>
</div>