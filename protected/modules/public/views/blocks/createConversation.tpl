{begin_widget name="zii.widgets.jui.CJuiDialog" id='createConversation' options=['title'=>'Ответить',
                                                                       'autoOpen' => false,
                                                                       'modal' => true,
                                                                       'resizable'=> false,
                                                                       'width' => '350px']}
        
                                                                       
<div class="form createConversationForm">

    {form name="form" id='create-conversation-form' enableAjaxValidation=false}
        {$form->hiddenField($createConversationForm,'offer_id', ['id'=>'ccf_offer_id'])}
        <div class="row">
            {$form->labelEx($createConversationForm,'message')}
            {$form->textArea($createConversationForm,'message', ['class'=>'textarea', 'id'=>'message'])}
            {$form->error($createConversationForm,'message')}
        </div>

        <div class="row buttons">
            {CHtml::ajaxSubmitButton('Отправить', '/public/conversation/create', ['type' => 'POST', 'success' => 'pageObject.createConversationResult'],['id'=>'showContactsSubmit'])}
        </div>

    {/form} 
</div>                                                                       
                                                                       
{/begin_widget} 
