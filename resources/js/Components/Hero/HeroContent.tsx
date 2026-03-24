import React from 'react';
import { mockData } from '../../data/mockData';
import VerifyScanner from './VerifyScanner';

interface HeroContentProps {
  readonly className?: string;
}

export const HeroContent: React.FC<HeroContentProps> = ({ className = '' }) => {
  return (
    <div className={`@container max-w-7xl mx-auto ${className}`}>
      <div className="flex flex-col gap-12 px-6 py-12 @[864px]:flex-row @[864px]:items-center @[864px]:py-24">
        <div className="flex flex-col gap-8 @[864px]:w-1/2">
          
          <div className="flex flex-col gap-4">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 w-fit">
              <span className="relative flex h-2 w-2">
                <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                <span className="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
              </span>
              <span className="text-xs font-bold text-primary uppercase tracking-widest">{mockData.hero.badgeText}</span>
            </div>
            <h1 className="text-slate-900 dark:text-white text-5xl font-black leading-[1.1] @[480px]:text-6xl @[864px]:text-7xl tracking-tight">
              {mockData.hero.titleStart} <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent">{mockData.hero.titleHighlight}</span> {mockData.hero.titleEnd}
            </h1>
            <p className="text-slate-600 dark:text-slate-400 text-lg font-normal leading-relaxed max-w-xl">
              {mockData.hero.subtitle}
            </p>
          </div>
          
          <div className="flex flex-wrap gap-4">
            <a href={mockData.hero.ctaPrimary.href} className="btn-3d flex min-w-[200px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-14 px-8 bg-primary text-white text-lg font-bold tracking-wide">
              <span className="truncate">{mockData.hero.ctaPrimary.label}</span>
              <span className="material-symbols-outlined ml-2">arrow_forward</span>
            </a>
            <a href={mockData.hero.ctaSecondary.href} className="flex min-w-[200px] cursor-pointer items-center justify-center rounded-lg h-14 px-8 border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-sm font-bold transition-all">
              {mockData.hero.ctaSecondary.label}
            </a>
          </div>

        </div>

        <div className="w-full @[864px]:w-1/2 relative group" id="scanner">
          <div className="absolute -inset-4 bg-primary/20 blur-3xl rounded-full opacity-30 group-hover:opacity-50 transition-opacity"></div>
          
          <div className="hidden @[480px]:flex relative w-full aspect-[4/3] bg-gradient-to-br from-slate-800 to-background-dark rounded-3xl border border-slate-700 overflow-hidden items-center justify-center shadow-2xl neon-glow mb-8">
            <img alt="Futuristic 3D Portal Device" className="w-full h-full object-cover mix-blend-overlay opacity-40 absolute" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgsiDPYgje6ZWMn-3HMTzM3TGtsoY4e3SCJog8FOkq_evraWjYrUT1BQnLax8XCe5JqTuo-x5axgTniYjA9L3gM9fHTkqIA6jATX-DCoXZvdtT_xHs6la7ZpUdtgjPlXJtHIknPajXMy7JwExUR0KvsCxzkLPUOmpaV2W0tgdY_gTiHIdX_kODxbgMriZsLkUfwt_L6pdNMYEJXO_BW_5w0_LqtbWQ8uxjmNxeK6L7PGSphOhvDbqxP5Pv33UaOGXTpj96Q3dTVpk"/>
            <div className="relative z-10 flex flex-col items-center gap-6">
              <div className="w-32 h-32 md:w-48 md:h-48 rounded-full border-4 border-dashed border-primary/50 flex items-center justify-center p-4">
                <div className="w-full h-full rounded-full bg-gradient-to-tr from-primary to-accent flex items-center justify-center shadow-[0_0_50px_rgba(236,91,19,0.5)]">
                  <span className="material-symbols-outlined text-4xl md:text-7xl text-white">fingerprint</span>
                </div>
              </div>
              <div className="text-center px-8 hidden md:block">
                <div className="h-2 w-32 bg-slate-700 rounded-full mx-auto mb-4 overflow-hidden">
                  <div className="h-full w-2/3 bg-primary rounded-full"></div>
                </div>
                <p className="text-xs font-mono text-primary uppercase tracking-[0.2em]">Ready to scan</p>
              </div>
            </div>
          </div>

          <div className="relative w-full z-10 flex items-center justify-center">
            <VerifyScanner />
          </div>
        </div>
      </div>
    </div>
  );
};

export default HeroContent;
