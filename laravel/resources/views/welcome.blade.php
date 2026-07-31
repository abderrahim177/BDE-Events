<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events List - Skeuomorphism</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#e0e5ec] font-['Poppins'] flex items-center justify-center min-h-screen p-6">

    <!-- 🎛️ Skeuomorphic Card (Neumorphism / Physical Metal Panel) -->
    <div class="w-full max-w-md bg-[#e6e9ef] p-8 rounded-[30px] border border-white/60 shadow-[15px_15px_30px_#be22b, -15px_-15px_30px_#ffffff] relative overflow-hidden">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <!-- Embossed Badge (زر بارز) -->
            <span class="text-xs font-bold tracking-wider uppercase text-indigo-600 bg-[#e6e9ef] px-4 py-2 rounded-full shadow-[inset_2px_2px_5px_#c5c8d0,inset_-2px_-2px_5px_#ffffff] border border-slate-300/40">
                Événement
            </span>
            <span class="text-sm font-semibold text-slate-500 tracking-wide">BDE Campus</span>
        </div>

        <!-- Title & Content -->
        <h2 class="text-2xl font-bold mb-3 text-slate-800 drop-shadow-[1px_1px_1px_rgba(255,255,255,0.8)]">
            Soirée d'Intégration 2026
        </h2>
        <p class="text-sm text-slate-600 mb-6 leading-relaxed">
            Rejoignez-nous pour la plus grande soirée de l'année ! Rencontrez vos camarades et profitez d'une ambiance exceptionnelle.
        </p>

        <!-- Stats Grid (Inset / Recessed Panels - بلايص محفورين لداخل) -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            
            <!-- Inset Box 1 -->
            <div class="bg-[#e6e9ef] rounded-2xl p-4 text-center shadow-[inset_4px_4px_8px_#c5c8d0,inset_-4px_-4px_8px_#ffffff] border border-slate-300/30">
                <p class="text-xs font-medium text-slate-500 mb-1">Places restantes</p>
                <p class="text-xl font-black text-indigo-700 drop-shadow-[0_1px_0_rgba(255,255,255,1)]">
                    45 <span class="text-xs font-normal text-slate-400">/ 150</span>
                </p>
            </div>

            <!-- Inset Box 2 -->
            <div class="bg-[#e6e9ef] rounded-2xl p-4 text-center shadow-[inset_4px_4px_8px_#c5c8d0,inset_-4px_-4px_8px_#ffffff] border border-slate-300/30">
                <p class="text-xs font-medium text-slate-500 mb-1">Prix</p>
                <p class="text-xl font-black text-emerald-600 drop-shadow-[0_1px_0_rgba(255,255,255,1)]">
                    Gratuit
                </p>
            </div>

        </div>

        <!-- 🔴 Skeuomorphic 3D Push Button (زر بارز كيتبرسّا بحال الفيزيك) -->
        <button class="w-full bg-gradient-to-b from-indigo-500 to-indigo-700 text-white font-bold py-4 px-6 rounded-2xl 
                       shadow-[0_6px_0_#3730a3,0_12px_15px_rgba(0,0,0,0.3)] 
                       hover:bg-gradient-to-b hover:from-indigo-400 hover:to-indigo-600
                       active:translate-y-1.5 active:shadow-[0_0px_0_#3730a3,0_4px_6px_rgba(0,0,0,0.3)] 
                       transition-all duration-150 border-t border-indigo-300">
            <i class="fa-solid fa-ticket mr-2"></i> Réserver ma place
        </button>

    </div>

</body>
</html>