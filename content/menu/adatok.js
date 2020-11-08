var button_back;

var select_year;
var select_month;

function initDom() {

    button_back = $('#button_back');
    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

    select_year = $('#select_year');
    select_month = $('#select_month');

}


$(()=>{

    initDom();
    fillYears();

});

function fillYears() {

    executeAjax((data)=>{
        if(data.status) {

            if(data.data.first !== false) { 
                let yearsHTML = '';
                let i;
                for (i = parseInt(data.data.first); i < parseInt(data.data.now)+1; i++) {
                    yearsHTML += '<option value="'+i+'">'+i+'</option>';
                }
                select_year.append(yearsHTML);
            } else {
                select_year.append('<option value="'+data.data.now+'">'+data.data.now+'</option>');
            }

        } else {
            console.error(data.error);
        }
    },'get-first-year');

}
// UI