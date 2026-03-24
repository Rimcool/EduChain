import React from 'react';
import Navbar from './Navbar';
import HeroContent from './HeroContent';
import Features from './Features';
import Stats from './Stats';
import CTA from './CTA';
import Footer from './Footer';

interface HeroScreenProps {
  readonly className?: string;
}

export const HeroScreen: React.FC<HeroScreenProps> = ({ className = '' }) => {
  return (
    <div className={`relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden grid-bg ${className}`}>
      <Navbar />
      <main className="relative z-10">
        <HeroContent />
        <Features />
        <Stats />
        <CTA />
      </main>
      <Footer />
    </div>
  );
};

export default HeroScreen;
