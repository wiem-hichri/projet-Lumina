<?php 
include('../../../config.php');
session_start();

if (!isset($_SESSION['formateur'])) {
    header("Location: auth/login.php");
    exit();
}
$formateur_id = $_SESSION['formateur_id'];

// Récupérer les données du formateur à partir de la base de données
$sql = 'SELECT * FROM formateur WHERE formateur_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute([$formateur_id]);
$formateur = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si les données du formateur ont été récupérées avec succès
if (!$formateur) {
    // Rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur
    echo "Erreur: formateur introuvable.";
    exit();
}
 include('header.php');
?>
<br><br><br>

<section class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="container ">


    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="../../../assets/home/img/user.jpg"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h1 class="my-3">
            <?php if (isset($formateur['last_name'])) 
    echo $formateur['last_name'];?>
     <?php if (isset($formateur['first_name'])) 
    echo $formateur['first_name'];?>
            </h1>
           
          </div>
        </div>
        
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($formateur['email'])) 
    echo $formateur['email'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Cin</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($formateur['cin'])) 
    echo $formateur['cin'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($formateur['tel'])) 
    echo $formateur['tel'];?></p>
              </div>
            </div>
            <hr>
         
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Spécialité</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($formateur['specialite'])) 
    echo $formateur['specialite'];?></p>
              </div>
              <hr>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

<?php include ('footer.php');?>