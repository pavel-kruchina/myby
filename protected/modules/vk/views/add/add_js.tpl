<script>
    var titleLocator = '#title';
    var describeLocator = '#describe';
    var titleEdited = 0;
    var describeEdited = 0;
    
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
        $(titleLocator).val('Например: фильтр под мойку до 1600 грн');
    }
    
    function initDescribe() {
        if ($(describeLocator).val()) {
            describeEdited = 1;
            return;
        }
        
        $(describeLocator).css('color', '#999');
        $(describeLocator).focus(clearValue);
        $(describeLocator).val('Например: 2 взрослых, один ребенок. Вода должна быть прежде всего безопасной. Фильтр нужен на завтра');
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
        
        $("#submit-button").prop('disabled', true);
        
        return true;
    }
    
</script>