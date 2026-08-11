// src/config/roleRoutes.js

export const ROLE_ALLOWED_ROUTES = {
  admin: [
    "/admin/dashboard",
    "/admin/events/create",
    "/admin/events/manage",
  ],
  student: [
    "/student/dashboard",
    "/student/events",
    "/student/tickets",
  ],
};

export const DEFAULT_ROLE_REDIRECT = {
  admin: "/admin/dashboard",
  student: "/student/dashboard",
};