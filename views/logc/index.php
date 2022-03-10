<?php

use yii\bootstrap4\Button;
use yii\helpers\Url;
use app\models\Click;

$this->title = 'Click Log';
?>
<div class="site-index" style="padding: 0 15px;">
    <table class="table table-sm table-bordered table-hover" style="font-size: 12px; min-width: 1920px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><a href="/logc?order=visitorId">VisitorID</a></th>
                <th scope="col">Uclick</th>
                <th scope="col"><a href="/logc?order=time">Time</a></th>
                <th scope="col"><a href="/logc?order=clientReferer">Url</a></th>
                <th scope="col"><a href="/logc?order=ip">Ip</a></th>
                <th scope="col"><a href="/logc?order=incognito">Incognito</a></th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clicks as $click): ?>
                <tr>
                    <th scope="row"><?=$click->id?></th>
                    <td><?=$click->visitorId?></td>
                    <td><?=$click->linkedId?></td>
                    <td><?=$click->time?></td>
                    <td><?=$click->url?></td>
                    <td><?=$click->ip?></td>
                    <td><?=$click->incognito?></td>
                    <td><a href="/logc/detail/<?=$click->id?>" class="btn btn-primary" style="font-size:10px;line-height:1;padding:2px"><b>D</b></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>