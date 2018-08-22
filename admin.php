<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Bootstrap Theme</title>
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
  <div class="container">
    <a href="index.html" class="navbar-brand">На главную</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item px-2">
          <a href="categories.html" class="nav-link">Категории</a>
        </li>
        <li class="nav-item px-2">
          <a href="users.html" class="nav-link">Тесты</a>
        </li>
      </ul>
      
      
    </div>
  </div>
</nav>

<section id="actions" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal">
          <i class="fas fa-plus"></i> Добавить тест
        </a>
      </div>

      <div class="col-md-3">
        <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#addCategoryModal">
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
                                  <a href="#" class="list-group-item list-group-item-action">Введение<span class="badge badge-primary badge-pill float-right">14 вопросов</span></a>
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


        <!-- <div class="card">
          <div class="card-header">
            <h4>Все тесты</h4>
          </div>
           <table class="table table-striped">
             <thead class="thead-dark">
               <tr>
                 <th>#</th>
                 <th>Название</th>
                 <th>Категория</th>
                 <th></th>
               </tr>
             </thead>
             <tbody>
               <tr>
                 <td>1</td>
                 <td>Post One</td>
                 <td>Web Development</td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
               <tr>
                 <td>2</td>
                 <td>Post Two</td>
                 <td>Tech Gadgets</td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
               <tr>
                 <td>3</td>
                 <td>Post Three</td>
                 <td>Web Development</td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
               <tr>
                 <td>4</td>
                 <td>Post Four</td>
                 <td>Business</td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
               <tr>
                 <td>5</td>
                 <td>Post Five</td>
                 <td>Web Development</td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
               <tr>
                 <td>6</td>
                 <td>Post Six</td>
                 <td>Health & Wellness</td>
                 <td>
                   <a href="details.html" class="btn btn-secondary">
                     <i class="fas fa-angle-double-right"></i> Подробнее
                   </a>
                 </td>
               </tr>
             </tbody>
           </table>
        </div> -->
      </div>
      
      
      <!-- <div class="col-md-3">
        <div class="card text-center bg-primary text-white mb-3">
          <div class="card-body">
            <h3>Тесты</h3>
            <h4 class="display-4">
              <i class="fas fa-pencil-alt"></i> 6
            </h4>
            <a href="tests.php" class="btn btn-outline-light btn-sm">Подробнее</a>
          </div>
        </div>

        <div class="card text-center bg-danger text-white mb-3">
          <div class="card-body">
            <h3>Категории</h3>
            <h4 class="display-4">
              <i class="fas fa-folder"></i> 4
            </h4>
            <a href="categories.php" class="btn btn-outline-light btn-sm">Подробнее</a>
          </div>
        </div>

      </div> -->
    </div>
  </div>
</section>


  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());

    // CKEditor
    CKEDITOR.replace( 'editor1' );
    
  </script>
</body>

</html>