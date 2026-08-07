import { useState } from 'react'
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import './index.css'
import StudentDashboard from './pages/student/DashboardStudent';
import Register from './pages/auth/Register';
import Login from './pages/auth/Login';
function App() {
 

  return (
    <>
     <BrowserRouter>
      <Routes>
        <Route path="/student" element={<StudentDashboard />} />
        <Route path='/login' element = {<Login />} />
        <Route path='/register' element = {<Register />} />
      </Routes>
    </BrowserRouter>
    </>
  )
}

export default App
