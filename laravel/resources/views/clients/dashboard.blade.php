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
  body { font-family: 'Poppins', sans-serif; }
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
  .nav-item { transition: all .2s ease; }
  .nav-item:hover { background: rgba(255,255,255,0.06); }
  .nav-active { background: #4f46e5; }
  .event-card { transition: all .2s ease; }
  .event-card:hover { transform: translateY(-2px); }
</style>
</head>
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
      <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/5 transition-all duration-200">
        <img src="https://i.pravatar.cc/64?img=47" class="w-8 h-8 rounded-full object-cover">
        <div class="flex-1 min-w-0">
          <p class="text-xs font-medium text-white truncate">Yasmine Bouzid</p>
          <p class="text-[11px] font-light text-slate-500 truncate">Étudiante · L3 Info</p>
        </div>
        <i class="fa-solid fa-arrow-right-from-bracket text-slate-500 text-xs"></i>
      </a>
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
            <p class="text-xs font-medium text-slate-800 leading-tight">Yasmine Bouzid</p>
            <p class="text-[11px] font-light text-slate-400 leading-tight">Étudiante</p>
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
        <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md">
          <div class="h-32 bg-gradient-to-br from-indigo-600 to-slate-900 relative flex items-center justify-center">
            <i class="fa-solid fa-champagne-glasses text-white/25 text-4xl"></i>
            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-emerald-600 px-2.5 py-1 rounded-full">Gratuit</span>
          </div>
          <div class="p-5">
            <p class="font-medium text-slate-800 text-sm mb-2.5">Soirée d'intégration BDE</p>
            <div class="space-y-1.5 mb-4">
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> 12 Sept 2026 · 20h00</p>
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> Amphithéâtre A</p>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-600 rounded-full" style="width: 68%"></div>
              </div>
              <span class="text-[11px] font-light text-slate-400 whitespace-nowrap">136/200 places</span>
            </div>
            <button class="w-full py-2.5 rounded-lg bg-indigo-600 text-white text-xs font-medium hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
              <i class="fa-solid fa-bolt text-[10px]"></i> S'inscrire en 1 clic
            </button>
          </div>
        </div>

        <!-- CARD 2 - PAID -->
        <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md">
          <div class="h-32 bg-gradient-to-br from-slate-800 to-slate-900 relative flex items-center justify-center">
            <i class="fa-solid fa-martini-glass-citrus text-white/25 text-4xl"></i>
            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-amber-600 px-2.5 py-1 rounded-full">150 DH</span>
          </div>
          <div class="p-5">
            <p class="font-medium text-slate-800 text-sm mb-2.5">Gala de fin d'année</p>
            <div class="space-y-1.5 mb-4">
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> 28 Sept 2026 · 19h30</p>
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> Salle des Arts</p>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-amber-500 rounded-full" style="width: 91%"></div>
              </div>
              <span class="text-[11px] font-light text-slate-400 whitespace-nowrap">9/100 places</span>
            </div>
            <button class="w-full py-2.5 rounded-lg border border-slate-200 text-slate-700 text-xs font-medium hover:bg-slate-50 transition-all duration-200">
              Réserver ma place
            </button>
          </div>
        </div>

        <!-- CARD 3 - FREE -->
        <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md">
          <div class="h-32 bg-gradient-to-br from-indigo-600 to-slate-900 relative flex items-center justify-center">
            <i class="fa-solid fa-futbol text-white/25 text-4xl"></i>
            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-emerald-600 px-2.5 py-1 rounded-full">Gratuit</span>
          </div>
          <div class="p-5">
            <p class="font-medium text-slate-800 text-sm mb-2.5">Tournoi sportif inter-filières</p>
            <div class="space-y-1.5 mb-4">
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> 05 Oct 2026 · 09h00</p>
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> Complexe sportif</p>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-600 rounded-full" style="width: 30%"></div>
              </div>
              <span class="text-[11px] font-light text-slate-400 whitespace-nowrap">45/150 places</span>
            </div>
            <button class="w-full py-2.5 rounded-lg bg-indigo-600 text-white text-xs font-medium hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
              <i class="fa-solid fa-bolt text-[10px]"></i> S'inscrire en 1 clic
            </button>
          </div>
        </div>

        <!-- CARD 4 - FULL -->
        <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden opacity-75">
          <div class="h-32 bg-gradient-to-br from-slate-700 to-slate-900 relative flex items-center justify-center">
            <i class="fa-solid fa-microphone text-white/25 text-4xl"></i>
            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-emerald-600 px-2.5 py-1 rounded-full">Gratuit</span>
          </div>
          <div class="p-5">
            <p class="font-medium text-slate-800 text-sm mb-2.5">Conférence Tech & Carrières</p>
            <div class="space-y-1.5 mb-4">
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> 14 Oct 2026 · 14h00</p>
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> Amphithéâtre B</p>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-rose-500 rounded-full" style="width: 100%"></div>
              </div>
              <span class="text-[11px] font-light text-slate-400 whitespace-nowrap">0/80 places</span>
            </div>
            <button disabled class="w-full py-2.5 rounded-lg bg-slate-100 text-slate-400 text-xs font-medium cursor-not-allowed">
              Complet
            </button>
          </div>
        </div>

        <!-- CARD 5 - PAID -->
        <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md">
          <div class="h-32 bg-gradient-to-br from-slate-800 to-slate-900 relative flex items-center justify-center">
            <i class="fa-solid fa-masks-theater text-white/25 text-4xl"></i>
            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-amber-600 px-2.5 py-1 rounded-full">80 DH</span>
          </div>
          <div class="p-5">
            <p class="font-medium text-slate-800 text-sm mb-2.5">Nuit du théâtre étudiant</p>
            <div class="space-y-1.5 mb-4">
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> 22 Oct 2026 · 20h30</p>
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> Théâtre du campus</p>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-600 rounded-full" style="width: 48%"></div>
              </div>
              <span class="text-[11px] font-light text-slate-400 whitespace-nowrap">58/120 places</span>
            </div>
            <button class="w-full py-2.5 rounded-lg border border-slate-200 text-slate-700 text-xs font-medium hover:bg-slate-50 transition-all duration-200">
              Réserver ma place
            </button>
          </div>
        </div>

        <!-- CARD 6 - FREE -->
        <div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md">
          <div class="h-32 bg-gradient-to-br from-indigo-600 to-slate-900 relative flex items-center justify-center">
            <i class="fa-solid fa-palette text-white/25 text-4xl"></i>
            <span class="absolute top-3 left-3 text-[11px] font-medium bg-white/90 text-emerald-600 px-2.5 py-1 rounded-full">Gratuit</span>
          </div>
          <div class="p-5">
            <p class="font-medium text-slate-800 text-sm mb-2.5">Atelier créatif "Campus en couleurs"</p>
            <div class="space-y-1.5 mb-4">
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-regular fa-calendar w-3.5 text-slate-400"></i> 03 Nov 2026 · 15h00</p>
              <p class="text-xs font-light text-slate-500 flex items-center gap-2"><i class="fa-solid fa-location-dot w-3.5 text-slate-400"></i> Atelier Beaux-Arts</p>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-600 rounded-full" style="width: 15%"></div>
              </div>
              <span class="text-[11px] font-light text-slate-400 whitespace-nowrap">6/40 places</span>
            </div>
            <button class="w-full py-2.5 rounded-lg bg-indigo-600 text-white text-xs font-medium hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
              <i class="fa-solid fa-bolt text-[10px]"></i> S'inscrire en 1 clic
            </button>
          </div>
        </div>

      </div>

    </main>
  </div>
</div>

</body>
</html>