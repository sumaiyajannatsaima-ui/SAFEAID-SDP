
<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST["name"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $blood = htmlspecialchars($_POST["blood"]);
    $units = htmlspecialchars($_POST["units"]);
    $hospital = htmlspecialchars(trim($_POST["hospital"]));
    $district = htmlspecialchars($_POST["district"]);
    $needed_date = htmlspecialchars($_POST["needed_date"]);
    $urgency = htmlspecialchars($_POST["urgency"]);

    if (
        $name && $phone && $blood && $units &&
        $hospital && $district && $needed_date && $urgency
    ) {
        $message = "Your blood request has been submitted successfully!";
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

    <title>Request Blood | SafeAid</title>

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: #f5f7fa;
            font-family: Arial, sans-serif;
        }

        .request-container {
            max-width: 650px;
            margin: 45px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .request-container h2 {
            text-align: center;
            color: #c62828;
            margin-bottom: 10px;
        }

        .request-container p {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        .request-form label {
            display: block;
            margin: 16px 0 7px;
            font-weight: bold;
        }

        .request-form input,
        .request-form select,
        .request-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .request-form textarea {
            min-height: 90px;
            resize: vertical;
        }

        .request-form button {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            background: #c62828;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .request-form button:hover {
            background: #a71919;
        }

        .request-message {
            padding: 12px;
            margin-bottom: 18px;
            background: #e8f5e9;
            color: #256029;
            border-radius: 6px;
            text-align: center;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #c62828;
            text-decoration: none;
            font-weight: bold;
        }

        @media(max-width: 600px) {
            .request-container {
                margin: 20px 12px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="request-container">

    <h2>🩸 Request Blood</h2>

    <p>Submit your blood request and connect with potential donors.</p>

    <?php if ($message != ""): ?>
        <div class="request-message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="request-form">

        <label>Patient / Requester Name *</label>
        <input type="text" name="name"
               placeholder="Enter full name" required>

        <label>Contact Number *</label>
        <input type="tel" name="phone"
               placeholder="Enter contact number" required>

        <label>Required Blood Group *</label>
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

        <label>Number of Units *</label>
        <select name="units" required>
            <option value="">Select Units</option>
            <option value="1">1 Unit</option>
            <option value="2">2 Units</option>
            <option value="3">3 Units</option>
            <option value="4">4 Units</option>
            <option value="5">5 Units</option>
        </select>

        <label>Hospital / Medical Center *</label>
        <input type="text" name="hospital"
               placeholder="Enter hospital name" required>

        <label>District *</label>
        <select name="district" required>
            <option value="">Select District</option>
            <option>Chattogram</option>
            <option>Dhaka</option>
            <option>Cox's Bazar</option>
            <option>Comilla</option>
            <option>Feni</option>
            <option>Sylhet</option>
            <option>Rajshahi</option>
        </select>

        <label>Blood Needed Date *</label>
        <input type="date" name="needed_date"
               min="<?php echo date('Y-m-d'); ?>" required>

        <label>Urgency *</label>
        <select name="urgency" required>
            <option value="">Select Urgency</option>
            <option>Emergency</option>
            <option>Within 24 Hours</option>
            <option>Within 2-3 Days</option>
            <option>Scheduled</option>
        </select>

        <label>Additional Information</label>
        <textarea name="details"
                  placeholder="Write additional information (optional)"></textarea>

        <button type="submit">Submit Blood Request</button>

    </form>

    <div class="back-link">
        <p><a href="find-donor.php">← Find Blood Donors</a></p>
        <a href="index.php">Back to Home</a>
    </div>

</div>

</body>
</html>
