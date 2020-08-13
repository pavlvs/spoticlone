<?php

/**
 *
 */
class Playlist
{
    private $db;
    private $id;
    private $name;
    private $owner;

    public function __construct($db, $data)
    {

        if (!is_array($data)) {
            //dat is an id string
            $query = mysqli_query($db, "SELECT * FROM playlists WHERE id='$data'");
            $data = mysqli_fetch_array($query);
        }
        $this->db = $db;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];
    }

    public function getId()
    { # code...
        return $this->id;
    }
    public function getName()
    { # code...
        return $this->name;
    }

    public function getOwner()
    { # code...
        return $this->owner;
    }

    public function getNumberOfSongs()
    { # code...
        $query = mysqli_query($this->db, "SELECT songId FROM playlistsongs WHERE playlistId='$this->id'");
        return mysqli_num_rows($query);
    }

    public function getSongIds()
    {
        $query = mysqli_query($this->db, "SELECT songId FROM playlistsongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");
        $array = array();
        while ($row = mysqli_fetch_array($query)) {
            array_push($array, $row['songId']);
        }
        return $array;
    }
}
