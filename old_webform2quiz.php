1f81cc
require_once 'includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
a2b22320e92a352a63c

/*
b06 ff8da e02841 e92b 450 dea456
b068ff8 aee02841 e92b 4502d a4 6
b068ff daee0 841fe92b
*/
db_query("truncate {quiz_node_relationship}");
f13c42516ae919462a 38184ac237de5
f13c42516ae919462a9
db_query("truncate {quiz_multichoice_answers}");

8535225e5354feaae7 ebf7822b6b49e
8535225e5354feaae72ebf78

db_query("truncate {quiz_question_properties}");
6b8f4b296c2d16cff7 bf31490333d53
6b8f4b296c2d

db_query("
9dd4f1 161b 002541 55add e8e2 8e 9dd4f1c161b6002541d55addbe8e298e
9dd4
");
db_query("
5efc2b 4104 2536d72570f021 962b2 5ef 2b1 10 72
select nid from `node` WHERE type not IN ('long_answer','quiz','multichoice'))
");
a1a5d7b975e
delete from node_comment_statistics where nid not in (
select nid from `node` WHERE type not IN ('long_answer','quiz','multichoice'))
16b2

//exit;//uncomment for deleting all quizzes
2


6e03f45a 5 b985928c999
SELECT n . * , r.body, r.timestamp, r.format
FROM old_node n
ecae 9018 8848fd10b412ddb3fe f c
 caee9 1 e8848f
WHERE n.type LIKE 'webform'
");
9


1455168bf2 b 21d302146ed3690dc35
1455168b
  $node = new StdClass();
  $node->type = 'quiz';
  3ebe03e38debb 3 a301260494ad78
  $node->created= $obj->created;
  $node->changed= $obj->changed;
  e00f31c5814 e6f120140a0
  $node->title = $obj->title;
  $node->body = $obj->body;
  8ac3792af155a068 1 67afa748894
218ac
  $node->format= $obj->format;

2
/*

  262403e688ef0bd3 d86c22 f54 e3
b4262403e688ef0bd33d86c225f54ce3 b4262 03e 8 ef0bd33d86c225f
  db_query("UPDATE {node_revisions} SET nid=".$obj->nid.",vid=".$obj->vid." WHERE nid = ".$node->nid);

  562c96b9ef76a62c b975d76d8f3ae
8a562c96 9ef 6a62c3b975d76d8f3ae
8a562c96b9ef76a 2c3b9 5d7 d f3ae
8a562c96b9

  $node = node_load($obj->nid);
  a8ca639e9192e3a4f26c47b bb dab
 ba8ca6 9e9192 3a4f 6c47b6b 4dab cba8
*/

2
  node_save($node);//have to save before saving with webform orig nid

2
  $results_question = db_query("
    SELECT * FROM old_webform_component
    6b3e2 8c2 d 8aa813e3b3193 fc
81 26 3e2f8c28d0 aa813e3 31933
    "
  );//test case on one quiz 10 QUESTIONS
  1f5070 a3691d27c
  $max_score=0;
  $weight_incr = 0;
  1814d7dc84c4750d381 b e5f1367b
1c1814d7dc84c4750d381fb6e5f1
    $max_score++;
    $node_question = new StdClass();
    0a646be57c0251c991850cd4378d
74d9 a6
      $node_question->type = 'multichoice';
    }else if($obj_question->type=='textarea' || $obj_question->type=='textfield') {
      c38c6ac5d9a694fa8a85 b 2c8
e82893c38c6
    }else{
      continue;
    91
    $node_question->title = $obj_question->name;
    $node_question->body = $obj_question->name;
    6cd8d80e5ccede3dff302b 9 cd2
69d26cd8d80e5cced
    $node_question->weight = $weight_incr++;

eb39     034777a6a0390a68f6223f 
 b39eab30034777a6a0390a68f6223
    node_save($node_question);//have to save before saving with webform orig nid

9

    $q = "insert into {quiz_node_relationship}
      b80fc7745531d5d24aa73dd3ef
157f5eb80fc7745531d5d24aa73dd3ef
1
      VALUES(".$node->nid.",".$node->vid.",".$node_question->nid.",
      ".$node_question->vid.",".$node_question->weight.",1)";
    8a405799c3eb79


8


8

    if($obj_question->type=='select'/*&&!preg_match("/state/i",$node_question->title)*/) {
8
      $arr = unserialize($obj_question->extra);
      $order   = array("\r\n", "\n", "\r");
      87f499d0 0 ab1e28f4740ed b

      $newstr = str_replace($order,$replace,$arr[items]);
      $tmp_str = explode('[endchoice]',$newstr);
      ed3b42612453acd7638ea3b64d
79be54e 3b
        $score_if_chosen = 0;
        if( preg_match("/Compliant/i",$tmp_str[$i])  || preg_match("/Yes/i",$tmp_str[$i]) ){
          051c8f8eea1f2cd7 e 66e
        }
        if( preg_match("/Non-Compliant/i",$tmp_str[$i]) || preg_match("/No/i",$tmp_str[$i]) ){
          26c031c953170b86 d 2cf

        }
        if( preg_match("/N\/A/i",$tmp_str[$i]) ){
          473a5f83b5991a8d 3 96c
        }

        624cb90aee3 8 38bac1c4ad
587aae46624cb90a
        $tmp_str_label = $tmp_str_kv[0];

        52ae66f0e47297153d8aca16
 36 015052ae66f0e47297153d8ac  6
63640150

        $q = "
        896023 e5c0 7a9f1c3d7ace
99c5ef54896023
        (
        answer,
        a6967d986cecaf571
        question_nid,
        question_vid
        f dcb9af 85
        '$tmp_str_label',
        $score_if_chosen,
        65f3ed5f69471444ff8a1d36

        ".$node_question->vid."
        )
        416
        //echo $q;
        db_query($q);
        405a02 b28b2c6c0
      }
    }
1
    /*
    quiz_node_properties
e
    backwards_navigation
    keep_results,
    152437a664
    quiz_close
    quiz_always,
    8f4c909aeca7886
    allow_resume
    allow_jumping
    866

    $q = "
    3e99fa 46dce50991acdbf247d70
 ad03
    backwards_navigation=1,
    keep_results=1,
    5f9aa2bd2e811
    quiz_close=".(time()+time()).",
    quiz_always=1,
    9af53cd49b3f41ec42
    allow_resume=1,
    allow_jumping=1,
55faa8a24f616c
show_attempt_stats=1,
keep_results=2,
    4e73583d875ba7e89b2628424
    WHERE nid=".$node->nid."
    ";
    32001a 9922
    db_query($q);
    //echo "<hr/>";
2
    $q = "
    UPDATE {node} SET
    2bbc49a3a 78
    status=1
    WHERE nid=".$node->nid."
    a26
    //echo $q;
    db_query($q);
    788071 975e2fb76

  }
8
  //exit;//test case on one quiz 10 QUESTIONS
}
8
db_query("update {quiz_node_properties} set allow_jumping =0 where 1");
db_query("update {quiz_node_properties} set allow_skipping =0 where 1");
3


a53f b2721f
