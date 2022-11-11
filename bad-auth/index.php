<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web2Lab2</title>
  <style>
    #error {
      color: red;
    }
  </style>
</head>
<body>
  <h1>Primjer loše autentifikacije.</h1>
  <p>Pritisnite <a href="/good-auth">ovdje</a> za primjer dobre autentifikacije</p>
  <p>Vidimo na ovom primjeru više značajki loše autentifikacije.</p>
  <ul>
    <li>Sjednice su jednostavna vrijednost ("session1", "session2") koje je jednostavno pogoditi</li>
    <li>Sjednice su pohranjene u localStorage prostoru koji se lako uređuje (pokušajte promjeniti vrijednost sesije)</li>
    <li>Korisnički podaci (username/password) su vrlo jednostavni te se šalju GET metodom (vidljivi su u URL-u)</li>
  </ul>

  <p id="error"></p>

  <p id="secret">Niste prijavljeni.</p>

  <form id="login_form" onsubmit="return handleSubmit(event)" method="GET" action="index.php">
    <label for="username">Korisničko ime:</label>
    <input type="text" name="username" id="username">
    <br/>

    <label for="password">Lozinka:</label>
    <input type="password" name="password" id="password">
    <br/>

    <input type="submit" value="Prijavi se">
  </form>

  <button onclick="logout()">Odjava</button>

  <script>
    function handleSubmit(e) {
      e.preventDefault()
      const username = document.getElementById('username').value
      const password = document.getElementById('password').value

      fetch(`login.php?username=${username}&password=${password}`)
      .then(res => res.json())
      .then(({success, message, session}) => {
        if(!success) {
          document.getElementById('error').textContent = message
          return
        }

        localStorage.setItem('session_id', session)
        location.reload()
      })
    }

    window.onload = function() {
      const session_id = localStorage.getItem('session_id');

      if(!session_id) {
        return;
      }

      document.getElementById('login_form').remove()

      fetch("get_user_data.php?session_id=" + session_id)
        .then(res => res.json())
        .then(({success, secret, message}) => {
        if(!success) {
          document.getElementById('error').textContent = message
          return
        }
        
        document.getElementById('secret').textContent = secret
        })
    }

    function logout() {
      localStorage.removeItem('session_id');
      location.reload()
    }
  </script>
</body>
</html>