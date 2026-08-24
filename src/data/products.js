// Homepage "Featured Products" (Bestsellers)
export const homeProducts = [
  { slug: 'verdant-solitaire-ring', name: 'Verdant Solitaire Ring', price: '$165', tag: 'solitaire ring, emerald cut' },
  { slug: 'hammered-terra-band', name: 'Hammered Terra Band', price: '$155', tag: 'hammered silver band' },
  { slug: 'blue-topaz-halo-ring', name: 'Blue Topaz Halo Ring', price: '$175', tag: 'blue topaz halo ring' },
  { slug: 'tree-bark-textured-band', name: 'Tree Bark Textured Band', price: '$160', tag: 'tree bark textured band' },
  { slug: 'emerald-whisper-ring', name: 'Emerald Whisper Ring', price: '$172', tag: 'emerald gemstone ring' },
  { slug: 'terracotta-accent-band', name: 'Terracotta Accent Band', price: '$150', tag: 'silver band, terracotta stone' },
  { slug: 'sri-lankan-sapphire-ring', name: 'Sri Lankan Sapphire Ring', price: '$175', tag: 'blue sapphire ring' },
  { slug: 'minimalist-silver-solitaire', name: 'Minimalist Silver Solitaire', price: '$158', tag: 'thin band solitaire ring' },
];

export const collections = [
  { name: 'Blue Topaz Collection', tag: 'blue topaz ring, studio shot' },
  { name: 'Artisan Textured Bands', tag: 'hammered & tree bark texture band' },
  { name: 'Minimalist Solitaires', tag: 'minimalist solitaire ring' },
];

// Shop Collection catalog
export const shopProducts = [
  { slug: 'raw-edge-blue-topaz-solitaire', name: 'The Raw-Edge Blue Topaz Solitaire', detail: 'Natural Blue Topaz | 925 Sterling Silver', price: '$150.00 – $175.00', tag: 'blue topaz solitaire ring', badge: 'Ethically Sourced' },
  { slug: 'hammered-spinel-band', name: 'Hammered Spinel Band', detail: 'Natural Spinel | 925 Sterling Silver', price: '$155.00 – $170.00', tag: 'hammered spinel band', badge: 'Natural Stone' },
  { slug: 'tree-bark-amethyst-ring', name: 'Tree Bark Amethyst Ring', detail: 'Natural Amethyst | 925 Sterling Silver', price: '$160.00 – $175.00', tag: 'tree bark amethyst ring', badge: 'Ethically Sourced' },
  { slug: 'open-gap-moonstone-ring', name: 'Open-Gap Moonstone Ring', detail: 'Natural Moonstone | 925 Sterling Silver', price: '$150.00 – $165.00', tag: 'open-gap moonstone ring', badge: 'Natural Stone' },
  { slug: 'high-polish-tourmaline-solitaire', name: 'High-Polish Tourmaline Solitaire', detail: 'Natural Tourmaline | 925 Sterling Silver', price: '$165.00 – $175.00', tag: 'tourmaline solitaire ring', badge: 'Ethically Sourced' },
  { slug: 'textured-band-blue-topaz-ring', name: 'Textured Band Blue Topaz Ring', detail: 'Natural Blue Topaz | 925 Sterling Silver', price: '$158.00 – $172.00', tag: 'textured band blue topaz ring', badge: 'Natural Stone' },
  { slug: 'hammered-amethyst-solitaire', name: 'Hammered Amethyst Solitaire', detail: 'Natural Amethyst | 925 Sterling Silver', price: '$150.00 – $168.00', tag: 'hammered amethyst solitaire', badge: 'Ethically Sourced' },
  { slug: 'adjustable-spinel-band', name: 'Adjustable Spinel Band', detail: 'Natural Spinel | 925 Sterling Silver', price: '$155.00 – $175.00', tag: 'adjustable spinel band', badge: 'Natural Stone' },
];

export const shopFilters = [
  { label: 'Gemstone Type', options: ['Blue Topaz', 'Spinel', 'Amethyst', 'Moonstone', 'Tourmaline'] },
  { label: 'Silver Texture', options: ['Hammered Finish', 'Tree Bark Texture', 'High Polish'] },
  { label: 'Ring Style', options: ['Solitaire', 'Open-Gap / Adjustable', 'Textured Band'] },
];

export const sortOptions = ['Featured', 'Price: Low to High', 'Price: High to Low', 'Newest'];

export const assurances = [
  { icon: 'fa-solid fa-box', title: 'Custom Octagonal Packaging Included', desc: 'Every ring comes in our emerald wooden box with Mitti Attar scent.' },
  { icon: 'fa-solid fa-scroll', title: 'Authenticity Certificate', desc: 'Gemologist-certified natural Sri Lankan stones.' },
  { icon: 'fa-solid fa-plane', title: 'Insured Global Courier', desc: 'Ships via DHL/FedEx with full tracking.' },
];

// Product Detail — the featured/first product
export const featuredProduct = {
  slug: 'raw-edge-blue-topaz-solitaire',
  name: 'The Raw-Edge Blue Topaz Solitaire Ring',
  subtitle: 'Natural Blue Topaz | 925 Sterling Silver | Ethically Sourced',
  price: '$165.00 USD',
  description: 'Handcrafted 925 Sterling Silver ring with an artisanal hammered finish, holding a 1.2ct natural, ethically sourced Sri Lankan Blue Topaz.',
  media: [
    { key: 'hero', label: 'Studio shot, hero angle, neutral background', isVideo: false },
    { key: 'wear', label: 'On-finger wear angle', isVideo: false },
    { key: 'texture', label: 'Open-back setting & hammered texture close-up', isVideo: false },
    { key: 'unboxing', label: 'Ring inside emerald wooden box with terracotta packaging', isVideo: false },
    { key: 'video', label: '10-second sunlight sparkle video clip', isVideo: true },
  ],
  sizes: ['US 5', 'US 6', 'US 7', 'US 8', 'US 9', 'Open-Gap'],
  defaultSize: 'US 7',
  specs: [
    { label: 'Gemstone', value: '100% Natural Sri Lankan Blue Topaz (Unheated/Natural)' },
    { label: 'Carat Weight', value: '1.15 – 1.20 Carats' },
    { label: 'Gem Cut', value: 'Cushion Cut / Round Brilliant Cut' },
    { label: 'Metal Standard', value: 'Solid 925 Sterling Silver (Nickel-free, Hypoallergenic)' },
    { label: 'Finish/Texture', value: 'Artisan Hand-Hammered Texture' },
    { label: 'Setting Type', value: 'Open-back bezel setting (max light transmission, direct skin contact)' },
  ],
  packagingItems: [
    'Octagonal Teak Wood Box (Deep Emerald Green)',
    'Terracotta Well Insert infused with Mitti Attar essential oil',
    'Hand-signed Artisan Thank You Tag & Authenticity Card',
    'Silver Polishing Cloth & Care Card',
  ],
  ratingBars: [
    { label: '5 star', pct: '82%' },
    { label: '4 star', pct: '12%' },
    { label: '3 star', pct: '4%' },
    { label: '2 star', pct: '1%' },
    { label: '1 star', pct: '1%' },
  ],
  reviewFilters: ['Verified Buyer', 'By Size', 'By Gem Type'],
  reviews: [
    { name: 'Rachel H.', size: 'US 7', quote: 'The open-back setting is stunning in sunlight, and the hammered texture feels handmade in the best way.' },
    { name: 'Megan T.', size: 'US 6', quote: 'Sizing was spot on and the engraving inside the band was a lovely surprise touch.' },
    { name: 'Danielle K.', size: 'US 8', quote: 'You can tell this is a real natural stone — the inclusions make it feel one of a kind.' },
  ],
  crossSell: [
    { name: 'Spinel Minimalist Ring', price: '$155.00', tag: 'spinel minimalist ring' },
    { name: 'Amethyst Textured Band', price: '$160.00', tag: 'amethyst textured band' },
    { name: 'Blue Topaz Pair Earrings', price: '$150.00', tag: 'blue topaz pair earrings' },
  ],
};

export const testimonials = [
  { name: 'Rachel H.', location: 'Austin, TX', quote: "The sizing guide was spot on — first ring I've ordered online that fit perfectly. Unboxing felt like a gift to myself." },
  { name: 'Megan T.', location: 'Portland, OR', quote: "Genuinely the nicest packaging I've seen from a jewelry brand. The earthy scent when you open the box is unexpected and lovely." },
  { name: 'Danielle K.', location: 'Charleston, SC', quote: 'I was nervous about ring size but their guide made it easy. The hammered band is even better than the photos.' },
];

export const unboxingFeatures = [
  'Geometric emerald-green wooden keepsake box',
  'Mitti attar — the scent of Sri Lankan earth',
  'Hand-folded terracotta fabric inserts',
  'Signed authenticity & provenance card',
];

export const instagramTiles = ['lifestyle shot 1', 'lifestyle shot 2', 'lifestyle shot 3', 'lifestyle shot 4', 'lifestyle shot 5', 'lifestyle shot 6'];
