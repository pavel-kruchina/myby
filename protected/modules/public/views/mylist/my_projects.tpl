{extends file="layouts/public.tpl"}
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
            
            Средний график работы менеджеров - с 10:00 до 18:00 по будням.<br />
           
            Как только по Вашему заказу появятся предложения,<br /> 
            Вы получите оповещение на почту, указанную при регистрации
       </div>
       
        
        <script>
            $('.ui-widget-overlay').live('click', function(){ $('.ui-dialog-titlebar-close').click(); });
        </script>
    {/begin_widget}
    {/if}
    
    <div class="h-background"><h1>Ваши заказы</h1></div>
    <div id="projectsContainer">
    {include file='application.modules.public.views.blocks.projects'}
    </div>
    
    <div id="projectsNavigation">
        {if $page}<a href="{Yii::app()->request->baseUrl}/public/mylist/{$page-1}"><div class="backward"></div></a>{/if}
        {foreach from=$pages.items item=p}
            {if $p.page===null}
                {$p.text}
            {else}
                <a href="{Yii::app()->request->baseUrl}/public/mylist/{$p.page}">{$p.text}</a>
            {/if}
        {/foreach}
        {if $page<$pages.count-1}<a href="{Yii::app()->request->baseUrl}/public/mylist/{$page+1}"><div class="forward"></div></a>{/if}
    </div>
    
    {include file='application.modules.public.views.default.index-js'}
{/block}