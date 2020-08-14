<?php
class Validator
{
    private $errorArray;
    private $db;

    public function __construct()
    {
        $this->errorArray = [];
        $this->db = new Database();
    }

    public function isRequired($fieldArray)
    {
        foreach ($fieldArray as $field) {
            if ($_POST['' . $field . ''] == '') {
                return false;
            }
        }
        return true;
    }

    public function isValidEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function username($un)
    {
        if (strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }
        $sql = "SELECT username
                FROM users
                where username = :un";
        $this->db->query($sql);
        $this->db->bind(':un', $un);
        $this->db->execute();
        if ($this->db->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }

    public function firstName($fn)
    {
        # code...
        if (strlen($fn) > 25 || strlen($fn) < 2) {
            // do not register
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }
    }

    public function lastName($ln)
    {
        # code...
        if (strlen($ln) > 25 || strlen($ln) < 2) {
            // do not register
            array_push($this->errorArray, Constants::$lastNameCharacters);

            return;
        }
    }

    public function emails($em1, $em2)
    {
        # code...
        if ($em1 != $em2) {
            // do not register
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }
        if (!filter_var($em1, FILTER_VALIDATE_EMAIL)) {
            // do not register
            array_push($this->errorArray, Constants::$invalidEmail);
            return;
        }
        $sql = "SELECT email
                FROM users
                where email = :em";
        $this->db->query($sql);
        $this->db->bind(':em', $em1);
        $this->db->execute();
        if ($this->db->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    public function passwords($pw1, $pw2)
    {
        if ($pw1 != $pw2) {
            // do not register
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }
        if (preg_match('/[^A-Za-z0-9]/', $pw1)) {
            array_push($this->errorArray, Constants::$passwordsCharacters);
            return;
            # code...
        }
        if (strlen($pw1) > 30 || strlen($pw1) < 5) {
            // do not register
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }
    }

    public function loginError()
    {
        array_push($this->errorArray, Constants::$loginFailed);
    }

    public function getError($error)
    {
        //exit;
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        $span = '<span class="errorMessage">foo</span><br>';
        echo "<span class='errorMessage'>$error</span>";
    }

    public function hasErrors()
    {
        return count($this->errorArray);
    }
}
