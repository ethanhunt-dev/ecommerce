<!DOCTYPE html>
<html>
<head>
    <title>User Register</title>
</head>
<body>

<h2>User Registration</h2>

<!-- Show error message -->
<?php if ($this->session->flashdata('error')): ?>
    <p style="color:red;">
        <?= $this->session->flashdata('error'); ?>
    </p>
<?php endif; ?>

<!-- Show success message -->
<?php if ($this->session->flashdata('success')): ?>
    <p style="color:green;">
        <?= $this->session->flashdata('success'); ?>
    </p>
<?php endif; ?>

<!-- Show validation errors -->
<?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

<form method="post" action="<?= site_url('users/auth/do_register'); ?>">
    
    <label>Username:</label><br>
    <input type="text" name="name" value="<?= set_value('uname'); ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= set_value('email'); ?>"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Register</button>
</form>


<p>
    Already have an account? 
    <a href="<?= site_url('users/auth/login'); ?>">Login here</a>
</p>

</body>
</html>
