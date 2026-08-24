import './ConciergeCTA.css';

export default function ConciergeCTA() {
  return (
    <section className="concierge">
      <div className="concierge__inner">
        <div className="kicker">Collector Concierge</div>
        <h2>Need a size adjustment or custom engraving query?</h2>
        <div className="concierge__buttons">
          <button className="btn btn-terracotta">
            <i className="fa-solid fa-envelope" /> Contact Lead Gemologist
          </button>
          <button className="btn btn-emerald">
            <i className="fa-brands fa-whatsapp" style={{ fontSize: 16 }} /> Chat on WhatsApp
          </button>
        </div>
        <a href="#" className="concierge__link">
          <i className="fa-solid fa-download" style={{ fontSize: 12 }} /> Download Silver Care &amp; Polishing Guide
        </a>
      </div>
    </section>
  );
}
