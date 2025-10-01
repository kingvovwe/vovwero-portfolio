<?php
// Set the recipient email address
$to_email = "omughellivovwero@gmail.com"; // Replace with your actual email address

// Get form data
$name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
$email = isset($_POST['email']) ? htmlspecialchars(strip_tags(trim($_POST['email']))) : '';
$phone = isset($_POST['phone']) ? htmlspecialchars(strip_tags(trim($_POST['phone']))) : 'N/A';
$message = isset($_POST['message']) ? htmlspecialchars(strip_tags(trim($_POST['message']))) : '';
$preferred_date_time = isset($_POST['preferred_date_time']) ? htmlspecialchars(strip_tags(trim($_POST['preferred_date_time']))) : 'Not specified';

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "error: Invalid email format.";
    exit;
}

// Subject of the email
$subject = "New Session Request from Portfolio Website - " . $name;

// Email body in HTML format
$email_body = '
<html>
<head>
    <title>New Session Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #10B981; /* Primary green color */
            border-bottom: 2px solid #10B981;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        strong {
            color: #555555;
        }
        .message-box {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Session Request from Your Portfolio Website</h2>
        <p>You have received a new session request with the following details:</p>
        <p><strong>Name:</strong> ' . $name . '</p>
        <p><strong>Email:</strong> ' . $email . '</p>
        <p><strong>Phone:</strong> ' . $phone . '</p>
        <p><strong>Preferred Date & Time:</strong> ' . $preferred_date_time . '</p>
        <p><strong>Message:</strong></p>
        <div class="message-box">
            <p>' . nl2br($message) . '</p>
        </div>
        <p style="margin-top: 20px;">Please respond to this request as soon as possible.</p>
    </div>
    <div class="footer">
        <p>This email was sent from your portfolio website contact form.</p>
    </div>
</body>
</html>
';

// Email headers
$headers = "From: " . $name . " <" . $email . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n"; // Added for HTML email
$headers .= "Content-type: text/html; charset=UTF-8\r\n"; // Changed to text/html

// Attempt to send the email
if (mail($to_email, $subject, $email_body, $headers)) {
    echo "success"; // Send success response to JavaScript
} else {
    echo "error: Failed to send email."; // Send error response to JavaScript
}
?>
