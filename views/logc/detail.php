<?php
/**
 * @var yii\db\ActiveRecord $model
 */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
$this->title = "Click Detail";
$al = $click->attributeLabels();
$bd = $click->browserDetails;
$bdal = $bd->attributeLabels();
$il = $click->ipLocation;
$ilal = $il->attributeLabels();
?>
<div class="site-index" style="padding: 0 15px;">
    <table class="table table-sm table-bordered table-hover" style="font-size: 12px; min-width: 1920px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Click Info</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($click as $key => $value):?>
                <tr>
                    <th scope="row"><?=$al[$key]?></th>
                    <td><?=$value?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="table table-sm table-bordered table-hover" style="font-size: 12px; min-width: 1920px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Browser Info</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bd as $key => $value):?>
                <tr>
                    <th scope="row"><?=$bdal[$key]?></th>
                    <td><?=$value?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="table table-sm table-bordered table-hover" style="font-size: 12px; min-width: 1920px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Ip Info</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($il as $key => $value):?>
                <tr>
                    <th scope="row"><?=$ilal[$key]?></th>
                    <td><?=$value?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>