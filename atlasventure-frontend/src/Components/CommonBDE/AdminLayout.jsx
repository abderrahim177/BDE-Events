import React from "react";
import { Outlet } from "react-router-dom";
import Aside from "./SidebarBDE";
import Header from "./NavbarBDE";

export default function AdminLayout() {
  return (
    <div className="flex min-h-screen bg-slate-50">
      {/* Sidebar On the Left (Dark mode) */}
      <Aside />

      <div className="flex-1 flex flex-col min-w-0">
        {/* Header On Top (Light mode) */}
        <Header />

        {/* Dynamic Content Area (Light mode) */}
        <main className="flex-1 p-6 md:p-8 overflow-y-auto">
          <Outlet />
        </main>
      </div>
    </div>
  );
}