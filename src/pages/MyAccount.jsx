import { useState } from 'react';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import ConciergeCTA from '../components/ConciergeCTA.jsx';
import Placeholder from '../components/Placeholder.jsx';
import { orders, vaultItems } from '../data/account.js';
import './MyAccount.css';

const sidebarLinks = [
  { id: 'dashboard', icon: 'fa-solid fa-gauge', label: 'Dashboard' },
  { id: 'orders', icon: 'fa-solid fa-box', label: 'Orders' },
  { id: 'vault', icon: 'fa-solid fa-gem', label: 'My Vault' },
  { id: 'addresses', icon: 'fa-solid fa-location-dot', label: 'Addresses' },
  { id: 'details', icon: 'fa-regular fa-user', label: 'Account Details' },
];

function DashboardPanel() {
  return (
    <>
      <h2 className="account-panel-title">Dashboard</h2>
      <div className="account-dash-grid">
        <div className="account-card">
          <i className="fa-solid fa-box account-card-icon" />
          <div className="account-card-title">Latest Order Status</div>
          <p className="account-card-body">Order #FB-8042 &middot; Processing / Shipped via DHL</p>
          <button type="button" className="account-btn account-btn-emerald">
            Track Shipment
          </button>
        </div>
        <div className="account-card">
          <i className="fa-solid fa-scroll account-card-icon" />
          <div className="account-card-title">Digital Authenticity Certificates</div>
          <p className="account-card-body">View &amp; download PDF certificates for your gemstones.</p>
          <button type="button" className="account-btn account-btn-outline-emerald">
            View Certificates
          </button>
        </div>
        <div className="account-card account-card--highlight">
          <i className="fa-solid fa-seedling account-card-icon" />
          <div className="account-card-title">Scent Refill Claim</div>
          <p className="account-card-body">Eligible for a complimentary Mitti Attar refill on your next drop.</p>
          <button type="button" className="account-btn account-btn-terracotta">
            Claim Refill
          </button>
        </div>
      </div>
    </>
  );
}

function OrdersPanel() {
  return (
    <>
      <h2 className="account-panel-title">Orders &amp; Live Tracking</h2>
      <div className="account-orders-list">
        {orders.map((o) => (
          <div className="account-order-card" key={o.id}>
            <div className="account-order-head">
              <div className="account-order-id">
                {o.id} <span className="account-order-date">&middot; {o.date}</span>
              </div>
              <span className="account-order-status" style={{ borderColor: o.badgeColor, color: o.badgeColor }}>
                {o.status}
              </span>
            </div>
            <div className="account-order-body">
              <Placeholder variant="light" caption="ring" style={{ width: 72, height: 72, borderRadius: 10, flexShrink: 0 }} />
              <div>
                <div className="account-order-product">{o.product}</div>
                <div className="account-order-specs">{o.specs}</div>
              </div>
            </div>
            <div className="account-order-actions">
              <button type="button" className="account-btn account-btn-emerald">
                Track Courier
              </button>
              <button type="button" className="account-btn account-btn-outline-slate">
                Download Invoice
              </button>
              <button type="button" className="account-btn account-btn-outline-slate">
                Download Gem Certificate
              </button>
            </div>
          </div>
        ))}
      </div>
    </>
  );
}

function VaultPanel() {
  return (
    <>
      <h2 className="account-panel-title account-panel-title--tight">My Facetbound Vault</h2>
      <p className="account-panel-sub">Your Curated Gems &mdash; a digital record of every piece you&rsquo;ve acquired.</p>
      <div className="account-vault-grid">
        {vaultItems.map((v) => (
          <div className="account-vault-card" key={v.name}>
            <Placeholder variant="light" caption={v.tag} style={{ height: 200 }} />
            <div className="account-vault-card-body">
              <div className="account-vault-name">{v.name}</div>
              <div className="account-vault-acquired">Acquired {v.acquired}</div>
            </div>
          </div>
        ))}
      </div>
      <div className="account-milestone">
        <div className="kicker">Next Milestone</div>
        <p className="account-milestone-text">
          Complete your collection with a handcrafted Natural Spinel or Amethyst Accent Band.
        </p>
        <button type="button" className="account-btn account-btn-terracotta">
          Explore Accent Bands
        </button>
      </div>
    </>
  );
}

function AddressesPanel() {
  return (
    <>
      <h2 className="account-panel-title">Addresses</h2>
      <div className="account-addresses-grid">
        <div className="account-card account-address-card">
          <div className="account-address-label">Shipping Address</div>
          <div className="account-address-block">
            Rachel Hartley
            <br />
            1420 Redbud Lane, Apt 3B
            <br />
            Austin, TX 78704
            <br />
            United States
          </div>
          <button type="button" className="account-btn account-btn-outline-emerald account-address-edit">
            Edit Address
          </button>
        </div>
        <div className="account-card account-address-card">
          <div className="account-address-label">Billing Address</div>
          <div className="account-address-block">Same as shipping address.</div>
          <button type="button" className="account-btn account-btn-outline-emerald account-address-edit">
            Edit Address
          </button>
        </div>
      </div>
      <label className="account-checkbox-row">
        <input type="checkbox" />
        Save a secondary address for direct gifting.
      </label>
    </>
  );
}

function DetailsPanel() {
  return (
    <>
      <h2 className="account-panel-title">Account Details</h2>
      <div className="account-card account-details-card">
        <div className="account-details-row account-details-row--2col">
          <div className="account-field">
            <label className="account-field-label">First Name</label>
            <input type="text" className="account-input" defaultValue="Rachel" />
          </div>
          <div className="account-field">
            <label className="account-field-label">Last Name</label>
            <input type="text" className="account-input" defaultValue="Hartley" />
          </div>
        </div>
        <div className="account-field">
          <label className="account-field-label">Email Address</label>
          <input type="email" className="account-input" defaultValue="rachel.hartley@email.com" />
        </div>
        <div className="account-field">
          <label className="account-field-label">Current Password</label>
          <input type="password" className="account-input" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
        </div>
        <div className="account-field">
          <label className="account-field-label">New Password</label>
          <input type="password" className="account-input" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
        </div>
        <button type="button" className="account-btn account-btn-terracotta account-save-btn">
          Save Changes
        </button>
      </div>
    </>
  );
}

export default function MyAccount() {
  const [tab, setTab] = useState('dashboard');

  return (
    <>
      <Header accountActive={true} />

      {/* Welcome / VIP Banner */}
      <section className="account-banner">
        <Placeholder variant="dark" style={{ position: 'absolute', inset: 0 }} />
        <div className="account-banner-scrim" />
        <div className="container account-banner-content">
          <div className="account-banner-badge">
            <i className="fa-solid fa-gem" style={{ fontSize: 11 }} />
            Facetbound Collector Member
          </div>
          <h1 className="account-banner-title">Welcome back, Rachel</h1>
          <div className="account-banner-status">
            <i className="fa-solid fa-plane" style={{ color: 'var(--terracotta)', fontSize: 13 }} />
            You have 1 Active Express Shipment in transit.
          </div>
        </div>
      </section>

      {/* Main Grid */}
      <section className="account-main">
        <div className="container account-main-grid">
          <aside className="account-sidebar">
            {sidebarLinks.map((link) => (
              <div
                key={link.id}
                className={`account-sidebar-row ${tab === link.id ? 'account-sidebar-row--active' : ''}`}
                onClick={() => setTab(link.id)}
              >
                <i className={link.icon} style={{ width: 16 }} />
                {link.label}
              </div>
            ))}
            <div className="account-sidebar-row" onClick={() => {}}>
              <i className="fa-solid fa-arrow-right-from-bracket" style={{ width: 16 }} />
              Logout
            </div>
          </aside>

          <div className="account-content">
            {tab === 'dashboard' && <DashboardPanel />}
            {tab === 'orders' && <OrdersPanel />}
            {tab === 'vault' && <VaultPanel />}
            {tab === 'addresses' && <AddressesPanel />}
            {tab === 'details' && <DetailsPanel />}
          </div>
        </div>
      </section>

      <ConciergeCTA />
      <Footer />
    </>
  );
}
