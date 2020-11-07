<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Zárás');
?>

<div class="keret" style="margin: 100px auto; max-width: 930px;">

    <div class="row" style="margin-bottom: 50px;">
        <div class="col">

            <div class="splitRow">
                <h3>Zárás</h3>
                <button id="button_back" type="button" class="btn btn-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

        </div>
    </div>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col-md" id="col_a">
            
            <div class="splitRow penzRow">
                <b>5 Ft</b>
                <input id="kp_5" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>10 Ft</b>
                <input id="kp_10" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>20 Ft</b>
                <input id="kp_20" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>50 Ft</b>
                <input id="kp_50" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>100 Ft</b>
                <input id="kp_100" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>200 Ft</b>
                <input id="kp_200" type="text" class="form-control">
            </div>

        </div>
        <div class="col-md" id="col_b">

            <div class="splitRow penzRow">
                <b>500 Ft</b>
                <input id="kp_500" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>1000 Ft</b>
                <input id="kp_1000" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>2000 Ft</b>
                <input id="kp_2000" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>5000 Ft</b>
                <input id="kp_5000" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>10000 Ft</b>
                <input id="kp_10000" type="text" class="form-control">
            </div>

            <div class="splitRow penzRow">
                <b>20000 Ft</b>
                <input id="kp_20000" type="text" class="form-control">
            </div>

        </div>
    </div>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col">
            <h4 class="text-center">Kassza tartalma:<br><b id="total_kp">0 Ft</b></h4>
        </div>
    </div>

    <div id="settings_input" class="row" style="margin-bottom: 50px;">
        <div class="col">

        </div>
    </div>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col text-center">
            <button id="button_zaras" type="button" style="max-width: 100px;" class="btn btn-dark btn-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Zárás</button>
        </div>
    </div>
    <div id="zaras_alert"></div>

</div>
