<?php

  include_once 'scripts/OnDemandObjects.php';
  include_once 'scripts/OnDemandServices.php';
  include_once 'scripts/DatabaseController_Comment.php';
  include_once 'scripts/DatabaseController_User.php';
  include_once 'scripts/DatabaseController_Media.php';
  include_once 'scripts/DatabaseController_OdClass.php';
  include_once 'scripts/DatabaseController_Post.php';


echo "<pre>
	--
	 *
	 * TA
	 *
	 -
	</pre>";
  $email = '$email'.time();

  $ta = createOdTa(new OdTA('$id', array(2, 7), '$name', $email, '$password', '$active', '$admin', '$info', '$picture4' . time()));

  if ($ta){
    formattedPrint($ta,'formattedPrint($ta);');
    formattedPrint(getOdTaById($ta->getId()),'formattedPrint(getOdTaById($ta->getId());');
  }  else
    echo 'null';

  echo "<br /><br />$email is unique: " . unique_email_db($email);
  $email .= "_new";
  echo "<br /><br />$email is unique: " . unique_email_db($email);

  formattedPrint(get_all_tas_db(), "formattedPrint(get_all_tas_db());");

  formattedPrint(get_all_tas_db(4), "formattedPrint(get_all_tas_db(4));");

  formattedPrint(get_all_tas_db(7), "formattedPrint(get_all_tas_db(7));");

  if ($ta){
    formattedPrint($ta,'formattedPrint($ta);');
    formattedPrint(getOdTaById($ta->getId()),'formattedPrint(getOdTaById($ta->getId());');
  }  else
    echo 'null';

  echo "<br /><br />$email is unique: " . unique_email_db($email);
  $email .= "_new";
  echo "<br /><br />$email is unique: " . unique_email_db($email);



echo "<pre>
	--
	 *
	 * MEDIA
	 *
	 -
	</pre>";
  $media = create_media_db(new OdMedia(-1, date('dMYHis') . 'filename.smp', 0, 1, 1), '1332');

  if ($media){
    formattedPrint($media,'formattedPrint($media);');
    formattedPrint(get_media_byId_db($media->getId(), '1332'),'formattedPrint(get_media_byId($media->getId()));');
  }  else
    echo 'null';

  // get_all_media_db($class, $postId, $taId, $rating, $ratingComp);
  formattedPrint(get_all_media_db("1332", 1, 0, 0, 0), "get_all_media_db('1332', 1, 0, 0, 0);");
  formattedPrint(get_all_media_db("1332", 0, 1, 0, 0), "get_all_media_db('1332', 0, 1, 0, 0);");

echo "<pre>
	--
	 *
	 * COMMENT
	 *
	 -
	</pre>";
  $comment = create_comment_db(new OdComment(-1, 1, 1, 0, 'This is a sample comment with embedded <i>html</i>.'), '1332');

  if ($comment){
    formattedPrint($comment,'formattedPrint($comment);');
    formattedPrint(get_media_byId_db($comment->getId(), '1332'),'formattedPrint(get_media_byId($comment->getId()));');
  }  else
    echo 'null';


  formattedPrint(get_all_comments_db("1332", 1, 0, 0, 0), "get_all_comments_db('1332', 1, 0, 0, 0);");
  formattedPrint(get_all_comments_db("1332", 0, 1, 0, 0), "get_all_comments_db('1332', 0, 1, 0, 0);");

echo "<pre>
	--
	 *
	 * POST
	 *
	 -
	</pre>";
  $post = create_post_db(new OdPost(-1, "Sample Post", "Sample Description", $ta->getId(), "Insertion"), '1332');

  if ($post){
    formattedPrint($post,'formattedPrint($post);');
    formattedPrint(get_media_byId_db($post->getId(), '1332'),'formattedPrint(get_media_byId($post->getId()));');
  }  else
    echo 'null';


  formattedPrint(get_all_posts_db("1332", "Insertion"), "get_all_posts_db('1332', 'Insertion');");
  formattedPrint(get_all_posts_db("1332", "Removal"), "get_all_posts_db('1332', 'Removal');");


echo "<pre>
	--
	 *
	 * CLASS
	 *
	 -
	</pre>";
  $number = 1332;

  $class = create_class_db(new OdClass(-1, "CS", $number, "Random Class", "Brand new!!! Take Now!!!"));

  if ($class){
    formattedPrint($class,'formattedPrint($class);');
    formattedPrint(get_class_byId_db($class->getId()),'formattedPrint(get_class_byId_db($class->getId());');
    formattedPrint(get_class_byNumber_db($class->number),'formattedPrint(get_class_byNumber_db($class->number);');
  }  else
    echo 'null';

  formattedPrint(get_all_classes_db(), "formattedPrint(get_all_classes_db());");

	/**
	 *
	 * OTHER
	 *
	 */
  function formattedPrint($obj, $header) {
    echo "<br /><h2>$header</h2><div style='border:1px solid #000;'><pre>";
    print_r($obj);
    echo '</pre></div><br />';
  }
?>
