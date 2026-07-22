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
<style>
  body { font-family: 'Poppins', sans-serif; }
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
  .nav-item { transition: all .2s ease; }
  .nav-item:hover { background: rgba(255,255,255,0.06); }
  .nav-active { background: #4f46e5; }
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
      <a href="#" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-normal">
        <i class="fa-solid fa-chart-simple w-4 text-center text-xs"></i> Vue d'ensemble
      </a>
      <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
        <i class="fa-solid fa-calendar-days w-4 text-center text-xs"></i> Événements
      </a>
      <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
        <i class="fa-solid fa-ticket w-4 text-center text-xs"></i> Réservations
      </a>
      <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
        <i class="fa-solid fa-gear w-4 text-center text-xs"></i> Paramètres
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

    <!-- CONTENT -->
    <main class="flex-1 p-5 lg:p-8 space-y-8">

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

        <form class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">

          <div class="md:col-span-2">
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Titre de l'événement</label>
            <input type="text" placeholder="Ex : Soirée d'intégration BDE"
              class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
          </div>

          <div class="md:col-span-2">
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
            <textarea rows="3" placeholder="Décrivez l'événement en quelques lignes..."
              class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-none"></textarea>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Date</label>
            <div class="relative">
              <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="date"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal text-slate-600 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Heure</label>
            <div class="relative">
              <i class="fa-regular fa-clock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="time"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal text-slate-600 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Lieu</label>
            <div class="relative">
              <i class="fa-solid fa-location-dot absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="text" placeholder="Ex : Amphithéâtre A"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Jauge maximale</label>
            <div class="relative">
              <i class="fa-solid fa-users absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="number" min="1" placeholder="Ex : 200"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <div class="md:col-span-2">
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Tarification</label>
            <div class="flex flex-wrap items-center gap-3">
              <label class="flex items-center gap-2 px-4 py-2.5 rounded-lg border border-indigo-500 bg-indigo-50/50 cursor-pointer transition-all duration-200">
                <input type="radio" name="pricing" checked class="w-3.5 h-3.5 text-indigo-600 focus:ring-indigo-500/30">
                <span class="text-xs font-medium text-slate-700">Gratuit</span>
              </label>
              <label class="flex items-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 cursor-pointer transition-all duration-200 hover:border-slate-300">
                <input type="radio" name="pricing" class="w-3.5 h-3.5 text-indigo-600 focus:ring-indigo-500/30">
                <span class="text-xs font-medium text-slate-700">Payant</span>
              </label>
              <div class="relative flex-1 min-w-[140px]">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-light">DH</span>
                <input type="number" min="0" placeholder="0.00" disabled
                  class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 text-sm font-normal text-slate-400 placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
              </div>
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
      <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
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

              <tr class="hover:bg-slate-50/60 transition-all duration-200">
                <td class="px-6 lg:px-8 py-4">
                  <p class="font-medium text-slate-800">Soirée d'intégration BDE</p>
                  <p class="text-xs font-light text-slate-400">Amphithéâtre A</p>
                </td>
                <td class="px-4 py-4 text-slate-500 font-light">12 Sept 2026</td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-emerald-50 text-emerald-600 px-2 py-1 rounded-full">Gratuit</span>
                </td>
                <td class="px-4 py-4">
                  <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                      <div class="h-full bg-indigo-600 rounded-full" style="width: 68%"></div>
                    </div>
                    <span class="text-xs font-light text-slate-500 w-16 text-right">64/200</span>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-indigo-50 text-indigo-600 px-2 py-1 rounded-full">Ouvert</span>
                </td>
              </tr>

              <tr class="hover:bg-slate-50/60 transition-all duration-200">
                <td class="px-6 lg:px-8 py-4">
                  <p class="font-medium text-slate-800">Gala de fin d'année</p>
                  <p class="text-xs font-light text-slate-400">Salle des Arts</p>
                </td>
                <td class="px-4 py-4 text-slate-500 font-light">28 Sept 2026</td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-amber-50 text-amber-600 px-2 py-1 rounded-full">150 DH</span>
                </td>
                <td class="px-4 py-4">
                  <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                      <div class="h-full bg-amber-500 rounded-full" style="width: 91%"></div>
                    </div>
                    <span class="text-xs font-light text-slate-500 w-16 text-right">9/100</span>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-amber-50 text-amber-600 px-2 py-1 rounded-full">Presque complet</span>
                </td>
              </tr>

              <tr class="hover:bg-slate-50/60 transition-all duration-200">
                <td class="px-6 lg:px-8 py-4">
                  <p class="font-medium text-slate-800">Tournoi sportif inter-filières</p>
                  <p class="text-xs font-light text-slate-400">Complexe sportif</p>
                </td>
                <td class="px-4 py-4 text-slate-500 font-light">05 Oct 2026</td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-emerald-50 text-emerald-600 px-2 py-1 rounded-full">Gratuit</span>
                </td>
                <td class="px-4 py-4">
                  <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                      <div class="h-full bg-indigo-600 rounded-full" style="width: 30%"></div>
                    </div>
                    <span class="text-xs font-light text-slate-500 w-16 text-right">45/150</span>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-indigo-50 text-indigo-600 px-2 py-1 rounded-full">Ouvert</span>
                </td>
              </tr>

              <tr class="hover:bg-slate-50/60 transition-all duration-200">
                <td class="px-6 lg:px-8 py-4">
                  <p class="font-medium text-slate-800">Conférence Tech & Carrières</p>
                  <p class="text-xs font-light text-slate-400">Amphithéâtre B</p>
                </td>
                <td class="px-4 py-4 text-slate-500 font-light">14 Oct 2026</td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-emerald-50 text-emerald-600 px-2 py-1 rounded-full">Gratuit</span>
                </td>
                <td class="px-4 py-4">
                  <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                      <div class="h-full bg-rose-500 rounded-full" style="width: 100%"></div>
                    </div>
                    <span class="text-xs font-light text-slate-500 w-16 text-right">0/80</span>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <span class="text-[11px] font-medium bg-rose-50 text-rose-600 px-2 py-1 rounded-full">Complet</span>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>
</div>

</body>
</html>