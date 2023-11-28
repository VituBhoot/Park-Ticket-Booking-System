<!DOCTYPE html>
<html>
<head>
  <title>Sign In</title>
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
    <!-- Sign In section -->
    <section id="signin">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Sign In</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </form>
              </div>
              <div class="card-footer text-center">
                Don't have an account? <a href="signup.php">Sign Up</a>
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
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Perform any necessary validation or data processing

  // Example code to check if email and password match the database record
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Successful login, redirect to a new page
    header("Location: dashboard.php");
    exit();
  } else {
    // Invalid login, display an error message
    echo "Invalid email or password.";
  }
}

// Close the database connection
$conn->close();
?>
