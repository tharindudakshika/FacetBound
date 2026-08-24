import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import ConciergeCTA from '../components/ConciergeCTA.jsx';
import Hero from '../components/Hero.jsx';
import Placeholder from '../components/Placeholder.jsx';
import { shopProducts, shopFilters, sortOptions, assurances } from '../data/products.js';
import './ShopCollection.css';

function ProductCard({ p }) {
  return (
    <div className="shopcol-card">
      <Link to={`/product/${p.slug}`} className="shopcol-card-img">
        <Placeholder
          variant="light"
          caption={`${p.tag}, lifestyle shot`}
          className="shopcol-img-base"
          style={{ position: 'absolute', inset: 0 }}
        />
        <Placeholder
          variant="warm"
          caption={`${p.tag}, on-finger close-up`}
          className="shopcol-img-hover"
          style={{ position: 'absolute', inset: 0 }}
        />
        <span className="shopcol-badge">{p.badge}</span>
      </Link>
      <h3 className="shopcol-card-name">{p.name}</h3>
      <p className="shopcol-card-detail">{p.detail}</p>
      <p className="shopcol-card-price">{p.price}</p>
      <div className="shopcol-card-actions">
        <button type="button" className="shopcol-btn shopcol-btn-outline-emerald">
          Add to Cart
        </button>
        <a
          className="shopcol-btn shopcol-btn-whatsapp"
          href={`https://wa.me/?text=${encodeURIComponent("Hi! I'm interested in the " + p.name)}`}
          target="_blank"
          rel="noopener noreferrer"
        >
          <i className="fa-brands fa-whatsapp" />
          WhatsApp
        </a>
      </div>
    </div>
  );
}

export default function ShopCollection() {
  return (
    <>
      <Header />

      <Hero
        minHeight={420}
        padding="80px"
        caption="hero image: curated ring collection, studio flat lay"
        title="The Handcrafted Collection"
        subtitle="Every ring is individually crafted with ethically sourced natural Sri Lankan gemstones set in 925 sterling silver."
        maxWidth={640}
      />

      {/* Filter & Sort Toolbar */}
      <div className="shopcol-toolbar">
        <div className="container shopcol-toolbar__row">
          <div className="shopcol-filters">
            {shopFilters.map((f) => (
              <button type="button" className="shopcol-filter-pill" key={f.label}>
                {f.label}
                <i className="fa-solid fa-chevron-down" style={{ fontSize: 10 }} />
              </button>
            ))}
          </div>
          <div className="shopcol-sort">
            <label htmlFor="shopcol-sort-select" className="shopcol-sort__label">
              Sort by:
            </label>
            <select id="shopcol-sort-select" className="shopcol-sort__select" defaultValue={sortOptions[0]}>
              {sortOptions.map((opt) => (
                <option key={opt} value={opt}>
                  {opt}
                </option>
              ))}
            </select>
          </div>
        </div>
      </div>

      {/* Product Grid */}
      <section className="shopcol-grid-section">
        <div className="container">
          <div className="shopcol-grid">
            {shopProducts.slice(0, 6).map((p) => (
              <ProductCard p={p} key={p.slug} />
            ))}
          </div>

          {/* Inline Trust Banner */}
          <div className="shopcol-trust-banner">
            <h3 className="shopcol-trust-banner__title">Unsure About Your Ring Size?</h3>
            <p className="shopcol-trust-banner__body">
              We offer surprise-proof open-gap designs and a comprehensive US Sizing Guide with free exchanges.
            </p>
            <button type="button" className="btn btn-terracotta">
              View Sizing Guide
            </button>
          </div>

          <div className="shopcol-grid">
            {shopProducts.slice(6, 8).map((p) => (
              <ProductCard p={p} key={p.slug} />
            ))}
          </div>
        </div>
      </section>

      {/* Bottom Assurance Row */}
      <section className="shopcol-assurance">
        <div className="container shopcol-assurance__grid">
          {assurances.map((a) => (
            <div className="shopcol-assurance__item" key={a.title}>
              <div className="shopcol-assurance__icon">
                <i className={a.icon} />
              </div>
              <h4 className="shopcol-assurance__title">{a.title}</h4>
              <p className="shopcol-assurance__desc">{a.desc}</p>
            </div>
          ))}
        </div>
      </section>

      <ConciergeCTA />
      <Footer />
    </>
  );
}
