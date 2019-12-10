<?php
/**
 *
 */
class Playlist {
    private $con;
    private $id;
    private $name;
    private $owner;

    public function __construct($con, $data) {
        $this->con = $con;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];
    }

    public function getId() { # code...
        return $this->id;
    }
    public function getName() { # code...
        return $this->name;
    }

    public function getOwner() { # code...
        return $this->owner;
    }
}
?>