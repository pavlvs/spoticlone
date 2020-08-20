<?php
class Artist
{
	private $db;
	private $id;

	public function __construct($id)
	{
		$this->db = new Database();
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		$sql = "SELECT name
				FROM artists
				WHERE id=$this->id";

		$this->db->query($sql);
		$artist = $this->db->single();
		return $artist->name;
	}

	public function getSongIds()
	{
		$sql = "SELECT id
				FROM songs
				WHERE artist='$this->id'
				ORDER BY plays ASC";

		$this->db->query($sql);
		$songs = $this->db->resultset();
		$array = [];
		foreach ($songs as $song) {
			array_push($array, $song->id);
		}

		return $array;
	}

	public function getAlbums()
	{
		$sql = "SELECT *
				FROM albums
				WHERE artist='$this->id'
				ORDER BY title ASC";

		$this->db->query($sql);
		$albums = $this->db->resultset();

		$array = [];
		foreach ($albums as $album) {
			array_push($array, $album);
		}

		return $array;
	}
}
