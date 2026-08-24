import { useState } from 'react';
import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import ConciergeCTA from '../components/ConciergeCTA.jsx';
import Hero from '../components/Hero.jsx';
import Placeholder from '../components/Placeholder.jsx';
import { featuredProduct } from '../data/products.js';
import './ProductDetail.css';

const TABS = [
  { id: 1, label: 'Gemstone & Metal Specs' },
  { id: 2, label: 'Ethical Origin & Craftsmanship' },
  { id: 3, label: 'Packaging & Unboxing' },
];

export default function ProductDetail() {
  const [activeGalleryIndex, setActiveGalleryIndex] = useState(0);
  const [lightboxOpen, setLightboxOpen] = useState(false);
  const [activeTab, setActiveTab] = useState(1);
  const [qty, setQty] = useState(1);
  const [size, setSize] = useState(featuredProduct.defaultSize);

  const mediaLen = featuredProduct.media.length;

  function openLightbox(i) {
    setActiveGalleryIndex(i);
    setLightboxOpen(true);
  }

  function prevImage() {
    setActiveGalleryIndex((i) => (i - 1 + mediaLen) % mediaLen);
  }

  function nextImage() {
    setActiveGalleryIndex((i) => (i + 1) % mediaLen);
  }

  return (
    <>
      <Header />

      <Hero
        minHeight={320}
        padding="64px"
        caption="hero image: blue topaz solitaire, hand wear"
        title={featuredProduct.name}
        subtitle={featuredProduct.subtitle}
        maxWidth={640}
      />

      {/* Breadcrumb */}
      <div className="container pdp-breadcrumb">
        <Link to="/">Home</Link> / <Link to="/shop">Collections</Link> / <Link to="/shop">Blue Topaz</Link> /{' '}
        <span className="pdp-breadcrumb__current">The Raw-Edge Solitaire</span>
      </div>

      {/* Gallery + Buy Box */}
      <div className="container pdp-main">
        {/* Gallery */}
        <div className="pdp-gallery">
          {featuredProduct.media.map((m, i) => (
            <div key={m.key} className="pdp-gallery__tile" onClick={() => openLightbox(i)}>
              <Placeholder
                variant="light"
                caption={m.label}
                style={{ cursor: 'zoom-in', position: 'relative', borderRadius: 14, height: 280 }}
              />
              {m.isVideo && (
                <div className="pdp-gallery__play">
                  <i className="fa-solid fa-play" />
                </div>
              )}
              <div className="pdp-gallery__expand">
                <i className="fa-solid fa-expand" />
              </div>
            </div>
          ))}
        </div>

        {/* Buy Box */}
        <div className="pdp-buybox">
          <h1 className="pdp-buybox__title">{featuredProduct.name}</h1>

          <div className="pdp-buybox__rating">
            <div className="stars">
              {Array.from({ length: 5 }).map((_, i) => (
                <i key={i} className="fa-solid fa-star" style={{ fontSize: 14 }} />
              ))}
            </div>
            <span>4.9/5 &middot; 18 reviews</span>
          </div>

          <div className="pdp-buybox__price">{featuredProduct.price}</div>
          <div className="pdp-buybox__shipping">Includes Insured Worldwide Shipping</div>

          <p className="pdp-buybox__desc">{featuredProduct.description}</p>

          {/* Size selector */}
          <div className="pdp-field">
            <label className="pdp-field__label">US Ring Size</label>
            <div className="pdp-sizes">
              {featuredProduct.sizes.map((s) => (
                <button
                  type="button"
                  key={s}
                  className={`pdp-size-swatch ${size === s ? 'pdp-size-swatch--active' : ''}`}
                  onClick={() => setSize(s)}
                >
                  {s}
                </button>
              ))}
            </div>
            <a href="#" className="pdp-size-link">
              📏 Unsure of your size? Find Your Ring Size
            </a>
          </div>

          {/* Engraving */}
          <div className="pdp-field">
            <label className="pdp-field__label" htmlFor="pdp-engraving">
              Add Free Inside Band Engraving (Max 12 chars)
            </label>
            <input id="pdp-engraving" type="text" className="pdp-engraving-input" maxLength={12} placeholder="Enter text here..." />
          </div>

          {/* CTA row */}
          <div className="pdp-cta-row">
            <div className="pdp-qty">
              <button type="button" className="pdp-qty__btn" onClick={() => setQty((q) => Math.max(1, q - 1))}>
                &minus;
              </button>
              <span className="pdp-qty__value">{qty}</span>
              <button type="button" className="pdp-qty__btn" onClick={() => setQty((q) => q + 1)}>
                +
              </button>
            </div>
            <button type="button" className="btn btn-terracotta pdp-add-btn">
              Add to Cart
            </button>
          </div>

          <a
            className="btn btn-emerald pdp-whatsapp-btn"
            href={`https://wa.me/?text=${encodeURIComponent(
              "Hi! I'm interested in the " + featuredProduct.name + ', size ' + size
            )}`}
            target="_blank"
            rel="noopener noreferrer"
          >
            <i className="fa-brands fa-whatsapp" /> Chat on WhatsApp
          </a>

          <button type="button" className="pdp-pay-btn">
            Buy with PayPal / Apple Pay
          </button>

          {/* Trust badges */}
          <div className="pdp-trust">
            <div className="pdp-trust__row">
              <i className="fa-solid fa-plane" />
              <span>Free Worldwide Insured Shipping (5&ndash;7 Business Days via DHL/FedEx)</span>
            </div>
            <div className="pdp-trust__row">
              <i className="fa-solid fa-scroll" />
              <span>Gemologist Authenticity Certificate included</span>
            </div>
            <div className="pdp-trust__row">
              <i className="fa-solid fa-rotate" />
              <span>Easy 30-Day Size Exchange Policy</span>
            </div>
          </div>
        </div>
      </div>

      {/* Lightbox */}
      {lightboxOpen && (
        <div className="pdp-lightbox">
          <button type="button" className="pdp-lightbox__close" onClick={() => setLightboxOpen(false)}>
            <i className="fa-solid fa-xmark" />
          </button>
          <button type="button" className="pdp-lightbox__nav pdp-lightbox__nav--prev" onClick={prevImage}>
            <i className="fa-solid fa-chevron-left" />
          </button>
          <Placeholder
            variant="light"
            caption={featuredProduct.media[activeGalleryIndex].label}
            style={{ borderRadius: 14, width: 'min(680px, 86vw)', height: 'min(680px, 80vh)' }}
          />
          <button type="button" className="pdp-lightbox__nav pdp-lightbox__nav--next" onClick={nextImage}>
            <i className="fa-solid fa-chevron-right" />
          </button>
        </div>
      )}

      {/* Details Tabs */}
      <div className="pdp-details">
        <div className="pdp-details__inner">
          <div className="pdp-tabs">
            {TABS.map((t) => (
              <button
                type="button"
                key={t.id}
                className={`pdp-tab ${activeTab === t.id ? 'pdp-tab--active' : ''}`}
                onClick={() => setActiveTab(t.id)}
              >
                {t.label}
              </button>
            ))}
          </div>

          <div className="pdp-tab-panel">
            {activeTab === 1 && (
              <div className="pdp-specs">
                {featuredProduct.specs.map((s) => (
                  <div className="pdp-specs__row" key={s.label}>
                    <span className="pdp-specs__label">{s.label}</span>
                    <span className="pdp-specs__value">{s.value}</span>
                  </div>
                ))}
              </div>
            )}
            {activeTab === 2 && (
              <p className="pdp-origin-copy">
                Directly sourced from local miners in Ratnapura, Sri Lanka. Faceted by licensed lapidaries and hand-set by master
                silversmiths.
              </p>
            )}
            {activeTab === 3 && (
              <div className="pdp-packaging">
                {featuredProduct.packagingItems.map((item) => (
                  <div className="pdp-packaging__row" key={item}>
                    <i className="fa-solid fa-check" />
                    <span>{item}</span>
                  </div>
                ))}
              </div>
            )}
          </div>
        </div>
      </div>

      {/* Visual Story Banner */}
      <div className="pdp-story">
        <div className="pdp-story__inner">
          <div className="kicker">Crafted with Intention</div>
          <div className="pdp-story__grid">
            <Placeholder variant="dark" caption="macro: hammering texture into silver" style={{ borderRadius: 14, height: 280 }} />
            <Placeholder variant="dark" caption="macro: hammering texture into silver" style={{ borderRadius: 14, height: 280 }} />
            <Placeholder variant="dark" caption="macro: stone-setting process" style={{ borderRadius: 14, height: 280 }} />
          </div>
          <p className="pdp-story__copy">
            No two rings are 100% identical. The subtle hammer marks on the silver and the unique natural inclusions inside the
            crystal ensure your piece is uniquely yours.
          </p>
        </div>
      </div>

      {/* Reviews */}
      <div className="pdp-reviews">
        <div className="container">
          <div className="pdp-reviews__summary">
            <div className="pdp-reviews__score">
              <div className="pdp-reviews__score-num">
                4.9<span>/ 5</span>
              </div>
              <div className="stars" style={{ fontSize: 15 }}>
                {Array.from({ length: 5 }).map((_, i) => (
                  <i key={i} className="fa-solid fa-star" />
                ))}
              </div>
              <div className="pdp-reviews__score-count">Based on 18 reviews</div>
            </div>

            <div className="pdp-reviews__bars">
              {featuredProduct.ratingBars.map((rb) => (
                <div className="pdp-reviews__bar-row" key={rb.label}>
                  <span className="pdp-reviews__bar-label">{rb.label}</span>
                  <div className="pdp-reviews__bar-track">
                    <div className="pdp-reviews__bar-fill" style={{ width: rb.pct }} />
                  </div>
                </div>
              ))}
            </div>

            <div className="pdp-reviews__filters">
              {featuredProduct.reviewFilters.map((f) => (
                <button type="button" key={f} className="pdp-reviews__chip">
                  {f}
                </button>
              ))}
            </div>
          </div>

          <div className="pdp-reviews__ugc">
            {Array.from({ length: 6 }).map((_, i) => (
              <Placeholder key={i} variant="light" caption="customer photo" style={{ aspectRatio: '1', borderRadius: 8 }} />
            ))}
          </div>

          <div className="pdp-reviews__cards">
            {featuredProduct.reviews.map((r) => (
              <div className="pdp-review-card" key={r.name}>
                <div className="pdp-review-card__top">
                  <div className="stars" style={{ fontSize: 13 }}>
                    {Array.from({ length: 5 }).map((_, i) => (
                      <i key={i} className="fa-solid fa-star" />
                    ))}
                  </div>
                  <span className="pdp-review-card__verified">Verified Buyer</span>
                </div>
                <p className="pdp-review-card__quote">&ldquo;{r.quote}&rdquo;</p>
                <div className="pdp-review-card__name">
                  {r.name} &mdash; <span>Size {r.size}</span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* You May Also Like */}
      <div className="pdp-crosssell">
        <div className="container">
          <h2 className="pdp-crosssell__title">You May Also Like</h2>
          <div className="pdp-crosssell__grid">
            {featuredProduct.crossSell.map((cs) => (
              <div className="pdp-crosssell__item" key={cs.name}>
                <Placeholder variant="light" caption={cs.tag} style={{ borderRadius: 12, height: 300 }} />
                <div className="pdp-crosssell__name">{cs.name}</div>
                <div className="pdp-crosssell__price">{cs.price}</div>
              </div>
            ))}
          </div>
        </div>
      </div>

      <ConciergeCTA />
      <Footer />
    </>
  );
}
