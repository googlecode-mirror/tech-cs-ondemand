<?php

  include_once "OnDemandObjects.php";

  // A lot of these functions return dummy data for testing
  
  function getOdClassById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdClass($id, 'CS', 1332, 'Data Structures and Algorithms', 'This is an example class with embedded <b>html</b>.');
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
    return new OdPost($id, 'Example Post', 'This is an example post with embedded <i>html</i>.', 1, 'topic');
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

  /**
   * @return a 2D array of classes categorized into sub-arrays for each subject
   */
  function getAllOdClasses() {
	$result = array();
	$classes = array();
	
	$class = new OdClass(10, 'CS', 1332, 'Data Structures and Algorithms', 'This is an example class with embedded <b>html</b>.');
	$classes[] = $class;
	
	$class = new OdClass(11, 'CS', 1331, 'Intro to Object-Oriented Programming', 'This is an example class with embedded <b>html</b>.');
	$classes[] = $class;
	
	$class = new OdClass(14, 'CS', 2340, 'Objects and Design', 'This is an example class with embedded <b>html</b>.');
	$classes[] = $class;
	
	$class = new OdClass(12, 'CS', 2110, 'Computer Organization and Programming', 'bla, bla, bla');
	$classes[] = $class;
	
	$class = new OdClass(13, 'CS', 2200, 'Systems and Networks', 'hey, hey, hey');
	$classes[] = $class;
	
	// in the actual implementation, the DB query should return the data sorted by course number
	usort($classes, array("OdClass", "compare"));
	$result[] = $classes;
	
	$classes = array();
	
	$class = new OdClass(16, 'MATH', 1502, 'Calculus II', 'math');
	$classes[] = $class;
	
	$class = new OdClass(18, 'MATH', 3215, 'Probability and Statistics', 'math');
	$classes[] = $class;
	
	$class = new OdClass(17, 'MATH', 3215, 'Applied Combinatorics', 'math');
	$classes[] = $class;
	
	usort($classes, array("OdClass", "compare"));
	$result[] = $classes;
	
	$classes = array();
	
	$class = new OdClass(15, 'PHYS', 2212, 'Electricity and Magnetism', 'This is an example class with embedded <b>html</b>.');
	$classes[] = $class;
	
	usort($classes, array("OdClass", "compare"));
	$result[] = $classes;
	
    return $result;
  }

  function getAllOdTAs() {
    // TODO
    return array(getOdTaById(10), getOdTaById(14), getOdTaById(15));
  }
?>