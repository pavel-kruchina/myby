{extends file="layouts/vk.tpl"}

{block name="content"}
    {include file='application.modules.vk.views.blocks.showContacts'}
    {include file='application.modules.vk.views.project.project-js'}
    
     <div class="project-container no-limits">
        <div class="project-title">{$project->title}</div>
        <div class="project-date">{$project->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
        <div class="project-describe no-limits">{$project->describe}</div>
        <div class="project-author">От пользователя: <b>{$author->name} {$author->sname}</b></div>
     </div>
        
    {foreach from=$offers item=offer}
        <div class="offer-box" id='offerBox{$offer->id}'>
            <div class="offer-head">
                <div class="offer-date">{$offer->date}</div>
                <div class="offer-shop-user-name">
                    <b>{$shopUsers[$offer->shop_user_id]->name}</b> 
                    <a href="{Yii::app()->request->baseUrl}/vk/shopuserabout/{$shopUsers[$offer->shop_user_id]->id}" class="no-decoration">
                        <nobr>[О продавце]</nobr>
                    </a>
                        {if !$showedContacts[$offer->shop_user_id]}
                        <span id="showContacts{$offer->shop_user_id}"><a OnClick='pageObject.showOpenContactsDialog({$offer->shop_user_id}); return false;' href="#" class="no-decoration thisPage" title='Отправте контакты, чтоб продавец мог связаться с вами'>
                        <nobr>[Отправить контакты]</nobr></span>
                        {else}
                            [контакты отправленны]
                        {/if}
                    </a>
                        
                </div>
            </div>
            <div class="offer-text">
                {$offer->text}
            </div>
            
            {foreach from=$comments[$offer->id] item=comment}
                <div class="comment-box" id='commentBox{$comment->id}'>
                    <div class="comment-head">
                        <div class="comment-date">{$comment->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
                        <div class="comment-user-name">
                            <b>{$author->name} {$author->sname}</b> 
                        </div>
                    </div>
                    <div class="offer-text">
                        {$comment->text}
                    </div>
                </div>    
            {/foreach}
            
            {if yii::app()->user->getId() == $author->id}
                <a id='addCommentLink{$offer->id}' class="addCommentLink no-decoration thisPage" href="" onClick="pageObject.showAnswerForm({$offer->id}); return false;">
                    Ответить
                </a>
                <div class="addComment"></div>
            {/if}
        </div>    
    {/foreach}
    
    <div id='addCommentForm' style='display: none' class='form hideRequired'>
        {form name="form" id='add-comment-form' enableAjaxValidation=false}
        {$form->errorSummary($addCommentForm)}
        {$form->hiddenField($addCommentForm,'offer_id', ['class'=>'', 'id'=>'offer_id'])}
        
        <div class="row">
            {$form->textArea($addCommentForm,'text', ['class'=>'addorder-margin-top', 'id'=>'text'])}
        </div>

        <div class="row buttons">
            {CHtml::submitButton('Оставить комментарий', ['class'=>'button', 'id'=>'submit-button'])}
        </div>
        {/form}
    </div>
{/block}