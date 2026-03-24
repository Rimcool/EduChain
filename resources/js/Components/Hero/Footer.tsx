import React from 'react';
import { mockData } from '../../data/mockData';

interface FooterProps {
  readonly className?: string;
}

export const Footer: React.FC<FooterProps> = ({ className = '' }) => {
  return (
    <footer className={`bg-background-light dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 py-12 ${className}`}>
      <div className="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
        <div className="flex items-center gap-2">
          <div className="text-primary flex size-8 items-center justify-center bg-primary/10 rounded-lg">
            <span className="material-symbols-outlined text-xl">school</span>
          </div>
          <h2 className="text-slate-900 dark:text-white text-xl font-bold">{mockData.header.logoText}</h2>
        </div>
        <p className="text-slate-500 dark:text-slate-400 text-sm">{mockData.footer.copyright}</p>
        <div className="flex gap-6">
          {mockData.footer.links.map((link) => (
            <a key={link.id} href={link.href} className="text-slate-400 hover:text-primary cursor-pointer transition-colors block">
              <span className="material-symbols-outlined">{link.icon}</span>
            </a>
          ))}
        </div>
      </div>
    </footer>
  );
};

export default Footer;
