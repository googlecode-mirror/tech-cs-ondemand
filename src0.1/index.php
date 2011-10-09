<?php

  include_once 'scripts/OnDemandObjects.php';
  include_once 'scripts/OnDemandServices.php';

  formattedPrint(getOdClassById(10), 'formattedPrint(getOdClassById(10));');
  formattedPrint(getOdTaById(10),'formattedPrint(getOdTaById(10));');
  formattedPrint(getOdPostById(10),'formattedPrint(getOdPostById(10));');
  formattedPrint(getOdMediaById(10),'formattedPrint(getOdMediaById(10));');
  formattedPrint(getOdCommentById(10),'formattedPrint(getOdCommentById(10));');
  formattedPrint(getAllOdClasses(),'formattedPrint(getAllOdClasses());');
  formattedPrint(getAllOdTAs(),'formattedPrint(getAllOdTAs());');

  function formattedPrint($obj, $header) {
    echo "<br />$header<div style='border:1px solid #000;'><pre>";
    print_r($obj);
    echo '</pre></div><br />';
  }
?>