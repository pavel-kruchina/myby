{if Yii::app()->user->isGuest}
    {begin_widget name="zii.widgets.jui.CJuiDialog" id='mydialog' options=['title'=>'Вы у нас впервые?',
                                                                       'autoOpen' => false,
                                                                       'modal' => true,
                                                                       'resizable'=> false,
                                                                       'width' => '550px']}
       <div class="dailog-content"> 
            
            Пожалуйста, укажите свои данные, чтобы вы могли получать сообщения о предложениях по вашему заказу. <br /><br />
            <div class="form">

            {form name="form" id='register-form' enableAjaxValidation=false}

                <div class="row">
                    {$form->labelEx($regform,'name', ['id'=>reg_name])}
                    {$form->textField($regform,'name')}
                    {$form->error($regform,'name')}
                </div>
                
                <div class="row">
                    {$form->labelEx($regform,'sname', ['id'=>reg_sname])}
                    {$form->textField($regform,'sname')}
                    {$form->error($regform,'sname')}
                </div>
                
                <div class="row">
                    {$form->labelEx($regform,'mail', ['id'=>reg_mail])}
                    {$form->textField($regform,'mail')}
                    {$form->error($regform,'mail')}
                </div>

                <div class="row">
                    {$form->labelEx($regform,'password', ['id'=>reg_password])}
                    {$form->passwordField($regform,'password')}
                    {$form->error($regform,'password')}
                </div>

                <div class="row buttons right-side">
                    {CHtml::ajaxSubmitButton('Подтвердить данные', '/public/reg', ['type'=>"POST", 'success'=>'regSuccess'], ['class'=>'button', 'id'=>'reg-button'])}
                </div>
                Уже были у нас? Нажмите <a href="#" class="thisPage" onClick="showLogin(); return false;">сюда</a>
            {/form}
            
            {form name="form" id='login-form' enableAjaxValidation=false htmlOptions=['style'=>'display: none'] }

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
                    {CHtml::ajaxSubmitButton('Вход', '/public/login/ajaxlogin', ['type'=>"POST", 'success'=>'loginSuccess'], ['class'=>'button', 'id'=>'login-button'])}
                </div>
                  Впервые у нас? Нажмите <a href="#" class="thisPage" onClick="showReg(); return false;">сюда</a>
            {/form}
        </div>
            
       </div> 
    {/begin_widget}
        
    <script>
        needRegister = 1;
    </script>
{/if}