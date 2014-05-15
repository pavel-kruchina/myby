{extends file="layouts/public.tpl"}
{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/message.css" />
{/block}

{block name="content"}
    <a href="{Yii::app()->request->baseUrl}/public/conversation"><- Вернутся к списку</a> <br /> <br />
    Ваша переписка
    <div class="conversation-title">{$conversation->title}</div>
    <br />
    
    {foreach from=$messages item=message}
        {if $message->author_type=="user"}
            {include file="application.modules.public.views.conversation.message_user"}
        {else}
            {include file="application.modules.public.views.conversation.message_shop_user"}
        {/if}
    {/foreach}
    
    <hr />
    
    <div class="form">
        {form name="form" id='add-message' enableAjaxValidation=false}
            <div class="row">
                {$form->labelEx($addForm,'message', ['id'=>message])}
                {$form->textArea($addForm,'message')}
                {$form->error($addForm,'message')}
            </div>

            <div class="row buttons right-side">
                {CHtml::submitButton('Добавить', ['class'=>'button', 'id'=>'add-message'])}
            </div>

        {/form}
    </div>
{/block}