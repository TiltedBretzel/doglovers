<?php
session_start();
if (!(isset($_SESSION["login_Type"]))) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Inscription</title>
    <link rel="stylesheet" type="text/css" href="./register.css">
    <script type="text/javascript" src="register.js"></script>
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>

    <?php

    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $nomOk = $prenomOk = $adresseOk = $sexeOk = $dateNaissanceOk = $situationOk = $tailleOk = $poidsOk = $CouleurCheveuxOk = $CouleurYeuxOk = $pseudoOk = $passwordOk = false;

    $lieuresFilled = $professionFilled = $enfantsFilled = $msgAccFilled = $interetFilled = $citationFilled = $fumeurFilled = $infoschiensFilled = true;

    $erreurNom = $erreurSexe = $erreurPoids = $erreurPseudo = $erreurFumeur = $erreurPrenom = $erreurMsgAcc
      = $erreurPhotos = $erreurAdresse = $erreurCitation = $erreurNbDoggos = $erreurPassword = $erreurDoggos= $erreurInterets
      = $erreurNombreEnf = $erreurSituation = $erreurInfoschiens = $erreurCouleurYeux = $erreurCouleurCheveux
      = $erreurDateNaissance = $erreurTaille = "";

    $_SESSION["nom"] = $_SESSION["sexe"] = $_SESSION["poids"] = $_SESSION["pseudo"] = $_SESSION["fumeur"] = $_SESSION["prenom"] = $_SESSION["msgAcc"]
      = $_SESSION["photos"] = $_SESSION["adresse"] = $_SESSION["citation"] = $_SESSION["nbDoggos"] = $_SESSION["password"] = $_SESSION["interets"]
      = $_SESSION["nombreEnf"] = $_SESSION["situation"] = $_SESSION["infoschiens"] = $_SESSION["couleurYeux"] = $_SESSION["couleurCheveux"]
      = $_SESSION["dateNaissance"] = $_SESSION["taille"] = $_SESSION["lieures"] = $_SESSION["profession"] = $_SESSION["fumeur"] = $_SESSION["chiens"] = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nom"])) {
        $erreurNom = "Le champ nom est requis";
      } else {
        $nomOk = true;
        $_SESSION["nom"] = test_input($_POST["nom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $_SESSION["nom"])) {
          $erreurNom = "Le nom est invalide.";
          !$nomOk;
        }
      }
      if (empty($_POST["prenom"])) {
        $erreurPrenom = "Le champ prénom est requis";
      } else {
        $prenomOk = true;
        $_SESSION["prenom"] = test_input($_POST["prenom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $_SESSION["prenom"])) {
          $erreurPrenom = "Le prénom est invalide.";
          !$prenomOk;
        }
      }
      if (empty($_POST["adresse"])) {
        $erreurAdresse = "Le champ adresse est requis";
      } else {
        $adresseOk = true;
        $_SESSION["adresse"] = test_input($_POST["adresse"]);
        if (preg_match("/^[§]*$/", $_SESSION["adresse"])) {
          $erreurPseudo = "Le pseudo est invalide.";
          !$adresseOk;
        }
      }
      if (empty($_POST["lieures"])) {
        $lieures = "";
      } else {
        $_SESSION["lieures"] = test_input($_POST["lieures"]);
        if (preg_match("/^[§]*$/", $_SESSION["lieures"])) {
          $erreurLieuRes = "Le lieu de résidence contient des caractères invalides.";
          !$lieuResFilled;
        }
      }

      if (empty($_POST["sexe"])) {
        $erreurSexe = "Le champ sexe est requis";
      } else {
        $sexeOk = true;
        $_SESSION["sexe"] = test_input($_POST["sexe"]);
        if (($_SESSION["sexe"] != "Homme") && ($_SESSION["sexe"] != "Femme") && ($_SESSION["sexe"] != "Autre")) {
          $erreurSexe = "Le sexe est invalide.";
          !$sexeOk;
        }
      }

      if (empty($_POST["dateNaissance"])) {
        $erreurDateNaissance = "Le champ date de naissance est requis";
      } else {
        $dateNaissanceOk = true;
        $_SESSION["dateNaissance"] = test_input($_POST["dateNaissance"]);
        if (!preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $_SESSION["dateNaissance"])) {
          $erreurDateNaissance = "La date de naissance est invalide.";
          !$dateNaissanceOk;
        }
      }

      if (empty($_POST["profession"])) {
        $_SESSION["profession"] = "";
      } else {
        $_SESSION["profession"] = test_input($_POST["profession"]);
        if (!preg_match("/^[a-zA-Z -]*$/", $_SESSION["profession"])) {
          $erreurProfession = "La profession est invalide.";
          !$professionFilled;
        }
      }

      if (empty($_POST["situation"])) {
        $erreurSituation = "Le champ situation amoureuse est requis";
      } else {
        $situationOk = "true";
        $_SESSION["situation"] = test_input($_POST["situation"]);
        if (($_SESSION["situation"] != "Célibataire") && ($_SESSION["situation"] != "Compliqué")) {
          $erreurSituation = "La situation amoureuse est invalide.";
          !$situationOk;
        }
      }

      if (!isset($_POST["enfants"])) {
        $_SESSION["enfants"] = "";
      } else {
        $_SESSION["enfants"] = test_input($_POST["enfants"]);
        if ($_SESSION["enfants"] != "on") {
          $erreurEnfants = "Une erreur s'est produite";
          !$enfantsFilled;
        } else {
          if (empty($_POST["nombreEnf"])) {
            $erreurNombreEnf = "Le champ nombre d'enfants est requis";
            !$enfantsFilled;
          } else {
            $_SESSION["nombreEnf"] = test_input($_POST["nombreEnf"]);
            if (($_SESSION["nombreEnf"] != "1") && ($_SESSION["nombreEnf"] != "2") && ($_SESSION["nombreEnf"] != "3-5") && ($_SESSION["nombreEnf"] != "5+") && ($_SESSION["nombreEnf"] != "-1")) {
              $erreurNombreEnf = "Le nombre d'enfants est invalide.";
              !$enfantsFilled;
            }
          }
        }
      }

      if (empty($_POST["poids"])) {
        $erreurPoids = "Le champ poids est requis";
      } else {
        $poidsOk = true;
        $_SESSION["poids"] = test_input($_POST["poids"]);
        if (($_SESSION["poids"] < 0) || ($_SESSION["poids"] > 600)) {
          $erreurPoids = "Le poids est invalide.";
          !$poidsOk;
        }
      }

      if (empty($_POST["taille"])) {
        $erreurTaille = "Le champ poids est requis";
      } else {
        $_SESSION["taille"] = test_input($_POST["taille"]);
        $tailleOk = true;
        if (($_SESSION["taille"] < 0) || ($_SESSION["taille"] > 260)) {
          $erreurTaille = "La taille est invalide.";
          !$tailleOk;
        }
      }

      if (empty($_POST["couleurCheveux"])) {
        $erreurCouleurCheveux = "Le champ couleur de cheveux est requis";
      } else {
        $CouleurCheveuxOk = "true";
        $_SESSION["couleurCheveux"] = test_input($_POST["couleurCheveux"]);
        if (($_SESSION["couleurCheveux"] != "Noir") && ($_SESSION["couleurCheveux"] != "Brun") && ($_SESSION["couleurCheveux"] != "Auburn")
          && ($_SESSION["couleurCheveux"] != "Châtain") && ($_SESSION["couleurCheveux"] != "Roux") && ($_SESSION["couleurCheveux"] != "Blond Vénitien")
          && ($_SESSION["couleurCheveux"] != "Blond") && ($_SESSION["couleurCheveux"] != "Blanc") && ($_SESSION["couleurCheveux"] != "Autre")
        ) {
          $erreurCouleurCheveux = "La couleur de cheveux est invalide.";
          !$CouleurCheveuxOk;
        }
      }

      if (empty($_POST["couleurYeux"])) {
        $erreurCouleurYeux = "Le champ couleur de yeux est requis";
      } else {
        $CouleurYeuxOk = true;
        $_SESSION["couleurYeux"] = test_input($_POST["couleurYeux"]);
        if (($_SESSION["couleurYeux"] != "Bleu") && ($_SESSION["couleurYeux"] != "Vert") && ($_SESSION["couleurYeux"] != "Marron")
          && ($_SESSION["couleurYeux"] != "Noisette") && ($_SESSION["couleurYeux"] != "Noir") && ($_SESSION["couleurYeux"] != "Autre")
        ) {
          $erreurCouleurYeux = "La couleur des yeux est invalide.";
          !$CouleurYeuxOk;
        }
      }

      if (empty($_POST["msgAcc"])) {
        $_SESSION["msgAcc"] = "";
      } else {
        $_SESSION["msgAcc"] = test_input($_POST["msgAcc"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["msgAcc"])) {
          $erreurMsgAcc = "Le message d'accueil est invalide.";
          !$msgAccFilled;
        }
      }

      if (empty($_POST["citation"])) {
        $_SESSION["citation"] = "";
      } else {
        $_SESSION["citation"] = test_input($_POST["citation"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["citation"])) {
          $erreurCitation = "La citation est invalide.";
          !$citationFilled;
        }
      }

      if (empty($_POST["interets"])) {
        $_SESSION["interets"] = "";
      } else {
        $_SESSION["interets"] = test_input($_POST["interets"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["interets"])) {
          $erreurInterets = "Les centres d'interets sont invalides.";
          !$interetFilled;
        }
      }

      if (!isset($_POST["fumeur"])) {
        $_SESSION["fumeur"] = "";
      } else {
        $_SESSION["fumeur"] = test_input($_POST["fumeur"]);
        if ($_SESSION["fumeur"] != "on") {
          $erreurFumeur = "Une erreur s'est produite.";
          !$fumeurFilled;
        }
      }

      if (!isset($_POST["chiens"])) {
        $_SESSION["chiens"] = "";
      } else {
        $_SESSION["chiens"] = test_input($_POST["chiens"]);
        if ($_SESSION["chiens"] != "on") {
          $erreurDoggos = "Une erreur s'est produite";
          !$chiensFilled;
        } else {
          if (empty($_POST["nbDoggos"])) {
            $erreurNbDoggos = "Le champ nombre de chiens est requis";
            !$chiensFilled;
          } else {
            $_SESSION["nbDoggos"] = test_input($_POST["nbDoggos"]);
            if (($_SESSION["nbDoggos"] != "1") && ($_SESSION["nbDoggos"]  != "2") && ($_SESSION["nbDoggos"]  != "3+")) {
              $erreurNbDoggos = "Le nombre de chiens est invalide.";
              !$chiensFilled; 
            }
          }
        }
      }

      if (empty($_POST["infoschiens"])) {
        $_SESSION["infoschiens"]  = "";
      } else {
        $_SESSION["infoschiens"] = test_input($_POST["infoschiens"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["infoschiens"])) {
          $erreurInfoschiens = "Les informations à propos des chiens sont invalides ou contiennent des caractères interdits.";
          !$infoschiensFilled;
        }
      }

      if (empty($_POST["pseudo"])) {
        $erreurPseudo = "Le champ pseudo est requis";
      } else {
        $pseudoOk = "true";
        $_SESSION["pseudo"] = test_input($_POST["pseudo"]);
        if (!preg_match("/^[a-zA-Z,-.]*$/", $_SESSION["pseudo"])) {
          $erreurPseudo = "Le pseudo est invalide.";
          !$pseudoOk;
        }
      }

      if (empty($_POST["password"])) {
        $erreurPassword = "Le champ mot de passe est requis";
      } else {
        $passwordOk = "true";
        $_SESSION["password"] = test_input($_POST["password"]);
        if (!preg_match("/[^§\s]+/", $_SESSION["password"])) {
          $erreurPassword = "Le mot de passe est invalide.";
          !$passwordOk;
        }
      }
    }

    if ($nomOk && $prenomOk && $adresseOk && $sexeOk && $dateNaissanceOk && $situationOk && $tailleOk && $poidsOk && $CouleurCheveuxOk && $CouleurYeuxOk && $pseudoOk && $passwordOk && $lieuresFilled && $professionFilled && $enfantsFilled && $msgAccFilled && $interetFilled && $citationFilled && $fumeurFilled && $infoschiensFilled && (!isset($_SESSION["erreur"]))) {
      $_SESSION["dataPassed"] = "true";
      header('Location: ./confirmRegistration.php');
    }
    ?>

    <div id="page">
      <div id="bloc_Register">
        <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <h3>Informations Générales :</h3>
          <label for="nom">Nom</label><br>
          <input name="nom" type="text" pattern="[^§]+" value="<?php echo $_SESSION['nom'] ?>" placeholder="Votre nom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurNom; ?> </span><br>
          <label for="prenom">Prénom</label><br>
          <input name="prenom" pattern="[^§]+" type="text" value="<?php echo $_SESSION['prenom'] ?>" placeholder="Votre prénom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPrenom; ?> </span><br>
          <label for="adresse">Adresse, cette information sera privée.</label><br>
          <input name="adresse" pattern="[^§]+" type="text" value="<?php echo $_SESSION['adresse'] ?>" placeholder="Adresse complète" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurAdresse; ?> </span><br>
          <label for="lieures">Lieu de résidence, cette adresse sera publique.</label><br>
          <input name="lieures" pattern="[^§]+" type="text" value="<?php echo $_SESSION['lieures'] ?>" placeholder="(Pays, Ville, Département)" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="sexe">Sexe</label><br>
          <div class="blocSexe">
            <label><input checked="checked" name="sexe" type="radio" id="Homme" value="Homme" /> Homme </label>
            <label><input name="sexe" type="radio" value="Femme" id="Femme" /> Femme </label> <br>
            <label><input name="sexe" type="radio" value="Autre" id="Autre" /> Autre </label> <br>
          </div>
          <label for="birthday">Date de Naissance</label><br>
          <input type="date" name="dateNaissance" value="<?php echo $_SESSION['dateNaissance'] ?>" required> <span>* <?php echo $erreurDateNaissance; ?> </span><br>
          <label for="profession">Profession</label> <br>
          <input name="profession" pattern="[^§]+" type="text" value="<?php echo $_SESSION['profession'] ?>" placeholder="Votre profession ou activité." oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="situation">Situation amoureuse</label> <span>* <?php echo $erreurSituation ?> </span><br>
          <div class="blocSexe">
            <label><input checked="checked" name="situation" type="radio" value="Célibataire" id="Célibataire" required /> Célibataire</label> /
            <label><input name="situation" type="radio" id="Compliqué" value="Compliqué" /> Compliqué</label>
            <label><input id="enfants" name="enfants" type="checkbox" onclick="changeVisibility('nbEnfants')" <?php if (isset($_POST['enfants'])) echo "checked='checked'"; ?> />avec enfants.</label><br>
            <div id="nbEnfants"> <span>* <?php echo $erreurNombreEnf; ?> </span>
              <select name="nombreEnf" id="nombreEnf">
                <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '-1')) { ?>selected="true" <?php }; ?> value="-1">Ne pas mentionner</option>
                <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '1')) { ?>selected="true" <?php }; ?> value="1">1 Enfant</option>
                <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '2')) { ?>selected="true" <?php }; ?> value="2">2 Enfants</option>
                <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '3-5')) { ?>selected="true" <?php }; ?> value="3-5">Entre 3 et 5 Enfants</option>
                <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '5+')) { ?>selected="true" <?php }; ?> value="5+">Plus de 5 Enfants</option>
              </select>
            </div>
          </div>
          <h3>Informations physique :</h3>
          <label for="poids">Poids</label>
          <label><input type="number" name="poids" id="poids" min="0" value="<?php echo $_SESSION["poids"] ?>" required>kg</label> <span>* <?php echo $erreurPoids; ?> </span><br>
          <label for="poids">Taille</label>
          <label><input type="number" name="taille" id="taille" min="0" value="<?php echo $_SESSION["taille"] ?>" required>cm</label> <span>* <?php echo $erreurTaille; ?> </span><br>

          <label for="couleurCheveux">Couleur de vos cheveux</label> <span>* <?php echo $erreurCouleurCheveux; ?> </span> <br>
          <select name="couleurCheveux" id="couleurCheveux">
            <option <?php if (isset($_SESSION['couleurCheveux']) && ($_SESSION['couleurCheveux'] == 'Noir')) { ?>selected="true" <?php }; ?> value="Noir">Noir</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Brun')) { ?>selected="true" <?php }; ?> value="Brun">Brun</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Auburn')) { ?> selected="true" <?php }; ?> value="Auburn">Auburn</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Châtain')) { ?>selected="true" <?php }; ?> value="Châtain">Châtain</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Roux')) { ?>selected="true" <?php }; ?> value="Roux">Roux</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Blond Vénitien')) { ?>selected="true" <?php }; ?> value="Blond Vénitien">Blond Vénitien</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Blond')) { ?>selected="true" <?php }; ?> value="Blond">Blond</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Blanc')) { ?>selected="true" <?php }; ?> value="Blanc">Blanc</option>
            <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Autre')) { ?>selected="true" <?php }; ?> value="Autre">Autre</option>
          </select> <br>
          <label for="couleurYeux">Couleur de vos yeux</label> <span>* <?php echo $erreurCouleurYeux; ?> </span><br>
          <select name="couleurYeux" id="couleurYeux">
            <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Bleu')) { ?>selected="true" <?php }; ?> value="Bleu">Bleu</option>
            <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Vert')) { ?>selected="true" <?php }; ?> value="Vert">Vert</option>
            <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Marron')) { ?>selected="true" <?php }; ?> value="Marron">Marron</option>
            <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Noisette')) { ?>selected="true" <?php }; ?> value="Noisette">Noisette</option>
            <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Noir')) { ?>selected="true" <?php }; ?> value="Noir">Noir</option>
            <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Autre')) { ?>selected="true" <?php }; ?> value="Autre">Autre</option>
          </select>
          <h3>Informations profil :</h3>
          <label for="msgAcc">Message d'accueil</label><br>
          <input name="msgAcc" pattern="[^§]+" type="text" value="<?php echo $_SESSION['msgAcc'] ?>" placeholder="Un petit message d'accueil" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="citation">Citation</label><br>
          <input name="citation" pattern="[^§]+" type="text" value="<?php echo $_SESSION['citation'] ?>" placeholder="Une citation ?" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="interets">Interets</label><br>
          <input name="interets" pattern="[^§]+" type="text" value="<?php echo $_SESSION['interets'] ?>" placeholder="Vos interets" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label><input type="checkbox" name="fumeur" id="fumeur" <?php if (isset($_POST['fumeur'])) echo "checked='checked'"; ?>>Fumeur ?</label><br>
          <label><input name="chiens" id="chiens" type="checkbox" onclick="changeVisibility('nbChiens')" <?php if (isset($_POST['chiens'])) echo "checked='checked'"; ?> /> Je possède un ami à 4 pattes !</label><br>
          <div id="nbChiens"> <span>* <?php echo $erreurNbDoggos; ?> </span>
            <select name="nbDoggos" id="nbDoggos">
              <option <?php if (isset($_SESSION['nbDoggos']) && ($_SESSION['nbDoggos'] == '1')) { ?>selected="true" <?php }; ?> value="1">1 Chien</option>
              <option <?php if (isset($_SESSION['nbDoggos']) && ($_SESSION['nbDoggos'] == '2')) { ?>selected="true" <?php }; ?> value="2">2 Chiens</option>
              <option <?php if (isset($_SESSION['nbDoggos']) && ($_SESSION['nbDoggos'] == '3+')) { ?>selected="true" <?php }; ?> value="3+">3 Chiens ou plus</option>
            </select>
            <input name="infoschiens" pattern="[^§]+" type="text" value="<?php echo $_SESSION['infoschiens'] ?>" placeholder="Infos chiens" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          </div>
          <h3>Photos !</h3>
          <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span> <br>
          <input type="file" id="photos" name="photos" accept="image/png, image/jpeg" multiple> <br>
          <label for="pseudo">Pseudo</label><br>
          <input name="pseudo" type="text" pattern="[^\s§]+" value="<?php echo $_SESSION['pseudo'] ?>" placeholder="Votre pseudo" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPseudo; ?> </span><br>
          <label for="password">Mot de Passe</label><br>
          <input name="password" type="password" pattern="[^\s]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo '<span>' . $erreurPassword . '</span>'; ?><br>
            <input type="submit" value="Ajouter !"></input>
        </form>
        <?php 
        if (isset($_SESSION["erreur"]) && ($_SESSION["errreur"] == "login_existant")) {
          echo '<span id="loginError"> Identifiant ou mot de passe incorrect.</span>';
          unset($_SESSION["erreur"]);
        }
        ?>
      </div>
    </div>
    <script>
      updateCheckBoxOnload('enfants', 'nbEnfants');
      updateCheckBoxOnload('chiens', 'nbChiens');
    </script>
  </body>

  </html>
<?php
} else {
  header('Location: ./../erreurs/alreadyIn.php');
} ?>