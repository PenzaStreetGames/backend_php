<?php
$session = Yii::$app->session;
if ($session->isActive) {
    $session->open();
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Кафедра ПМ</title>
    <link href="<?php echo $themeStyleSheet; ?>" rel="stylesheet" id="theme-link">
</head>
<?php if ($lang == "ru"):
    include "lang/ru.php"
    ?>
<?php else:
    include "lang/en.php"
    ?>
<?php endif ?>
<script src="js/cookies.js"></script>
</html>