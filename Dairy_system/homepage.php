<?php
session_start();
include 'connection.php';
// include '../includes/header.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo htmlspecialchars($username); ?> - Fresh Farm Dairy</title>
    <link rel="stylesheet" href="../Dairy_system/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Discover the freshest dairy products at the best prices.</p>

        <!-- Categories Section -->
        <section class="categories">
            <h3>Shop by Category</h3>
            <ul>
                <li><a href="../products/view_product.php?category=milk">Milk</a></li>
                <li><a href="../products/view_product.php?category=cheese">Cheese</a></li>
                <li><a href="../products/view_product.php?category=yogurt">Yogurt</a></li>
                <li><a href="../products/view_product.php?category=butter">Butter</a></li>
            </ul>
        </section>

        <!-- New Arrivals -->
        <section class="new-arrivals">
            <h3>New Arrivals</h3>
            <div class="product-list">
                <?php
                $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<img src='../assets/images/" . htmlspecialchars($row['image']) . "' alt='Product Image'>";
                    echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
                    echo "<p>₹" . htmlspecialchars($row['price']) . "</p>";
                    echo "<a href='../products/view_product.php?id=" . $row['id'] . "' class='btn'>View</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>

        <!-- Special Offers -->
        <section class="offers">
            <h3>Special Offers</h3>
            <p>Check out our discounts and deals on selected products.</p>
            <a href="../discounts.php" class="btn">View Offers</a>
        </section>
    </div>

    <!-- <?php include '../includes/footer.php'; ?> -->
</body>
</html>