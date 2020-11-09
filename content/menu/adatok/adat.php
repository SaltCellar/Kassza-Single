<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Adat');

    if(!isset($_GET['y'])) $_GET['y'] = date('Y',time());
    if(!isset($_GET['m'])) $_GET['m'] = date('m',time());

    setTitle('Adat - '.$_GET['y'].".".$_GET['m'].".");
?>

<div class="keret" style="margin: 100px auto;">

    <div class="splitRow">
        <h3>Adatok <?=$_GET['y'].".".$_GET['m']."."?></h3>
        <button id="button_back" type="button" class="btn btn-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>

    <canvas id="chart_beki"></canvas>

    <!--
        Bevétel összesen
        Kiadás összesen
        BANK / KP arány
    -->
    <div style="margin-top: 30px;">
        <h4 id="s_bv_osz"></h4>
        <h4 id="s_ki_osz"></h4>
    </div>

    <!--
        Nyugták száma
        Kiadások száma
    -->

    <canvas id="chart_kp"></canvas>

    <h3 style="margin-top: 50px;">Napok</h3><hr>

    <div class="form-group">
    <label for="selected_nap">Nap</label>
        <select id="selected_nap" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>

</div>

<script>

    var ADAT_y = <?=$_GET['y']?>;
    var ADAT_m = <?=$_GET['m']?>;

</script>