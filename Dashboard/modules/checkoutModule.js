// public_portal/js/modules/CheckoutModule.js

export const checkoutModule = {
    // Target the elements you want to hide
    elements: {
        titleBlock: document.querySelector('.project-title'),
        contentCard: document.querySelector('.module-card')
    },

    showDialog(bundleId, bundleName, bundlePrice) {
        // 1. Hide the original package views
        if (this.elements.titleBlock)  this.elements.titleBlock.style.display = 'none';
        if (this.elements.contentCard) this.elements.contentCard.style.display = 'none';

        // 2. Build the structural native HTML <dialog> layout string
        const dialogHTML = `
            <dialog id="checkout-system-dialog" class="checkout-box">
                <!-- Native geometric HTML close cross -->
                <button id="btn-checkout-cancel" class="cancel-cross-btn">&times;</button>
                
                <h1 class="checkout-title">PROJECT<br>ZERON</h1>

                <div class="order-summary-card" style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: left; font-size: 0.95rem; border-left: 3px solid #00ffcc;">
                    <p style="margin: 0 0 5px 0; color: #a0aec0;">Package: <strong style="color: #fff;">${this.escapeHtml(bundleName)}</strong></p>
                    <p style="margin: 0; color: #a0aec0;">Cost: <strong style="color: #00ffcc;">KES ${this.escapeHtml(bundlePrice)}</strong></p>
                </div>
                
                <form id="checkout-submission-form" action="mpesasimulationpage.php" method="POST">
                    <input type="hidden" name="bundle_id" value="${this.escapeHtml(bundleId)}">
                    
                    <div class="input-group">
                        <label for="phone_number">M-Pesa Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="e.g. 0712345678" required autocomplete="off">
                    </div>
                    
                    <button type="submit" class="dash-button" style="width: 100%; margin: 20px 0 0 0; background: #00ffcc; color: #000; font-weight: bold;">PROCEED</button>
                </form>
            </dialog>
        `;

        // 3. Mount it safely directly onto the HTML body structure
        const dialogWrapper = document.createElement('div');
        dialogWrapper.id = 'checkout-dialog-wrapper';
        dialogWrapper.innerHTML = dialogHTML;
        document.body.appendChild(dialogWrapper);

        // 4. Trigger the native browser modal engine open switch
        const nativeDialog = document.getElementById('checkout-system-dialog');
        nativeDialog.showModal(); 

        // 5. Cancel listener mapping
        document.getElementById('btn-checkout-cancel').addEventListener('click', () => {
            this.hideDialog();
        });
    },

    hideDialog() {
        const nativeDialog = document.getElementById('checkout-system-dialog');
        if (nativeDialog) {
            nativeDialog.close(); // Cleanly close the native browser dialogue module
        }

        const activeWrapper = document.getElementById('checkout-dialog-wrapper');
        if (activeWrapper) {
            activeWrapper.remove(); // Wipe the node structure completely
        }

        // Return original screen layers visibility states
        if (this.elements.titleBlock)  this.elements.titleBlock.style.display = '';
        if (this.elements.contentCard) this.elements.contentCard.style.display = '';
    },

    escapeHtml(str) {
        if (!str) return '';
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
    }
};
