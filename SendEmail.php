<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));
	
	// Validate the input fields and return an error if any of them are empty or invalid
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);	// Set the response code to 400 (Bad Request)
        echo "Please fill out all required fields and enter a valid email address.";	// Display an error message
        exit;	// Stop the script execution
    }

	// Set the recipient, subject, and content of the email to be sent
	$recipient = "youremail@example.com"; // The email address where the contact form submissions will be sent
	$subject = "New Contact Form Submission"; // The subject line of the email
	$email_content = "Name: $name\n"; // The name of the sender
	$email_content .= "Email: $email\n\n"; // The email address of the sender
	$email_content .= "Message:\n$message\n"; // The message of the sender
    
	// Set the headers of the email to include the sender's name and email address
	$headers = "From: $name <$email>";

	// Send the email using the mail() function and check if it was successful
    if (mail($recipient, $subject, $email_content, $headers)) {
        http_response_code(200);	// Set the response code to 200 (OK)
        echo "Thank You! Your message has been sent.";	// Display a success message
    } else {
        http_response_code(500);	// Set the response code to 500 (Internal Server Error)
      echo "Oops! Something went wrong and we couldn't send your message.";	// Display a failure message
}
} else {
http_response_code(403);
echo "There was a problem with your submission, please try again.";
}
?> 