<ul?php
    session_start();

    $message = null ;
    if( isset( $_SESSION['message']))
    {
        $message =  $_SESSION['message'];
        echo "" . $message ;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Accueil</title>
  <style>
   
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: skyblue;
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         height: 100vh;
         overflow: hidden;
      }

      header {
         text-align: center;
         padding: 10px;
         background-color: #f2f2f2;
      }

      main {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100%;
         color: white;
      }

      .button-container {
         width: 60vw;
         max-width: 600px;
         height: 40vh;
         display: flex;
         justify-content: space-evenly;  /* Espace uniforme entre les boutons */
         align-items: center;  /* Centrage vertical des boutons */
         font-size: 4vw;
         gap: 60px;  /* Espace entre chaque bouton */
      }

      button {    
         font-size: 2vw; 
         font-weight: lighter;
         color: white;
         padding: 2vh 5vw;
         background: #000000;
         outline: none;
         cursor: pointer;
         border: none;
         border-radius: 2vw; 
         box-shadow: 0 1vh #000000;
      }

      button:hover {
         background-color: #0056b3; /* Ajout d'un effet hover pour l'interaction */
      }

      #result {
         margin-top: 20px;
         color: red;
      }

      @media (max-width: 600px) {
         .button-container {
            font-size: 8vw;
         }
      }  
   
   
   </style>
</head>
<body>
   <main>

   
      <div class="running-section">
         <h2>BIENVENUE SUR RUNNING</h2>
      </div>

      <div class="button-container">
         <a href="connexion.php"><button>S'authentifier</button></a> 
         <a href="inscription.html"><button>S'inscrire</button></a>
      </div> 

      <div class="running-section">
         <img class="game-image" src="index.png" alt="Running Game">
      </div>

      <div class="button-container">
         <a href="apropos.php"><button>A propos</button></a>
      </div>

      <div class="running-section">
         <p>Rejoignez-nous !!!</p>
      </div>

   </main>
</body>