import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import NavbarBDE from '../../Components/CommonBDE/NavbarBDE';
import SidebarBDE from '../../Components/CommonBDE/SidebarBDE';

export default function CreateEvent() {
  const navigate = useNavigate();
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
      <SidebarBDE />

      {/* Main Content Area */}
      <div className="flex-1 flex flex-col overflow-y-auto min-w-0">
        {/* Navbar Component */}
        <NavbarBDE />

        {/* Page Content Container */}
        <main className="p-4 sm:p-8 max-w-3xl w-full mx-auto my-auto">
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
                    setFormData({ ...formData, title: e.target.value })
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
                    setFormData({ ...formData, description: e.target.value })
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
                      setFormData({ ...formData, datetime: e.target.value })
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
                      setFormData({ ...formData, lieu: e.target.value })
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
                    setFormData({ ...formData, max_people: e.target.value })
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
        </main>
      </div>
    </div>
  );
}