import React, { useEffect, useState } from "react";
import axios from "axios";
import { Trash2, Calendar, MapPin } from "lucide-react";
import NavbarBDE from "../../Components/CommonBDE/NavbarBDE";
import SidebarBDE from "../../Components/CommonBDE/SidebarBDE";

export default function ManageEvents() {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [loadingId, setLoadingId] = useState(null); // معرفة أي عنصر يتنفذ عليه الحذف
  const [errorMsg, setErrorMsg] = useState("");

  // جلب الأحداث
  const fetchEvents = async () => {
    try {
      setLoading(true);
      setErrorMsg("");
      const token = localStorage.getItem("token");

      const res = await axios.get("http://127.0.0.1:8000/api/eventManage", {
        headers: {
          Authorization: `Bearer ${token}`,
          Accept: "application/json",
        },
      });

      const dataArray = Array.isArray(res.data)
        ? res.data
        : res.data.data || [];

      setEvents(dataArray);
    } catch (err) {
      console.error("Erreur API:", err);
      setErrorMsg("Impossible de charger les événements.");
    } finally {
      setLoading(false);
    }
  };

  const handleDelete = async (id) => {
    if (!window.confirm("Voulez-vous vraiment supprimer cet événement ?")) {
      return;
    }

    setLoadingId(id);

    try {
      const token = localStorage.getItem("token");
      await axios.delete(`http://127.0.0.1:8000/api/eventManage/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
          Accept: "application/json",
        },
      });
      setEvents((prevEvents) => prevEvents.filter((event) => event.id !== id));
    } catch (err) {
      console.error("Erreur de suppression:", err.response?.data || err.message);
      alert(
        err.response?.data?.message || "Impossible de supprimer cet événement."
      );
    } finally {
      setLoadingId(null);
    }
  };

  useEffect(() => {
    fetchEvents();
  }, []);

  return (
    <div className="flex h-screen bg-slate-50 overflow-hidden font-sans">
      {/* Sidebar Component */}
      <SidebarBDE />

      {/* Main Content Area */}
      <div className="flex-1 flex flex-col overflow-y-auto min-w-0">
        {/* Navbar Component */}
        <NavbarBDE />

        {/* Page Content Container */}
        <main className="p-4 sm:p-8 max-w-7xl w-full mx-auto space-y-6">
          <div className="flex items-center justify-between">
            <div>
              <h1 className="text-xl font-bold text-slate-900 tracking-tight">
                Gestion des Événements
              </h1>
              <p className="text-xs text-slate-400 mt-1">
                Consultez et gérez la liste de tous les événements créés.
              </p>
            </div>
          </div>

          {errorMsg && (
            <div className="p-3 bg-rose-50 border border-rose-100 rounded-xl text-rose-600 text-xs font-medium">
              {errorMsg}
            </div>
          )}

          {loading ? (
            <div className="flex flex-col items-center justify-center py-20 gap-2 text-slate-400">
              <div className="w-5 h-5 border-2 border-slate-300 border-t-amber-500 rounded-full animate-spin"></div>
              <span className="text-xs">Chargement des événements...</span>
            </div>
          ) : (
            <div className="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-x-auto">
              <table className="w-full text-left text-xs text-slate-600 min-w-[750px]">
                <thead className="bg-slate-50 border-b border-slate-100 font-semibold text-slate-700">
                  <tr>
                    <th className="p-4">Titre & Description</th>
                    <th className="p-4 whitespace-nowrap">Date & Heure</th>
                    <th className="p-4 whitespace-nowrap">Lieu</th>
                    <th className="p-4 whitespace-nowrap">Prix</th>
                    <th className="p-4 min-w-[160px] whitespace-nowrap">
                      Réservations / Capacité
                    </th>
                    <th className="p-4 text-right whitespace-nowrap w-20">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100">
                  {Array.isArray(events) && events.length > 0 ? (
                    events.map((item) => {
                      const reserved =
                        item.reservations_count ||
                        item.reservation_count ||
                        0;
                      const capacity =
                        item.max_people || item.max_capacity || 1;
                      const percentage = Math.min(
                        Math.round((reserved / capacity) * 100),
                        100
                      );

                      return (
                        <tr
                          key={item.id}
                          className="hover:bg-slate-50/50 transition-colors"
                        >
                          {/* Titre & Description */}
                          <td className="p-4 max-w-[200px] sm:max-w-xs">
                            <div className="font-bold text-slate-900 text-xs mb-0.5 truncate">
                              {item.title}
                            </div>
                            <p className="text-[11px] text-slate-400 truncate">
                              {item.description || "Aucune description"}
                            </p>
                          </td>

                          {/* Date & Heure */}
                          <td className="p-4 text-slate-600 whitespace-nowrap">
                            <div className="flex items-center gap-1.5">
                              <Calendar className="w-3.5 h-3.5 text-slate-400 shrink-0" />
                              <span>
                                {item.date_time ||
                                  item.datetime ||
                                  item.date ||
                                  "N/A"}
                              </span>
                            </div>
                          </td>

                          {/* Lieu */}
                          <td className="p-4 text-slate-600 whitespace-nowrap">
                            <div className="flex items-center gap-1.5">
                              <MapPin className="w-3.5 h-3.5 text-slate-400 shrink-0" />
                              <span>{item.lieu || "N/A"}</span>
                            </div>
                          </td>

                          {/* Prix */}
                          <td className="p-4 whitespace-nowrap">
                            {item.is_free || item.price == 0 ? (
                              <span className="px-2 py-0.5 bg-emerald-50 text-emerald-600 font-semibold rounded-md text-[10px]">
                                Gratuit
                              </span>
                            ) : (
                              <span className="px-2 py-0.5 bg-slate-100 text-slate-700 font-semibold rounded-md text-[10px]">
                                {item.price} DH
                              </span>
                            )}
                          </td>

                          {/* Progress Bar */}
                          <td className="p-4 whitespace-nowrap">
                            <div className="space-y-1.5 max-w-[180px]">
                              <div className="flex justify-between items-center text-[10px]">
                                <span className="font-semibold text-slate-700">
                                  {reserved} / {capacity} places
                                </span>
                                <span className="text-slate-400 font-medium">
                                  {percentage}%
                                </span>
                              </div>
                              <div className="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div
                                  className={`h-full transition-all duration-300 rounded-full ${
                                    percentage >= 100
                                      ? "bg-rose-500"
                                      : percentage >= 75
                                      ? "bg-amber-500"
                                      : "bg-emerald-500"
                                  }`}
                                  style={{ width: `${percentage}%` }}
                                ></div>
                              </div>
                            </div>
                          </td>

                          {/* Actions */}
                          <td className="p-4 text-right whitespace-nowrap w-20">
                            <button
                              onClick={() => handleDelete(item.id)}
                              disabled={loadingId === item.id}
                              className="p-2 rounded-xl text-rose-500 hover:bg-rose-50 transition-all inline-flex items-center justify-center disabled:opacity-50"
                              title="Supprimer l'événement"
                            >
                              {loadingId === item.id ? (
                                <div className="w-4 h-4 border-2 border-rose-500 border-t-transparent rounded-full animate-spin"></div>
                              ) : (
                                <Trash2 className="w-4 h-4" />
                              )}
                            </button>
                          </td>
                        </tr>
                      );
                    })
                  ) : (
                    <tr>
                      <td
                        colSpan="6"
                        className="p-8 text-center text-slate-400"
                      >
                        Aucun événement trouvé.
                      </td>
                    </tr>
                  )}
                </tbody>
              </table>
            </div>
          )}
        </main>
      </div>
    </div>
  );
}