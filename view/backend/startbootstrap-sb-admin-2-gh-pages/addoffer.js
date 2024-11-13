document.addEventListener('DOMContentLoaded', function () {
    const formElement = document.getElementById('offerForm');
    const titleField = document.getElementById('title');
    const destinationField = document.getElementById('destination');
    const priceField = document.getElementById('price');

    // Form submission event listener
    formElement.addEventListener('submit', function (e) {
        e.preventDefault();
        resetMessages();
        const formValid = validateFormFields();

        if (formValid) {
            alert("Form submitted successfully!");
            formElement.submit(); // Remove this line if form submission is not required
        }
    });

    // Real-time validation (keyup) for Title, Destination, and Price
    titleField.addEventListener('keyup', function () {
        clearFieldMessage(titleField);
        if (titleField.value.length < 3) {
            displayMessage(titleField, "Title must have at least 3 characters.", "error");
        } else {
            displayMessage(titleField, "Looks good!", "success");
        }
    });

    destinationField.addEventListener('keyup', function () {
        clearFieldMessage(destinationField);
        const validDestination = /^[A-Za-z\s]{3,}$/;
        if (!validDestination.test(destinationField.value)) {
            displayMessage(destinationField, "Destination must be letters only and at least 3 characters.", "error");
        } else {
            displayMessage(destinationField, "Valid destination!", "success");
        }
    });

    priceField.addEventListener('keyup', function () {
        clearFieldMessage(priceField);
        if (isNaN(priceField.value) || priceField.value <= 0) {
            displayMessage(priceField, "Price must be a positive number.", "error");
        } else {
            displayMessage(priceField, "Valid price!", "success");
        }
    });

    // Form fields validation on submit
    function validateFormFields() {
        let formValid = true;
        const titleField = document.getElementById('title');
        const destinationField = document.getElementById('destination');
        const departureField = document.getElementById('departureDate');
        const returnField = document.getElementById('returnDate');
        const priceField = document.getElementById('price');

        if (titleField.value.length < 3) {
            displayMessage(titleField, "Title must contain at least 3 characters.", "error");
            formValid = false;
        } else {
            displayMessage(titleField, "Title is valid.", "success");
        }

        const destinationPattern = /^[A-Za-z\s]{3,}$/;
        if (!destinationPattern.test(destinationField.value)) {
            displayMessage(destinationField, "Destination should only contain letters and spaces and be at least 3 characters long.", "error");
            formValid = false;
        } else {
            displayMessage(destinationField, "Destination is valid.", "success");
        }

        if (!departureField.value) {
            displayMessage(departureField, "Please select a valid departure date.", "error");
            formValid = false;
        } else {
            displayMessage(departureField, "Departure date is valid.", "success");
        }

        if (!returnField.value || new Date(returnField.value) <= new Date(departureField.value)) {
            displayMessage(returnField, "Return date must be after the departure date.", "error");
            formValid = false;
        } else {
            displayMessage(returnField, "Return date is valid.", "success");
        }

        if (isNaN(priceField.value) || priceField.value <= 0) {
            displayMessage(priceField, "Price must be a positive number.", "error");
            formValid = false;
        } else {
            displayMessage(priceField, "Price is valid.", "success");
        }

        return formValid;
    }

    // Show message under fields
    function displayMessage(field, message, type) {
        const messageElement = document.createElement('span');
        messageElement.className = type;
        messageElement.innerText = message;
        field.parentNode.appendChild(messageElement);
    }

    // Clear messages for a specific field
    function clearFieldMessage(field) {
        const existingMessages = field.parentNode.querySelectorAll('span.error, span.success');
        existingMessages.forEach(function (message) {
            message.remove();
        });
    }

    // Reset all messages in the form
    function resetMessages() {
        const allMessages = document.querySelectorAll('span.error, span.success');
        allMessages.forEach(function (message) {
            message.remove();
        });
    }
});

