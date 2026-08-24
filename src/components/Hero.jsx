import Placeholder from './Placeholder.jsx';
import './Hero.css';

// Shared hero pattern: dark emerald bg, striped placeholder + legibility scrim, headline block.
export default function Hero({ minHeight = 420, padding = '80px', caption, title, subtitle, maxWidth = 640 }) {
  return (
    <section className="fb-hero" style={{ minHeight }}>
      <div className="fb-hero__media">
        <Placeholder variant="dark" />
        <div className="fb-hero__scrim" />
      </div>
      {caption && <div className="fb-hero__caption">[ {caption} ]</div>}
      <div className="container fb-hero__content" style={{ padding: `${padding} var(--section-x)` }}>
        <div style={{ maxWidth }}>
          <h1 className="fb-hero__title">{title}</h1>
          {subtitle && <p className="fb-hero__subtitle">{subtitle}</p>}
        </div>
      </div>
    </section>
  );
}
