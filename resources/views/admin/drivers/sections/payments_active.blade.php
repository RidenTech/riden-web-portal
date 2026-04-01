<div class="driver-info-card payments-info-card">
    <div class="driver-info-card-header payments-header-style">
        <i class="bi bi-wallet2"></i>
        <h5>Payment Methods</h5>
    </div>
    
    <div class="payments-content-container p-4">
        <!-- Primary Methods Section -->
        <div class="payment-category-section mb-4">
            <h6 class="payment-category-title">Primary Methods</h6>
            
            <div class="payment-item-row">
                <div class="payment-method-info">
                    <span class="bank-name">Royal Bank of Canada</span>
                </div>
                <div class="masked-card-number">********234</div>
            </div>

            <div class="payment-item-row">
                <div class="payment-method-info">
                    <div class="payment-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d6/Visa_2021.svg" alt="Visa" onerror="this.src='https://logos-world.net/wp-content/uploads/2020/04/Visa-Logo.png'">
                    </div>
                    <span class="bank-name">Visa</span>
                </div>
                <div class="masked-card-number">********234</div>
            </div>

            <div class="payment-item-row">
                <div class="payment-method-info">
                    <div class="payment-logo apple-pay">
                        <i class="bi bi-apple"></i>
                        <span>Pay</span>
                    </div>
                    <span class="bank-name">Apple Pay</span>
                </div>
                <div class="masked-card-number">********234</div>
            </div>
        </div>

        <!-- Other Methods Section -->
        <div class="payment-category-section">
            <h6 class="payment-category-title">Other Methods</h6>
            
            <div class="payment-item-row">
                <div class="payment-method-info">
                    <span class="bank-name">Canadian Western Bank</span>
                </div>
                <div class="masked-card-number">********234</div>
            </div>

            <div class="payment-item-row">
                <div class="payment-method-info">
                    <div class="payment-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard">
                    </div>
                    <span class="bank-name">Mastercard</span>
                </div>
                <div class="masked-card-number">********234</div>
            </div>
        </div>
    </div>
</div>

<style>
.payments-header-style {
    background: #D10000 !important;
    color: white !important;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.payments-header-style i {
    color: white !important;
}

.payment-category-title {
    color: #D10000;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 20px;
}

.payment-item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 0;
    border-bottom: 1px solid #F3F4F6;
}

.payment-item-row:last-child {
    border-bottom: none;
}

.payment-method-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.payment-logo {
    width: 45px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #F9FAFB;
    border-radius: 4px;
    border: 1px solid #E5E7EB;
    overflow: hidden;
    padding: 2px;
}

.payment-logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.apple-pay {
    background: #000;
    color: white;
    font-size: 14px;
    font-weight: 600;
    border: none;
    gap: 2px;
}
.apple-pay i { font-size: 16px; }

.bank-name {
    font-size: 15px;
    font-weight: 600;
    color: #111;
}

.masked-card-number {
    font-size: 14px;
    color: #4B5563;
    font-weight: 500;
    letter-spacing: 1px;
}
</style>
