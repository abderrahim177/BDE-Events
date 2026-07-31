<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Mes Billets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #e2e8f0;
            box-shadow: inset 2px 2px 5px #cbd5e1;
        }

        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 999px;
            border: 2px solid #e2e8f0;
        }

        .skeuo-raised {
            background: #e6eef8;
            box-shadow: 8px 8px 16px #c3cbd5, -8px -8px 16px #ffffff;
        }

        .skeuo-raised-sm {
            background: #e6eef8;
            box-shadow: 4px 4px 10px #c3cbd5, -4px -4px 10px #ffffff;
        }

        .skeuo-inset {
            background: #e6eef8;
            box-shadow: inset 3px 3px 6px #c3cbd5, inset -3px -3px 6px #ffffff;
        }

        .skeuo-btn {
            background: linear-gradient(145deg, #6366f1, #4338ca);
            box-shadow: 0 4px 0 #312e81, 0 8px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.15s ease;
        }

        .skeuo-btn:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #312e81, 0 3px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

@if (session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center gap-3 w-full max-w-xs p-4 text-slate-700 rounded-xl skeuo-raised border border-white/60 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-9 h-9 text-emerald-600 rounded-lg skeuo-inset">
        <i class="fa-solid fa-check text-sm"></i>
    </div>
    <div class="text-sm font-semibold">{{ session('success') }}</div>
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

<body class="bg-[#e6eef8] text-slate-800 antialiased h-full overflow-hidden">

    <div class="flex h-screen overflow-hidden">

        <!-- ASIDE: Dark Skeuomorphic Panel -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-[#1e293b] text-slate-300 shrink-0 h-full overflow-y-auto border-r border-slate-700/50 shadow-[10px_0_25px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-3 px-6 h-20 border-b border-slate-700/60 shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shadow-[inset_1px_1px_2px_rgba(255,255,255,0.4),0_4px_8px_rgba(0,0,0,0.4)]">
                    <i class="fa-solid fa-calendar-days text-white text-sm"></i>
                </div>
                <span class="text-white text-base font-bold tracking-tight drop-shadow-md">BDE-Events</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-3">
                <p class="px-3 text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-2">Menu</p>

                <!-- Normal Link -->
                <a href="{{ route('students.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white text-sm font-medium hover:bg-slate-800/60 transition-all border border-transparent hover:border-slate-700/50">
                    <i class="fa-solid fa-compass w-5 text-center text-xs"></i> Découvrir
                </a>

                <!-- Active Link -->
                <a href="{{ route('Ticket') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white text-sm font-semibold bg-[#111827] shadow-[inset_3px_3px_6px_#090d14,inset_-1px_-1px_4px_#1f2937] border-l-4 border-indigo-500">
                    <i class="fa-solid fa-ticket w-5 text-center text-xs text-indigo-400"></i> Mes Billets
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white text-sm font-medium hover:bg-slate-800/60 transition-all border border-transparent hover:border-slate-700/50">
                    <i class="fa-regular fa-user w-5 text-center text-xs"></i> Mon Profil
                </a>
            </nav>

            <!-- User Info Badge Inset -->
            <div class="px-4 pb-6 shrink-0">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-[#17212f] shadow-[inset_3px_3px_6px_#0e141d,inset_-2px_-2px_5px_#202e41] border border-slate-700/40">
                    <img src="https://i.pravatar.cc/64?img=47" class="w-10 h-10 rounded-full object-cover ring-2 ring-indigo-500/50 shadow-md">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate drop-shadow-sm">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-medium text-slate-400 truncate capitalize">{{ auth()->user()->role ?? 'Étudiant' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-400 bg-[#1e293b] shadow-[2px_2px_4px_#0e141d,-2px_-2px_4px_#2a3951] active:shadow-[inset_2px_2px_4px_#0e141d] transition-all" title="Déconnexion">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">

            <!-- HEADER -->
            <header class="h-20 shrink-0 bg-[#e6eef8] border-b border-slate-300/60 flex items-center justify-between px-6 lg:px-10 shadow-[0_4px_10px_rgba(0,0,0,0.03)] z-10">
                
                <!-- Skeuomorphic Search Bar -->
                <div class="relative w-full max-w-xs hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Rechercher un billet..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-2xl skeuo-inset text-xs font-medium text-slate-700 placeholder:text-slate-400 outline-none border border-slate-300/40 focus:ring-2 focus:ring-indigo-500/30 transition-all">
                </div>

                <div class="flex items-center gap-5 ml-auto">
                    <!-- Notification Button Raised -->
                    <button class="relative w-10 h-10 rounded-2xl skeuo-raised-sm flex items-center justify-center text-slate-600 hover:text-indigo-600 active:shadow-[inset_2px_2px_4px_#c3cbd5] transition-all">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-indigo-600 rounded-full shadow-[0_0_8px_#4f46e5]"></span>
                    </button>

                    <div class="w-px h-7 bg-slate-300 shadow-[1px_0_0_#ffffff]"></div>

                    <!-- User Top Right -->
                    <div class="flex items-center gap-3 px-3 py-1.5 rounded-2xl skeuo-raised-sm">
                        <img src="https://i.pravatar.cc/64?img=47" class="w-8 h-8 rounded-full object-cover ring-2 ring-white shadow-sm">
                        <div class="hidden md:block">
                            <p class="text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-medium text-slate-500 leading-tight capitalize">{{ auth()->user()->role ?? 'Étudiant' }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-10 space-y-8">

                <!-- Title & Header section -->
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight drop-shadow-[0_1px_0_rgba(255,255,255,1)]">Mes Billets</h1>
                    <p class="text-sm font-medium text-slate-500 mt-1">Accédez à vos Pass numériques et téléchargez vos justificatifs de réservation.</p>
                </div>

                <!-- Tickets Grid -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                    @forelse ($reservations as $reservation)
                    <div class="skeuo-raised rounded-3xl overflow-hidden flex flex-col md:flex-row border border-white/80 relative transition-all duration-300 hover:translate-y-[-2px]">

                        <!-- Left Main Pass Side -->
                        <div class="w-full md:w-[70%] p-6 sm:p-7 flex flex-col justify-between border-b md:border-b-0 md:border-r-2 border-dashed border-slate-300/80 relative z-0">

                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl skeuo-inset flex items-center justify-center text-indigo-600">
                                        <i class="fa-solid fa-calendar-days text-xs font-bold"></i>
                                    </div>
                                    <span class="text-xs font-bold tracking-wider uppercase text-slate-600 drop-shadow-[0_1px_0_rgba(255,255,255,1)]">BDE-Events</span>
                                </div>

                                <div>
                                    @if($reservation->status === 'confirmé')
                                    <span class="text-[11px] font-bold text-emerald-700 bg-[#e6eef8] px-3 py-1 rounded-full skeuo-raised-sm border border-white/60 inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Confirmé
                                    </span>
                                    @elseif($reservation->status === 'en_attente')
                                    <span class="text-[11px] font-bold text-amber-700 bg-[#e6eef8] px-3 py-1 rounded-full skeuo-raised-sm border border-white/60 inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        En attente
                                    </span>
                                    @else
                                    <span class="text-[11px] font-bold text-slate-600 bg-[#e6eef8] px-3 py-1 rounded-full skeuo-raised-sm border border-white/60 inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                        Utilisé
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-5">
                                <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest mb-1">Événement</p>
                                <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight leading-snug drop-shadow-[0_1px_0_rgba(255,255,255,1)]">
                                    {{ $reservation->event->title }}
                                </h2>
                            </div>

                            <!-- Details Inset Box -->
                            <div class="grid grid-cols-2 gap-4 mb-6 p-3.5 rounded-2xl skeuo-inset border border-slate-300/30">
                                <div>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Date & Heure</p>
                                    <p class="text-xs font-bold text-slate-700 mt-1 flex items-center gap-1.5">
                                        <i class="fa-regular fa-clock text-indigo-500 font-bold text-[11px]"></i>
                                        {{ \Carbon\Carbon::parse($reservation->event->date_time)->translatedFormat('d M Y') }} · {{ \Carbon\Carbon::parse($reservation->event->date_time)->format('H\hi') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Lieu</p>
                                    <p class="text-xs font-bold text-slate-700 mt-1 truncate flex items-center gap-1.5">
                                        <i class="fa-solid fa-location-dot text-indigo-500 font-bold text-[11px]"></i>
                                        {{ $reservation->event->location }}
                                    </p>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-300/60 flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Titulaire</p>
                                    <p class="text-xs font-bold text-slate-800 tracking-wide mt-0.5 truncate drop-shadow-[0_1px_0_rgba(255,255,255,1)]">{{ $reservation->user->name }}</p>
                                </div>

                                <a href=""
                                    class="skeuo-btn inline-flex items-center gap-2 px-4 py-2.5 text-white rounded-xl text-xs font-bold border-t border-indigo-400/40 shrink-0">
                                    <i class="fa-solid fa-file-arrow-down text-xs"></i>
                                    <span>Télécharger PDF</span>
                                </a>
                            </div>

                        </div>

                        <!-- Right Stub Side -->
                        <div class="w-full md:w-[30%] p-6 flex flex-col items-center justify-center gap-3 relative border-t md:border-t-0 border-slate-300/60 bg-[#e2ebf6]">

                            <div class="w-16 h-16 bg-white p-2 rounded-2xl shadow-sm skeuo-raised-sm flex items-center justify-center border border-white">
                                <i class="fa-solid fa-qrcode text-3xl text-slate-800"></i>
                            </div>

                            <div class="text-center">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Référence</p>
                                <span class="font-mono text-[13px] font-bold text-indigo-600 tracking-wider select-all">
                                    {{ $reservation->ticket_reference }}
                                </span>
                            </div>
                        </div>

                        <!-- Skeuomorphic Ticket Cutouts -->
                        <div class="hidden md:block absolute -bottom-4 left-[70%] -translate-x-1/2 w-8 h-8 bg-[#e6eef8] rounded-full z-10 shadow-[inset_2px_2px_4px_#c3cbd5]"></div>
                        <div class="hidden md:block absolute -top-4 left-[70%] -translate-x-1/2 w-8 h-8 bg-[#e6eef8] rounded-full z-10 shadow-[inset_-2px_-2px_4px_#ffffff]"></div>

                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 skeuo-raised rounded-3xl border border-white/80">
                        <div class="w-16 h-16 skeuo-inset text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-300/30">
                            <i class="fa-solid fa-ticket text-2xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 drop-shadow-[0_1px_0_rgba(255,255,255,1)]">Aucun billet trouvé</h3>
                        <p class="text-slate-500 text-xs mt-1 max-w-sm mx-auto">Vous n'avez pas encore réservé de place pour les événements à venir.</p>
                        <a href="{{ route('students.dashboard') }}" class="skeuo-btn inline-flex items-center gap-2 mt-5 px-5 py-2.5 text-white rounded-xl text-xs font-bold border-t border-indigo-400/40">
                            Découvrir les événements
                        </a>
                    </div>
                    @endforelse

                </div>

            </main>
        </div>
    </div>

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