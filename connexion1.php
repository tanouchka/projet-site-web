<!DOCTYPE html><html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion</title>
            <style>
                body {
             font-family: Arial, sans-serif;
             margin: 0;
             padding: 0;
             background-image: url('background other 2.0.png');
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;
             height: 100vh;
             overflow: hidden;
          }
    
                        form {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh; /* utilise 100% de la hauteur de la vue */
                    margin: 0; /* supprime les marges par défaut du corps de la page */
                }

    
                label {
                    display: block;
                    margin-bottom: 10px;
                    text-align: center;
                    color:white;
                }
                h1{
                color:white;}
                p{
                color:white;
                text-align: center;
                }
                input {
                    padding: 8px;
                    margin-bottom: 10px;
                    text-align: center;
                }
    
                button {
                    padding: 10px;
                    font-size: 16px;
                }
    
                 /* Style pour l'icône mobile */
                #result {
                    margin-top: 20px;
                    color: red;
                }
            </style>
        </head>
        
        <body>
            <h1>Authentification</h1>
            <P>saisissez vos informations</P>
            <form action="ttconnexion.php"  method="POST" >
                <label for="email">Identifiant:</label>
                <input type="text" id="email" name = "email" required>
                <br>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name = "password" required>
                <br>
                <button class="btn btn-outline-primary" type="submit">Se connecter</button>
            </form>

            
            
        </body>
    </html>
    