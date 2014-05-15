{extends file="layouts/public.tpl"}

{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/add_order.css" />
{/block}

{block name="content"}
    <div class="h-background"><h1>Что Вы хотите купить?</h1></div>
    {include file='application.modules.public.views.add.add_form'}
{/block}