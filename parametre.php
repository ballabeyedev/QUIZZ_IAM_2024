<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease;
            background-color: #f2f2f2; /* Couleur de fond */
        }
        .footer1 {
            color: red;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-top: 10px;
            margin-left: 40px;
        }

        .pieds {
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: -800px;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #007bff;
            padding: 8px 16px;
            text-decoration: none;
            font-size: 16px;
        }

        .pagination a:hover {
            background-color: #f2f2f2;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
        }
        label, select, input {
            display: block;
            margin-bottom: 10px;
        }

        select, input[type="range"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .logo{
            height: 900px;
            width:200px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333; 
        }

        section {
            margin-bottom: 30px;
        }

        h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #444; 
        }

        button {
            background-color: #007bff; 
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3; 
        }

        input[type="checkbox"] {
            margin-top: 5px;
        }
    </style>
    <title>Paramètres du Site</title>
</head>
<body>
    <div class="logo">
        <img src="image/logo.png">
        <ul>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Paramètres</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="#" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit" class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="container">
        <h2>Paramètres du Site</h2>

        <section id="section1" class="ui-preferences">
            <h3>Préférences de l'Interface Utilisateur</h3>
            <label for="theme">Thème :</label>
            <select id="theme" onchange="changeTheme()">
                <option value="light">Clair</option>
                <option value="dark">Sombre</option>
            </select>
            <label for="font-size">Taille de la Police :</label>
            <input type="range" id="font-size" min="10" max="24" step="2" onchange="changeFontSize()">
        </section>

        <section id="section2" class="account-preferences">
            <h3>Préférences du Compte</h3>
            <label for="changePassword">Changer le Mot de Passe :</label>
            <button id="changePassword" onclick="showChangePasswordForm()">Changer</button>
            <label for="notifications">Activer les Notifications :</label>
            <input type="checkbox" id="notifications" onchange="toggleNotifications()">
        </section>

        <section id="section3" class="privacy-settings">
            <h3>Paramètres de Confidentialité</h3>
            <label for="visibility">Visibilité du Profil :</label>
            <select id="visibility" onchange="updateVisibility()">
                <option value="public">Public</option>
                <option value="private">Privé</option>
            </select>
            <label for="data-sharing">Partage de Données :</label>
            <input type="checkbox" id="data-sharing" onchange="toggleDataSharing()">
        </section>

        <section id="section4" class="quiz-settings">
            <h3>Paramètres du Quiz</h3>
            <label for="quiz-difficulty">Difficulté du Quiz :</label>
            <select id="quiz-difficulty" onchange="updateQuizDifficulty()">
                <option value="easy">Facile</option>
                <option value="medium">Moyen</option>
                <option value="hard">Difficile</option>
            </select>
            <label for="quiz-time-limit">Limite de Temps du Quiz (en minutes) :</label>
            <input type="number" id="quiz-time-limit" min="1" max="60" onchange="updateQuizTimeLimit()">
        </section>

    </div>   
    <script>

    function changeTheme() {
        var themeSelect = document.getElementById('theme');
        var selectedTheme = themeSelect.options[themeSelect.selectedIndex].value;
        document.body.style.backgroundColor = (selectedTheme === 'dark') ? '#333' : '#fff';
        document.body.style.color = (selectedTheme === 'dark') ? '#fff' : '#333';
    }

    function changeFontSize() {
        var fontSizeInput = document.getElementById('font-size');
        var fontSizeValue = fontSizeInput.value + 'px';
        document.body.style.fontSize = fontSizeValue;
    }

    function showChangePasswordForm() {
        var newPassword = prompt('Veuillez saisir le nouveau mot de passe:');
        if (newPassword !== null) {
            console.log('Mot de passe changé avec succès :', newPassword);
        }
    }

    function toggleNotifications() {
        var notificationsCheckbox = document.getElementById('notifications');
        if (notificationsCheckbox.checked) {
            console.log('Notifications activées');
        } else {
            console.log('Notifications désactivées');
        }
    }

    function updateVisibility() {
        var visibilitySelect = document.getElementById('visibility');
        var selectedVisibility = visibilitySelect.options[visibilitySelect.selectedIndex].value;
        console.log('Nouvelle visibilité du profil :', selectedVisibility);
    }

    function toggleDataSharing() {
        var dataSharingCheckbox = document.getElementById('data-sharing');
        if (dataSharingCheckbox.checked) {
            console.log('Partage de données activé');
        } else {
            console.log('Partage de données désactivé');
        }
    }
    function updateQuizDifficulty() {
        var difficultySelect = document.getElementById('quiz-difficulty');
        var selectedDifficulty = difficultySelect.options[difficultySelect.selectedIndex].value;
        console.log('Nouvelle difficulté du quiz :', selectedDifficulty);
    }

    function updateQuizTimeLimit() {
        var timeLimitInput = document.getElementById('quiz-time-limit');
        var timeLimitValue = timeLimitInput.value;
        console.log('Nouvelle limite de temps du quiz (en minutes) :', timeLimitValue);
    }


</script>

</body>
</html>
