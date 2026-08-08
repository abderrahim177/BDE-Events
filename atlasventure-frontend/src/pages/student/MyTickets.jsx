import React, { useEffect, useState } from "react";
import axios from "axios";
import { Ticket as TicketIcon, Calendar, MapPin, Download, QrCode, CheckCircle } from "lucide-react";

export default function Mytickets() {
  //  تسمية الـ State بالجمع باش توافق الكود
  const [tickets, setTickets] = useState([]); 
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchTicket = async () => {
      try {
        setLoading(true);
        const token = localStorage.getItem("token");

        const response = await axios.get("http://127.0.0.1:8000/api/ticket", {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
          },
        });
        console.log("Response Data:", response.data); 
        console.log(token);
        const data = Array.isArray(response.data)
          ? response.data
          : response.data.tickets || response.data.data || response.data.ticket || [];

        setTickets(data);
      } catch (err) {
        console.error("Erreur API:", err.response?.data || err.message);
        setError("Impossible de charger vos billets !");
      } finally {
        setLoading(false);
      }
    };

    fetchTicket();
  }, []);

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto space-y-6 font-sans">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/60">
        <div>
          <h1 className="text-lg font-bold text-slate-900 tracking-tight">Mes Billets</h1>
          <p className="text-[11px] text-slate-400 font-normal">
            Consultez et gérez vos réservations d'événements.
          </p>
        </div>
      </div>

      {loading && (
        <div className="flex flex-col items-center justify-center py-20 gap-2.5 text-slate-400">
          <div className="w-5 h-5 border-2 border-slate-300 border-t-amber-500 rounded-full animate-spin"></div>
          <p className="text-xs font-light">Chargement de vos billets...</p>
        </div>
      )}

      {error && !loading && (
        <div className="p-3 rounded-2xl bg-rose-50 border border-rose-100 text-rose-600 text-xs font-medium flex items-center justify-between">
          <span>{error}</span>
          <button onClick={() => window.location.reload()} className="underline text-[11px]">
            Réessayer
          </button>
        </div>
      )}

      {!loading && !error && tickets.length === 0 && (
        <div className="flex flex-col items-center justify-center py-16 text-center space-y-3">
          <div className="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
            <TicketIcon className="w-6 h-6 stroke-[1.5]" />
          </div>
          <div>
            <p className="text-xs text-slate-700 font-medium">Vous n'avez aucun billet pour le moment.</p>
          </div>
        </div>
      )}

      {!loading && !error && tickets.length > 0 && (
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-8">
          {tickets.map((t) => (
            <div
              key={t.id}
              className="bg-white rounded-3xl p-5 border border-slate-100 shadow-[6px_6px_16px_rgba(0,0,0,0.04)] flex flex-col justify-between"
            >
              <div className="flex flex-col sm:flex-row gap-5 items-stretch h-full">
                <div className="flex-1 space-y-3.5 flex flex-col justify-between">
                  <div>
                    <div className="flex items-center justify-between mb-2">
                      <span className="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100/60">
                        <CheckCircle className="w-3 h-3" /> {t.status || "Réservé"}
                      </span>
                      <span className="text-[10px] font-mono text-slate-400">
                        #{t.ticket_reference || `TKT-${t.id}`}
                      </span>
                    </div>

                    <h3 className="text-sm font-bold text-slate-900 tracking-tight">
                      {t.event?.title || "Événement BDE"}
                    </h3>
                  </div>

                  <div className="space-y-2 text-[11px] text-slate-500 font-medium">
                    <div className="flex items-center gap-2">
                      <Calendar className="w-3.5 h-3.5 text-amber-500" />
                      <span>{t.event?.date_time || t.created_at}</span>
                    </div>
                    <div className="flex items-center gap-2">
                      <MapPin className="w-3.5 h-3.5 text-amber-500" />
                      <span>{t.event?.location || "Campus"}</span>
                    </div>
                  </div>

                  <button 
                    onClick={() => window.print()}
                    className="w-full sm:w-auto self-start px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-[11px] flex items-center justify-center gap-1.5 border border-slate-200/60"
                  >
                    <Download className="w-3.5 h-3.5" /> Télécharger (PDF)
                  </button>
                </div>

                <div className="sm:w-[30%] pt-4 sm:pt-0 border-t sm:border-t-0 border-slate-100 flex flex-col items-center justify-center text-center">
                  <div className="p-2.5 bg-slate-50 rounded-2xl border border-slate-200/60 mb-2">
                    <QrCode className="w-12 h-12 text-slate-800" />
                  </div>
                  <span className="text-[9px] font-medium text-slate-400 uppercase">
                    Scannez à l'entrée
                  </span>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}