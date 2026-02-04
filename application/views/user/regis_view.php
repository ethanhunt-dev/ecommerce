<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>regi|page</title>
</head>
<body><header> <h2>registration</h2></header>
    <!-- post --><main>
        <?php if($this->session->flashdata('success')): ?>
            <p style ="color:green:">
                <?= $msg  ?>>
        </p>  
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <p style="color:red;"><?=  $err ?>></p>
            <?php endif; ?>
    <?php echo form_open("Registration/regis"); ?>
<p>
    <label for ="name">user_name</label>
    <input type ="text"  name="name" value="<?php echo set_value('name');  ?>" required >
</p>
    
    <p>
        <label for ="email">email</label>
    <input type ="email" name="email" value ="<?php echo set_value('email'); ?>" required>
    <br>
        <span style="color:red;"><?php echo form_error('email'); ?></span>
    </p>
    

    <p>
        <label for ="password">password</label>
    <input type ="password" name="password"  required>
     <small>Password must be exactly 4 characters</small><br>
    <span style="color:red;"><?php echo form_error('password'); ?></span>
    </p> 
    <p>
    &nbsp;&nbsp;
    <button type ="submit">submit</button>
    <button type ="reset">reset</button>
</p>
    <?php echo form_close(); ?>
</main> 
    



    
</body>
</html>