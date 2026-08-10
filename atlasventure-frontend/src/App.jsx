import React from "react";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import ProtectedRoute from "./components/ProtectedRoute";

// Auth Pages
import Login from "./pages/auth/Login";
import Register from "./pages/auth/Register";

// Admin Pages
import DashboardAdmin from "./pages/Admin/DashboardAdmin";
import CreateEvent from "./pages/Admin/CreatEvent";
import ManageEvents from "./pages/Admin/ManageEvnet";

// Student Pages
import StudentDashboard from "./pages/student/DashboardStudent";

export default function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Public Routes */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />

        {/* Protected Admin Routes */}
        <Route element={<ProtectedRoute allowedRoles={["admin"]} />}>
          <Route path="/admin" element={<Navigate to="/admin/dashboard" replace />} />
          <Route path="/admin/dashboard" element={<DashboardAdmin />} />
          <Route path="/admin/events/create" element={<CreateEvent />} />
          <Route path="/admin/events/manage" element={<ManageEvents />} />
        </Route>

        {/* Protected Student Routes */}
        <Route element={<ProtectedRoute allowedRoles={["student"]} />}>
          <Route path="/student/dashboard" element={<StudentDashboard />} />
        </Route>

        {/* Default Catch-all Redirect */}
        <Route path="*" element={<Navigate to="/login" replace />} />
      </Routes>
    </BrowserRouter>
  );
}