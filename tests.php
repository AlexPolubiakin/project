<?php 
    require_once 'lib/Database.php';
    require_once 'lib/functions.php';

    $db = new Database;
    $db->query("SELECT * FROM category");
    $resultFromCategory = $db->resultset();

    // !!!! НУЖНО ПЕРЕПИСАТЬ ФУНКЦИЮ И СДЕЛАТЬ JOIN для отображения категорий
    /**
     * 
     * 
     * "SELECT *,
     *                   items.id as itemId
     *                   FROM items 
     *                   INNER JOIN lists
     *                   ON items.list_id = lists.id
     *                   WHERE items.list_id ='$id'");
     * 
     * 
     * 
     */
    $db->query('SELECT * FROM tests');
    $resultFromTests = $db->resultset();
    
require_once "inc/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $post_cat_id = (int) $_POST['cat_id'];
    $post_test_name = trim($_POST['test_name']);
    if (addTest($post_test_name, $post_cat_id, $db)) {
        header('Location: http://localhost/tarasov/tests.php');
    }
}

?>

<div class="row">
    <div class="col-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="post">
                        <div class="form-group">
                            <label>Выберите категорию теста</label>
                            <select name="cat_id" class="form-control" required>
                            <option value="">Категория не выбрана</option>
                            <?php 
                            foreach ($resultFromCategory as $key) {
                                echo "<option value=" . $key['id_category'] . ">" . $key['category_name'] . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Введите название теста</label>
                            <input type="text" class="form-control" name="test_name" id="category">
                        </div>
                        <input type="submit" class="btn btn-danger" value="Добавить"/>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-8">

  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4>Добавленные тесты</h4>
          </div>
           <table class="table table-striped">
             <thead class="thead-dark">
               <tr>
                 <th>#</th>
                 <th>Название теста</th>
                 <th>Категория</th>
                 <th></th>
               </tr>
             </thead>
             <tbody>
                 
             <?php 
             $num = 1;
             foreach ($resultFromTests as $key) { ?>
               <tr>
                 <td><?php echo $num; ?></td>
                 <td><?php echo $key['test_name']; ?></td>
                 <td><?php echo $key['test_name']; ?></td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
               <?php 
                    $num++;
                } ?>

             </tbody>
           </table>

        </div>
      </div>
    </div>
  </div>


    </div>
</div>

<?php
require_once "inc/footer.php";
?>
