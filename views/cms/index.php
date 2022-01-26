<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Button;
use yii\helpers\Url;

$this->title = 'List of articles';
?>
<div class="site-index">
    <?php foreach($articles as $article): ?>
        <div class="row alert alert-secondary">
            <div class="col-xs">
                <?=$article->id?>
            </div>
            <div class="col-sm">
                <?=$article->title?>
            </div>
            <div class="col-sm">
                <?=$article->author?>
            </div>
            <div class="col-sm">
                <?=$article->date?>
            </div>
            <div class="col-sm">
                <img src="<?=$article->thumbnail?>" alt="" class="img-fluid img-thumbnail" style="max-width: 200px;">
            </div>
            <div class="col-xs">
                <div><a href="/cms/edit/<?=$article->id?>" class="btn btn-primary">Edit</a></div>
                <br>
                <div><a href="/cms/delete/<?=$article->id?>" class="btn btn-danger">Delete</a></div>
            </div>
        </div>

    <?php endforeach; ?>
</div>
