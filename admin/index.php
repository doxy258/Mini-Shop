<?php 

require '../app/config/config.php';
require '../app/classes/User.php';
require '../app/classes/Product.php';

$user = new User();

if($user->is_logged() && $user->is_admin()) : 

$products = new Product();
$products = $products->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
<body>
    <div class="container">
        <a href="add_product.php" class="btn btn-success"> Add Product </a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"> Product ID</th>
                    <th scope="col"> Name</th>
                    <th scope="col"> Price</th>
                    <th scope="col"> Size</th>
                    <th scope="col"> Image</th>
                    <th scope="col"> Created At</th>
                    <th scope="col"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr>
                        <th scope="row"> <?php echo $product['product_id']; ?></th>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['size']; ?></td>
                        <td><?php echo $product['image']; ?></td>
                        <td><?php echo $product['created_at']; ?></td>                        
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-primary"> Edit </a>
                            <a href="delete_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger"> Delete </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
</body>
</html>

<?php endif; ?>