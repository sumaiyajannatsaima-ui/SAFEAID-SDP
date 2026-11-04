
<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST["name"]));
    $blood = htmlspecialchars($_POST["blood"]);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $district = htmlspecialchars($_POST["district"]);
    $area = htmlspecialchars(trim($_POST["area"]));

    if ($name && $blood && $phone && $district && $area) {
        $message = "Your donor registration form has been submitted successfully!";
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donor Registration | SafeAid</title>

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: #f5f7fa;
            font-family: Arial, sans-serif;
        }

        .donor-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .donor-container h2 {
            text-align: center;
            color: #c62828;
        }

        .donor-container p {
            text-align: center;
            color: #666;
        }

        .donor-form label {
            display: block;
            margin-top: 17px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .donor-form input,
        .donor-form select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .donor-form button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            background: #c62828;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .donor-form button:hover {
            background: #a71919;
        }

        .message {
            text-align: center;
            padding: 12px;
            background: #e8f5e9;
            color: green;
            border-radius: 6px;
            margin: 15px 0;
        }
    </style>
</head>

<body>

<div class="donor-container">

    <h2>❤️ Become a Blood Donor</h2>

    <p>Register yourself and help save lives.</p>

    <?php if ($message != ""): ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="donor-form">

        <label>Full Name *</label>
        <input type="text" name="name"
               placeholder="Enter your full name" required>

        <label>Blood Group *</label>
        <select name="blood" required>
            <option value="">Select Blood Group</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>O+</option>
            <option>O-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select>

        <label>Phone Number *</label>
        <input type="tel" name="phone"
               placeholder="Enter phone number" required>

        <label>District *</label>
        <select name="district" required>
            <option value="">Select District</option>
            <option>Chattogram</option>
            <option>Dhaka</option>
            <option>Cox's Bazar</option>
            <option>Chandanaish</option>
            <option>Comilla</option>
            <option>Feni</option>
        </select>

        <label>Area *</label>
        <input type="text" name="area"
               placeholder="Enter your area" required>

        <label>Last Blood Donation Date</label>
        <input type="date" name="last_donation_date">

        <button type="submit">Register as Donor</button>

    </form>

    <p style="margin-top:20px;">
        <a href="index.php">← Back to Home</a>
    </p>

</div>

</body>
</html>

