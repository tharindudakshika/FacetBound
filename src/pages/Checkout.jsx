import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import ConciergeCTA from '../components/ConciergeCTA.jsx';
import Placeholder from '../components/Placeholder.jsx';
import './Checkout.css';

function stop(e) {
  e.preventDefault();
}

export default function Checkout() {
  return (
    <>
      <Header showSsl={true} />

      {/* Hero */}
      <section className="checkout-hero">
        <Placeholder variant="dark" style={{ position: 'absolute', inset: 0 }} />
        <div className="checkout-hero__scrim" />
        <div className="container checkout-hero__content">
          <div style={{ maxWidth: 640 }}>
            <h1 className="checkout-hero__title">Secure Checkout</h1>
            <p className="checkout-hero__subtitle">
              You&apos;re one step away from your handcrafted Facetbound ring.
            </p>
          </div>
        </div>
      </section>

      {/* Main two-column */}
      <div className="container checkout-main">
        {/* LEFT COLUMN */}
        <div className="checkout-left">
          {/* Express checkout */}
          <div className="checkout-express">
            <button type="button" className="checkout-btn-paypal">
              Express Checkout with PayPal
            </button>
            <button type="button" className="checkout-btn-wallet">
              <i className="fa-brands fa-apple" />
              <span> / </span>
              <i className="fa-brands fa-google" />
              <span>Express Checkout with Apple Pay / Google Pay</span>
            </button>
          </div>

          {/* Divider */}
          <div className="checkout-divider">
            <div className="checkout-divider__line" />
            <span className="checkout-divider__text">OR CONTINUE WITH STANDARD CHECKOUT</span>
            <div className="checkout-divider__line" />
          </div>

          <form onSubmit={stop}>
            {/* Contact Information */}
            <section className="checkout-section">
              <h2 className="checkout-section__title">Contact Information</h2>
              <div className="checkout-grid-2">
                <input type="email" className="checkout-input" placeholder="Email Address" />
                <input type="tel" className="checkout-input" placeholder="Phone Number" />
              </div>
              <p className="checkout-helper">Used for order updates &amp; DHL/FedEx tracking SMS.</p>
            </section>

            {/* Shipping Address */}
            <section className="checkout-section">
              <h2 className="checkout-section__title">Shipping Address</h2>
              <div className="checkout-field-col">
                <div className="checkout-grid-2">
                  <input type="text" className="checkout-input" placeholder="First Name" />
                  <input type="text" className="checkout-input" placeholder="Last Name" />
                </div>

                <div className="checkout-field">
                  <label className="checkout-label" htmlFor="checkout-dob">
                    Date of Birth
                  </label>
                  <input type="date" id="checkout-dob" className="checkout-input" />
                </div>

                <input type="text" className="checkout-input" placeholder="Street Address" />
                <input type="text" className="checkout-input" placeholder="Apartment / Suite (Optional)" />

                <select className="checkout-input checkout-select" defaultValue="US">
                  <option value="US">United States</option>
                  <option value="GB">United Kingdom</option>
                  <option value="CA">Canada</option>
                  <option value="AU">Australia</option>
                </select>

                <div className="checkout-grid-3">
                  <input type="text" className="checkout-input" placeholder="City" />
                  <input type="text" className="checkout-input" placeholder="State" />
                  <input type="text" className="checkout-input" placeholder="ZIP Code" />
                </div>

                <div className="checkout-checkbox-row">
                  <input type="checkbox" id="checkout-save-info" style={{ accentColor: 'var(--terracotta)' }} />
                  <label htmlFor="checkout-save-info" className="checkout-checkbox-label">
                    Save this information for next time
                  </label>
                </div>
              </div>
            </section>

            {/* Shipping Method */}
            <section className="checkout-section">
              <h2 className="checkout-section__title">Shipping Method</h2>
              <div className="checkout-shipping-option">
                <input type="radio" checked disabled readOnly />
                <div>
                  <div className="checkout-shipping-option__title">
                    Free Express Worldwide Shipping — 5–7 Business Days (DHL / FedEx Insured)
                  </div>
                  <p className="checkout-shipping-option__note">
                    Includes full tracking number and custom insurance for high-value gemstone products.
                  </p>
                </div>
              </div>
            </section>

            {/* Payment */}
            <section className="checkout-section">
              <h2 className="checkout-section__title">Payment</h2>
              <div className="checkout-payment">
                <div className="checkout-payment__row checkout-payment__row--selected">
                  <div className="checkout-payment__header">
                    <label className="checkout-payment__label">
                      <input type="radio" name="pay" defaultChecked />
                      Credit / Debit Card
                    </label>
                    <div className="checkout-card-icons">
                      <i className="fa-brands fa-cc-visa" />
                      <i className="fa-brands fa-cc-mastercard" />
                      <i className="fa-brands fa-cc-amex" />
                      <i className="fa-brands fa-cc-discover" />
                    </div>
                  </div>
                  <div className="checkout-card-form">
                    <input type="text" className="checkout-input" placeholder="Card Number" />
                    <div className="checkout-grid-2">
                      <input type="text" className="checkout-input" placeholder="Expiration Date (MM/YY)" />
                      <input type="text" className="checkout-input" placeholder="CVV" />
                    </div>
                    <input type="text" className="checkout-input" placeholder="Cardholder Name" />
                  </div>
                </div>

                <div className="checkout-payment__row">
                  <label className="checkout-payment__label">
                    <input type="radio" name="pay" />
                    PayPal Express Checkout
                  </label>
                </div>

                <div className="checkout-payment__row checkout-payment__row--split">
                  <label className="checkout-payment__label">
                    <input type="radio" name="pay" />
                    Buy Now, Pay Later — Klarna / Afterpay
                  </label>
                  <span className="checkout-payment__note">4 interest-free installments</span>
                </div>
              </div>
            </section>
          </form>
        </div>

        {/* RIGHT COLUMN — ORDER SUMMARY */}
        <aside className="checkout-summary">
          <h2 className="checkout-summary__title">Order Summary</h2>

          <div className="checkout-lineitem">
            <Placeholder
              variant="light"
              caption="ring + box"
              style={{ width: 84, height: 84, borderRadius: 10, flexShrink: 0 }}
            />
            <div className="checkout-lineitem__body">
              <h3 className="checkout-lineitem__title">The Raw-Edge Blue Topaz Solitaire Ring</h3>
              <p className="checkout-lineitem__specs">
                Size: US 7 · Metal: 925 Sterling Silver
                <br />
                Engraving: &quot;Forever &amp; Always&quot;
              </p>
              <p className="checkout-lineitem__price">$165.00</p>
            </div>
          </div>

          <div className="checkout-promo">
            <input type="text" className="checkout-input checkout-promo__input" placeholder="Discount Code / Gift Card" />
            <button type="button" className="checkout-promo__btn">
              Apply
            </button>
          </div>

          <div className="checkout-totals">
            <div className="checkout-totals__row">
              <span>Subtotal</span>
              <span>$165.00</span>
            </div>
            <div className="checkout-totals__row">
              <span>Shipping</span>
              <span className="checkout-totals__free">FREE (Worldwide Insured)</span>
            </div>
            <div className="checkout-totals__row">
              <span>Estimated Taxes</span>
              <span>$0.00</span>
            </div>
          </div>

          <div className="checkout-total-row">
            <span className="checkout-total-row__label">Total</span>
            <span className="checkout-total-row__value">
              $165.00 <span className="checkout-total-row__currency">USD</span>
            </span>
          </div>

          <button type="button" className="btn btn-terracotta checkout-place-order">
            <i className="fa-solid fa-lock" />
            PLACE ORDER — $165.00 USD
          </button>

          <div className="checkout-guarantees">
            <div className="checkout-guarantee">
              <i className="fa-solid fa-scroll" />
              <p>Gemologist Authenticity Certificate: Included with every Sri Lankan natural gemstone.</p>
            </div>
            <div className="checkout-guarantee">
              <i className="fa-solid fa-box" />
              <p>Unboxing Guarantee: Ships in handcrafted Teak Wood Box with Mitti Attar scent experience.</p>
            </div>
            <div className="checkout-guarantee">
              <i className="fa-solid fa-rotate" />
              <p>30-Day Hassle-Free Size Exchange Policy</p>
            </div>
            <div className="checkout-guarantee">
              <i className="fa-solid fa-plane" />
              <p>100% Insured Delivery: Fully covered against loss or damage during courier transit.</p>
            </div>
          </div>
        </aside>
      </div>

      <ConciergeCTA />
      <Footer />
    </>
  );
}
