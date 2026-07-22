<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE-Events — Découvrir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .event-card {
            transition: all .2s ease;
        }

        .event-card:hover {
            transform: translateY(-2px);
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
<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-slate-900 text-slate-300 shrink-0">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-white text-xs"></i>
                </div>
                <span class="text-white text-sm font-medium tracking-tight">BDE-Events</span>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1">
                <p class="px-3 text-[10px] font-medium tracking-widest text-slate-500 uppercase mb-2">Menu</p>
                <a href="student-dashboard.html" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-normal">
                    <i class="fa-solid fa-compass w-4 text-center text-xs"></i> Découvrir
                </a>
                <a href="{{route ('ticket')}}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
                    <i class="fa-solid fa-ticket w-4 text-center text-xs"></i> Mes Billets
                </a>
                <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
                    <i class="fa-regular fa-user w-4 text-center text-xs"></i> Mon Profil
                </a>
            </nav>

            <div class="px-3 pb-5">
                <form action="{{route ('logout')}}" method="POST" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-red-300 transition-all duration-200">
                    @csrf
                    <div class="flex-1 min-w-0">
                        <button type="submit" class="text-xs font-medium text-white truncate">Logout</button>
                    </div>
                    <i class="fa-solid fa-arrow-right-from-bracket text-slate-500 text-xs"></i>
                </form>
            </div>
        </aside>
        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- HEADER -->
            <header class="h-16 shrink-0 bg-white border-b border-slate-200 flex items-center justify-between px-5 lg:px-8">
                <div class="relative w-full max-w-xs hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Rechercher un événement..."
                        class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 bg-slate-50 text-xs font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white">
                </div>

                <div class="flex items-center gap-4 ml-auto">
                    <button class="relative w-9 h-9 rounded-full hover:bg-slate-100 flex items-center justify-center transition-all duration-200">
                        <i class="fa-regular fa-bell text-slate-500 text-sm"></i>
                        <span class="absolute top-2 right-2.5 w-1.5 h-1.5 bg-indigo-600 rounded-full"></span>
                    </button>
                    <div class="w-px h-6 bg-slate-200"></div>
                    <div class="flex items-center gap-2.5">
                        <img src="https://i.pravatar.cc/64?img=47" class="w-8 h-8 rounded-full object-cover">
                        <div class="hidden md:block">
                            <p class="text-xs font-medium text-slate-800 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[11px] font-light text-slate-400 leading-tight">{{ auth()->user()->role }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-5 lg:p-8 space-y-8">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Découvrir</h1>
                        <p class="text-sm font-light text-slate-500 mt-1">Explorez les événements organisés par votre BDE.</p>
                    </div>

                    <div class="flex items-center gap-2 overflow-x-auto pb-1">
                        <button class="px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-medium whitespace-nowrap transition-all duration-200">Tous</button>
                        <button class="px-4 py-2 rounded-full border border-slate-200 text-slate-600 text-xs font-medium whitespace-nowrap hover:bg-slate-50 transition-all duration-200">Gratuits</button>
                        <button class="px-4 py-2 rounded-full border border-slate-200 text-slate-600 text-xs font-medium whitespace-nowrap hover:bg-slate-50 transition-all duration-200">Payants</button>
                        <button class="px-4 py-2 rounded-full border border-slate-200 text-slate-600 text-xs font-medium whitespace-nowrap hover:bg-slate-50 transition-all duration-200">Cette semaine</button>
                    </div>
                </div>

                <!-- EVENTS GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                    <!-- CARD 1 - FREE -->
                    @foreach ($evenment as $event)
                    <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md">
                        <div class="h-32 bg-gradient-to-br from-indigo-600 to-slate-900 relative flex items-center justify-center">
                            <i class="fa-solid fa-champagne-glasses text-white/25 text-4xl"></i>
                            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-emerald-600 px-2.5 py-1 rounded-full">Gratuit</span>
                        </div>

                        <div class="p-5">
                            <p class="font-medium text-slate-800 text-sm mb-2.5">{{ $event->title }}</p>

                            <div class="space-y-1.5 mb-4">
                                <p class="text-xs font-light text-slate-500 flex items-center gap-2">
                                    <i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> {{ $event->date_time }}
                                </p>
                                <p class="text-xs font-light text-slate-500 flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> {{ $event->location }}
                                </p>
                            </div>
                            @php
                            // استعمل reservations_count بالجمع بـ نفس سمية العلاقة
                            $registeredCount = (int) ($event->reservations_count ?? 0);
                            $maxCapacity = (int) ($event->max_capacity ?? 0);

                            $percentage = $maxCapacity > 0 ? min(100, round(($registeredCount / $maxCapacity) * 100)) : 0;
                            @endphp
                            <div class="flex items-center gap-3 mb-4">
                                <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full transition-all duration-500"
                                        style="width: {{ $percentage . '%' }}"></div>
                                </div>

                                <span class="text-[11px] font-medium text-slate-500 whitespace-nowrap">
                                    <span class="text-indigo-600 font-semibold">{{ $registeredCount }}</span> / {{ $event->max_capacity }} places
                                </span>
                            </div>

                            <a href="{{ route('reservation', $event->id) }}" class="w-full py-2.5 rounded-lg bg-indigo-600 text-white text-xs font-medium hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                <i class="fa-solid fa-bolt text-[10px]"></i> S'inscrire en 1 clic
                            </a>
                        </div>
                    </div>
                    @endforeach
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