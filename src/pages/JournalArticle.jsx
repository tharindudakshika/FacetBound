import { useState } from 'react';
import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import Placeholder from '../components/Placeholder.jsx';
import { articles } from '../data/journal.js';
import './JournalArticle.css';

const RELATED_SLUGS = [
  'reading-a-spinel-inclusions-colour-zones-fire',
  'the-hammer-and-the-anvil',
  'open-back-bezels',
];

export default function JournalArticle() {
  const [email, setEmail] = useState('');
  const [subscribed, setSubscribed] = useState(false);

  const related = RELATED_SLUGS.map((slug) => articles.find((a) => a.slug === slug)).filter(
    Boolean
  );

  function handleSubscribe(e) {
    e.preventDefault();
    if (!email) return;
    setSubscribed(true);
    setEmail('');
  }

  return (
    <>
      <Header />

      {/* Article Header */}
      <section className="article-header">
        <span className="article-badge">Ethical Sourcing &middot; Gemology 101</span>
        <h1>
          The Journey of a Natural Spinel: From Ratnapura Mining to Handcrafted Silver Ring
        </h1>
        <div className="article-meta">
          By FACETBOUND Lead Gemologist &bull; August 2026 &bull; 5 min read
        </div>
      </section>

      {/* Banner */}
      <section className="article-banner-section">
        <div className="container">
          <Placeholder
            variant="light"
            boxed
            caption="banner: raw Spinel crystal in a Ratnapura gem pit"
            style={{ borderRadius: 16, height: 460 }}
          />
        </div>
      </section>

      {/* Body + Sidebar */}
      <section className="article-body-section">
        <div className="container article-body-grid">
          <article className="article-content">
            <p className="article-lead">
              Sri Lanka has been called Ratna-Dweepa — the Island of Gems — for well over two
              thousand years. Its riverbeds and alluvial pits still give up sapphire, garnet,
              moonstone and, most quietly prized of all, Spinel: a stone long mistaken for ruby,
              and one that almost never requires treatment to reach its finest colour.
            </p>

            <p className="article-p">
              That last detail matters more than it sounds. A natural, unheated Spinel is exactly
              what the earth made — its colour, its inclusions, its faint internal weather all
              original. Nothing about it has been corrected.
            </p>

            <h2 className="article-h2">Artisanal Mining vs Industrial Mass Production</h2>

            <p className="article-p">
              The pits around Ratnapura are dug by hand, timbered by hand, and worked by small
              teams who have often held the same claim for generations. A shaft is narrow,
              seasonal, and refilled when it is spent. Nothing is dredged; no riverbank is
              stripped; no tailings pond is left behind.
            </p>

            <p className="article-p article-p--tight">
              Industrial extraction works the opposite way — volume first, landscape second. We
              buy only from traditional small-scale miners, in person, at the pit or the morning
              market, because it is the only method that leaves the river as it was and pays the
              person who found the stone.
            </p>

            <Placeholder
              variant="light"
              boxed
              caption="macro: rough Spinel on the lapidary wheel"
              style={{ borderRadius: 14, height: 320, marginBottom: 14 }}
            />
            <div className="article-image-caption">
              A rough Spinel meeting the wheel for the first time — the cut is judged to the
              stone, not to a template.
            </div>

            <blockquote className="article-pull-quote">
              <p>
                "Every natural Spinel carries the fingerprint of the earth — no two rings will
                ever be identical."
              </p>
            </blockquote>

            <h2 className="article-h2">The Art of Hand-Hammering 925 Sterling Silver</h2>

            <p className="article-p">
              A hammered band begins as a plain length of 925 sterling. The silversmith works it
              over a polished steel stake, strike by strike, until the surface holds hundreds of
              shallow facets that catch light from every angle. The pattern cannot be
              programmed — the rhythm of the hand is what makes it read as handmade.
            </p>

            <p className="article-p article-p--tight">
              Tree bark texture is slower still: the band is scored, annealed, and re-worked so
              the ridges run with the grain of the metal rather than across it. Only then is the
              bezel raised and the stone set open-backed, so light passes straight through the
              Spinel and onto the skin.
            </p>

            <div className="article-product-embed">
              <Placeholder
                variant="light"
                caption="macro: Spinel ring"
                style={{ borderRadius: 10, width: 132, height: 132, flexShrink: 0 }}
              />
              <div className="article-product-info">
                <span className="article-product-kicker">Featured Piece</span>
                <h3 className="article-product-title">The Artisanal Raw-Edge Spinel Ring</h3>
                <p className="article-product-sub">
                  925 Sterling Silver &middot; Natural Untreated Spinel
                </p>
                <Link to="/shop" className="btn btn-terracotta article-product-cta">
                  View Ring Details
                </Link>
              </div>
            </div>

            <p className="article-p article-p--wide">
              From pit to finger the stone passes perhaps six pairs of hands, all of them local,
              none of them a machine. That is the whole argument for making jewellery this way:
              the result is slower, scarcer, and unrepeatable.
            </p>

            <div className="article-share-row">
              <div className="article-share-label">Share this story</div>
              <div className="article-share-chips">
                <a href="#" className="article-share-chip">
                  <i className="fa-brands fa-pinterest-p" /> Pinterest
                </a>
                <a href="#" className="article-share-chip">
                  <i className="fa-brands fa-facebook-f" /> Facebook
                </a>
                <a href="#" className="article-share-chip">
                  <i className="fa-brands fa-x-twitter" /> X
                </a>
                <a href="#" className="article-share-chip">
                  <i className="fa-solid fa-envelope" /> Email
                </a>
              </div>
            </div>

            <div className="article-author-bio">
              <div className="article-author-avatar">
                <i className="fa-solid fa-gem" />
              </div>
              <div className="article-author-info">
                <span className="article-author-kicker">Written by</span>
                <div className="article-author-name">FACETBOUND Gemological Team</div>
                <p className="article-author-text">
                  Our in-house gemologists and silversmiths in Sri Lanka, writing on the stones
                  they select and the bands they raise by hand.
                </p>
              </div>
            </div>
          </article>

          <aside className="article-sidebar">
            <div className="article-widget">
              <div className="article-widget-wordmark">Facetbound</div>
              <p className="article-widget-blurb">
                Mined by Nature, Shaped by Hand. Ethically sourced Sri Lankan gemstones set in 925
                sterling silver.
              </p>
              <Link to="/our-story" className="article-widget-link">
                Our Story <i className="fa-solid fa-arrow-right" />
              </Link>
            </div>

            <div className="article-widget article-widget--ethics">
              <span className="article-widget-kicker">Ethics &amp; Packaging</span>
              <h3 className="article-widget-title">100% plastic-free, start to finish.</h3>
              <ul className="article-widget-bullets">
                <li>
                  <span className="article-dot" />
                  Octagonal teak wood keepsake box
                </li>
                <li>
                  <span className="article-dot" />
                  Terracotta board insert, no plastic foam
                </li>
                <li>
                  <span className="article-dot" />
                  Mitti Attar — the scent of rain on earth
                </li>
              </ul>
            </div>

            <div className="article-widget">
              <span className="article-widget-label">Related Gem Guides</span>
              <div className="article-widget-links">
                <a href="#" className="article-widget-guide-link">
                  How to Care for 925 Sterling Silver Rings
                </a>
                <a href="#" className="article-widget-guide-link">
                  Spinel vs Sapphire: Which Gem Suits Your Energy?
                </a>
              </div>
            </div>
          </aside>
        </div>
      </section>

      {/* Related Articles */}
      <section className="article-related-section">
        <div className="container">
          <h2 className="article-related-heading">
            Explore More Stories from the Mine &amp; Studio
          </h2>
          <div className="article-related-grid">
            {related.map((a) => (
              <Link to={`/journal/${a.slug}`} className="article-related-card" key={a.slug}>
                <Placeholder
                  variant="light"
                  caption={a.tag}
                  style={{ borderRadius: 12, height: 220 }}
                />
                <div className="article-related-body">
                  <h3>{a.title}</h3>
                  <span className="article-related-readtime">{a.readTime || '5 min read'}</span>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Newsletter */}
      <section className="article-newsletter">
        <div className="article-newsletter-inner">
          <h2>
            Love Gemology &amp; Handcrafted Fine Jewelry? Join the Collector's Circle for Private
            Gem Drops.
          </h2>
          <form className="article-newsletter-form" onSubmit={handleSubscribe}>
            <input
              type="email"
              placeholder="Your email address"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="article-newsletter-input"
              required
            />
            <button type="submit" className="article-newsletter-btn">
              {subscribed ? 'Subscribed!' : 'Subscribe'}
            </button>
          </form>
        </div>
      </section>

      <Footer />
    </>
  );
}
