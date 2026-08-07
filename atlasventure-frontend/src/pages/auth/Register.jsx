import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import axios from 'axios';

export default function Register() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    terms: false,
  });
  const [errors, setErrors] = useState([]);
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
    setErrors([]);
    if (!formData.terms) {
      setErrors(["Veuillez accepter les conditions d'utilisation."]);
      return;
    }
    setLoading(true);
    try {
      const response = await axios.post('http://localhost:8000/api/register', {
        name: formData.name,
        email: formData.email,
        password: formData.password,
      });
      if (response.data.token) {
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        navigate('/student');
      }
    } catch (err) {
      console.error('Register Error:', err);
      if (err.response?.data?.errors) {
        const validationErrors = Object.values(err.response.data.errors).flat();
        setErrors(validationErrors);
      } else {
        setErrors([err.response?.data?.message || 'Une erreur est survenue.']);
      }
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
            <Link
              to="/login"
              className="text-slate-400 border-transparent hover:text-slate-600 pb-3 text-sm font-medium border-b-2 transition-all duration-200"
            >
              Connexion
            </Link>
            <span className="text-indigo-600 border-indigo-600 pb-3 text-sm font-medium border-b-2 transition-all duration-200 cursor-pointer">
              Inscription
            </span>
          </div>

          {/* Register Form */}
          <div>
            {/* Display Laravel Errors */}
            {errors.length > 0 && (
              <div className="mb-5 p-4 rounded-xl bg-red-50 border border-red-200/60 text-red-600 text-xs font-medium space-y-1">
                <div className="flex items-center gap-2 font-semibold text-red-700">
                  <i className="fa-solid fa-circle-xmark"></i>
                  <span>Des erreurs sont survenues :</span>
                </div>
                <ul className="list-disc list-inside pl-1 space-y-0.5 font-normal text-red-600/90">
                  {errors.map((err, index) => (
                    <li key={index}>{err}</li>
                  ))}
                </ul>
              </div>
            )}

            <h2 className="text-2xl font-semibold text-slate-900 tracking-tight mb-1">
              Créer votre compte
            </h2>
            <p className="text-slate-500 font-light text-sm mb-8">
              Rejoignez la communauté du campus en quelques secondes.
            </p>

            <form onSubmit={handleSubmit} className="space-y-5">
              <div>
                <label className="block text-xs font-medium text-slate-600 mb-1.5">
                  Nom complet
                </label>
                <div className="relative">
                  <i className="fa-regular fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                  <input
                    type="text"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    required
                    placeholder="Prénom Nom"
                    className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                  />
                </div>
              </div>

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
                    type="password"
                    name="password"
                    value={formData.password}
                    onChange={handleChange}
                    required
                    placeholder="8 caractères minimum"
                    className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-normal placeholder:text-slate-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                  />
                </div>
              </div>

              <label className="flex items-start gap-2 cursor-pointer select-none pt-1">
                <input
                  type="checkbox"
                  name="terms"
                  checked={formData.terms}
                  onChange={handleChange}
                  className="w-3.5 h-3.5 mt-0.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/30"
                />
                <span className="text-xs font-light text-slate-500">
                  J'accepte les{' '}
                  <a href="#" className="text-indigo-600 font-medium">
                    conditions d'utilisation
                  </a>{' '}
                  et la politique de confidentialité.
                </span>
              </label>

              <button
                type="submit"
                disabled={loading}
                className="w-full py-2.5 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-all duration-200 shadow-sm hover:shadow-md disabled:opacity-50"
              >
                {loading ? 'Création du compte...' : 'Créer mon compte'}
              </button>
            </form>

            <p className="text-center text-xs font-light text-slate-500 mt-8">
              Déjà inscrit ?{' '}
              <Link
                to="/login"
                className="text-indigo-600 font-medium hover:text-indigo-700 transition-all duration-200"
              >
                Se connecter
              </Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}