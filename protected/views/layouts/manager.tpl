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
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/shopmanager.css" />
    {block name="extraCSS"}{/block}
    <title>{CHtml::encode($this->pageTitle)}</title>
</head>

<body>
    {include file='layouts/blocks/metrics.tpl'}
<div class="container" id="page">

	<div id="header">
		<div id="logo"></div>
	</div><!-- header -->

	<div id="mainmenu">
		{$this->widget('zii.widgets.CMenu',[
			'items'=>[
				['label'=>'Список заказов', 'url'=>['/shopmanager/index']],
                ['label'=>'Мои предложения', 'url'=>['/shopmanager/myoffers']],
				['label'=>'Вход', 'url'=>['/shopmanager/login'], 'visible'=>Yii::app()->user->isGuest],
				['label'=>'Выход', 'url'=>['/shopmanager/logout'], 'visible'=>!Yii::app()->user->isGuest]
			]
		], true)} 
        
        {if !Yii::app()->user->isGuest}
            <div class="user-info">Вы вошли как {Yii::app()->user->getUserData()->name}</div>
        {/if}
	</div><!-- mainmenu -->
	<div class="main-content">
        {block name="content"}{/block}
    </div>
	<div class="clear"></div>

	<div id="footer">
        <a class="thisPage" target="_blank" href="{Yii::app()->request->baseUrl}/static/shop.pdf">Магазинам</a>
        | <a class="thisPage" style="color: #CC0000" target="_blank" href="{Yii::app()->request->baseUrl}/static/mail-filter.pdf">Совет</a>
        | © Сайт персональных покупок "MyBy" - 2014
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
