<?php

  include_once "OnDemandObjects.php";

  function getOdClassById($id) {
    if ($id <= 0)
      return 0;
    // TODO
    return new OdClass($id, 'Example Title', 'This is an example class with embedded <i>html</i>.', 'CS #Sample#', 'Example Category');
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
    return new OdPost($id, 'Example Post', 'This is an example post with embedded <i>html</i>.', 1, 'example');
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
    // TODO
    return array(getOdClassById(10), getOdClassById(14), getOdClassById(15));
  }

  function getAllOdTAs() {
    // TODO
    return array(getOdTaById(10), getOdTaById(14), getOdTaById(15));
  }
?>