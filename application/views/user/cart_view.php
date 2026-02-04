<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .qty-btn { padding: 4px 8px; text-decoration: none; border: 1px solid #000; margin: 0 5px; }
        .remove-btn { color: red; text-decoration: none; }
    </style>
</head>
<body>

<h2>Shopping Cart</h2>

<?php if (empty($cart)) : ?>
    <p>Your cart is empty.</p>
<?php else: ?>

<table>
    <tr>
        <th>Product ID</th>
        <th>Qty</th>
        <th>Action</th>
    </tr>

    <?php foreach ($cart as $product_id => $qty): ?>
    <tr>
        <td><?= $product_id; ?></td>
        <td>
            <a class="qty-btn" href="<?= site_url('user/cart/decrease/'.$product_id); ?>">−</a>
            <?= $qty; ?>
            <a class="qty-btn" href="<?= site_url('user/cart/increase/'.$product_id); ?>">+</a>
        </td>
        <td>
            <a class="remove-btn" href="<?= site_url('user/cart/remove/'.$product_id); ?>">Remove</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>

</body>
</html>
