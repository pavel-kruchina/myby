{extends file="layouts/public.tpl"}

{block name="content"}
    {include file='application.modules.public.views.blocks.createConversation'}
    {include file='application.modules.public.views.project.project-js'}
    
     <div class="project-container no-limits">
        <div class="project-title">{$project->title}</div>
        <div class="project-date">{$project->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
        <div class="project-describe no-limits">{$project->describe}</div>
        
        <div  class="project-author">От пользователя: <b>{$author->name} {$author->sname}</b> 
        {if $author->id == Yii::app()->user->getId() && $project->deleted=='no'}
            <a class="thisPage" style="float: right" href="{Yii::app()->request->baseUrl}/public/project/{$project->id}/?delete=1" onclick="return confirm('Вы точно хотите закрыть этот заказ?')">Закрыть заказ</a>
        {/if}
        {if $project->deleted=='yes'}<span style="float: right; font-weight: bold">Заказ закрыт</span>{/if}
        </div>
        
     </div>
        
    {foreach from=$offers item=offer}
        <div class="offer-box" id='offerBox{$offer->id}'>
            <div class="offer-head">
                <div class="offer-date">{$offer->date}</div>
                <div class="offer-shop-user-name">
                    <b>{$shopUsers[$offer->shop_user_id]->name}</b> 
                    <a href="{Yii::app()->request->baseUrl}/public/shopuserabout/{$shopUsers[$offer->shop_user_id]->id}" class="no-decoration">
                        <nobr>[О продавце]</nobr>
                    </a>
                </div>
            </div>
            <div class="offer-text">
                {$offer->text}
            </div>
            
            {if yii::app()->user->getId() == $author->id}
                <a id='addCommentLink{$offer->id}' class="addCommentLink no-decoration thisPage" href="" OnClick='pageObject.showOpenConversationDialog({$offer->id}); return false;'>
                    Ответить
                </a>
            {/if}
        </div>    
    {/foreach}
    
{/block}