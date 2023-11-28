<?php
session_start();
if (isset($_SESSION["user_id"])) {
  header("Location: dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Online Park Ticket Booking</title>
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
    <!-- Home section -->
    <section id="home">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Welcome to Online Park Ticket Booking</h2>
                <p class="card-text">Plan your visit and book tickets for various parks online.</p>
                <a href="signin.php" class="btn btn-primary">Sign In</a>
                <a href="signup.php" class="btn btn-secondary">Sign Up</a>
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
