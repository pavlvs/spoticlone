<?php
class Song
{
	private $db;
	private $id;
	private $data;
	private $title;
	private $artistId;
	private $albumId;
	private $genre;
	private $duration;
	private $path;

	public function __construct($id)
	{
		$this->db = new Database();
		$this->id = $id;
		$songId = intval($this->id);

		$sql = "SELECT *
				FROM songs
				WHERE id=:id";

		$this->db->query($sql);
		$this->db->bind(':id', $songId);
		$this->data = $this->db->single();
		$this->title = $this->getData()->title;
		$this->artistId = $this->getData()->artist;
		$this->albumId = $this->getData()->album;
		$this->genre = $this->getData()->genre;
		$this->duration = $this->getData()->duration;
		$this->path = $this->getData()->path;
	}
	public function getData()
	{
		return $this->data;
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

	public function getAlbum()
	{
		return new Album($this->albumId);
	}

	public function getGenre()
	{
		return $this->genre;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function getPath()
	{
		return $this->path;
	}
}
