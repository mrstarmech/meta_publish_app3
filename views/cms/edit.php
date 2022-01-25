<?php
/**
 * @var yii\db\ActiveRecord $model
 */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$form = ActiveForm::begin();
echo $form->field($model, 'title')->textInput([
    'minlength' => 3,
    'maxlength' => 255
]);
echo $form->field($model, 'author')->textInput([
    'minlength' => 3,
    'maxlength' => 255
]);
echo $form->field($model, 'date')->widget(yii\jui\DatePicker::class);
echo $form->field($model, 'thumbnail')->fileInput();
echo $form->field($model, 'thumbstring')->textarea([
    'rows' => 3,
    'style' => 'resize:none;width:100%;padding:10px;font-size:1em;',
    'maxlength' => 255
]);
echo $form->field($model, 'actual_content')->textarea([
    'rows' => 32,
    'style' => 'resize:none;width:100%;padding:10px;font-size:1em;'
]);
echo $form->field($model, 'content_id')->textInput([
    'hidden',
    'value' => 1
]);
echo $form->field($model, 'category_id')->textInput();
echo $model->isNewRecord ? Html::submitButton('Create', ['class' => 'btn btn-success']) : Html::submitButton('Update', ['class' => 'btn btn-primary']);
ActiveForm::end();