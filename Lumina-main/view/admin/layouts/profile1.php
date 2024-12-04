<?php 
include('../../../config.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: auth/login.php");
    exit();
}
$admin_id = $_SESSION['admin_id'];

// Récupérer les données du admin à partir de la base de données
$sql = 'SELECT * FROM admin WHERE admin_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si les données du admin ont été récupérées avec succès
if (!$admin) {
    // Rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur
    echo "Erreur: admin introuvable.";
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
            <?php if (isset($admin['last_name'])) 
    echo $admin['last_name'];?>
     <?php if (isset($admin['first_name'])) 
    echo $admin['first_name'];?>
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
                <p class="text-muted mb-0"><?php if (isset($admin['email'])) 
    echo $admin['email'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Cin</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($admin['cin'])) 
    echo $admin['cin'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($admin['tel'])) 
    echo $admin['tel'];?></p>
              </div>
            </div>
            <hr>
         
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Poste</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php if (isset($admin['poste'])) 
    echo $admin['poste'];?></p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

<?php include ('footer.php');?>