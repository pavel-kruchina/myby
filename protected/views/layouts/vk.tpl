<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/ie.css" media="screen, projection" />
	<![endif]-->
    
	<link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/main.css" />
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/project.css" />
	<link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/form.css" />
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/vk-project-offer.css" />
    
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/vk-mod.css" />
    {block name="extraCSS"}{/block}
    
     
    <script src="http://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script>
	
    <title>{CHtml::encode($this->pageTitle)}</title>
    
    <script src="{Yii::app()->request->baseUrl}/js/main.js" type="text/javascript"></script>
</head>

<body>
{include file='layouts/blocks/metrics.tpl'}    
<div class="container-vk" id="page">

	<div id="header">
		<div id="logo"></div>
        
        <div id="mainmenu">
            <ul>
                <li><a href="http://myby.com.ua/public" target="_top">Все заказы</a></li>
                <li><a href="http://myby.com.ua/public/mylist" target="_top">Мои заказы</a></li>
            </ul>
            <a href="http://myby.com.ua/public/add" target="_top"><div class="add-order-button">Добавить заказ</div></a>
        </div><!-- mainmenu -->
	</div><!-- header -->

	<div class="main-content-vk">
        {block name="content"}{/block}
    </div>
	<div class="clear"></div>

	<div id="footer">
		<a href="{Yii::app()->request->baseUrl}/vk/about">Как это работает</a> 
        | <a class="thisPage" target="_blank" href="{Yii::app()->request->baseUrl}/static/buyer.pdf">Покупателям</a>
        | <a class="thisPage" target="_blank" href="{Yii::app()->request->baseUrl}/static/shop.pdf">Магазинам</a>
        | <a class="thisPage" target="_blank" href="{Yii::app()->request->baseUrl}/static/agreement.pdf">Пользовательское соглашение</a> 
        | <a href="http://myby.com.ua/public/contacts" target="_top" >Контакты</a> 
        
	</div><!-- footer -->

</div><!-- page -->
<div class="loading hidden"></div>
<a target="_blank" class="thisPage" href="http://vk.com/myby4every1"><div id="askButton"></div></a>
</body>
</html>
