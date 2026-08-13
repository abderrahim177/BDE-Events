// src/hooks/useAutoLogout.js
import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

export default function useAutoLogout(timeoutInMinutes = 15) {
  const navigate = useNavigate();

  useEffect(() => {
    let timer;

    const logoutUser = () => {
      sessionStorage.clear();
      navigate('/login', { 
        replace: true, 
        state: { message: "Votre session a expiré en raison d'inactivité." } 
      });
    };

    const resetTimer = () => {
      if (timer) clearTimeout(timer);
      timer = setTimeout(logoutUser, timeoutInMinutes * 60 * 1000);
    };

    const events = ['mousemove', 'keydown', 'click', 'scroll', 'touchstart'];

    events.forEach((event) => window.addEventListener(event, resetTimer));

    resetTimer();

    return () => {
      if (timer) clearTimeout(timer);
      events.forEach((event) => window.removeEventListener(event, resetTimer));
    };
  }, [navigate, timeoutInMinutes]);
}