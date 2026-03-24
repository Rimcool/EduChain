import React, { useState } from 'react';

interface VerifyData {
  student_name: string;
  roll_number: string;
  degree_title: string;
  university_name: string;
  graduation_year: string;
}

export const VerifyScanner: React.FC = () => {
  const [formData, setFormData] = useState<VerifyData>({
    student_name: '',
    roll_number: '',
    degree_title: '',
    university_name: '',
    graduation_year: ''
  });
  const [loading, setLoading] = useState(false);
  const [result, setResult] = useState<any>(null);
  const [error, setError] = useState<string | null>(null);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError(null);
    setResult(null);

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    try {
      const res = await fetch('/api/verify/public', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(formData)
      });
      
      const data = await res.json();
      setResult(data);
    } catch (err: any) {
      setError(err.message || 'Verification failed');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="bg-[#221610]/95 backdrop-blur-md rounded-2xl border border-primary/20 p-6 md:p-8 shadow-2xl w-full max-w-xl mx-auto neon-glow">
      <div className="flex items-center justify-center p-4 pb-6">
        <h2 className="text-slate-100 text-2xl font-bold leading-tight tracking-[-0.015em] text-center">Identity Verification</h2>
      </div>

      <form onSubmit={handleSubmit} className="flex flex-col gap-5">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div className="flex flex-col gap-2">
            <label className="text-xs font-bold uppercase tracking-widest text-primary/80 px-1">Student Name</label>
            <div className="relative">
              <span className="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/60">person</span>
              <input type="text" name="student_name" placeholder="e.g., Rimla Shehad" required onChange={handleChange}
                className="holographic-input w-full h-14 pl-12 pr-4 rounded-lg text-slate-100 placeholder:text-slate-500 bg-transparent transition-all" />
            </div>
          </div>
          <div className="flex flex-col gap-2">
            <label className="text-xs font-bold uppercase tracking-widest text-primary/80 px-1">Roll Number</label>
            <div className="relative">
              <span className="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/60">badge</span>
              <input type="text" name="roll_number" placeholder="e.g., FA-BS91-102" required onChange={handleChange}
                className="holographic-input w-full h-14 pl-12 pr-4 rounded-lg text-slate-100 placeholder:text-slate-500 bg-transparent transition-all" />
            </div>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div className="flex flex-col gap-2">
            <label className="text-xs font-bold uppercase tracking-widest text-primary/80 px-1">Degree Title</label>
            <div className="relative">
              <span className="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/60">school</span>
              <input type="text" name="degree_title" placeholder="e.g., Software Engineering" required onChange={handleChange}
                className="holographic-input w-full h-14 pl-12 pr-4 rounded-lg text-slate-100 placeholder:text-slate-500 bg-transparent transition-all" />
            </div>
          </div>
          <div className="flex flex-col gap-2">
            <label className="text-xs font-bold uppercase tracking-widest text-primary/80 px-1">University</label>
            <div className="relative">
              <span className="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/60">account_balance</span>
              <input type="text" name="university_name" placeholder="e.g., Karachi University" required onChange={handleChange}
                className="holographic-input w-full h-14 pl-12 pr-4 rounded-lg text-slate-100 placeholder:text-slate-500 bg-transparent transition-all" />
            </div>
          </div>
        </div>

        <div className="flex flex-col gap-2">
          <label className="text-xs font-bold uppercase tracking-widest text-primary/80 px-1">Graduation Year</label>
          <div className="relative">
            <span className="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/60">calendar_today</span>
            <input type="number" name="graduation_year" placeholder="YYYY" min="1947" max="2026" required onChange={handleChange}
              className="holographic-input w-full h-14 pl-12 pr-4 rounded-lg text-slate-100 placeholder:text-slate-500 bg-transparent transition-all" />
          </div>
        </div>

        <div className="mt-4">
          <button type="submit" disabled={loading} className="w-full h-14 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
            <span>{loading ? 'Scanning...' : 'Scan Degree'}</span>
            <span className="material-symbols-outlined">{loading ? 'hourglass_empty' : 'document_scanner'}</span>
          </button>
        </div>
      </form>

      {error && (
        <div className="mt-6 p-4 border border-red-500/30 rounded-xl text-red-500 text-sm holographic-input" style={{background: 'linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(239, 68, 68, 0.15) 100%)'}}>
          {error}
        </div>
      )}

      {result && (
        <div className="mt-8 pt-6 border-t border-primary/20">
          <div className="flex items-center justify-between mb-4">
            <div className={`px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border ${
              result.result === 'real' ? 'bg-green-500/10 text-green-400 border-green-500/30 shadow-[0_0_10px_rgba(34,197,94,0.2)]' :
              result.result === 'fake' ? 'bg-red-500/10 text-red-400 border-red-500/30 shadow-[0_0_10px_rgba(239,68,68,0.2)]' :
              'bg-amber-500/10 text-amber-400 border-amber-500/30 shadow-[0_0_10px_rgba(245,158,11,0.2)]'
            }`}>
              {result.result}
            </div>
            <div className="text-3xl font-black text-white">{result.score}%</div>
          </div>
          
          <p className="text-slate-400 text-sm mb-6 px-1">{result.reason}</p>
          
          <div className="space-y-3 mb-6">
            {result.layers?.map((layer: any, i: number) => (
              <div key={i} className={`flex items-center justify-between p-4 rounded-xl border ${layer.pass ? 'border-green-500/20 bg-green-500/5' : 'border-red-500/20 bg-red-500/5'}`}>
                <span className="text-sm text-slate-300">{layer.msg}</span>
                <span className={`font-bold text-sm ${layer.pass ? 'text-green-400' : 'text-red-400'}`}>{layer.grade}</span>
              </div>
            ))}
          </div>

          <div className="holographic-input p-5 rounded-xl flex justify-between items-center">
            <span className="text-primary/80 text-xs uppercase tracking-widest font-bold">Verification Code</span>
            <span className="font-mono text-white font-bold tracking-widest bg-black/30 px-3 py-1 rounded border border-primary/30">{result.code}</span>
          </div>
        </div>
      )}
    </div>
  );
};

export default VerifyScanner;

