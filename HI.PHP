<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIGH 5 SALES FORM</title>


    <script>
      function saveToDatabase() {
    var formData = {};

    // Collect form data
    var formElements = document.getElementById('stockForm').elements;
    for (var i = 0; i < formElements.length; i++) {
        var element = formElements[i];
        if (element.name) {
            formData[element.name] = element.value;
        }
    }

    // Convert form data to JSON and set the hidden input value
    document.getElementById('form_data').value = JSON.stringify(formData);

    // Submit the form
    document.getElementById('stockForm').submit();
}

    </script>

    <script>




   // JavaScript function to calculate the total, sales, amount, profit, and total profit dynamically
function calculateFields(item) {
    var opening = parseFloat(document.getElementById("opening_" + item).value) || 0;
    var received = parseFloat(document.getElementById("received_" + item).value) || 0;
    var total = parseInt(opening) + parseInt(received);

    // Update the total field
    document.getElementById("total_" + item).value = total;

    // Calculate and update the sales field only if closing is filled
    var closing = document.getElementById("closing_" + item).value;
    if (closing !== "") {
        calculateSales(item);
    }

    // Calculate and update the amount field
    calculateAmount(item);

    // Calculate and update the profit field
    calculateProfit(item);

    // Calculate and update the total profit field
    calculateTotalProfit(item);
}

function calculateAmount(item) {
    var price = parseFloat(document.getElementById("price_" + item).value) || 0;
    var sales = parseFloat(document.getElementById("sales_" + item).value) || 0;

    var amount = price * sales;

    // Update the amount field
    document.getElementById("amount_" + item).value = amount;
}
// JavaScript function to calculate the sales dynamically
function calculateSales(item) {
    var total = parseFloat(document.getElementById("total_" + item).value) || 0;
    var closing = parseFloat(document.getElementById("closing_" + item).value) || 0;

    var sales = total - closing;

    // Update the sales field
    document.getElementById("sales_" + item).value = sales;
}

function calculateTotalProfit(item) {
    var sales = parseFloat(document.getElementById("sales_" + item).value) || 0;
    var profit = parseFloat(document.getElementById("profit_" + item).value) || 0;

    var totalProfit = sales * profit;

    // Update the total profit field
    document.getElementById("total_profit_" + item).value = totalProfit;
}

function printReport() {
    window.print();
}
</script>


<link rel="stylesheet" type="text/css" href="stylemain.css">



</head>
<body>
    <h1>HIGH 5 BAR & PUB STOCK SYSTEM</h1>

<?php
// Database connection details
$host = "localhost";
$dbname = "hi5";
$username = "root";
$password = "";

// Items array
$items = array(
    "Tusker", "Guiness", "WhiteCap", "Balozi", "TuskerCider", "Allsopps","Guiness Can","Tusker Can","Guarana", 
   "Faxe","Trust","Diluxe","Kane Extra¼","Kane Extra¾","Hunters¼","Gilbeys¾","Gilbeys¼", "Gilbeys½","V&A¼","Captain Morgan¾","Captain Morgan¼","Orijin¼",
  "Chrome¾", "Chrome¼", "Tripple Ace¼", "Kenya Cane¾","Kenya Cane¼","County¾","County¼", "Lemonade","Soda500ml",
"Soda 300ml","Water 500ml","Energy Drink", "Predator","Sportman", "Safari","Kings","Afia"
  
);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($items as $item) {
            // Get form values for the current item
            $opening = isset($_POST["opening_" . $item]) ? $_POST["opening_" . $item] : 0;
            $received = isset($_POST["received_" . $item]) ? $_POST["received_" . $item] : 0;
            $total = isset($_POST["total_" . $item]) ? $_POST["total_" . $item] : 0;
            $closing = isset($_POST["closing_" . $item]) ? $_POST["closing_" . $item] : 0;
            $sales = isset($_POST["sales_" . $item]) ? $_POST["sales_" . $item] : 0;
            $price = isset($_POST["price_" . $item]) ? $_POST["price_" . $item] : 0;
            $amount = isset($_POST["amount_" . $item]) ? $_POST["amount_" . $item] : 0;
            $profit = isset($_POST["profit_" . $item]) ? $_POST["profit_" . $item] : 0;
            $totalProfit = isset($_POST["total_profit_" . $item]) ? $_POST["total_profit_" . $item] : 0;

            // Insert data into the stock_tracking_table for the current item
            $stmt = $pdo->prepare("INSERT INTO stock_tracking_table (item_name, opening, received, total, closing, sales, price, amount, profit, total_profit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$item, $opening, $received, $total, $closing, $sales, $price, $amount, $profit, $totalProfit]);
        }

        header("Location: totals_page.html");
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}







$itemPrices = array(
    "Tusker" => 220.0,
    "Guiness" => 250.0,
    "WhiteCap" =>230.0, "Balozi" => 220.0, "TuskerCider" =>230.0,
     "Allsopps" => 180,"Guiness Can"=>250.0,"Tusker Can"=>250.0,"Guarana"=> 220, 
    "Faxe"=>330.0,"Trust"=>50.0,"Diluxe"=>100.0,"Kane Extra¼"=>250.0,
    "Kane Extra¾"=>750.0,"Hunters¼"=>370.0,"Gilbeys¾"=>1500.0,
    "Gilbeys¼"=>550.0, "Gilbeys½"=>750.0,"V&A¼"=>330.0,"Captain Morgan¾"=>1300.0,
    "Captain Morgan¼"=>400.0,"Orijin¼"=>270.0,
    "Chrome¾"=>800.0, "Chrome¼"=>270.0, "Tripple Ace¼"=>250.0, "Kenya Cane¾"=>900.0,
    "Kenya Cane¼"=>320.0,"County¾"=>800.0,"County¼"=>280.0, "Lemonade"=>50.0,"Soda500ml"=>80.0,
    "Soda 300ml"=>50.0,"Water 500ml"=>100.0,"Energy Drink"=>50.0, "Predator"=>70.0,"Sportman"=>15.0, "Safari"=>10,"Kings"=>10.0,"Afia"=>100.0
    // Add prices for other items as needed
);




$itemProfits = array(
    "Tusker" => 51.0,
    "Guiness" => 52.0,
    "WhiteCap" =>42.0, "Balozi" => 49.0, "TuskerCider" =>33.0,
     "Allsopps" => 45.0,"Guiness Can"=>41.0,"Tusker Can"=>33.0,"Guarana"=>51.0, 
    "Faxe"=>50.0,"Trust"=>37.5,"Diluxe"=>50.0,"Kane Extra¼"=>42.0,
    "Kane Extra¾"=>97.0,"Hunters¼"=>30.0,"Gilbeys¾"=>150.0,
    "Gilbeys¼"=>115.0, "Gilbeys½"=>150.0,"V&A¼"=>20.0,"Captain Morgan¾"=>298.0,
    "Captain Morgan¼"=>60.0,"Orijin¼"=>45.0,
    "Chrome¾"=>190.0, "Chrome¼"=>45.0, "Tripple Ace¼"=>41.0, "Kenya Cane¾"=>222.0,
    "Kenya Cane¼"=>61.0,"County¾"=>100.0,"County¼"=>50.0, "Lemonade"=>13.5,"Soda500ml"=>30.0,
    "Soda 300ml"=>17.5,"Water 500ml"=>50.0,"Energy Drink"=>20.83, "Predator"=>15.87,
    "Sportman"=>7.0, "Safari"=>1.25,"Kings"=>1.25,"Afia"=>32.5
    
);







?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <table border="1">
        <thead>
            <tr>
                <th>Item</th>
                <th>Opening</th>
                <th>Received</th>
                <th>Total</th>
                <th>Closing</th>
                <th>Sales</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Profit</th>
                <th>Total Profit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?php echo $item; ?></td>
                    <td><input type="number" id="opening_<?php echo $item; ?>" name="opening_<?php echo $item; ?>" oninput="calculateFields('<?php echo $item; ?>')" required></td>
                    <td><input type="number" id="received_<?php echo $item; ?>" name="received_<?php echo $item; ?>" oninput="calculateFields('<?php echo $item; ?>')"></td>
                    <td><input type="number" id="total_<?php echo $item; ?>" name="total_<?php echo $item; ?>" readonly required></td>
                    <td><input type="number" id="closing_<?php echo $item; ?>" name="closing_<?php echo $item; ?>" onblur="calculateSales('<?php echo $item; ?>')" required></td>
                    <td><input type="number" id="sales_<?php echo $item; ?>" name="sales_<?php echo $item; ?>" readonly required></td>
                   
                    <td><input type="number" id="price_<?php echo $item; ?>" name="price_<?php echo $item; ?>" value="<?php echo $itemPrices[$item]; ?>" oninput="calculateAmount('<?php echo $item; ?>')" required></td>

                    <td><input type="number" id="amount_<?php echo $item; ?>" name="amount_<?php echo $item; ?>" readonly required></td>
                    
                    <td><input type="number" id="profit_<?php echo $item; ?>" name="profit_<?php echo $item; ?>" value="<?php echo $itemProfits[$item]; ?>" oninput="calculateTotalProfit('<?php echo $item; ?>')" required></td>

                    <td><input type="number" id="total_profit_<?php echo $item; ?>" name="total_profit_<?php echo $item; ?>" readonly required></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

   <!-- <input type="submit" value="Calculate and Save">-->


 



</form>





<form method="post" action="save_stock_form.php" id="stockForm">
    
    <!-- Add the "Save to Database" button -->
  <!--  <button type="button" onclick="saveToDatabase()">Save to Database asap</button>-->
    <input type="hidden" name="form_data" id="form_data" value="">
</form>




<button onclick="printReport()">Print Report</button>

<script>
function printReport() {
    // Get the current date and time
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString();
    var formattedTime = currentDate.toLocaleTimeString();

    // Create a string with date and time information
    var dateTimeString = 'Printed on ' + formattedDate + ' at ' + formattedTime;

    // Add the date and time information to the document
    var dateElement = document.createElement('p');
    dateElement.textContent = dateTimeString;
    document.body.appendChild(dateElement);

    // Trigger the print function
    window.print();

    // Remove the added date and time information from the document
    document.body.removeChild(dateElement);
}
</script>
<button onclick="calculateTotals()">Calculate Totals</button>
<script>




function calculateTotals() {
    var totalAmount = 0;
    var totalTotalProfit = 0;

    // Dynamically generate the items array based on PHP data
    var items = <?php echo json_encode($items); ?>;

    // Loop through each item to calculate the totals
    for (var i = 0; i < items.length; i++) {
        var item = items[i];

        var amount = parseFloat(document.getElementById("amount_" + item).value) || 0;
        var totalProfit = parseFloat(document.getElementById("total_profit_" + item).value) || 0;

        totalAmount += amount;
        totalTotalProfit += totalProfit;
    }





    // Redirect to the totals page with parameters
    window.location.href = 'totals_page.html?totalAmount=' + totalAmount.toFixed(2) + '&totalProfit=' + totalTotalProfit.toFixed(2);
}



</script>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="stockForm">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="stockForm">
        

        <!-- Add the "Save to Database" button -->
        <button type="button" onclick="saveToDatabase()">Save to Database</button>
    </form>
</body>
</html>
