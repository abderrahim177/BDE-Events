<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BDE-Events — Connexion / Inscription</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { sans: ['Poppins', 'sans-serif'] },
        colors: {
          brand: {
            900: '#0f172a',
            800: '#1e293b',
          }
        }
      }
    }
  }
</script>
<style>
  body { font-family: 'Poppins', sans-serif; }
  .tab-active { color: #4f46e5; border-color: #4f46e5; }
  .tab-inactive { color: #94a3b8; border-color: transparent; }
  .panel { display: none; }
  .panel.active { display: block; }
  ::selection { background: #e0e7ff; }
</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<div class="min-h-screen flex">

  <!-- LEFT VISUAL PANEL -->
  <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900 to-indigo-950/40"></div>

    <!-- subtle decorative grid -->
    <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>

    <!-- decorative floating cards -->
    <div class="absolute top-16 right-14 w-64 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm p-5 shadow-2xl">
      <div class="flex items-center justify-between mb-3">
        <span class="text-[11px] font-medium text-indigo-300 tracking-wide uppercase">Événement</span>
        <span class="text-[10px] font-medium bg-emerald-500/15 text-emerald-300 px-2 py-0.5 rounded-full">Gratuit</span>
      </div>
      <p class="text-white font-medium text-sm mb-1">Soirée d'intégration BDE</p>
      <p class="text-slate-400 text-xs font-light mb-4">12 Sept · 20h00 · Amphithéâtre A</p>
      <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
        <div class="h-full bg-indigo-500 rounded-full" style="width: 68%"></div>
      </div>
      <p class="text-[11px] text-slate-500 font-light mt-2">136/200 places réservées</p>
    </div>

    <div class="absolute bottom-24 left-14 w-56 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm p-5 shadow-2xl">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-full bg-indigo-500/20 flex items-center justify-center">
          <i class="fa-solid fa-ticket text-indigo-300 text-sm"></i>
        </div>
        <div>
          <p class="text-white text-sm font-medium">Pass numérique</p>
          <p class="text-slate-500 text-xs font-light">Accès instantané</p>
        </div>
      </div>
    </div>

    <!-- brand content -->
    <div class="relative z-10 flex flex-col justify-between p-14 w-full">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center">
          <i class="fa-solid fa-calendar-days text-white text-sm"></i>
        </div>
        <span class="text-white text-lg font-medium tracking-tight">BDE-Events</span>
      </div>

      <div class="max-w-md">
        <h1 class="text-4xl font-semibold text-white leading-tight tracking-tight mb-4">
          La vie du campus,<br class="hidden xl:block"> réservée en un clic.
        </h1>
        <p class="text-slate-400 font-light leading-relaxed">
          Découvrez, réservez et retrouvez tous vos billets pour les événements organisés par votre BDE — sur un seul et même espace.
        </p>
      </div>

      <p class="text-slate-600 text-xs font-light">© 2026 BDE-Events · Campus Universitaire</p>
    </div>
  </div>

  <!-- RIGHT FORM PANEL -->
  <div class="w-full lg:w-1/2 flex items-center justify-center px-6 sm:px-10 py-14">
    <div class="w-full max-w-sm">

      <!-- mobile logo -->
      <div class="flex lg:hidden items-center gap-3 mb-10 justify-center">
        <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center">
          <i class="fa-solid fa-calendar-days text-white text-sm"></i>
        </div>
        <span class="text-slate-900 text-lg font-medium tracking-tight">BDE-Events</span>
      </div>

      <!-- Tabs -->
      <div class="flex items-center gap-8 border-b border-slate-200 mb-8">
        <button onclick="showPanel('login')" id="tab-login" class="tab-active pb-3 text-sm font-medium border-b-2 transition-all duration-200">
          Connexion
        </button>
        <button onclick="showPanel('register')" id="tab-register" class="tab-inactive pb-3 text-sm font-medium border-b-2 transition-all duration-200">
          Inscription
        </button>
      </div>

      <!-- LOGIN PANEL -->
      <div id="panel-login" class="panel active">
        <h2 class="text-2xl font-semibold text-slate-900 tracking-tight mb-1">Bon retour parmi nous</h2>
        <p class="text-slate-500 font-light text-sm mb-8">Connectez-vous pour accéder à vos événements.</p>

        <form action="{{route('Login')}}" method="POST"  class="space-y-5">
          @csrf
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Email étudiant</label>
            <div class="relative">
              <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="email" name="email" placeholder="prenom.nom@campus.fr"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>
          @error('email')
        <p class="mt-1.5 text-xs text-red-500 font-medium flex items-center gap-1">
            <i class="fa-solid fa-circle-exclamation text-xs"></i>
            {{ $message }}
        </p>
        @enderror
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Mot de passe</label>
            <div class="relative">
              <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="password" name="password" placeholder="••••••••"
                class="w-full pl-10 pr-10 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
              <i class="fa-regular fa-eye absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm cursor-pointer hover:text-slate-600 transition-all duration-200"></i>
            </div>
          </div>

          <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 cursor-pointer select-none">
              <input type="checkbox" class="w-3.5 h-3.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/30">
              <span class="text-xs font-light text-slate-500">Se souvenir de moi</span>
            </label>
            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-all duration-200">Mot de passe oublié ?</a>
          </div>

          <button type="submit"
            class="w-full py-2.5 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-all duration-200 shadow-sm hover:shadow-md">
            Se connecter
          </button>
        </form>

        <p class="text-center text-xs font-light text-slate-500 mt-8">
          Pas encore de compte ?
          <button onclick="showPanel('register')" class="text-indigo-600 font-medium hover:text-indigo-700 transition-all duration-200">S'inscrire</button>
        </p>
      </div>

      <!-- REGISTER PANEL -->
      <div id="panel-register" class="panel">
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
        <h2 class="text-2xl font-semibold text-slate-900 tracking-tight mb-1">Créer votre compte</h2>
        <p class="text-slate-500 font-light text-sm mb-8">Rejoignez la communauté du campus en quelques secondes.</p>

        <form action="{{route ('register')}}" method="POST" class="space-y-5" >
          @csrf
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Nom complet</label>
            <div class="relative">
              <i class="fa-regular fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="text" name="name" placeholder="Prénom Nom"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Email étudiant</label>
            <div class="relative">
              <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="email" name="email" placeholder="prenom.nom@campus.fr"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1.5">Mot de passe</label>
            <div class="relative">
              <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
              <input type="password" name="password" placeholder="8 caractères minimum"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 placeholder:font-light outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>
          </div>

          <label class="flex items-start gap-2 cursor-pointer select-none pt-1">
            <input type="checkbox" class="w-3.5 h-3.5 mt-0.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/30">
            <span class="text-xs font-light text-slate-500">J'accepte les <a href="#" class="text-indigo-600 font-medium">conditions d'utilisation</a> et la politique de confidentialité.</span>
          </label>

          <button type="submit"
            class="w-full py-2.5 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-all duration-200 shadow-sm hover:shadow-md">
            Créer mon compte
          </button>
        </form>

        <p class="text-center text-xs font-light text-slate-500 mt-8">
          Déjà inscrit ?
          <button onclick="showPanel('login')" class="text-indigo-600 font-medium hover:text-indigo-700 transition-all duration-200">Se connecter</button>
        </p>
      </div>

    </div>
  </div>
</div>

<script>
  function showPanel(name) {
    document.getElementById('panel-login').classList.toggle('active', name === 'login');
    document.getElementById('panel-register').classList.toggle('active', name === 'register');
    document.getElementById('tab-login').className = (name === 'login' ? 'tab-active' : 'tab-inactive') + ' pb-3 text-sm font-medium border-b-2 transition-all duration-200';
    document.getElementById('tab-register').className = (name === 'register' ? 'tab-active' : 'tab-inactive') + ' pb-3 text-sm font-medium border-b-2 transition-all duration-200';
  }
</script>

</body>
</html>