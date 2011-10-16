<?php

  include_once 'scripts/OnDemandObjects.php';
  include_once 'scripts/OnDemandServices.php';
  include_once 'scripts/DatabaseController_Comment.php';
  include_once 'scripts/DatabaseController_Media.php';

  $com = create_comment_db(new OdComment($id, 1, 1, 0, 'This is a sample comment with embedded <i>html</i>.'), '1332');

  if ($com){
    formattedPrint($com,'formattedPrint($com);');
    formattedPrint(get_comment_byId_db($com->getId(), '1332'),'formattedPrint(get_comment_byId($com->getId()));');
  }  else
    echo 'null';

  $media = create_media_db(new OdMedia(-1, date('dMYHis') . 'filename.smp', 0, 1, 1), '1332');

  if ($media){
    formattedPrint($media,'formattedPrint($media);');
    formattedPrint(get_media_byId_db($media->getId(), '1332'),'formattedPrint(get_media_byId($media->getId()));');
  }  else
    echo 'null';

  function formattedPrint($obj, $header) {
    echo "<br /><h2>$header</h2><div style='border:1px solid #000;'><pre>";
    print_r($obj);
    echo '</pre></div><br />';
  }
?>