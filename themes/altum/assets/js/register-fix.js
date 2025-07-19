'use strict';

// Fix for register button submit issue
document.addEventListener('DOMContentLoaded', function() {
    // Define a function to manually submit a form
    function submitForm(form) {
        // Create a hidden submit button
        const hiddenSubmit = document.createElement('input');
        hiddenSubmit.type = 'submit';
        hiddenSubmit.style.display = 'none';
        form.appendChild(hiddenSubmit);
        
        // Click the button to submit the form
        hiddenSubmit.click();
        
        // Clean up
        form.removeChild(hiddenSubmit);
    }
    
    // Define gtag_report_conversion if it doesn't exist
    if (typeof window.gtag_report_conversion !== 'function') {
        window.gtag_report_conversion = function() {
            console.log('Analytics conversion tracked');
            return true;
        };
    }
    
    // Find the register button
    const registerButton = document.querySelector('button.btn.btn-primary.btn-block');
    
    if (registerButton && registerButton.textContent.includes('Register')) {
        // Remove all existing click event listeners
        const newButton = registerButton.cloneNode(true);
        registerButton.parentNode.replaceChild(newButton, registerButton);
        
        // Add our own click event listener
        newButton.addEventListener('click', function(event) {
            // Prevent default to avoid any errors
            event.preventDefault();
            
            // Track conversion
            if (typeof window.gtag_report_conversion === 'function') {
                window.gtag_report_conversion();
            }
            
            // Get the form
            const form = this.closest('form');
            
            // Submit the form after a delay
            setTimeout(function() {
                if (form) {
                    submitForm(form);
                }
            }, 300);
        });
    }
});