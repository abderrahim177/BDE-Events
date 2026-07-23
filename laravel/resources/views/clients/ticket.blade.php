<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Mes Billets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .nav-item {
            transition: all .2s ease;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-active {
            background: #4f46e5;
        }

        .bg-grid-pattern {
            background-size: 24px 24px;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    <div class="flex min-h-screen">

        <aside class="hidden lg:flex lg:flex-col w-64 bg-slate-900 text-slate-300 shrink-0 border-r border-slate-800">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10">
                <div class="w-8 h-8 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md shadow-indigo-600/30">
                    <i class="fa-solid fa-calendar-days text-white text-xs"></i>
                </div>
                <span class="text-white text-sm font-bold tracking-tight">BDE-Events</span>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1">
                <p class="px-3 text-[10px] font-semibold tracking-widest text-slate-500 uppercase mb-2">Menu</p>
                <a href="{{ route('students.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium">
                    <i class="fa-solid fa-compass w-4 text-center text-xs text-slate-400"></i> Découvrir
                </a>
                <a href="{{ route('Ticket') }}" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-xl text-white text-sm font-medium shadow-sm shadow-indigo-600/20">
                    <i class="fa-solid fa-ticket w-4 text-center text-xs"></i> Mes Billets
                </a>
                <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium">
                    <i class="fa-regular fa-user w-4 text-center text-xs text-slate-400"></i> Mon Profil
                </a>
            </nav>

            <div class="px-3 pb-5">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50 border border-slate-800">
                    <img src="https://i.pravatar.cc/64?img=47" class="w-9 h-9 rounded-full object-cover ring-2 ring-indigo-500/30">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-slate-400 truncate capitalize">{{ auth()->user()->role ?? 'Étudiant' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-400 transition-colors p-1">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 shrink-0 bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-20 flex items-center justify-between px-5 lg:px-8">
                <div class="relative w-full max-w-xs hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Rechercher un billet..."
                        class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 bg-slate-50/80 text-xs font-medium placeholder:text-slate-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white">
                </div>

                <div class="flex items-center gap-4 ml-auto">
                    <button class="relative w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center transition-all duration-200">
                        <i class="fa-regular fa-bell text-slate-600 text-sm"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-indigo-600 rounded-full ring-2 ring-white"></span>
                    </button>
                    <div class="w-px h-5 bg-slate-200"></div>
                    <div class="flex items-center gap-3 cursor-pointer">
                        <img src="https://i.pravatar.cc/64?img=47" class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-200">
                        <div class="hidden md:block">
                            <p class="text-xs font-semibold text-slate-800 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-medium text-slate-400 leading-tight capitalize">{{ auth()->user()->role ?? 'Étudiant' }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-5 lg:p-8 space-y-8 max-w-7xl w-full mx-auto">

                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Mes Billets</h1>
                    <p class="text-xs font-medium text-slate-500 mt-1">Accédez à vos Pass numériques et téléchargez vos justificatifs de réservation.</p>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                    @forelse ($reservations as $reservation)
                    <div class="bg-[#0b1329] bg-grid-pattern rounded-3xl overflow-hidden text-white flex flex-col md:flex-row shadow-2xl relative border border-slate-800/80 hover:border-slate-700/80 transition-all duration-300 group">

                        <div class="w-full md:w-[70%] p-6 sm:p-7 flex flex-col justify-between border-b md:border-b-0 md:border-r-2 border-dashed border-slate-800 relative z-0">

                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shadow-inner">
                                        <i class="fa-solid fa-calendar-days text-xs"></i>
                                    </span>
                                    <span class="text-xs font-bold tracking-wider uppercase text-slate-300">BDE-Events</span>
                                </div>

                                <div>
                                    @if($reservation->status === 'confirmé')
                                    <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full backdrop-blur-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Confirmé
                                    </span>
                                    @elseif($reservation->status === 'en_attente')
                                    <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full backdrop-blur-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                        En attente
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-slate-500/10 text-slate-400 border border-slate-500/20 px-3 py-1 rounded-full backdrop-blur-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        Utilisé
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6">
                                <p class="text-[10px] font-semibold text-indigo-400 uppercase tracking-widest mb-1">Événement</p>
                                <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight leading-snug group-hover:text-indigo-200 transition-colors">
                                    {{ $reservation->event->title }}
                                </h2>
                            </div>

                            
                            <div class="grid grid-cols-2 gap-4 mb-6 bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80">
                                <div>
                                    <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider">Date & Heure</p>
                                    <p class="text-xs font-semibold text-slate-100 mt-1 flex items-center gap-1.5">
                                        <i class="fa-regular fa-clock text-indigo-400 text-[11px]"></i>
                                        {{ \Carbon\Carbon::parse($reservation->event->date_time)->translatedFormat('d M Y') }} · {{ \Carbon\Carbon::parse($reservation->event->date_time)->format('H\hi') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider">Lieu</p>
                                    <p class="text-xs font-semibold text-slate-100 mt-1 truncate flex items-center gap-1.5">
                                        <i class="fa-solid fa-location-dot text-indigo-400 text-[11px]"></i>
                                        {{ $reservation->event->location }}
                                    </p>
                                </div>
                            </div>

                           
                            <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider">Titulaire</p>
                                    <p class="text-xs font-bold text-white tracking-wide mt-0.5 truncate">{{ $reservation->user->name }}</p>
                                </div>

                             
                                <a href=""
                                    class="inline-flex items-center gap-2 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-semibold transition-all shadow-lg shadow-indigo-600/25 active:scale-95 shrink-0">
                                    <i class="fa-solid fa-file-arrow-down text-xs"></i>
                                    <span>Télécharger PDF</span>
                                </a>
                            </div>

                        </div>

                        <div class="w-full md:w-[30%] bg-[#070d1d] p-6 flex flex-col items-center justify-center gap-3 relative border-t md:border-t-0 border-slate-800">

                            <div class="w-16 h-16 bg-white p-1.5 rounded-xl shadow-lg flex items-center justify-center">
                                <i class="fa-solid fa-qrcode text-3xl text-slate-900"></i>
                            </div>

                            <div class="text-center">
                                <p class="text-[9px] font-medium text-slate-500 uppercase tracking-widest mb-0.5">Référence</p>
                                <span class="font-mono text-xs font-bold text-indigo-400 tracking-wider select-all">
                                    {{ $reservation->ticket_reference }}
                                </span>
                            </div>
                        </div>

                        <div class="hidden md:block absolute -bottom-4 left-[70%] -translate-x-1/2 w-8 h-8 bg-slate-50 rounded-full z-10"></div>
                        <div class="hidden md:block absolute -top-4 left-[70%] -translate-x-1/2 w-8 h-8 bg-slate-50 rounded-full z-10"></div>

                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-slate-200/80 shadow-sm">
                        <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-ticket text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Aucun billet trouvé</h3>
                        <p class="text-slate-500 text-xs mt-1 max-w-sm mx-auto">Vous n'avez pas encore réservé de place pour les événements à venir.</p>
                        <a href="{{ route('students.dashboard') }}" class="inline-flex items-center gap-2 mt-5 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition-all">
                            Découvrir les événements
                        </a>
                    </div>
                    @endforelse

                </div>

            </main>
        </div>
    </div>

</body>

</html>