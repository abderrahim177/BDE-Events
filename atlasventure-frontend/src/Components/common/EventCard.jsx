import React from 'react';
import { Calendar, MapPin, Zap, Lock } from 'lucide-react';

export default function EventCard({ event, onReserve }) {
  const isFull = event.reserved_count >= event.max_people;
  const percentage = Math.min((event.reserved_count / event.max_people) * 100, 100);
  return (
    <div className="bg-white rounded-2xl border border-slate-200/80 overflow-hidden hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 flex flex-col justify-between group">
      <div>
        {/* Event Banner */}
        <div className="relative h-44 bg-gradient-to-br from-indigo-600 to-indigo-900 p-4 flex flex-col justify-between overflow-hidden">
          <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent"></div>
          
          <span className="self-start px-3 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-md text-emerald-600 shadow-sm">
            {event.is_free ? 'Gratuit' : `${event.price} DH`}
          </span>

          <div className="relative z-10">
            <h3 className="text-xl font-bold text-white tracking-tight leading-snug group-hover:text-indigo-100 transition">
              {event.title}
            </h3>
          </div>
        </div>

        {/* Details Section */}
        <div className="p-5 space-y-4">
          <div className="space-y-2 text-xs font-medium text-slate-600">
            <div className="flex items-center gap-2.5">
              <Calendar className="w-4 h-4 text-indigo-600" />
              <span>{event.datetime}</span>
            </div>
            <div className="flex items-center gap-2.5">
              <MapPin className="w-4 h-4 text-indigo-600" />
              <span>{event.lieu}</span>
            </div>
          </div>

          {/* Progress Bar */}
          <div className="space-y-1.5 pt-2">
            <div className="flex justify-between items-center text-xs font-semibold">
              <span className="text-slate-500">Places réservées</span>
              <span className="text-slate-800">{event.reserved_count} / {event.max_people}</span>
            </div>
            <div className="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
              <div
                className={`h-full rounded-full transition-all duration-500 ${
                  isFull ? 'bg-red-500' : 'bg-indigo-600'
                }`}
                style={{ width: `${percentage}%` }}
              ></div>
            </div>
          </div>
        </div>
      </div>

      {/* Button */}
      <div className="px-5 pb-5 pt-0">
        {isFull ? (
          <button
            disabled
            className="w-full py-2.5 rounded-xl bg-slate-100 text-slate-400 font-semibold text-xs flex items-center justify-center gap-2 cursor-not-allowed"
          >
            <Lock className="w-3.5 h-3.5" /> Événement Complet
          </button>
        ) : (
          <button
            onClick={() => onReserve(event.id)}
            className="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 active:scale-[0.99] text-white font-semibold text-xs flex items-center justify-center gap-2 shadow-md shadow-indigo-600/20 transition"
          >
            <Zap className="w-3.5 h-3.5 fill-white" /> S'inscrire en 1 clic
          </button>
        )}
      </div>
    </div>
  );
}