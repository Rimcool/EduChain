import React from 'react';
import { mockData } from '../../data/mockData';

interface StatsProps {
  readonly className?: string;
}

export const Stats: React.FC<StatsProps> = ({ className = '' }) => {
  return (
    <div className={`bg-slate-100 dark:bg-slate-900/40 border-y border-slate-200 dark:border-slate-800 ${className}`}>
      <div className="max-w-7xl mx-auto px-6 py-12 flex flex-wrap gap-8">
        {mockData.stats.map((stat) => (
          <div key={stat.id} className="flex min-w-[200px] flex-1 flex-col gap-2 rounded-2xl p-8 bg-white dark:bg-background-dark shadow-sm border border-slate-200 dark:border-slate-800">
            <p className="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-widest">{stat.label}</p>
            <p className="text-slate-900 dark:text-primary text-4xl font-black">{stat.value}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Stats;
