<script>
var pageObject = {
    showContactsResult: function(XMLHttpRequest, textStatus, errorThrown) {
        $('.ui-dialog-titlebar-close').click();
        $('#showContacts'+manager_id).html('[контакты отправленны]');
        alert('Ваши контакты отправленны, и в ближайшее время менеджер с вами свяжется');
    },
    
    showOpenContactsDialog:function(manager_id){
        $('#showContactsManagerId').val(manager_id);
        $("#showContacts").dialog("open");
    },
    
    showAnswerForm: function(offer_id) {
        $('#offerBox'+offer_id+' div.addComment').append($('#addCommentForm'));
        $('#offer_id').val(offer_id);
        $('#addCommentForm').show();
        $('.addCommentLink').show();
        $('#addCommentLink'+offer_id).hide();
    }
};

</script>