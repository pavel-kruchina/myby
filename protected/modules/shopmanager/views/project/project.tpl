{extends file="layouts/manager.tpl"}

{block name="content"}
     <div class="project-container">
        <div class="project-title">{$project->title}</div>
        <div class="project-date">{$project->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
        <div class="project-describe">{$project->describe}</div>
        <div class="project-author">От пользователя: <b>{$author->name} {$author->sname}</b></div>
     </div>
     {if $project->deleted=='yes'}<span style=" font-weight: bold">Заказ закрыт</span>{/if}
     {if $openUsers}
     <div class="showedContacts">
         <h2>Пользователи, с которыми нужно связаться</h2>
         {foreach from=$showedContacts item=contact}
             {include file='application.modules.shopmanager.views.blocks.client'}
         {/foreach}
     </div>
     {/if}
     
    <div class="form add-offer-form">

        {form name="form" id='add-order-form' enableAjaxValidation=false}
            {$form->errorSummary($add)}

            <div class="row">
                {$form->labelEx($add,'offer')}
                {$form->textArea($add,'offer', ['class'=>'textarea', 'id'=>'offer'])}
                {$form->error($add,'offer')}
            </div>

            <div class="row buttons">
                {CHtml::submitButton('Сделать предложение', ['id'=>'submit-button'])}
            </div>

        {/form} 
    </div>
        
    {foreach from=$offers item=offer}
        <div class="offer-box">
            <div class="offer-head">
                <div class="offer-date">{$offer->date}</div>
                <div class="offer-shop-user-name">{$shopUsers[$offer->shop_user_id]->name}</div>
            </div>
            <div class="offer-text">
                {$offer->text}
            </div>
            
            {foreach from=$comments[$offer->id] item=comment}
                <div class="comment-box">
                    <div class="comment-head">
                        <div class="comment-date">{$comment->date|date_format:"%H:%M:%S %d.%m.%Y"}</div>
                        <div class="comment-user-name">{$author->name} {$author->sname}</div>
                    </div>
                    <div class="comment-text">
                        {$comment->text}
                    </div>
                </div>    
            {/foreach}
            
        </div>    
    {/foreach}
{/block}