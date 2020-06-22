<?php
function checkInput($data)
{
    if (!empty($data)) {
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        $data = trim($data);
        return $data;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['contact_form']) && !empty($_POST['contact_form'])) {
        $sender_name = $sender_email = $sender_message = '';
        if (!empty($_POST['sender_name'])) {
            $sender_name = checkInput($_POST['sender_name']);
            if (strlen($sender_name) < 4) {
                die(json_encode(array('error' => 'Please enter full name.')));
            }
        } else {
            die(json_encode(array('error' => 'Full name is required.')));
        }
        if (!filter_var($_POST['sender_email'], FILTER_VALIDATE_EMAIL)) {
            die(json_encode(array('error' => 'A valid email is required.')));
        } else {
            $sender_email = checkInput($sender_email);
        }
        if (!empty($_POST['sender_message'])) {
            $sender_message = $_POST['sender_message'];
            if (strlen($sender_message) < 10) {
                die(json_encode(array('error' => 'Message content is too short.')));
            }
        } else {
            die(json_encode(array('error' => 'Message is required.')));
        }
        $_SESSION['sender_name'] = $sender_name;
        $_SESSION['sender_email'] = $sender_email;
        $_SESSION['sender_message'] = $sender_message;
        die(json_encode(array('valid' => true)));
    }
}
?>