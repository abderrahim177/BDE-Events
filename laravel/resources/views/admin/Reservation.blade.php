<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Administration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
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

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    <div class="flex min-h-screen">

      <aside class="hidden lg:flex lg:flex-col w-64 bg-slate-900 text-slate-300 shrink-0 border-r border-slate-800">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10">
                <div class="w-8 h-8 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md shadow-indigo-600/30">
                    <i class="fa-solid fa-shield-halved text-white text-xs"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-white text-sm font-bold tracking-tight">BDE-Events</span>
                    <span class="text-[10px] text-indigo-400 font-semibold uppercase tracking-wider">Admin Panel</span>
                </div>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1">
                <p class="px-3 text-[10px] font-semibold tracking-widest text-slate-500 uppercase mb-2">Gestion</p>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium">
                    <i class="fa-solid fa-chart-pie w-4 text-center text-xs text-slate-400"></i> Vue d'ensemble
                </a>

                <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium">
                    <i class="fa-solid fa-calendar-days w-4 text-center text-xs text-slate-400"></i> Événements
                </a>

                <a href="{{ route('admin.reservations.index') }}" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-xl text-white text-sm font-medium shadow-sm shadow-indigo-600/20">
                    <i class="fa-solid fa-ticket w-4 text-center text-xs"></i> Réservations
                </a>

                <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium">
                    <i class="fa-solid fa-users w-4 text-center text-xs text-slate-400"></i> Étudiants
                </a>
            </nav>

            <div class="px-3 pb-5">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50 border border-slate-800">
                    <img src="https://i.pravatar.cc/64?img=68" class="w-9 h-9 rounded-full object-cover ring-2 ring-indigo-500/30">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-indigo-400 truncate capitalize">{{ auth()->user()->role ?? 'Admin' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-400 transition-colors p-1" title="Déconnexion">
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
                    <input type="text" placeholder="Rechercher étudiant, référence..."
                        class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 bg-slate-50/80 text-xs font-medium placeholder:text-slate-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white">
                </div>

                <div class="flex items-center gap-4 ml-auto">
                    <button class="relative w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center transition-all duration-200">
                        <i class="fa-regular fa-bell text-slate-600 text-sm"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-indigo-600 rounded-full ring-2 ring-white"></span>
                    </button>
                    
                    <div class="w-px h-5 bg-slate-200"></div>

                    <div class="flex items-center gap-3 cursor-pointer">
                        <img src="https://i.pravatar.cc/64?img=68" class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-200">
                        <div class="hidden md:block">
                            <p class="text-xs font-semibold text-slate-800 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-medium text-slate-400 leading-tight capitalize">{{ auth()->user()->role ?? 'Admin' }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-5 lg:p-8 space-y-6 max-w-7xl w-full mx-auto">

                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Gestion des Réservations</h1>
                        <p class="text-xs font-medium text-slate-500 mt-1">Validez ou annulez les demandes de billets des étudiants en temps réel.</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-xs font-medium flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase font-semibold">
                                <tr>
                                    <th class="p-4">Référence</th>
                                    <th class="p-4">Étudiant</th>
                                    <th class="p-4">Événement</th>
                                    <th class="p-4">Statut Actuel</th>
                                    <th class="p-4 text-center">Changer le Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                                @forelse ($reservations as $reservation)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    
                                    <td class="p-4 font-mono font-bold text-indigo-600">
                                        {{ $reservation->ticket_reference }}
                                    </td>

                                    <td class="p-4">
                                        <p class="font-semibold text-slate-800">{{ $reservation->user->name }}</p>
                                        <p class="text-xs text-slate-400 font-normal">{{ $reservation->user->email }}</p>
                                    </td>

                                    <td class="p-4">
                                        <p class="font-medium text-slate-800">{{ $reservation->event->title }}</p>
                                        <p class="text-xs text-slate-400 font-normal">
                                            {{ \Carbon\Carbon::parse($reservation->event->date_time)->format('d/m/Y H:i') }}
                                        </p>
                                    </td>

                                    <td class="p-4">
                                        @if($reservation->status === 'confirmé')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-full text-xs font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Confirmé
                                            </span>
                                        @elseif($reservation->status === 'en_attente')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 border border-amber-200 rounded-full text-xs font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> En attente
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-xs font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> {{ ucfirst($reservation->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-4 text-center">
                                        <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST" class="inline-flex items-center justify-center">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <select name="status" onchange="this.form.submit()" 
                                                class="text-xs font-medium bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none cursor-pointer transition-all">
                                                <option value="en_attente" {{ $reservation->status === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                <option value="confirmé" {{ $reservation->status === 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                                                <option value="utilisé" {{ $reservation->status === 'utilisé' ? 'selected' : '' }}>Utilisé</option>
                                                <option value="annulé" {{ $reservation->status === 'annulé' ? 'selected' : '' }}>Annulé</option>
                                            </select>
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-400 font-normal">
                                        <i class="fa-solid fa-inbox text-2xl text-slate-300 mb-2 block"></i>
                                        Aucune réservation trouvée.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($reservations, 'links'))
                <div class="mt-4">
                    {{ $reservations->links() }}
                </div>
                @endif

            </main>
        </div>
    </div>

</body>

</html>