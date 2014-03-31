{extends file="layouts/manager.tpl"}

{block name="content"}
    <h2>Мои предложения</h2>
    <div id="projectsContainer">
        {foreach from=$projects.records item=project}
         {include file='shopmanager/blocks/projectShortView.tpl'}
        {/foreach}
    </div>
        
   <div id="projectsNavigation">
        {if $page}<a href="{Yii::app()->request->baseUrl}/shopmanager/index/{$page-1}"><div class="backward"></div></a>{/if}
        {foreach from=$pages.items item=p}
            {if $p.page===null}
                {$p.text}
            {else}
                <a href="{Yii::app()->request->baseUrl}/shopmanager/index/{$p.page}">{$p.text}</a>
            {/if}
        {/foreach}
        {if $page<$pages.count-1}<a href="{Yii::app()->request->baseUrl}/shopmanager/index/{$page+1}"><div class="forward"></div></a>{/if}
    </div>
{/block}