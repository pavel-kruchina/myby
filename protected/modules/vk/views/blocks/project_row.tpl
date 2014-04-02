<div class="project-container">
    <div class="project-date">{$project->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
    <div class="project-title">{$project->title}</div>
    <div class="project-describe">{$project->describe}</div>
    <div class="project-offers">
        <a href="{Yii::app()->request->baseUrl}/vk/project/{$project->id}">
                Смотреть предложения ({if $offersCount[$project->id]}{$offersCount[$project->id]->offersCount}{else}0{/if})
        </a>
        {if $project->user_id == Yii::app()->user->getId() && $project->deleted=='no'}
            <a class="thisPage" style="float: right" href="{Yii::app()->request->baseUrl}/vk/project/{$project->id}/?delete=1" onclick="return confirm('Вы точно хотите закрыть этот заказ?')">Закрыть заказ</a>
        {/if}
        
        {if $project->deleted=='yes'}<span style="float: right; font-weight: bold">Заказ закрыт</span>{/if}
    </div>
</div>
