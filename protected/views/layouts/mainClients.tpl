<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	{block name="extraCSS"}{/block}
	<title>{CHtml::encode($this->pageTitle)}</title>
</head>

<body style="overflow: hidden; background-color: #e2e1df; font-family: Calibri">
{include file='layouts/blocks/metrics.tpl'}
<div style="width: 0px; height: 0px;">    
<img id="backgroundImg" src="{Yii::app()->request->baseUrl}/images/photo.jpg" style="" OnLoad="imageResize()"/>
</div>

<div style="text-align: center; font-size: 24pt; color: black; padding-top: 22px; ">
        Добро пожаловать на сайт <br />персональных покупок MyBy
</div>

<a href="http://vk.com/app3916083_226178909">
    <div style="cursor: pointer; position: absolute; top: 15px; left: 20px; height: 72px; padding-left: 70px; background: url('{Yii::app()->request->baseUrl}/images/vk-logo.png') top left no-repeat"> 
    </div>
</a>

<div style="position: absolute; top: 92px; left: 55px; height: 33px; padding-left: 76px; background: url('{Yii::app()->request->baseUrl}/images/enter.png') top left no-repeat"> 
</div>

<div style="position: absolute; top: 15px; right: 15px; height: 33px; width: 160px;">
    <a href="{Yii::app()->request->baseUrl}/shopmanager" style="color: black; font-size: 18px;">
        Вход для магазинов
    </a>
</div>

<div style="position: absolute; bottom: 80px; width: 100%;">
    <div style="margin: auto; width: 450px; font-size: 18pt; padding-right: 80px; text-align: right;">
        {if $mailSaved}
            Спасибо за подписку, мы будем держать вас в курсе событий.
        {else}
    
            <span>Подпишитесь на нас, и скоро вы измените<br> свое представление об онлайн шоппинге</span>
            <form style="margin-top: 10px;" method="POST">
                <input name='mail' onFocus="this.value='';" style="height: 20px; margin: 0px; padding: 0px 10px 0px 10px; width: 300px; border: 1px solid #161616;" value="Введите ваш e-mail"/><input style="height: 22px; margin: 0px; padding: 0px 5px 0px 5px;  border: 1px solid #161616;" type="submit" value="Подписаться"  name='mailSubmit' />
            </form>
        {/if}
    </div>
    
</div>

<div style="position: absolute; bottom: 20px; left: 55px; font-size: 18px"> 
    * На данный момент мы работаем только через Вконтакте
</div>    
    
<script>

var img_w = 0;
var img_h = 0;
    
function imageResize() {
    var doc_w = $(window).width();
    var doc_h = $(window).height();
    
    if (!img_w) {
        img_w = $('#backgroundImg').width();
        img_h = $('#backgroundImg').height();
    }
    
    if ((doc_w/doc_h)>(img_w/img_h)) {
        $('#backgroundImg').height(doc_h);
        $('#backgroundImg').width(Math.round(doc_h*img_w/img_h));
    } else {
        $('#backgroundImg').width(doc_w);
        $('#backgroundImg').height(Math.round(doc_w/img_w*img_h));
    }
    
    $('#backgroundImg').css('margin-left', Math.round((doc_w - $('#backgroundImg').width())/2)+'px');
    $('#backgroundImg').css('margin-top', Math.round((doc_h - $('#backgroundImg').height())/2)+'px');
    
}

window.onresize = imageResize;
</script>
</body>
</html>
