         <div class="project-container">
            <div class="project-title">{$project->title}</div>
            <div class="project-date">{$project->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
            <div class="project-describe">{$project->describe}</div>
            <div class="project-response">
                {if $project->deleted=='no'}
                    <a href="{Yii::app()->request->baseUrl}/shopmanager/project/{$project->id}" class="no-decoration">
                        <span class="project-response">Ответить на запрос</span>
                    </a>
                    Всего ответов: {if $offersCount[$project->id]}{$offersCount[$project->id]->offersCount}{else}0{/if}
                {/if}
                {if $project->deleted=='yes'}<span style=" font-weight: bold">Заказ закрыт</span>{/if}
            </div>
        </div>