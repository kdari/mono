<?php
header('Content-disposition: attachment; filename='. urlencode($_GET["fname"]). '.mp3');
header('Content-type: audio/mpeg');
readfile($_GET["file"]);
?>