<?php
//подрубаем ДБ и функции
require_once 'lib/Database.php';
require_once 'lib/functions.php';

$db = new Database;
// выводим все тесты и ответы
$allTests = getAllTestInnerJoinCategory($db);
$allOptions = getOptions($db);
// подключаем хэдер
require_once "inc/header.php";
//добавления вопроса
if (isset($_POST['addq'])) {
        $test_id = (int) $_POST['test_id'];
        $q_body = htmlspecialchars($_POST['q_body']);
        $a_type = (int) $_POST['a_type'];

    if (addQuestion($q_body, $a_type, $test_id, $db)) {
            header('Location: http://localhost/tarasov/details.php?test='.$test_id);
    }   
}
// добавление варианта ответа
if (isset($_POST['add_opt'])) {
    $o_body = htmlspecialchars($_POST['o_body']);
    $o_cflg = (int) $_POST['o_cflg']; 
    $q_id = (int) $_POST['q_id']; 
    $t_id = (int) $_POST['test_id']; 
    if (addOptions($o_body, $o_cflg, $q_id, $db)) {
            header('Location: http://localhost/tarasov/details.php?test='.$t_id .'&q_add=' .$q_id);
    }   
}
// удаление ответа на вопрос
if (isset($_GET['o_del'])) {
    delOptions($_GET['o_del'],$db);
    header('location: http://localhost/tarasov/details.php?test='. $_GET['test']);
}
// удаление вопроса
if (isset($_GET['q_del'])) {
    delQuestions($_GET['q_del'],$db);
    header('location: http://localhost/tarasov/details.php?test='. $_GET['test']);
}
//редактировать вопрос

if (isset($_POST['editq'])){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    var_dump($_POST);
    $edit_q_body = htmlspecialchars($_POST['q_body']);
    updQuestions($_GET['q_edit'], $edit_q_body, $db);
    header('location: http://localhost/tarasov/details.php?test='. $_GET['test']);
}
// редактировать варианты ответа 
if(isset($_POST['edit_opt'])) {
    $upd_o_id = (int) $_POST['o_id'];
    $upd_o_body = htmlspecialchars($_POST['o_body']);
    $upd_o_cflg = (int) $_POST['o_cflg'];
    updOptions($upd_o_id, $upd_o_body, $upd_o_cflg, $db);
    header('location: http://localhost/tarasov/details.php?test='. $_GET['test']);
}
?>

<div class="row">
    <div class="col-4">
        <?php if (isset($_GET['test'])) { 
                if(isset($_GET['q_edit'])){ 
                    $edit_id = trim($_GET['q_edit']);
                    $single_q = getSingleQuestion($edit_id, $db);
                    ?>
                <div class="container">
            <a href="details.php" class="btn btn-block btn-danger mt-3">Назад</a>
                    <h4>Редактировать текст вопроса</h4>
                <form method="POST">
                    <input type="hidden" name="q_id" value="<?php echo $_GET['q_edit']; ?>">
                    <div class="form-group">
                        <label>Введите вопрос:</label>
                        <textarea class="form-control" name="q_body" rows="4"><?php echo $single_q['0']['q_name']?></textarea>
                    </div>  
                    <input type="submit" class="btn btn-primary btn-block" name="editq" value="Редактировать">
                </form> 
                </div>    
                <?php  } else { ?>
            <div class="container">
            <a href="details.php" class="btn btn-block btn-danger mt-3">Назад</a>
                    <h4>Добавить вопрос</h4>
                <form method="POST">
                    <input type="hidden" name="test_id" value="<?php echo $_GET['test']; ?>">
                    <div class="form-group">
                        <label>Введите вопрос:</label>
                        <textarea class="form-control" name="q_body" rows="4"></textarea>
                    </div>  
                    <label>Формат ответа:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a_type" value="0" checked>
                        <label class="form-check-label">
                        Один ответ
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a_type" value="1">
                        <label class="form-check-label">
                        Множественный ответ
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a_type" value="2">
                        <label class="form-check-label">
                        Свободный ввод
                        </label>
                    </div>
                    <input type="submit" class="btn btn-danger btn-block" name="addq" value="Добавить">
                </form> 
                </div>   
                <?php }?>
            <?php } else { ?>

            <div class="card">
                <div class="card-header">
                    <h4>Выбирете тест</h4>
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
        <?php } ?>
    </div>

    <div class="col-4">
        
<?php if (isset($_GET['test'])) { 
        $all_q = getQuestions($_GET['test'], $db);
            $n = 1;
    foreach ($all_q as $key) { 
            ?>
        <div class="card">
            <h5 class="card-header">Вопрос №
                    <?php echo $n;?> 
                    <a href="?test=<?php echo $key['test_id'];?>&q_add=<?php echo $key['q_id'];?>" class="btn btn-danger float-right">
                    Добавить ответ
                </a>
            </h5>
                <div class="card-body">
                  <h6 class="card-title">
                      <?php echo $key['q_name'];?>
                        <a href="?test=<?php echo $key['test_id'];?>&q_del=<?php echo $key['q_id'];?>" class="text-danger float-right mx-1"><i class="fas fa-trash-alt"></i></a> 
                        <a href="?test=<?php echo $key['test_id'];?>&q_edit=<?php echo $key['q_id'];?>" class="text-primary float-right mx-1"><i class="fas fa-edit"></i></a>
                        
                </h6>
                
                <?php 
                foreach ($allOptions as $value) {
                    if ($value['id_q'] == $key['q_id']) {
                ?>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <?php echo $value['o_body'];?>
                                <a class="float-right text-danger mx-1" href="?test=<?php echo $key['test_id'];?>&o_del=<?php echo $value['id_answ'];?>">
                                <i class="fas fa-trash-alt"></i>
                                </a>
                                <a class="float-right mx-1" href="?test=<?php echo $key['test_id'];?>&o_edit=<?php echo $value['id_answ'];?>"><i class="fas fa-edit"></i></a>
                            </li>
                        </ul>
                        <?php
                    } 
                }
                ?>
              </div>
            </div>
        <?php 
            $n++;    
    }
} 
            ?>  
    </div>
    <div class="col-4 p-3">


        <?php if (isset($_GET['q_add'])) {  ?>
            <div class="col-10">
            <form method="post">
                <div class="form-group">
                    <label>Введите вариант ответа:</label>
                    <input type="hidden" name="q_id" value="<?php echo $_GET['q_add'];?>">
                    <input type="hidden" name="test_id" value="<?php echo $_GET['test'];?>">
                    <input type="text" class="form-control" name="o_body" placeholder="Вариант ответа">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="o_cflg" value='0' checked>
                    <label class="form-check-label">
                        Ответ неверный
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="o_cflg" value='1'>
                    <label class="form-check-label">
                        Ответ верный
                    </label>
                </div>
                <input type="submit" name="add_opt" class="btn btn-block btn-danger">
            </form>
            </div>
        <?php   } elseif (isset($_GET['o_edit'])) { 
            $edit_id = $_GET['o_edit'];
            $single_option = getSingleOption($edit_id,$db);
            ?>
            <div class="col-10">
            <form method="post">
                <div class="form-group">
                    <label>Отредактируйте вариант ответа:</label>
                    <input type="hidden" name="o_id" value="<?php echo $_GET['o_edit'];?>">
                    <input type="text" class="form-control" name="o_body" placeholder="Ваш вариант ответа" value="<?php echo $single_option[0]['o_body'];?>">
                </div>
                <?php if($single_option[0]['o_cflg'] == 0) { ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="o_cflg" value='0' checked >
                        <label class="form-check-label">
                            Ответ неверный
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="o_cflg" value='1' >
                        <label class="form-check-label">
                            Ответ верный
                        </label>
                    </div>
                <?php } else { ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="o_cflg" value='0' >
                    <label class="form-check-label">
                        Ответ неверный
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="o_cflg" value='1'checked>
                    <label class="form-check-label">
                        Ответ верный
                    </label>
                </div>
                <?php } ?>
                <input type="submit" name="edit_opt" class="btn btn-block btn-primary">
            </form>
            </div>
       <?php } else {
            echo 'Вы должны выбрать вопрос для добавления вариантов ответа или редактирования!';
        }
        ?>
    </div>
</div>

<?php

require_once "inc/footer.php";


