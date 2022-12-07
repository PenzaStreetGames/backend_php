<?php

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Кафедра ПМ</title>
    <link href="<?php echo $data["themeStyleSheet"]; ?>" rel="stylesheet" id="theme-link">
</head>
<?php if ($data["lang"] == "ru"):
    include "adaptiveView/AdaptiveViewRu.php"
    ?>
<?php else:
    include "adaptiveView/AdaptiveViewEn.php"
    ?>
<?php endif ?>
<script src="js/cookies.js"></script>
</html>
