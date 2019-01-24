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
    <form method='POST' action='searchExpenses.php' name='search_form'>
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
        <button id="addButton" class="btn btn-primary" style="margin-top: 30px; margin-left: 30px">Добавить запись расходов</button>
    <?php } ?>
    <form action="" method="POST" role="form" style="display: none; margin-top: 20px;margin-left: 30px">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" id="email_id" name="email" placeholder="">
            <label for="">Период(Месяц или период времени)</label>
            <input type="text" class="form-control" id="period" name="period" placeholder="">
            <label for="">Еда</label>
            <input type="text" class="form-control" id="food" name="food" placeholder="">
            <label for="">Квартплата</label>
            <input type="text" class="form-control" id="housing" name="housing" placeholder="">
            <label for="">Одежда</label>
            <input type="text" class="form-control" id="clothes" name="clothes" placeholder="">
            <label for="">Товары для дома и здоровья</label>
            <input type="text" class="form-control" id="home_and_Health_Products" name="home_and_Health_Products" placeholder="">
            <label for="">Развлечения</label>
            <input type="text" class="form-control" id="entertainment" name="entertainment" placeholder="">
            <label for="">Хобби</label>
            <input type="text" class="form-control" id="hobbies" name="hobbies" placeholder="">
            <label for="">Личная гигиена</label>
            <input type="text" class="form-control" id="personal_care" name="personal_care" placeholder="">
            <label for="">Уход за любой техникой</label>
            <input type="text" class="form-control" id="caring_for_appliances" name="caring_for_appliances" placeholder="">
            <label for="">Другие расходы</label>
            <input type="text" class="form-control" id="other_expenses" name="other_expenses" placeholder="">
        </div>
        <button type="submit" class="btn btn-default">Добавить</button>
    </form>
    <div class="container-fluid">
        <?php include 'db.php'; ?>
        <?php include 'api.php'; ?>
        <?php
            $expenses = getAllExpenses($db);
        ?>
        <table class="table table-hover" style="margin-top: 70px">
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
<!--                --><?php //if(isset($_SESSION['user'])) { ?>
<!--                <th>Удалить</th>-->
<!--                --><?php //} ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($expenses as $expense){ ?>
                <tr>
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
<!--                    --><?php //if(isset($_SESSION['user'])) { ?>
<!--                    <td><a class="btn btn-danger" href="delete.php?email_id=--><?php //echo $expense['id'] ?><!--">Удалить</a></td>-->
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
            $food = $_POST['food'];
            $housing = $_POST['housing'];
            $clothes = $_POST['clothes'];
            $home_and_Health_Products = $_POST['home_and_Health_Products'];
            $entertainment = $_POST['entertainment'];
            $hobbies = $_POST['hobbies'];
            $personal_care = $_POST['personal_care'];
            $caring_for_appliances = $_POST['caring_for_appliances'];
            $other_expenses = $_POST['other_expenses'];
            addExpenses($db, $email,$period,$food,$housing,$clothes,$home_and_Health_Products,$entertainment,$hobbies,$personal_care,$caring_for_appliances,$other_expenses);
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
<script>
    $("#addButton2").click(function(){
        $("form").slideDown();
    });
</script>
</body>
</html>