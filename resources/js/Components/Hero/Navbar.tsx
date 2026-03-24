import React from 'react';
import { mockData } from '../../data/mockData';

interface NavbarProps {
  readonly className?: string;
}

export const Navbar: React.FC<NavbarProps> = ({ className = '' }) => {
  return (
    <nav className={`flex flex-wrap items-center bg-transparent p-6 justify-between max-w-7xl mx-auto w-full z-10 ${className}`}>
      <div className="flex items-center gap-2">
        <div className="text-primary flex size-10 shrink-0 items-center justify-center bg-primary/10 rounded-lg">
          <span className="material-symbols-outlined text-3xl">school</span>
        </div>
        <h2 className="text-slate-900 dark:text-white text-2xl font-bold leading-tight tracking-tight">
          {mockData.header.logoText}
        </h2>
      </div>
      
      <div className="hidden md:flex gap-8 items-center">
        {mockData.header.navLinks.slice(0, 2).map((link) => (
          <a key={link.id} href={link.href} className="text-sm font-medium hover:text-primary transition-colors">
            {link.label}
          </a>
        ))}
        <a 
          href={mockData.header.navLinks[2].href} 
          className="text-primary text-sm font-bold border border-primary/30 px-6 py-2 rounded-lg hover:bg-primary/10 transition-colors"
        >
          {mockData.header.navLinks[2].label}
        </a>
      </div>
      
      <div className="md:hidden">
        <span className="material-symbols-outlined">menu</span>
      </div>
    </nav>
  );
};

export default Navbar;
