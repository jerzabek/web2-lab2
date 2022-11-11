<?php
// Imagine a database call happening here...
$data = [
  [
    "title" => "Ovo nije dobro",
    "text" => "<script>alert(\"Ovo je primjer XSS-a\");</script>"
  ],
  [
    "title" => "Ovaj je uredu",
    "text" => "Ovaj text nema nikakav kod."
  ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web2 Lab2</title>
</head>

<body>
  <h1>Primjer dobro riješenog XSS-a</h1>

  <p>Vidimo da se u tekstu komentara ispod nalazi HTML script tag, koji je ispisan na ekranu ali ga preglednik nije izveo. To je zato jer je prilikom ispisa na poslužitelju pravilno obrađen. Korak sanitizacije prilikom unosa podatka u sustav je najsigurniji način rješavanja ovog problema.</p>
  <p>Pritisnite <a href="nesigurno.php">ovdje</a> kako biste vidjeli nesigurnu verziju ovog koda.</p>

  <div id="content">
    <?php foreach($data as $post):?>
      <h1><?php echo htmlentities($post["title"]);?></h1>
      <p><?php echo htmlentities($post['text']);?></p>
      <hr />
    <?php endforeach;?>
  </div>
</body>

</html>