{extends file="layouts/vk.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/add_order.css" />
{/block}

{block name="content"}
    {include file='application.modules.vk.views.add.add_js'}
    
    <div class="h-background"><h1>Что Вы хотите купить?</h1></div>
<div class="message">
<center>Заказ не обязывает Вас к покупке</center>
</div>
<div class="form">

    {form name="form" id='add-order-form' enableAjaxValidation=false}
    
    <div class="row">
        {$form->labelEx($add,'title')}
        {$form->textField($add,'title', ['class'=>'addorder-margin-top', 'id'=>'title'])}
        {$form->error($add,'title')}
    </div>

    <div class="row">
        {$form->labelEx($add,'describe')}
        {$form->textArea($add,'describe', ['class'=>'height100 addorder-margin-top', 'id'=>'describe'])}
        {$form->error($add,'describe')}
    </div>

    <div class="row buttons">
        {CHtml::submitButton('Сделать заказ', ['class'=>'button', 'id'=>'submit-button'])}
    </div>

{/form} 
</div>

{/block}