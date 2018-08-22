<?php 
require_once "inc/header.php";
?>

<section id="actions" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <a href="#" class="btn btn-primary btn-block">
          <i class="fas fa-plus"></i> Добавить тест
        </a>
      </div>

      <div class="col-md-3">
        <a href="#" class="btn btn-danger btn-block">
          <i class="fas fa-plus"></i> Добавить категорию
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
                  <div class="card my-2">
                      <div class="card-header">
                          HTML
                      </div>
                      <div class="card-body">
                          <div class="list-group">
                                  <a href="#" class="list-group-item list-group-item-action">
                                    Введение
                                    <span class="badge badge-primary badge-pill float-right">
                                        14 вопросов
                                      </span>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action">Гиперссылки<span class="badge badge-primary badge-pill float-right">20 вопросов</span></a>
                              </div>
                      </div>
                  </div>    
                  <div class="card my-2">
                          <div class="card-header">
                              JavaScript
                          </div>
                          <div class="card-body">
                              <div class="list-group">
                                      <a href="#" class="list-group-item list-group-item-action">Основы синтаксиса<span class="badge badge-primary badge-pill float-right">10 вопросов</span></a>
                                      <a href="#" class="list-group-item list-group-item-action">Управляющие конструкции<span class="badge badge-primary badge-pill float-right">25 вопросов</span></a>
                                  </div>
                          </div>
                      </div>    
              </div>
          </div>
      </div>
      
    </div>
  </div>
</section>

<?php 
require_once "inc/footer.php";
?>


