import React from "react";
import { Navigate, Outlet } from "react-router-dom";

export default function ProtectedRoute({ allowedRoles }) {
  const token = localStorage.getItem("token");
  const userRole = localStorage.getItem("user_role")?.toLowerCase()?.trim();

  if (!token) {
    return <Navigate to="/login" replace />;
  }

  if (allowedRoles && !allowedRoles.includes(userRole)) {
    if (userRole === "student") {
      return <Navigate to="/student/dashboard" replace />;
    }
    if (userRole === "admin" || userRole === "bde") {
      return <Navigate to="/admin/dashboard" replace />;
    }
    return <Navigate to="/login" replace />;
  }

  return <Outlet />;
}

export default function AppRoutes() {
  return (
    <Routes>
      <Route
        path="/admin/dashboard"
        element={
          <BdeRoute>
            <DashboardAdmin />
          </BdeRoute>
        }
      />
      <Route
        path="/admin/events/create"
        element={
          <BdeRoute>
            <CreateEvent />
          </BdeRoute>
        }
      />
      <Route
        path="/admin/events/manage"
        element={
          <BdeRoute>
            <ManageEvent />
          </BdeRoute>
        }
      />
    </Routes>
  );
}