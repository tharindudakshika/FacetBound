import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import Hero from '../components/Hero.jsx';
import Placeholder from '../components/Placeholder.jsx';
import './Sustainability.css';

const sourcingRows = [
  {
    icon: 'fa-solid fa-hand-holding-heart',
    title: 'Direct Mine-to-Hand',
    desc: "Sourcing natural Spinel gemstones directly from Sri Lanka's traditional miners without intermediaries.",
  },
  {
    icon: 'fa-solid fa-water',
    title: 'No Industrial Mass Mining',
    desc: 'Using strictly traditional, artisanal small-scale mining methods that prevent environmental and river damage.',
  },
  {
    icon: 'fa-solid fa-gem',
    title: 'Untreated Natural Spinels',
    desc: 'Utilizing exclusively 100% natural Spinels with zero artificial heat or chemical treatments.',
  },
];

const artisanBlocks = [
  {
    title: 'Fair Wages & Respect',
    desc: 'Providing fair trade wages and proper compensation to local silversmiths and lapidaries.',
  },
  {
    title: 'Preserving Heritage',
    desc: 'Showcasing the generational artisanal heritage of Sri Lankan silversmiths to an international audience.',
  },
];

const packagingCards = [
  {
    icon: 'fa-solid fa-box',
    title: 'Octagonal Teak Wood Box',
    desc: 'Reusable octagonal boxes crafted from local teak wood, replacing plastic boxes.',
  },
  {
    icon: 'fa-solid fa-droplet',
    title: 'Terracotta & Natural Scent',
    desc: 'Natural terracotta board and pure Mitti Attar fragrance, replacing plastic foam inserts.',
  },
  {
    icon: 'fa-solid fa-leaf',
    title: 'Honeycomb Kraft Wrap',
    desc: '100% biodegradable hexagonal paper wrap for secure courier shipping instead of plastic bubble wrap.',
  },
];

export default function Sustainability() {
  return (
    <>
      <Header />

      <Hero
        minHeight={520}
        padding="110px"
        caption="hero image: Ratnapura mine landscape + raw Spinel crystal macro"
        title="Ethically Sourced. Earth Consciously Crafted."
        subtitle="Our commitment to Sri Lanka's heritage, local artisans, and zero-plastic sustainability."
        maxWidth={660}
      />

      {/* Ethical Gem Sourcing */}
      <section className="sustain-sourcing">
        <div className="container sustain-sourcing__grid">
          <Placeholder
            variant="light"
            boxed
            caption="selecting stones from local miners, Ratnapura gem pit"
            style={{ borderRadius: 14, minHeight: 440 }}
          />
          <div>
            <div className="kicker">Sourcing</div>
            <h2 className="sustain-sourcing__title">Ethical Gem Sourcing</h2>
            <div className="sustain-rows">
              {sourcingRows.map((row) => (
                <div className="sustain-row" key={row.title}>
                  <i className={`${row.icon} sustain-row__icon`} />
                  <div>
                    <p className="sustain-row__title">{row.title}</p>
                    <p className="sustain-row__desc">{row.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Artisan Fair Trade */}
      <section className="sustain-artisan">
        <div className="sustain-artisan__grid">
          <Placeholder
            variant="darker"
            boxed
            caption="close-up: silversmith handcrafting a ring"
            style={{ minHeight: 480 }}
          />
          <div className="sustain-artisan__copy">
            <div>
              <div className="kicker">Fair Trade</div>
              <h2 className="sustain-artisan__title">Artisan Fair Trade &amp; Craftsmanship</h2>
            </div>
            <div className="sustain-artisan__blocks">
              {artisanBlocks.map((block) => (
                <div className="sustain-artisan__block" key={block.title}>
                  <p className="sustain-artisan__block-title">{block.title}</p>
                  <p className="sustain-artisan__block-desc">{block.desc}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* 100% Plastic-Free Packaging */}
      <section className="sustain-packaging">
        <div className="container">
          <div className="sustain-packaging__head">
            <div className="kicker">Packaging</div>
            <h2 className="sustain-packaging__title">100% Plastic-Free Packaging</h2>
          </div>
          <Placeholder
            variant="light"
            boxed
            caption="flat-lay: octagonal wooden box, terracotta board, honeycomb paper wrap"
            style={{ borderRadius: 16, height: 380, marginBottom: 32 }}
          />
          <div className="sustain-packaging__grid">
            {packagingCards.map((card) => (
              <div className="sustain-card" key={card.title}>
                <i className={`${card.icon} sustain-card__icon`} />
                <p className="sustain-card__title">{card.title}</p>
                <p className="sustain-card__desc">{card.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Sustainability Promise */}
      <section className="sustain-promise">
        <div className="sustain-promise__box">
          <div className="kicker sustain-promise__kicker">Our Sustainability Promise</div>
          <p className="sustain-promise__text">
            Every FACETBOUND Spinel ring comes with an Authenticity Card certifying that your piece is 100% natural,
            ethically mined in Sri Lanka, and packaged without a single grain of single-use plastic.
          </p>
        </div>
      </section>

      {/* Closing CTA */}
      <section className="sustain-cta">
        <h2 className="sustain-cta__title">Wear Jewelry with a Soul</h2>
        <Link to="/shop" className="btn btn-terracotta">
          Explore Ethical Spinel Collections
        </Link>
      </section>

      <Footer />
    </>
  );
}
