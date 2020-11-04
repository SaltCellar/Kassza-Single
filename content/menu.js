var button_logout;
var button_info;
var button_settings;

function initDom() {

    button_logout = $('#button_logout');
    button_info = $('#button_info');
    button_settings = $('#button_settings');

    button_logout.click(()=>{
        executeAjax((data)=>{
            if(data.status) location.reload();
        },'logout');
    });

    button_settings.click(()=>{
        window.location.href = "?c=settings";
    });

    button_info.click(()=>{
        window.location.href = "?c=info";
    });

}


$(()=>{

    initDom();

});