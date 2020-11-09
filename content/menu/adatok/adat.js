var button_back;

var dataSets;
var settings;

function initDom() {

    button_back = $('#button_back');
    button_back.click(()=>{
        window.location.href = "?c=menu/adatok";
    });

}


$(()=>{

    initDom();
    load_adat(ADAT_y,ADAT_m);

});

// SETTINGS

function load_settings() {

    executeAjax((data)=>{
        if(data.status) {

            settings = data.data;
            drawSettings();

        } else {
            console.error(data.error);
        }
    },'get-settings');

}

function drawSettings() {

    let month_bv_osz = 0;
    for(let i = 0; i < dataSets.bv_osz.length; i++) {
        month_bv_osz += parseInt(dataSets.bv_osz[i]);
    }
    $('#s_bv_osz').html('Bevétel összesen: '+numberFormat(month_bv_osz)+' Ft');

    let month_ki_osz = 0;
    for(let i = 0; i < dataSets.ki_osz.length; i++) {
        month_ki_osz += parseInt(dataSets.ki_osz[i]);
    }
    $('#s_ki_osz').html('Kiadás összesen: '+numberFormat(month_ki_osz)+' Ft');

}

// DATA

function load_adat(_y,_m) {
    
    executeAjax((data)=>{
        if(data.status) {

            handle_Result(data.data);

        } else {
            console.error(data.error);
        }
    },'get-month',{
        y:_y,
        m:_m
    });

}

function handle_Result(_data) {
    
    dataSets = {
        day: [],
        time: [],
        kp: [],
        bv_osz: [],
        ny_db: [],
        bv_bank: [],
        ki_osz: [],
        ki_db: [],
        bv_a: [],
        bv_b: [],
        bv_c: [],
        bv_d: [],
        bv_e: []
    }

    $.each(_data,(k,v)=>{
        $.each(v,(vk,vv)=>{
            dataSets[vk].push(vv);
        });
        dataSets['day'].push((new Date(v.time * 1000)).getDate() + ".");
    });

    load_settings();

    // DRAW CHARTS

    drawChart_beki(dataSets.day,dataSets.bv_osz,dataSets.bv_bank,dataSets.ki_osz);
    drawChart_kp(dataSets.day,dataSets.kp);


}


function drawChart_beki(_labels,_dataBe,_dataBank,_dataKi) {

    let _dataKp = [];
    for (let i = 0; i < _dataBe.length; i++) {
        _dataKp.push(_dataBe[i] - _dataBank[i]);
    }

    new Chart(document.getElementById('chart_beki').getContext('2d'), {
        type: 'line', // bar, horizontal bar, pie, line, doughnut radar, polarArea
        data: {
            labels: _labels,
            datasets: [
                {
                    label: 'Bevétel Összes',
                    data: _dataBe,
                    borderColor: '#abcbff',
                    fill: false,
                },
                {
                    label: 'Bevétel Kp',
                    data: _dataKp,
                    borderColor: '#4287f5',
                    fill: false,
                },
                {
                    label: 'Kiadás',
                    data: _dataKi,
                    borderColor: '#ff5f2e',
                    fill: false,
                }
            ],
        },
        options: {
            title:{
                display: true,
                text: 'Bevétel & Kiadás',
                fontSize: 26,
            }
        }
    });
}

function drawChart_kp(_labels,_dataKp) {
    new Chart(document.getElementById('chart_kp').getContext('2d'), {
        type: 'line', // bar, horizontal bar, pie, line, doughnut radar, polarArea
        data: {
            labels: _labels,
            datasets: [
                {
                    label: 'Kassza',
                    data: _dataKp,
                    borderColor: '#7cf067',
                    fill: false,
                },
            ],
        },
        options: {
            title:{
                display: true,
                text: 'Kassza álása',
                fontSize: 26,
            }
        }
    });
}