<?php
//подрубаем ДБ и функции
require_once 'lib/Database.php';
require_once 'lib/functions.php';

$db = new Database;
// выводим все тесты и ответы
$allTests = getAllTestInnerJoinCategory($db);
$allOptions = getOptions($db);


//добавления вопроса
if (isset($_POST['addq'])) {
    $test_id = (int) $_POST['test_id'];
    $q_body = htmlspecialchars($_POST['q_body']);
    $a_type = (int) $_POST['a_type'];
if (addQuestion($q_body, $a_type, $test_id, $db)) {
        header('Location: newdetails.php?test='.$test_id);
}   
}
// добавление пустого варианта ответа
if (isset($_GET['addo']) == true) {
    $test_id = (int) $_GET['test'];
    $id_question = (int) $_GET['q_id'];
    if (addOptionsBlank($id_question,$db)) {
        header('Location: newdetails.php?test='.$test_id);
    }
}
// удаление вопроса
if (isset($_GET['q_del'])) {
    delQuestions($_GET['q_del'],$db);
    header('location: newdetails.php?test='. $_GET['test']);
}
// удаление ответа на вопрос
if (isset($_GET['o_del'])) {
    delOptions($_GET['o_del'],$db);
    header('location: newdetails.php?test='. $_GET['test']);
}
// редакитруем варианты ответа
if (isset($_POST['editq'])) {
    var_dump($_POST);
    $edit_q_body = htmlspecialchars($_POST['q_body']);
    $edit_q_id = (int) $_POST['q_id'];
    updQuestions($edit_q_id, $edit_q_body, $db);
    header('location: newdetails.php?test='. $_GET['test']);
}
// редакитруем вопрос
if (isset($_POST['edita'])) {
    // var_dump($_POST);
        $edit_a_body = htmlspecialchars($_POST['o_body']);
        $edit_a_flag = $_POST['flag'];
        $edit_a_id = (int) $_POST['a_id'];
    // array(4) { ["flag"]=> string(1) "1" ["o_body"]=> string(21) "бла бла бла " ["a_id"]=> string(2) "55" ["edita"]=> string(0) "" }
    if (updOptions($edit_a_id,$edit_a_body,$edit_a_flag, $db) ) {
        header('location: newdetails.php?test='. $_GET['test']);
    }
}

if (isset($_POST['add_options'])) {
    // array(4) { ["o_body"]=> string(3) "123" ["flag"]=> string(1) "1" ["id_q"]=> string(2) "42" ["add_options"]=> string(0) "" }
    $add_free_answ_body = htmlspecialchars($_POST['o_body']);
    $add_free_answ_flag = $_POST['flag'];
    $add_free_answ_q_id = $_POST['id_q'];
    if (addOptions( $add_free_answ_body, $add_free_answ_flag, $add_free_answ_q_id, $db)) {
        header('location: newdetails.php?test='. $_GET['test']);        
    }
}

if (isset($_POST['test_type'])) {
    var_dump($_POST);
}
// подключаем хэдер
require_once "inc/header.php";


?>

<div class="col-2">
        <a href="newdetails.php" class="btn btn-block btn-danger mt-3">Назад</a>
</div>
        <?php if(!isset($_GET['test'])) { ?>
            <div class="container">
                <div class="row">
                            <div class="alert alert-dark w-100 mt-1" role="alert">
                                <h5>Выбирете тест</h5>
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
                                        foreach ($allTests as $key) {  ?>
                                    <tr>
                                        <td><?php echo $num ;?></td>
                                        <td><?php echo $key['test_name'] ;?></td>
                                        <td><?php echo $key['category_name'] ;?></td>
                                        <td>
                                        <a href="?test=<?php echo $key['tests_id'] ;?>" class="btn btn-secondary">
                                            <i class="fas fa-angle-double-right"></i> Выбрать тест
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
        <?php } else { ?>

            
<?php
// вытаскиваем все вопросы по id теста
 $all_q = getQuestions($_GET['test'], $db);
 ?>

<?php
    $n = 1;
    foreach ($all_q as $key) { ?>
<?php
    if ($key['q_type'] == 0) { ?>
    <div class="container mt-3">
    <!-- вопрос -->
    <form method="post">
        <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text font-weight-bold">Вопрос №<?php echo $n; ?></span>
                </div>
                <input type="hidden" name="q_id" value="<?php echo $key['q_id'];?>">
                <textarea class="form-control" name="q_body"><?php echo $key['q_name'];?></textarea>
                <div class="input-group-append">
                        <a href='newdetails.php?test=<?php echo $key['test_id'];?>&addo=true&q_id=<?php echo $key['q_id'];?>' class="btn btn-outline-success">Добавить ответ</a>
                        <button class="btn btn-outline-primary" type="submit" name="editq">Редактировать</button>
                        <a href='newdetails.php?test=<?php echo $key['test_id'];?>&q_del=<?php echo $key['q_id'];?>' class="btn btn-outline-danger">Удалить</a>
              </div>
        </div>
    </form>
        <?php 
            $q_num = '';
                foreach ($allOptions as $value) {
                    if ($value['id_q'] == $key['q_id']) {
        ?>
        <!-- не решен вопрос с радио кнопками при редактировании , поэтому замена к checkbox-->
            <!-- одиночный ответ -->
            <form method="post">
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="hidden" name="flag" value="0">
                        <input type="checkbox" name="flag" value="1" <?php echo ($value['o_cflg'] == '1') ? 'checked' : '';  ?>>
                    </div>
                    <span class="input-group-text"><?php echo $q_num; ?></span>
                </div>
                <textarea class="form-control" name="o_body"><?php echo $value['o_body'];?></textarea>
                <input type="hidden" name="a_id" value="<?php echo $value['id_answ'];?>">
                <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" name="edita">Редактировать</button>
                        <a href='?test=<?php echo $key['test_id'];?>&o_del=<?php echo $value['id_answ'];?>' class="btn btn-outline-danger">Удалить</a>
                </div>
            </div>
            </form>

                    <?php 
                }
            } ?>
                </div> 
<?php
    $n++;
    } elseif ($key['q_type'] == 1) { ?>
        <div class="container mt-3">
        <form method="post">
        <!-- тело вопроса -->
        <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text font-weight-bold">Вопрос №<?php echo $n; ?></span>
                </div>
                <input type="hidden" name="q_id" value="<?php echo $key['q_id'];?>">
                <textarea class="form-control" name="q_body"><?php echo $key['q_name'];?></textarea>
                <div class="input-group-append" id="button-addon4">
                        <a href='newdetails.php?test=<?php echo $key['test_id'];?>&addo=true&q_id=<?php echo $key['q_id'];?>' class="btn btn-outline-success">Добавить ответ</a>
                        <button class="btn btn-outline-primary" type="submit" name="editq">Редактировать</button>
                        <a href='newdetails.php?test=<?php echo $key['test_id'];?>&q_del=<?php echo $key['q_id'];?>' class="btn btn-outline-danger">Удалить</a>
              </div>
        </div>
        </form> 

        <?php 
            $q_num = '';
                foreach ($allOptions as $value) {
                    if ($value['id_q'] == $key['q_id']) {
        ?>
        <!-- множественный ответ -->
        <form method="post">
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="hidden" name="flag" value="0">
                    <input type="checkbox" name="flag" value="1" <?php echo ($value['o_cflg'] == '1') ? 'checked' : '';  ?>>
                </div>
                <span class="input-group-text" id="basic-addon1"><?php echo $q_num; ?></span>
            </div>
            <textarea class="form-control" name="o_body"><?php echo $value['o_body'];?></textarea>
            <input type="hidden" name="a_id" value="<?php echo $value['id_answ'];?>">
            <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" name="edita">Редактировать</button>
                    <a href='?test=<?php echo $key['test_id'];?>&o_del=<?php echo $value['id_answ'];?>' class="btn btn-outline-danger">Удалить</a>
            </div>
        </div>
        </form>    
        <?php 
                }
            } ?>
    </div>
<?php
$n++;
    } elseif ($key['q_type'] == 2) { 
    ?>
        
        <div class="container mt-3">
                <!-- свободный ввод -->
                <form method="post">
                <div class="input-group mb-1">
                        <div class="input-group-prepend">
                          <span class="input-group-text font-weight-bold">Вопрос №<?php echo $n; ?></span>
                        </div>
                        <input type="hidden" name="q_id" value="<?php echo $key['q_id'];?>">
                        <textarea class="form-control" name="q_body"><?php echo $key['q_name'];?></textarea>
                        <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" name="editq">Редактировать</button>
                        <a href='newdetails.php?test=<?php echo $key['test_id'];?>&q_del=<?php echo $key['q_id'];?>' class="btn btn-outline-danger">Удалить</a>
                      </div>
                </div>
                </form>

            <?php 
                    $free_answ = checkAnswers($key['q_id'], $db);
                    if (empty($free_answ)) { ?>
                <form method="post">
                    <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Правильный ответ</span>
                            </div>
                            <input type="text" class="form-control" name="o_body">
                            <input type="hidden" name="flag" value="1">
                            <input type="hidden" name="id_q" value="<?php echo $key['q_id']; ?>">
                             <div class="input-group-append">
                                <button class="btn btn-outline-success" name="add_options" type="submit">Сохранить</button>
                            </div>
                    </div>
                </form>

                <?php } else { 
                    ?>
                    <form method="post">
                    <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Правильный ответ</span>
                            </div>
                            <input type="text" class="form-control" name="o_body" value="<?php echo $free_answ[0]['o_body'];?>">
                            <input type="hidden" name="a_id" value="<?php echo $free_answ[0]['id_answ'];?>">
                            <input type="hidden" name="flag" value="1">
                             <div class="input-group-append">
                                <button class="btn btn-outline-success" name="edita" type="submit">Сохранить</button>
                            </div>
                    </div>
                </form>
                <?php }
                 ?>
                <!-- свободный ввод ответа -->
            </div>
<?php
  $n++;  
}
    ?>
    <?php  } ?>

            <div class="container mb-5">
                    <h4>Добавить вопрос</h4>
                <form method="POST">
                    <input type="hidden" name="test_id" value="<?php echo $_GET['test']; ?>">
                    <div class="form-group">
                        <label>Введите вопрос:</label>
                        <textarea class="form-control" name="q_body" rows="4"></textarea>
                    </div>  
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <select class="custom-select" name="a_type" id="myInputGroupSelect">
                                    <option value="0">Один ответ</option>
                                    <option value="1">Множественный ответ</option>
                                    <option value="2">Свободный ввод</option>
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="myInputGroupSelect">Формат ответа</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <input type="submit" class="btn btn-danger btn-block" name="addq" value="Добавить">
                        </div>
                    </div>
                </form> 
                </div> 
        <?php } ?>
<?php
require_once "inc/footer.php";


