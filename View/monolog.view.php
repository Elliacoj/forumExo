<?php
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/log.txt");

if($file) { ?>
<div id="monolog"><?= nl2br($file) ?> </div> <?php
}