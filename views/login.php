<?php
// Start the session at the beginning
session_start();

include '../includes/header.php';
// Include the database connection
include_once('../database/db_connect.php');

// Initialize variables
$email = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from POST request
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validate email and password inputs
    if (empty($email)) {
        $errors[] = "Email is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        // Query to find the user by email
        $sql = "SELECT user_id, name, email, password, status FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Check if the user is active
            if ($user['status'] === 'inactive') {
                $errors[] = "Your account is inactive. Please contact support.";
            } else {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Set session variables for the logged-in user
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];

                    $_SESSION['welcome_message'] = "Welcome, " . $user['name'] . "!";


                    // Redirect to homepage
                    header("Location: ../index.php");
                    exit;
                } else {
                    $errors[] = "Invalid email or password.";
                }
            }
        } else {
            $errors[] = "No user found with this email.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-container form button {
            padding: 10px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container form button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .signup-option {
            text-align: center;
            margin-top: 10px;
        }
        .signup-option a {
            color: #007BFF;
            text-decoration: none;
        }
        .signup-option a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="signup-option">
            <p>Don't have an account? <a href="signup.php">Signup!</a></p>
        </div>
    </div>
</body>
</html>


<?php
include '../includes/footer.php';
?>