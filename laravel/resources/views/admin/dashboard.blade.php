<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0e5ec;
        }

        /* Classes Utilitaires Skeuomorphisme */
        .skeuo-card {
            background: #e0e5ec;
            box-shadow: 9px 9px 16px #b8bec5, -9px -9px 16px #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .skeuo-pressed {
            background: #e0e5ec;
            box-shadow: inset 4px 4px 8px #b8bec5, inset -4px -4px 8px #ffffff;
        }

        .skeuo-btn {
            background: linear-gradient(145deg, #ffffff, #cad0d7);
            box-shadow: 5px 5px 10px #b8bec5, -5px -5px 10px #ffffff;
            transition: all 0.2s ease;
        }

        .skeuo-btn:hover {
            background: linear-gradient(145deg, #cad0d7, #ffffff);
            box-shadow: 2px 2px 5px #b8bec5, -2px -2px 5px #ffffff;
        }

        .skeuo-btn-primary {
            background: linear-gradient(145deg, #5b54fa, #433bc9);
            box-shadow: 5px 5px 12px #b5b9e0, -5px -5px 12px #ffffff;
            transition: all 0.2s ease;
        }

        .skeuo-btn-primary:hover {
            background: linear-gradient(145deg, #433bc9, #5b54fa);
            box-shadow: 2px 2px 6px #b5b9e0, -2px -2px 6px #ffffff;
        }

        .skeuo-input {
            background: #e0e5ec;
            box-shadow: inset 3px 3px 6px #b8bec5, inset -3px -3px 6px #ffffff;
        }

        .skeuo-sidebar {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            box-shadow: 5px 0px 15px rgba(0, 0, 0, 0.15);
        }

        .skeuo-nav-active {
            background: linear-gradient(145deg, #4338ca, #3730a3);
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.3), 3px 3px 8px rgba(0, 0, 0, 0.4);
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #e0e5ec;
            box-shadow: inset 2px 2px 4px #b8bec5, inset -2px -2px 4px #ffffff;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
            box-shadow: 2px 2px 4px #b8bec5;
        }
    </style>
</head>

@if (session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center gap-3 w-full max-w-xs p-4 text-slate-700 bg-[#e0e5ec] rounded-2xl skeuo-card transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-9 h-9 text-emerald-600 skeuo-pressed rounded-xl">
        <i class="fa-solid fa-check text-sm"></i>
    </div>
    <div class="text-sm font-medium text-slate-700">{{ session('success') }}</div>
    <button type="button" onclick="closeToast()" class="ml-auto text-slate-400 hover:text-slate-600 p-1">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>

<script>
    setTimeout(() => {
        closeToast();
    }, 3500);

    function closeToast() {
        const toast = document.getElementById('toast-success');
        if (toast) {
            toast.classList.add('opacity-0', '-translate-y-4');
            setTimeout(() => toast.remove(), 500);
        }
    }
</script>
@endif

<body class="bg-[#e0e5ec] text-slate-700 antialiased overflow-hidden">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR SKEUOMORPHIC -->
        <!-- SIDEBAR SKEUOMORPHIC ULTIMATE -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-[#141a29] text-slate-300 shrink-0 h-screen z-20 sticky top-0 border-r border-slate-800/80 shadow-[10px_0_30px_rgba(0,0,0,0.5)]">

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
            <nav class="flex-1 px-4 py-6 space-y-2.5 overflow-y-auto custom-sidebar-scrollbar">
                <p class="px-3 text-[10px] font-bold tracking-widest text-slate-500 uppercase mb-3 drop-shadow">Menu Principal</p>

                <!-- ITEM ACTIF (Effet enfoncé 3D + Lueur) -->
                <a href="#" class="relative group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-white text-sm font-semibold transition-all duration-200 bg-[#0f1420] shadow-[inset_3px_3px_6px_rgba(0,0,0,0.7),inset_-2px_-2px_5px_rgba(255,255,255,0.05)] border border-white/[0.03]">
                    <!-- Indicateur latéral -->
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-indigo-500 rounded-r-full shadow-[0_0_12px_#6366f1]"></span>

                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center text-white shadow-[2px_2px_5px_rgba(0,0,0,0.4)] border border-indigo-400/30">
                        <i class="fa-solid fa-chart-simple text-xs"></i>
                    </div>
                    <span class="tracking-wide">Vue d'ensemble</span>
                </a>

                <!-- ITEM NORMAL (Effet relief 3D au hover) -->
                <a href="#" class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-medium text-slate-400 hover:text-white transition-all duration-200 hover:bg-gradient-to-br hover:from-[#1a2235] hover:to-[#121824] hover:shadow-[5px_5px_10px_rgba(0,0,0,0.4),-2px_-2px_6px_rgba(255,255,255,0.03)] border border-transparent hover:border-white/[0.05]">
                    <div class="w-8 h-8 rounded-xl bg-[#0f1420] group-hover:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-indigo-400 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.5),inset_-1px_-1px_3px_rgba(255,255,255,0.03)] transition-all">
                        <i class="fa-solid fa-calendar-days text-xs"></i>
                    </div>
                    <span class="tracking-wide">Événements</span>
                </a>

                <a href="{{ route('admin.reservations.index') }}" class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-medium text-slate-400 hover:text-white transition-all duration-200 hover:bg-gradient-to-br hover:from-[#1a2235] hover:to-[#121824] hover:shadow-[5px_5px_10px_rgba(0,0,0,0.4),-2px_-2px_6px_rgba(255,255,255,0.03)] border border-transparent hover:border-white/[0.05]">
                    <div class="w-8 h-8 rounded-xl bg-[#0f1420] group-hover:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-indigo-400 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.5),inset_-1px_-1px_3px_rgba(255,255,255,0.03)] transition-all">
                        <i class="fa-solid fa-ticket text-xs"></i>
                    </div>
                    <span class="tracking-wide">Réservations</span>
                </a>

                <a href="#" class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-medium text-slate-400 hover:text-white transition-all duration-200 hover:bg-gradient-to-br hover:from-[#1a2235] hover:to-[#121824] hover:shadow-[5px_5px_10px_rgba(0,0,0,0.4),-2px_-2px_6px_rgba(255,255,255,0.03)] border border-transparent hover:border-white/[0.05]">
                    <div class="w-8 h-8 rounded-xl bg-[#0f1420] group-hover:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-indigo-400 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.5),inset_-1px_-1px_3px_rgba(255,255,255,0.03)] transition-all">
                        <i class="fa-solid fa-gear text-xs"></i>
                    </div>
                    <span class="tracking-wide">Paramètres</span>
                </a>
            </nav>

            <!-- USER PROFILE FOOTER (Console Skeuomorphique) -->
            <div class="px-4 pb-6 shrink-0">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-[#0b0e17] shadow-[inset_3px_3px_8px_rgba(0,0,0,0.8),inset_-2px_-2px_6px_rgba(255,255,255,0.03)] border border-white/[0.04]">

                    <div class="relative shrink-0">
                        <img src="https://i.pravatar.cc/64?img=47" class="w-10 h-10 rounded-xl object-cover ring-2 ring-indigo-500/50 shadow-md">
                        <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full border-2 border-[#0b0e17] shadow-[0_0_6px_#10b981]"></span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate tracking-wide drop-shadow">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-indigo-400 truncate capitalize tracking-wider">{{ auth()->user()->role ?? 'Étudiant' }}</p>
                    </div>

                    <!-- BOUTON DE LOGOUT SKEUOMORPHIQUE -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Déconnexion"
                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#1a2235] to-[#101522] flex items-center justify-center text-slate-400 hover:text-red-400 active:scale-95 transition-all duration-150 shadow-[3px_3px_6px_rgba(0,0,0,0.6),-1px_-1px_3px_rgba(255,255,255,0.05)] border border-white/[0.05] hover:border-red-500/30">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs drop-shadow"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTAINER -->
        <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

            <!-- HEADER SKEUOMORPHIC -->
            <header class="h-20 shrink-0 bg-[#e0e5ec] border-b border-slate-300/60 flex items-center justify-between px-6 lg:px-10 z-10 shadow-sm">
                <div class="relative w-full max-w-xs hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Rechercher un événement, un étudiant..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl skeuo-input text-xs font-normal text-slate-700 placeholder:text-slate-400 outline-none transition-all">
                </div>

                <div class="flex items-center gap-5 ml-auto">
                    <button class="relative w-10 h-10 rounded-xl skeuo-btn flex items-center justify-center text-slate-600">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-indigo-600 rounded-full ring-2 ring-white"></span>
                    </button>

                    <div class="w-px h-7 bg-slate-300"></div>

                    <div class="flex items-center gap-3 p-1.5 pr-3 rounded-2xl skeuo-btn">
                        <img src="https://i.pravatar.cc/64?img=12" class="w-8 h-8 rounded-xl object-cover shadow-sm">
                        <div class="hidden md:block">
                            <p class="text-xs font-semibold text-slate-800 leading-tight">{{auth()->user()->name}}</p>
                            <p class="text-[10px] font-medium text-slate-500 leading-tight">{{auth()->user()->role}}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px] ml-1"></i>
                    </div>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-10 space-y-10">

                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight drop-shadow-sm">Vue d'ensemble</h1>
                    <p class="text-xs font-medium text-slate-500 mt-1">Bienvenue Sarah, voici un résumé de l'activité du BDE.</p>
                </div>

                <!-- KPI CARDS SKEUOMORPHIC -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                    <div class="skeuo-card rounded-3xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl skeuo-pressed flex items-center justify-center text-indigo-600">
                                <i class="fa-solid fa-calendar-days text-base"></i>
                            </div>
                            <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 skeuo-pressed px-3 py-1.5 rounded-xl">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +12%
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-slate-800 tracking-tight">24</p>
                        <p class="text-xs font-medium text-slate-500 mt-1">Événements actifs</p>
                    </div>

                    <div class="skeuo-card rounded-3xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl skeuo-pressed flex items-center justify-center text-indigo-600">
                                <i class="fa-solid fa-users text-base"></i>
                            </div>
                            <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 skeuo-pressed px-3 py-1.5 rounded-xl">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +8%
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-slate-800 tracking-tight">1 842</p>
                        <p class="text-xs font-medium text-slate-500 mt-1">Places réservées au total</p>
                    </div>

                    <div class="skeuo-card rounded-3xl p-6 sm:col-span-2 xl:col-span-1">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl skeuo-pressed flex items-center justify-center text-indigo-600">
                                <i class="fa-solid fa-gauge-high text-base"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-500 skeuo-pressed px-3 py-1.5 rounded-xl">Moyenne</span>
                        </div>
                        <p class="text-3xl font-bold text-slate-800 tracking-tight">76%</p>
                        <p class="text-xs font-medium text-slate-500 mt-1 mb-4">Taux de remplissage moyen</p>

                        <!-- Progress Bar Pressed -->
                        <div class="w-full h-3 skeuo-pressed rounded-full p-0.5 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full shadow-sm" style="width: 76%"></div>
                        </div>
                    </div>
                </div>

                <!-- EVENT CREATION FORM SKEUOMORPHIC -->
                <div class="skeuo-card rounded-3xl p-6 lg:p-8">
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-300/50">
                        <div>
                            <h2 class="text-lg font-bold text-slate-800 tracking-tight">Créer un nouvel événement</h2>
                            <p class="text-xs font-medium text-slate-500 mt-1">Renseignez les informations ci-dessous pour publier un événement.</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl skeuo-pressed flex items-center justify-center text-slate-500">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </div>
                    </div>

                    <form action="{{route('Create_evenment')}}" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        @csrf
                        @if ($errors->any())
                        <div class="mb-2 p-4 rounded-2xl skeuo-pressed border border-red-200 text-red-600 text-xs font-medium space-y-2 md:col-span-2">
                            <div class="flex items-center gap-2 font-bold text-red-700">
                                <i class="fa-solid fa-circle-xmark text-sm"></i>
                                <span>Des erreurs sont survenues :</span>
                            </div>
                            <ul class="list-disc list-inside pl-1 space-y-1 font-medium text-red-600/90">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Titre de l'événement</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Ex : Soirée d'intégration BDE"
                                class="w-full px-4 py-3 rounded-xl skeuo-input text-sm font-medium text-slate-700 placeholder:text-slate-400 placeholder:font-normal outline-none focus:ring-2 focus:ring-indigo-500/30 transition-all">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Description</label>
                            <textarea rows="3" name="description" placeholder="Décrivez l'événement en quelques lignes..."
                                class="w-full px-4 py-3 rounded-xl skeuo-input text-sm font-medium text-slate-700 placeholder:text-slate-400 placeholder:font-normal outline-none focus:ring-2 focus:ring-indigo-500/30 resize-none transition-all">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Date et Heure</label>
                            <div class="relative">
                                <i class="fa-regular fa-calendar-days absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none"></i>
                                <input type="datetime-local" value="{{ old('datetime') }}" name="datetime"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl skeuo-input text-sm font-medium text-slate-700 outline-none focus:ring-2 focus:ring-indigo-500/30 transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Lieu</label>
                            <div class="relative">
                                <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="text" name="lieu" value="{{ old('lieu') }}" placeholder="Ex : Amphithéâtre A"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl skeuo-input text-sm font-medium text-slate-700 placeholder:text-slate-400 placeholder:font-normal outline-none focus:ring-2 focus:ring-indigo-500/30 transition-all">
                            </div>
                        </div>

                        <div class="md:col-span-2 sm:col-span-1">
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Jauge maximale</label>
                            <div class="relative">
                                <i class="fa-solid fa-users absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="number" name="max_people" value="{{ old('max_people') }}" min="1" placeholder="Ex : 200"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl skeuo-input text-sm font-medium text-slate-700 placeholder:text-slate-400 placeholder:font-normal outline-none focus:ring-2 focus:ring-indigo-500/30 transition-all">
                            </div>
                        </div>

                        <div class="md:col-span-2 flex items-center justify-end gap-4 pt-4 border-t border-slate-300/40">
                            <button type="button" class="px-6 py-3 rounded-xl skeuo-btn text-xs font-bold text-slate-600 hover:text-slate-800 transition-all">
                                Annuler
                            </button>
                            <button type="submit" class="px-6 py-3 rounded-xl skeuo-btn-primary text-white text-xs font-bold transition-all flex items-center gap-2">
                                <i class="fa-solid fa-check text-xs"></i> Publier l'événement
                            </button>
                        </div>
                    </form>
                </div>

                <!-- CAPACITY TRACKING TABLE SKEUOMORPHIC -->
                <div class="skeuo-card rounded-3xl overflow-hidden">
                    <div class="flex items-center justify-between px-6 lg:px-8 py-6 border-b border-slate-300/50">
                        <div>
                            <h2 class="text-base font-bold text-slate-800 tracking-tight">Suivi des capacités</h2>
                            <p class="text-xs font-medium text-slate-500 mt-0.5">Places restantes en temps réel pour chaque événement.</p>
                        </div>
                        <button class="px-4 py-2 rounded-xl skeuo-btn text-xs font-bold text-indigo-600 flex items-center gap-2">
                            Voir tout <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-slate-300/50 bg-slate-300/20">
                                    <th class="px-6 lg:px-8 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Événement</th>
                                    <th class="px-4 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Date</th>
                                    <th class="px-4 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tarif</th>
                                    <th class="px-4 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-64">Places restantes</th>
                                    <th class="px-4 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-300/40">
                                @foreach ($Event as $item)
                                <tr class="hover:bg-slate-200/30 transition-colors">
                                    <td class="px-6 lg:px-8 py-5">
                                        <p class="font-semibold text-slate-800">{{$item->title}}</p>
                                        <p class="text-xs font-medium text-slate-500">{{$item->location}}</p>
                                    </td>
                                    <td class="px-4 py-5 text-slate-600 font-medium text-xs">{{$item->date_time}}</td>
                                    <td class="px-4 py-5">
                                        <span class="text-[11px] font-bold text-emerald-600 skeuo-pressed px-3 py-1 rounded-lg inline-block">Gratuit</span>
                                    </td>
                                    <td class="px-4 py-5">
                                        @php
                                        $registeredCount = (int) ($item->reservations_count ?? 0);
                                        $maxCapacity = (int) ($item->max_capacity ?? 0);
                                        $percentage = $maxCapacity > 0 ? min(100, round(($registeredCount / $maxCapacity) * 100)) : 0;
                                        @endphp
                                        <div class="space-y-2">
                                            <div class="w-full h-2.5 skeuo-pressed rounded-full p-0.5 overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full transition-all duration-500"
                                                    style="width: {{ $percentage . '%'}}"></div>
                                            </div>

                                            <div class="text-[11px] font-medium text-slate-500">
                                                <span class="text-indigo-600 font-bold">{{ $registeredCount }}</span> / {{ $item->max_capacity }} places
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5">
                                        @if($item->isFull())
                                        <span class="text-[11px] font-bold text-red-600 skeuo-pressed px-3 py-1 rounded-lg inline-block">
                                            Fermé
                                        </span>
                                        @else
                                        <span class="text-[11px] font-bold text-indigo-600 skeuo-pressed px-3 py-1 rounded-lg inline-block">
                                            Ouvert
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    @if (session('success'))
    <script>
        Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });

        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
    </script>
    @endif
</body>

</html>