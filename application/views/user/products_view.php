<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <meta charset="utf-8">
    <style>
        /* Simple grid skeleton */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .card img {
            max-width: 100%;
            height: 140px;
            object-fit: contain;
        }
        .section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<h2>Products</h2>

<p><a href="<?= base_url('user/cart/view') ?>">View Cart (<?= isset($cart_count) ? $cart_count : 0 ?>)</a></p>

<?php
// Safety check
$products = isset($products) ? $products : [];
?>

<!-- ================= FIRST 5 PRODUCTS ================= -->
<div class="section">
    <div class="grid">
        <?php
        $count = 0;
        foreach ($products as $product):
            if ($count == 5) break;
        ?>
            <div class="card">
                <?php if (!empty($product->image)): ?>
                    <img src="<?= base_url($product->image) ?>" alt="<?= $product->name ?>">
                <?php else: ?>
                    <div style="height:140px; line-height:140px; background:#f2f2f2;">No Image</div>
                <?php endif; ?>

                <h4><?= $product->name ?></h4>
                <p>Price: ₹ <?= $product->sp ?></p>

                <p>
                    <a href="<?= base_url('user/products/view/'.$product->id) ?>">View</a> |
                    <a href="<?= base_url('user/cart/add/'.$product->id) ?>">Add to Cart</a>
                </p>
            </div>
        <?php
            $count++;
        endforeach;
        ?>
    </div>
</div>

<!-- ================= NEXT 5 PRODUCTS ================= -->
<div class="section">
    <div class="grid">
        <?php
        $count2 = 0;
        foreach ($products as $index => $product):
            if ($index < 5) continue;   // skip first 5
            if ($count2 == 5) break;    // only next 5
        ?>
            <div class="card">
                <?php if (!empty($product->image)): ?>
                    <img src="<?= base_url($product->image) ?>" alt="<?= $product->name ?>">
                <?php else: ?>
                    <div style="height:140px; line-height:140px; background:#f2f2f2;">No Image</div>
                <?php endif; ?>

                <h4><?= $product->name ?></h4>
                <p>Price: ₹ <?= $product->sp ?></p>

                <p>
                    <a href="<?= base_url('user/products/view/'.$product->id) ?>">View</a> |
                    <a href="<?= base_url('user/cart/add/'.$product->id) ?>">Add to Cart</a>
                </p>
            </div>
        <?php
            $count2++;
        endforeach;
        ?>
    </div>
</div>

<!-- ================= PAGINATION ================= -->
<div style="text-align:center; margin:20px 0;">

    <?php if ($pagination['page'] > 1): ?>
        <a href="<?= base_url('user/products/'.$pagination['prev']) ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
        <a href="<?= base_url('user/products/'.$i) ?>"
           <?= ($i == $pagination['page']) ? 'style="font-weight:bold;"' : '' ?>>
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($pagination['page'] < $pagination['total_pages']): ?>
        <a href="<?= base_url('user/products/'.$pagination['next']) ?>">Next</a>
    <?php endif; ?>

</div>

</body>
</html>
