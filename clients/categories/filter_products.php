<?php
session_start();
require_once('../../config/config.php');

// Retrieve the minimum and maximum prices from the AJAX request
$CateId = $_POST['CateId'];
$minPrice = $_POST['minPrice'];
$maxPrice = $_POST['maxPrice'];


// Add your logic to filter products based on the price range
// For example, you can modify your existing SQL query
$sqlAllProducts = "SELECT product.*,categories.*, IFNULL(TotalOrders, 0) AS TotalOrders
FROM product
INNER JOIN categories ON product.CateId = categories.CateId
LEFT JOIN (
    SELECT ProdId, SUM(od.OrdQuantity) AS TotalOrders
    FROM orderdetail AS od
    GROUP BY ProdId
) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
WHERE categories.CateStatus = 1 AND product.ProdStatus = 1 AND product.ProdPrice BETWEEN $minPrice AND $maxPrice;";

$resultAllProducts = mysqli_query($connection, $sqlAllProducts);


$sqlFilteredProducts = "SELECT product.*,categories.*, IFNULL(TotalOrders, 0) AS TotalOrders
FROM product
INNER JOIN categories ON product.CateId = categories.CateId
LEFT JOIN (
    SELECT ProdId, SUM(od.OrdQuantity) AS TotalOrders
    FROM orderdetail AS od
    GROUP BY ProdId
) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
WHERE categories.CateStatus = 1 AND product.ProdStatus = 1 AND product.CateId = '$CateId' AND product.ProdPrice BETWEEN $minPrice AND $maxPrice;";

$resultFilteredProducts = mysqli_query($connection, $sqlFilteredProducts);

// Function to fetch and display the filtered products
function fetchFilteredProducts($result)
{
    $html = '';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $html .= '<div class="product-item women">';

            // Product Image
            $html .= '<div class="product product_filter">';
            $html .= '<div class="product_image">';
            $html .= '<img src="../../images/' . $row["ProdImage"] . '" alt="">';
            $html .= '</div>';

            // Product Info
            $html .= '<div class="product_info">';
            $html .= '<h6 class="product_name"><a href="../singleproduct/singleproduct_action.php?ProdId=' . $row['ProdId'] . '">' . $row["ProdName"] . '</a></h6>';

            // Product Price
            if ($row['ProdIsSale'] == 1) {
                $html .= '<div class="product_price">' . number_format($row["ProdPriceSale"], 0, ',', '.') . '<span>' . number_format($row["ProdPrice"], 0, ',', '.') . '</span></div>';
            } else if ($row['ProdIsSale'] == 0) {
                $html .= '<div class="product_price">' . number_format($row["ProdPrice"], 0, ',', '.') . '</div>';
            }

            // Add to Cart Button
            $html .= '<div class="red_button add_to_cart_button"><a href="#" id="cart_link">add to cart</a></div>';

            $html .= '</div>'; // Closing product_info
            $html .= '</div>'; // Closing product

            $html .= '</div>'; // Closing product-item

        }
    } else {
        $html .= '<h3>Không có sản phẩm nào trong khoảng giá</h3>';
    }


    return $html;
}


// Return the HTML for the updated product list

if ($CateId == "") {
    echo fetchFilteredProducts($resultAllProducts);
} else {
    echo fetchFilteredProducts($resultFilteredProducts);
}

// Close the database connection
mysqli_close($connection);
