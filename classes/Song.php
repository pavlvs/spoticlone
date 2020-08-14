<?php

/**
 * Artist
 */
class Song
{
	private $db;
	private $id;
	private $mysqliData;
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
		$sql = "SELECT *
				FROM songs
				WHERE id='$this->id'";

		$this->db->query($sql);
		$this->mysqliData = $this->db->resultset();
		$this->title = $this->mysqliData->title;
		$this->artistId = $this->mysqliData->artist;
		$this->albumId = $this->mysqliData->album;
		$this->genre = $this->mysqliData->genre;
		$this->duration = $this->mysqliData->duration;
		$this->path = $this->mysqliData->path;
	}
	public function getMysqliData()
	{
		return $this->mysqliData;
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
