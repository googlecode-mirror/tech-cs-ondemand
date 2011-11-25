<?php

class OdClass {

  private $id; // unique integer id for DB
  
  public $subject; // shortened course subject prefix [eg: CS, MATH, PHYS, etc]
  public $number; // 4-digit course number [eg: 1332]
  public $title; // full class name [eg: Data Structures and Algorithms]
  public $description; // displayed on class page w/ embedded HTML

  function __construct($id, $subject, $number, $title, $description){
                $this->id = $id;
		$this->subject = $subject;
		$this->number = $number;
                $this->title = $title;
                $this->description = $description;
  }

  function getId() {
    return $this->id;
  }

  function saveToDb() {
    // TODO
  }

  function getAllTags() {
	return get_all_tags_db($this->number);
  }

  function getAllPostsForTag($tag) {
	return get_all_posts_db($this->number, $tag);
  }

  /**
   * @return a 2D array of posts where each subarray corresponds to a topic
   *         ordering within each subarray (topic) is yet to be determined
   *         suggested orderings: alphabetical, difficulty, temporal
   */
  function getAllPosts() {
	$rtn = array();
	$tags = $this->getAllTags();
	for ($i=0;$i<count($tags);$i++)
		$rtn[] = $this->getAllPostsForTag($tags);
	return $rtn;
  }

  function getAllTAs() {
    // TODO
  }
  
  static function compare($a, $b)
  {
	return $a->number - $b->number;
  }
}

class OdTA {

  private $id;
  public $classId;		// array()
  public $name;
  public $email;
  public $password;		// md5 hashed
  public $active;
  public $admin;
  public $info;
  public $picture;

  function __construct($id, $classId, $name, $email, $password, $active, $admin, $info, $picture){
    $this->id	= $id;
    $this->classId	= $classId;	// array()
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

  function addClass($newClassId) {
	$this->classId[] = $newClassId;
	$con = connectToDB();
	update_ta_add_class_db($this->id, $newClassId);
	breakCon($con);
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
  public $topic; // ONE category this post belongs to [eg: AVL Trees, Hash Tables, etc]
  
  //public $tags; // perhaps in the future we will have each post have searchable tags

  function __construct($id, $title, $description, $taid, $topic, $created = 0, $lastModified = 0) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
	$this->taid = $taid;
	$this->topic = $topic;
    $this->created = $created ? $created : date_create(date('D, d M Y H:i:s'));
    $this->lastModified = $lastModified ? $lastModified : $this->created;
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
    return get_ta_byId_db($this->taid);
  }

  function saveToDb() {
    // TODO
  }

  function getAllComments($classNumber) {
    return get_all_comments_db($classNumber, $this->id, $this->taid);
  }

  function getAllMedia($classNumber) {
    return get_all_media_db($class, $this->id, $this->taid);
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
    return get_ta_byId_db($this->taid);
  }

  function getPost($classNumber) {
    return get_post_byId_db($this->postid);
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
    return get_ta_byId_db($this->taid);
  }

  function getPost($classNumber) {
    return get_post_byId_db($this->postid);
  }

  function saveToDb() {
    // TODO
  }
}

?>
