var button_back;

var select_year;
var select_month;

var button_mutat;

function initDom() {

    button_back = $('#button_back');
    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

    select_year = $('#select_year');
    select_month = $('#select_month');

    button_mutat = $('#button_mutat');
    button_mutat.click(mutat);

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

            // SET CURRENT YEAR & MONTH
            let dateObj = new Date();
            let year = dateObj.getUTCFullYear();
            let month = dateObj.getUTCMonth() + 1; //months from 1-12

            select_year.val(year);
            select_month.val(month);


        } else {
            console.error(data.error);
        }
    },'get-first-year');

}

function mutat() {
    window.location.href = "?c=menu/adatok/adat" + "&y=" + select_year.val() + "&m=" + select_month.val();
}