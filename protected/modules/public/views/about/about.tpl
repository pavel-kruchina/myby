{extends file="layouts/public.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/about.css" />
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/add_order.css" />
{/block}

{block name="content"}
<div class="message" style="text-align: center"> 
<h2>Что такое MyBy</h2>
Скажите нам, что Вы хотите купить, и менеджеры разных магазинов<br /> подберут для Вас персональные предложения на самых выгодных условиях
</div>
    
    <div class="h-background"><h1>Как это работает</h1></div>
    <div class="how"></div>
    
<div class="h-background"><h1>Оставить заказ</h1></div>
    {include file='application.modules.public.views.add.add_form'}
{/block}