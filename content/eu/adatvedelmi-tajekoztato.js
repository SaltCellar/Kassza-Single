var button_back;

function initDom() {

    button_back = $('#button_back');

    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

}


$(()=>{

    initDom();

});