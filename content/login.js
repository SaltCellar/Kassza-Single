var button_login;
var input_username;
var input_password;

function initDom() {

    button_login    = $('#button_login');
    input_username  = $('#input_username');
    input_password  = $('#input_password');

    button_login.click(()=>{

        executeAjax((data)=>{

            if(data.status) {

                location.reload();

            } else {
                console.error(data.error);
                bootstrapAlert($('#login_alert'),'danger',data.error);
            }

        },'login',{
            username: input_username.val(),
            password: input_password.val()
        });

    });
}

$(()=>{

    initDom();

});