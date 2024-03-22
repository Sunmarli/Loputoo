<?php
require_once ('conf.php');

global $yhendus;

if (isset($_REQUEST["first_name"], $_REQUEST["last_name"], $_REQUEST["username"], $_REQUEST["email"], $_REQUEST["password"])) {
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    $checkUsernameQuery = $yhendus->prepare("SELECT user_id FROM users WHERE username = ?");
    $checkUsernameQuery->bind_param("s", $username);
    $checkUsernameQuery->execute();
    $result = $checkUsernameQuery->get_result();

    if ($result->num_rows > 0) {
        echo "Username is already taken. Please choose another one.";
    } else {
        // Hash the password using PASSWORD_DEFAULT
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertUserQuery = $yhendus->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $insertUserQuery->bind_param("sssss", $first_name, $last_name, $username, $email, $hashedPassword);


        if ($insertUserQuery->execute()) {
            // Get the user_id of the newly inserted user
            $newUserId = $insertUserQuery->insert_id;
            echo "<script>alert('User registered successfully!');
            location.href='index.php'</script>";
        } else {
            echo "Error inserting user data: " . $insertUserQuery->error;
        }

        $insertUserQuery->close();
    }

    $checkUsernameQuery->close();
}

?>
<div id="eraisik_form" style="display: none">
    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mt-5 mb-5">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Loo konto</h2>
                                <form method="post">
                                    <div class="text mb-2" style="font-size: 11px">Teie nimi ja perekonnanimi on nähtav ainult Tuleohutusteenused.ee'le </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" id="eesnimi" name="first_name" class="form-control form-control-lg" placeholder=" " />
                                        <label for="eesnimi">Eesnimi</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" id="perenimi" name="last_name" class="form-control form-control-lg" placeholder=" " />
                                        <label for="perenimi">Perekonnanimi</label>
                                    </div>
                                    <div class="text-xs mb-2" style="font-size: 11px">Seda nime näietakse kuulutuses. </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" id="kasutajanimi" name="username" class="form-control form-control-lg" placeholder=" " />
                                        <label for="kasutajanimi">Kasutajanimi</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder=" " />
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="text-xs mb-2" style="font-size: 11px" >Vähemalt 8 sümbolit. </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" id="parool" name="password" class="form-control form-control-lg" placeholder=" " />
                                        <label for="parool">Parool</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" required="required" id="password_confirmation"  class="form-control form-control-lg" placeholder=" " />
                                        <label for="parool">Korrake parooli</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body col-12">Registreerun</button>
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Olete juba registreerunud? <a href="../login.php" class="fw-bold text-body"><u>Login here</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
</div>

<?php
//if(isSet($_REQUEST["lisatudeesnimi"])){
//    echo "Lisati $_REQUEST[lisatudeesnimi]";
//    echo "<script>
//            alert('Uus inimene lisatud');
//            location.href='registreerimine.php'
//            </script>";
//}
//?>
