72e6ce
require_once 'includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
6ee717d7e725d29f7b0

/*
e72 91541 b56540 99bd c15 025939
e72e915 1cb56540 99bd c1590 59 9
e72e91 41cb5 540699bd
*/
db_query("truncate {quiz_node_relationship}");
34f2d4b4949a5dc2b8 735073777a5e2
34f2d4b4949a5dc2b86
db_query("truncate {quiz_multichoice_answers}");

3336b1bb6a50a17b76 7e24040076be4
3336b1bb6a50a17b7607e240

db_query("truncate {quiz_question_properties}");
216ddfb15b7dbffbb4 802e6dbfae1b9
216ddfb15b7d

db_query("
c2de1a c494 f61740 26f35 43b6 3f c2de1abc4945f61740b26f35243b6a3f
c2de
");
db_query("
04bfa1 0100 b4657440f02aa8 caad7 04b a1f 10 7b
select nid from `node` WHERE type not IN ('long_answer','quiz','multichoice'))
");
49f146fccf9
delete from node_comment_statistics where nid not in (
select nid from `node` WHERE type not IN ('long_answer','quiz','multichoice'))
0307

//exit;//uncomment for deleting all quizzes
6


44fe1dbf 5 e065abd08f2
SELECT n . * , r.body, r.timestamp, r.format
FROM old_node n
dce0 e226 8e7c20544a9c0e9cd4 5 2
 ce0ee 2 98e7c2
WHERE n.type LIKE 'webform'
");
5


13cad8aa7c 3 fa6fb4071b317e43f91
13cad8aa
  $node = new StdClass();
  $node->type = 'quiz';
  19b6f20edb0a7 4 2503652afc0ee9
  $node->created= $obj->created;
  $node->changed= $obj->changed;
  e8c3850ba29 1edb39ff1a7
  $node->title = $obj->title;
  $node->body = $obj->body;
  4290665e49eff929 9 b23c71a5f8f
35429
  $node->format= $obj->format;

e
/*

  4311e3b382969215 a7c0b4 0e0 4f
404311e3b382969215aa7c0b4c0e044f 40431 e3b 8 969215aa7c0b4c0
  db_query("UPDATE {node_revisions} SET nid=".$obj->nid.",vid=".$obj->vid." WHERE nid = ".$node->nid);

  9e3ef74b44b85136 0ad47f046319d
a99e3ef7 b44 8513620ad47f046319d
a99e3ef74b44b85 3620a 47f 4 319d
a99e3ef74b

  $node = node_load($obj->nid);
  7b800b577633c4079fb0e82 70 a4d
 07b800 577633 4079 b0e8227 6a4d 607b
*/

f
  node_save($node);//have to save before saving with webform orig nid

1
  $results_question = db_query("
    SELECT * FROM old_webform_component
    4f969 9a4 c 05a60b867ce1f 71
1f 94 969e9a41cd 5a60b86 ce1f2
    "
  );//test case on one quiz 10 QUESTIONS
  e069e9 a5f61b166
  $max_score=0;
  $weight_incr = 0;
  3e462ca2e7b12291e50 6 51646889
c43e462ca2e7b12291e508625164
    $max_score++;
    $node_question = new StdClass();
    f75a55671762d3cd6336fbb3a781
ea8f 75
      $node_question->type = 'multichoice';
    }else if($obj_question->type=='textarea' || $obj_question->type=='textfield') {
      816d33313fb1d37d3edd e 22a
8c7966816d3
    }else{
      continue;
    e1
    $node_question->title = $obj_question->name;
    $node_question->body = $obj_question->name;
    01743c4330c09825423a57 4 45f
273001743c4330c09
    $node_question->weight = $weight_incr++;

c7bf     4f8257061d303cbe9826a1 
 7bfc9f874f8257061d303cbe9826a
    node_save($node_question);//have to save before saving with webform orig nid

d

    $q = "insert into {quiz_node_relationship}
      b12bd4666c254a97074b0030d9
d22cb6b12bd4666c254a97074b0030d9
d
      VALUES(".$node->nid.",".$node->vid.",".$node_question->nid.",
      ".$node_question->vid.",".$node_question->weight.",1)";
    b0e999f735338b


1


d

    if($obj_question->type=='select'/*&&!preg_match("/state/i",$node_question->title)*/) {
9
      $arr = unserialize($obj_question->extra);
      $order   = array("\r\n", "\n", "\r");
      98ab4cd3 7 5b13bac822881 9

      $newstr = str_replace($order,$replace,$arr[items]);
      $tmp_str = explode('[endchoice]',$newstr);
      99336a3fda720cf349dd43195b
59d53c9 33
        $score_if_chosen = 0;
        if( preg_match("/Compliant/i",$tmp_str[$i])  || preg_match("/Yes/i",$tmp_str[$i]) ){
          9298385b58d197f1 f be6
        }
        if( preg_match("/Non-Compliant/i",$tmp_str[$i]) || preg_match("/No/i",$tmp_str[$i]) ){
          d13012467c7a2342 5 79c

        }
        if( preg_match("/N\/A/i",$tmp_str[$i]) ){
          17fd7991d9ec392f e 828
        }

        dc73df5627c 2 65ade930dd
ed74504bdc73df56
        $tmp_str_label = $tmp_str_kv[0];

        03f570cb1395b3f4f41608fc
 80 fd4703f570cb1395b3f4f4160  c
2802fd47

        $q = "
        ab21ac ddb2 66c14a70ea87
4f64079bab21ac
        (
        answer,
        5872b991b9d4ee949
        question_nid,
        question_vid
        a 65b735 59
        '$tmp_str_label',
        $score_if_chosen,
        06fd7d8024d171cfd4841fd6

        ".$node_question->vid."
        )
        220
        //echo $q;
        db_query($q);
        31d595 87540dc44
      }
    }
9
    /*
    quiz_node_properties
0
    backwards_navigation
    keep_results,
    a52fb605c1
    quiz_close
    quiz_always,
    4ad66f60f3c9617
    allow_resume
    allow_jumping
    039

    $q = "
    9d214b f543886af6946dc18acae
 5919
    backwards_navigation=1,
    keep_results=1,
    82d70be777392
    quiz_close=".(time()+time()).",
    quiz_always=1,
    caab46bd3d1aeebe23
    allow_resume=1,
    allow_jumping=1,
708d305a309556
show_attempt_stats=1,
keep_results=2,
    b0e994eeb83f4d243304da5f2
    WHERE nid=".$node->nid."
    ";
    73c8d0 35b4
    db_query($q);
    //echo "<hr/>";
a
    $q = "
    UPDATE {node} SET
    f43ca9e1a ed
    status=1
    WHERE nid=".$node->nid."
    f08
    //echo $q;
    db_query($q);
    538b20 d4e9ba641

  }
e
  //exit;//test case on one quiz 10 QUESTIONS
}
9
db_query("update {quiz_node_properties} set allow_jumping =0 where 1");
db_query("update {quiz_node_properties} set allow_skipping =0 where 1");
6


782e 7e6244
