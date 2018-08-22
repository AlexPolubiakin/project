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
?>