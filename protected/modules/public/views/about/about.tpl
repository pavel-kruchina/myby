{extends file="layouts/public.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/about.css" />
{/block}

{block name="content"}
<div class="message" style="text-align: center"> 
<h2>Что такое MyBy</h2>
Скажите нам, что Вы хотите купить, и менеджеры разных магазинов<br /> подберут для Вас персональные предложения на самых выгодных условиях
</div>
    
    <div class="h-background"><h1>Как это работает</h1></div>
    <div class="how"><a  href="{Yii::app()->request->baseUrl}/public/add" ><button class="button" style="margin-left: 215px;  margin-top: 190px;">Оставить заказ</button></a></div>
    
<div class="message">
<center>Заказ не обязывает Вас к покупке</center>
</div>
{/block}