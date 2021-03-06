<?php

/**
 * Artist
 */
class Album
{
	private $db;
	private $id;
	private $title;
	private $artistId;
	private $genre;
	private $artworkPath;

	public function __construct($id)
	{
		$this->db = new Database();
		$this->id = $id;
		$sql = "SELECT *
				FROM albums
				WHERE id='$this->id'";
		$this->db->query($sql);
		$album = $this->db->single();
		if ($album) {
			$this->title = $album->title;
			$this->artistId = $album->artist;
			$this->genre = $album->genre;
			$this->artworkPath = $album->artworkPath;
		}
	}

	public function getRandomAlbums($number)
	{
		$sql = "SELECT *
			FROM `albums`
			ORDER BY rand()
            LIMIT $number";

		$this->db->query($sql);
		$albums = $this->db->resultset();
		return $albums;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getArtist()
	{
		return new Artist($this->artistId);
	}

	public function getGenre()
	{
		return $this->genre;
	}

	public function getArtwork()
	{
		return $this->artworkPath;
	}

	public function getNumberOfSongs()
	{
		$sql = "SELECT id
				FROM songs
				WHERE album='$this->id'";
		$this->db->query($sql);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getSongIds()
	{
		$sql = "SELECT id
				FROM songs
				WHERE album='$this->id'
				ORDER BY albumOrder ASC";
		$this->db->query($sql);
		$albums = $this->db->resultset();
		$array = [];
		foreach ($albums as $album) {
			array_push($array, $album->id);
		}
		return $array;
	}
}
