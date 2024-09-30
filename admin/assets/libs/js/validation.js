// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function(form) {
            var password = form.querySelector('#password');
            var confirmPassword = form.querySelector('#cpassword');
            var confirmPasswordFeedback = form.querySelector('#confirmPasswordFeedback');

            if (confirmPassword){
                // Function to check if passwords match
                function checkPasswordMatch() {
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.classList.add('is-invalid');
                        confirmPasswordFeedback.style.display = 'block';
                    } else {
                        confirmPassword.classList.remove('is-invalid');
                        confirmPassword.classList.add('is-valid');
                        confirmPasswordFeedback.style.display = 'none';
                    }
                }

                // Attach keyup event listener to both password and confirm password fields
                password.addEventListener('keyup', checkPasswordMatch);
                confirmPassword.addEventListener('keyup', checkPasswordMatch);
            }

            form.addEventListener('submit', function(event) {
                var isValid = form.checkValidity(); // Bootstrap's validation

                if (confirmPassword){
                    // Check if passwords match on form submit
                    if (password.value !== confirmPassword.value) {
                        isValid = false; // Set form as invalid if passwords don't match
                        confirmPassword.classList.add('is-invalid');
                        confirmPasswordFeedback.style.display = 'block';
                    }
                }

                // If form is invalid, prevent submission
                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
                
            }, false);
        });
    }, false);
})();