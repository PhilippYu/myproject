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
    <?php include 'db.php'; ?>
    <?php include 'api.php';?>
    <?php
    $expenses = searchExpenses($db);
    ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Email</th>
            <th>Период(Месяц или период времени)</th>
            <th>Еда</th>
            <th>Квартплата</th>
            <th>Одежда</th>
            <th>Товары для дома и здоровья</th>
            <th>Развлечения</th>
            <th>Хобби</th>
            <th>Личная гигиена</th>
            <th>Уход за любой техникой</th>
            <th>Другие расходы</th>
            <?php if(isset($_SESSION['user'])) { ?>
            <?php if($_SESSION['user'] == 'admin'){ ?>
                <th>Удалить</th>
            <?php }} ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($expenses as $expense){ ?>
            <tr id="myUL">
                <!--                    <td><a href="edit.php?id=--><?php //echo $expense['id'] ?><!--">--><?php //echo $expense['email']?><!--</a></td>-->
                <td> <?php echo $expense['email']?></td>
                <td> <?php echo $expense['period']?></td>
                <td> <?php echo $expense['food']?></td>
                <td> <?php echo $expense['housing']?></td>
                <td> <?php echo $expense['clothes']?></td>
                <td> <?php echo $expense['home_and_Health_Products']?></td>
                <td> <?php echo $expense['entertainment']?></td>
                <td> <?php echo $expense['hobbies']?></td>
                <td> <?php echo $expense['personal_care']?></td>
                <td> <?php echo $expense['caring_for_appliances']?></td>
                <td> <?php echo $expense['other_expenses']?></td>
                <?php if(isset($_SESSION['user'])) { ?>
                <?php if($_SESSION['user'] == 'admin'){ ?>
                    <td><a class="btn btn-danger" href="delete.php?email_id=<?php echo $expense['id'] ?>">Удалить</a></td>
                <?php }} ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<div id="footer">

    <div class="calculator" style="float: right; margin-right: 50px">
        <script>var fm = "BYN";var to = "USD";var tz = "timezone";var sz = "320x289";var lg = "ru";var st = "default";var lr = "0";var rd = "0";</script>
        <a href="https://ru.currencyrate.today/converter-widget" title="Конвертер валют">
        <script src="//currencyrate.today/converter"></script></a>
    </div>

        <script>
            $("#addButton").click(function(){
                $("form").slideDown();
            });
        </script>
</div>
</body>
</html>