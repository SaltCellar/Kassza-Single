var keret_settings_main;
var keret_settings_changeUsername;
var keret_settings_changePassword;

var button_back;
var button_back_changeUsername;
var button_back_changePassword;


var options = {
    bv_osz  : { title:'Bevétel összesen',           cb: false, spinner: false },
    ny_db   : { title:'Nyugta db.',                 cb: false, spinner: false },
    bv_bank : { title:'Bevétel terminál',           cb: false, spinner: false },
    ki_osz  : { title:'Kifizetés összesen',         cb: false, spinner: false },
    ki_db   : { title:'Kifizetések db.',            cb: false, spinner: false },
    bv_a    : { title:'Bevétel A (5%)',             cb: false, spinner: false },
    bv_b    : { title:'Bevétel B (18%)',            cb: false, spinner: false },
    bv_c    : { title:'Bevétel C (27%)',            cb: false, spinner: false },
    bv_d    : { title:'Bevétel D (0% AJT)',         cb: false, spinner: false },
    bv_e    : { title:'Bevétel E (0% TAM)',         cb: false, spinner: false }
};

var button_changeUsername;
var button_changePassword;

function initDom() {

    keret_settings_main = $('#keret_settings_main');
    keret_settings_changeUsername = $('#keret_settings_changeUsername');
    keret_settings_changePassword = $('#keret_settings_changePassword');

    button_back = $('#button_back');
    button_back_changeUsername = $('#button_back_changeUsername');
    button_back_changePassword = $('#button_back_changePassword');

    button_back.click(()=>{
        window.location.href = "?c=menu";
    });

    button_back_changeUsername.click(()=>{
        $('#newUsername_error').hide();
        $('#newUsername_success').hide();
        keret_settings_changeUsername.hide();
        keret_settings_main.show();
    });

    button_back_changePassword.click(()=>{
        $('#newPassword_error').hide();
        $('#newPassword_success').hide();
        keret_settings_changePassword.hide();
        keret_settings_main.show();
    });

    // CHANGE OPTIONS

    button_changeUsername = $('#button_changeUsername');
    button_changePassword = $('#button_changePassword');

    button_changeUsername.click(()=>{
        keret_settings_main.hide();
        keret_settings_changeUsername.show();
    });

    button_changePassword.click(()=>{
        keret_settings_main.hide();
        keret_settings_changePassword.show();
    });

}


$(()=>{
    initDom();
    buildUI(afterBuildUI);
});

function afterBuildUI() {
    //Disable all ui input in settings
    disabledAllOptions(true);

    //Load settings (ajax)
    loadSettings();

    //options.kp_sz.cb.prop('checked', true);

}

function buildUI(_callBack) {

    let optionsHTML = "";

    $.when(
        $.each(options,(index,value)=>{
            optionsHTML += '<div class="splitRow"><p style="line-height: 26px;">'+value.title+'</p><div class="splitRow" style="width: auto;"><div id="spinner_'+index+'" class="spinner-border spinner-border-sm" style="margin-top: 7px; margin-right: 10px;" role="status"><span class="sr-only">Loading...</span></div><div class="inputSwitch"><input onclick="updateSwitchSettings(\''+index+'\')" id="switch_'+index+'" type="checkbox" /><label for="switch_'+index+'" class="labelSwitch"></label></div></div></div>';
        })
    ).then(()=>{
        $.when(
            $('#div_gyujtes').append(optionsHTML)
        ).then(
            $.each(options,(index,value)=>{
                value.cb        = $('#switch_'+index);
                value.spinner   = $('#spinner_'+index);
            })
        );

        _callBack();
    });

}

function disabledAllOptions(_boolean) {

    $.each(options,(index,value)=>{
        value.cb.prop('disabled', _boolean);
    })

    button_changeUsername.prop('disabled', _boolean);
    button_changePassword.prop('disabled', _boolean);
}

function hideAllSpinner() {
    $.each(options,(index,value)=>{
        value.spinner.hide();
    })
}

function loadSettings() {
    executeAjax((data)=>{
        if(data.status) {
            //Set the ui...

            $.when(
                $.each(data.data,(index,value)=>{
                    options[index].cb.prop('checked', value);
                })
            ).then(()=>{
                disabledAllOptions(false);
                hideAllSpinner();
            });

        } else {
            console.error(data.error);
        }
    },'get-settings');
}

function updateSwitchSettings(_optionName) {
    let _boolean = options[_optionName].cb.is(':checked');

    disabledAllOptions(true);
    options[_optionName].spinner.show();

    executeAjax((data)=>{
        if(data.status) {

            options[_optionName].spinner.hide();
            disabledAllOptions(false);

        } else {console.error(data.error);}
    },'update-settings',{name:_optionName,value:_boolean});
    
}

function changeUsernameOrPassword(_boolean) {
    /*
        true = change Username
        false = change Password
    */
    let _newValue = "asd";

    if(_boolean) {
        _newValue = $('#newUsername').val();
    } else {
        _newValue = $('#newPassword').val();
    }

    $('#newUsername_error').hide();
    $('#newUsername_success').hide();
    $('#newPassword_error').hide();
    $('#newPassword_success').hide();

    executeAjax((data)=>{
        if(data.status) {

            if(_boolean) {
                $('#newUsername').val('');
                $('#newUsername_error').hide();
                $('#newUsername_success').show();
            } else {
                $('#newPassword').val('');
                $('#newPassword_error').hide();
                $('#newPassword_success').show();
            }

        } else {
            console.error(data.error)
            if(_boolean) {
                $('#newUsername_error').show();
            } else {
                $('#newPassword_error').show();
            }
        }
    },'change-uop',{target:_boolean,value:_newValue});
    
}