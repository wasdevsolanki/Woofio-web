


$(function() {
    // Check email button click event
    $("#checkEmail").click(function() {
        var email = $("#email").val();
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Simulate email check using AJAX (replace with actual logic)
        $.ajax({
            url: '/check-email',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken 
            },
            data: { email: email },
            success: function(response) {
                if (response.exists) {
                    $("#step1").addClass("d-none");
                    $("#step2").removeClass("d-none");
                    $("#submitButton").removeClass("d-none");
                    $("#multiStepForm").removeAttr("id");

                } else {
                    $("#multiStepForm").removeClass("multiStepForm");
                    $("#email_value").val(email);
                    $("#step1").addClass("d-none");
                    $("#step3").removeClass("d-none");
                    $("#submitButton").removeClass("d-none");
                }
            },
            error: function() {
                console.log('Error checking email.');
            }
        });
    });

    // Step 2 form submission (password)
    $(".multiStepForm").submit(function(e) {
        e.preventDefault();
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        var email = $("#email").val(); // Get the email from step 1
        var password = $("#password").val();
        var qr_id = $("#qr_id").val();

        // Perform login using AJAX
        $.ajax({
            url: '/login-user', // Replace with your login route
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: { email: email, password: password, qr_id: qr_id},
            success: function(response) {
                // Handle login success or failure
                if (response.success) {
                    // Redirect to dashboard or perform any other action
                    window.location.href='/user?qr_id='+response.qr_id;
                } else if(response.message) {
                    alert("Password is incorrect");
                }
            },
            error: function() {
                console.log('Error logging in.');
            }
        });
    });


    // Step 3 form submission (user registration)
    $("#multiStepForm").submit(function(e) {
        e.preventDefault();

        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData(this);
        var qr_id = $("#qr_id").val();
        formData.append("qr_id", qr_id);

        $.ajax({
            url: '/register-user',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: formData,
            processData: false, // To prevent jQuery from automatically processing the data
            contentType: false, // To prevent jQuery from automatically setting content type
            success: function(response) {
                if (response.success) {
                    window.location.href='/user?qr_id='+response.qr_id;
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Entered info:\n';

                    // Loop through each error and add them to the list
                    for (const fieldName in errors) {
                        errorMessage += '- ' + errors[fieldName].join(', ') + '\n';
                    }

                    // Display the alert with error messages as a formatted list
                    alert(errorMessage);
                } else {
                    console.log('Error registering user.');
                    console.log(xhr);
                }
            }

        });
    });


    $(".register_button").click(function(e) {
        e.preventDefault();
        var path = document.getElementById('Path').getAttribute('path');
        window.location.href = '/register?qr_id='+path;
    });

    $(".login_button").click(function(e) {
        e.preventDefault();
        var path = document.getElementById('Path').getAttribute('path');

        window.location.href = '/login?qr_id='+path;
    });

});
