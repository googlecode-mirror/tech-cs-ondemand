<?php

  include_once "OnDemandObjects.php";
  
  // A map from class type (as number) to header name
  $CLASS_NAMES = array(
	  0 => "Computer Science",
	  1 => "Mathemagics",
	  2 => "Physics"
  );

  function getOdClassById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdClass($id, 'Data Structures and Algorithms', 'This is an example class with embedded <b>html</b>.', 'CS 1332', 0, 1332);
  }

  function getOdTaById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdTA($id, 1, 'Example TA', 'ta@ta.com', md5(5), 1, 0, 'This is an example "About Me" with embedded <i>html</i>.', 'sampleImage.jpg');
  }

  function getOdPostById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdPost($id, 'Example Post', 'This is an example post with embedded <i>html</i>.', 1, 'example', 'topic');
  }

  function getOdMediaById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdMedia($id, 'samepleFile.ex', 0, 1, 1);
  }

  function getOdCommentById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdComment($id, 1, 1, 0, 'This is a sample comment with embedded <i>html</i>.');
  }

  function getAllOdClasses() {
	$result = array(); // 2-D array of classes categorized into sub-arrays for each subject	
	$classes = array();
	
	$class = new OdClass(10, 'Data Structures and Algorithms', 'This is an example class with embedded <b>html</b>.', 'CS 1332', 0, 1332);
	$classes[] = $class;
	
	$class = new OdClass(11, 'Intro to Object-Oriented Programming', 'This is an example class with embedded <b>html</b>.', 'CS 1331', 0, 1331);
	$classes[] = $class;
	
	$class = new OdClass(14, 'Objects and Design', 'This is an example class with embedded <b>html</b>.', 'CS 2340', 0, 2340);
	$classes[] = $class;
	
	$class = new OdClass(12, 'Computer Organization and Programming', 'bla, bla, bla', 'CS 2110', 0, 2110);
	$classes[] = $class;
	
	$class = new OdClass(13, 'Systems and Networks', 'hey, hey, hey', 'CS 2200', 0, 2200);
	$classes[] = $class;
	
	usort($classes, array("OdClass", "compare"));
	$result[] = $classes;
	
	$classes = array();
	
	$class = new OdClass(16, 'Calculus II', 'math', 'MATH 1502', 1, 1502);
	$classes[] = $class;
	
	$class = new OdClass(18, 'Probability and Statistics', 'math', 'MATH 3215', 1, 3215);
	$classes[] = $class;
	
	$class = new OdClass(17, 'Applied Combinatorics', 'math', 'MATH 3012', 1, 3012);
	$classes[] = $class;
	
	usort($classes, array("OdClass", "compare"));
	$result[] = $classes;
	
	$classes = array();
	
	$class = new OdClass(15, 'Physics II - Electricity and Magnetism', 'This is an example class with embedded <b>html</b>.', 'PHYS 2212', 2, 2);
	$classes[] = $class;
	
	usort($classes, array("OdClass", "compare"));
	$result[] = $classes;
	
    return $result;
  }
  
  function getAllPosts($class_id)
  {
	$_uid = 1; // temporary unique ID for testing
	
	$result = array(); // 2D array of posts categorized by sub-arrays for each topic
	
	$topic = array();
	for ($i=0; $i < 5; $i++)
	{
		$post = new OdPost($_uid++, "AVL Trees: Adding", "A quick overview of the steps involved in adding an element to an AVL tree. <i>See <a href=\"\">BST: Adding</a> for more basics</i>", 5, "AVL self-balancing tree binary", "AVL Trees");
		$topic[] = $post;
	}
	$result[] = $topic;
  
	$topic = array();
	for ($i=0; $i < 2; $i++)
	{
		$post = new OdPost($_uid++, "Merge sort", "This post contains a video of a sample merge sort iteration", 5, "merge sort sorting nlogn", "Sorting");
		$topic[] = $post;
	}
	$result[] = $topic;
	
	$topic = array();
	$post = new OdPost($_uid++, "Hash functions", "Principles of a good hash function", 5, "hash functions collisions", "Hash Tables");
	$topic[] = $post;
	$result[] = $topic;
	
	return $result;
  }

  function getAllOdTAs() {
    // TODO
    return array(getOdTaById(10), getOdTaById(14), getOdTaById(15));
  }
?>