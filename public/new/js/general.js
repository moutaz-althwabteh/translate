$(document).ready(
    function () {

         var complete_purch = function () {
             $('.complete-purch').on("click",function () {


                 $.ajax({
                     url: "services/complete_purshace.php",
                     data: {},
                     method:"POST",
                     success: function (msg) {
                         //alert(msg);
                        // $('.carty').text(msg).fadeOut("slow").fadeIn("slow").fadeOut("slow").fadeIn("slow");
                     }
                 });
                
             });
         }
        
        var delete_sp_cart = function () {
            $('.delete-sp-cart').on("click",function () {

                var a =   $(this).parent().find(".cart-id").text();
                var curr_id = $(this);
                $.ajax({
                    url: "services/del_sp_cart.php",
                    data: {a:a},
                    method:"POST",
                    success: function (msg) {
                        curr_id.parent().parent().hide("slow");
                        $('.carty').text(msg);
                        //$('.carty').text(msg).fadeOut("slow").fadeIn("slow").fadeOut("slow").fadeIn("slow");
                    }
                });

            });
        };

        var user_login = function () {
            $('.login-btn').on("click",function () {


                $.ajax({
                    url: "services/user_login.php",
                    data: {a:$('#username').val(),b:$('#passowrd').val()},
                    method:"POST",
                    success: function (res) {
                        var x = jQuery.parseJSON(res);
                        alert(x.account_id);
                        if(x.massege == true){ $('#msg').text('اهلا بك'); }
                        else if(x.massege == false){ $('#msg').text('اسم المستخدم او كلمة المرور غير صحيح');}
                        else{ $('#msg').text('خلل غير معروف يرجى الاتصال بمسؤول النظام');}

                        
                    }
                });

            });
        }

        var new_user = function () {
            $('.reg-btn').on("click",function () {


                $.ajax({
                    url: "services/new_user.php",
                    data: {a:$('#fullname').val(),b:$('#username1').val(),c:$('#password1').val()},
                    method:"POST",
                    success: function (res) {
                        var x = jQuery.parseJSON(res);
                        alert(res);
                        if(x.massege == true){ $('#msg').text('لقد تمت عملية التسجيل بنجاح'); }
                        else if(x.massege == false){ $('#msg').text('اسم المستخدم او كلمة المرور غير صحيح');}
                        else{ $('#msg').text('خلل غير معروف يرجى الاتصال بمسؤول النظام');}


                    }
                });

            });
        }


        $('.add-cart').on("click",function () {

          // alert($(this).parent().find(".current-id").text()) ;
            
            $.ajax({
                url: "services/add_cart.php",
                data: {a:$(this).parent().find(".current-id").text()},
                method:"POST",
                success: function (msg) {
                    //alert(msg);
                    $('.carty').text(msg).fadeOut("slow").fadeIn("slow").fadeOut("slow").fadeIn("slow");
                }
            });

            $.ajax({
                url: "services/get_cart.php",
                data: {},
                method:"POST",
                success: function (msg) {
                    var x =  jQuery.parseJSON(msg);
                    var str ="";
                    for(var i = 0 ; i<x.length;i++){

                       str = str+"<tr><td>"+x[i].product_name+"</td><td>"+x[i].qua+"</td><td><span style='display: none' class='cart-id'>"+x[i].product+
                           "</span><a href='#' class='btn-danger btn delete-sp-cart'/>del</a></td></tr>";
                    }
                    $('.all-cart').html(str);
                    delete_sp_cart();
                }
            });


            return false; // ma bykamel sloko elerterady , to prevent link to refresh page
        });

        delete_sp_cart();
        complete_purch();
        user_login();
        new_user();

    });