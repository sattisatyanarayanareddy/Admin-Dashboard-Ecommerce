<?php
include 'db_connect.php';
include 'product_actions.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);


$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo_vts.png" alt="">
            </div>
            <span class="logo_name">SathyaMart</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#" class="nav-link" data-section="dashboard">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="#" class="nav-link" data-section="add-products">
                        <i class="fa-regular fa-address-book"></i>
                        <span class="link-name">Add Products</span>
                    </a></li>
                <li><a href="#" class="nav-link" data-section="update-products">
                        <i class="fa-solid fa-pen"></i>
                        <span class="link-name">Update Products</span>
                    </a></li>
                <li><a href="#" class="nav-link" data-section="delete-products">
                        <i class="fa-solid fa-trash"></i>
                        <span class="link-name">Delete Products</span>
                    </a></li>
            </ul>
            <ul class="logout-mode">
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" id="searchInput" placeholder="Search here...">
            </div>
        </div>
        <div class="dash-content" id="content">
            <div class="section" id="dashboard">
                <h2>Dashboard</h2>
                <p>Welcome to the dashboard!</p>
                <div class="rowProducts" id="productList">
                    <?php foreach ($products as $product): ?>
                        <div class="productContainer">
                            <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <h3 class="productName"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <h6><?php echo htmlspecialchars($product['product_price']); ?> /-</h6>
                            <h6><?php echo htmlspecialchars($product['product_category']); ?></h6>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="section" id="add-products">
                <h2>Add Products</h2>
                <p>Here you can add new products.</p>
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="product_image">Product Image:</label>
                        <input type="file" id="product_image" name="product_image" accept="image/*" required>
                    </div>
                    <div>
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" required>
                    </div>
                    <div>
                        <label for="product_price">Product Price:</label>
                        <input type="number" id="product_price" name="product_price" step="0.01" required>
                    </div>
                    <div>
                        <label for="product_category">Product Category:</label>
                        <input type="text" id="product_category" name="product_category" required>
                    </div>
                    <div>
                        <button type="submit">Add Product</button>
                    </div>
                </form>
            </div>
            <div class="section" id="update-products">
                <h2>Update Products</h2>
                <div class="rowProducts">
                    <?php foreach ($products as $product): ?>
                        <div class="productContainer">
                            <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <h3 class="productName"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <h6><?php echo htmlspecialchars($product['product_price']); ?> /-</h6>
                            <button onclick="document.getElementById('update-form-<?php echo $product['id']; ?>').style.display = 'block'">Update</button>
                            <form id="update-form-<?php echo $product['id']; ?>" class="update-form" action="" method="post" style="display:none;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <div>
                                    <label for="update_product_price">Product Price:</label>
                                    <input type="number" id="update_product_price" name="product_price" step="0.01" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
                                </div>
                                <button type="submit" name="update_product">Update Product</button>
                                <button type="button" onclick="document.getElementById('update-form-<?php echo $product['id']; ?>').style.display = 'none'">Cancel</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="section" id="delete-products">
                <h2>Delete Products</h2>
                <div class="rowProducts">
                    <?php foreach ($products as $product): ?>
                        <div class="productContainer">
                            <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <h3 class="productName"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <h6><?php echo htmlspecialchars($product['product_price']); ?> /-</h6>
                            <button onclick="document.getElementById('delete-form-<?php echo $product['id']; ?>').style.display = 'block'">Delete</button>
                            <form id="delete-form-<?php echo $product['id']; ?>" class="delete-form" action="" method="post" style="display:none;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete_product">Delete Product</button>
                                <button type="button" onclick="document.getElementById('delete-form-<?php echo $product['id']; ?>').style.display = 'none'">Cancel</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>

</html>
