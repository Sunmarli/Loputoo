<?php
require_once('conf.php');
session_start();
global $yhendus;
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $yhendus->prepare("UPDATE users SET first_name=?, last_name=?, username=?, email=? WHERE user_id=?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $username, $email, $user_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
        // Optionally, you can redirect the user to another page after the update
        // header("Location: profile.php");
        // exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch user data
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <?php include 'head-links.php'; ?>
</head>
<body>

<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar.php'; ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div id="successMessage"></div>
                <div class="col-md-8 order-md-1">

                    <div class="row rounded p-3" style="background-color: #edeff1">
                        <div class="card p-2 mb-5">

                            <form id="profileForm" method="post" action="">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr class="table-row">
                                        <td>Nimi:</td>
                                        <td><input type="text" name="first_name" value="<?= $user['first_name'] ?>" class="form-control" disabled></td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>Perekonnanimi:</td>
                                        <td><input type="text" name="last_name" value="<?= $user['last_name'] ?>" class="form-control" disabled></td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>Username:</td>
                                        <td><input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" disabled></td>
                                    </tr>

                                    <tr class="table-row">
                                        <td>Firma email:</td>
                                        <td><input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" disabled></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div id="buttons">
                                    <button type="submit" class="btn btn-primary" style="display: none;">Salvesta</button>
                                    <button type="button" class="btn btn-secondary edit-profile">Muuda</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main content -->

    <!-- Contact -->
    <?php include 'contact.php'; ?>
    <!-- End Contact -->

</div>

<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv</div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<?php include 'script-links.php'; ?>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $(".edit-profile").click(function () {
            $("input").prop("disabled", false);
            $(".edit-profile").hide();
            $("button[type='submit']").show();
        });

        $("#profileForm").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request to the server
            $.ajax({
                type: "POST",
                url: "user-profile.php", // PHP script to handle the update
                data: formData,
                success: function (response) {

                    // After successful profile update, display success message
                    $("#successMessage").html('<div class="alert alert-success" role="alert">Profile updated successfully.</div>');

                    // Delay reloading the page by 5 seconds (5000 milliseconds)
                    setTimeout(function() {
                        $("#successMessage").html('');
                        window.location.reload();
                    }, 6000);

                },
                error: function (xhr, status, error) {
                    // Handle errors
                    $(".alert").html('<div class="alert alert-danger" role="alert">Error updating profile. Please try again later.</div>');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


</body>
</html>
