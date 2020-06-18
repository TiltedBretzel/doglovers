<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) >= 2)) { ?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="./../profil/monProfil/MonProfil.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico" />
</head>

  <?php
    $erreur = false;
    if (($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET["user"]))) {
     $_SESSION["user"] = $_GET["user"];
     $user = $_SESSION["user"];
    } else if (!isset($_SESSION["user"])) {
      echo "ALED";
    }
  ?>

<script> // Merci Stack OverFlow https://stackoverflow.com/questions/6320113/how-to-prevent-form-resubmission-when-page-is-refreshed-f5-ctrlr 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<body>
  <!--Début bloc de présentation-->
  <div id="blocTitre"></div>
  <div id="Titre">
    <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
    <h1>Profil de <?php echo ($_SESSION["user"]); ?></h1>
  </div>
  <div class="menu">
    <ul>
      <li><a href="../home/accueil.php">Accueil</a></li>
      <li><a href="./../profil/profil.php?user=<?php echo $_SESSION["user"];?>">Infos <?php echo ($_SESSION["user"]); ?></a></li>
      <li><a class="active" href="">Conversation</a></li>
      <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      <?php if(intval($_SESSION['login_Type']) === 3){ ?>
        <li><a href="../admin/bannir/bannir.php">Bannir <?php echo ($_SESSION["user"]); ?></a></li>
        <li><a href="../admin/supprimerCompte.php">Supprimer <?php echo ($_SESSION["user"]); ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <!--Fin bloc de présentation-->
  <?php
if (isset($_SESSION["user"])) {
echo('coucouuuuuuuuuu');
  //on recupère les deux pseudos
  $nomFichier = array($_SESSION['pseudo'], $_SESSION['user']);
  //on les tri par ordre alphabétique
  usort($nomFichier, "strnatcmp");
  //on écrit le tableau pour vérifier
  //print_r($nomFichier);
  //on met dans content ce qu'on veut écrire dans le fichier
  $heure = date("H:i");
  if(!empty($_POST['message'])){
    $content = $heure." ".$_SESSION['pseudo']." : ".$_POST['message']. "\n";
    //on met le contenu dans le fichier nommé pseudo1_pseudo2.txt avec pseudo1 et 2 triés par ordre alphabétique
    //le fichier est créé s'il n'éxiste pas
    file_put_contents($nomFichier[0].'_'.$nomFichier[1].'.txt', $content, FILE_APPEND);
  }
    if(file_exists('destinataires_'.$_SESSION['pseudo'].'.txt')){
     
      //on gere le fichier destinataires
      $contenu = file_get_contents('destinataires_'.$_SESSION['pseudo'].'.txt');
      $nomDestinataire = explode('|',$contenu);
      $i = 0;
      $destinataireTrouve = false;
      $destinataire = $_SESSION['user'];
      while (($i < sizeof($nomDestinataire)-1) && !$destinataireTrouve) {
        if($nomDestinataire[$i]==$destinataire){
          
          $destinataireTrouve = true;
        }
        $i++;
      }
      if(!$destinataireTrouve){
        $destinataire = $_SESSION['user'].'|';
        file_put_contents('destinataires_'.$_SESSION['pseudo'].'.txt', $destinataire, FILE_APPEND);
      }
    } else {
      $destinataire = $_SESSION['user'].'|';
      file_put_contents('destinataires_'.$_SESSION['pseudo'].'.txt', $destinataire, FILE_APPEND);
    }
  ?>
  <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

    <h3>Conversation :</h3>
    <?php
    if (file_exists($nomFichier[0] . '_' . $nomFichier[1] . '.txt')) {
      //on récupère le contenu du fichier à savoir la conversation
      $conversation = file_get_contents($nomFichier[0] . '_' . $nomFichier[1] . '.txt');
      $nbrMsg = explode("\n", $conversation);
      $j = 0;
      while (($j < count($nbrMsg) - 1)) {
        /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
      récupérer les différentes données présentes dans chaque ligne*/
        echo $nbrMsg[$j] . "</br>";
        $j++;
      }
    } else {
      echo ("<span> Pour démarrer la conversation, envoyez un message ! ☺ </span> <br>");
    }
    ?>

    <!--<label for="message">ici je sais pas quoi</label><br>-->
    <input name="message" type="text" pattern="[^§]+" value="" placeholder="écrire un message" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /><br>
    <div class="part_boutons"><!--partie boutons-->
      <input type="submit" value="Envoyer "></input>
    </div><!--fin partie boutons-->
  </form>
</body>

</html>
<?php
}
/*}else{
  echo("erreurrrrrr");
}*/
unset($_POST['message']);
//unset($_SESSION['user']);
} else {
header("Location: /home/accueil.php");
}
?>
