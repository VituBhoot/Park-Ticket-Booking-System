<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <link rel="stylesheet" type="text/css" href="contacts.css">
</head>
<body>
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
<h1>Contact Us</h1>

<div id="contact-info">
  <h2>Contact Information</h2>
  <p>Email: <a href="mailto:abcd@gmail.com">abcd@gmail.com</a></p>
  <p>Phone: 0170000000</p>
</div>

<div id="map">
  <div class="mapouter">
    <div class="gmap_canvas">
      <iframe width="770" height="510" id="gmap_canvas" src="https://maps.google.com/maps?q=dhaka&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
      </iframe>
      <a href="https://2yu.co">2yu</a><br>
      <style>.mapouter{position:relative;text-align:right;height:510px;width:770px;}</style>
      <a href="https://embedgooglemap.2yu.co">html embed google map</a>
      <style>.gmap_canvas {overflow:hidden;background:none!important;height:510px;width:770px;}</style>
    </div>
  </div>
</div>

<h1>Feedback Us</h1>

<div class="container">
  <form action="contacts.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>

    <input type="submit" value="Submit" name="submit">
  </form>
</div>

</body>
</html>

<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parkticket";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Handle form submission
  if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert the contact details into the database
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
      // Redirect to dashboard.php
      header("Location: contacts.php");
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

// Close the database connection
$conn->close();
?>

