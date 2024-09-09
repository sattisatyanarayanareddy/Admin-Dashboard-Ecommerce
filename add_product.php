<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $targetDir = "uploads/";
    
    
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); 
    }

    
    $fileName = basename($_FILES["product_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
            
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_category = $_POST['product_category'];
            $created_at = date('Y-m-d H:i:s');

            $sql = "INSERT INTO products (product_image, product_name, product_price, product_category, created_at) 
                    VALUES ('$fileName', '$product_name', '$product_price', '$product_category', '$created_at')";

            if ($conn->query($sql) === TRUE) {
                
                $last_id = $conn->insert_id;
                
                
                $product_id = 'PDTX' . str_pad($last_id, 4, '0', STR_PAD_LEFT);
                
                $updateSql = "UPDATE products SET product_id = '$product_id' WHERE id = $last_id";
                if ($conn->query($updateSql) === TRUE) {
                    echo "New product added successfully with ID $product_id";
                } else {
                    echo "Error: " . $updateSql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file. Check directory permissions and file path.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
    }
}

$conn->close();
?>
