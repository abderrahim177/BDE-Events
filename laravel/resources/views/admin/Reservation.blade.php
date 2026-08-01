<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Administration des Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Personnalisation de la barre de défilement Dark (Sidebar) */
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: #0f1420;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #2a3447;
            border-radius: 9999px;
        }

        /* Personnalisation de la barre de défilement Light (Main Content) */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 9999px;
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #cbd5e1, #94a3b8);
            border-radius: 9999px;
            border: 2px solid #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #6366f1, #4338ca);
        }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-800 antialiased selection:bg-indigo-500 selection:text-white h-full overflow-hidden">

    <!-- CONTENEUR PRINCIPAL DÉFINI EN 100VH FIXE -->
    <div class="flex h-screen w-screen overflow-hidden">

        <!-- ================= SIDEBAR (DARK MODE) ================= -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-[#141a29] text-slate-300 shrink-0 h-full z-30 border-r border-slate-800/80 shadow-[10px_0_30px_rgba(0,0,0,0.3)]">
            
            <!-- HEADER BRANDING -->
            <div class="flex items-center gap-3.5 px-6 h-20 border-b border-white/[0.06] shrink-0 bg-gradient-to-b from-white/[0.03] to-transparent">
                <div class="relative w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shadow-[inset_1px_1px_2px_rgba(255,255,255,0.4),5px_5px_12px_rgba(0,0,0,0.4)] border border-indigo-400/40">
                    <i class="fa-solid fa-calendar-days text-white text-base drop-shadow-[0_2px_4px_rgba(0,0,0,0.4)]"></i>
                    <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-400 rounded-full border-2 border-[#141a29] shadow-[0_0_8px_#34d399]"></span>
                </div>
                <div class="flex flex-col">
                    <span class="text-white text-base font-bold tracking-tight drop-shadow-md">BDE-Events</span>
                    <span class="text-[9px] font-semibold text-indigo-400 uppercase tracking-widest">Admin Panel</span>
                </div>
            </div>

            <!-- NAVIGATION MENU -->
            <nav class="flex-1 px-4 py-6 space-y-2.5 overflow-y-auto sidebar-scrollbar">
                <p class="px-3 text-[10px] font-bold tracking-widest text-slate-500 uppercase mb-3">Menu Principal</p>
                
                <!-- Vue d'ensemble -->
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-medium text-slate-400 hover:text-white transition-all duration-200 hover:bg-gradient-to-br hover:from-[#1a2235] hover:to-[#121824] hover:shadow-[5px_5px_10px_rgba(0,0,0,0.4),-2px_-2px_6px_rgba(255,255,255,0.03)] border border-transparent hover:border-white/[0.05]">
                    <div class="w-8 h-8 rounded-xl bg-[#0f1420] group-hover:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-indigo-400 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.5),inset_-1px_-1px_3px_rgba(255,255,255,0.03)] transition-all">
                        <i class="fa-solid fa-chart-pie text-xs"></i>
                    </div>
                    <span class="tracking-wide">Vue d'ensemble</span>
                </a>

                <!-- Événements -->
                <a href="#" class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-medium text-slate-400 hover:text-white transition-all duration-200 hover:bg-gradient-to-br hover:from-[#1a2235] hover:to-[#121824] hover:shadow-[5px_5px_10px_rgba(0,0,0,0.4),-2px_-2px_6px_rgba(255,255,255,0.03)] border border-transparent hover:border-white/[0.05]">
                    <div class="w-8 h-8 rounded-xl bg-[#0f1420] group-hover:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-indigo-400 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.5),inset_-1px_-1px_3px_rgba(255,255,255,0.03)] transition-all">
                        <i class="fa-solid fa-calendar-days text-xs"></i>
                    </div>
                    <span class="tracking-wide">Événements</span>
                </a>

                <!-- Réservations (ACTIF) -->
                <a href="{{ route('admin.reservations.index') }}" class="relative group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-white text-sm font-semibold transition-all duration-200 bg-[#0f1420] shadow-[inset_3px_3px_6px_rgba(0,0,0,0.7),inset_-2px_-2px_5px_rgba(255,255,255,0.05)] border border-white/[0.03]">
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-indigo-500 rounded-r-full shadow-[0_0_12px_#6366f1]"></span>
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center text-white shadow-[2px_2px_5px_rgba(0,0,0,0.4)] border border-indigo-400/30">
                        <i class="fa-solid fa-ticket text-xs"></i>
                    </div>
                    <span class="tracking-wide">Réservations</span>
                </a>

                <!-- Étudiants -->
                <a href="#" class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-medium text-slate-400 hover:text-white transition-all duration-200 hover:bg-gradient-to-br hover:from-[#1a2235] hover:to-[#121824] hover:shadow-[5px_5px_10px_rgba(0,0,0,0.4),-2px_-2px_6px_rgba(255,255,255,0.03)] border border-transparent hover:border-white/[0.05]">
                    <div class="w-8 h-8 rounded-xl bg-[#0f1420] group-hover:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-indigo-400 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.5),inset_-1px_-1px_3px_rgba(255,255,255,0.03)] transition-all">
                        <i class="fa-solid fa-users text-xs"></i>
                    </div>
                    <span class="tracking-wide">Étudiants</span>
                </a>
            </nav>

            <!-- PROFILE FOOTER SIDEBAR -->
            <div class="px-4 pb-6 shrink-0">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-[#0b0e17] shadow-[inset_3px_3px_8px_rgba(0,0,0,0.8),inset_-2px_-2px_6px_rgba(255,255,255,0.03)] border border-white/[0.04]">
                    <div class="relative shrink-0">
                        <img src="https://i.pravatar.cc/64?img=68" class="w-10 h-10 rounded-xl object-cover ring-2 ring-indigo-500/50 shadow-md">
                        <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full border-2 border-[#0b0e17] shadow-[0_0_6px_#10b981]"></span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate tracking-wide">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-indigo-400 truncate capitalize tracking-wider">{{ auth()->user()->role ?? 'Admin' }}</p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Déconnexion" 
                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#1a2235] to-[#101522] flex items-center justify-center text-slate-400 hover:text-red-400 active:scale-95 transition-all duration-150 shadow-[3px_3px_6px_rgba(0,0,0,0.6),-1px_-1px_3px_rgba(255,255,255,0.05)] border border-white/[0.05]">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- ================= ZONE CONTENU DROITE (WHITE MODE) ================= -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden bg-[#f1f5f9]">

            <!-- HEADER (WHITE MODE FIXE) -->
            <header class="h-20 shrink-0 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-6 lg:px-8 z-20 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                
                <!-- Recherche Encastrée -->
                <div class="relative w-full max-w-sm hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Rechercher étudiant, référence..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-slate-100 text-xs font-medium text-slate-800 placeholder:text-slate-400 outline-none shadow-[inset_2px_2px_5px_rgba(0,0,0,0.08),inset_-2px_-2px_4px_rgba(255,255,255,0.8)] border border-slate-200 focus:border-indigo-500 focus:bg-white transition-all">
                </div>

                <!-- Profile & Notifications Header -->
                <div class="flex items-center gap-4 ml-auto">
                    <button class="relative w-10 h-10 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-600 hover:text-indigo-600 shadow-[4px_4px_10px_rgba(0,0,0,0.08),-3px_-3px_8px_rgba(255,255,255,0.9)] border border-white active:scale-95 transition-all">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute top-2.5 right-2.5 w-2.5 h-2.5 bg-indigo-600 rounded-full border-2 border-white shadow-sm"></span>
                    </button>
                    
                    <div class="w-px h-6 bg-slate-200"></div>

                    <div class="flex items-center gap-3 px-3.5 py-1.5 rounded-2xl bg-slate-100 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.06),inset_-2px_-2px_4px_rgba(255,255,255,0.9)] border border-slate-200/60 cursor-pointer">
                        <img src="https://i.pravatar.cc/64?img=68" class="w-8 h-8 rounded-xl object-cover ring-2 ring-indigo-500/30">
                        <div class="hidden md:block">
                            <p class="text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-semibold text-indigo-600 leading-tight capitalize">{{ auth()->user()->role ?? 'Admin' }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px] ml-1"></i>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT (WHITE MODE) -->
            <main class="flex-1 overflow-y-auto custom-scrollbar p-6 lg:p-8 space-y-6 bg-[#f8fafc]">
                <div class="max-w-7xl mx-auto space-y-6">

                    <!-- EN-TÊTE DU CONTENT -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 rounded-3xl bg-white shadow-[6px_6px_16px_rgba(0,0,0,0.04),-4px_-4px_12px_rgba(255,255,255,0.9)] border border-slate-200/70">
                        <div>
                            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Gestion des Réservations</h1>
                            <p class="text-xs font-medium text-slate-500 mt-1">Validez ou annulez les demandes de billets des étudiants en temps réel.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-4 py-2 rounded-2xl bg-slate-100 text-xs font-bold text-indigo-600 border border-slate-200 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.05)]">
                                <i class="fa-solid fa-ticket mr-1.5"></i> {{ $reservations->count() }} Réservation(s)
                            </span>
                        </div>
                    </div>

                    <!-- MESSAGE SUCCÈS -->
                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-3 shadow-sm">
                            <div class="w-7 h-7 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 border border-emerald-300">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            </div>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- TABLEAU DES RÉSERVATIONS -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-[8px_8px_24px_rgba(0,0,0,0.04),-6px_-6px_16px_rgba(255,255,255,0.9)] overflow-hidden">
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-[11px] uppercase font-bold tracking-wider">
                                    <tr>
                                        <th class="py-4 px-6">Référence</th>
                                        <th class="py-4 px-6">Étudiant</th>
                                        <th class="py-4 px-6">Événement</th>
                                        <th class="py-4 px-6">Statut Actuel</th>
                                        <th class="py-4 px-6 text-center">Changer le Statut</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                                    @forelse ($reservations as $reservation)
                                    <tr class="hover:bg-slate-50/80 transition-colors">
                                        <td class="py-4 px-6">
                                            <span class="inline-block font-['JetBrains_Mono'] font-bold text-xs text-indigo-600 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.05)]">
                                                {{ $reservation->ticket_reference }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="font-bold text-slate-900">{{ $reservation->user->name }}</p>
                                            <p class="text-xs text-slate-400 font-normal">{{ $reservation->user->email }}</p>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="font-semibold text-slate-800">{{ $reservation->event->title }}</p>
                                            <p class="text-xs text-slate-400 font-normal flex items-center gap-1.5 mt-0.5">
                                                <i class="fa-regular fa-clock text-[10px] text-indigo-500"></i>
                                                {{ \Carbon\Carbon::parse($reservation->event->date_time)->format('d/m/Y H:i') }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($reservation->status === 'confirmé')
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-xs font-semibold shadow-sm">
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_6px_#10b981]"></span> Confirmé
                                                </span>
                                            @elseif($reservation->status === 'en_attente')
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-xl text-xs font-semibold shadow-sm">
                                                    <span class="w-2 h-2 rounded-full bg-amber-500 shadow-[0_0_6px_#f59e0b]"></span> En attente
                                                </span>
                                            @elseif($reservation->status === 'utilisé')
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-xl text-xs font-semibold shadow-sm">
                                                    <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_6px_#6366f1]"></span> Utilisé
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 rounded-xl text-xs font-semibold shadow-sm">
                                                    <span class="w-2 h-2 rounded-full bg-rose-500 shadow-[0_0_6px_#f43f5e]"></span> {{ ucfirst($reservation->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST" class="inline-flex items-center justify-center">
                                                @csrf
                                                @method('PATCH')
                                                <div class="relative">
                                                    <select name="status" onchange="this.form.submit()" 
                                                        class="appearance-none text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200 rounded-xl px-4 py-2 pr-8 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.06)] focus:border-indigo-500 focus:bg-white outline-none cursor-pointer transition-all">
                                                        <option value="en_attente" class="bg-white text-amber-600" {{ $reservation->status === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                        <option value="confirmé" class="bg-white text-emerald-600" {{ $reservation->status === 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                                                        <option value="utilisé" class="bg-white text-indigo-600" {{ $reservation->status === 'utilisé' ? 'selected' : '' }}>Utilisé</option>
                                                        <option value="annulé" class="bg-white text-rose-600" {{ $reservation->status === 'annulé' ? 'selected' : '' }}>Annulé</option>
                                                    </select>
                                                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 pointer-events-none"></i>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-slate-400 font-normal">
                                            <div class="w-16 h-16 rounded-3xl bg-slate-100 border border-slate-200 shadow-[inset_2px_2px_5px_rgba(0,0,0,0.05)] flex items-center justify-center mx-auto mb-3">
                                                <i class="fa-solid fa-inbox text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-sm font-semibold text-slate-500">Aucune réservation trouvée.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- PAGINATION -->
                    @if(method_exists($reservations, 'links'))
                    <div class="mt-4">
                        {{ $reservations->links() }}
                    </div>
                    @endif

                </div>
            </main>

        </div>
    </div>

</body>

</html>