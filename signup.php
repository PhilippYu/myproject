<?php
session_start();
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
        <?php require_once 'rb-mysql.php';?>
        <?php include 'db.php'; ?>
        <?php include 'api.php'; ?>
        <?php
        $data = $_POST;
        if( isset($data['do_signup'])){

            $errors = array();
            if(trim($data['login'])==''){
                $errors[] = 'Введите логин!';
            }
            if($data['password']==''){
                $errors[] = 'Введите пароль!';
            }
//            if(R::count('users',"login = ?",array($data['login']))>0){
//                $errors[] = 'Пользователь с таким логином уже существует!';
//            }

            if(empty($errors)){
                $login = $_POST['login'];
                $password = $_POST['password'];
                addUser($db, $login, $password);
                echo "Регистрация прошла успешно!";
            }else{
                echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
            }
        }
        ?>
        <form action="signup.php" method="post">
            <div class="col-lg-5">
            <p>
                <p><strong>Ваш логин</strong></p>
                <input type="text" class="form-control" name="login" value="<?php echo @$data['login'];?>">
            </p>
            <p>
                <p><strong>Ваш пароль</strong></p>
                <input type="password" class="form-control" name="password">
            </p>
            <p>
                <button class="btn btn-primary" type="submit" name="do_signup" style="margin-left: 150px; margin-top: 30px">Зарегистрироваться</button>
            </p>
            </div>
        </form>
    </div>
</div>
<div id="footer">

</div>
</body>
</html>