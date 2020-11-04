<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Menu');
?>


<div class="keret" style="margin-top: 100px;">

    <?=getFormTitle()?>

    <div class="row menuRow">
        <div class="col-sm">
            <button type="button" class="btn btn-outline-dark btn-lg"><i class="fa fa-sun-o" aria-hidden="true"></i><br>Nyitás</button>
        </div>
        <div class="col-sm">
            <button type="button" class="btn btn-outline-dark btn-lg"><i class="fa fa-moon-o" aria-hidden="true"></i><br>Zárás</button>
        </div>
        <div class="col-sm">
            <button type="button" class="btn btn-outline-dark btn-lg"><i class="fa fa-calendar-o" aria-hidden="true"></i><br>Adatok</button>
        </div>
    </div>
</div>

<button id="button_logout" style="margin-top: 30px; margin-bottom: 100px;" type="button" class="btn btn-dark"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
<button id="button_info" style="margin-top: 30px; margin-bottom: 100px;" type="button" class="btn btn-dark"><i class="fa fa-info" aria-hidden="true"></i> Info</button>
<button id="button_settings" style="margin-top: 30px; margin-bottom: 100px;" type="button" class="btn btn-dark"><i class="fa fa-cog" aria-hidden="true"></i> Settings</button>