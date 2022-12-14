<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>

<?php
foreach ($files as $file) {
    echo "<div class='card'><a class='card-body' href='uploads/".$file."'>".$file."</a></div>";
}
