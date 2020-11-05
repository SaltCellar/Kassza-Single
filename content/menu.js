var button_logout;
var button_info;
var button_settings;

var button_menu_nyitas;
var button_menu_zaras;
var button_menu_adatok;

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

    button_menu_nyitas = $('#button_menu_nyitas');
    button_menu_zaras = $('#button_menu_zaras');
    button_menu_adatok = $('#button_menu_adatok');

    button_menu_nyitas.click(()=>{
        window.location.href = "?c=menu/nyitas";
    });

    button_menu_zaras.click(()=>{
        window.location.href = "?c=menu/zaras";
    });

    button_menu_adatok.click(()=>{
        window.location.href = "?c=menu/adatok";
    });

}


$(()=>{

    initDom();

});