var button_back;
var button_zaras;
var kp_inputs;
var total_kp;
var options;

var total;

var settings_input;

function initDom() {

    total = 0;

    button_back = $('#button_back');
    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

    button_zaras = $('#button_zaras');
    button_zaras.click(zaras);

    settings_input = $('#settings_input');

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
    loadSettings();

});

function totalCalc() {
    total = 0;
    $.when($.each(kp_inputs,(k,v)=>{
        let p = parseInt(v.val());
        if(isNaN(p)) { p = 0; }
        total += p * parseInt(k);
    })).then(()=>{
        total_kp.html(numberFormat(total)+" Ft");
    });
}

function loadSettings() {


    executeAjax((data)=>{
        if(data.status) {

            $.when(
                $.each(data.data,(k,v)=>{
                    if(v) {options[k].input = true;}
                })
            ).then(
                buildUi()
            );

        } else {
            console.error(data.error);
        }
    },'get-settings');

}

function buildUi() {
    settings_input.html('');
    $.each(options,(k,v)=>{
        if(v.input) {
            $.when(
                settings_input.append('<div class="splitRow penzRow" style="max-width: 500px;"><b>'+v.title+'</b><input id="'+k+'" type="text" class="form-control"></div>')
            ).then( () => {
                    v.input = $('#'+k);
                    v.input.inputFilter(function(value) {
                        return /^\d*$/.test(value);    // Allow digits only, using a RegExp
                    });
                }
            );
        }
    });
}

function zaras() {
    //kp_inputs
    //options if not false

    //kp_inputs
    //options

    let DATA = {
        kp: {},
        options: {},
    };

    $.each(kp_inputs,(k,v)=>{
        let p = parseInt(v.val());
        if(isNaN(p)) { p = 0; }
        DATA['kp'][k] = p;
    });

    $.each(options,(k,v)=>{
        let p = false;
        if(v.input !== false) {
            p = parseInt(v.input.val());
            if(isNaN(p)) { p = 0; }
            DATA['options'][k] = p;
        }
    });

    DATA['options']['kp'] = total;
    executeAjax((data)=>{
        if(data.status) {
            bootstrapAlert($('#zaras_alert'),'success',data.data);
        } else {
            console.error(data.error);
            bootstrapAlert($('#zaras_alert'),'danger',data.error);
        }
    },'zaras',DATA);

    console.log("Script done.");
}