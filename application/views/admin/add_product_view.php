<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add|page</title>
</head>
<body> 
    <?php if ($this->session->flashdata('msg')) { ?>

    <p style="color:<?= ($this->session->flashdata('type') == 'success') ? 'green' : 'red'; ?>">
        <?= $this->session->flashdata('msg'); ?>
    </p>

<?php } ?>


   

    <h2>ADD PRODUCT</H2>
    <?php echo validation_errors('<p style="color:red;">','</p>'); ?>
    <?php echo
     form_open_multipart('admin/product_controller/add_product'); ?>
    <p>
    <label for ='name'>product name</label><br>
    <input type ="text" name ="name" id ="name" value ="<?= set_value('name'); ?>"  required >
    </p>
     <p>
    <label for ='price'>product price</label><br>
    <input type ="text" name ="price" id ="price" value ="<?= set_value('price'); ?>" required>
    </p>
    <p>
    <label for ='sp'>selling price</label><br>
    <input type ="text" name ="sp" id ="sp" value ="<?= set_value('sp'); ?>" required>
    </p>
    <p>
    <p>
        <p>
    <label for ='image'>image</label><br>
    <input type ="file" name ="image" id ="image" value ="<?= set_value('image'); ?>" required>
    </p>
  <p>
    <label for="description">Description</label><br>
    <textarea name="description"
              id="description"
              rows="5"
              cols="50"
              required><?= set_value('description'); ?></textarea>
</p>

    
    
    
    <input type="submit" value="Submit">

    &nbsp;&nbsp;

   
    <button
        type="button"
        onclick="window.location.href='<?= site_url('admin/product_controller'); ?>'"
    >
        Back
    </button>
    &nbsp;&nbsp;
      <button type="reset">Reset</button>

</p>
<?php echo form_close(); ?>


</body>
</html>