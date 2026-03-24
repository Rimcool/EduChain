import React from 'react';
import { mockData } from '../../data/mockData';

interface FeaturesProps {
  readonly className?: string;
}

export const Features: React.FC<FeaturesProps> = ({ className = '' }) => {
  return (
    <div className={`flex flex-col gap-16 px-6 py-24 max-w-7xl mx-auto @container ${className}`}>
      <div className="flex flex-col gap-6 text-center items-center">
        <h2 className="text-slate-900 dark:text-white text-4xl font-bold tracking-tight @[480px]:text-5xl">
          {mockData.features.title}
        </h2>
        <p className="text-slate-600 dark:text-slate-400 text-lg max-w-2xl">
          {mockData.features.subtitle}
        </p>
      </div>
      
      <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
        {mockData.features.items.map((item) => (
          <div key={item.id} className="flex flex-col gap-6 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 p-8 backdrop-blur-sm hover:border-primary/50 transition-all">
            <div className="text-primary bg-primary/10 w-14 h-14 rounded-xl flex items-center justify-center">
              <span className="material-symbols-outlined text-3xl">{item.icon}</span>
            </div>
            <div className="flex flex-col gap-3">
              <h3 className="text-slate-900 dark:text-white text-xl font-bold">{item.title}</h3>
              <p className="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{item.description}</p>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Features;
