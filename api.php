<?php

function getAllExpenses($db){
    $sql = "SELECT * FROM expenses";
    $result = array();

    $stmt = $db -> prepare($sql);

    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $result[$row['id']] = $row;
    }

    return $result;
}

function getAllIncome($db){
    $sql = "SELECT * FROM income";
    $result = array();

    $stmt = $db -> prepare($sql);

    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $result[$row['id']] = $row;
    }

    return $result;
}

function getIncomeById($db, $id){
    $sql = "SELECT * FROM income WHERE id=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt -> execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function saveEmailIncome($db, $name, $id){
    $sql = "UPDATE income
            SET email = :email
            WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $name, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}


function addIncome ($db, $email,$period, $salary, $partTimeJob, $dividends, $other_income){
    $sql = "INSERT INTO income(email,period,salary,part_time_job,dividends,other_income)
            VALUES (:email,:period,:salary,:part_time_job,:dividends,:other_income)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':period', $period, PDO::PARAM_STR);
    $stmt->bindValue(':salary', $salary, PDO::PARAM_INT);
    $stmt->bindValue(':part_time_job', $partTimeJob, PDO::PARAM_INT);
    $stmt->bindValue(':dividends', $dividends, PDO::PARAM_INT);
    $stmt->bindValue(':other_income', $other_income, PDO::PARAM_STR);
    $stmt->execute();
}

function addExpenses ($db, $email,$period,$food,$housing,$clothes,$home_and_Health_Products,$entertainment,$hobbies,$personal_care,$caring_for_appliances,$other_expenses){
    $sql = "INSERT INTO expenses(email,period,food,housing,clothes,home_and_Health_Products, entertainment, hobbies,personal_care,caring_for_appliances,other_expenses)
            VALUES (:email,:period,:food,:housing,:clothes,:home_and_Health_Products,:entertainment,:hobbies,:personal_care,:caring_for_appliances,:other_expenses)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':period', $period, PDO::PARAM_STR);
    $stmt->bindValue(':food', $food, PDO::PARAM_INT);
    $stmt->bindValue(':housing', $housing, PDO::PARAM_INT);
    $stmt->bindValue(':clothes', $clothes, PDO::PARAM_INT);
    $stmt->bindValue(':home_and_Health_Products', $home_and_Health_Products, PDO::PARAM_INT);
    $stmt->bindValue(':entertainment', $entertainment, PDO::PARAM_STR);
    $stmt->bindValue(':hobbies', $hobbies, PDO::PARAM_INT);
    $stmt->bindValue(':personal_care', $personal_care, PDO::PARAM_INT);
    $stmt->bindValue(':caring_for_appliances', $caring_for_appliances, PDO::PARAM_INT);
    $stmt->bindValue(':other_expenses', $other_expenses, PDO::PARAM_STR);
    $stmt->execute();
}

function addUser($db,$login,$password){
    $sql = "INSERT INTO users(login,password)
            VALUES (:login,:password)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':login', $login, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
}

function deleteIncome($db,$id){
    $sql = "DELETE FROM income WHERE id=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    $stmt->execute();
}

function deleteExpenses($db,$id){
    $sql = "DELETE FROM expenses WHERE id=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    $stmt->execute();
}

function isUser($db, $user, $password){
    $sql = "SELECT login, password FROM users WHERE login=:login AND password=:password";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":login", $user, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);

    $stmt -> execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($row)){
        return true;
    }else{
        return false;
    }
}

function searchIncome($db)
{
    $result = array();
    if (isset($_POST['search_button'])) {
        $email = $_POST['search_email'];
        $stmt = $db->prepare("SELECT * FROM income WHERE `email` = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }
}
function searchExpenses($db)
{
    $result = array();
    if (isset($_POST['search_button'])) {
        $email = $_POST['search_email'];
        $stmt = $db->prepare("SELECT * FROM expenses WHERE `email` = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }
}



