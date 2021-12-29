<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/style.css">
<?php
include_once(__DIR__ . '/config.php');
include_once(PRIVATE_DIR . '/db.php');
$example = $_GET["example"];
$sbscrption = new DB('test');
?>
<form method="get" action="#">
    <button type="submit" name="sort_week" class="button" value="1"> Sort Week </button>
</form>

<?php

$subsentities = $sbscrption->getAll();
if (isset($subsentities['entities'])) :
    foreach ($subsentities['entities'] as $sbscrption) : ?>
        <div class="box">
            <h2 class="emails"><?= $sbscrption['emails'] ?></h2>
            <p class="time"><?= $sbscrption['created_at'] ?></p>
        </div>
    <?php endforeach ?>
<?php endif ?>


</html>