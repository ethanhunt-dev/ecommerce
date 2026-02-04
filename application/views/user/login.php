<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Page</title>
</head>
<body>

<header>Login</header>

<?php if ($msg = $this->session->flashdata('success')): ?>
    <p style="color: green;"><?= $msg; ?></p>
<?php endif; ?>

<?php if ($err = $this->session->flashdata('error')): ?>
    <p style="color: red;"><?= $err; ?></p>
<?php endif; ?>

<?php echo form_open('login/do_login'); ?>

<p>
    <label for="email">Email</label>
    <input type="email" name="email" required>
</p>

<p>
    <label for="password">Password</label>
    <input type="password" name="password" required>
</p>

<p>
    <button type="submit">Login</button>
    <button type="reset">Reset</button>
</p>

<p>
    No account?
    <a href="<?= site_url('register'); ?>">Register</a>
</p>

</form>

</body>
</html>
