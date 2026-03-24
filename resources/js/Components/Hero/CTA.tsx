import React from 'react';
import { mockData } from '../../data/mockData';

interface CTAProps {
  readonly className?: string;
}

export const CTA: React.FC<CTAProps> = ({ className = '' }) => {
  return (
    <div className={`@container px-6 py-24 bg-primary relative overflow-hidden ${className}`}>
      <div className="absolute inset-0 bg-primary opacity-90"></div>
      <div className="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxyZWN0IHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgZmlsbD0ibm9uZSIvPgo8cGF0aCBkPSJNMCAwdjQwaDQwdjRwaC00MFoiIGZpbGw9InJnYmEoMTY4LCA4NSLCAyNDcsIDAuMSkiLz4KPC9zdmc+')] opacity-30"></div>
      <div className="relative z-10 flex flex-col items-center gap-10 text-center max-w-3xl mx-auto">
        <div className="flex flex-col gap-4">
          <h2 className="text-white text-4xl font-black tracking-tight @[480px]:text-6xl">
            {mockData.ctaBottom.title}
          </h2>
          <p className="text-white/80 text-lg font-medium">
            {mockData.ctaBottom.subtitle}
          </p>
        </div>
        <a href={mockData.ctaBottom.buttonHref} className="bg-white text-primary hover:bg-slate-100 px-10 py-5 rounded-xl text-xl font-bold shadow-2xl transition-all transform hover:scale-105 active:scale-95 inline-block cursor-pointer">
          {mockData.ctaBottom.buttonLabel}
        </a>
      </div>
    </div>
  );
};

export default CTA;
