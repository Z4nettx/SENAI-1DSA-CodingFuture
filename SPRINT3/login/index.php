<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Cervejaria Dogma</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
</head>

<body>
  <div class="background"></div>

  <main>
    <img src="../assets/logo.png" alt="Logotipo da Cervejaria Dogma" />
    <h1>Fazer login</h1>

    <form action="login.php" id="loginForm" method="post">
      <label for="email"></label>
      <input type="email" id="email" name="email" placeholder="E-mail" required autocomplete="off" />
      <input type="password" id="password" name="senha" placeholder="Insira sua senha" required autocomplete="off" />
      <button type="submit">Continuar</button>
    </form>

    <footer>
      <nav>
        <ul>
          <li><a href="#">Política de privacidade</a></li>
          <li><a href="#">Termos de serviço</a></li>
          <li><a href="../cadastrousuario/">Não tem uma conta?</a></li>
        </ul>
      </nav>

      <div class="mensagem">
        <div class="mensagem">
          <?php if (!empty($mensagem)) echo $mensagem; ?>
        </div>
      </div>
    </footer>
  </main>
</body>

</html>