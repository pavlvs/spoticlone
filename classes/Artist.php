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
		$songIds = $this->db->resultset();

		$array = [];
		foreach ($songIds as $songId) {
			array_push($array, $songId);
		}

		return $array;
	}
}
