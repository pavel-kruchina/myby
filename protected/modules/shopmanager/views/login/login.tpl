{extends file="layouts/manager.tpl"}

{block name="content"}
    <h2>Вход</h2>
    <div class="form">

        {form name="form" id='login-form' enableAjaxValidation=false}
        {$form->errorSummary($loginForm)}

        <div class="row">
            {$form->labelEx($loginForm,'mail')}
            {$form->textField($loginForm,'mail', ['class'=>'textfield', 'id'=>'mail'])}
            {$form->error($loginForm,'mail')}
        </div>

        <div class="row">
            {$form->labelEx($loginForm,'password')}
            {$form->passwordField($loginForm,'password', ['class'=>'textfield', 'id'=>'describe'])}
            {$form->error($loginForm,'password')}
        </div>

        <div class="row buttons">
            {CHtml::submitButton('Вход', ['id'=>'submit-button'])}
        </div>

    {/form} 
    </div>
    
    
{/block}