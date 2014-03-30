{begin_widget name="zii.widgets.jui.CJuiDialog" id='showContacts' options=['title'=>'Отправить контакты',
                                                                       'autoOpen' => false,
                                                                       'modal' => true,
                                                                       'resizable'=> false,
                                                                       'width' => '300px']}
        
                                                                       
<div class="form showContactsForm">

    {form name="form" id='add-order-form' enableAjaxValidation=false}
    {$form->errorSummary($showContactsForm)}
    <input type=hidden name='models_forms_ShowContactsForm[manager_id]' value=0 id='showContactsManagerId'>
    <input type=hidden name='models_forms_ShowContactsForm[project_id]' value={$project->id}>
    <div class="row">
        {$form->labelEx($showContactsForm,'phone')}
        {$form->textField($showContactsForm,'phone', ['class'=>'textfield', 'id'=>'phone'])}
        {$form->error($showContactsForm,'phone')}
    </div>
    
    <div class="row">
        {$form->labelEx($showContactsForm,'email')}
        {$form->textField($showContactsForm,'email', ['class'=>'textfield', 'id'=>'email'])}
        {$form->error($showContactsForm,'email')}
    </div>

    <div class="row">
        {$form->labelEx($showContactsForm,'comment')}
        {$form->textArea($showContactsForm,'comment', ['class'=>'textarea', 'id'=>'comment'])}
        {$form->error($showContactsForm,'comment')}
    </div>

    <div class="row buttons">
        {CHtml::ajaxSubmitButton('Отправить', '/vk/ajaxShowContacts', ['type' => 'POST', 'complete' => 'pageObject.showContactsResult'],['id'=>'showContactsSubmit'])}
    </div>

{/form} 
</div>                                                                       
                                                                       
{/begin_widget} 
