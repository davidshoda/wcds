<?php
require_once 'includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
set_time_limit(0);

/*
For WCDS, remove node and node_revisions manually from admin to conserve other content
*/
db_query("truncate {quiz_node_relationship}");
db_query("truncate {quiz_multichoice_properties}");
db_query("truncate {quiz_multichoice_answers}");

db_query("truncate {quiz_long_answer_node_properties}");

db_query("truncate {quiz_question_properties}");
db_query("truncate {quiz_node_properties}");

db_query("
delete from `node` WHERE type IN ('long_answer','quiz','multichoice')
");
db_query("
delete from node_revisions where nid not in (
select nid from `node` WHERE type not IN ('long_answer','quiz','multichoice'))
");
db_query("
delete from node_comment_statistics where nid not in (
select nid from `node` WHERE type not IN ('long_answer','quiz','multichoice'))
");

//exit;//uncomment for deleting all quizzes



$results = db_query("
SELECT n . * , r.body, r.timestamp, r.format
FROM old_node n
LEFT JOIN old_node_revisions r ON n.vid = r.vid
WHERE n.type LIKE 'webform'
");



while($obj = db_fetch_object($results)){
  $node = new StdClass();
  $node->type = 'quiz';
  $node->status = $obj->status;
  $node->created= $obj->created;
  $node->changed= $obj->changed;
  $node->uid= $obj->uid;
  $node->title = $obj->title;
  $node->body = $obj->body;
  $node->timestamp = $obj->timestamp;
  $node->format= $obj->format;


/*

  db_query("UPDATE {node} SET nid=".$obj->nid.",vid=".$obj->vid." WHERE nid = ".$node->nid);
  db_query("UPDATE {node_revisions} SET nid=".$obj->nid.",vid=".$obj->vid." WHERE nid = ".$node->nid);

  db_query("UPDATE {quiz_node_properties} SET nid=".$obj->nid.",vid=".$obj->vid." WHERE nid = ".$node->nid);

  $node = node_load($obj->nid);
  node_save($node);//have to save before saving with webform orig nid
*/


  node_save($node);//have to save before saving with webform orig nid


  $results_question = db_query("
    SELECT * FROM old_webform_component
    WHERE nid = ".$obj->nid." order by cid,weight /*LIMIT 20*/
    "
  );//test case on one quiz 10 QUESTIONS
  //echo "<hr/>";
  $max_score=0;
  $weight_incr = 0;
  while($obj_question = db_fetch_object($results_question)){
    $max_score++;
    $node_question = new StdClass();
    if($obj_question->type=='select') { 
      $node_question->type = 'multichoice';
    }else if($obj_question->type=='textarea' || $obj_question->type=='textfield') { 
      $node_question->type = 'long_answer';         
    }else{
      continue;
    }
    $node_question->title = $obj_question->name;
    $node_question->body = $obj_question->name;
    $node_question->teaser = $obj_question->name;
    $node_question->weight = $weight_incr++;

echo     $node_question->teaser = $obj_question->name."<br/>";
    node_save($node_question);//have to save before saving with webform orig nid



    $q = "insert into {quiz_node_relationship} 
      (parent_nid,parent_vid,child_nid,child_vid,weight,max_score) 
      VALUES(".$node->nid.",".$node->vid.",".$node_question->nid.",
      ".$node_question->vid.",".$node_question->weight.",1)";
    db_query($q);







    if($obj_question->type=='select'/*&&!preg_match("/state/i",$node_question->title)*/) { 

      $arr = unserialize($obj_question->extra);
      $order   = array("\r\n", "\n", "\r");
      $replace = '[endchoice]' ;
      $newstr = str_replace($order,$replace,$arr[items]);
      $tmp_str = explode('[endchoice]',$newstr);  
      for($i=0;$i<sizeof($tmp_str);$i++) {
        $score_if_chosen = 0;
        if( preg_match("/Compliant/i",$tmp_str[$i])  || preg_match("/Yes/i",$tmp_str[$i]) ){
          $score_if_chosen = 1;
        }
        if( preg_match("/Non-Compliant/i",$tmp_str[$i]) || preg_match("/No/i",$tmp_str[$i]) ){
          $score_if_chosen = -1;
        }
        if( preg_match("/N\/A/i",$tmp_str[$i]) ){
          $score_if_chosen = 0;
        }

        $tmp_str_kv = explode("|",$tmp_str[$i]);
        $tmp_str_label = $tmp_str_kv[0];

        if(!isset($tmp_str_kv[0]) || trim($tmp_str_kv[0])=='')  continue;

        $q = "
        INSERT INTO {quiz_multichoice_answers} 
        (
        answer,
        score_if_chosen,
        question_nid,
        question_vid
        ) VALUES (
        '$tmp_str_label',
        $score_if_chosen,
        ".$node_question->nid.",
        ".$node_question->vid."
        )
        ";
        //echo $q;
        db_query($q);
        //echo "<hr/>";
      }
    }
    
    /*    
    quiz_node_properties

    backwards_navigation  
    keep_results,
    quiz_open  
    quiz_close   
    quiz_always,
    allow_skipping   
    allow_resume  
    allow_jumping
    */
    
    $q = "
    UPDATE {quiz_node_properties} SET
    backwards_navigation=1,
    keep_results=1,
    quiz_open=1,
    quiz_close=".(time()+time()).",
    quiz_always=1,
    allow_skipping=1,
    allow_resume=1,
    allow_jumping=1,
pass_rate=75,
show_attempt_stats=1,
keep_results=2,
    max_score=".$max_score." 
    WHERE nid=".$node->nid."
    ";
    //echo $q;
    db_query($q);
    //echo "<hr/>";    
    
    $q = "
    UPDATE {node} SET
    promote=0 ,
    status=1 
    WHERE nid=".$node->nid."
    ";
    //echo $q;
    db_query($q);
    //echo "<hr/>";   

  }

  //exit;//test case on one quiz 10 QUESTIONS
}

db_query("update {quiz_node_properties} set allow_jumping =0 where 1");
db_query("update {quiz_node_properties} set allow_skipping =0 where 1");



echo "DONE";