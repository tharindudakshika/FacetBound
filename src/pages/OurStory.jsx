import { Link } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import Hero from '../components/Hero.jsx';
import Placeholder from '../components/Placeholder.jsx';
import './OurStory.css';

export default function OurStory() {
  return (
    <>
      <Header />

      <Hero
        minHeight={600}
        padding="120px"
        caption="cinematic close-up: raw gemstone from pit + hand-polished silver ring"
        title={<>Unearthing Sri Lanka&rsquo;s Earth. Shaping Timeless Art.</>}
        subtitle="The story of how raw natural crystals from ancient riverbeds are transformed into modern artisanal jewellery."
        maxWidth={660}
      />

      {/* The Genesis */}
      <section className="story-genesis">
        <div className="container story-genesis-grid">
          <Placeholder
            variant="light"
            boxed
            caption="pit mining scene / gemstone market in Ratnapura"
            style={{ borderRadius: 14, minHeight: 420 }}
          />
          <div>
            <div className="kicker">The Genesis</div>
            <h2>Sri Lanka has been the realm of the world&rsquo;s finest gemstones for centuries.</h2>
            <p>
              Facetbound was founded to offer the world hand-crafted rings that preserve the unique character
              and soul of each natural stone &mdash; standing as an alternative to mass-produced, identical
              jewelry.
            </p>
          </div>
        </div>
      </section>

      {/* Raw & Refined Philosophy */}
      <section className="story-philosophy">
        <div className="container">
          <div className="story-philosophy-head">
            <div className="kicker">Our Philosophy</div>
            <h2>Raw &amp; Refined</h2>
          </div>
          <div className="story-philosophy-grid">
            <div className="story-card">
              <div className="kicker">The Raw</div>
              <h3>Earth&rsquo;s Natural State</h3>
              <p>
                A natural gemstone is a creation forged over millions of years under extreme terrestrial
                pressure and heat. Because of this, every single stone is 100% unique.
              </p>
            </div>
            <div className="story-card">
              <div className="kicker">The Refined</div>
              <h3>Artisanal Craftsmanship</h3>
              <p>
                Local artisan silversmiths bring each raw stone to life using hammered or tree bark textures,
                tailored to fit its natural shape.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Ethical Sourcing */}
      <section className="story-ethics">
        <div className="container">
          <div className="story-ethics-box">
            <div className="kicker">Sustainability</div>
            <h2>Ethical Sourcing &amp; Fair Trade</h2>
            <div className="story-ethics-points">
              <div className="story-ethics-point">
                <h4>No Mass Mining</h4>
                <p>
                  Utilizing strictly ethical sourcing methods that protect the environment and ensure fair
                  wages for local miners.
                </p>
              </div>
              <div className="story-ethics-point">
                <h4>Authenticity Guaranteed</h4>
                <p>
                  Every ring is delivered with a Gemological Authenticity Certificate and a tag signed by the
                  artisan.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Meet the Artisans */}
      <section className="story-artisans">
        <Placeholder
          variant="darker"
          boxed
          caption="close-up: silversmith's hands hammering silver"
          style={{ minHeight: 440 }}
        />
        <div className="story-artisans-copy">
          <div className="kicker">Meet the Artisans</div>
          <h2>A Human Touch, in Every Setting</h2>
          <p>
            Every Facetbound piece carries a human touch. No machines, no factory lines &mdash; just dedicated
            master craftsmen in Sri Lanka pouring their soul into every texture and setting.
          </p>
        </div>
      </section>

      {/* Earth-Conscious Packaging */}
      <section className="story-packaging">
        <div className="container story-packaging-grid">
          <div>
            <div className="kicker">Unboxing</div>
            <h2>Our packaging is completely plastic-free.</h2>
            <p>
              The moment you open the box, the scent of rain-soaked earth (Mitti Attar) immerses you in the
              authentic experience of a Sri Lankan gemstone mine.
            </p>
          </div>
          <Placeholder
            variant="terra-dark"
            boxed
            caption="octagonal emerald wooden box, terracotta board inserts, mitti attar"
            style={{ minHeight: 400 }}
          />
        </div>
      </section>

      {/* CTA */}
      <section className="story-cta">
        <h2>Find the Piece That Speaks to You</h2>
        <div className="story-cta-buttons">
          <Link to="/shop" className="btn btn-terracotta">
            Explore Collections
          </Link>
          <Link to="/sustainability" className="btn btn-outline-terracotta">
            Read Our Ethics
          </Link>
        </div>
      </section>

      <Footer />
    </>
  );
}
