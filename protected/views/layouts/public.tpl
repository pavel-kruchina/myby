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
    
    {block name="extraCSS"}{/block}
    
     
    <script src="http://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script>
	
    <title>{CHtml::encode($this->pageTitle)}</title>
    
    <script src="{Yii::app()->request->baseUrl}/js/main.js" type="text/javascript"></script>
</head>

<body>
{include file='layouts/blocks/metrics.tpl'}    
<div class="container" id="page">

	<div id="header">
		<a href="{Yii::app()->request->baseUrl}/public/about"><div id="logo"></div></a>
        
        <div id="mainmenu">
            {$this->widget('zii.widgets.CMenu',[
                'items'=>[
                    ['label'=>'Мои заказы', 'url'=>['/public/mylist']],
                    ['label'=>'Моя переписка', 'url'=>['/public/conversation'], 'linkOptions'=>['id'=>'menu-messages']],
                    ['label'=>'Все заказы', 'url'=>['/public/index']],
                    ['label'=>'Вход', 'url'=>['/public/login'], 'visible'=>Yii::app()->user->isGuest]
                ]
            ], true)}
            
            {if Conversation::isUnreadConversationForUserId(Yii::app()->user->getId())}
            <script>$('#menu-messages').addClass('new-messages')</script>
            {/if}
            
            <a href="{Yii::app()->request->baseUrl}/public/add"><div class="add-order-button">Добавить заказ</div></a>
        </div><!-- mainmenu -->
	</div><!-- header -->

	<div class="main-content">
        {block name="content"}{/block}
    </div>
	<div class="clear"></div>

	<div id="footer">
		<a href="{Yii::app()->request->baseUrl}/public/about">Как это работает</a> 
        | <a class="thisPage" target="_blank" href="{Yii::app()->request->baseUrl}/static/agreement.pdf">Пользовательское соглашение</a> 
        | <a href="{Yii::app()->request->baseUrl}/public/contacts">Контакты</a> 
        
	</div><!-- footer -->

</div><!-- page -->
<div class="loading hidden"></div>
<div class="right-area">
    <a target="_blank" class="thisPage" href="http://vk.com/myby4every1"><div id="askButton"></div></a>
    <script type="text/javascript" src="//yandex.st/share/share.js"
    charset="utf-8"></script>
    <div class="likes-area yashare-auto-init" data-yashareL10n="ru"
     data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus" data-yashareTheme="counter">
    </div> 
</div>
</body>
</html>
