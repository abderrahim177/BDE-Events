import React, { useState, useEffect } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import NavbarBDE from '../../Components/CommonBDE/NavbarBDE';
import SidebarBDE from '../../Components/CommonBDE/SidebarBDE';

// Skeleton Screen 
const FormSkeleton = () => (
  <div className="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6 animate-pulse">
    {/* Header Skeleton */}
    <div className="space-y-2">
      <div className="h-6 bg-slate-200 rounded-md w-1/3"></div>
      <div className="h-3 bg-slate-100 rounded-md w-2/3"></div>
    </div>

    {/* Inputs Skeleton */}
    <div className="space-y-4">
      {/* Titre */}
      <div className="space-y-1.5">
        <div className="h-3 bg-slate-200 rounded w-1/4"></div>
        <div className="h-10 bg-slate-100 rounded-xl w-full"></div>
      </div>

      {/* Description */}
      <div className="space-y-1.5">
        <div className="h-3 bg-slate-200 rounded w-1/4"></div>
        <div className="h-24 bg-slate-100 rounded-xl w-full"></div>
      </div>

      {/* Grid: Date & Lieu */}
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div className="space-y-1.5">
          <div className="h-3 bg-slate-200 rounded w-1/3"></div>
          <div className="h-10 bg-slate-100 rounded-xl w-full"></div>
        </div>
        <div className="space-y-1.5">
          <div className="h-3 bg-slate-200 rounded w-1/3"></div>
          <div className="h-10 bg-slate-100 rounded-xl w-full"></div>
        </div>
      </div>

      {/* Capacité Max */}
      <div className="space-y-1.5">
        <div className="h-3 bg-slate-200 rounded w-1/4"></div>
        <div className="h-10 bg-slate-100 rounded-xl w-full"></div>
      </div>

      {/* Button Skeleton */}
      <div className="h-12 bg-slate-200 rounded-xl w-full pt-2"></div>
    </div>
  </div>
);

export default function CreateEvent() {
  const navigate = useNavigate();
  const [pageLoading, setPageLoading] = useState(true); 
  const [loading, setLoading] = useState(false);
  const [errorMsg, setErrorMsg] = useState("");

  const [formData, setFormData] = useState({
    title: "",
    datetime: "",
    description: "",
    lieu: "",
    max_people: 40,
    price: 0,
    is_free: true,
  });

  useEffect(() => {
    const timer = setTimeout(() => {
      setPageLoading(false);
    }, 1200); 
    return () => clearTimeout(timer);
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault(); 
    setErrorMsg("");
    setLoading(true);
    try {
      const token = localStorage.getItem("token");
      const response = await axios.post(
        "http://127.0.0.1:8000/api/admin/create",
        formData,
        {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
            "Content-Type": "application/json",
          },
        }
      );
      if (response.status === 200 || response.status === 201) {
        navigate("/admin/events/manage");
      }
    } catch (err) {
      console.error("Erreur API:", err.response?.data || err.message);
      setErrorMsg(
        err.response?.data?.message ||
          "Impossible de créer l'événement. Vérifiez les champs."
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="flex h-screen bg-slate-50 overflow-hidden font-sans">
      {/* Sidebar Component */}
      <SidebarBDE loading={pageLoading} />

      {/* Main Content Area */}
      <div className="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
        {/* Navbar Component */}
        <NavbarBDE loading={pageLoading} />

        {/* Page Content Container (قابل للتمرير وبدون my-auto) */}
        <main className="flex-1 overflow-y-auto p-4 sm:p-8">
          <div className="max-w-3xl w-full mx-auto">
            {pageLoading ? (
              <FormSkeleton />
            ) : (
              <div className="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                <div>
                  <h2 className="text-xl font-bold text-slate-900 tracking-tight">
                    Créer un nouvel événement
                  </h2>
                  <p className="text-xs text-slate-400 mt-1">
                    Remplissez le formulaire ci-dessous pour publier un événement.
                  </p>
                </div>

                {errorMsg && (
                  <div className="p-3 bg-rose-50 border border-rose-100 rounded-xl text-rose-600 text-xs font-medium">
                    {errorMsg}
                  </div>
                )}

                <form onSubmit={handleSubmit} className="space-y-4 text-xs">
                  <div>
                    <label className="block font-medium text-slate-700 mb-1">
                      Titre de l'événement
                    </label>
                    <input
                      type="text"
                      value={formData.title}
                      placeholder="Ex: Soirée d'intégration"
                      className="w-full p-2.5 rounded-xl border border-slate-200 outline-none focus:border-amber-500 transition-all"
                      onChange={(e) =>
                        setFormData((prev) => ({ ...prev, title: e.target.value }))
                      }
                    />
                  </div>

                  <div>
                    <label className="block font-medium text-slate-700 mb-1">
                      Description de l'événement
                    </label>
                    <textarea
                      rows="4"
                      value={formData.description}
                      placeholder="Saisissez une description détaillée..."
                      className="w-full p-2.5 rounded-xl border border-slate-200 outline-none focus:border-amber-500 transition-all resize-none"
                      onChange={(e) =>
                        setFormData((prev) => ({ ...prev, description: e.target.value }))
                      }
                    />
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label className="block font-medium text-slate-700 mb-1">
                        Date & Heure
                      </label>
                      <input
                        type="datetime-local"
                        value={formData.datetime}
                        className="w-full p-2.5 rounded-xl border border-slate-200 outline-none focus:border-amber-500 transition-all"
                        onChange={(e) =>
                          setFormData((prev) => ({ ...prev, datetime: e.target.value }))
                        }
                      />
                    </div>
                    <div>
                      <label className="block font-medium text-slate-700 mb-1">
                        Lieu
                      </label>
                      <input
                        type="text"
                        value={formData.lieu}
                        placeholder="Ex: Amphithéâtre A"
                        className="w-full p-2.5 rounded-xl border border-slate-200 outline-none focus:border-amber-500 transition-all"
                        onChange={(e) =>
                          setFormData((prev) => ({ ...prev, lieu: e.target.value }))
                        }
                      />
                    </div>
                  </div>

                  <div>
                    <label className="block font-medium text-slate-700 mb-1">
                      Capacité Max (Places)
                    </label>
                    <input
                      type="number"
                      min="1"
                      value={formData.max_people}
                      className="w-full p-2.5 rounded-xl border border-slate-200 outline-none focus:border-amber-500 transition-all"
                      onChange={(e) =>
                        setFormData((prev) => ({ ...prev, max_people: e.target.value }))
                      }
                    />
                  </div>

                  <button
                    type="submit"
                    disabled={loading}
                    className="w-full py-3 bg-amber-500 hover:bg-amber-600 disabled:bg-amber-300 text-white font-semibold rounded-xl transition-all flex items-center justify-center gap-2 shadow-sm"
                  >
                    {loading ? (
                      <>
                        <span className="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                        <span>Création en cours...</span>
                      </>
                    ) : (
                      "Publier l'événement"
                    )}
                  </button>
                </form>
              </div>
            )}
          </div>
        </main>
      </div>
    </div>
  );
}