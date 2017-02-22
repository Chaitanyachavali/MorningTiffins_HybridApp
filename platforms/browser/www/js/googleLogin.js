var googleapi = {
    authorize: function(options) {
        var deferred = $.Deferred();

        var authUrl = 'https://accounts.google.com/o/oauth2/auth?' + $.param({
            client_id: options.client_id,
            redirect_uri: options.redirect_uri,
            response_type: 'code',
            scope: options.scope
        });

        var authWindow = window.open(authUrl, '_blank', 'location=no,toolbar=no');
        $(authWindow).on('loadstart', function(e) {
            var url = e.originalEvent.url;
            var code = /\?code=(.+)$/.exec(url);
            var error = /\?error=(.+)$/.exec(url);

            if (code || error) {
                authWindow.close();
            }

            if (code) {
                $.post('https://accounts.google.com/o/oauth2/token', {
                    code: code[1],
                    client_id: options.client_id,
                    client_secret: options.client_secret,
                    redirect_uri: options.redirect_uri,
                    grant_type: 'authorization_code'
                }).done(function(data) {
                    deferred.resolve(data);
                }).fail(function(response) {
                    deferred.reject(response.responseJSON);
                });
            } else if (error) {
                deferred.reject({
                    error: error[1]
                });
            }
        });

        return deferred.promise();
    }
};

$(document).on('deviceready', function() {

    $("#login").click(function(){
        googleapi.authorize({
            client_id: '1024734048238-p2t15mb0h7qgtlcl7adv10k7pgkfj1fb.apps.googleusercontent.com',
            client_secret: '17IwYXzpnumzo8uiZEs_S5Bp',
            redirect_uri: 'http://localhost',
            scope: 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email'
        }).done(function(data) {
            //alert("just login data")
            //var t = JSON.stringify(data);
            ////alert(t);
            //$("#loginStatus").html('Access Token: ' + data.access_token);
            var access_token = data.access_token;
            //alert(access_token);
            var url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' + access_token;
            //alert(url);
            //get user details from acess token
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                error: function(jqXHR, text_status, strError) {},
                success: function(data) {
                    var item;
                    var x = JSON.stringify(data);
                    //alert(x);
                    ////alert(x.email);
                    console.log(JSON.stringify(data));
                    // Save the userprofile data in your localStorage.
                    localStorage.gmailLogin = "true";
                    localStorage.gmailID = data.id;
                    localStorage.email = data.email;
                    localStorage.gmailFirstName = data.given_name;
                    localStorage.gmailLastName = data.family_name;
                    var fullname = data.given_name.concat(data.family_name)
                    localStorage.gmailFullName = fullname;
                    localStorage.gmailProfilePicture = data.picture;
                    localStorage.gmailGender = data.gender;
                    // //alert("Got all the data");
                    // var check = "temp";
                    // check = window.localStorage.getItem('gmailEmail');
                    // //alert(check);
                    // //alert("Data Shown");

                    var dataString = 'google_id='+ data.id + '&mail='+ data.email + '&name='+ fullname + '&gender='+ data.gender;
                    //alert(dataString);
                    $.ajax({  
                        type: "POST",  
                        url: "https://morningtiffins.000webhostapp.com/app_scripts/insertNewUser.php",  
                        data: dataString,  
                        success: function(dataString) {  
                            //alert(dataString);
                            //alert("New User Added to database");
                            window.location.href="category.html";
                             
                        }  
                    });
                    //window.location.href="category.html";
                }
            });
        }).fail(function(data) {
            $("#loginStatus").html(data.error);
        });
    });
});