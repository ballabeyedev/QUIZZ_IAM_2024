<?php

require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['passwd'], $_POST['confirm_passwd'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $confirm_passwd = $_POST['confirm_passwd'];

        if ($passwd !== $confirm_passwd) {
            echo "Les mots de passe ne correspondent pas";
        } else {
            $check_query = "SELECT * FROM joueur WHERE login_joueur = :login";
            $stmt = $connect->prepare($check_query);
            $stmt->execute([':login' => $login]);
            if ($stmt->rowCount() > 0) {
                echo "<div class='unique'>Le login existe déjà. Veuillez choisir un autre login.</div>";
            } else {
                $query = $connect->prepare("INSERT INTO joueur (nom_joueur, prenom_joueur, login_joueur, passwd_joueur) VALUES (?, ?, ?, ?)");
                $testquery = $query->execute([$nom, $prenom, $login, $passwd]);

                if ($testquery) {
                    header("Location: index.php");
                } else {
                    echo "Erreur lors de l'insertion";
                }
            }
        } 
    } else {
        echo "Les données nécessaires ne sont pas définies";
    }
}

$query = $connect->query("SELECT * FROM joueur");
$list = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | QUIZZ </title>
    <link rel="stylesheet" href="inscription.css">
    <style>
    .h3 {
        text-decoration: underline;
        margin-left: 450px;
    }
    .tous{
        /* margin-top: -150px; */
        margin-left: 250px;
        margin-top: -100px;
    }
    .tous a{
        margin-left: 50px;
    }
    .unique {
        background-color: #ffcccc; 
        color: #cc0000;
        padding: 10px; 
        border: 1px solid #cc0000; 
        border-radius: 5px; 
        margin-bottom: 10px; 
        /* margin-top: 400px; */
        margin-left: 470px;
        margin-right: 300px; 
    } 
    /* .header{
        margin-top: -500px;
    } */

    </style>
</head>

<body>
    <div class="header">
        <img src="image/logo.png" alt="">
    </div>
    <div class="tous">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <hr class="hr">
        <h3 class="h3">S'INSCRIRE COMME JOUEUR </h3>
        <div class="ins"><img src="image/insc.jpg" alt=""></div>
        <form class="login" method="post">
            <input type="text" name="nom" id="nom" placeholder="Nom" required>
            <br>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
            <br>
            <input type="text" name="login" id="login" placeholder="Adresse mail" required>
            <br>
            <input type="password" name="passwd" id="passwd" placeholder="Mot de Passe" required>
            <br>
            <input type="password" name="confirm_passwd" id="confirm_passwd" placeholder="Confirmer le Mot de Passe"
                required>
            <br>
            <div id="error-message"></div>
            <button type="submit" id="envoyer">S'Inscrire →</button>
            <?php if(isset($errorMessage) && !empty($errorMessage)): ?>
            <div class="unique"><?php echo $errorMessage; ?></div>
            <?php endif; ?> 
        </form>
         
    </div>
    <script>
    const form = document.querySelector('.login');
    const nom = document.getElementById('nom');
    const prenom = document.getElementById('prenom');
    const login = document.getElementById('login');
    const passwd = document.getElementById('passwd');
    const confirmPasswd = document.getElementById('confirm_passwd');
    const errorsDiv = document.getElementById('error-message');
    const button = document.getElementById('envoyer');

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
            displayError('Le champ prénom est obligatoire.');
            hasErrors = true;
        }

        if (login.value === '') {
            displayError('Le champ login est obligatoire.');
            hasErrors = true;
        }

        if (passwd.value === '') {
            displayError('Le champ mot de passe est obligatoire.');
            hasErrors = true;
        }

        if (confirmPasswd.value === '') {
            displayError('Le champ de confirmation du mot de passe est obligatoire.');
            hasErrors = true;
        }

        if (passwd.value !== confirmPasswd.value) {
            displayError('Les mots de passe ne correspondent pas.');
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
</body>

</html>