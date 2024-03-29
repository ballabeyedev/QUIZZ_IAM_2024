<?php
require_once("connexion.php");

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['passwd'], $_POST['confirm_passwd'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $confirm_passwd = $_POST['confirm_passwd'];

        if ($passwd !== $confirm_passwd) {
            $message = '<div class="error1">Les mots de passe ne correspondent pas.</div>';
        } else {
            $checkLoginQuery = $connect->prepare("SELECT * FROM administrateur WHERE login_admin = ?");
            $checkLoginQuery->execute([$login]);

            if ($checkLoginQuery->rowCount() > 0) {
                $message = '<div class="error1">Un administrateur avec ce login existe déjà.</div>';
            } else {
                $adminQuery = $connect->prepare("INSERT INTO administrateur (nom_admin, prenom_admin, login_admin, passwd_admin) VALUES (?, ?, ?, ?)");
                $adminQuery->execute([$nom, $prenom, $login, $passwd]);
                
                $message = '<div class="success">Admin inséré avec succès.</div>';
            }
        }
    } else {
        $message = '<div class="error1">Les données nécessaires ne sont pas définies.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .footer1 {
            color: red;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-top: 10px;
            margin-left: -100px;
        }

        .pieds {
            margin: 0;
        }
        .tq{
            margin-top: -610px;
            margin-left: 250px;
        }
        .h3{
            text-decoration: underline;
            margin-left: 350px;
        }
        .logo{
            height:680px;
            margin-top: -90px;
        }
        .disconnect{
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error1 {
            color: #ff0000;
            margin-bottom: 10px;
            margin-left: 760px;
            margin-top: -40px;
        }

        .success {
            color: #008000;
            margin-bottom: 10px;
            margin-left: 760px;
            margin-top: -40px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="image/logo.png">
        <ul>
            <li><a href="admin.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="deconnexion.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit" class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="tq">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <hr class="hr">
        <h3 class="h3">AJOUTER UN ADMINISTRATEUR</h3>
        <div class="ins"><img src="image/aq.png" alt=""></div>
        <form class="login" method="post" id="myform">
            <input type="text" name="nom" id="nom" placeholder="Nom" required>
            <br>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
            <br>
            <input type="text" name="login" id="login" placeholder="Adresse mail" required>
            <br>
            <input type="password" name="passwd" id="passwd" placeholder="Mot de Passe" required>
            <br>
            <input type="password" name="confirm_passwd" id="confirm_passwd" placeholder="Confirmer le Mot de Passe" required>
            <br>
            <select name="profils" id="profils" required>
                <option value="" disabled selected>Sélectionnez un profil</option>
                <option value="admin">admin</option>
            </select><br><br>
            <div class="error-message" id="error-message"><?= isset($error) ? $error : "" ?></div>
            <button type="submit">S'Inscrire →</button>
        </form>
    </div>
    <script>
        const form = document.getElementById('myform');
        const nom = document.getElementById('nom');
        const prenom = document.getElementById('prenom');
        const email = document.getElementById('login');
        const passwd = document.getElementById('passwd');
        const passwdconfirm = document.getElementById('confirm_passwd');
        const profils = document.getElementById('profils');
        const errorsDiv = document.getElementById('error-message');
        const button = document.querySelector('.login button');

        form.addEventListener('input', validateForm);

        function resetForm() {
            form.reset();
        }

        function validateForm() {
            errorsDiv.innerHTML = '';
            let hasErrors = false;

            if (nom.value === '') {
                displayError('Le champ nom est obligatoire.');
                hasErrors = true;
            }

            if (prenom.value === '') {
                displayError('Le champ prenom est obligatoire.');
                hasErrors = true;
            }
            if (email.value === '') {
                displayError('Le champ email est obligatoire.');
                hasErrors = true;
            }

            if (passwd.value === '') {
                displayError('Le champ mot de passe est obligatoire.');
                hasErrors = true;
            }
            if (passwdconfirm.value === '') {
                displayError('Le champ confirmer mot de passe est obligatoire.');
                hasErrors = true;
            }
            if (profils.value === '') {
                displayError('Le champ profils est obligatoire.');
                hasErrors = true;
            }
            if(passwd.value != passwdconfirm.value){
                displayError('Les mots de passe ne sont pas identiques.');
                hasErrors = true;
            }

            button.disabled = hasErrors;
        }

        function displayError(errorMessage) {
            const errorPara = document.createElement('p');
            errorPara.classList.add('error');
            errorPara.textContent = errorMessage;
            errorsDiv.appendChild(errorPara);
        }
    </script>
    <?= $message ?>
    <footer class="footer1">
        <p class="pieds">LesTroisFantastiques  © copyright iam big 2024</p>
    </footer>
</body>
</html>
