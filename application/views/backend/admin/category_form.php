<link rel="stylesheet" href="<?php echo base_url() . 'assets/backend/css/bootcamp.css' ?>">


<?php
$url = 'addons/bootcamp/category/add';
if (isset($category)) {
    $url = 'addons/bootcamp/category/update/' . $category['id'];
}
?>

<form action="<?php echo site_url($url); ?>" method="post">
    <div class="form-group">
        <label for="category_name"><?php echo get_phrase('Name'); ?></label>
        <input type="text" name="category_name" class="form-control" id="category_name" <?php if (isset($category)) : ?> value="<?php echo $category['category_name']; ?>" <?php else : ?> placeholder="Category name" <?php endif; ?> required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo get_phrase('Save'); ?></button>
    </div>
</form>