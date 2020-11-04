<?php
    //if(!isMember()) location('c=login');;
    if(isMember()) location('c=menu');
    setTitle('Login');

    
?>

<div style="    
    margin: 0px auto;
    margin-top: 100px;
    max-width: 360px;
">

    <div class="keret">

        <?=getFormTitle()?>

        <div id="login_alert"></div>

        <div class="form-group">
            <label for="input_username"><i class="fa fa-user" aria-hidden="true"></i> User Name</label>
            <input type="text" class="form-control" id="input_username">
        </div>
        <div class="form-group">
            <label for="input_password"><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
            <input type="password" class="form-control" id="input_password">
        </div>
        <button id="button_info" class="btn btn-link"><i class="fa fa-info" aria-hidden="true"></i> Info</button>
        <button id="button_login" class="btn btn-dark pull-right" style="margin-top: 10px;"><i class="fa fa-sign-in" aria-hidden="true"></i> Enter</button>

    </div>

    <div class="eu_keret" style="margin-top: 50px; margin-bottom: 100px;">
        <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
            <img src="res/eu.svg" alt="Kiwi standing on oval">
            <h4>EU Ready <small>HU</small></h4>
        </div>
        <p><i>Ez az oldal sütiket használ! Az oldal megfelelő és biztosnágos működéséhez elngethetetlen a sütik használata. Az oldal használatával elfogadja a sütik használatát.</i></p>
        <a href="?c=eu/cookies"><i class="fa fa-link" aria-hidden="true"></i> Sütik (Cookies)</a><br>
        <a href="?c=eu/adatvedelmi-tajekoztato"><i class="fa fa-link" aria-hidden="true"></i> Adatvédelmi Tájékoztató</a><br>
        <a href="?c=eu/impressum"><i class="fa fa-link" aria-hidden="true"></i> Impresszum</a><br>
    </div>

</div>