<script>
    var formLocator = "#add-order-form";
    var titleLocator = '#title';
    var describeLocator = '#describe';
    var titleEdited = 0;
    var describeEdited = 0;
    var needRegister = 0;
    
    $('document').ready(initTitle);
    $('document').ready(initDescribe);
    $('document').ready(function() { 
        $('#add-order-form').submit(checkForm);
    });
    
    function initTitle() {
        if ($(titleLocator).val()) {
            titleEdited = 1;
            return;
        }
        
        $(titleLocator).css('color', '#999');
        $(titleLocator).focus(clearValueTitle);
        $(titleLocator).val('{$landing.titleExample}');
    }
    
    function initDescribe() {
        if ($(describeLocator).val()) {
            describeEdited = 1;
            return;
        }
        
        $(describeLocator).css('color', '#999');
        $(describeLocator).focus(clearValue);
        $(describeLocator).val('{$landing.textExample}');
    }
    
    function clearValueTitle() {
        titleEdited = 1;
        
        this.value = '';
        this.style.color = 'black';
        $('#'+this.id).unbind('focus');
    }
    
    function clearValue() {
        describeEdited = 1;
        
        this.value = '';
        this.style.color = 'black';
        $('#'+this.id).unbind('focus');
        
    }
    
    function checkForm() {
    
        if (!titleEdited) {
            alert('Введите заголовок');
            return false;
        }
        
        if (!describeEdited) {
            alert('Введите описание');
        
            return false;
        }
        
        if (needRegister){
            $("#mydialog").dialog("open");
            return false;
        }
        
        $("#submit-button").prop('disabled', true);
        
        return true;
    }
    
    function regSuccess(data) {
        data = JSON.parse(data);
        if (data.is_error) {
            showErrors(data.errors);
            if (data.mailExists)
                alert('Пользователь с такой почтой уже существует. Просто войдите со своим паролем');
            
            return false;
        }
        
        needRegister = 0;
        $(formLocator).submit();
    }
    
    function loginSuccess(data) {
        data = JSON.parse(data);
        if (data.is_error) {
            showLoginErrors(data.errors);
            return false;
        }
        
        needRegister = 0;
        $(formLocator).submit();
    }
    
    function showLoginErrors() {
        alert('Неверный email или пароль');
    }
    
    function showErrors(errors) {
        $('#register-form label').removeClass('error');
            $.each(errors, function(key, val){
                $('#reg_'+key).addClass('error');
            });
    }
    
    function showLogin() {
        $('#register-form').hide();
        $('#login-form').show();
    }
    
    function showReg() {
        $('#register-form').show();
        $('#login-form').hide();
    }
    
</script>