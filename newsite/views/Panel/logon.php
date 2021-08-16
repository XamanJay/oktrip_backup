<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Logon Panel Oktrip! </title>
     <link href="../../css/animate/Ollin.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/nprogress/nprogress.css" rel="stylesheet">
    <link href="/css/animate/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/styles-admin.css">
    <link rel="icon" type="image/png" href="/img/iconos/favicon.png" />
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery-validate/jquery.validate.min.js"></script>
</head>

<body class="login">
    <div class="page">
        <div class="middle-page">
            <div class="col-300">
                <div class="login-form">
                    <form id="loginForm" action="/panel/login" method="POST">
                        <p class="MOVIMIENTO_IZQ_CRECIENDO"><h2>Panel de administrador logon</h2></p>
                        <a href="/home"><img src="../../img/logos/oktrip.png" class="img-responsive center-block MOVIMIENTO_IZQ_CRECIENDO" alt="" style="width: 100%; margin-bottom: 15px;"></a>
                        <div class="form-group">
                            <input class="form-control MOVIMIENTO_IZQ_CRECIENDO" id="username" name="username" type="text" placeholder="Correo o cuenta de usuario" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control MOVIMIENTO_IZQ_CRECIENDO" id="password" name="password" type="password" placeholder="Contraseña" required>
                        </div>
                        <div id="button-submit MOVIMIENTO_IZQ_CRECIENDO" class="form-group">
                            <input type="hidden" name='gp_tk' value='<?php echo $_SESSION['token']; ?>'>
                            <button class="btn btn-default form-control">Entrar</button>
                        </div>
                        <i class="fa fa-spinner fa-pulse fa-4x fa-fw cl-ok hidden" aria-hidden="true"></i>
                    </form>
                </div>
                <div class="alert alert-danger alert-error alert-dismissible fade" role="alert">
                    <div class="message"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                },
                messages: {
                    username: {
                        required: "Este campo es requerido.",
                    },
                    password: {
                        required: "Este campo es requerido.",
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        beforeSend: function(){
                            $('#button-submit').css('display','none').fadeIn();
                            $('.fa-spinner').css('display','block').fadeIn();
                        },
                        success: function (jsonObject) {
                            $('#button-submit').css('display','block').fadeIn();
                            $('.fa-spinner').css('display','none').fadeIn();
                            if (jsonObject != "") {
                                console.log(jsonObject);
                                var object = JSON.parse(jsonObject);
                                if(object.type == "success"){
                                    window.location.reload(true);
                                }
                                else
                                {
                                    $(".alert-"+object.type+" .message").html(object.message);
                                    $(".alert-"+object.type).addClass("in");
                                    $("form input[name='password']").val("");
                                }
                            }
                        },
                        failed: function(result) {
                            console.log("failed");
                        }
                    });
                    return false;
                }
            });


            /*$("#loginForm").submit(function(e){
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: $(form).serialize(),
                    beforeSend: function(){
                        $('#button-submit').css('display','none').fadeIn();
                        $('.fa-spinner').css('display','block').fadeIn();
                    },
                    success: function (jsonObject) {
                        $('#button-submit').css('display','block').fadeIn();
                        $('.fa-spinner').css('display','none').fadeIn();
                        if (jsonObject != "") {
                            var object = JSON.parse(jsonObject);
                            console.log(object);
                            $(".alert-"+object.type+" .message").html(object.message);
                            $(".alert-"+object.type).addClass("in");
                            $("form input").val("");
                        }
                    }
                });
                e.preventDefault();
                return false;
            });*/
        });

    </script>

</body>
</html>