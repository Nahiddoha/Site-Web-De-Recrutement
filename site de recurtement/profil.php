<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>langues</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="sytle1.css" rel="stylesheet">
    <style>
    header{
  background-color:  rgba(0, 0, 0, 0.8);
  width: 100%;
  position: fixed;
  z-index: 999;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 100px;
}
.logo{
  text-decoration: none;
  color: white;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 1.8em;
}

.navigation a{
  color: white;
  text-decoration: none;
  font-size: 1.1em;
  font-weight: 500;
  padding: 30px;
}

.navigation a:hover{
  color: #daa520;
}
    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <a href="#" class="logo">LSID<em class="e1">recrutement</em></a>
        <nav class="navigation">
            <a href="acueil_condidat.php">offres d'emplois</a>
            <a href="profil.php">Ajouter CV</a>
            <a href="#foot">Contact</a>
            <a href="cv.php">MON CV</a>
            <a href="deconnexion_C.php">Deconnexion</a>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <br>
    <?php
session_start();
include_once('config.php');

$con = config::connect();
if(isset( $_SESSION['id_candidat'])){
    $id_candidat = $_SESSION['id_candidat'];
}

$query = $con->prepare("select * from profil where id_candidat=:id_candidat");

$query->bindParam(":id_candidat",$id_candidat);
$query->execute();
if($candidat=$query->fetch(PDO::FETCH_ASSOC)){
    $candi=$candidat['id_candidat'];
}
if(isset($candi)){
    ?>
    <div>
        <h3>vous avez deja un CV </h3>
    </div>
    <?php
}
else{
?>
    <div class="h5">
        <h5>
            <marquee behavior="" direction="right"> remplir votre profil professionnelle et personelle 📝</marquee>
        </h5>

    </div>

    <div class="bloc-input">


        <form method="post" action="Tprofil.php" id="form">


            <h1>Identification <i class="fa-solid fa-user"></i> </h1>
            <div id="Identification">
                    <table>

                    <tr>
                        <td>

                        </td>
                    </tr>

                    <tr><td>
                            <label>CIN :<em>*</em></label>
                        </td>
                        <td> <input type="text" maxlength="8" name="cin" id="cin" /> </td>

                    </tr>
            </div>
            <tr>
                <td></td>
                <td class="erreur" id="er1"> vous devez entrer votre CIN</td>
            </tr>
            <tr>
                <td>
                    <label>Nom :<em>*</em> </label>
                </td>
                <td>
                    <input type="text" maxlength="50" value="" name="nom" id="nom" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="erreur" id="er2"> vous devez entrer votre Nom</td>
            </tr>
            <tr>
                <td>
                    <label>Prénom :<em>*</em> </label>
                </td>
                <td>
                    <input type="text" maxlength="50" value="" name="prenom" id="prenom" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="erreur" id="er3"> vous devez entrer votre Prenom</td>
            </tr>

            <tr>
                <td>
                    <label>Date de naissance : </label>
                </td>
                <td>
                    <input type="date" value="" name="dn" id="dn" />
                </td>

            </tr>
            <tr>

                <td><label>Adresse : <em>*</em> </label></td>
                <td width="250px">
                    <p>
                    <div><textarea cols="30" rows="6" class="input_textearea" name="adress" id="adress"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="erreur" id="er6"> vous devez entrer votre Adresse</td>
            </tr>

            <tr>
                <td><label>Email : <em>*</em> </label></td>
                <td><input type="email" maxlength="100" value="" name="email" id="email" /></td>
            <tr>
                <td></td>
                <td class="erreur" id="er7"> vous devez entrer votre Email</td>
            </tr>

            </tr>
            <tr>

                <td><label>Tél : </label></td>
                <td><input type="tel" value="" name="tel" /></td>
            </tr>
            </table>

    </div>

    <button id="btn" name="suivant">suivant</button>
    </form>
    <script>
    var btn = document.getElementById('Identification');
    var msg1 = document.getElementById('er1');
    var msg2 = document.getElementById('er2');
    var msg3 = document.getElementById('er3');
    var msg4 = document.getElementById('er4');

    var msg6 = document.getElementById('er6');
    var msg7 = document.getElementById('er7');
    var msg8 = document.getElementById('er8');
    var cin = document.getElementById('cin');
    var nom = document.getElementById('nom');
    var prenom = document.getElementById('prenom');


    var adress = document.getElementById('adress');
    var email = document.getElementById('email');
    var situationa = document.getElementById('situationa');
    var cli = false;
    btn.onclick = function(e) {
        cli = true

        if (cin.value == '' || cin.value.length < 7) {
            e.preventDefault();
            msg1.style.display = 'block';
            cin.style.border = '1px solid red';
        }

        if (nom.value.length < 2) {
            e.preventDefault();
            msg2.style.display = 'block';
            nom.style.border = '1px solid red';
        }
        if (prenom.value < 2) {
            e.preventDefault();
            msg3.style.display = 'block';
            prenom.style.border = '1px solid red';
        }



        if (adress.value < 10) {
            e.preventDefault();
            msg6.style.display = 'block';
            adress.style.border = '1px solid red';
        }
        if (email.value < 2) {
            e.preventDefault();
            msg7.style.display = 'block';
            email.style.border = '1px solid red';
        }

    }
    cin.onkeyup = function() {
        if (cli == true) {
            if (cin.value.length < 9) {
                msg1.style.display = 'none';
                cin.style.border = '1px solid green';
            } else {
                msg1.style.display = 'block';
                cin.style.border = '1px solid red';

            }
        }
    }
    nom.onkeyup = function() {
        if (cli == true) {
            if (nom.value.length > 2) {
                msg2.style.display = 'none';
                nom.style.border = '1px solid green';
            } else {
                msg2.style.display = 'block';
                nom.style.border = '1px solid red';

            }
        }
    }
    prenom.onkeyup = function() {
        if (cli == true) {
            if (prenom.value.length > 2) {
                msg3.style.display = 'none';
                prenom.style.border = '1px solid green';
            } else {
                msg3.style.display = 'block';
                prenom.style.border = '1px solid red';

            }
        }
    }

    adress.onkeyup = function() {
        if (cli == true) {
            if (adress.value.length > 5) {
                msg6.style.display = 'none';
                adress.style.border = '1px solid green';
            } else {
                msg6.style.display = 'block';
                adress.style.border = '1px solid red';

            }
        }
    }
    email.onkeyup = function() {
        if (cli == true) {
            if (email.value.length > 10) {
                msg7.style.display = 'none';
                email.style.border = '1px solid green';
            } else {
                msg7.style.display = 'block';
                email.style.border = '1px solid red';

            }
        }
    }

    const imgDiv = document.querySelector('#bloc-photo');
    const img = document.querySelector('#photo');
    const up = document.querySelector('#file_2');
    const upload = document.querySelector('#upload');
    imgDiv.addEventListener('mouseenter', function() {
        upload.style.display = "block";
    });

    imgDiv.addEventListener('mouseleave', function() {
        upload.style.display = "none";
    });

    up.addEventListener('change', function() {
        const choosefile = this.files[0];
        if (choosefile) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                img.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(choosefile);
        }
    });
    </script>
    <br>

</body>

<?php
}?><br>
<br>
<br>
<br>
<footer class="bg-dark text-white pt-5 pb-4" id="foot">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">LSIDrecrutement
                </h5>
                <p>avec nous vous trouverai le meilleure ofre</p>

            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Secteurs
                </h5>
                <p>
                    <a href="#" class="text-white" style="text-decoration :none;">informatique</a>


                    <a href="#" class="text-white" style="text-decoration :none;">mécanique</a>
                    <a href="#" class="text-white" style="text-decoration :none;">électronique</a>
                    <a href="#" class="text-white" style="text-decoration :none;">réseau</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Contact</h5>
                <p>
                    <i class="fas fa-home mr-3"></i>Settat ,Casablanca-Settat ,Maroc
                </p>
                <p>
                    <i class="fas fa-envelope mr-3"></i>LSIDrecrutement2023@gmail.com
                </p>
                <p>
                    <i class="fas fa-phone mr-3"></i>+212 6123456988
                </p>
                <p>
                    <i class="fas fa-phone mr-3"></i>+212 5123456789
                </p>
            </div>
        </div>
        <hr class="mb-4">
        <div class="row alig-items-center">
            <div class="col-md-7 col-lg-8">
                <p>les droits de copies @2023 est réserver par :
                    <a href="#" style="text-decoration: none;">
                        <strong class="text-warning">Provideur</strong>
                    </a>

                </p>


            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-google-plus"></i></a>

                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-youtube"></i></a>
                        </li>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>