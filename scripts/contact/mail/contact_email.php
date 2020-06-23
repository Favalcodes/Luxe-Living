<?php
error_reporting(0);
session_start();
if (isset($_GET['valid']) && !empty($_GET['valid'])) {
    if (isset($_SESSION['sender_name']) && !empty($_SESSION['sender_name'])) {
        $sender_name = $_SESSION['sender_name'];
    }
    if (isset($_SESSION['sender_email']) && !empty($_SESSION['sender_email'])) {
        $sender_email = $_SESSION['sender_email'];
    }
    if (isset($_SESSION['sender_message']) && !empty($_SESSION['sender_message'])) {
        $sender_message = $_SESSION['sender_message'];
    }

    require 'PHPMailerAutoload.php';
    date_default_timezone_set('UTC');

    '<link rel="stylesheet" href="../css/email.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/760c3d66bf.js" crossorigin="anonymous"></script>';

//Contact email configuration
    $contact_email = new PHPMailer;

// TODO: set email server host email address
    $emailfrom = "service@personalizedwineng.com";

    $contact_email->isSMTP();                                      // Set mailer to use SMTP
    $contact_email->Host = 'personalizedwineng.com';  // Specify main and backup SMTP servers
    $contact_email->SMTPAuth = true;                               // Enable SMTP authentication
    $contact_email->Username = 'service@personalizedwineng.com';                 // SMTP username
    $contact_email->Password = 'Personalizedwine123*';                           // SMTP password
    $contact_email->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $contact_email->Port = 465;                                    // TCP port to connect to
    try {
        $contact_email->setFrom($emailfrom);
    } catch (phpmailerException $e) {
    }
    $contact_email->addAddress($sender_email);     // Add a recipient
// $contact_email->addAddress('example@example.com');               // Name is optional
    // $contact_email->addCC('example@example.com');
    $contact_email->isHTML(true);

//    $contact_email->SMTPDebug = 3;
    //    Contact email content
    $contact_email->Body .= '<div class="container margin-top-30">
    <div class="row margin-top-30">
    <!-- BEGIN QUOTE SUMMARY -->
    <div class="col-xs-12 col-md-12 col-lg-12 margin-top-30">
    <div class="grid invoice">
    <div class="grid-body">
        <div class="invoice-title">
            <div class="row" style="background-color: black;">
                <div class="row margin-top-30" style="width: 100%">
                    <div class="col-12"
                         style="text-align:center;padding-top: 20px;width: 100%;height: 90px;">
                        <h3 style="padding-left:3px; padding-top: 20px; padding-right: 3px; color: white;opacity: 1;margin: auto;">Luxe Living</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row margin-top-30">
    <div class="col-md-12" style="width: 100%; overflow: scroll">
    <table class="table table-striped m-t-30"  style=" width:100%; -ms-overflow: scroll; overflow: scroll;">
    <thead><br>
    <tr class="linecrow" style="width: 100%; margin-top: 30px; overflow-x: scroll; text-align: center">
        <td class=" col-xs-12 col-md-12 col-lg-12 text-center"><strong>CONTACT EMAIL INFORMATION</strong></td>
        </tr>
    </thead>
    <tbody><br>
     <tr>
       <td class="text-center col-xs-12 col-md-12 col-lg-12"><strong>Sender Name</strong>: ' . $sender_name . '</td>
     </tr><br>
      <tr>
        <td class="text-center col-xs-12 col-md-12 col-lg-12"><strong>Sender Email</strong>: ' . $sender_email . '</td>
       </tr><br>
        <tr>
          <td class="text-center col-xs-12 col-md-12 col-lg-12"><strong>Message</strong>: <p>' . $sender_message . '</p></td>
         </tr>
        </tbody>
      </table>
                </div>
            </div><br>
            <div class="row margin-top-30">
        <div class="col-12" style="text-align: center">
  <h6>This email was sent from <a href="' . $_SERVER["HTTP_HOST"] . '" class="text-decoration-none">' . $_SERVER["HTTP_HOST"] . '</a> by ( <a href="#">' . $sender_name . '</a> )<br>
</h6></div>
                <div class="col-12"
                     style="display: flex;width: 100%;height: 100px;">
                    <div style="text-align:center;background: rgb(27, 27, 27);width:100%;opacity: 0.5; height: 90px;">
                        <h3 style="padding-top: 20px;color: white;opacity: 1;margin: auto;">Luxe Living</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="width: 100%; margin-top: 15px;">
        <div class="col-12" style="text-align: center; width: 100%">
 &copy; <a href="' . $_SERVER["HTTP_HOST"] . '" class="text-decoration-none">' . $_SERVER["HTTP_HOST"] . '</a> All rights reserved. Made With <span class="human-heart heart">&hearts;</span> ' . date("Y") . '
</div>
</div>
    </div>
    </div>
    
    </div>
    </div>';
    try {
        if (!$contact_email->send()) {
            $msg = "Email was not sent. Please try again.";
            die(json_encode(array('fail' => $msg)));
        } else {
            $msg = "Thanks for your message. We will be in touch.";
            die(json_encode(array('success' => $msg)));
        }
    } catch (phpmailerException $e) {
        //
    }
} else {
    $msg = "Oops! your email was not sent.";
    die(json_encode(array('fail' => $msg)));
} ?>




