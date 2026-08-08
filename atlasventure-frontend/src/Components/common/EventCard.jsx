import React from 'react';
import { Calendar, MapPin, Zap, Lock } from 'lucide-react';

export default function EventCard({ event, onReserve }) {
  const isFull = event.reserved_count >= event.max_capacity;
  const percentage = Math.min((event.reserved_count / event.max_capacity) * 100, 100);

  return (
    <div className="bg-white rounded-3xl p-4 border border-slate-100 shadow-[6px_6px_16px_rgba(0,0,0,0.04),_-6px_-6px_16px_rgba(255,255,255,0.8),inset_1px_1px_2px_rgba(255,255,255,0.9)] hover:shadow-[10px_10px_24px_rgba(0,0,0,0.06),_-10px_-10px_24px_rgba(255,255,255,0.9)] transition-all duration-300 flex flex-col justify-between group font-sans">
      <div className="space-y-3.5">
        
        {/* Banner with Muted Dark Gradient & Clay Badge */}
        <div className="relative h-36 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 p-3.5 flex flex-col justify-between overflow-hidden shadow-[inset_2px_2px_6px_rgba(255,255,255,0.1)]">
          
          <span className="self-start px-2.5 py-0.5 rounded-lg text-[10px] font-semibold bg-white/90 backdrop-blur-md text-slate-900 shadow-[1px_1px_4px_rgba(0,0,0,0.1)]">
            {event.is_free ? 'Gratuit' : `${event.price} DH`}
          </span>

          <div className="relative z-10">
            <h3 className="text-sm font-semibold text-white tracking-tight leading-snug line-clamp-2">
              {event.title}
            </h3>
          </div>
        </div>

        {/* Details Section */}
        <div className="space-y-3 px-1">
          <div className="space-y-1.5 text-[11px] font-medium text-slate-500">
            <div className="flex items-center gap-2">
              <Calendar className="w-3.5 h-3.5 text-amber-500" />
              <span>{event.date_time}</span>
            </div>
            <div className="flex items-center gap-2">
              <MapPin className="w-3.5 h-3.5 text-amber-500" />
              <span className="truncate">{event.location}</span>
            </div>
          </div>

          {/* Clay Progress Bar */}
          <div className="space-y-1 pt-1">
            <div className="flex justify-between items-center text-[10px] font-semibold">
              <span className="text-slate-400">Places réservées</span>
              <span className="text-slate-700">{event.reserved_count} / {event.max_capacity}</span>
            </div>
            <div className="w-full h-2 rounded-full bg-slate-100 p-0.5 shadow-[inset_1px_1px_2px_rgba(0,0,0,0.1)]">
              <div
                className={`h-full rounded-full transition-all duration-500 ${
                  isFull ? 'bg-rose-500' : 'bg-amber-500'
                }`}
                style={{ width: `${percentage}%` }}
              ></div>
            </div>
          </div>
        </div>
      </div>

      {/* Button */}
      <div className="pt-4">
        {isFull ? (
          <button
            disabled
            className="w-full py-2 rounded-xl bg-slate-100 text-slate-400 font-medium text-[11px] flex items-center justify-center gap-1.5 cursor-not-allowed border border-slate-200/50"
          >
            <Lock className="w-3 h-3" /> Événement Complet
          </button>
        ) : (
          <button
            onClick={() => onReserve(event.id)}
            className="w-full py-2 rounded-xl bg-amber-500 hover:bg-amber-400 active:scale-[0.98] text-slate-950 font-semibold text-[11px] flex items-center justify-center gap-1.5 shadow-[inset_-2px_-2px_4px_rgba(0,0,0,0.15),_0_4px_12px_rgba(245,158,11,0.3)] transition-all duration-200"
          >
            <Zap className="w-3.5 h-3.5 fill-slate-950" /> S'inscrire en 1 clic
          </button>
        )}
      </div>
    </div>
  );
}