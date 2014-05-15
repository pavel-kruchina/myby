<script>
var pageObject = {
    createConversationResult: function(data) {
        $('.ui-dialog-titlebar-close').click();
        data = JSON.parse(data);
        
        if (!data.is_error) {
            window.location = '/' + data.url;
        }
    },
    
    showOpenConversationDialog:function(offer_id){
        $('#ccf_offer_id').val(offer_id);
        $("#createConversation").dialog("open");
    },
};

</script>