<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
require '../../../config.php';

$sql = 'select * from formateur where formateur_id=?';

$req = $conn->prepare($sql);
$req->execute([$_GET["formateur_id"]]);
$row = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Formateur</h5>
            <div class="card-body">
                <form action="update.php"onsubmit="return onSubmitForm()" method="post">
                    <div class="row">
                        <input required type="text" class="form-control" name="formateur_id" style="visibility:hidden"
                            value="<?php echo $row['formateur_id'] ?>">

                        <div class="mb-3 w-50">
                            <label class="form-label">First name</label>
                            <input required type="text" class="form-control" name="first_name"
                                value="<?php echo $row['first_name'] ?>">
                            <div class="form-text">Enter your first name</div>
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Last name</label>
                            <input required type="text" class="form-control" name="last_name"
                                value="<?php echo $row['last_name'] ?>">
                            <div class="form-text">Enter your last name</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Email address</label>
                            <input required type="email" class="form-control" name="email"
                                value="<?php echo $row['email'] ?>">
                            <div class="form-text">Enter your email address with the '@' symbol included</div>
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Phone number</label>
                            <input required type="tel" class="form-control" name="tel" aria-describedby="emailHelp" id="tel"
                                value="<?php echo $row['tel'] ?>">
                            <div class="form-text">Enter only your phone number +216 ** *** ***
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Password</label>
                            <input required type="password" class="form-control" name="password"  id="password"
                                value="<?php echo $row['password'] ?>">
                            
                        </div>

                        <div class="mb-3 w-50">
                            <label class="form-label">Confirm password</label>
                            <input required type="password" class="form-control" name="password" id="confirmPassword">
                        </div>


                    </div>

                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">CIN</label>
                            <input required type="text" class="form-control" name="cin" aria-describedby="emailHelp"
                                value="<?php echo $row['cin'] ?>"  id="cin">
                            <div class="form-text">Enter your 8 digit CIN number.
                            </div>
                        </div>

                        <div class="mb-3 w-50">
                            <label class="form-label">Spécialité</label>
                            <select name="specialite" class="form-control">
                                <option value=""></option>
                                <option value="Mathematique" <?php if ($row['specialite'] == "Mathematique")
                                    echo "selected"; ?>>Mathematique</option>
                                <option value="Digital Marketing" <?php if ($row['specialite'] == "Digital Marketing")
                                    echo "selected"; ?>>Digital Marketing</option>
                                <option value="FrontEnd Web Developpement" <?php if ($row['specialite'] == "FrontEnd Web Developpement")
                                    echo "selected"; ?>>FrontEnd Web Developpement</option>
                                <option value="BackEnd Web Developpement" <?php if ($row['specialite'] == "BackEnd Web Developpement")
                                    echo "selected"; ?>>BackEnd Web Developpement</option>
                            </select>
                            <div class="form-text">Select your speciality</div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Rib</label>
                            <input required type="text" class="form-control" name="rib"  id="rib"
                                value="<?php echo $row['rib'] ?>">
                            <div class="form-text">Enter your bank account number (RIB)</div>

                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Banque</label>
                            <select name="banque" class="form-control">
                                <option value="STB" <?php if ($row['banque'] == "STB")
                                    echo "selected"; ?>>STB</option>
                                <option value="ATB" <?php if ($row['banque'] == "ATB")
                                    echo "selected"; ?>>ATB</option>
                                <option value="BNA" <?php if ($row['banque'] == "BNA")
                                    echo "selected"; ?>>BNA</option>
                                <option value="Zitouna" <?php if ($row['banque'] == "Zitouna")
                                    echo "selected"; ?>>Zitouna
                                </option>
                                <option value="Amen" <?php if ($row['banque'] == "Amen")
                                    echo "selected"; ?>>Amen</option>
                                <option value="Wifek" <?php if ($row['banque'] == "Wifek")
                                    echo "selected"; ?>>Wifek</option>
                                <option value="BH" <?php if ($row['banque'] == "BH")
                                    echo "selected"; ?>>BH</option>
                            </select>
                            <div class="form-text">Pick your bank from the list</div>
                        </div>
                    </div>
                    <button onclick="return confirm('Are you sure you want to update?')" type="submit"
                        class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        var errorMessage = "";

        if (password !== confirmPassword) {
            errorMessage += "Passwords do not match.\n";
            confirmPassword.value = "";
        }
        if (password.length < 8) {
            password.value = "";
            errorMessage += "Password must be 8 characters or less.\n";
        }
        return errorMessage;
    }

    function validatePhoneNumber() {
        var phoneNumber = document.getElementById("tel").value;
        var errorMessage = "";

        if (phoneNumber.length !== 8) {
            phoneNumber.value="";
            errorMessage += "Please enter a valid phone number.\n";
        }
        return errorMessage;
    }

    function validateRib() {
        var rib = document.getElementById("rib").value;
        var errorMessage = "";

        if (rib.length !== 24) {
            rib.value="";
            errorMessage += "Please enter a valid rib.\n";
        }
        return errorMessage;
    }
    function validateCIN() {
        var cin = document.getElementById("cin").value;
        var errorMessage = "";

        if (cin.length !== 8) {
            cin.value="";
            errorMessage += "Please enter a valid 8-digit CIN number.\n";
        }
        return errorMessage;
    }
   
    function onSubmitForm() {
        var errorMessage = validatePassword() + validatePhoneNumber() + validateCIN() + validateRib();

        if (errorMessage) {
            alert(errorMessage);
            return false;
        } else {
            return true;
        }
    }
</script>
<?php include ('../layouts/footer.php'); ?>