var button_login;
var input_username;
var input_password;
var button_info;

function initDom() {

    button_login    = $('#button_login');
    input_username  = $('#input_username');
    input_password  = $('#input_password');
    button_info     = $('#button_info');

    button_login.click(()=>{

        executeAjax((data)=>{

            if(data.status) {

                //location.reload();
                window.location.href = "?c=menu";

            } else {
                console.error(data.error);
                bootstrapAlert($('#login_alert'),'danger',data.error);
            }

        },'login',{
            username: input_username.val(),
            password: input_password.val()
        });

    });

    button_info.click(()=>{
        window.location.href = "?c=info";
    });

}

$(()=>{

    initDom();

});