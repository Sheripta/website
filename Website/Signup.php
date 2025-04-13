<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


     <!-- Custom CSS for red asterisk -->
     <style>
        .required:after {
            content: " *";
            color: red;
        }
        .text-danger {
            color: red;
        }
    </style>
    <!-- <style>
.error {color: #FF0000;}
</style> -->
</head>
<body>
    <!-- Form Validation -->

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $dobErr = $passwordErr = $confirmPasswordErr = $phoneErr = "";
$name = $email = $gender = $dob = $password = $confirmPassword = $phone = "";


// form submission logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate Name
  if (empty($_POST["first_name"])) {
    $nameErr = "First name is required";
  } else {
    $name = test_input($_POST["first_name"]);
  }

  if (empty($_POST["last_name"])) {
    $nameErr = "Last name is required";
  } else {
    $name .= " " . test_input($_POST["last_name"]);
  }

  // Validate Email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if email address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  // Validate Gender
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  // Validate Date of Birth
  if (empty($_POST["month"]) || empty($_POST["day"]) || empty($_POST["year"])) {
    $dobErr = "Date of Birth is required";
  } else {
    $dob = test_input($_POST["month"]) . " " . test_input($_POST["day"]) . ", " . test_input($_POST["year"]);
  }
// Validate Password
if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  // Validate Confirm Password
  if (empty($_POST["confirm_password"])) {
    $confirmPasswordErr = "Please confirm your password";
  } else {
    $confirmPassword = test_input($_POST["confirm_password"]);
    if ($password !== $confirmPassword) {
      $confirmPasswordErr = "Passwords do not match";
    }
  }
   // Validate Phone Number
   if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if phone number is well-formed (basic validation for numbers)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
      $phoneErr = "Invalid phone number format. It should contain 10 digits.";
    }
  }


  
}

// Function to sanitize input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



 ?>
  <!-- Sign-Up Section -->
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white text-center">
                        <h4>Sign Up</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <!-- First Name -->
                            <div class="form-group">
                                <label class="required">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter First Name" required>
                                <span class="text-danger"><?php echo $nameErr; ?></span>
                            </div>
                              <!-- Middle Name -->
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name">
                            </div>
                            <!-- Last Name -->
                            <div class="form-group">
                                <label class="required">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Last Name" required>
                                <span class="text-danger"><?php echo $nameErr; ?></span>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label class="required">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter Email" required>
                                <span class="text-danger"><?php echo $emailErr; ?></span>
                            </div>
                            <!-- Date of Birth -->
                            <div class="form-group">
                                <label class="required">Date of Birth</label>
                                <div class="form-inline">
                                    <select class="form-control mr-2" name="month" required>
                                        <option value="">Month</option>
                                        <option value="May" <?php if (isset($_POST['month']) && $_POST['month'] == 'May') echo 'selected'; ?>>May</option>
                                        <option value="June" <?php if (isset($_POST['month']) && $_POST['month'] == 'June') echo 'selected'; ?>>June</option>
                                    </select>
                                    <input type="number" class="form-control mr-2" name="day" placeholder="5" min="1" max="31" value="<?php echo $_POST['day'] ?? ''; ?>" required>
                                    <input type="number" class="form-control" name="year" placeholder="1985" min="1900" max="2024" value="<?php echo $_POST['year'] ?? ''; ?>" required>
                                </div>
                                <span class="text-danger"><?php echo $dobErr; ?></span>
                            </div>
                            <!-- Gender -->
                            <div class="form-group">
                                <label class="required">Gender</label><br>
                                <input type="radio" name="gender" value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male') echo 'checked'; ?> required> Male
                                <input type="radio" name="gender" value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'female') echo 'checked'; ?> required> Female
                                <span class="text-danger"><?php echo $genderErr; ?></span>
                            </div>
                            <!-- Country -->
                            <div class="form-group">
                                <label>Country</label>
                                <select name="country" class="form-control">
                                    <option>USA</option>
                                    <option>India</option>
                                </select>
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="form-group">
                                <label class="required">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>" placeholder="Enter Phone Number" required>
                                <span class="text-danger"><?php echo $phoneErr; ?></span>
                            </div>
                             <!-- Password -->
                             <div class="form-group">
                                <label class="required">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                                <span class="text-danger"><?php echo $passwordErr; ?></span>
                            </div>
                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label class="required">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                <span class="text-danger"><?php echo $confirmPasswordErr; ?></span>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="terms" required>
                                <label class="form-check-label">I agree to the Terms of Use</label>
                            </div>
                            
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="index.html" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    
    <?php 
// include 'db.php'; // Include the database connection file

if (isset($_POST['submit'])) {
    // Get form data and sanitize inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, phone, password)
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

</body>
</html>

