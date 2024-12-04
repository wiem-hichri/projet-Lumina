<?php
if (isset($_SESSION['successAdd'])) {
    echo '<div id="successAddAlert" class="alert alert-success">' . $_SESSION['successAdd'] . '</div>';
    unset($_SESSION['successAdd']); // Clear the session variable after displaying the message
}

// Display error message for add operation if it exists
if (isset($_SESSION['errorAdd'])) {
    echo '<div id="errorAddAlert" class="alert alert-danger">' . $_SESSION['errorAdd'] . '</div>';
    unset($_SESSION['errorAdd']); // Clear the session variable after displaying the message
}

// Display success message for edit operation if it exists
if (isset($_SESSION['successUpdate'])) {
    echo '<div id="successEditAlert" class="alert alert-success">' . $_SESSION['successUpdate'] . '</div>';
    unset($_SESSION['successUpdate']); // Clear the session variable after displaying the message
}

// Display error message for edit operation if it exists
if (isset($_SESSION['errorUpdate'])) {
    echo '<div id="errorEditAlert" class="alert alert-danger">' . $_SESSION['errorUpdate'] . '</div>';
    unset($_SESSION['errorUpdate']); // Clear the session variable after displaying the message
}

// Display success message for delete operation if it exists
if (isset($_SESSION['successDelete'])) {
    echo '<div id="successDeleteAlert" class="alert alert-success">' . $_SESSION['successDelete'] . '</div>';
    unset($_SESSION['successDelete']); // Clear the session variable after displaying the message
}

// Display error message for delete operation if it exists
if (isset($_SESSION['errorDelete'])) {
    echo '<div id="errorDeleteAlert" class="alert alert-danger">' . $_SESSION['errorDelete'] . '</div>';
    unset($_SESSION['errorDelete']); // Clear the session variable after displaying the message
} // Display success message for login operation if it exists
if (isset($_SESSION['successLogin'])) {
    echo '<div id="successLoginAlert" class="alert alert-success">' . $_SESSION['successLogin'] . '</div>';
    unset($_SESSION['successLogin']); // Clear the session variable after displaying the message
}

// Display error message for login operation if it exists
if (isset($_SESSION['errorLogin'])) {
    echo '<div id="errorLoginAlert" class="alert alert-danger">' . $_SESSION['errorLogin'] . '</div>';
    unset($_SESSION['errorLogin']); // Clear the session variable after displaying the message
}

// Display success message for logout operation if it exists
if (isset($_SESSION['successLogout'])) {
    echo '<div id="successLogoutAlert" class="alert alert-success">' . $_SESSION['successLogout'] . '</div>';
    unset($_SESSION['successLogout']); // Clear the session variable after displaying the message
}

// Display error message for logout operation if it exists
if (isset($_SESSION['errorLogout'])) {
    echo '<div id="errorLogoutAlert" class="alert alert-danger">' . $_SESSION['errorLogout'] . '</div>';
    unset($_SESSION['errorLogout']); // Clear the session variable after displaying the message
} ?>
<script>
    setTimeout(function () {
        var successLoginAlert = document.getElementById('successLoginAlert');
        var errorLoginAlert = document.getElementById('errorLoginAlert');
        var successLogoutAlert = document.getElementById('successLogoutAlert');
        var errorLogoutAlert = document.getElementById('errorLogoutAlert');
        var successAddAlert = document.getElementById('successAddAlert');
        var errorAddAlert = document.getElementById('errorAddAlert');
        var successEditAlert = document.getElementById('successEditAlert');
        var errorEditAlert = document.getElementById('errorEditAlert');
        var successDeleteAlert = document.getElementById('successDeleteAlert');
        var errorDeleteAlert = document.getElementById('errorDeleteAlert');

        var alerts = [
            successLoginAlert,
            errorLoginAlert,
            successLogoutAlert,
            errorLogoutAlert,
            successAddAlert,
            errorAddAlert,
            successEditAlert,
            errorEditAlert,
            successDeleteAlert,
            errorDeleteAlert
        ];

        alerts.forEach(function (alert) {
            if (alert) {
                alert.style.display = 'none';
            }
        });
    }, 5000);
</script>