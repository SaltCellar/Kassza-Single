<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Settings');
?>


<div id="keret_settings_main" class="keret" style="margin: 100px auto; max-width: 510px;">

    <div class="splitRow">
        <h3>Settings</h3>
        <button id="button_back" type="button" class="btn btn-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>

    <h5 style="margin-top: 50px;" >Gyűjtés</h5><hr>

    <div id="div_gyujtes"></div>

    <h5 style="margin-top: 50px;" >Biztonság</h5><hr>

    <button id="button_changeUsername" style="margin-bottom: 10px;" type="button" class="btn btn-dark">Change Username</button>
    <br>
    <button id="button_changePassword" type="button" class="btn btn-dark">Change Password</button>

</div>

<div id="keret_settings_changeUsername" class="keret" style="margin: 100px auto; max-width: 510px; display: none;">

    <div class="splitRow">
        <h3>Change Username</h3>
        <button id="button_back_changeUsername" type="button" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
    </div>

    <div class="form-group" style="margin-top: 50px;">
        <label for="newUsername">New Username</label>
        <input type="text" class="form-control" id="newUsername">
        <small>A felhasználói névnek minimum 5 karakter hosszúnak kell lennie!</small>
    </div>

    <div id="newUsername_error" style="display: none;" class="alert alert-danger" role="alert">
        <strong>Hmmm...</strong> valami gond van!
    </div>

    <div id="newUsername_success" style="display: none;" class="alert alert-success" role="alert">
        Sikeresen frissítve!
    </div>

    <button id="button_changeUsername" onclick="changeUsernameOrPassword(true)" type="button" class="btn btn-dark">Save</button>

</div>

<div id="keret_settings_changePassword" class="keret" style="margin: 100px auto; max-width: 510px; display: none;">

    <div class="splitRow">
        <h3>Change Password</h3>
        <button id="button_back_changePassword" type="button" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
    </div>

    <div class="form-group" style="margin-top: 50px;">
        <label for="newPassword">New Password</label>
        <input type="password" class="form-control" id="newPassword">
        <small>A jelszónak minimum 5 karakter hosszúnak kell lennie!</small>
    </div>

    <div id="newPassword_error" style="display: none;" class="alert alert-danger" role="alert">
        <strong>Hmmm...</strong> valami gond van!
    </div>

    <div id="newPassword_success" style="display: none;" class="alert alert-success" role="alert">
        Sikeresen frissítve!
    </div>

    <button id="button_changePassword" onclick="changeUsernameOrPassword(false)" type="button" class="btn btn-dark">Save</button>

</div>