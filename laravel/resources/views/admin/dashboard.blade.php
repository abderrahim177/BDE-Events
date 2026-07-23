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
    </style>
</head>
@if (session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center gap-3 w-full max-w-xs p-4 text-slate-700 bg-white rounded-xl shadow-lg border border-emerald-100 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-50 rounded-lg">
        <i class="fa-solid fa-check text-sm"></i>
    </div>
    <div class="text-sm font-medium">{{ session('success') }}</div>
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

<body class="bg-slate-50 text-slate-800 antialiased overflow-hidden">

    <!-- MAIN CONTAINER (Fixed height 100vh) -->
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR (Fixed height, no scroll) -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-slate-900 text-slate-300 shrink-0 h-full justify-between">
            <div>
                <!-- LOGO HEADER -->
                <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10 shrink-0">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-days text-white text-xs"></i>
                    </div>
                    <span class="text-white text-sm font-medium tracking-tight">BDE-Events</span>
                </div>

                <!-- NAVIGATION -->
                <nav class="px-3 py-6 space-y-1">
                    <p class="px-3 text-[10px] font-medium tracking-widest text-slate-500 uppercase mb-2">Menu</p>
                    <a href="#" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-normal">
                        <i class="fa-solid fa-chart-simple w-4 text-center text-xs"></i> Vue d'ensemble
                    </a>
                    <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
                        <i class="fa-solid fa-calendar-days w-4 text-center text-xs"></i> Événements
                    </a>
                    <a href="{{route ('admin.reservations.index')}}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
                        <i class="fa-solid fa-ticket w-4 text-center text-xs"></i> Réservations
                    </a>
                    <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
                        <i class="fa-solid fa-gear w-4 text-center text-xs"></i> Paramètres
                    </a>
                </nav>
            </div>

            <!-- USER FOOTER (Pinned to bottom) -->
            <div class="px-3 pb-5 shrink-0">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50 border border-slate-800">
                    <img src="https://i.pravatar.cc/64?img=47" class="w-9 h-9 rounded-full object-cover ring-2 ring-indigo-500/30">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-slate-400 truncate capitalize">{{ auth()->user()->role ?? 'Étudiant' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-400 transition-colors p-1 flex items-center">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 h-full">

            <!-- HEADER (Fixed) -->
            <header class="h-16 shrink-0 bg-white border-b border-slate-200 flex items-center justify-between px-5 lg:px-8 z-10">
                <div class="relative w-full max-w-xs hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Rechercher un événement, un étudiant..."
                        class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 bg-slate-50 text-xs font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white">
                </div>

                <div class="flex items-center gap-4 ml-auto">
                    <button class="relative w-9 h-9 rounded-full hover:bg-slate-100 flex items-center justify-center transition-all duration-200">
                        <i class="fa-regular fa-bell text-slate-500 text-sm"></i>
                        <span class="absolute top-2 right-2.5 w-1.5 h-1.5 bg-indigo-600 rounded-full"></span>
                    </button>
                    <div class="w-px h-6 bg-slate-200"></div>
                    <div class="flex items-center gap-2.5">
                        <img src="https://i.pravatar.cc/64?img=12" class="w-8 h-8 rounded-full object-cover">
                        <div class="hidden md:block">
                            <p class="text-xs font-medium text-slate-800 leading-tight">{{auth()->user()->name}}</p>
                            <p class="text-[11px] font-light text-slate-400 leading-tight">{{auth()->user()->role}}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                </div>
            </header>

            <!-- CONTENT AREA (Only this part scrolls) -->
            <main class="flex-1 overflow-y-auto p-5 lg:p-8 space-y-8">

                <div>
                    <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Vue d'ensemble</h1>
                    <p class="text-sm font-light text-slate-500 mt-1">Bienvenue Sarah, voici un résumé de l'activité du BDE.</p>
                </div>

                <!-- KPI CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-sm transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                                <i class="fa-solid fa-calendar-days text-indigo-600 text-sm"></i>
                            </div>
                            <span class="flex items-center gap-1 text-[11px] font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +12%
                            </span>
                        </div>
                        <p class="text-2xl font-semibold text-slate-900 tracking-tight">24</p>
                        <p class="text-xs font-light text-slate-500 mt-1">Événements actifs</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-sm transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                                <i class="fa-solid fa-users text-indigo-600 text-sm"></i>
                            </div>
                            <span class="flex items-center gap-1 text-[11px] font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +8%
                            </span>
                        </div>
                        <p class="text-2xl font-semibold text-slate-900 tracking-tight">1 842</p>
                        <p class="text-xs font-light text-slate-500 mt-1">Places réservées au total</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-sm transition-all duration-200 sm:col-span-2 xl:col-span-1">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                                <i class="fa-solid fa-gauge-high text-indigo-600 text-sm"></i>
                            </div>
                            <span class="text-[11px] font-medium text-slate-400">Moyenne</span>
                        </div>
                        <p class="text-2xl font-semibold text-slate-900 tracking-tight">76%</p>
                        <p class="text-xs font-light text-slate-500 mt-1 mb-3">Taux de remplissage moyen</p>
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-600 rounded-full" style="width: 76%"></div>
                        </div>
                    </div>
                </div>

                <!-- EVENT CREATION FORM -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 lg:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900 tracking-tight">Créer un nouvel événement</h2>
                            <p class="text-xs font-light text-slate-500 mt-1">Renseignez les informations ci-dessous pour publier un événement.</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center">
                            <i class="fa-solid fa-plus text-slate-400 text-sm"></i>
                        </div>
                    </div>

                    <form action="{{route('Create_evenment')}}" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        @csrf
                        @if ($errors->any())
                        <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200/60 text-red-600 text-xs font-medium space-y-1">
                            <div class="flex items-center gap-2 font-semibold text-red-700">
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>Des erreurs sont survenues :</span>
                            </div>
                            <ul class="list-disc list-inside pl-1 space-y-0.5 font-normal text-red-600/90">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Titre de l'événement</label>
                            <input type="text" name="title" placeholder="Ex : Soirée d'intégration BDE"
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                            <textarea rows="3" name="description" placeholder="Décrivez l'événement en quelques lignes..."
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Date et Heure</label>
                            <div class="relative">
                                <i class="fa-regular fa-calendar-days absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none"></i>
                                <input type="datetime-local" name="datetime"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal text-slate-600 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Lieu</label>
                            <div class="relative">
                                <i class="fa-solid fa-location-dot absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="text" name="lieu" placeholder="Ex : Amphithéâtre A"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Jauge maximale</label>
                            <div class="relative">
                                <i class="fa-solid fa-users absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="number" name="max_people" min="1" placeholder="Ex : 200"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            </div>
                        </div>
                        <div class="md:col-span-2 flex items-center justify-end gap-3 pt-2">
                            <button type="button" class="px-5 py-2.5 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-50 transition-all duration-200">
                                Annuler
                            </button>
                            <button type="submit" class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center gap-2">
                                <i class="fa-solid fa-check text-xs"></i> Publier l'événement
                            </button>
                        </div>
                    </form>
                </div>

                <!-- CAPACITY TRACKING TABLE -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-6">
                    <div class="flex items-center justify-between px-6 lg:px-8 py-5 border-b border-slate-100">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900 tracking-tight">Suivi des capacités</h2>
                            <p class="text-xs font-light text-slate-500 mt-1">Places restantes en temps réel pour chaque événement.</p>
                        </div>
                        <button class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-all duration-200 flex items-center gap-1.5">
                            Voir tout <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-slate-100">
                                    <th class="px-6 lg:px-8 py-3 text-[11px] font-medium text-slate-400 uppercase tracking-wide">Événement</th>
                                    <th class="px-4 py-3 text-[11px] font-medium text-slate-400 uppercase tracking-wide">Date</th>
                                    <th class="px-4 py-3 text-[11px] font-medium text-slate-400 uppercase tracking-wide">Tarif</th>
                                    <th class="px-4 py-3 text-[11px] font-medium text-slate-400 uppercase tracking-wide w-64">Places restantes</th>
                                    <th class="px-4 py-3 text-[11px] font-medium text-slate-400 uppercase tracking-wide">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($Event as $item)
                                <tr class="hover:bg-slate-50/60 transition-all duration-200">
                                    <td class="px-6 lg:px-8 py-4">
                                        <p class="font-medium text-slate-800">{{$item->title}}</p>
                                        <p class="text-xs font-light text-slate-400">{{$item->location}}</p>
                                    </td>
                                    <td class="px-4 py-4 text-slate-500 font-light">{{$item->date_time}}</td>
                                    <td class="px-4 py-4">
                                        <span class="text-[11px] font-medium bg-emerald-50 text-emerald-600 px-2 py-1 rounded-full">Gratuit</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        @php
                                        $registeredCount = (int) ($item->reservations_count ?? 0);
                                        $maxCapacity = (int) ($item->max_capacity ?? 0);
                                        $percentage = $maxCapacity > 0 ? min(100, round(($registeredCount / $maxCapacity) * 100)) : 0;
                                        @endphp
                                        <div class="flex items-center gap-3">
                                            <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-indigo-600 rounded-full transition-all duration-500"
                                                    style="width: {{ $percentage . '%'}}"></div>
                                            </div>

                                            <span class="text-[11px] font-medium text-slate-500 whitespace-nowrap">
                                                <span class="text-indigo-600 font-semibold">{{ $registeredCount }}</span> / {{ $item->max_capacity }} places
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-[11px] font-medium bg-indigo-50 text-indigo-600 px-2 py-1 rounded-full">Ouvert</span>
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