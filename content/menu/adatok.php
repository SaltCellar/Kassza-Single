<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Adatok');
?>

<div class="keret" style="margin: 100px auto;">

    <div class="splitRow">
        <h3>Adatok</h3>
        <button id="button_back" type="button" class="btn btn-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>

    <div class="form-group">
        <label for="select_year">Év</label>
        <select id="select_year" class="form-control">
        </select>
    </div>

    <div class="form-group">
        <label for="select_month">Hónap</label>
        <select id="select_month" class="form-control">
            <option value="1">1. január</option>
            <option value="2">2. február</option>
            <option value="3">3. március</option>
            <option value="4">4. április</option>
            <option value="5">5. május</option>
            <option value="6">6. június</option>
            <option value="7">7. július</option>
            <option value="8">8. augusztus</option>
            <option value="9">9. szeptember</option>
            <option value="10">10. október</option>
            <option value="11">11. november</option>
            <option value="12">12. december</option>
        </select>
    </div>

    

</div>