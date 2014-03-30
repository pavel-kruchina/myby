function ajax(url, data, callback) {
    startAjax()
    $.ajax({'url':url, 'data':data, 'dataType':'json', cache:false, 
        success:
                function(requestResult){callback(requestResult, data); finishAjax();} 
    });
}

function startAjax() {
    $('.loading').removeClass('hidden');
}

function finishAjax() {
    $('.loading').addClass('hidden');
}

function showLoading() {
    /*if (this.classList.contains('thisPage'))
        return false;
    */
    $('.loading').removeClass('hidden');
}

$('document').ready(function(){$('a:not(.thisPage):not(.ui-dialog-titlebar-close)').live('click', showLoading); });