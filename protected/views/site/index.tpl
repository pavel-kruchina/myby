{extends file="layouts/mainClients.tpl"}

{block name="content"}
    {include file='site/blocks/add_project.tpl'}
    <h2>Список активных запросов</h2>
    Добавить свой запрос - <button OnClick='$("#mydialog").dialog("open"); return false;'>Добавить</button> <br /> <br />
    {foreach from=$projects item=project}
        <div class="project-container">
        <div class="project-title">{$project->title}</div>
        <div class="project-date">{$project->date}</div>
        <div class="project-describe">{$project->describe}</div>
    </div>
    {/foreach}
{/block}