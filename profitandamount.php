<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Amount and Profit</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // JavaScript to calculate total amount and total profit
            var items = [
                "Tusker", "Guiness", "WhiteCap", "Tusker", "Guiness", "WhiteCap", "Balozi", "TuskerCider", "Allsopps", "Guiness Can", "Tusker Can", "Guarana",
                "Faxe", "Trust", "Diluxe", "Kane Extra¼", "Kane Extra¾", "Hunters¼", "Gilbeys¾", "Gilbeys¼", "Gilbeys½", "V&A¼", "Captain Morgan¾", "Captain Morgan¼", "Orijin¼",
                "Chrome¾", "Chrome¼", "Tripple Ace¼", "Kenya Cane¾", "Kenya Cane¼", "County¾", "County¼", "Lemonade", "Soda500ml",
                "Soda 300ml", "Water 500ml", "Energy Drink", "Predator", "Sportman", "Safari", "Kings", "Afia"
            ];

            // Initialize total amount and total profit
            var totalAmount = 0;
            var totalProfit = 0;

            // Loop through items to calculate total amount and total profit
            items.forEach(function (item) {
                // Assume you have elements with IDs like "amount_Tusker", "total_profit_Tusker", etc.
                var amountElement = document.getElementById("amount_" + item);
                var profitElement = document.getElementById("total_profit_" + item);

                // Check if the elements exist
                if (amountElement && profitElement) {
                    // Update totals
                    totalAmount += parseFloat(amountElement.innerText);
                    totalProfit += parseFloat(profitElement.innerText);
                }
            });

            // Display total amount and total profit
            var totalAmountElement = document.getElementById("totalAmount");
            var totalProfitElement = document.getElementById("totalProfit");

            if (totalAmountElement && totalProfitElement) {
                totalAmountElement.innerText = "Total Sales: " + totalAmount.toFixed(2);
                totalProfitElement.innerText = "Total Profit: " + totalProfit.toFixed(2);
            }
        });

        function printReport() {
            window.print();
        }
    </script>
</head>

<body>

    <div class="header-container">
        <h1>RECORDS ADDED SUCCESFULLY</h1>
    </div>

    <?php
// Database connection details
$host = "localhost";
$dbname = "hi5";
$username = "root";
$password = "";

// Items array
$items = array(
    "Tusker", "Guiness", "WhiteCap", "Tusker","Guiness", "WhiteCap", "Balozi", "TuskerCider", "Allsopps","Guiness Can","Tusker Can","Guarana", 
    "Faxe","Trust","Diluxe","Kane Extra¼","Kane Extra¾","Hunters¼","Gilbeys¾","Gilbeys¼", "Gilbeys½","V&A¼","Captain Morgan¾","Captain Morgan¼","Orijin¼",
    "Chrome¾", "Chrome¼", "Tripple Ace¼", "Kenya Cane¾","Kenya Cane¼","County¾","County¼", "Lemonade","Soda500ml",
  "Soda 300ml","Water 500ml","Energy Drink", "Predator","Sportman", "Safari","Kings","Afia"
);

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialize total amount and total profit variables
    $totalAmount = 0;
    $totalProfit = 0;

    // Loop through items to calculate total amount and profit
    foreach ($items as $item) {
        // Retrieve the latest record for the current item
        $stmt = $pdo->prepare("SELECT amount, total_profit FROM stock_tracking_table WHERE item_name = ? ORDER BY id DESC LIMIT 1");
        $stmt->execute([$item]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display item data
        echo "<div id='amount_$item' style='display: none;'>{$row['amount']}</div>";
        echo "<div id='total_profit_$item' style='display: none;'>{$row['total_profit']}</div>";
    }

    // Display total amount and total profit
    echo "<div class='center-text'>";
   // echo "<h2>Total Sales: $totalAmount</h2>";
   // echo "<h2>Total Profit: $totalProfit</h2>";
    echo "</div>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    $pdo = null;
}
?>

    <!-- Display total amount and total profit -->
   <!-- <div class='center-text'>
        <h2 id="totalAmount">Total Sales: 0.00</h2>
        <h2 id="totalProfit">Total Profit: 0.00</h2>
    </div>-->

    <!-- MPESA input form -->
    <!--<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="mpesa" id="mpesa-label" class="center-text">MPESA:</label>
        <input type="number" id="mpesa" name="mpesa" class="center-text" required><br>
        <input type="submit" value="Submit">
    </form>-->

    <?php
    // Check if the MPESA form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the MPESA value
        $mpesaValue = isset($_POST["mpesa"]) ? intval($_POST["mpesa"]) : 0;

        // Subtract the MPESA value from the total sales
        $totalAmount -= $mpesaValue;

        // Display updated total amount
      //  echo "<div class='center-text'>";
        //echo "<h2>Cashout Balance: $totalAmount</h2>";
       // echo "</div>";

        // Display MPESA value in a label
      //  echo "<label for='mpesa' id='mpesa-value' class='center-text'>MPESA SALES: $mpesaValue</label>";
    }
    ?>

    <!-- Print button -->
  <!--  <button onclick="printReport()">Print Report</button>-->

</body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPESA Sales</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

    <div class="header-container">
        <h1>HIGH 5 STOCK SYSTEM</h1>
    </div>

    <?php
    // Database connection details
    $host = "localhost";
    $dbname = "hi5";
    $username = "root";
    $password = "";

    // Check if the MPESA form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Connect to the database
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Get the MPESA value
            $mpesaValue = isset($_POST["mpesa"]) ? intval($_POST["mpesa"]) : 0;

            // Insert data into the stock_tracking_table for the MPESA sale
            $stmt = $pdo->prepare("INSERT INTO stock_tracking_table (item_name, amount, total_profit) VALUES (?, ?, ?)");
            $stmt->execute(['MPESA', -$mpesaValue, 0]);

            // Print success message
            echo "<div class='center-text'>";
            echo "<p>MPESA sale successfully added to the database.</p>";
            echo "</div>";

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the database connection
            $pdo = null;
        }
    }
    ?>

    <!-- MPESA input form -->
   <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="mpesa" id="mpesa-label" class="center-text">MPESA:</label>
        <input type="number" id="mpesa" name="mpesa" class="center-text" required><br>
        <input type="submit" value="Submit">
    </form>-->

</body>

</html>

</html>
