<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
require '../../../config.php';

$sql = 'select * from admin where admin_id=?';

$req = $conn->prepare($sql);
$req->execute([$_GET["admin_id"]]);
$row = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new admin</h5>
            <div class="card-body">
                <form action="update.php"onsubmit="return onSubmitForm()" method="post">
                        <input required type="hidden" class="form-control" name="admin_id"
                            value="<?php echo $row['admin_id'] ?>">
                    <div class="row">

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
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email address</label>
                        <input required type="email" class="form-control" name="email"
                            value="<?php echo $row['email'] ?>" readonly>

                    </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input required type="password" class="form-control" name="password"id="password"
                                value="<?php echo $row['password'] ?>">
                            
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Confirm assword</label>
                            <input required type="password" class="form-control" name="password" id="confirmPassword">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Phone number</label>
                            <input required type="tel" class="form-control" name="tel" aria-describedby="emailHelp"  id="tell"
                                value="<?php echo $row['tel'] ?>">
                            <div class="form-text">Enter only your phone number +216 ** *** ***
                            </div>
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">CIN</label>
                            <input required type="text" class="form-control" name="cin" aria-describedby="emailHelp"
                                value="<?php echo $row['cin'] ?>" id="cin">
                            <div class="form-text">Enter your 8 digit CIN number.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Poste</label>
                        <select name="poste" class="form-control">
                            <option value="" <?php if ($row['poste'] == "")
                                echo "selected"; ?>></option>
                            <option value="Manager" <?php if ($row['poste'] == "Manager")
                                echo "selected"; ?>>Manager
                            </option>
                            <option value="HR" <?php if ($row['poste'] == "HR")
                                echo "selected"; ?>>HR</option>
                            <!-- Ajoutez d'autres options au besoin -->
                        </select>
                        <div class="form-text">Choose your job title from the list.</div>

                    </div>
                    <button onclick="return confirm('Are you sure you want to update?')" type="submit"
                        class="btn btn-primary">Submit</button>
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
        var errorMessage = validatePassword() + validatePhoneNumber() + validateCIN();

        if (errorMessage) {
            alert(errorMessage);
            return false;
        } else {
            return true;
        }
    }
</script>
<?php include ('../layouts/footer.php'); ?>