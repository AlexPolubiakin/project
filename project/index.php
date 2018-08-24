<?php 
//подрубаем ДБ и функции
require_once 'lib/Database.php';
require_once 'lib/functions.php';
$db = new Database;
$allInfo = getAllTestInnerJoinCategory($db);

require_once "inc/header.php";

?>
<section id="actions" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <a href="categories.php" class="btn btn-primary btn-block">
          <i class="fas fa-plus"></i> Добавить категорию
        </a>
      </div>

      <div class="col-md-3">
        <a href="edit.php" class="btn btn-danger btn-block">
          <i class="fas fa-plus"></i> Добавить тест
        </a>
      </div>

      <div class="col-md-3">
        <a href="details.php" class="btn btn-primary btn-block">
          <i class="fas fa-plus"></i> Добавить вопрос
        </a>
      </div>
    </div>
  </div>
</section>

<section id="posts">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="row">
              <div class="col-12">
                <h2>Категории и тесты:</h2>
              <?php 
              foreach ($allInfo as $key) {
              ?>
                  <div class="card my-2">
                      <div class="card-header">
                          <?php echo $key['category_name']; ?>
                      </div>

                      <div class="card-body">
                          <div class="list-group">
                                  <a href="#" class="list-group-item list-group-item-action">
                                  <?php echo $key['test_name']; ?>
                                    
                                    <span class="badge badge-primary badge-pill float-right mx-1">
                                        <?php echo getCountOfQuestions($key['tests_id'],$db); ?>
                                      </span>
                                      <span class="small float-right mx-1">Всего вопросов:</span>
                                  </a>
                              </div>
                      </div>
                  </div>   
              <?php } ?>
              </div>
          </div>
      </div>
      
    </div>
  </div>
</section>

<?php 
require_once "inc/footer.php";
?>


