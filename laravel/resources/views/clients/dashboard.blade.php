<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Découvrir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CDN باش يخدموا الـ Toasts اللي عندك فـ التحت -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        .skeuo-btn-tab {
            background: #e6eef8;
            box-shadow: 4px 4px 8px #c3cbd5, -4px -4px 8px #ffffff;
            transition: all 0.15s ease;
        }

        .skeuo-btn-tab:active, .skeuo-btn-tab-active {
            background: #e6eef8;
            box-shadow: inset 3px 3px 6px #c3cbd5, inset -3px -3px 6px #ffffff;
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

                <!-- Active Link -->
                <a href="student-dashboard.html" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white text-sm font-semibold bg-[#111827] shadow-[inset_3px_3px_6px_#090d14,inset_-1px_-1px_4px_#1f2937] border-l-4 border-indigo-500">
                    <i class="fa-solid fa-compass w-5 text-center text-xs text-indigo-400"></i> Découvrir
                </a>

                <!-- Normal Links -->
                <a href="{{route ('Ticket')}}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white text-sm font-medium hover:bg-slate-800/60 transition-all border border-transparent hover:border-slate-700/50">
                    <i class="fa-solid fa-ticket w-5 text-center text-xs"></i> Mes Billets
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
                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-400 bg-[#1e293b] shadow-[2px_2px_4px_#0e141d,-2px_-2px_4px_#2a3951] active:shadow-[inset_2px_2px_4px_#0e141d] transition-all">
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
                    <input type="text" placeholder="Rechercher un événement..."
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
                            <p class="text-[10px] font-medium text-slate-500 leading-tight">{{ auth()->user()->role }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-10 space-y-8">

                <!-- Title & Filter Tabs -->
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800 tracking-tight drop-shadow-[0_1px_0_rgba(255,255,255,1)]">Découvrir</h1>
                        <p class="text-sm font-medium text-slate-500 mt-1">Explorez les événements organisés par votre BDE.</p>
                    </div>

                    <!-- Skeuomorphic Filter Buttons -->
                    <div class="flex items-center gap-3 overflow-x-auto p-1.5 rounded-2xl skeuo-inset border border-slate-300/40">
                        <button class="px-5 py-2 rounded-xl bg-slate-800 text-white text-xs font-bold shadow-[0_3px_6px_rgba(0,0,0,0.3)] whitespace-nowrap">Tous</button>
                        <button class="px-5 py-2 rounded-xl text-slate-600 text-xs font-semibold hover:text-indigo-600 whitespace-nowrap active:bg-slate-200/50 transition-all">Gratuits</button>
                        <button class="px-5 py-2 rounded-xl text-slate-600 text-xs font-semibold hover:text-indigo-600 whitespace-nowrap active:bg-slate-200/50 transition-all">Payants</button>
                        <button class="px-5 py-2 rounded-xl text-slate-600 text-xs font-semibold hover:text-indigo-600 whitespace-nowrap active:bg-slate-200/50 transition-all">Cette semaine</button>
                    </div>
                </div>

                <!-- Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

                    @foreach ($evenment as $event)
                    <div class="skeuo-raised rounded-3xl border border-white/80 overflow-hidden flex flex-col justify-between p-2 hover:translate-y-[-2px] transition-all duration-300">
                        
                        <!-- Event Card Header Banner -->
                        <div class="h-36 rounded-2xl bg-gradient-to-br from-indigo-700 via-indigo-900 to-slate-900 relative flex items-center justify-center shadow-[inset_0_-4px_10px_rgba(0,0,0,0.4)] overflow-hidden">
                            <i class="fa-solid fa-champagne-glasses text-white/15 text-6xl transform -rotate-12"></i>
                            
                            <!-- 3D Badge Gratuit -->
                            <span class="absolute top-3 left-3 text-[11px] font-bold text-emerald-700 bg-[#e6eef8] px-3 py-1 rounded-full skeuo-raised-sm border border-white/60">
                                Gratuit
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <p class="font-bold text-slate-800 text-base mb-3 drop-shadow-[0_1px_0_rgba(255,255,255,1)]">{{ $event->title }}</p>

                                <!-- Details Inset Panel -->
                                <div class="space-y-2 mb-5 p-3 rounded-xl skeuo-inset border border-slate-300/30">
                                    <p class="text-xs font-medium text-slate-600 flex items-center gap-2.5">
                                        <i class="fa-regular fa-calendar w-4 text-indigo-500 font-bold"></i> {{ $event->date_time }}
                                    </p>
                                    <p class="text-xs font-medium text-slate-600 flex items-center gap-2.5">
                                        <i class="fa-solid fa-location-dot w-4 text-indigo-500 font-bold"></i> {{ $event->location }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                @php
                                $registeredCount = (int) ($event->reservations_count ?? 0);
                                $maxCapacity = (int) ($event->max_capacity ?? 0);
                                $percentage = $maxCapacity > 0 ? min(100, round(($registeredCount / $maxCapacity) * 100)) : 0;
                                @endphp

                                <!-- Recessed Progress Bar -->
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="flex-1 h-3 skeuo-inset rounded-full overflow-hidden p-0.5 border border-slate-300/50">
                                        <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-700 rounded-full transition-all duration-500 shadow-[0_1px_3px_rgba(0,0,0,0.3)]"
                                            style="width: {{ $percentage }}%"></div>
                                    </div>

                                    <span class="text-[11px] font-bold text-slate-600 whitespace-nowrap">
                                        <span class="text-indigo-600 font-extrabold">{{ $registeredCount }}</span> / {{ $event->max_capacity }} places
                                    </span>
                                </div>

                                <!-- Action Buttons -->
                                @if($event->isFull())
                                <div class="w-full py-3 rounded-xl bg-red-100 text-red-600 text-xs font-bold text-center skeuo-inset border border-red-200">
                                    <i class="fa-solid fa-lock mr-1"></i> Événement Complet
                                </div>
                                @else
                                <a href="{{ route('reservation', $event->id) }}" class="skeuo-btn w-full py-3 rounded-xl text-white text-xs font-bold flex items-center justify-center gap-2 border-t border-indigo-400/40">
                                    <i class="fa-solid fa-bolt text-[11px] text-indigo-200"></i> S'inscrire en 1 clic
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>
            </main>
        </div>
    </div>

@if (session('success'))
<script>
    const Toast = Swal.mixin({
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