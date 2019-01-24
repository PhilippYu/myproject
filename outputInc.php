<?php
session_start();
?>

<!DOCTYPE html>
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
<!--                    <li><a href="statistic.php">Статистика</a></li>-->
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
    <form method='POST' action='searchIncome.php' name='search_form'>
        <div class="col-lg-3" style="float: right">
            <label for="">Поиск своей записи по Email</label>
            <div class="input-group">
                <input type="text" class="form-control" name='search_email' value='' placeholder="Введите Email...">
                <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name='search_button' value='Поиск'>Поиск</button>
            </span>
            </div>
        </div>
    </form>
    <?php if(isset($_SESSION['user'])) { ?>
        <button id="addButton" class="btn btn-primary" style="margin-top: 30px; margin-left: 30px">Добавить запись доходов</button>
    <?php } ?>
    <form action="" method="POST" role="form" style="display: none; margin-top: 20px;margin-left: 30px">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="">
            <label for="">Период(Месяц или период времени)</label>
            <input type="text" class="form-control" id="period" name="period" placeholder="">
            <label for="">Зарплата с основной работы</label>
            <input type="text" class="form-control" id="salary" name="salary" placeholder="">
            <label for="">Подработка</label>
            <input type="text" class="form-control" id="part_time_job" name="part_time_job" placeholder="">
            <label for="">Дивиденты</label>
            <input type="text" class="form-control" id="dividends" name="dividends" placeholder="">
            <label for="">Другие доходы</label>
            <input type="text" class="form-control" id="other_income" name="other_income" placeholder="">
        </div>
        <button type="submit" class="btn btn-default">Добавить</button>
    </form>
    <div class="container-fluid">
        <?php include 'db.php'; ?>
        <?php include 'api.php'; ?>
        <?php
        $income = getAllIncome($db);
        ?>
        <table class="table table-hover" style="margin-top: 70px">
            <thead>
            <tr>
                <th>Email</th>
                <th>Период(Месяц или период времени)</th>
                <th>Зарплата с основной работы</th>
                <th>Подработка</th>
                <th>Дивиденты</th>
                <th>Другие доходы</th>
<!--                --><?php //if(isset($_SESSION['user'])) { ?>
<!--                    <th>Удалить</th>-->
<!--                --><?php //} ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($income as $incomes){ ?>
                <tr>
<!--                    <td><a href="edit.php?id=--><?php //echo $incomes['id'] ?><!--">--><?php //echo $incomes['email']?><!--</a></td>-->
<!--                    <td><a href="edit.php">--><?php //echo $incomes['salary']?><!--</a></td>-->
<!--                    <td><a href="edit.php">--><?php //echo $incomes['part_time_job']?><!--</a></td>-->
<!--                    <td><a href="edit.php">--><?php //echo $incomes['dividends']?><!--</a></td>-->
<!--                    <td><a href="edit.php">--><?php //echo $incomes['other_income']?><!--</a></td>-->
                    <td><?php echo $incomes['email']?></td>
                    <td><?php echo $incomes['period']?></td>
                    <td><?php echo $incomes['salary']?></td>
                    <td><?php echo $incomes['part_time_job']?></td>
                    <td><?php echo $incomes['dividends']?></td>
                    <td><?php echo $incomes['other_income']?></td>
<!--                    --><?php //if(isset($_SESSION['user'])) { ?>
<!--                        <td><a class="btn btn-danger" href="delete.php?email_id=--><?php //echo $incomes['id'] ?><!--">Удалить</a></td>-->
<!--                    --><?php //} ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
            <p><?php echo "<p style='margin-left: 10px'>*Все суммы указаны в Белорусских рублях(BYN), формат вывода rub.coins.</p>" ?></p>
        <?php
        if(isset($_POST['email']) && $_POST['email'] != '') {
            $email = $_POST['email'];
            $period = $_POST['period'];
            $salary = $_POST['salary'];
            $part_time_job = $_POST['part_time_job'];
            $dividends = $_POST['dividends'];
            $other_income = $_POST['other_income'];
            addIncome($db, $email,$period,$salary,$part_time_job,$dividends,$other_income);
        }

        ?>

    </div>

</div>
<div id="footer">
    <a href="#" title="Вернуться наверх" class="buttonup"><img src="arrow21.png"
     style="float: right; margin-right: 50px;margin-bottom: 15px; width: 40px; height: 60px;">
    </a>
</div>
<script>
    $("#addButton").click(function(){
        $("form").slideDown();
    });
</script>
</body>
</html>