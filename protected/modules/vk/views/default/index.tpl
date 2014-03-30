{extends file="layouts/vk.tpl"}

{block name="content"}
    <div class="h-background"><h1>Список активных заказов</h1></div>
    <div id="projectsContainer">
    {include file='application.modules.vk.views.blocks.projects'}
    </div>
    
    <div id="projectsNavigation">
        {if $page}<a href="{Yii::app()->request->baseUrl}/vk/index/{$page-1}"><div class="backward"></div></a>{/if}
        {foreach from=$pages.items item=p}
            {if $p.page===null}
                {$p.text}
            {else}
                <a href="{Yii::app()->request->baseUrl}/vk/index/{$p.page}">{$p.text}</a>
            {/if}
        {/foreach}
        {if $page<$pages.count-1}<a href="{Yii::app()->request->baseUrl}/vk/index/{$page+1}"><div class="forward"></div></a>{/if}
    </div>
    
    {include file='application.modules.vk.views.default.index-js'}
{/block}