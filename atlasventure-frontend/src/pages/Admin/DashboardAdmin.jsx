import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { Calendar, Plus, Ticket } from "lucide-react";
import NavbarBDE from '../../Components/CommonBDE/NavbarBDE';
import SidebarBDE from '../../Components/CommonBDE/SidebarBDE';
import axios from "axios";

export default function DashboardAdmin() {
  const [stats, setStats] = useState({
    total_events: 0,
    total_reservations: 0,
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchStats = async () => {
      try {
        const token = localStorage.getItem("token");

        const res = await axios.get("http://127.0.0.1:8000/api/stats", {
          headers: { 
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
            "Content-Type": "application/json"
          },
        });

        console.log("Response Data:", res.data);

        const totalEvents = res.data.total_events 
          ?? (Array.isArray(res.data.totale_Evenment) ? res.data.totale_Evenment.length : res.data.totale_Evenment) 
          ?? 0;

        const totalReservations = res.data.total_reservations ?? 0;

        setStats({
          total_events: totalEvents,
          total_reservations: totalReservations
        });

      } catch (err) {
        console.error("Erreur lors du chargement des stats:", err.response?.data || err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchStats();
  }, []);

  return (
    <div className="flex h-screen bg-slate-50 overflow-hidden font-sans">
      {/* Sidebar à gauche */}
      <SidebarBDE />

      {/* Conteneur principal (Navbar + Contenu) */}
      <div className="flex-1 flex flex-col min-w-0 overflow-hidden">
        {/* Navbar en haut */}
        <NavbarBDE />

        {/* Zone de contenu défilable */}
        <main className="flex-1 overflow-y-auto p-8">
          <div className="max-w-7xl mx-auto space-y-6">
            
            {/* Header de la page */}
            <div className="flex justify-between items-center">
              <div>
                <h1 className="text-xl font-bold text-slate-900">Espace BDE Admin</h1>
                <p className="text-xs text-slate-500">
                  Gérez vos événements et suivez les réservations.
                </p>
              </div>
              <Link
                to="/admin/events/create"
                className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-semibold flex items-center gap-2 shadow-md transition-all"
              >
                <Plus className="w-4 h-4" /> Créer un événement
              </Link>
            </div>

            {/* Cartes de statistiques */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="p-5 bg-white rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm">
                <div className="p-3 bg-amber-50 rounded-xl text-amber-500">
                  <Calendar className="w-6 h-6" />
                </div>
                <div>
                  <p className="text-xs text-slate-400 font-medium">Total Événements</p>
                  <h3 className="text-lg font-bold text-slate-800">
                    {loading ? "..." : stats.total_events}
                  </h3>
                </div>
              </div>

              <div className="p-5 bg-white rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm">
                <div className="p-3 bg-emerald-50 rounded-xl text-emerald-500">
                  <Ticket className="w-6 h-6" />
                </div>
                <div>
                  <p className="text-xs text-slate-400 font-medium">Total Réservations</p>
                  <h3 className="text-lg font-bold text-slate-800">
                    {loading ? "..." : stats.total_reservations}
                  </h3>
                </div>
              </div>
            </div>

          </div>
        </main>
      </div>
    </div>
  );
}