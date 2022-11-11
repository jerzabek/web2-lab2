<?php
session_start();

$database_content = [
  "user1" => [
    "password"    => "jhdfij$$",
    "secret"      => "Ovo je tajni sadržaj kojemu smije pristupiti samo user1...",
  ],
  "user2" => [
    "password"    => "=#)ask3#K",
    "secret"      => "Ovo je tajni sadržaj kojemu smije pristupiti samo user2...",
  ],
];

if(isset($_GET["login"]) && isset($_POST["username"]) && isset($_POST["password"])) {
  echo "Uspješna prijava";
  if(array_key_exists($_POST["username"], $database_content) && $database_content[$_POST["username"]]["password"] === $_POST['password']) {
    $_SESSION["user_data"] = $database_content[$_POST["username"]]["secret"];
  } else {
    echo "Neispravni podaci";
  }
}

if(isset($_GET["logout"])) {
  unset($_SESSION["user_data"]);
}

$_POST = array();
$_GET = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web2Lab2</title>
</head>
<body>
  <h1>Primjer dobre autentifikacije.</h1>
  <p>Ova metoda autentifikacije implementirana je pomoću PHP sjednica.</p>

  <p>
  <?php
    if (isset($_SESSION['user_data'])) {
      echo $_SESSION['user_data'];
    } else {
      echo "Niste prijavljeni...";
    }
  ?>
  </p>

  <?php if (isset($_SESSION['user_data'])):?>
    <form action="index.php?logout=1" method="POST">
      <input type="submit" value="Odjava">
    </form>
  <?php else:?>
    <form action="index.php?login=1" method="POST">
      <label for="username">Korisničko ime:</label>
      <input type="text" name="username" id="username">
      <br/>

      <label for="password">Lozinka:</label>
      <input type="password" name="password" id="password">
      <br/>

      <input type="submit" value="Prijavi se">
    </form>
  <?php endif;?>

</body>
</html>