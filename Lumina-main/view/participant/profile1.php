<?php 
include('../../config.php');
session_start();

if (!isset($_SESSION['participant'])) {
    header("Location: auth/login.php");
    exit();
}
$participant_id = $_SESSION['participant_id'];

// Récupérer les données du participant à partir de la base de données
$sql = 'SELECT * FROM participant WHERE participant_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute([$participant_id]);
$participant = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si les données du participant ont été récupérées avec succès
if (!$participant) {
    // Rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur
    echo "Erreur: Participant introuvable.";
    exit();
}
 include('header.php');
?>
<br><br><br>

<section class="d-flex justify-content-center align-items-center" style="min-height: 80vh; ">
  <div class="container ">


    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="../../assets/home/img/user.jpg"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h1 class="my-3">
            <?php if (isset($participant['last_name'])) 
    echo $participant['last_name'];?>
     <?php if (isset($participant['first_name'])) 
    echo $participant['first_name'];?>
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
                <p class="text-muted mb-0"><?php if (isset($participant['email'])) 
    echo $participant['email'];?></p>
              </div>
            </div>
            <hr style="border-top: 1px solid rgba(128, 128, 128, 0.5);" class="col-sm-6">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Cin</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($participant['cin'])) 
    echo $participant['cin'];?></p>
              </div>
            </div>
            <hr style="border-top: 1px solid rgba(128, 128, 128, 0.5);" class="col-sm-6">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($participant['tel'])) 
    echo $participant['tel'];?></p>
              </div>
            </div>
            <hr style="border-top: 1px solid rgba(128, 128, 128, 0.5);" class="col-sm-6">
         
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-4">
                <p class="text-muted mb-0"><?php if (isset($participant['address'])) 
    echo $participant['address'];?></p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

<?php include ('footer.php');?>