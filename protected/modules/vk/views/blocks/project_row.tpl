<div class="project-container">
    <div class="project-date">{$project->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
    <div class="project-title">{$project->title}</div>
    <div class="project-describe">{$project->describe}</div>
    <div class="project-offers">
        <a href="{Yii::app()->request->baseUrl}/vk/project/{$project->id}">
                Смотреть предложения ({if $offersCount[$project->id]}{$offersCount[$project->id]->offersCount}{else}0{/if})
        </a>
        {if $project->deleted=='yes'}<span style="float: right; font-weight: bold">Заказ не актуален</span>{/if}
    </div>
</div>
