import { Routes, Route } from 'react-router-dom';
import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import Home from './pages/Home.jsx';
import OurStory from './pages/OurStory.jsx';
import Sustainability from './pages/Sustainability.jsx';
import ShopCollection from './pages/ShopCollection.jsx';
import ProductDetail from './pages/ProductDetail.jsx';
import Checkout from './pages/Checkout.jsx';
import MyAccount from './pages/MyAccount.jsx';
import Journal from './pages/Journal.jsx';
import JournalArticle from './pages/JournalArticle.jsx';

function ScrollToTop() {
  const { pathname } = useLocation();
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);
  return null;
}

export default function App() {
  return (
    <>
      <ScrollToTop />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/our-story" element={<OurStory />} />
        <Route path="/sustainability" element={<Sustainability />} />
        <Route path="/shop" element={<ShopCollection />} />
        <Route path="/product/:slug" element={<ProductDetail />} />
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/account" element={<MyAccount />} />
        <Route path="/journal" element={<Journal />} />
        <Route path="/journal/:slug" element={<JournalArticle />} />
      </Routes>
    </>
  );
}
