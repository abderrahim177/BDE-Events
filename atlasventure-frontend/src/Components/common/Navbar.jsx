import React from 'react';
import { Search, Bell, ChevronDown } from 'lucide-react';

export default function Navbar({searchQuery, setSearchQuery, loading = false }) {
  let userData = null;
  try {
    const storedUser = localStorage.getItem('user');
    userData = storedUser ? JSON.parse(storedUser) : null;
  } catch (e) {
    console.error("Erreur lors du parsing du localStorage user:", e);
  }

  const currentUser = userData || {};

  if (loading) {
    return (
      <header className="w-full flex justify-between items-center px-8 py-3.5 bg-[#f8fafc] border-b border-slate-200/60 font-sans animate-pulse">
        {/* Search Box Skeleton */}
        <div className="w-72 h-8 bg-slate-200 rounded-xl"></div>

        {/* Right Actions Skeleton */}
        <div className="flex items-center gap-3">
          {/* Bell Skeleton */}
          <div className="w-8 h-8 rounded-xl bg-slate-200"></div>

          {/* User Profile Skeleton */}
          <div className="flex items-center gap-2.5 px-3 py-1 bg-slate-200 rounded-xl w-36 h-9">
            <div className="w-7 h-7 rounded-lg bg-slate-300"></div>
            <div className="flex-1 space-y-1">
              <div className="h-2.5 bg-slate-300 rounded w-16"></div>
              <div className="h-2 bg-slate-300 rounded w-10"></div>
            </div>
          </div>
        </div>
      </header>
    );
  }

  return (
    <header className="w-full flex justify-between items-center px-8 py-3.5 bg-[#f8fafc] border-b border-slate-200/60 font-sans">
      {/* Search Input Box with Claymorphism Inset */}
      <div className="relative w-72">
        <Search className="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
        <input
          type="text"
          placeholder="Rechercher un événement..."
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          className="w-full pl-9 pr-4 py-2 bg-slate-100/70 border border-slate-200/80 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-slate-300 focus:shadow-[inset_2px_2px_4px_rgba(0,0,0,0.04)] transition-all duration-200"
        />
      </div>

      {/* Right Actions */}
      <div className="flex items-center gap-3">
        {/* Notification Bell */}
        <button className="relative p-2 rounded-xl bg-white border border-slate-200/60 text-slate-600 shadow-[2px_2px_6px_rgba(0,0,0,0.03)] hover:shadow-[inset_-1px_-1px_3px_rgba(0,0,0,0.05)] transition-all duration-200">
          <Bell className="w-4 h-4" />
          <span className="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-amber-500 rounded-full ring-2 ring-white"></span>
        </button>

        {/* User Profile */}
        <div className="flex items-center gap-2.5 pl-2 pr-3 py-1 bg-white border border-slate-200/60 rounded-xl shadow-[2px_2px_6px_rgba(0,0,0,0.03)] hover:shadow-[inset_-1px_-1px_3px_rgba(0,0,0,0.05)] cursor-pointer transition-all duration-200">
          <img
            src={currentUser?.avatar || "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100"}
            alt="Profile"
            className="w-7 h-7 rounded-lg object-cover"
          />
          <div className="text-left">
            <h4 className="text-[11px] font-semibold text-slate-800 leading-tight">
              {currentUser?.name || "Abdorrahim"}
            </h4>
            <p className="text-[9px] text-slate-400 capitalize">
              {currentUser?.role || "student"}
            </p>
          </div>
          <ChevronDown className="w-3.5 h-3.5 text-slate-400 ml-1" />
        </div>
      </div>
    </header>
  );
}