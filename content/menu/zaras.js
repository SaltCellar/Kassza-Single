var button_back;
var kp_inputs;
var total_kp;
var options;

function initDom() {

    button_back = $('#button_back');
    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

    total_kp = $('#total_kp');

    kp_inputs = {
        5:      $('#kp_5'),
        10:     $('#kp_10'),
        20:     $('#kp_20'),
        50:     $('#kp_50'),
        100:    $('#kp_100'),
        200:    $('#kp_200'),
        500:    $('#kp_500'),
        1000:   $('#kp_1000'),
        2000:   $('#kp_2000'),
        5000:   $('#kp_5000'),
        10000:  $('#kp_10000'),
        20000:  $('#kp_20000')
    };

    options = {
        bv_osz  : { title:'Bevétel összesen',           input: false },
        ny_db   : { title:'Nyugta db.',                 input: false },
        bv_bank : { title:'Bevétel terminál',           input: false },
        ki_osz  : { title:'Kifizetés összesen',         input: false },
        ki_db   : { title:'Kifizetések db.',            input: false },
        bv_a    : { title:'Bevétel A (5%)',             input: false },
        bv_b    : { title:'Bevétel B (18%)',            input: false },
        bv_c    : { title:'Bevétel C (27%)',            input: false },
        bv_d    : { title:'Bevétel D (0% AJT)',         input: false },
        bv_e    : { title:'Bevétel E (0% TAM)',         input: false }
    };

    $.each(kp_inputs,(k,v)=>{
        v.on("change paste keyup cut select", function() {
            totalCalc();
        });
        v.inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
    });

}


$(()=>{

    initDom();
    loadSettingsAndBuildUI();

});

function totalCalc() {
    let total = 0;
    $.when($.each(kp_inputs,(k,v)=>{
        let p = parseInt(v.val());
        if(isNaN(p)) { p = 0; }
        total += p * parseInt(k);
    })).then(()=>{
        total_kp.html(numberFormat(total)+" Ft");
    });
}

function loadSettingsAndBuildUI() {
    let _data = false;
    $.when(
        executeAjax((data)=>{
            if(data.status) {
                _data = data.data;
            } else {
                console.error(data.error);
            }
        },'get-settings')
    ).then(
        
    );
}