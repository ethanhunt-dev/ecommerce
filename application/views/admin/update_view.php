<?= form_open_multipart('admin/product_controller/update/'.$product->id); ?>

<label>Product Name</label><br>
<input type="text" name="name" value="<?= set_value('name', $product->name); ?>"><br><br>

<label>Price</label><br>
<input type="text" name="price" value="<?= set_value('price', $product->price); ?>"><br><br>

<label>Selling Price</label><br>
<input type="text" name="sp" value="<?= set_value('sp', $product->sp); ?>"><br><br>

<label>Description</label><br>
<textarea name="description"><?= set_value('description', $product->description); ?></textarea><br><br>

<!-- SHOW OLD IMAGE -->
<?php if (!empty($product->image)): ?>
    <p>Current Image:</p>
    <img src="<?= base_url($product->image); ?>" width="100"><br><br>
<?php endif; ?>

<!-- UPLOAD NEW IMAGE -->
<label>Change Image</label><br>
<input type="file" name="image"><br><br>
   &nbsp,&nbsp;

<button type="submit">Update</button>
<button type="button"
        onclick="window.location.href='<?= site_url('admin/product_controller'); ?>'">
    Back
</button>



<?= form_close(); ?>
