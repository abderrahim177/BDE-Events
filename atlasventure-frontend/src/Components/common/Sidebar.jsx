import React from 'react';
import { Compass, Ticket, User, LogOut, Calendar } from 'lucide-react';

export default function Sidebar({ activeTab, setActiveTab, user }) {
  const menuItems = [
    { id: 'discover', label: 'Découvrir', icon: Compass },
    { id: 'tickets', label: 'Mes Billets', icon: Ticket },
    { id: 'profile', label: 'Mon Profil', icon: User },
  ];

  return (
    <aside className="w-64 bg-slate-900 text-slate-300 h-full p-6 flex flex-col justify-between border-r border-slate-800 select-none">
      <div>
        {/* Brand Logo */}
        <div className="flex items-center gap-3 px-2 mb-10">
          <div className="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-600/30">
            <Calendar className="w-5 h-5" />
          </div>
          <span className="font-bold text-xl text-white tracking-tight">BDE-Events</span>
        </div>

        {/* Navigation Menu */}
        <p className="text-[11px] font-semibold text-slate-500 uppercase tracking-wider px-3 mb-3">
          Menu
        </p>

        <nav className="space-y-1.5">
          {menuItems.map((item) => {
            const Icon = item.icon;
            const isActive = activeTab === item.id;
            return (
              <button
                key={item.id}
                onClick={() => setActiveTab(item.id)}
                className={`w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 ${
                  isActive
                    ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20'
                    : 'text-slate-400 hover:text-white hover:bg-slate-800/60'
                }`}
              >
                <Icon className={`w-5 h-5 ${isActive ? 'text-white' : 'text-slate-400'}`} />
                {item.label}
              </button>
            );
          })}
        </nav>
      </div>

      {/* User Card Footer */}
      <div className="p-3 bg-slate-800/50 border border-slate-800 rounded-2xl flex items-center justify-between">
        <div className="flex items-center gap-3 overflow-hidden">
          <img
            src={user?.avatar || "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100"}
            alt="Avatar"
            className="w-9 h-9 rounded-xl object-cover ring-2 ring-slate-700"
          />
          <div className="truncate">
            <h4 className="text-xs font-semibold text-white truncate">{user?.name || "abdorrahim"}</h4>
            <p className="text-[11px] text-slate-400 capitalize">{user?.role || "Student"}</p>
          </div>
        </div>
        <button className="p-2 text-slate-400 hover:text-red-400 hover:bg-slate-800 rounded-lg transition">
          <LogOut className="w-4 h-4" />
        </button>
      </div>
    </aside>
  );
}