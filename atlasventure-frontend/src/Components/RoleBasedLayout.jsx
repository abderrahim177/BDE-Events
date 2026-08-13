// src/components/RoleBasedLayout.jsx
import React from "react";
import { Navigate, Outlet, useLocation } from "react-router-dom";
import { ROLE_ALLOWED_ROUTES } from "../config/roleRoutes";
import useAutoLogout from "../Components/useAutoLogout";
export default function RoleBasedLayout({ requiredRole }) {
  const location = useLocation();
  const token = sessionStorage.getItem("token");
  const userRole = sessionStorage.getItem("user_role")?.toLowerCase()?.trim();
  useAutoLogout(15);
  if (!token) {
    return <Navigate to="/login" replace />;
  }
  if (userRole !== requiredRole) {
    return <Navigate to="/unauthorized" replace />;
  }
  const allowedPaths = ROLE_ALLOWED_ROUTES[userRole] || [];
  const currentPath = location.pathname;
  const isPathAllowed = allowedPaths.some((path) => currentPath.startsWith(path));
  if (!isPathAllowed) {
    return <Navigate to="/unauthorized" replace />;
  }
  return <Outlet />;
}