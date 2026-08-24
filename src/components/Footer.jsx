import { useState } from 'react';
import { socialLinks, policyLinks, paymentBadges } from '../data/nav.js';
import './Footer.css';

export default function Footer() {
  const [email, setEmail] = useState('');
  const [joined, setJoined] = useState(false);

  function handleJoin(e) {
    e.preventDefault();
    if (!email) return;
    setJoined(true);
    setEmail('');
  }

  return (
    <footer className="fb-footer">
      <div className="container fb-footer__top">
        <div className="fb-footer__brand">
          <div className="fb-footer__wordmark">Facetbound</div>
          <p>Organic luxury, hand-shaped. Ethically sourced Sri Lankan gemstones in 925 sterling silver.</p>
          <div className="fb-footer__social">
            {socialLinks.map((s) => (
              <a href="#" key={s.label} className="fb-footer__social-icon" aria-label={s.label}>
                <i className={s.icon} />
              </a>
            ))}
          </div>
        </div>
        <div className="fb-footer__col">
          <div className="fb-footer__label">Policies</div>
          {policyLinks.map((p) => (
            <a href="#" key={p} className="fb-footer__policy-link">
              {p}
            </a>
          ))}
        </div>
        <div className="fb-footer__col">
          <div className="fb-footer__label">Join the Circle</div>
          <p className="fb-footer__copy">Early access to new drops and 10% off your first order.</p>
          <form className="fb-footer__form" onSubmit={handleJoin}>
            <input
              type="email"
              placeholder="Email address"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              aria-label="Email address"
            />
            <button type="submit">{joined ? 'Joined!' : 'Join'}</button>
          </form>
        </div>
      </div>
      <div className="container fb-footer__bottom">
        <div className="fb-footer__copyright">© 2026 Facetbound. All rights reserved.</div>
        <div className="fb-footer__payments">
          {paymentBadges.map((pb) => (
            <div className="fb-footer__badge" key={pb.name}>
              <i className={pb.icon} />
              <span>{pb.name}</span>
            </div>
          ))}
        </div>
      </div>
    </footer>
  );
}
