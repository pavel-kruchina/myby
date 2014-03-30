{extends file="layouts/vk.tpl"}
{block name="extraCSS"}
    <link rel="stylesheet" type="text/css" href="{Yii::app()->request->baseUrl}/css/dialog.css" />
{/block}
{block name="content"}
    {if $add_project}
    {begin_widget name="zii.widgets.jui.CJuiDialog" id='mydialog' options=['title'=>'Благодарим вас!',
                                                                       'autoOpen' => true,
                                                                       'modal' => true,
                                                                       'resizable'=> false,
                                                                       'width' => 'auto']}
       <div class="dailog-content" style="text-align: center"> 
            
            Средний график работы менеджеров - с 10:00 до 18:00 по будням<br />
           
            Как только по Вашему заказу появятся предложения,<br /> 
            На Вашу страницу Вконтакте придет оповещение
       </div>
       <div class="dailog-footer" style="text-align: center"> 
            Все оповещения можно посмотреть, зайдя в меню<br /> 
            "Приложения" и выбрав вкладку "Оповещения"
       </div>
        
        <script>
            $('.ui-widget-overlay').live('click', function(){ $('.ui-dialog-titlebar-close').click(); });
        </script>
    {/begin_widget}
    {/if}
    
    <div class="h-background"><h1>Ваши заказы</h1></div>
    <div id="projectsContainer">
    {include file='application.modules.vk.views.blocks.projects'}
    </div>
    
    <div id="projectsNavigation">
        {if $page}<a href="{Yii::app()->request->baseUrl}/vk/mylist/{$page-1}"><div class="backward"></div></a>{/if}
        {foreach from=$pages.items item=p}
            {if $p.page===null}
                {$p.text}
            {else}
                <a href="{Yii::app()->request->baseUrl}/vk/mylist/{$p.page}">{$p.text}</a>
            {/if}
        {/foreach}
        {if $page<$pages.count-1}<a href="{Yii::app()->request->baseUrl}/vk/mylist/{$page+1}"><div class="forward"></div></a>{/if}
    </div>
    
    {include file='application.modules.vk.views.default.index-js'}
{/block}