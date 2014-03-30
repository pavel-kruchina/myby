{extends file="layouts/vk.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/contacts.css" />
{/block}

{block name="content"}
    <div class="h-background"><h1>Контакты</h1></div>
{if $message}<div class='message'>{$message}</div>{/if}
<div class="form contactsForm">

    {form name="form" id='add-order-form' enableAjaxValidation=false}
    {$form->errorSummary($contactsForm)}

    <div class="row">
        {$form->labelEx($contactsForm,'mail', ['class'=>'width100'])}
        {$form->textField($contactsForm,'mail', ['class'=>'textfield', 'id'=>'mail'])}
        {$form->error($contactsForm,'mail')}
    </div>

    <div class="row">
        {$form->labelEx($contactsForm,'text', ['class'=>'width100'])}
        {$form->textArea($contactsForm,'text', ['class'=>'textarea height100', 'id'=>'text'])}
        {$form->error($contactsForm,'text')}
    </div>

    <div class="row buttons">
        {CHtml::label('&nbsp;', false, ['class'=>'width100'])}
        {CHtml::submitButton('Отправить', ['class'=>'button', 'id'=>'submit-button'])}
    </div>

{/form} 
</div>
{/block}