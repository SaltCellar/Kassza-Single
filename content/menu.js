var button_logout;
var button_settings;

function initDom() {

    button_logout = $('#button_logout');
    button_settings = $('#button_settings');

    button_logout.click(()=>{
        executeAjax((data)=>{
            if(data.status) location.reload();
        },'logout');
    });

    button_settings.click(()=>{
        window.location.href = "?c=settings";
    });

}


$(()=>{

    initDom();

});