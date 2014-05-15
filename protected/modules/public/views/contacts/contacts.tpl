{extends file="layouts/public.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/contacts.css" />
{/block}

{block name="content"}
    <div class="h-background"><h1>Контакты</h1></div>

<div style="float: right">
<script type="text/javascript" src="//vk.com/js/api/openapi.js?112"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", { mode: 0, width: "380", height: "280", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 68679398);
</script>
</div>

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