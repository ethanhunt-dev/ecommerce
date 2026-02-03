<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h2>Products</h2>
<main>
<?php foreach ($products as $product): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h4><?= $product->name ?></h4>
        <p>Price: ₹<?= $product->sp ?></p>
        <img src="<?= base_url($product->image) ?>" width="120">
    </div>
<?php endforeach; ?>
</main>
<footer><div><div style="text-align:center; margin:20px 0;">

    <?php if ($pagination['page'] > 1): ?>
        <a href="<?= base_url('users/products/'.$pagination['prev']) ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
        <a 
            href="<?= base_url('users/products/'.$i) ?>"
            style="<?= ($i == $pagination['page']) ? 'font-weight:bold;' : '' ?>"
        >
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($pagination['page'] < $pagination['total_pages']): ?>
        <a href="<?= base_url('users/products/'.$pagination['next']) ?>">Next</a>
    <?php endif; ?>

</div>
</div></footer>
    
        
</body>
</html>
