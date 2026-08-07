import React from 'react';
import { Search, Bell, ChevronDown } from 'lucide-react';

export default function Header({ user, searchQuery, setSearchQuery }) {
  return (
    <header className="w-full flex justify-between items-center px-8 py-4 bg-white border-b border-slate-100">
      {/* Search Input Box */}
      <div className="relative w-80">
        <Search className="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
        <input
          type="text"
          placeholder="Rechercher un événement..."
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          className="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200/80 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition"
        />
      </div>

      {/* Right Actions */}
      <div className="flex items-center gap-4">
        {/* Notification Bell */}
        <button className="relative p-2.5 rounded-xl border border-slate-200/80 text-slate-600 hover:bg-slate-50 transition">
          <Bell className="w-4 h-4" />
          <span className="absolute top-2 right-2 w-2 h-2 bg-indigo-600 rounded-full"></span>
        </button>

        {/* User Profile */}
        <div className="flex items-center gap-3 pl-3 pr-2 py-1.5 rounded-xl border border-slate-200/80 hover:bg-slate-50 cursor-pointer transition">
          <img
            src={user?.avatar || "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100"}
            alt="Profile"
            className="w-8 h-8 rounded-lg object-cover"
          />
          <div className="text-left">
            <h4 className="text-xs font-semibold text-slate-800 leading-tight">{user?.name || "abdorrahim"}</h4>
            <p className="text-[10px] text-slate-400 font-medium capitalize">{user?.role || "student"}</p>
          </div>
          <ChevronDown className="w-4 h-4 text-slate-400 ml-1" />
        </div>
      </div>
    </header>
  );
}