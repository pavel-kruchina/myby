{extends file="layouts/vk.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/about.css" />
{/block}

{block name="content"}
<div class="message">
<h2>Мы открылись!</h2>
Теперь мы принимаем заказы на <a target="_top" href="http://myby.com.ua">myby.com.ua</a>
</div>
    
    <div class="h-background"><h1>Как это работает</h1></div>
    <div class="how"></div>
    <a  href="http://myby.com.ua/public/add" target="_top" ><button class="button" style="margin-left: 210px; margin-top: 10px;">Оставить заказ</button></a>
<div class="message">
<center>Заказ не обязывает Вас к покупке</center>
</div>
{/block}