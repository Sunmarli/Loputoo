<?php
require_once ('conf.php');
global $yhendus;
session_start();

//// Check if advert_id is provided in the URL
//if (isset($_GET['advert_id'])) {
//    $advert_id = $_GET['advert_id'];
//}else {
//    echo 'no advert id provided';
//    exit();
//}
$advert_id=43;
$company_id = null;
// Check if user_id is set in session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $company_id = null;
} elseif (isset($_SESSION['company_id'])) { // Check if company_id is set in session
    $company_id = $_SESSION['company_id'];
    $user_id = null;
} else {
    // If neither user_id nor company_id is set, handle the error or redirect
    echo "Error: User or company not logged in.";
    exit;
}
// Prepare and execute a query to fetch details based on advert_id
$stmt = $yhendus->prepare("SELECT user_id, advert_title, advert_description, region, city, work_start_date,work_end_date, created_at FROM advert_table WHERE advert_id = ?");
$stmt->bind_param("i", $advert_id);
$stmt->execute();
$stmt->bind_result($user_id, $advert_title,$advert_description, $region, $city, $work_start_date,$work_end_date,  $created_at);

if ($stmt->fetch()) {
    $advert = new stdClass();

    $advert->user_id = $user_id;
    $advert->advert_title = htmlspecialchars($advert_title);
    $advert->advert_description=htmlspecialchars($advert_description);
    $advert->region = htmlspecialchars($region);
    $advert->city = htmlspecialchars($city);
    $advert->work_start_date = $work_start_date;
    $advert->created_at = $created_at;

} else {

    echo "Advertisement not found.";
}
$stmt->close();




$sql = "SELECT comments.*, users.username
         FROM comments 
         inner join  users ON comments.user_id = users.user_id
         WHERE advert_id = $advert_id 
         ORDER BY created_at DESC";


$result = mysqli_query($yhendus, $sql);

// Convert the result set to an associative array
$comments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $comments[] = $row;
}

function displayNestedComments($comments, $parentCommentId, $indentation = 1, $company_id, $advert_id, $user_id) {

    foreach ($comments as $comment) {
        if ($comment['parent_comment_id'] == $parentCommentId) {
            echo '<div class="comment nested-comment" style="background-color: lightblue; margin-left: ' . ($indentation * 20) . 'px">';
            echo '<p>' . $comment['username'] . '</p>';
            echo '<p>' . $comment['created_at'] . '</p>';
            echo '<p>' . $comment['comment_text'] . '</p>';

            // Reply link and form
            echo '<a href="#" class="reply_link" data-comment-id="' . $comment['comment_id'] . '">Reply</a>';
            echo '<div class="reply_form nested-comment" style="display: none;">';
            echo '<form id="comment_form" action="submit_comment.php" method="post">';
            echo '<input type="hidden" name="parent_comment_id" value="' . $comment['comment_id'] . '">';
            echo '<input type="hidden" name="advert_id" value="' . $advert_id . '">';
            echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
            echo '<input type="hidden" name="company_id" value="' . $company_id . '">';

            echo '<textarea name="reply_text" rows="3" placeholder="Enter your reply"></textarea>';
            echo '<button type="submit" name="submit">Submit Reply</button>';
            echo '</form>';
            echo '</div>';

            // Recursive call to display nested comments
            displayNestedComments($comments, $comment['comment_id'], $indentation + 1, $company_id, $advert_id, $user_id);

            echo '</div>';
        }
    }


}
// Close the database connection
mysqli_close($yhendus);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Website</title>
</head>
<body>
<!-- Navbar -->
<?php include 'partial/nav-bar-outside-partial.php'; ?>
<!-- End Navbar -->

<div class="container-fluid px-0">
    <!-- Main content -->
    <main>
        <div class="bg-light">

        <div class="container mt-5">
            <div class="row rounded p-3" style="background-color: #edeff1" >
                <div class="col-md-8 order-md-1" >
                    <h3 class="mb-4 mt-4"><?=$advert_title ?></h3>
                    <div class="card p-2">
                        <table class="table table-borderless">
                            <colgroup>
                                <col style="width: 50%">
                                <col style="width: 50%">
                            </colgroup>
                            <tbody>
                            <tr class="table-row">
                                <td>Hanke lõpp:</td>
                                <td><?=$work_start_date ?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Maakond:</td>
                                <td><?=$region ?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Linn:</td>
                                <td><?=$city ?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Tööde algus:</td>
                                <td><?=$work_start_date?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Tööde lõpp:</td>
                                <td><?=$work_end_date ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row ml-2 mr-2">
                        <label for="description" class="form-label mt-4">Töö sisu :</label>
                        <div id="description"><?=$advert_description ?></div>
                        <label for="failid" class="form-label mt-4">Pildid, videod ja failid</label>
                        <div id="failid"><?php include 'partial/display-files-of-img.php'; ?> </div>

                        <div class="card p-2 mt-5">


                            <!-- Display existing comments and replies -->
                            <h4>Küsimused hanke korraldajale</h4>
                            <hr>
                            <form id="comment_form" action="submit_comment.php" method="post">
                                <input type="hidden" name="advert_id" value="<?php echo $advert_id; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
                                <textarea name="comment_text" rows="3" placeholder="Enter your comment"></textarea>
                                <button type="submit" name="submit">Submit Comment</button>
                            </form>

                            <div id="comments">
                                <?php foreach ($comments as $comment): ?>
                                    <?php if (is_null($comment['parent_comment_id'])): ?>
                                        <div class="comment" style="background-color: #ff8080">
                                            <p><strong><?php echo $comment['username']; ?></strong> - <?php echo $comment['created_at']; ?></p>
                                            <p><?php echo $comment['comment_text']; ?></p>
                                            <a href="#" class="reply_link" data-comment-id="<?php echo $comment['comment_id']; ?>">Reply</a>
                                            <div class="reply_form nested-comment" style="display: none;">
                                                <form id="comment_form" action="submit_comment.php" method="post">
                                                    <input type="hidden" name="parent_comment_id" value="<?php echo $comment['comment_id']; ?>">
                                                    <input type="hidden" name="advert_id" value="<?php echo $advert_id; ?>">
                                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                    <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
                                                    <textarea name="reply_text" rows="3" placeholder="Enter your reply"></textarea>
                                                    <button type="submit" name="submit">Submit Reply</button>
                                                </form>
                                            </div>
                                            <!-- Display nested comments for this parent comment -->
                                            <?php displayNestedComments($comments, $comment['comment_id'], 1, $company_id, $advert_id, $user_id); ?>

                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                    </div>


                <div class="col-md-4 order-md-2 mb-4">
                    <?php if(isset($_SESSION['company_id'])): ?>
                        <h4 class="d-flex justify-content-between align-items-center mb-3 mt-5">
                            <span class="text">Minu pakkumine</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>
                        <form class="card p-2 mb-5" method="post" action="/partial/submit_offer.php">
                            <input type="hidden" name="advert_id" value="<?php echo $advert_id; ?>">
                            <input type="hidden" name="company_id" value="<?php echo $_SESSION['company_id']; ?>">
                            <div class="mb-3">
                                <label for="summa" class="form-label">Summa</label>
                                <input type="text" class="form-control" id="summa" name="summa">
                            </div>
                            <!--                        <div class="mb-3">-->
                            <!--                            <label for="kaibemaks" class="form-label">Käibemaks</label>-->
                            <!--                            <select class="form-select" id="kaibemaks" aria-label="Default select example">-->
                            <!---->
                            <!--                                <option value="hinna-sees">Hinna Sees</option>-->
                            <!--                                <option value="option-2">Option 2</option>-->
                            <!--                            </select>-->
                            <!--                        </div>-->
                            <div class="mb-3">
                                <label for="kirjeldus" class="form-label">Pakkumise kirjeldus</label>
                                <textarea name="offer_description" class="form-control" id="kirjeldus" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn custom-button2 mt-4" name="submit">Saada pakkumine</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main content -->

    <hr>

    <!-- Contact -->
    <?php include 'partial/contact.php'; ?>
    <!-- End Contact -->

</div>

<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Custom JS -->
<script src="js/scripts.js"></script>
<script>
    $(document).ready(function() {
        $(".reply_link").click(function(e) {
            e.preventDefault(); // Prevent default link behavior

            // Get the corresponding reply form
            var replyForm = $(this).next(".reply_form");

            // Toggle the visibility of the reply form
            replyForm.slideToggle();
        });
    });
</script>


</body>
</html>