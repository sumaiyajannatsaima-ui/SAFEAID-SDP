
<?php
$search_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $blood = htmlspecialchars($_POST["blood"]);
    $district = htmlspecialchars($_POST["district"]);
    $area = htmlspecialchars(trim($_POST["area"]));

    if ($blood != "" && $district != "") {
        $search_message = "Search submitted for " . $blood .
                          " donors in " . $district .
                          " " . $area . ".";
    } else {
        $search_message = "Please select Blood Group and District.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Find Blood Donor | SafeAid</title>

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: #f5f7fa;
            font-family: Arial, sans-serif;
        }

        .search-container {
            max-width: 750px;
            margin: 60px auto;
            padding: 35px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.10);
        }

        .search-container h2 {
            text-align: center;
            color: #c62828;
            font-size: 28px;
        }

        .search-container p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .search-form label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        .search-form select,
        .search-form input {
            width: 100%;
            padding: 13px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .search-form button {
            width: 100%;
            padding: 14px;
            margin-top: 25px;
            background: #c62828;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .search-form button:hover {
            background: #a71919;
        }

        .search-message {
            background: #e8f5e9;
            color: #256029;
            padding: 13px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
        }

        .register-link a {
            color: #c62828;
            font-weight: bold;
            text-decoration: none;
        }

        @media(max-width: 600px) {
            .search-container {
                margin: 20px 12px;
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<div class="search-container">

    <h2>🩸 Find Blood Donors</h2>

    <p>Find voluntary blood donors near your location.</p>

    <?php if ($search_message != ""): ?>
        <div class="search-message">
            <?php echo $search_message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="search-form">

        <label>Select Blood Group *</label>

        <select name="blood" required>
            <option value="">Choose Blood Group</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>O+</option>
            <option>O-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select>

        <label>Select District *</label>

        <select name="district" required>
            <option value="">Choose District</option>
            <option>Chattogram</option>
            <option>Dhaka</option>
            <option>Cox's Bazar</option>
            <option>Chandanaish</option>
            <option>Comilla</option>
            <option>Feni</option>
            <option>Sylhet</option>
            <option>Rajshahi</option>
        </select>

        <label>Area / Upazila</label>

        <input type="text" name="area"
               placeholder="Enter area or upazila">

        <button type="submit">🔍 Search Donors</button>

    </form>

    <div class="register-link">
        <p>Want to become a blood donor?</p>
        <a href="donor-register.php">Register as a Donor →</a>
    </div>

    <div class="register-link">
        <a href="index.php">← Back to Home</a>
    </div>

</div>

</body>
</html>
