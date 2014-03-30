{extends file="layouts/vk.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/about.css" />
{/block}

{block name="content"}
<div class="message">
<h2>Что такое MyBy</h2>
Скажите нам, что Вы хотите купить, и менеджеры разных магазинов подберут для Вас персональные предложения на самых выгодных условиях
</div>
    
    <div class="h-background"><h1>Как это работает</h1></div>
    <div class="how"></div>
    <a  href="{Yii::app()->request->baseUrl}/vk/add" ><button class="button" style="margin-left: 210px; margin-top: 10px;">Оставить заказ</button></a>
<div class="message">
<center>Заказ не обязывает Вас к покупке</center>
</div>
{/block}