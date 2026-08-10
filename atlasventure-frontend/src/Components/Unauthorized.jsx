// src/pages/Unauthorized.jsx
import React from "react";
import { useNavigate } from "react-router-dom";
import { ShieldAlert, ArrowLeft } from "lucide-react";

export default function Unauthorized() {
  const navigate = useNavigate();
  const userRole = localStorage.getItem("user_role")?.toLowerCase()?.trim();

  const handleBack = () => {
    if (userRole === "student") {
      navigate("/student/dashboard", { replace: true });
    } else if (userRole === "admin" || userRole === "bde") {
      navigate("/admin/dashboard", { replace: true });
    } else {
      navigate("/login", { replace: true });
    }
  };

  return (
    <div className="min-h-screen bg-slate-50 flex items-center justify-center p-4 font-sans">
      <div className="max-w-md w-full bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center space-y-4">
        <div className="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mx-auto">
          <ShieldAlert className="w-8 h-8" />
        </div>
        <div>
          <h1 className="text-xl font-bold text-slate-900">Accès Refusé (403)</h1>
          <p className="text-xs text-slate-500 mt-1">
            Vous n'avez pas les autorisations nécessaires pour accéder à cette page.
          </p>
        </div>
        <button
          onClick={handleBack}
          className="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-semibold flex items-center justify-center gap-2 transition-all"
        >
          <ArrowLeft className="w-4 h-4" /> Return à mon espace
        </button>
      </div>
    </div>
  );
}