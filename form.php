<?php
    
    $message_sent = false;
    $errors ='';

      if (isset($_POST["email"]) && $_POST["email"] !="") {

        if(empty($_POST['name'])||empty($_POST['email']))
        {
            $errors .= "\n Name and Email are required fields. ";   
        }
        if(IsInjected($visitor_email))
        {
            $errors .= "\n Bad email value!";
        }

        if (empty($errors)){
            
            # submit form data...
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $email_to = "contact@itmark-us.com";//replace with your email
            $headers = "From: " .$email;
            $txt = "You have received an email from " .$firstName .$lastName. "\n" ."\n" .$message;

            mail($email_to, $subject, $txt, $headers);
            
            $message_sent = true;
        }
    }

    function IsInjected($str)
    {
      $injections = array('(\n+)',
                  '(\r+)',
                  '(\t+)',
                  '(%0A+)',
                  '(%0D+)',
                  '(%08+)',
                  '(%09+)'
                  );
      $inject = join('|', $injections);
      $inject = "/$inject/i";
      if(preg_match($inject,$str))
        {
        return true;
      }
      else
        {
        return false;
      }
    }
?>
