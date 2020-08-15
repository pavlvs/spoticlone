<?php
function stickyInput($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

if (isset($_POST['loginButton'])) {
    // Login button was pressed
    //$account = new Account();

    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $result = $account->login($username, $password);

    if ($result) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location:index.php?action=browse");
        exit;
    }
}

if (isset($_POST['registerButton'])) {
    // register button was pressed
    //$account = new Account();
    $validate = new Validator();

    $data = [];

    $data['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $data['firstName'] = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $data['lastName'] = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $data['email1'] = filter_input(INPUT_POST, 'email1', FILTER_VALIDATE_EMAIL);
    $data['email2'] = filter_input(INPUT_POST, 'email2', FILTER_VALIDATE_EMAIL);
    $data['password1'] = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
    $data['password2'] = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

    // validate form data
    $requiredFields = ['username', 'firstName', 'lastName', 'email1', 'email2',  'password1', 'password2'];
    if (!$validate->isRequired($requiredFields)) {
        header("Location:index.php?action=register");
        exit;
    } else {
        $success = $account->register($data['username'], $data['firstName'], $data['lastName'], $data['email1'], $data['email2'], $data['password1'], $data['password2']);
        if ($success) {
            $_SESSION['userLoggedIn'] = $data['username'];
            header("Location:index.php?action=browse");
            exit;
        }
    }
}
