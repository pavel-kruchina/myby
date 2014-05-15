<script>
var pageObject = {
    loadOrderUrl: '{Yii::app()->request->baseUrl}/vk/AjaxProjectsPageLoad',
    
    
    loadOrdersPortion: function(page) {
        ajax(this.loadOrderUrl, { 'page':page }, this.showOrders);
    },
    
    showOrders: function(result, data) {
        $('#projectsContainer').html(result.html);
        pageObject.setNavigation(data.page);
    },
    
    setNavigation: function(page) {
        pageObject.checkPrevNavigation(page);
        
        $('prev').unbind('click');
        $('#next').unbind('click');
        
        $('#prev').bind('click', function(){ pageObject.loadOrdersPortion(page-1) });
        $('#next').bind('click', function(){ pageObject.loadOrdersPortion(page+1) });
    },
    
    checkPrevNavigation: function(page) {
        if(page>0) {
            $('#prev').removeClass('hidden');
        }   else {
            $('#prev').addClass('hidden');
        }
    },
    
    onLoad: function() {
        pageObject.setNavigation(0);
    }
};
</script>