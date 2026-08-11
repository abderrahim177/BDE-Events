import React, { useState } from "react";
import { User, Mail, Phone, Lock, Save, Shield, CheckCircle2, Ticket } from "lucide-react";

// Sub-component for Profile Skeleton Screen
const ProfileSkeleton = () => (
  <div className="p-6 md:p-8 max-w-5xl mx-auto space-y-6 font-sans animate-pulse">
    {/* Title Skeleton */}
    <div className="pb-2 border-b border-slate-200/60 space-y-2">
      <div className="h-6 bg-slate-200 rounded-lg w-40"></div>
      <div className="h-3 bg-slate-200 rounded-md w-72"></div>
    </div>

    {/* Overview Header Card Skeleton */}
    <div className="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-6">
      <div className="w-20 h-20 rounded-2xl bg-slate-200 flex-shrink-0"></div>

      <div className="flex-1 text-center md:text-left space-y-2.5 w-full">
        <div className="h-5 bg-slate-200 rounded-md w-48 mx-auto md:mx-0"></div>
        <div className="h-3.5 bg-slate-200 rounded-md w-36 mx-auto md:mx-0"></div>
        <div className="pt-1 flex items-center justify-center md:justify-start gap-2">
          <div className="h-5 bg-slate-200 rounded-full w-20"></div>
          <div className="h-5 bg-slate-200 rounded-full w-28"></div>
        </div>
      </div>

      {/* Quick Stats Skeleton */}
      <div className="flex items-center gap-4 pt-4 md:pt-0 border-t md:border-t-0 md:border-l border-slate-100 md:pl-6 w-full md:w-auto justify-around md:justify-start">
        <div className="space-y-1.5 flex flex-col items-center">
          <div className="h-6 bg-slate-200 rounded-md w-8"></div>
          <div className="h-3 bg-slate-200 rounded-md w-14"></div>
        </div>
      </div>
    </div>

    {/* Forms Skeleton Grid */}
    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
      {/* Personal Info Form Skeleton */}
      <div className="md:col-span-2 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-5">
        <div className="h-4 bg-slate-200 rounded-md w-48 pb-3 border-b border-slate-100"></div>

        <div className="space-y-4 pt-2">
          <div className="space-y-2">
            <div className="h-3 bg-slate-200 rounded w-24"></div>
            <div className="h-9 bg-slate-200 rounded-xl w-full"></div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div className="space-y-2">
              <div className="h-3 bg-slate-200 rounded w-24"></div>
              <div className="h-9 bg-slate-200 rounded-xl w-full"></div>
            </div>
            <div className="space-y-2">
              <div className="h-3 bg-slate-200 rounded w-24"></div>
              <div className="h-9 bg-slate-200 rounded-xl w-full"></div>
            </div>
          </div>

          <div className="pt-2 flex justify-end">
            <div className="h-9 bg-slate-200 rounded-xl w-48"></div>
          </div>
        </div>
      </div>

      {/* Security Form Skeleton */}
      <div className="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-5 h-fit">
        <div className="h-4 bg-slate-200 rounded-md w-28 pb-3 border-b border-slate-100"></div>

        <div className="space-y-3.5 pt-2">
          <div className="space-y-2">
            <div className="h-3 bg-slate-200 rounded w-32"></div>
            <div className="h-9 bg-slate-200 rounded-xl w-full"></div>
          </div>

          <div className="space-y-2">
            <div className="h-3 bg-slate-200 rounded w-36"></div>
            <div className="h-9 bg-slate-200 rounded-xl w-full"></div>
          </div>

          <div className="h-9 bg-slate-200 rounded-xl w-full mt-2"></div>
        </div>
      </div>
    </div>
  </div>
);

export default function Profile({ loading = false }) {
  const getStoredUser = () => {
    try {
      const stored = localStorage.getItem("user");
      return stored ? JSON.parse(stored) : {};
    } catch {
      return {};
    }
  };
  const storedUser = getStoredUser();
  const [formData, setFormData] = useState({
    name: storedUser.name || "Abdorrahim",
    email: storedUser.email || "abdorrahim@example.com",
    phone: storedUser.phone || "+212 600-000000",
    currentPassword: "",
    newPassword: "",
    confirmPassword: "",
  });

  const [isSaved, setIsSaved] = useState(false);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSaveProfile = (e) => {
    e.preventDefault();
    const updatedUser = { ...storedUser, name: formData.name, email: formData.email };
    localStorage.setItem("user", JSON.stringify(updatedUser));
    
    setIsSaved(true);
    setTimeout(() => setIsSaved(false), 3000);
  };

  // Render Skeleton when loading is true
  if (loading) {
    return <ProfileSkeleton />;
  }

  return (
    <div className="p-6 md:p-8 max-w-5xl mx-auto space-y-6 font-sans">
      {/* Header Title */}
      <div className="pb-2 border-b border-slate-200/60">
        <h1 className="text-lg font-bold text-slate-900 tracking-tight">Mon Profil</h1>
        <p className="text-[11px] text-slate-400 font-normal">
          Gérez vos informations personnelles et la sécurité de votre compte.
        </p>
      </div>

      {/* Profile Overview Card */}
      <div className="bg-white rounded-3xl p-6 border border-slate-100 shadow-[2px_4px_16px_rgba(0,0,0,0.03)] flex flex-col md:flex-row items-center gap-6">
        <div className="relative">
          <img
            src={storedUser?.avatar || "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200"}
            alt="Profile Avatar"
            className="w-20 h-20 rounded-2xl object-cover ring-4 ring-slate-50 border border-slate-200/60 shadow-sm"
          />
        </div>

        <div className="flex-1 text-center md:text-left space-y-1">
          <h2 className="text-base font-bold text-slate-800">{formData.name}</h2>
          <p className="text-xs text-slate-400 font-medium">{formData.email}</p>
          <div className="pt-1 flex items-center justify-center md:justify-start gap-2">
            <span className="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600 capitalize border border-slate-200/50">
              {storedUser?.role || "Étudiant"}
            </span>
            <span className="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100/60 flex items-center gap-1">
              <CheckCircle2 className="w-3 h-3" /> Compte Vérifié
            </span>
          </div>
        </div>

        {/* Quick Stats */}
        <div className="flex items-center gap-4 pt-4 md:pt-0 border-t md:border-t-0 md:border-l border-slate-100 md:pl-6 w-full md:w-auto justify-around md:justify-start">
          <div className="text-center">
            <span className="text-lg font-bold text-slate-800 block">04</span>
            <span className="text-[10px] text-slate-400 flex items-center gap-1 justify-center">
              <Ticket className="w-3 h-3 text-slate-400" /> Billets
            </span>
          </div>
        </div>
      </div>

      {/* Success Notification */}
      {isSaved && (
        <div className="p-3 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-medium flex items-center gap-2">
          <CheckCircle2 className="w-4 h-4" /> Les modifications ont été enregistrées avec succès.
        </div>
      )}

      {/* Settings Forms */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        {/* Personal Details Form */}
        <div className="md:col-span-2 bg-white rounded-3xl p-6 border border-slate-100 shadow-[2px_4px_16px_rgba(0,0,0,0.03)] space-y-5">
          <div className="flex items-center gap-2 pb-3 border-b border-slate-100">
            <User className="w-4 h-4 text-slate-500" />
            <h3 className="text-xs font-bold text-slate-800 uppercase tracking-wider">
              Informations Personnelles
            </h3>
          </div>

          <form onSubmit={handleSaveProfile} className="space-y-4">
            <div className="space-y-1.5">
              <label className="text-[11px] font-medium text-slate-600">Nom Complet</label>
              <div className="relative">
                <User className="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                <input
                  type="text"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  className="w-full pl-9 pr-4 py-2 bg-slate-50/70 border border-slate-200/80 rounded-xl text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-slate-300 transition-all duration-200"
                />
              </div>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="space-y-1.5">
                <label className="text-[11px] font-medium text-slate-600">Adresse Email</label>
                <div className="relative">
                  <Mail className="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                  <input
                    type="email"
                    name="email"
                    value={formData.email}
                    onChange={handleChange}
                    className="w-full pl-9 pr-4 py-2 bg-slate-50/70 border border-slate-200/80 rounded-xl text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-slate-300 transition-all duration-200"
                  />
                </div>
              </div>

              <div className="space-y-1.5">
                <label className="text-[11px] font-medium text-slate-600">Téléphone</label>
                <div className="relative">
                  <Phone className="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                  <input
                    type="text"
                    name="phone"
                    value={formData.phone}
                    onChange={handleChange}
                    className="w-full pl-9 pr-4 py-2 bg-slate-50/70 border border-slate-200/80 rounded-xl text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-slate-300 transition-all duration-200"
                  />
                </div>
              </div>
            </div>

            <div className="pt-2 flex justify-end">
              <button
                type="submit"
                className="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold flex items-center gap-2 shadow-sm transition-all duration-200"
              >
                <Save className="w-3.5 h-3.5" /> Enregistrer les modifications
              </button>
            </div>
          </form>
        </div>

        {/* Change Password Card */}
        <div className="bg-white rounded-3xl p-6 border border-slate-100 shadow-[2px_4px_16px_rgba(0,0,0,0.03)] space-y-5 h-fit">
          <div className="flex items-center gap-2 pb-3 border-b border-slate-100">
            <Shield className="w-4 h-4 text-slate-500" />
            <h3 className="text-xs font-bold text-slate-800 uppercase tracking-wider">
              Sécurité
            </h3>
          </div>

          <form onSubmit={(e) => e.preventDefault()} className="space-y-3.5">
            <div className="space-y-1.5">
              <label className="text-[11px] font-medium text-slate-600">Mot de passe actuel</label>
              <div className="relative">
                <Lock className="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                <input
                  type="password"
                  name="currentPassword"
                  placeholder="••••••••"
                  value={formData.currentPassword}
                  onChange={handleChange}
                  className="w-full pl-9 pr-4 py-2 bg-slate-50/70 border border-slate-200/80 rounded-xl text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-slate-300 transition-all duration-200"
                />
              </div>
            </div>

            <div className="space-y-1.5">
              <label className="text-[11px] font-medium text-slate-600">Nouveau mot de passe</label>
              <div className="relative">
                <Lock className="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                <input
                  type="password"
                  name="newPassword"
                  placeholder="••••••••"
                  value={formData.newPassword}
                  onChange={handleChange}
                  className="w-full pl-9 pr-4 py-2 bg-slate-50/70 border border-slate-200/80 rounded-xl text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-slate-300 transition-all duration-200"
                />
              </div>
            </div>

            <button
              type="button"
              className="w-full mt-2 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium border border-slate-200/60 transition-all duration-200"
            >
              Mettre à jour
            </button>
          </form>
        </div>
      </div>
    </div>
  );
}