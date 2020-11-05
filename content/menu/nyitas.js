var button_back;
var col_a;
var col_b;
var time_date_i;
var total_b;


function initDom() {

    button_back = $('#button_back');
    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

    col_a = $('#col_a');
    col_b = $('#col_b');

    time_date_i = $('#time_date_i');
    total_b = $('#total_b');

}


$(()=>{

    initDom();

    executeAjax((data)=>{
        if(data.status) {
            
            let total = 0;

            time_date_i.html(data.data.time);

            col_a.html('');
            col_b.html('');

            let col_a_p = "";
            let col_b_p = "";

            $.when(
                $.each(data.data.col_a, (k,v)=>{
                    total += v*k;
                    let emp = ""; if(v < 1) { emp = "font_gray"; }
                    col_a_p += '<div class="splitRow penzRow '+emp+'"><b>'+k+' Ft</b><b>'+v+'x</b></div>';
                })).then(()=>{
                col_a.append(col_a_p);

                $.when(
                    $.each(data.data.col_b, (k,v)=>{
                        total += v*k;
                        let emp = ""; if(v < 1) { emp = "font_gray"; }
                        col_b_p += '<div class="splitRow penzRow '+emp+'"><b>'+k+' Ft</b><b>'+v+'x</b></div>';
                    })).then(()=>{
                    col_b.append(col_b_p);
                    total_b.html(numberFormat(total)+' Ft');
                });

            });

        } else { console.error(data.error); }
    },'get-utolso-zaras');

});