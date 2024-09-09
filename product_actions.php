<?php
include 'db_connect.php';

if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];

    $sql = "UPDATE products SET product_price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $product_price, $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>
