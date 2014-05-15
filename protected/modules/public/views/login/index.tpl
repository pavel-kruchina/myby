{extends file="layouts/public.tpl"}

{block name="content"}
    Введите свою почту и пароль
    <div class="form">
        {form name="form" id='login-form' enableAjaxValidation=false}

                <div class="row">
                    {$form->labelEx($loginForm,'mail')}
                    {$form->textField($loginForm,'mail')}
                    {$form->error($loginForm,'mail')}
                </div>

                <div class="row">
                    {$form->labelEx($loginForm,'password')}
                    {$form->passwordField($loginForm,'password')}
                    {$form->error($loginForm,'password')}
                </div>

                <div class="row buttons right-side">
                    {CHtml::submitButton('Вход', ['class'=>'button', 'id'=>'login-button'])}
                </div>

        {/form}
    </div>
{/block}