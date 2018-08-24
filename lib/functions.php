<?php 

//удаление категории
function delCat($id,$db) 
{
    $db->query('DELETE FROM category WHERE id_category = :id');
    $db->bind(':id', $id);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }
}
//добавление категории
function addCat($param, $db) 
{
    $db->query("INSERT INTO category (category_name) VALUES (:category_name)");
    $db->bind(":category_name", $param);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }
}

// добавление теста
function addTest($test_name,$cat_id, $db)
{
    $db->query("INSERT INTO tests (test_name,category_id) VALUES (:test_name,:cat_id)");
    $db->bind(":test_name", $test_name);
    $db->bind(":cat_id", $cat_id);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }
}

function delTest($id,$db) 
{
    $db->query('DELETE FROM tests WHERE tests_id = :id');
    $db->bind(':id', $id);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }
}

function getCountOfQuestions($test_id,$db){
    $db->query('SELECT * FROM questions WHERE test_id = :id');
    $db->bind('id', $test_id);
    if ($db->execute()) {
        return $db->rowCount();
    } else {
        die('все пропало шеф');
    }


}
function getAllTestInnerJoinCategory($db) {
    $db->query('SELECT * FROM `tests` INNER JOIN category ON tests.category_id = category.id_category');
    return $db->resultset();
}
function addQuestion($q_name,$a_type,$test_id,$db) {
    $db->query('INSERT INTO questions (q_name,q_type,test_id) VALUES (:q_name,:q_type,:test_id)');
    $db->bind(':q_name', $q_name);
    $db->bind('q_type', $a_type);
    $db->bind('test_id', $test_id);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }
}

function getQuestions($test_id, $db) {
    $db->query('SELECT * FROM questions WHERE test_id = :id');
    $db->bind(':id', $test_id);
    return $db->resultset();

}
function addOptions($o_body,$o_cf,$id_q,$db) {
    $db->query('INSERT INTO options (o_body, o_cflg, id_q) VALUES (:o_body, :o_clfg, :id_q)');
    $db->bind(':o_body', $o_body);
    $db->bind(':o_clfg', $o_cf);
    $db->bind(':id_q', $id_q);

    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }   
}

function getOptions($db) {
    $db->query('SELECT * FROM options');
    return $db->resultset();
}

function delOptions($id,$db) {
    $db->query('DELETE FROM options WHERE id_answ = :id');
    $db->bind(':id', $id);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');
    }
}
function delQuestions($id,$db) {
    $db->query('DELETE FROM questions WHERE q_id = :id');
    $db->bind(':id', $id);
    if ($db->execute()) {
        $db->query('DELETE FROM options WHERE id_q = :id');
        $db->bind(':id', $id);
        if ($db->execute()) {
            return true;
        } else {
            die('все пропало шеф');    
        }
    } else {
        die('все пропало шеф');
    }
}
function getSingleQuestion($id,$db) {
    $db->query('SELECT * FROM questions WHERE q_id =:id');
    $db->bind(':id', $id);
    if ($db->execute()) {
        return $db->resultset();
    } else {
        die('все пропало шеф');    
    } 
}

function updQuestions($id,$upd_name,$db) {
    $db->query('UPDATE questions SET q_name = :upd_name WHERE q_id =:id');
    $db->bind(':id', $id);
    $db->bind(':upd_name', $upd_name);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');    
    } 
}

function getSingleOption($id,$db) {
    $db->query('SELECT * FROM options WHERE id_answ =:id');
    $db->bind(':id', $id);
    if ($db->execute()) {
        return $db->resultset();
    } else {
        die('все пропало шеф');    
    } 
}
function updOptions($id,$upd_name,$c_flg, $db) {
    $db->query('UPDATE options SET o_body = :upd_name, o_cflg = :upd_cflg WHERE id_answ =:id');
    $db->bind(':id', $id);
    $db->bind(':upd_name', $upd_name);
    $db->bind(':upd_cflg', $c_flg);
    if ($db->execute()) {
        return true;
    } else {
        die('все пропало шеф');    
    } 
}


?>