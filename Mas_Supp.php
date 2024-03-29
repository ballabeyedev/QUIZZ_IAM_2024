<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Questions</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 550px;
            margin-top: -500px;
            width:40%;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box; 
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
        .footer1 {
            color: red;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-top: 10px;
            margin-left: -10px;
        }

        .pieds {
            margin: 0;
        }
        .disconnect{
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .l2{
            margin-top: -250px;
            margin-left: 200px;
        }
        .l2 img{
            border: 3px solid black;
            height:240px;
        }
        hr {
            height: 10px;
            background: linear-gradient(to right, #BF2090, #4CAF50); 
            margin-left: 300px;
            margin-right: 300px;
            margin-top: 30px;
            animation: colorAnimation 5s infinite alternate; 
        }

        @keyframes colorAnimation {
            0% {
                background-position: 0%;
            }
            100% {
                background-position: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="profils">
        <p>Balla BEYE <img src="image/profils.jpg"></p>
    </div>
    <div class="logo">
        <img src="image/logo.png">
        <ul>
            <li><a href="admin.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <form action="process1.php" method="post">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <h1 class="titre">NOMBRE DE QUESTIONS</h1>
        <label for="numQuestions">Nombre de questions :</label>
        <input type="number" name="numQuestions" required>
        <button type="submit">Afficher</button>
    </form>
    <div class="l2"><img src="image/nq.png" alt=""></div>
    <hr classe="barre">
    <footer class="footer1">
        <p class="pieds">LesTroisFantastiques  © copyright iam big 2024</p>
    </footer>

</body>
</html>
