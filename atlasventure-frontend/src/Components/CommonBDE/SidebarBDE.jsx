import React from "react";
import { NavLink } from "react-router-dom";
import { LayoutDashboard, CalendarPlus, Settings, Ticket, LogOut } from "lucide-react";

export default function Aside() {
  const navItems = [
    { name: "Dashboard", path: "/admin/dashboard", icon: LayoutDashboard },
    { name: "Créer Événement", path: "/admin/events/create", icon: CalendarPlus },
    { name: "Gérer Événements", path: "/admin/events/manage", icon: Settings },
  ];

  return (
    <aside className="w-64 bg-slate-900 text-slate-300 min-h-screen p-5 flex flex-col justify-between border-r border-slate-800 shadow-xl font-sans">
      <div className="space-y-8">
        {/* Logo / Title */}
        <div className="flex items-center gap-3 px-2">
          <div className="w-9 h-9 rounded-2xl bg-amber-500 flex items-center justify-center text-slate-950 font-bold text-lg shadow-lg shadow-amber-500/20">
            B
          </div>
          <div>
            <h2 className="text-sm font-bold text-white tracking-wide">BDE Platform</h2>
            <p className="text-[10px] text-slate-400">Espace Admin</p>
          </div>
        </div>

        {/* Navigation Links */}
        <nav className="space-y-1.5">
          {navItems.map((item) => {
            const Icon = item.icon;
            return (
              <NavLink
                key={item.path}
                to={item.path}
                className={({ isActive }) =>
                  `flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all duration-200 ${
                    isActive
                      ? "bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20"
                      : "text-slate-400 hover:text-slate-200 hover:bg-slate-800/60"
                  }`
                }
              >
                <Icon className="w-4 h-4" />
                <span>{item.name}</span>
              </NavLink>
            );
          })}
        </nav>
      </div>

      {/* Logout Button */}
      <div className="pt-4 border-t border-slate-800">
        <button
          onClick={() => {
            localStorage.removeItem("token");
            window.location.href = "/login";
          }}
          className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-all"
        >
          <LogOut className="w-4 h-4" />
          <span>Déconnexion</span>
        </button>
      </div>
    </aside>
  );
}