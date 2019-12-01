<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $mail_to = "chaudharyvikas888@gmail.com";
        # Sender Data
    
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $url = filter_var(trim($_POST["website"]), FILTER_SANITIZE_URL);
        $phone = filter_var(trim($_POST['phone']));

        // If you want to clean it up manually you can:
        $phone = preg_replace('/[^0-9+-]/', '', $_POST['phone']);

        // If you want to check the length of the phone number and that it's valid you can:
        if(strlen($phone) == 10 or (strlen($phone) == 11) or strlen($phone) == 12) {
            if (preg_match('/^[0-9-+]$/',$var)) { 
                        http_response_code(400);
                        echo "$phone is not valid. Phone number should be 10 digit number. Special characters are not allowed.";
                        exit();
            }
        }
        else {
            echo ("$phone is not valid");
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            echo("$url is not a valid URL");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            http_response_code(400);
            echo "$email is not valid email address. Please enter valid email id.";
            exit;
        }   
        
        if ( empty($name) OR empty($email) OR empty($phone) OR empty($url)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }
        
        # Mail Content
        $content = "Name: $name\n";
        $content .= "Email: $email\n\n";
        $content .= "Phone:\n$phone\n";
        $content .= "URL:\n$url\n";
        $subject = "Mail from request form from " . $email;

        # email headers.
        $headers = "From:" . $email;

        # Send the email.
        # $success = mail($mail_to,$content, $headers);
        $success = mail($mail_to,$subject,$content,$headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't send your message.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
