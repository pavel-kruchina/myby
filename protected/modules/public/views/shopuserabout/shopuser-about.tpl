{extends file="layouts/public.tpl"}

{block name="extraCSS"}
        <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/vk-shopuser-about.css" />
{/block}

{block name="content"}
    <a href="javascript:history.go(-1)">Назад</a>
    <h2>{$shopuser->name}</h2>
    <p>Менеджер: <b>{$shopuser->manager_name}</b></p>
    <p>Телефон: <b>{$shopuser->phone}</b></p>
    <p>Почта: <b>{$shopuser->showed_mail}</b></p>
    <p>Сайт: <b><a href='{$shopuser->site_url}' class="thisPage" target="_blank">{$shopuser->site_name}</a></b></p>
    {$shopuser->describe}
{/block}