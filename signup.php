<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Navbar code -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- Navbar content -->
    </nav>
  </header>

  <main>
    <!-- Sign Up section -->
    <section id="signup">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Sign Up</h2>
                <form action="signup.php" method="post">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
              </div>
              <div class="card-footer text-center">
                Already have an account? <a href="signin.php">Sign In</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <!-- Footer content -->
    <div class="container">
      <!-- Footer content -->
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parkticket";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Perform any necessary validation or data processing

  // Example code to insert the user data into the database
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    // User registered successfully
    header("Location: signin.php");
    exit();
  } else {
    // Error occurred during registration
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close the database connection
$conn->close();
?>
