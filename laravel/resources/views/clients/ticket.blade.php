<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BDE-Events — Mes Billets</title>
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

  /* Ticket perforation notches */
  .notch-left, .notch-right {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 24px;
    height: 24px;
    background: #f8fafc;
    border-radius: 999px;
  }
  .notch-left { left: -12px; }
  .notch-right { right: -12px; }

  .perforation {
    background-image: repeating-linear-gradient(to bottom, #e2e8f0 0, #e2e8f0 6px, transparent 6px, transparent 14px);
    width: 1px;
  }

  /* Simulated barcode */
  .barcode {
    height: 40px;
    background: repeating-linear-gradient(
      90deg,
      #0f172a 0px, #0f172a 2px,
      transparent 2px, transparent 4px,
      #0f172a 4px, #0f172a 5px,
      transparent 5px, transparent 9px,
      #0f172a 9px, #0f172a 12px,
      transparent 12px, transparent 14px,
      #0f172a 14px, #0f172a 15px,
      transparent 15px, transparent 19px
    );
  }

  /* Simulated QR code */
  .qr {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-template-rows: repeat(7, 1fr);
    width: 72px;
    height: 72px;
    gap: 2px;
  }
  .qr div { background: #0f172a; border-radius: 1px; }
  .qr .off { background: transparent; }
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
      <a href="{{route ('/students')}}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-normal">
        <i class="fa-solid fa-compass w-4 text-center text-xs"></i> Découvrir
      </a>
      <a href="tickets.html" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-normal">
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
          <p class="text-xs font-medium text-white truncate">{{ auth()->user()->name }}</p>
          <p class="text-[11px] font-light text-slate-500 truncate">{{ auth()->user()->role }} · L3 Info</p>
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
        <input type="text" placeholder="Rechercher un billet..."
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
            <p class="text-xs font-medium text-slate-800 leading-tight">{{ auth()->user()->name}}</p>
            <p class="text-[11px] font-light text-slate-400 leading-tight">{{ auth()->user()->role }}</p>
          </div>
          <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
        </div>
      </div>
    </header>

    <!-- CONTENT -->
    <main class="flex-1 p-5 lg:p-8 space-y-8">

      <div>
        <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Mes Billets</h1>
        <p class="text-sm font-light text-slate-500 mt-1">Retrouvez vos pass numériques pour tous vos événements réservés.</p>
      </div>

      <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        <!-- TICKET 1 -->
        <div class="relative flex shadow-sm rounded-2xl">
          <div class="flex-1 bg-slate-900 rounded-l-2xl p-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="relative flex items-center justify-between mb-6">
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center">
                  <i class="fa-solid fa-calendar-days text-white text-[10px]"></i>
                </div>
                <span class="text-white text-xs font-medium tracking-tight">BDE-Events</span>
              </div>
              <span class="text-[10px] font-medium text-emerald-300 bg-emerald-500/15 px-2.5 py-1 rounded-full">Confirmé</span>
            </div>

            <p class="relative text-slate-500 text-[11px] font-light uppercase tracking-widest mb-1">Événement</p>
            <h3 class="relative text-white text-lg font-semibold tracking-tight mb-5">Soirée d'intégration BDE</h3>

            <div class="relative grid grid-cols-2 gap-4 mb-5">
              <div>
                <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Date</p>
                <p class="text-white text-sm font-normal">12 Septembre 2026</p>
              </div>
              <div>
                <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Heure</p>
                <p class="text-white text-sm font-normal">20h00</p>
              </div>
              <div class="col-span-2">
                <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Lieu</p>
                <p class="text-white text-sm font-normal">Amphithéâtre A — Campus Principal</p>
              </div>
            </div>

            <div class="relative pt-4 border-t border-white/10">
              <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Titulaire</p>
              <p class="text-white text-sm font-medium">Yasmine Bouzid</p>
            </div>
          </div>

          <!-- perforation -->
          <div class="relative w-0">
            <div class="notch-left" style="top: -12px;"></div>
            <div class="perforation h-full"></div>
            <div class="notch-left" style="top: auto; bottom: -12px; transform: translateY(0);"></div>
          </div>

          <!-- stub -->
          <div class="w-40 shrink-0 bg-slate-900 rounded-r-2xl p-5 flex flex-col items-center justify-center gap-3">
            <div class="qr">
              <div></div><div class="off"></div><div></div><div></div><div class="off"></div><div></div><div></div>
              <div class="off"></div><div></div><div class="off"></div><div class="off"></div><div></div><div class="off"></div><div></div>
              <div></div><div></div><div></div><div class="off"></div><div></div><div class="off"></div><div></div>
              <div class="off"></div><div class="off"></div><div class="off"></div><div></div><div class="off"></div><div></div><div class="off"></div>
              <div></div><div></div><div class="off"></div><div class="off"></div><div></div><div></div><div></div>
              <div class="off"></div><div></div><div class="off"></div><div></div><div class="off"></div><div class="off"></div><div class="off"></div>
              <div></div><div class="off"></div><div></div><div></div><div class="off"></div><div></div><div></div>
            </div>
            <p class="text-white text-[10px] font-light tracking-widest">BDE-2026-X79F2</p>
          </div>
        </div>

        <!-- TICKET 2 -->
        <div class="relative flex shadow-sm rounded-2xl">
          <div class="flex-1 bg-slate-900 rounded-l-2xl p-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="relative flex items-center justify-between mb-6">
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center">
                  <i class="fa-solid fa-calendar-days text-white text-[10px]"></i>
                </div>
                <span class="text-white text-xs font-medium tracking-tight">BDE-Events</span>
              </div>
              <span class="text-[10px] font-medium text-amber-300 bg-amber-500/15 px-2.5 py-1 rounded-full">En attente</span>
            </div>

            <p class="relative text-slate-500 text-[11px] font-light uppercase tracking-widest mb-1">Événement</p>
            <h3 class="relative text-white text-lg font-semibold tracking-tight mb-5">Nuit du théâtre étudiant</h3>

            <div class="relative grid grid-cols-2 gap-4 mb-5">
              <div>
                <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Date</p>
                <p class="text-white text-sm font-normal">22 Octobre 2026</p>
              </div>
              <div>
                <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Heure</p>
                <p class="text-white text-sm font-normal">20h30</p>
              </div>
              <div class="col-span-2">
                <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Lieu</p>
                <p class="text-white text-sm font-normal">Théâtre du Campus — Bâtiment C</p>
              </div>
            </div>

            <div class="relative pt-4 border-t border-white/10">
              <p class="text-slate-500 text-[10px] font-light uppercase tracking-widest mb-1">Titulaire</p>
              <p class="text-white text-sm font-medium">Yasmine Bouzid</p>
            </div>
          </div>

          <div class="relative w-0">
            <div class="notch-left" style="top: -12px;"></div>
            <div class="perforation h-full"></div>
            <div class="notch-left" style="top: auto; bottom: -12px; transform: translateY(0);"></div>
          </div>

          <div class="w-40 shrink-0 bg-slate-900 rounded-r-2xl p-5 flex flex-col items-center justify-center gap-3">
            <div class="qr">
              <div></div><div></div><div class="off"></div><div></div><div class="off"></div><div class="off"></div><div></div>
              <div class="off"></div><div class="off"></div><div></div><div class="off"></div><div></div><div></div><div class="off"></div>
              <div></div><div></div><div></div><div class="off"></div><div class="off"></div><div></div><div></div>
              <div class="off"></div><div></div><div class="off"></div><div></div><div></div><div class="off"></div><div class="off"></div>
              <div></div><div class="off"></div><div></div><div class="off"></div><div></div><div class="off"></div><div></div>
              <div class="off"></div><div></div><div></div><div class="off"></div><div class="off"></div><div></div><div class="off"></div>
              <div></div><div class="off"></div><div></div><div></div><div class="off"></div><div></div><div class="off"></div>
            </div>
            <p class="text-white text-[10px] font-light tracking-widest">BDE-2026-K21R8</p>
          </div>
        </div>

        <!-- TICKET 3 - PAST/USED -->
        <div class="relative flex shadow-sm rounded-2xl opacity-60">
          <div class="flex-1 bg-slate-700 rounded-l-2xl p-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="relative flex items-center justify-between mb-6">
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-slate-500 flex items-center justify-center">
                  <i class="fa-solid fa-calendar-days text-white text-[10px]"></i>
                </div>
                <span class="text-white text-xs font-medium tracking-tight">BDE-Events</span>
              </div>
              <span class="text-[10px] font-medium text-slate-300 bg-white/10 px-2.5 py-1 rounded-full">Utilisé</span>
            </div>

            <p class="relative text-slate-400 text-[11px] font-light uppercase tracking-widest mb-1">Événement</p>
            <h3 class="relative text-white text-lg font-semibold tracking-tight mb-5">Ciné-club en plein air</h3>

            <div class="relative grid grid-cols-2 gap-4 mb-5">
              <div>
                <p class="text-slate-400 text-[10px] font-light uppercase tracking-widest mb-1">Date</p>
                <p class="text-white text-sm font-normal">02 Juillet 2026</p>
              </div>
              <div>
                <p class="text-slate-400 text-[10px] font-light uppercase tracking-widest mb-1">Heure</p>
                <p class="text-white text-sm font-normal">21h00</p>
              </div>
              <div class="col-span-2">
                <p class="text-slate-400 text-[10px] font-light uppercase tracking-widest mb-1">Lieu</p>
                <p class="text-white text-sm font-normal">Esplanade Centrale</p>
              </div>
            </div>

            <div class="relative pt-4 border-t border-white/10">
              <p class="text-slate-400 text-[10px] font-light uppercase tracking-widest mb-1">Titulaire</p>
              <p class="text-white text-sm font-medium">Yasmine Bouzid</p>
            </div>
          </div>

          <div class="relative w-0">
            <div class="notch-left" style="top: -12px; background: #f8fafc;"></div>
            <div class="perforation h-full"></div>
            <div class="notch-left" style="top: auto; bottom: -12px; transform: translateY(0); background: #f8fafc;"></div>
          </div>

          <div class="w-40 shrink-0 bg-slate-700 rounded-r-2xl p-5 flex flex-col items-center justify-center gap-3">
            <div class="qr">
              <div></div><div class="off"></div><div></div><div class="off"></div><div></div><div></div><div class="off"></div>
              <div></div><div></div><div class="off"></div><div></div><div class="off"></div><div></div><div></div>
              <div class="off"></div><div></div><div></div><div></div><div class="off"></div><div class="off"></div><div></div>
              <div></div><div class="off"></div><div></div><div class="off"></div><div></div><div></div><div class="off"></div>
              <div class="off"></div><div></div><div class="off"></div><div></div><div class="off"></div><div class="off"></div><div></div>
              <div></div><div class="off"></div><div></div><div></div><div class="off"></div><div></div><div class="off"></div>
              <div class="off"></div><div></div><div class="off"></div><div></div><div></div><div class="off"></div><div></div>
            </div>
            <p class="text-white text-[10px] font-light tracking-widest">BDE-2026-M03T5</p>
          </div>
        </div>

        <!-- EMPTY STATE CARD (placeholder for future tickets) -->
        <div class="rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center p-10 text-center min-h-[220px]">
          <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mb-4">
            <i class="fa-solid fa-ticket text-slate-400 text-sm"></i>
          </div>
          <p class="text-sm font-medium text-slate-600 mb-1">Découvrez plus d'événements</p>
          <p class="text-xs font-light text-slate-400 mb-4 max-w-[220px]">Vos prochains pass numériques apparaîtront ici dès votre inscription.</p>
          <a href="{{route ('/students')}}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-all duration-200 flex items-center gap-1.5">
            Explorer les événements <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

      </div>

    </main>
  </div>
</div>

</body>
</html>