import { Link } from 'react-router-dom';
import { navLinks } from '../data/nav.js';
import './Header.css';

export default function Header({ cartCount = 0, showSsl = false, accountActive = false }) {
  return (
    <header className="fb-header">
      <div className="container fb-header__row">
        <Link to="/" className="fb-header__wordmark">
          Facetbound
        </Link>
        <nav className="fb-header__nav">
          {navLinks.map((link) => (
            <Link key={link.label} to={link.href} className="fb-header__link">
              {link.label}
            </Link>
          ))}
        </nav>
        <div className="fb-header__icons">
          {showSsl && (
            <div className="fb-header__ssl">
              <i className="fa-solid fa-lock" />
              <span>SSL Encrypted</span>
            </div>
          )}
          <i className="fa-solid fa-magnifying-glass fb-header__icon" title="Search" />
          <Link to="/account" title="Account">
            <i
              className={accountActive ? 'fa-regular fa-user fb-header__icon fb-header__icon--active' : 'fa-regular fa-user fb-header__icon'}
            />
          </Link>
          <div className="fb-header__cart">
            <i className="fa-solid fa-bag-shopping fb-header__icon" title="Cart" />
            {cartCount > 0 && <div className="fb-header__cart-badge">{cartCount}</div>}
          </div>
        </div>
      </div>
    </header>
  );
}
