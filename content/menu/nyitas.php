<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Nyitás');
?>


<div class="keret" style="margin: 100px auto;">

    <div class="row" style="margin-bottom: 50px;">
        <div class="col">

            <div class="splitRow">
                <h3>Nyitás</h3>
                <button id="button_back" type="button" class="btn btn-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

        </div>
    </div>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col">

            <h4 class="text-center">Rögzitve: <a id="time_date_i"></a></h4>
            <h3 class="text-center" style="margin-top: 20px;"><b id="total_b">? Ft</b></h3>
            
        </div>
    </div>

    <div class="row">
        <div class="col-md" id="col_a">
            

        </div>
        <div class="col-md" id="col_b">


        </div>
    </div>

</div>
