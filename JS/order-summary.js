window.onload = function () {
    const confirmTermsCheckbox = document.querySelector('#confirm-terms');
    const paypalButton = document.querySelector('.paypal-button input[type="image"]');
    const paymentErrorMessage = 'Please confirm the terms of use before making the payment.';

    confirmTermsCheckbox.addEventListener('change', (event) => {
        paypalButton.disabled = !event.target.checked;
    });

    paypalButton.addEventListener('click', (event) => {
        if (!confirmTermsCheckbox.checked) {
            event.preventDefault();
            alert(paymentErrorMessage);
        }
    });
}
