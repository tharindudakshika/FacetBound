import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import ConciergeCTA from '../components/ConciergeCTA.jsx';
import Placeholder from '../components/Placeholder.jsx';
import { homeProducts, collections, unboxingFeatures, testimonials, instagramTiles } from '../data/products.js';
import './Home.css';

const trustItems = [
  {
    label: 'Ethically Sourced Gems',
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
        <circle cx="12" cy="12" r="9" />
        <path d="M3 12h18M12 3c2.5 2.5 3.8 5.7 3.8 9s-1.3 6.5-3.8 9c-2.5-2.5-3.8-5.7-3.8-9s1.3-6.5 3.8-9Z" />
      </svg>
    ),
  },
  {
    label: '925 Sterling Silver',
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
        <path d="M12 3 4 9l8 12 8-12-8-6Z" />
        <path d="M4 9h16M8.5 9 12 21l3.5-12" />
      </svg>
    ),
  },
  {
    label: 'Worldwide Courier Shipping (DHL/FedEx)',
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
        <path d="M21 3 3 10.5l7.2 2.3L12.8 21 21 3Z" />
        <path d="M10.5 13.2 21 3" />
      </svg>
    ),
  },
];

export default function Home() {
  return (
    <>
      <Header cartCount={0} />

      {/* Hero */}
      <section className="home-hero">
        <Placeholder
          variant="dark"
          caption="hero image: hand modeling gemstone ring, natural light"
          boxed
          style={{ minHeight: 420 }}
        />
        <div className="home-hero__copy">
          <h1 className="home-hero__title">Mind by Nature. Shaped by Hand.</h1>
          <p className="home-hero__subtitle">
            Ethically sourced natural Sri Lankan gemstones crafted into 925 sterling silver rings.
          </p>
          <Link to="/shop" className="btn btn-terracotta home-hero__cta">
            Explore Collections
          </Link>
        </div>
      </section>

      {/* Trust bar */}
      <section className="home-trust">
        <div className="container home-trust__grid">
          {trustItems.map((item) => (
            <div className="home-trust__item" key={item.label}>
              <div className="home-trust__icon">{item.icon}</div>
              <div className="home-trust__label">{item.label}</div>
            </div>
          ))}
        </div>
      </section>

      {/* Curated Collections */}
      <section className="home-collections">
        <div className="container">
          <div className="section-head">
            <div className="kicker" style={{ textAlign: 'center' }}>
              Shop
            </div>
            <h2>Curated Collections</h2>
          </div>
          <div className="home-collections__grid">
            {collections.map((col) => (
              <div className="home-collection-card" key={col.name}>
                <div className="home-collection-card__img-wrap">
                  <Placeholder variant="light" caption={col.tag} />
                </div>
                <h3 className="home-collection-card__title">{col.name}</h3>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Brand Story */}
      <section className="home-story">
        <Placeholder
          variant="darker"
          caption="artisan hand-carving silver band, Sri Lanka workshop"
          boxed
          style={{ minHeight: 460 }}
        />
        <div className="home-story__copy">
          <div className="kicker">Our Story</div>
          <h2 className="home-story__heading">The Raw &amp; Refined Journey</h2>
          <p className="home-story__body">
            From the depths of Sri Lankan earth to your finger, each stone is hand-selected, cut, and set by artisan
            hands. What begins as raw, unpolished texture is slowly transformed — faceted, tempered, refined — into
            a quiet luxury meant to be worn every day.
          </p>
          <Link to="/our-story" className="home-story__link">
            Discover Our Roots →
          </Link>
        </div>
      </section>

      {/* Featured Products */}
      <section className="home-featured">
        <div className="container">
          <div className="section-head">
            <div className="kicker" style={{ textAlign: 'center' }}>
              Bestsellers
            </div>
            <h2>Featured Products</h2>
          </div>
          <div className="home-featured__grid">
            {homeProducts.map((p) => (
              <div className="home-product-card" key={p.slug}>
                <Link to={`/product/${p.slug}`} className="home-product-img-wrap">
                  <Placeholder variant="light" caption={p.tag} className="home-product-img" />
                  <div className="home-product-quickview">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                      <circle cx="11" cy="11" r="7" />
                      <path d="m21 21-4.3-4.3" />
                    </svg>
                  </div>
                </Link>
                <h3 className="home-product-name">{p.name}</h3>
                <p className="home-product-price">{p.price}</p>
                <div className="home-product-actions">
                  <button type="button" className="home-btn-sm home-btn-outline-emerald">
                    Add to Cart
                  </button>
                  <a
                    className="home-btn-sm home-btn-whatsapp"
                    href={`https://wa.me/?text=${encodeURIComponent("Hi! I'm interested in the " + p.name)}`}
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <i className="fa-brands fa-whatsapp" />
                    WhatsApp
                  </a>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Unboxing / Sustainability */}
      <section className="home-unboxing">
        <div className="container home-unboxing__grid">
          <div>
            <div className="kicker">Sustainability</div>
            <h2 className="home-unboxing__heading">An Unboxing Rooted in Earth.</h2>
            <p className="home-unboxing__body">
              100% plastic-free, from box to bubble wrap. Every order arrives in a geometric emerald-green wooden box
              with a hint of mitti attar — the scent of Sri Lankan earth after rain.
            </p>
            <div className="home-unboxing__list">
              {unboxingFeatures.map((feature) => (
                <div className="home-unboxing__item" key={feature}>
                  <span className="home-unboxing__dot" />
                  <span className="home-unboxing__label">{feature}</span>
                </div>
              ))}
            </div>
          </div>
          <Placeholder
            variant="dark"
            caption="opened wooden gift box: terracotta inserts, authenticity card"
            boxed
            style={{ border: '1px solid rgba(200,138,117,0.35)', borderRadius: 16, minHeight: 400 }}
          />
        </div>
      </section>

      {/* Testimonials */}
      <section className="home-testimonials">
        <div className="container">
          <div className="section-head">
            <div className="kicker" style={{ textAlign: 'center' }}>
              Reviews
            </div>
            <h2>Loved, Worldwide</h2>
          </div>
          <div className="home-testimonials__grid">
            {testimonials.map((t) => (
              <div className="home-testimonial-card" key={t.name}>
                <div className="stars">
                  {Array.from({ length: 5 }).map((_, i) => (
                    <i className="fa-solid fa-star" key={i} />
                  ))}
                </div>
                <p className="home-testimonial-card__quote">&ldquo;{t.quote}&rdquo;</p>
                <p className="home-testimonial-card__meta">
                  {t.name} — <span>{t.location}</span>
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Instagram grid */}
      <section className="home-instagram">
        <div className="container">
          <div className="home-instagram__head">
            <h2 className="home-instagram__heading">Join the Community</h2>
            <a className="home-instagram__handle" href="#" onClick={(e) => e.preventDefault()}>
              @facetbound.jewelry
            </a>
          </div>
          <div className="home-instagram__grid">
            {instagramTiles.map((tile, i) => (
              <Placeholder key={i} variant="dark" caption={tile} className="home-instagram__tile" />
            ))}
          </div>
        </div>
      </section>

      <ConciergeCTA />
      <Footer />
    </>
  );
}
