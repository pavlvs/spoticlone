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

    public function __construct($data)
    {
        $this->db = new Database();

        if (!is_object($data)) {
            //data is an id string
            $sql = "SELECT *
                    FROM playlists
                    WHERE id=':data";
            $this->db->query($sql);
            $this->db->bind(':data', $data);
            $data = $this->db->single();
        }
        $this->id = $data->id;
        $this->name = $data->name;
        $this->owner = $data->owner;
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
        $sql = "SELECT songId
                FROM playlistsongs
                WHERE playlistId='$this->id'";

        $this->db->query($sql);
        $this->db->resultset();
        return $this->db->rowCount();
    }

    public function getSongIds()
    {
        $sql = "SELECT songId
                FROM playlistsongs
                WHERE playlistId='$this->id'
                ORDER BY playlistOrder ASC";

        $this->db->query($sql);
        $songIds = $this->db->resultset();
        $array = [];
        foreach ($songIds as $songId) {
            array_push($array, $songId);
        }
        return $array;
    }
}
