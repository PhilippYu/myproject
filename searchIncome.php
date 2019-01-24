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
    $income = searchIncome($db);
    ?>
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th>Email</th>
            <th>Период(Месяц или период времени)</th>
            <th>Зарплата с основной работы</th>
            <th>Подработка</th>
            <th>Дивиденты</th>
            <th>Другие доходы</th>
            <?php if(isset($_SESSION['user'])) { ?>
            <?php if($_SESSION['user'] == 'admin'){ ?>
                <th>Удалить</th>
            <?php }} ?>
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
            <?php if(isset($_SESSION['user'])) { ?>
                <?php if($_SESSION['user'] == 'admin'){ ?>
                <td><a class="btn btn-danger" href="delete.php?email_id=<?php echo $incomes['id'] ?>">Удалить</a></td>
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


<!--    <form method="post" name="form">-->
<!--        <ul>-->
<!--            <li>Фильтр-->
<!--                <ul>-->
<!--                    <li>Период времени <input name="period" type="text"/></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->
<!--        <input name="filter" type="submit" value="Подобрать"/>-->
<!--    </form>-->
<!--    --><?php
//    function addFilterCondition($where, $add, $and = true)
//    {
//        if ($where) {
//            if ($and) $where .= " AND $add";
//            else $where .= " OR $add";
//        } else $where = $add;
//        return $where;
//    }
//
//    function getMainQuery() {
//        return 'SELECT * FROM income';
//    }
//
//    if (!empty($_POST["filter"])) {
//        $sql = getMainQuery();
//        $where = "";
//
//        if ($_POST["period"]) {
//            $where = addFilterCondition($where, "period = '" . htmlspecialchars($_POST["period"])) . "'";
//        }
//
//        if ($where) {
//            $sql .= " WHERE $where";
//        } else {
//            $sql .= " WHERE ";
//        }
//    }
//
//    echo '<h1>Получили такой SQL запрос:</h1>' . $sql;
//
//    $stmt = $pdo->prepare($sql);
//    $stmt->execute($ids);
//    $resultsCount = $stmt->rowCount();
//
//    echo "<h2>В результате найдено: {$resultsCount} строк </h2>";
//    ?>
<!--    </form>-->
<!--        <button id="addButton" class="btn btn-primary" style="margin-top: 30px; margin-left: 30px">Фильтр</button>-->
<!--        <form action="" method="POST" role="form" style="display: none; margin-top: 20px;margin-left: 30px">-->
<!--            <div class="col-lg-3">-->
<!--                <div class="form-group">-->
<!--                    <label for="">Период(Месяц или период времени)</label>-->
<!--                    <input type="text" name="period" class="form-control" placeholder="Введите период времени">-->
<!--                </div>-->
<!--                <button type="submit" name="filter" class="btn btn-default">Поиск</button>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        --><?php
//        function addWhere($where, $add, $and = true) {
//            if ($where) {
//                if ($and) $where .= " AND $add";
//                else $where .= " OR $add";
//            }
//            else $where = $add;
//            return $where;
//        }
//        if (!empty($_POST["filter"])) {
//            $where = "";
//            if ($_POST["period"]) $where = addWhere($where, "`period` >= '".htmlspecialchars($_POST["period"]))."'";
//
//            $sql = "SELECT * FROM `income`";
//            if ($where) $sql .= " WHERE $where";
//            echo $sql;
//        }
//        ?>
<!--        <script>-->
<!--            $("#addButton").click(function(){-->
<!--                $("form").slideDown();-->
<!--            });-->
<!--        </script>-->
</div>

</body>
</html>