<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | Page</title>

    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            border: 2px solid black;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #e0e0e0;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 6px 10px;
            margin: 2px;
            border: 1px solid black;
            text-decoration: none;
            color: black;
        }

        .pagination a.active {
            background-color: black;
            color: white;
            font-weight: bold;
        }

        .pagination a.disabled {
            color: grey;
            pointer-events: none;
            border-color: grey;
        }
    </style>
</head>
<body>

<div>

    <h1>Product View</h1>
    <pre>
  TOTAL RECORDS: <?= $total_records ?>
  PER PAGE: <?= $per_page ?>
  TOTAL PAGES: <?= $total_pages ?>
  CURRENT PAGE: <?= $page ?>
</pre>

    <a href="<?= site_url('admin/product_controller/add_product') ?>">ADD</a>

    <table>
        <tr>
            <th>SNO</th>
            <th>Name</th>
            <th>Cost Price</th>
            
            
            <th>sp</th>
             <th>image</th>
            <th>desc</th>
            <th>ACTION</th>
        </tr>

        <?php if (!empty($products)) { ?>

            <?php
            $sno = ($page - 1) * $per_page + 1;
            foreach ($products as $p) {
            ?>
                <tr>
                    <td><?= $sno++; ?></td>
                    <td><?= $p->name; ?></td>
                    <td><?= $p->price; ?></td>
                    <td><?= $p->sp; ?></td>
                     <td><?php if (!empty($p->image)) { ?>
                        <img src="<?= base_url($p->image); ?>" width="80">
                    <?php } else { ?>
                        No Image
                    <?php } ?></td>
                    
                    <td><?= $p->description; ?></td>
                    <td>
                         <a href="<?= site_url('admin/product_controller/edit/'.$p->id) ?>">
                    <button type="button">Edit</button>
                </a>
            <a href="<?= site_url('admin/product_controller/delete/'.$p->id) ?>"
               onclick="return confirm('Are you sure you want to delete this row?')">
                <button type="button">Delete</button>
            </a>
        </td>
                </tr>
            <?php } ?>

        <?php } else { ?>
            <tr>
                <td colspan="3">No products found</td>
            </tr>
        <?php } ?>
    </table>
<div class="pagination">

    <!-- PREV -->
    <a href="<?= site_url('admin/product_controller?page='.$prev) ?>">
        Prev
    </a>

    <!-- PAGE NUMBERS -->
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="<?= site_url('admin/product_controller?page='.$i) ?>"
           style="<?= ($i == $page) ? 'font-weight:bold;' : '' ?>">
            <?= $i ?>
        </a>
    <?php } ?>

    <!-- NEXT -->
    <a href="<?= site_url('admin/product_controller?page='.$next) ?>">
        Next
    </a>

</div>


</body>
</html>
