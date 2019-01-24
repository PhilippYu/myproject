<?php

session_start();
include 'db.php';
include 'api.php';

if(!empty($_POST)) {

    if($_POST['login'] != '' && $_POST['password'] != '') {
        $login = trim(strip_tags($_POST['login']));
        $password = trim(strip_tags($_POST['password']));
        if(isUser($db, $login, $password)) {
            $_SESSION['user'] = $login;
        } else {
            echo "<h3>Проверьте имя пользователя или пароль</h3>";
        }
    } else {
        echo "<h1>Заполните все поля</h1>";
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Philipp Yurkovski</title>
    <style>
        body{
            background: url("Background.png");
        }
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">I&E</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Главная</a></li>
                        <li><a href="outputInc.php">Доходы</a></li>
                        <li><a href="outputExp.php">Расходы</a></li>
<!--                        <li><a href="statistic.php">Статистика</a></li>-->
                    </ul>
                    <div class="pull-right">
                        <?php if(isset($_SESSION['user'])) { ?>
                            <p style="color: gray">Пользователь: <?php echo $_SESSION['user'];  ?></p>
                            <p><a href="logout.php">Выйти</a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div id="content">
        <div class="container-fluid">
            <div class="enter">
            <button id="addButton2" class="btn btn-primary" style="float: right; margin-bottom: 10px; margin-right: 10px">Войти</button>
            <?php if(!isset($_SESSION['user'])) { ?>
                <form action="" method="POST" role="form" style="display: none; margin-top: 20px; margin-bottom: 20px">
                    <div class="form-group">
                        <label for="">Логин</label>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                    <div class="form-group">
                        <label for="">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            <?php } ?>
            </div>
            <div class="registr">
                <a class="btn btn-primary" href="signup.php" style="float: right; margin-bottom: 10px;margin-right: 10px">Регистрация</a>
<!--                --><?php
//                if(isset($_POST['login_id']) && $_POST['login_id'] != '') {
//                    $login1 = $_POST['login_id'];
//                    $password1 = $_POST['password_id'];
//                    addUser($db,$login1,$password1);
//                }
//                ?>
            </div>
        </div>
        <div class="jumbotron" style="background-color: whitesmoke">
            <h1 style="margin-left: 30px">Учёт доходов и расходов семьи</h1>
            <p style="margin-left: 50px">Курсовой проект выполнил студент группы МС-32, Юрковский Филипп</p>
        </div>
    </div>
    <div id="footer">
<!--        <iframe width="170" height="170" style="float: right" src="http://www.calculator888.ru/outdoor/widget-new-year.html#3"-->
<!--                scrolling="no" frameborder="0"></iframe><br>-->

    </div>
<!--    <script>-->
<!--        $("#addButton").click(function(){-->
<!--            $("form").slideDown();-->
<!--        });-->
<!--    </script>-->
    <script>
        $("#addButton2").click(function(){
            $("form").slideDown();
        });
    </script>
</body>
</html>