<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>

<h2>User Login</h2>

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

<form method="post" action="<?= site_url('users/auth/do_login'); ?>">
    
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= set_value('email'); ?>" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>
    Don't have an account? 
    <a href="<?= site_url('users/auth/register'); ?>">Register here</a>
</p>

</body>
</html>
