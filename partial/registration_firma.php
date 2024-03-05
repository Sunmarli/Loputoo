<?php
require_once('conf.php');

global $yhendus;

if (isset($_REQUEST['first_name'], $_REQUEST['last_name'], $_REQUEST['company_name'], $_REQUEST['registration_code'], $_REQUEST['address'], $_REQUEST['email'], $_REQUEST['password'])) {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $company_name = $_REQUEST['company_name'];
    $registration_code = $_REQUEST['registration_code'];
    $address = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $checkUserName = $yhendus->prepare("SELECT id FROM company_users WHERE company_name=?");
    $checkUserName->bind_param('s', $company_name);
    $checkUserName->execute(); // Execute the query

    $result = $checkUserName->get_result(); // Get the result

// Close the statement
    $checkUserName->close();

    if ($result->num_rows > 0) {
        echo "<script>alert('company already in database')</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = $yhendus->prepare("INSERT INTO company_users(first_name, last_name, company_name, registration_code, address, email, password) VALUES (?,?,?,?,?,?,?)");
        $insertQuery->bind_param('sssssss', $first_name, $last_name, $company_name, $registration_code, $address, $email, $hashedPassword);

        if ($insertQuery->execute()) {
            $newUserId = $insertQuery->insert_id;
            echo "<script>alert('company registered successfully!');</script>";
        } else {
            echo "Error inserting user data: " . $insertQuery->error;
        }

        // Close the statement
        $insertQuery->close();
    }
}


?>

<!--        <div class="user-info">-->
<!--            --><?php //=$_SESSION['kasutaja']?><!-- on logitud-->
<!--            <form action="" method="post">-->
<!--                <input type="submit" name="logout" value="Logi välja" class="logout-button">-->
<!--            </form>-->
<!--        </div>-->
<body>
<div id="firma_form" style="display: none">
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
                                    <div class="form-floating mb-4">
                                        <input type="text" id="firmaNimi" name="company_name" class="form-control form-control-lg" placeholder=" " />
                                        <label for="firmaNimi">Ettevõtte nimi</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" id="regkood" name="registration_code" class="form-control form-control-lg" placeholder=" " />
                                        <label for="regkood">Registreerimiskood</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input type="text" id="aadress" name="address" class="form-control form-control-lg" placeholder=" " />
                                        <label for="aadress">Aadress</label>
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
                                    <div class="d-flex justify-content-center ">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body col-12">Registreerun</button>
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Olete juba registreerunud? <a href="#!" class="fw-bold text-body"><u>Login here</u></a></p>
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
