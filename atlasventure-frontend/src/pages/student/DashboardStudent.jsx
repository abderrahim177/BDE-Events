import React, { useEffect, useState } from "react";
import Sidebar from "../../Components/common/Sidebar";
import Header from "../../Components/common/Navbar";
import EventCard from "../../Components/common/EventCard";
import Mytickets from "./MyTickets"; 
import axios from "axios";

export default function StudentDashboard() {
  const [activeTab, setActiveTab] = useState("discover"); 
  const [searchQuery, setSearchQuery] = useState("");
  const [filter, setFilter] = useState("Tous");
  
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [reservingId, setReservingId] = useState(null); 
  const [error, setError] = useState(null);

  const user = { name: "Abdorrahim", role: "student" };

  const fetchevent = async () => {
    try {
      setLoading(true);
      const token = localStorage.getItem("token");

      const response = await axios.get("http://127.0.0.1:8000/api/students", {
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

  useEffect(() => {
    fetchevent();
  }, []);

  const handleReserve = async (eventId) => {
    try {
      setReservingId(eventId); 
      const token = localStorage.getItem("token");

      const response = await axios.post(
        `http://127.0.0.1:8000/api/reservation/${eventId}`,
        {}, 
        {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
          },
        }
      );

      alert(response.data?.message || "Réservation effectuée avec succès !");

      setEvents((prevEvents) =>
        prevEvents.map((evt) => {
          if (evt.id === eventId) {
            return {
              ...evt,
              reservations_count: (evt.reservations_count || 0) + 1,
              is_reserved: true, 
            };
          }
          return evt;
        })
      );
    } catch (err) {
      console.error("Erreur lors de la réservation:", err.response?.data || err.message);
      alert(
        err.response?.data?.message || "Impossible د'effectuer la réservation."
      );
    } finally {
      setReservingId(null); 
    }
  };

  const filteredEvents = events.filter((event) => {
    const matchesSearch =
      event.title?.toLowerCase().includes(searchQuery.toLowerCase()) ||
      event.lieu?.toLowerCase().includes(searchQuery.toLowerCase()) ||
      event.location?.toLowerCase().includes(searchQuery.toLowerCase());

    if (filter === "Gratuits") return matchesSearch && event.is_free;
    if (filter === "Payants") return matchesSearch && !event.is_free;
    return matchesSearch;
  });

  return (
    <div className="flex h-screen w-full bg-[#f8fafc] font-sans text-slate-700 antialiased overflow-hidden">
      
      <div className="w-64 flex-shrink-0 h-full">
        <Sidebar activeTab={activeTab} setActiveTab={setActiveTab} user={user} />
      </div>

      {/* Main Container */}
      <div className="flex-1 flex flex-col h-full min-w-0 overflow-y-auto">
        <Header user={user} searchQuery={searchQuery} setSearchQuery={setSearchQuery} />

        <main className="flex-1">
          {activeTab === "discover" && (
            <div className="p-6 md:p-8 max-w-7xl w-full mx-auto space-y-6">
              
              {/* Header & Filter Pills */}
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                  <h1 className="text-lg font-bold text-slate-900 tracking-tight">
                    Découvrir
                  </h1>
                  <p className="text-[11px] text-slate-400 font-normal">
                    Explorez les événements disponibles et réservez votre place.
                  </p>
                </div>

                <div className="bg-slate-200/50 p-1 rounded-2xl flex items-center gap-1 self-start shadow-[inset_1px_1px_3px_rgba(0,0,0,0.06)]">
                  {["Tous", "Gratuits", "Payants"].map((f) => (
                    <button
                      key={f}
                      onClick={() => setFilter(f)}
                      className={`px-3 py-1 rounded-xl text-[11px] font-medium transition-all duration-200 ${
                        filter === f
                          ? "bg-white text-slate-900 shadow-[2px_2px_6px_rgba(0,0,0,0.06)] font-semibold"
                          : "text-slate-500 hover:text-slate-800"
                      }`}
                    >
                      {f}
                    </button>
                  ))}
                </div>
              </div>

              {/* Loading State */}
              {loading && (
                <div className="flex flex-col items-center justify-center py-20 gap-2.5 text-slate-400">
                  <div className="w-5 h-5 border-2 border-slate-300 border-t-amber-500 rounded-full animate-spin"></div>
                  <p className="text-xs font-light">Chargement en cours...</p>
                </div>
              )}

              {/* Error State */}
              {error && !loading && (
                <div className="p-3 rounded-2xl bg-rose-50 border border-rose-100 text-rose-600 text-xs font-medium flex items-center justify-between">
                  <span>{error}</span>
                  <button onClick={() => window.location.reload()} className="underline text-[11px]">
                    Réessayer
                  </button>
                </div>
              )}

              {/* Events Grid */}
              {!loading && !error && (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 pb-8">
                  {filteredEvents.map((event) => (
                    <EventCard 
                      key={event.id} 
                      event={event} 
                      onReserve={handleReserve}
                      isReserving={reservingId === event.id} 
                    />
                  ))}
                </div>
              )}
            </div>
          )}
          {activeTab === "my-tickets" && <Mytickets />}
          {activeTab === "saved" && (
            <div className="p-8 text-center text-xs text-slate-400">Événements enregistrés (Bientôt)</div>
          )}
          {activeTab === "profile" && (
            <div className="p-8 text-center text-xs text-slate-400">Page Profil (Bientôt)</div>
          )}
        </main>
      </div>
    </div>
  );
}