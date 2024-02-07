//Custom Error


// For Input fields
document.querySelector('#registerForm').addEventListener('submit', function(event) {
    var inputs = document.querySelectorAll('#registerForm input[required]');
    var allInputsValid = true;

    inputs.forEach(function(input) {
        var errorDiv = input.parentNode.querySelector('.text-red-500');

        if (input.value.trim() === '') {
            event.preventDefault();
            errorDiv.textContent = 'This field is required.';
            allInputsValid = false;
        } else {
            errorDiv.textContent = '';
        }
    });


    //For Terms Of Service Checkbox
    var termsCheckbox = document.querySelector('#terms');
    var termsError = document.querySelector('#termsError');

    if (!termsCheckbox.checked) {
        event.preventDefault();
        termsError.classList.remove('hidden');
        allInputsValid = false;
    } else {
        termsError.classList.add('hidden');
    }

    if (!allInputsValid) {
        event.preventDefault();
    }
});
