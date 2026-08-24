import { useState } from 'react';
import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import Placeholder from '../components/Placeholder.jsx';
import { categories, articles, featuredArticle } from '../data/journal.js';
import './Journal.css';

export default function Journal() {
  const [category, setCategory] = useState('All Stories');
  const [email, setEmail] = useState('');
  const [subscribed, setSubscribed] = useState(false);

  const filtered =
    category === 'All Stories' ? articles : articles.filter((a) => a.category === category);

  function handleSubscribe(e) {
    e.preventDefault();
    if (!email) return;
    setSubscribed(true);
    setEmail('');
  }

  return (
    <>
      <Header />

      {/* Page Header */}
      <section className="journal-page-header">
        <h1>The Facetbound Journal</h1>
        <p>
          Notes on Sri Lankan gemology, artisan silversmithing, and the raw beauty of earth's
          creations.
        </p>
      </section>

      {/* Featured Article */}
      <section className="journal-featured-section">
        <div className="container">
          <div className="journal-featured">
            <Placeholder
              variant="light"
              boxed
              caption={featuredArticle.tag}
              style={{ minHeight: 440 }}
            />
            <div className="journal-featured-body">
              <span className="journal-featured-badge">{featuredArticle.badge}</span>
              <h2>{featuredArticle.title}</h2>
              <p>{featuredArticle.excerpt}</p>
              <Link to={`/journal/${featuredArticle.slug}`} className="btn btn-terracotta journal-featured-cta">
                Read the Full Story
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Category Nav */}
      <section className="journal-category-nav-section">
        <div className="container">
          <nav className="journal-category-nav">
            {categories.map((label) => (
              <span
                key={label}
                className={`journal-category-item${category === label ? ' journal-category-item--active' : ''}`}
                onClick={() => setCategory(label)}
              >
                {label}
              </span>
            ))}
          </nav>
        </div>
      </section>

      {/* Journal Grid */}
      <section className="journal-grid-section">
        <div className="container">
          <div className="journal-grid">
            {filtered.map((a) => (
              <Link to={`/journal/${a.slug}`} className="journal-card" key={a.slug}>
                <Placeholder
                  variant="light"
                  caption={a.tag}
                  style={{ borderRadius: 12, height: 240 }}
                />
                <div className="journal-card-body">
                  <span className="journal-card-meta">
                    {a.date} &bull; {a.category}
                  </span>
                  <h3>{a.title}</h3>
                  <span className="journal-card-link">
                    Read <i className="fa-solid fa-arrow-right" />
                  </span>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Newsletter */}
      <section className="journal-newsletter">
        <div className="journal-newsletter-inner">
          <h2>Join the Collector's Circle</h2>
          <p>
            Get early access to our rarest raw gemstone drops and exclusive artisan stories
            directly to your inbox.
          </p>
          <form className="journal-newsletter-form" onSubmit={handleSubscribe}>
            <input
              type="email"
              placeholder="Your email address"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="journal-newsletter-input"
              required
            />
            <button type="submit" className="journal-newsletter-btn">
              {subscribed ? 'Subscribed!' : 'Subscribe'}
            </button>
          </form>
        </div>
      </section>

      <Footer />
    </>
  );
}
