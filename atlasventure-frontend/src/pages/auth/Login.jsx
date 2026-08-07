import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import axios from 'axios';

export default function Login() {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
    remember: false,
  });
  const [showPassword, setShowPassword] = useState(false);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(false);

  const navigate = useNavigate();

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value,
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(null);
    setLoading(true);

    try {
      // 1. إرسال الطلب للـ Backend (Laravel Sanctum)
      const response = await axios.post('http://localhost:8000/api/login', {
        email: formData.email,
        password: formData.password,
      });

      // 2. حفظ الـ Token فـ localStorage
      if (response.data.token) {
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        
        // 3. التوجيه للـ Dashboard
        navigate('/student');
      }
    } catch (err) {
      console.error('Login Error:', err);
      setError(
        err.response?.data?.message || 'Email ou mot de passe incorrect.'
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen flex bg-slate-50 text-slate-800 font-sans antialiased">
      {/* LEFT VISUAL PANEL */}
      <div className="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
        <div className="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900 to-indigo-950/40"></div>

        <div
          className="absolute inset-0 opacity-[0.07]"
          style={{
            backgroundImage: 'radial-gradient(circle, #ffffff 1px, transparent 1px)',
            backgroundSize: '28px 28px',
          }}
        ></div>

        {/* Decorative floating cards */}
        <div className="absolute top-16 right-14 w-64 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm p-5 shadow-2xl">
          <div className="flex items-center justify-between mb-3">
            <span className="text-[11px] font-medium text-indigo-300 tracking-wide uppercase">
              Événement
            </span>
            <span className="text-[10px] font-medium bg-emerald-500/15 text-emerald-300 px-2 py-0.5 rounded-full">
              Gratuit
            </span>
          </div>
          <p className="text-white font-medium text-sm mb-1">Soirée d'intégration BDE</p>
          <p className="text-slate-400 text-xs font-light mb-4">
            12 Sept · 20h00 · Amphithéâtre A
          </p>
          <div className="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
            <div className="h-full bg-indigo-500 rounded-full" style={{ width: '68%' }}></div>
          </div>
          <p className="text-[11px] text-slate-500 font-light mt-2">
            136/200 places réservées
          </p>
        </div>

        <div className="absolute bottom-24 left-14 w-56 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm p-5 shadow-2xl">
          <div className="flex items-center gap-3">
            <div className="w-9 h-9 rounded-full bg-indigo-500/20 flex items-center justify-center">
              <i className="fa-solid fa-ticket text-indigo-300 text-sm"></i>
            </div>
            <div>
              <p className="text-white text-sm font-medium">Pass numérique</p>
              <p className="text-slate-500 text-xs font-light">Accès instantané</p>
            </div>
          </div>
        </div>

        {/* Brand content */}
        <div className="relative z-10 flex flex-col justify-between p-14 w-full">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center">
              <i className="fa-solid fa-calendar-days text-white text-sm"></i>
            </div>
            <span className="text-white text-lg font-medium tracking-tight">
              BDE-Events
            </span>
          </div>

          <div className="max-w-md">
            <h1 className="text-4xl font-semibold text-white leading-tight tracking-tight mb-4">
              La vie du campus,<br className="hidden xl:block" /> réservée en un clic.
            </h1>
            <p className="text-slate-400 font-light leading-relaxed">
              Découvrez, réservez et retrouvez tous vos billets pour les événements
              organisés par votre BDE — sur un seul et même espace.
            </p>
          </div>

          <p className="text-slate-600 text-xs font-light">
            © 2026 BDE-Events · Campus Universitaire
          </p>
        </div>
      </div>

      {/* RIGHT FORM PANEL */}
      <div className="w-full lg:w-1/2 flex items-center justify-center px-6 sm:px-10 py-14">
        <div className="w-full max-w-sm">
          {/* Mobile Logo */}
          <div className="flex lg:hidden items-center gap-3 mb-10 justify-center">
            <div className="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center">
              <i className="fa-solid fa-calendar-days text-white text-sm"></i>
            </div>
            <span className="text-slate-900 text-lg font-medium tracking-tight">
              BDE-Events
            </span>
          </div>

          {/* Navigation Tabs */}
          <div className="flex items-center gap-8 border-b border-slate-200 mb-8">
            <span className="text-indigo-600 border-indigo-600 pb-3 text-sm font-medium border-b-2 transition-all duration-200 cursor-pointer">
              Connexion
            </span>
            <Link
              to="/register"
              className="text-slate-400 border-transparent hover:text-slate-600 pb-3 text-sm font-medium border-b-2 transition-all duration-200"
            >
              Inscription
            </Link>
          </div>

          {/* Login Form */}
          <div>
            <h2 class="text-2xl font-semibold text-slate-900 tracking-tight mb-1">
              Bon retour parmi nous
            </h2>
            <p className="text-slate-500 font-light text-sm mb-8">
              Connectez-vous pour accéder à vos événements.
            </p>

            {/* Error Notification */}
            {error && (
              <div className="mb-5 p-3 rounded-lg bg-red-50 border border-red-200 text-red-600 text-xs font-medium flex items-center gap-2">
                <i className="fa-solid fa-circle-exclamation text-sm"></i>
                <span>{error}</span>
              </div>
            )}

            <form onSubmit={handleSubmit} className="space-y-5">
              <div>
                <label className="block text-xs font-medium text-slate-600 mb-1.5">
                  Email étudiant
                </label>
                <div className="relative">
                  <i className="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                  <input
                    type="email"
                    name="email"
                    value={formData.email}
                    onChange={handleChange}
                    required
                    placeholder="prenom.nom@campus.fr"
                    className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                  />
                </div>
              </div>

              <div>
                <label className="block text-xs font-medium text-slate-600 mb-1.5">
                  Mot de passe
                </label>
                <div className="relative">
                  <i className="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                  <input
                    type={showPassword ? 'text' : 'password'}
                    name="password"
                    value={formData.password}
                    onChange={handleChange}
                    required
                    placeholder="••••••••"
                    className="w-full pl-10 pr-10 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                  />
                  <i
                    onClick={() => setShowPassword(!showPassword)}
                    className={`fa-regular ${
                      showPassword ? 'fa-eye-slash' : 'fa-eye'
                    } absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm cursor-pointer hover:text-slate-600 transition-all duration-200`}
                  ></i>
                </div>
              </div>

              <div className="flex items-center justify-between pt-1">
                <label className="flex items-center gap-2 cursor-pointer select-none">
                  <input
                    type="checkbox"
                    name="remember"
                    checked={formData.remember}
                    onChange={handleChange}
                    className="w-3.5 h-3.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/30"
                  />
                  <span className="text-xs font-light text-slate-500">
                    Se souvenir de moi
                  </span>
                </label>
                <a
                  href="#"
                  className="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-all duration-200"
                >
                  Mot de passe oublié ?
                </a>
              </div>

              <button
                type="submit"
                disabled={loading}
                className="w-full py-2.5 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-all duration-200 shadow-sm hover:shadow-md disabled:opacity-50"
              >
                {loading ? 'Connexion en cours...' : 'Se connecter'}
              </button>
            </form>

            <p className="text-center text-xs font-light text-slate-500 mt-8">
              Pas encore de compte ?{' '}
              <Link
                to="/register"
                className="text-indigo-600 font-medium hover:text-indigo-700 transition-all duration-200"
              >
                S'inscrire
              </Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}