<?php
require_once('conf.php');
global $yhendus;
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Fetch advertisements associated with the user ID
$sql = "SELECT advert_id, advert_title, advert_description, created_at FROM advert_table WHERE user_id = ?";
$stmt = $yhendus->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $advertisements = array();
    $result = $stmt->get_result();
    // Check if there are any advertisements
    if ($result->num_rows > 0) {
        // Output the list of advertisements
        while ($row = $result->fetch_assoc()) {
            $advert = new stdClass();
            $advert->advert_id = $row['advert_id'];
            $advert->user_id = $user_id;
            $advert->advert_title = htmlspecialchars($row['advert_title']); // Assign advert_title from the fetched row
            $advert->description = htmlspecialchars($row['advert_description']); // Assign advert_description from the fetched row
            $advert->created_at = $row['created_at']; // Assign created_at from the fetched row
            array_push($advertisements, $advert);
        }
    } else {
        echo "Teil pole ühtegi kuulutust";
    }
    $stmt->close();
} else {
    echo "Error: " . $yhendus->error;
}
if (isset($_POST["delete"])) {
    delete_advert($_POST["advert_id"]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function delete_advert($advert_id)
{
    global $yhendus;
// Delete associated rows from advert_files table
    $stmt_files = $yhendus->prepare("DELETE FROM advert_files WHERE advert_id = ?");
    $stmt_files->bind_param("i", $advert_id);
    $stmt_files->execute();
    $stmt_files->close();

    // Now delete the row from advert_table
    $stmt = $yhendus->prepare("DELETE FROM advert_table WHERE advert_id = ?");
    $stmt->bind_param("i", $advert_id);
    $stmt->execute();
    $stmt->close();
}

$yhendus->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Website</title>
    <?php include 'head-links.php'; ?>
</head>
<body>
<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar.php'?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <div class="container ">

            <div class="row justify-content-center">
                <div class="col-md-10 mb-5">
                    <h2 class="mt-5">Minu kuulutused</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-left" scope="col">Kuulutus</th>
                                <th class="text-left" scope="col">Lisatud</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($advertisements as $advert): ?>
                                <tr>
                                    <td>
                                        <div class="row ">
                                          <h5 style="word-wrap: break-word;">
                                                    <?=$advert->advert_title ?>
                                          </h5>
<!--                                                <p class="truncated-text">-->
<!--                                                    --><?php //=$advert->description ?>
<!--                                                </p>-->
                                        </div>
                                    </td>
                                    <td class="text-left"><?= date("d.m.Y", strtotime($advert->created_at)) ?>
                                    </td>
                                    <td><div class="d-flex justify-content-center align-items-center ">
                                            <a class="btn custom-button" href="advert_edit.php?advert_id=<?= $advert->advert_id ?>"">Muuda</a>

                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="ml-3">
                                                <input type="hidden" name="advert_id" value="<?= $advert->advert_id ?>">
                                                <button type="submit" name="delete" class="btn btn-danger ">Kustuta</button>
                                            </form>
                                        </div></td>
                                </tr>
                            <?php endforeach; ?>ˇˇ
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="../js/scripts.js"></script>
</div>
</body>

<?php include 'contact.php'; ?>
<!--Footer -->
<?php include 'footer.php'; ?>


</html>
