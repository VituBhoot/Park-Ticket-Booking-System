<!DOCTYPE html>
<html>
<head>
  <title>Ticket Purchase Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" href="ticket.css">
</head>
<body>
  <!-- nav start -->
<nav>
  <h2 class="logo">Park Ticket<span>Booking</span></h2>
  <ul>
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="park.php">Parks</a></li>
    <li><a href="ticket.php">Tickets</a></li>
    <li><a href="contacts.php">Contacts</a></li>
    <li><a href="signin.php">Logout</a></li>
  </ul>
</nav>
<!-- nav end -->

<!-- pay form start -->
<div class="container">
  <h2>Ticket Purchase Form</h2>
  <form method="post" action="payment.php">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="Park_type" class="form-label">Select park</label>
      <select class="form-select" id="Park_type" name="Park_type" required>
        <option value="">Select Park</option>
        <option value="Fantasy Kingdom">Fantasy Kingdom</option>
        <option value="Nondon Park">Nondon Park</option>
        <option value="Dream Holiday Park">Dream Holiday Park</option>
        <option value="Bangabandhu Military Museum">Bangabandhu Military Museum</option>
        <option value="Shopnopori Park">Shopnopori Park</option>
        <option value="Toggi Fun World">Toggi Fun World</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="ticket_type" class="form-label">Ticket Type</label>
      <select class="form-select" id="ticket_type" name="ticket_type" required>
        <option value="">Select Ticket Type</option>
        <option value="Entrance">Entrance</option>
        <option value="Entrance Plus All Rides">Entrance Plus All Rides</option>
        <option value="Family package">Family package</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label">Quantity</label>
      <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="number" class="form-control" id="price" name="price" readonly>
    </div>

    <button type="submit" class="btn btn-primary" onclick="window.location.href = 'payment.php'">Buy Ticket</button>

  </form>
</div>
<!-- pay form end -->


<!-- Bootstrap JS -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const ticketTypeSelect = document.getElementById("ticket_type");
    const parkSelect = document.getElementById("Park_type");
    const quantityInput = document.getElementById("quantity");
    const priceInput = document.getElementById("price");

    ticketTypeSelect.addEventListener("change", calculatePrice);
    parkSelect.addEventListener("change", calculatePrice);
    quantityInput.addEventListener("input", calculatePrice);

    function calculatePrice() {
      const ticketType = ticketTypeSelect.value;
      const park = parkSelect.value;
      const quantity = parseInt(quantityInput.value);

      let price = 0;

      // Calculate the price based on the ticket type and park
      switch (ticketType) {
        case "Entrance":
          switch (park) {
            case "Fantasy Kingdom":
              price = 500;
              break;
            case "Nondon Park":
              price = 400;
              break;
            case "Dream Holiday Park":
              price = 550;
              break;
            case "Bangabandhu Military Museum":
              price = 100;
              break;
            case "Shopnopori Park":
              price = 450;
              break;
            case "Toggi Fun World":
              price = 500;
              break;
            // Add more cases for other parks
            default:
              price = 0;
          }
          break;
        case "Entrance Plus All Rides":
          switch (park) {
            case "Fantasy Kingdom":
              price = 800;
              break;
            case "Nondon Park":
              price = 600;
              break;
            case "Dream Holiday Park":
              price = 650;
              break;
            case "Bangabandhu Military Museum":
              price = 400;
              break;
            case "Shopnopori Park":
              price = 550;
              break;
            case "Toggi Fun World":
              price = 3000;
              break;
            // Add more cases for other parks
            default:
              price = 0;
          }
          break;
        case "Family package":
          switch (park) {
            case "Fantasy Kingdom":
              price = 3200;
              break;
            case "Nondon Park":
              price = 2400;
              break;
            case "Dream Holiday Park":
              price = 2600;
              break;
            case "Bangabandhu Military Museum":
              price = 1600;
              break;
            case "Shopnopori Park":
              price = 2200;
              break;
            case "Toggi Fun World":
              price = 12000;
              break;
            // Add more cases for other parks
            default:
              price = 0;
          }
          break;
        default:
          price = 0;
      }

      // Multiply the price by quantity
      const totalPrice = price * quantity;

      // Set the calculated price in the price input field
      priceInput.value = totalPrice;
    }
  });
</script>

</body>
</html>



<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "parkticket";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $parkType = $_POST["Park_type"];
  $ticketType = $_POST["ticket_type"];
  $quantity = $_POST["quantity"];
  $amount = $_POST["amount"];

  // Prepare and execute the SQL query
  $sql = "INSERT INTO ticket_purchase (name, email, park_type, ticket_type, quantity, amount) VALUES (?, ?, ?, ?, ?, ?)";
  $statement = $connection->prepare($sql);
  $statement->bind_param("ssssii", $name, $email, $parkType, $ticketType, $quantity, $amount);

  if ($statement->execute()) {
    // The data was successfully inserted into the database
    echo "Ticket purchase record inserted successfully.";
  } else {
    // An error occurred while inserting the data
    echo "Error inserting ticket purchase record: " . $statement->error;
  }

  $statement->close();
}

$connection->close();
?>
