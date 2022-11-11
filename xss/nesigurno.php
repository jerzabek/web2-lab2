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
  <h1>Primjer ne riješenog XSS-a</h1>

  <p>Vidimo da se prilikom učitanja stranice pokrenula skripta koju je neki drugi korisnik potencijalno spremio kroz neku formu.</p>
  <p>Neopreznim ispisom/bez sanitizacije podataka prilikom spremanja ova ranjivost je prisutna.</p>
  <p>Pritisnite <a href="index.php">ovdje</a> kako biste vidjeli sigurnu verziju ovog koda.</p>

  <div id="content">
    <?php foreach($data as $post):?>
      <h1><?php echo $post["title"];?></h1>
      <p><?php echo $post['text'];?></p>
      <hr />
    <?php endforeach;?>
  </div>
</body>

</html>