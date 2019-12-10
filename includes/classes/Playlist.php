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

        if (!is_array($data)) {
            //dat is an id string
            $query = mysqli_query($con, "SELECT * FROM playlists WHERE id='$data'");
            $data = mysqli_fetch_array($query);
        }
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

    public function getNumberOfSongs() { # code...
        $query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id'");
        return mysqli_num_rows($query);
    }
}
?>