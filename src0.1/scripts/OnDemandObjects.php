<?php

class OdClass {

  private $id;
  public $title;
  public $description;
  public $alias;		// how the link will display to the user GET variables
  public $type;		// Class category (for now, 0=CS, 1=MATH, 2=PHYS)
  public $order;	// lower comes first (just use course numbers)

  function __construct($id, $title, $description, $alias, $type, $order){
                $this->id = $id;
                $this->title = $title;
                $this->description = $description;
                $this->alias = $alias;
                $this->type = $type;
				$this->order = $order;
        }

  function getId() {
    return $this->id;
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
  
  static function compare($a, $b)
  {
	return $a->order - $b->order;
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
    return $this->id;
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
  public $topic;

  function __construct($id, $title, $description, $taid, $tag, $topic, $created = 0, $lastModified = 0) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->created = $created ? $created : date_create(date('D, d M Y H:i:s'));
    $this->lastModified = $lastModified ? $lastModified : $this->created;
    $this->taid = $taid;
    $this->tag = $tag;
	$this->topic = $topic;
  }

  function getId() {
    return $this->id;
  }

  function getCreated() {
    return $this->created;
  }

  function getLastModified() {
    return $this->lastModified;
  }

  function getTAid() {
    return $this->taid;
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

  function __construct($id, $filename, $type, $taid, $postid, $created = 0, $lastModified = 0) {
    $this->id = $id;
    $this->filename = $filename;
    $this->type = $type;
    $this->created = $created ? $created : date_create(date('D, d M Y H:i:s'));
    $this->lastModified = $lastModified ? $lastModified : $this->created;
    $this->taid = $taid;
    $this->postid = $postid;
  }

  function getId() {
    return $this->id;
  }

  function getCreated() {
    return $this->created;
  }

  function getLastModified() {
    return $this->lastModified;
  }

  function getTAid() {
    return $this->taid;
  }

  function getPostid() {
    return $this->taid;
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

  function __construct($id, $postid, $taid, $rating, $comment, $created = 0, $lastModified = 0) {
    $this->id = $id;
    $this->postid = $postid;
    $this->taid = $taid;
    $this->created = $created ? $created : date_create(date('D, d M Y H:i:s'));
    $this->lastModified = $lastModified ? $lastModified : $this->created;
    $this->rating = $rating;
    $this->comment = $comment;
  }

  function getId() {
    return $this->id;
  }

  function getCreated() {
    return $this->created;
  }

  function getLastModified() {
    return $this->lastModified;
  }

  function getTAid() {
    return $this->taid;
  }

  function getPostid() {
    return $this->postid;
  }

  function getRating() {
    return $this->rating;
  }

  function voteUp() {
    return ++$this->rating;
  }

  function voteDown() {
    return --$this->rating;
  }

  function isDisplayed() {
    return $this->rating >= $this->displayThreshold;
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