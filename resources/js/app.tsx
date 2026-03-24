import React from 'react';
import { createRoot } from 'react-dom/client';
import HeroScreen from './Components/Hero/HeroScreen';

const activeHeroElement = document.getElementById('hero-react-root');

if (activeHeroElement) {
    const root = createRoot(activeHeroElement);
    root.render(
        <React.StrictMode>
            <div className="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 selection:bg-primary/30">
                <HeroScreen />
            </div>
        </React.StrictMode>
    );
}
