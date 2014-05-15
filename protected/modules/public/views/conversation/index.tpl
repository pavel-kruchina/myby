{extends file="layouts/public.tpl"}
{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/message.css" />
{/block}
{block name="content"}
    <div class="h-background"><h1>Ваша переписка</h1></div>
    <div id="conversationContainer">
    {foreach from=$conversations.records item=conversation}
        {include file='application.modules.public.views.conversation.conversation'}
    {/foreach}
    </div>
    
    <div id="projectsNavigation">
        {if $page}<a href="{Yii::app()->request->baseUrl}/public/conversation/{$page-1}"><div class="backward"></div></a>{/if}
        {foreach from=$pages.items item=p}
            {if $p.page===null}
                {$p.text}
            {else}
                <a href="{Yii::app()->request->baseUrl}/public/conversation/{$p.page}">{$p.text}</a>
            {/if}
        {/foreach}
        {if $page<$pages.count-1}<a href="{Yii::app()->request->baseUrl}/public/conversation/{$page+1}"><div class="forward"></div></a>{/if}
    </div>
    
{/block}