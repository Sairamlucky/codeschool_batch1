<?php
include 'database.php';
include 'response.php';

if (!array_key_exists('username', $_POST)) {
    $response['status'] = false;
    $response['message'] = "Please enter a valid Username address";
    echo json_encode($response);
    return;
}
if (!array_key_exists('password', $_POST)) {
    $response['status'] = false;
    $response['message'] = "Please enter a Password address";
    echo json_encode($response);
    return;
}

    $statement = $pdo->prepare("SELECT * from users where username =? and password =?");
    $statement->execute([$_POST['username'], ($_POST['password'])]);
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (count($resultSet) == 0) {
        $response['status'] = false;
        $response['message'] = "username or Password incorrect";
        echo json_encode($response);
        return;
    }
      $response['status'] = true;
$response['message'] = "Login successful";
$response['data'] = $resultSet;
echo json_encode($response);
return;
?>