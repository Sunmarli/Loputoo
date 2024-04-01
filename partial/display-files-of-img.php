<?php
$directory = '/user_files/';
global $yhendus;
$stmt = $yhendus->prepare("SELECT filename, file_path FROM advert_files WHERE advert_id = ?");
$stmt->bind_param("i", $advert_id);
$stmt->execute();
$stmt->bind_result($filename, $file_path);

while ($stmt->fetch()) {
    $file_url = $directory . $file_path;

    // Output the file download link
    echo '<a href="' . $file_url . '" download>' . $filename . '</a><br>';
}


$stmt->close();
?>