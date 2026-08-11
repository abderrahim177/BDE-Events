import React from "react";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import RoleBasedLayout from "./components/RoleBasedLayout";

// Pages
import Login from "./pages/auth/Login";
import Register from "./pages/auth/Register";
import DashboardAdmin from "./pages/Admin/DashboardAdmin";
import CreateEvent from "./pages/Admin/CreatEvent";
import ManageEvents from "./pages/Admin/ManageEvnet";
import StudentDashboard from "./pages/student/DashboardStudent";
import Unauthorized from "./Components/Unauthorized"; 

export default function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Public Routes */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/unauthorized" element={<Unauthorized />} />

        {/* 🔴 ADMIN ROUTES */}
        <Route element={<RoleBasedLayout requiredRole="admin" />}>
          <Route path="/admin" element={<Navigate to="/admin/dashboard" replace />} />
          <Route path="/admin/dashboard" element={<DashboardAdmin />} />
          <Route path="/admin/events/create" element={<CreateEvent />} />
          <Route path="/admin/events/manage" element={<ManageEvents />} />
        </Route>

        {/* 🟢 STUDENT ROUTES */}
        <Route element={<RoleBasedLayout requiredRole="student" />}>
          <Route path="/student/dashboard" element={<StudentDashboard />} />

        </Route>

        {/* Catch-all for non-existing URLs */}
        <Route path="*" element={<Navigate to="/unauthorized" replace />} />
      </Routes>
    </BrowserRouter>
  );
}