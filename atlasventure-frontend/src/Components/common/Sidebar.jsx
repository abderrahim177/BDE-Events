import React from 'react';
import { Calendar, LogOut, Compass, Ticket, Bookmark, User } from 'lucide-react';

export default function Sidebar({ activeTab, setActiveTab, user }) {
  const menuItems = [
    { id: 'discover', label: 'Découvrir', icon: Compass },
    { id: 'my-tickets', label: 'Mes Billets', icon: Ticket },
    { id: 'saved', label: 'Enregistrés', icon: Bookmark },
    { id: 'profile', label: 'Mon Profil', icon: User },
  ];

  return (
    <aside className="w-64 bg-slate-900 text-slate-300 h-full p-5 flex flex-col justify-between border-r border-slate-800/60 select-none font-sans">
      <div className="space-y-8">
        {/* Brand Logo - Clay Touch */}
        <div className="flex items-center gap-3 px-2 pt-1">
          <div className="w-10 h-10 rounded-2xl bg-amber-500 text-slate-950 flex items-center justify-center font-bold shadow-[inset_-2px_-2px_6px_rgba(0,0,0,0.3),_2px_2px_8px_rgba(245,158,11,0.4)] transition-transform duration-300 hover:scale-105">
            <Calendar className="w-5 h-5 stroke-[2.5]" />
          </div>
          <div>
            <span className="font-bold text-base text-white tracking-tight block">BDE Events</span>
            <span className="text-[10px] text-slate-400 font-medium tracking-wide">STUDENT PORTAL</span>
          </div>
        </div>

        {/* Navigation Menu */}
        <div className="space-y-3">
          <p className="text-[10px] font-semibold text-slate-500 uppercase tracking-widest px-3">
            Navigation
          </p>

          <nav className="space-y-2">
            {menuItems.map((item) => {
              const Icon = item.icon;
              const isActive = activeTab === item.id;
              return (
                <button
                  key={item.id}
                  onClick={() => setActiveTab(item.id)}
                  className={`w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-medium transition-all duration-200 ${
                    isActive
                      ? 'bg-amber-500 text-slate-950 font-semibold shadow-[inset_-2px_-2px_4px_rgba(0,0,0,0.2),_0_4px_12px_rgba(245,158,11,0.25)] translate-x-1'
                      : 'text-slate-400 hover:text-white hover:bg-slate-800/50'
                  }`}
                >
                  <Icon className={`w-4 h-4 ${isActive ? 'text-slate-950' : 'text-slate-400'}`} />
                  {item.label}
                </button>
              );
            })}
          </nav>
        </div>
      </div>

      {/* User Card Footer */}
      <div className="p-2.5 bg-slate-800/40 rounded-2xl border border-slate-800/80 flex items-center justify-between shadow-[inset_1px_1px_2px_rgba(255,255,255,0.05)]">
        <div className="flex items-center gap-2.5 overflow-hidden">
          <img
            src={user?.avatar || "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100"}
            alt="Avatar"
            className="w-8 h-8 rounded-xl object-cover ring-2 ring-slate-700"
          />
          <div className="truncate">
            <h4 className="text-[11px] font-medium text-white truncate">{user?.name || "Abdorrahim"}</h4>
            <p className="text-[9px] text-slate-400 capitalize">{user?.role || "Student"}</p>
          </div>
        </div>
        <button className="p-1.5 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-lg transition duration-200">
          <LogOut className="w-3.5 h-3.5" />
        </button>
      </div>
    </aside>
  );
}