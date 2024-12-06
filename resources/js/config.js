$(document).ready(function () {
    // alert('loaded') 
    let currentStep = 1;
    const totalSteps = $(".step").length;
    // alert(totalSteps)
    // Initialize form
    $(".step").hide();
    $(`#step${currentStep}`).show();
    updateButtons();

    // Toggle guarantor info when the checkbox is clicked
    $("#allowGuarantor").on("change", function () {
        if ($(this).is(":checked")) {
            $("#guarantor-info").removeClass("hidden");
            $('#guarantor-info').find('input').addClass('required');
        } else {
            $("#guarantor-info").addClass("hidden");
            $('#guarantor-info').find('input').removeClassClass('required');
        }
    });
    $('#loanType').on('change', function () {
        // alert($(this).val());
        $('#typeLoan').removeClass('hidden');
        $('#typeLoan').find('input').addClass('required');
    });

    // Update button states
    function updateButtons() {
        $("#prevBtn").prop("disabled", currentStep === 1);
        $("#nextBtn").text(currentStep === totalSteps ? "Submit" : "Next Step");
    }

    // Validate current step
    function validateStep(step) {
        let isValid = true;
        $(`#step${step} .required`).each(function () {
            const tagName = $(this).prop("tagName").toLowerCase();
            if (tagName === 'select') {
                const field = $(this);
                if (field.val() === "") {
                    field.parent().next(".error").text("This field is required").show();
                }else{
                    field.parent().next(".error").hide();
                }
            } else {
                
            const field = $(this);
            // console.log(field);
            // Check if empty
            if (field.val().trim() === "") {
                isValid = false;
                // console.log($(field).parent());
                field.parent().next(".error").text("This field is required").show();
            } else {
                field.parent().next(".error").hide();
            }

            // Additional validation for specific fields
            if (field.attr("type") === "email" && field.val().trim() !== "") {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(field.val())) {
                    isValid = false;
                    field.parent().next(".error").text("Enter a valid email").show();
                }
            }

            if (field.attr("type") === "tel" && field.val().trim() !== "") {
                const phoneRegex = /^\+?[0-9]{1,3}\s?[0-9]{7,}$/;
                if (!phoneRegex.test(field.val())) {
                    isValid = false;
                    field.parent().next(".error").text("Enter a valid phone number").show();
                }
            }

            if (field.attr("type") === "password" && field.val().trim() !== "") {
                const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; 
                // At least 8 characters, one uppercase, one lowercase, one number, and one special character
                const confirmPasswordField = $("input[name='password_confirmation']");
                
                if (!passwordRegex.test(field.val())) {
                    isValid = false;
                    field.parent().next(".error").text(
                        "Password must be at least 8 characters, include uppercase, lowercase, a number, and a special character."
                    ).show();
                } else if (confirmPasswordField.length > 0 && confirmPasswordField.val().trim() !== "") {
                    // Verify password confirmation matches
                    if (field.val() !== confirmPasswordField.val()) {
                        isValid = false;
                        confirmPasswordField.parent().next(".error").text("Passwords do not match").show();
                    } else {
                        confirmPasswordField.parent().next(".error").text("").hide();
                    }
                }
        }
    }
    
    });
        return isValid;
    }

    // Show next step
    $("#nextBtn").on('click', function (e) {
        e.preventDefault();
        // alert('clicked')
        if (currentStep < totalSteps) {
            // alert(currentStep)
            if (validateStep(currentStep)) {
                // alert(currentStep)
                $(`#step${currentStep}`).slideUp(400, function () {
                    currentStep++;
                    // alert(currentStep)
                    $(`#step${currentStep}`).slideDown(400);
                    updateButtons();
                });
            }
        } else {
            // Final submission
            if (validateStep(currentStep)) {
                submitForm();
            }
        }
    });
    // Show previous step
    $("#prevBtn").click(function (e) {
        e.preventDefault();
        if (currentStep > 1) {
            $(`#step${currentStep}`).slideUp(400, function () {
                currentStep--;
                $(`#step${currentStep}`).slideDown(400);
                updateButtons();
            });
        }
    });

    // AJAX form submission
    function submitForm() {
        const formData = $("#multiStepForm").serialize();
        $.ajax({
            url: '/settings/store',
            method: 'GET',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // If you're using Laravel
            },
            success: function(response) {
                console.log(response);
                alert('Form submitted successfully!');
                // location.reload();
            },
            error: function(error) {
                alert('An error occurred. Please try again.');
                console.log(error);  // Log the error for debugging
            }
        });
        
    }

    // Clear errors on input
    $(".required").on("input", function () {
        $(this).parent().next(".error").hide();
    });
});
