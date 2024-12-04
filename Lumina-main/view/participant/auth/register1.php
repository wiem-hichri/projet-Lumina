<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumina</title>
    <link rel="shortcut icon" type="image/png" href="../../../assets/dashboard/images/logos/light-bulb.png" />
    <link rel="stylesheet" href="../../../assets/dashboard/css/styles.min.css" />
</head>

<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">



                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="../../main/home.php"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../../../assets/dashboard/images/logos/lumina-logo.png" width="180"
                                        alt="">
                                </a>
                                <p class="text-center">Join us</p>
                                <form action="participantStore.php" onsubmit="return onSubmitForm()" method="post"
                                    style="padding: 0 0 0 250px">
                                    <div class="row">
                                        <div class="mb-3 w-50">
                                            <label class="form-label">First name</label>
                                            <input required type="text" class="form-control" name="first_name"
                                                placeholder="Enter your first name">

                                        </div>
                                        <div class="mb-3 w-50">
                                            <label class="form-label">Last name</label>
                                            <input required type="text" class="form-control" name="last_name"
                                                placeholder="Enter your last name">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 w-50">
                                            <label class="form-label">Email address</label>
                                            <input required type="email" class="form-control" id="email" name="email">
                                            <div class="form-text">Enter your email address with the '@' symbol included
                                            </div>
                                        </div>
                                        <div class="mb-3 w-50">
                                            <label class="form-label">Phone number</label>
                                            <input required type="tel" class="form-control" name="tel" id="tel">
                                            <div class="form-text">Enter only your phone number +216 ** *** ***
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 w-50">
                                            <label class="form-label">Password</label>
                                            <input required type="password" class="form-control" name="password"
                                                id="password" placeholder="Enter your password">

                                        </div>
                                        <div class="mb-3 w-50">
                                            <label class="form-label">Confirm password</label>
                                            <input required type="password" class="form-control" name="password"
                                                id="confirmPassword" placeholder="Confirm Password">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mb-3 w-50">
                                            <label class="form-label">CIN</label>
                                            <input required type="text" class="form-control" name="cin" id="cin">
                                            <div class="form-text">Enter your 8 digit CIN number.
                                            </div>
                                        </div>
                                        <div class="mb-3 w-50">
                                            <label class="form-label">Address</label>
                                            <input required type="text" class="form-control" name="address"
                                                placeholder="Enter your Address" id="adress">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 ">
                                            <label class="form-label">Profession</label>
                                            <input required type="text" class="form-control" name="profession"
                                                id="profession">
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>
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
            phoneNumber.value = "";
            errorMessage += "Please enter a valid phone number.\n";
        }
        return errorMessage;
    }

    function validateCIN() {
        var cin = document.getElementById("cin").value;
        var errorMessage = "";

        if (cin.length !== 8) {
            cin.value = "";
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

</html>