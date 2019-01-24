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
            </div>
        </div>
    </nav>
</header>
<div id="content">
    <div class="container-fluid">
        <?php include 'db.php'; ?>
        <?php include 'api.php'; ?>
        <?php
        $id = $_GET['email_id'];
        $incomes = deleteIncome($db, $id);
        $expense = deleteExpenses($db,$id);
        echo "<h1>Операция прошла успешно!</h>";
        ?>

<!--        --><?php //include 'db.php'; ?>
<!--        --><?php //include 'api.php'; ?>
<!--        --><?php
//        $email = $_GET['email_id'];
//        $expense = deleteExpenses($db,$email);
//        ?>



    </div>
</div>
<div id="footer">

</div>
</body>
</html>