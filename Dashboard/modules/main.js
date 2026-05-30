import { checkoutModule } from './CheckoutModule.js';

const buyButtons = document.querySelectorAll('.buy-action-trigger');

buyButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        // Find the specific card wrapper enclosing this clicked button
        const cardWrapper = event.target.closest('.client-card');
        
        // Read data safely from the wrapper boundary context
        const bundleId    = cardWrapper.getAttribute('data-id');
        const bundleName  = cardWrapper.getAttribute('data-name');
        const bundlePrice = cardWrapper.getAttribute('data-price');

        checkoutModule.showDialog(bundleId, bundleName, bundlePrice);
    });
});
