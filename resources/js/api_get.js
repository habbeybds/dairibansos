import axios from "axios";

// $("body").on("submit", "#FormLogin", function(e) {
//     e.preventDefault();

//     let emailorusername = $("#exampleInputUsernameEmail").val();
//     let password = $("#exampleInputPassword1").val();
//     $("#message-error").html("");
    
//     // axios
//     //     .get("/api/login", {
//     //         params: {
//     //             email: emailorusername,
//     //             username:emailorusername,
//     //             password: password
//     //         }
//     //     })
//     //     .then(function(response) {
//     //         var data_login = response.data.data;
//     //         var token = $('#token').val();
//     //         $.ajax({
//     //             url:"/data_login",
//     //             method:"POST",
//     //             data:{"_token": token,"action":"setDataLogin", data:data_login},
//     //             success:function(data){
//     //                 window.location.href = "/dashboard";
//     //             }
//     //         });
//     //     })
//     //     .catch(function(error) {
//     //         console.log(error.response.data.error);
//     //         $("#message-error").addClass('show');
//     //        $("#message-error").html(error.response.data.error);
//     //     })
//     //     .then(function() {
//     //         // always executed
//     //     });
// });
