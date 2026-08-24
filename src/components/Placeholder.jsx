// Generic striped placeholder used everywhere a real photo will eventually go.
// variant: 'light' | 'dark' | 'darker' | 'terra-dark' | 'warm'
export default function Placeholder({ variant = 'light', caption, boxed = false, style, className = '' }) {
  const variantClass = `ph-${variant}`;
  return (
    <div className={`ph ${variantClass} ${boxed ? 'ph-boxed' : ''} ${className}`} style={style}>
      {caption && <div className="ph-caption">[ {caption} ]</div>}
    </div>
  );
}
