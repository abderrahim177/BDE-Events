import React from "react";
import { Bell, User } from "lucide-react";

export default function Header() {
  return (
    <header className="h-16 bg-white border-b border-slate-100 px-8 flex items-center justify-between sticky top-0 z-10 font-sans shadow-sm">
      <div>
        <h2 className="text-sm font-bold text-slate-800">Panneau de Gestion</h2>
        <p className="text-[10px] text-slate-400">Bienvenue sur votre espace BDE</p>
      </div>

      <div className="flex items-center gap-4">
        {/* Notifications Icon */}
        <button className="p-2 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-100 transition-all relative">
          <Bell className="w-4 h-4" />
          <span className="w-2 h-2 rounded-full bg-amber-500 absolute top-1.5 right-1.5 border border-white"></span>
        </button>

        {/* User Profile */}
        <div className="flex items-center gap-3 pl-2 border-l border-slate-100">
          <div className="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs">
            <User className="w-4 h-4 text-amber-600" />
          </div>
          <div className="text-left hidden sm:block">
            <p className="text-xs font-semibold text-slate-700">Admin BDE</p>
            <p className="text-[10px] text-slate-400">admin@bde.com</p>
          </div>
        </div>
      </div>
    </header>
  );
}