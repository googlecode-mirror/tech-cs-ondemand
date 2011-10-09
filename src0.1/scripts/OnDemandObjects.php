<?php

class OdClass {

  private $id;
  public $title;
  public $description;
  public $alias;		// how the link will display to the user GET variables
  public $type;		// I don't know what this is

  function __construct($id, $title, $description, $alias, $type){
                $this->id = $id;
                $this->title = $title;
                $this->description = $description;
                $this->alias = $alias;
                $this->type = $type;
        }

  function getId() {
    return $id;
  }

  function saveToDb() {
    // TODO
  }

  function getAllPosts($enum) {
    // TODO
  }

  function getAllTAs() {
    // TODO
  }
}

class OdTA {

  private $id;
  public $classId;
  public $name;
  public $email;
  public $password;		// md5 hashed
  public $active;
  public $admin;
  public $info;
  public $picture;

  function __construct($id, $classId, $name, $email, $password, $active, $admin, $info, $picture){
    $this->id	= $id;
    $this->classId	= $classId;
    $this->name	= $name;
    $this->email	= $email;
    $this->password = $password;
    $this->active	= $active;
    $this->admin	= $admin;
    $this->info	= $info;
    $this->picture	= $picture;
  }

  function getId() {
    return $id;
  }

  function saveToDb() {
    // TODO
  }

  function getClass() {
    // TODO
  }

  function getAllPosts() {
    // TODO
  }
}

class OdPost {
  // private
  private $id;
  private $created;
  private $lastModified;
  private $taid;

  // public
  public $title;
  public $description;
  public $tag;

  function __construct($id, $title, $description, $created, $lastModified, $taid, $tag) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->created = $created;
    $this->lastModified = $lastModified;
    $this->taid = $taid;
    $this->tag = $tag;
  }

  function getId() {
    return $id;
  }

  function getCreated() {
    return $created;
  }

  function getLastModified() {
    return $lastModified;
  }

  function getTAid() {
    return $taid;
  }

  function getTA() {
    // TODO
  }

  function saveToDb() {
    // TODO
  }

  function getAllComments() {
    // TODO
  }

  function getAllMedia() {
    // TODO
  }
}

abstract class SupportedFileType {
  const PICTURE	= 0;
  const VIDEO	= 1;
  const AUDIO	= 2;
  const TXT	= 3;
  const JAVA	= 4;
  const PYTHON	= 5;

  // access like an enum:
  //	if($type == SupportedFileType::PICTURE)
}

class OdMedia {
  // private
  private $id;
  private $created;
  private $lastModified;
  private $taid;
  private $postid;

  // public
  public $filename;
  public $type; 	// of SupportedFileType

  function __construct($id, $filename, $type, $created, $lastModified, $taid, $postid) {
    $this->id = $id;
    $this->filename = $filename;
    $this->type = $type;
    $this->created = $created;
    $this->lastModified = $lastModified;
    $this->taid = $taid;
    $this->postid = $postid;
  }

  function getId() {
    return $id;
  }

  function getCreated() {
    return $created;
  }

  function getLastModified() {
    return $lastModified;
  }

  function getTAid() {
    return $taid;
  }

  function getPostid() {
    return $taid;
  }

  function getTA() {
    // TODO
  }

  function getPost() {
    // TODO
  }

  function saveToDb() {
    // TODO
  }
}

class OdComment {

  const displayThreshold = -4;

  // private
  private $id;
  private $postid;
  private $taid;
  private $created;
  private $lastModified;
  private $rating;

  // public
  public $comment;

  function __construct($id, $postid, $taid, $created, $lastModified, $rating, $comment) {
    $this->id = $id;
    $this->postid = $postid;
    $this->taid = $taid;
    $this->created = $created;
    $this->lastModified = $lastModified;
    $this->rating = $rating;
    $this->comment = $comment;
  }

  function getId() {
    return $id;
  }

  function getCreated() {
    return $created;
  }

  function getLastModified() {
    return $lastModified;
  }

  function getTAid() {
    return $taid;
  }

  function getPostid() {
    return $taid;
  }

  function getRating() {
    return $rating;
  }

  function voteUp() {
    return ++$rating;
  }

  function voteDown() {
    return --$rating;
  }

  function isDisplayed() {
    return $rating >= $displayThreshold;
  }

  function getTA() {
    // TODO
  }

  function getPost() {
    // TODO
  }

  function saveToDb() {
    // TODO
  }
}
?>