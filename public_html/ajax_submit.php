<?php
// Admin recipient email id
$toEmail = 'info@la-fa.org';

$status = 0;
$statusMsg = 'Oops! Something went wrong! Please try again late.';
if(isset($_POST['contact_submit'])){
    // Get the submitted form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];
    
    // Check whether submitted data is not empty
    if(!empty($email) && !empty($name) && !empty($message)){
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'Please enter a valid email.';
        }else{
            $emailSubject = 'Contact Request Submitted by '.$name;
            $htmlContent = '<h2>Contact Request Submitted</h2>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Message</h4><p>'.$imessage.'</p>';
            
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Additional headers
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";
            
            // Send email
            $sendEmail = mail($toEmail, $emailSubject, $htmlContent, $headers);
            if($sendEmail){
                $status = 1;
                $statusMsg = 'Thanks! Your contact request has been submitted successfully.';
            }else{
                $statusMsg = 'Failed! Your  request submission failed, please try again.';
            }
        }
    }else{
        $statusMsg = 'Please fill in all the mandatory fields.';
    }
}

$response = array(
    'status' => $status,
    'message' => $statusMsg
);
echo json_encode($response);
?>