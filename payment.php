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
    $amount = $_POST["price"]; // Use 'amount' instead of 'price'
    $pay_to = 'MCA Foundation (Save Tree, Save India)';

    include 'instamojo/Instamojo.php';

    $api = new Instamojo\Instamojo('test_3fca8eebb469e6292a0003326f6', 'test_69ae86fc88c4fccf0809d1641df', 'https://test.instamojo.com/api/1.1/');

    try {
        $response = $api->paymentRequestCreate(array(
            "purpose" => $pay_to,
            "user_name" => $name,
            "email" => $email,
            "amount" => $amount, // Updated parameter name
            "send_email" => true,
            "allow_repeated_payments" => false,
            "redirect_url" => "http://localhost/Payment/thankyou.php"
        ));

        // print_r($response);
        $url = $response['longurl'];
        header("location:$url");
    } catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }

    $sql = "INSERT INTO transaction (name, email, amount, pay_to) VALUES (?, ?, ?, ?)";
    $statement = $connection->prepare($sql);

    if ($statement) {
        $statement->bind_param("ssds", $name, $email, $amount, $pay_to); // Updated the number of placeholders and bindings

        if ($statement->execute()) {
            // The data was successfully inserted into the database
            echo "Transaction record inserted successfully.";
        } else {
            // An error occurred while inserting the data
            echo "Error inserting transaction record: " . $statement->error;
        }

        $statement->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }
}

$connection->close();
?>
