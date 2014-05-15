    {include file='application.modules.public.views.add.add_js'}
    {include file='application.modules.public.views.add.reg_window'}
<div class="form" style="float: left">

    {form name="form" id='add-order-form' enableAjaxValidation=false action='/public/add'}
    
    <div class="row">
        {$form->labelEx($add,'title')}
        {$form->textField($add,'title', ['class'=>'addorder-margin-top', 'id'=>'title'])}
        {$form->error($add,'title')}
    </div>

    <div class="row">
        {$form->labelEx($add,'describe')}
        {$form->textArea($add,'describe', ['class'=>'height100 addorder-margin-top', 'id'=>'describe'])}
        {$form->error($add,'describe')}
    </div>

    <div class="row buttons">
        {CHtml::submitButton('Сделать заказ', ['class'=>'button', 'id'=>'submit-button'])}
    </div>

{/form} 
</div>
<div style="margin: 10px 0px 0px 10px; float: right; width: 500px; text-align: center">
<h2 style="margin-bottom: 2px">Сегодня за Ваш заказ борются</h2>
<img id="Image-Maps-Com-image-maps-2014-05-15-113150" src="/images/shop_logo.png" border="0" width="500" height="210" orgWidth="500" orgHeight="210" usemap="#image-maps-2014-05-15-113150" alt="" />
<map name="image-maps-2014-05-15-113150" id="ImageMapsCom-image-maps-2014-05-15-113150">
<area  alt="funbox" title="funbox" href="/public/shopuserabout/11" shape="rect" coords="8,7,131,78" style="outline:none;" target="_self"     />
<area  alt="Мир техники" title="Мир техники" href="/public/shopuserabout/9" shape="rect" coords="149,27,211,79" style="outline:none;" target="_self"     />
<area  alt="Техносайт" title="Техносайт" href="/public/shopuserabout/20" shape="rect" coords="222,39,378,70" style="outline:none;" target="_self"     />
<area  alt="5za" title="5za" href="/public/shopuserabout/12" shape="rect" coords="394,26,495,92" style="outline:none;" target="_self"     />
<area  alt="smart-shop" title="smart-shop" href="/public/shopuserabout/13" shape="rect" coords="14,86,192,128" style="outline:none;" target="_self"     />
<area  alt="itnet" title="itnet" href="/public/shopuserabout/10/" shape="rect" coords="217,79,325,153" style="outline:none;" target="_self"     />
<area  alt="Тех-ника" title="Тех-ника" href="/public/shopuserabout/8" shape="rect" coords="337,97,493,139" style="outline:none;" target="_self"     />
<area  alt="Товар24" title="Товар24" href="/public/shopuserabout/16" shape="rect" coords="17,160,168,200" style="outline:none;" target="_self"     />
<area  alt="Техник" title="Техник" href="/public/shopuserabout/14" shape="rect" coords="192,155,331,210" style="outline:none;" target="_self"     />
<area  alt="qwerty shop" title="qwerty shop" href="/public/shopuserabout/19" shape="rect" coords="357,164,485,203" style="outline:none;" target="_self"     />
</map>

</div>
<div class="clear"></div>
<div class="message">
<center>Заказ не обязывает Вас к покупке</center>
</div>