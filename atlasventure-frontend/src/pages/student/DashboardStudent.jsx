import React, { useEffect, useState } from "react";
import Sidebar from "../../Components/common/Sidebar";
import Header from "../../Components/common/Navbar";
import EventCard from "../../Components/common/EventCard";
import axios from "axios";
n
export default function StudentDashboard() {
  const [activeTab, setActiveTab] = useState("discover");
  const [searchQuery, setSearchQuery] = useState("");
  const [filter, setFilter] = useState("Tous");
  
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const user = { name: "Abdorrahim", role: "student" };

  useEffect(() => {
    const fetchevent = async () => {
      try {
        setLoading(true);
        const token = localStorage.getItem("token");

        const response = await axios.get("http://localhost:8000/api/students", {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
          },
        });

        const data = Array.isArray(response.data)
          ? response.data
          : response.data.events || response.data.data || [];

        setEvents(data);
      } catch (err) {
        console.error("Erreur API:", err.response?.data || err.message);
        setError("Impossible de charger les événements.");
      } finally {
        setLoading(false);
      }
    };

    fetchevent();
  }, []);

  const handleReserve = (eventId) => {
    console.log("Réservation pour ID:", eventId);
  };

  // Filter Logic
  const filteredEvents = events.filter((event) => {
    const matchesSearch =
      event.title?.toLowerCase().includes(searchQuery.toLowerCase()) ||
      event.lieu?.toLowerCase().includes(searchQuery.toLowerCase());
    if (filter === "Gratuits") return matchesSearch && event.is_free;
    if (filter === "Payants") return matchesSearch && !event.is_free;
    return matchesSearch;
  });

  return (
    <div className="flex h-screen w-full bg-[#f8fafc] font-sans text-slate-700 antialiased overflow-hidden selection:bg-indigo-100 selection:text-indigo-900">
      
      {/* Sidebar with subtle border */}
      <div className="w-64 flex-shrink-0 h-full border-r border-slate-200/80 bg-white">
        <Sidebar activeTab={activeTab} setActiveTab={setActiveTab} user={user} />
      </div>

      {/* Main Container */}
      <div className="flex-1 flex flex-col h-full min-w-0 overflow-y-auto">
        <Header user={user} searchQuery={searchQuery} setSearchQuery={setSearchQuery} />

        <main className="p-6 md:p-8 flex-1 max-w-7xl w-full mx-auto space-y-6 animate-fade-in">
          
          {/* Header & Muted Modern Filters */}
          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/60">
            <div>
              <h1 className="text-xl font-semibold text-slate-800 tracking-tight">
                Découvrir
              </h1>
              <p className="text-xs text-slate-400 mt-0.5 font-normal">
                Explorez les événements disponibles et réservez votre place.
              </p>
            </div>

            {/* Micro Filter Pills */}
            <div className="bg-slate-100/80 p-1 rounded-xl flex items-center gap-1 self-start border border-slate-200/50">
              {["Tous", "Gratuits", "Payants", "Cette semaine"].map((f) => (
                <button
                  key={f}
                  onClick={() => setFilter(f)}
                  className={`px-3 py-1 rounded-lg text-[11px] font-medium transition-all duration-200 ${
                    filter === f
                      ? "bg-white text-slate-800 shadow-sm border border-slate-200/60"
                      : "text-slate-500 hover:text-slate-800 hover:bg-white/50"
                  }`}
                >
                  {f}
                </button>
              ))}
            </div>
          </div>

          {/* Loading State with Smooth Spinner */}
          {loading && (
            <div className="flex flex-col items-center justify-center py-24 gap-3 text-slate-400">
              <div className="w-6 h-6 border-2 border-slate-300 border-t-indigo-600 rounded-full animate-spin"></div>
              <p className="text-xs font-light">Chargement en cours...</p>
            </div>
          )}

          {/* Minimal Error Card */}
          {error && !loading && (
            <div className="p-3.5 rounded-xl bg-rose-50/60 border border-rose-100 text-rose-600 text-xs font-medium flex items-center justify-between shadow-sm">
              <span>{error}</span>
              <button 
                onClick={() => window.location.reload()} 
                className="underline text-[11px] hover:text-rose-800"
              >
                Réessayer
              </button>
            </div>
          )}

          {/* Event Grid with Soft Animations */}
          {!loading && !error && (
            <>
              {filteredEvents.length === 0 ? (
                <div className="flex flex-col items-center justify-center py-20 text-center">
                  <div className="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3 text-xs">
                    <i className="fa-regular fa-folder-open text-base"></i>
                  </div>
                  <p className="text-xs text-slate-500 font-medium">Aucun événement trouvé</p>
                  <p className="text-[11px] text-slate-400 font-light mt-0.5">Essayez de modifier vos filtres ou votre recherche.</p>
                </div>
              ) : (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 pb-10">
                  {filteredEvents.map((event) => (
                    <div 
                      key={event.id} 
                      className="transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-200/50 rounded-2xl"
                    >
                      <EventCard event={event} onReserve={handleReserve} />
                    </div>
                  ))}
                </div>
              )}
            </>
          )}

        </main>
      </div>
    </div>
  );
}