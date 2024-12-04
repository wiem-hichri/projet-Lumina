<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
require '../../../config.php';

$sql = 'select * from participant where participant_id=?';

$req = $conn->prepare($sql);
$req->execute([$_GET["participant_id"]]);
$row = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">

        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update participant</h5>
            <div class="card-body">
                <form action="update.php" onsubmit="return onSubmitForm()" method="post">
                    <div class="row">
                        <input required type="text" class="form-control" name="admin_id" style="visibility:hidden"
                            value="<?php echo $row['participant_id'] ?>">

                        <div class="mb-3 w-50">
                            <label class="form-label">First name</label>
                            <input required type="text" class="form-control" name="first_name"
                                value="<?php echo $row['first_name'] ?>">
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Last name</label>
                            <input required type="text" class="form-control" name="last_name"
                                value="<?php echo $row['last_name'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input required type="email" class="form-control" name="email"
                            value="<?php echo $row['email'] ?>">
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
                            <label class="form-label">Phone number</label>
                            <input required type="tel" class="form-control" name="tel" aria-describedby="emailHelp"  id="tel"
                                value="<?php echo $row['tel'] ?>">
                            <div class="form-text">Enter only your phone number +216 ** *** ***

                            </div>
                        </div>
                        <div class="mb-3  w-50">
                            <label class="form-label">CIN</label>
                            <input required type="text" class="form-control" name="cin" id="cin"
                                aria-describedby="emailHelp" value="<?php echo $row["cin"] ?>">
                            <div class="form-text">Enter your 8 digit CIN number.
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="mb-3 w-50">
                            <label class="form-label">Adresse</label>
                            <input required type="text" class="form-control" name="address"
                                value="<?php echo $row['address'] ?>">
                        </div>

                        <div class="mb-3 w-50">

                            <label class="form-label">Profession</label>
                            <Select name="poste" class="form-control">
                                <option></option>
                                <option value="Mobile App Developer">Mobile App Developer</option>
                                <option value="Data Scientist">Data Scientist </option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Cloud Architect">Cloud Architect</option>
                                <option value="Systems Administrator">Systems Administrator</option>

                            </Select>
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