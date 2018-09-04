<?php 
/**
 * Дописать эдит категорий !!!!
 * Написать коментарии
 * 
 */
    require_once 'lib/Database.php';
    require_once 'lib/functions.php';

    $db = new Database;
    $db->query("SELECT * FROM category");
    $result = $db->resultset();
    



if (isset($_GET['delcat'])) {
    if (delCat($_GET['delcat'], $db)) {
        header('Location: categories.php');
    } 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $cat_name = trim($_POST['cat_name']);
    // print_r($_POST['cat_name']);
    addCat($cat_name, $db);
    header('Location: categories.php');
}

require_once "inc/header.php";
?>

<div class="container">
    <div class="row">
    <div class="col-6">
    <div class="h5">
        Список категорий:
    </div>
        <ul class="list-group mt-3">
            <?php 
            foreach ($result as $key) {
                echo '<li class="list-group-item">'. $key['category_name'] .'<a class="close_tag" href="?delcat='. $key['id_category'] .'"><i class="fas fa-times-circle float-right"></i></a></li>';
            }
            ?>
        </ul>
    </div>
    <div class="col-6">
    <form method="post">
        <div class="form-group my-2">
            <label>Новая категория:</label>
            <input type="text" name="cat_name" class="form-control">
            <small class="form-text text-muted">Введите название новой категории:</small>
        </div>
            <input type="submit" class="btn btn-danger" value="Добавить"/>
        </form>
    </div>
</div>
</div>

<?php
require_once "inc/footer.php";
?>
