import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { ToastProvider } from './components/UI';
import ProtectedRoute from './routes/ProtectedRoute';
import Login from './pages/Auth/Login';
import ForgotPassword from './pages/Auth/ForgotPassword';
import Dashboard from './pages/Admin/Dashboard';
import DriverManagement from './pages/Admin/DriverManagement';
import DriverCreate from './pages/Admin/DriverCreate';
import DriverDetail from './pages/Admin/DriverDetail';
import DriverRequest from './pages/Admin/DriverRequest';
import PassengerManagement from './pages/Admin/PassengerManagement';
import PassengerCreate from './pages/Admin/PassengerCreate';
import PassengerDetail from './pages/Admin/PassengerDetail';
import PassengerRequest from './pages/Admin/PassengerRequest';
import FareManagement from './pages/Admin/FareManagement';
import CommissionManagement from './pages/Admin/CommissionManagement';
import PromoManagement from './pages/Admin/PromoManagement';
import PayoutManagement from './pages/Admin/PayoutManagement';
import BookingManagement from './pages/Admin/BookingManagement';
import BookingDetail from './pages/Admin/BookingDetail';
import BookingCreate from './pages/Admin/BookingCreate';
import VehicleManagement from './pages/Admin/VehicleManagement';
import VehicleCreate from './pages/Admin/VehicleCreate';
import VehicleEdit from './pages/Admin/VehicleEdit';
import VehicleDetail from './pages/Admin/VehicleDetail';
import SupportTicket from './pages/Admin/SupportTicket';
import ReportManagement from './pages/Admin/ReportManagement';
import Analytics from './pages/Admin/Analytics';
import CMSManagement from './pages/Admin/CMSManagement';
import AdminProfile from './pages/Admin/AdminProfile';
import AdminRoles from './pages/Admin/AdminRoles';
import AdminCreate from './pages/Admin/AdminCreate';
import AdminEdit from './pages/Admin/AdminEdit';
import AdminDetail from './pages/Admin/AdminDetail';
import ReviewManagement from './pages/Admin/ReviewManagement';
import ManageNotifications from './pages/Admin/ManageNotifications';
import Unauthorized from './pages/Unauthorized';

function App() {
  return (
    <ToastProvider>
      <Router>
        <Routes>
          {/* Public Routes */}
          <Route path="/auth/login" element={<Login />} />
          <Route path="/auth/forgot" element={<ForgotPassword />} />

          {/* Core Protected Routes */}
          <Route element={<ProtectedRoute />}>
            <Route path="/unauthorized" element={<Unauthorized />} />
            <Route path="/profile" element={<AdminProfile />} />
          </Route>

          {/* Dashboard */}
          <Route element={<ProtectedRoute module="Dashboard" />}>
            <Route path="/" element={<Dashboard />} />
          </Route>

          {/* Analytics */}
          <Route element={<ProtectedRoute module="Analytics/Stats" />}>
            <Route path="/analytics" element={<Analytics />} />
          </Route>

          {/* Admin Roles */}
          <Route element={<ProtectedRoute module="Admin Roles" />}>
            <Route path="/admin-roles" element={<AdminRoles />} />
            <Route path="/admin-roles/create" element={<AdminCreate />} />
            <Route path="/admin-roles/edit" element={<AdminEdit />} />
            <Route path="/admin-roles/detail" element={<AdminDetail />} />
          </Route>

          {/* Drivers */}
          <Route element={<ProtectedRoute module="Driver Management" />}>
            <Route path="/drivers" element={<DriverManagement />} />
            <Route path="/drivers/create" element={<DriverCreate />} />
            <Route path="/drivers/detail/:id" element={<DriverDetail />} />
            <Route path="/drivers/requests" element={<DriverRequest />} />
          </Route>

          {/* Passengers */}
          <Route element={<ProtectedRoute module="Passenger Management" />}>
            <Route path="/passenger" element={<PassengerManagement />} />
            <Route path="/passenger/create" element={<PassengerCreate />} />
            <Route path="/passenger/detail" element={<PassengerDetail />} />
            <Route path="/passenger/requests" element={<PassengerRequest />} />
          </Route>

          {/* Bookings */}
          <Route element={<ProtectedRoute module="Booking Management" />}>
            <Route path="/bookings" element={<BookingManagement />} />
            <Route path="/bookings/create" element={<BookingCreate />} />
            <Route path="/bookings/detail" element={<BookingDetail />} />
          </Route>

          {/* Vehicles */}
          <Route element={<ProtectedRoute module="Vehicles Management" />}>
            <Route path="/vehicles" element={<VehicleManagement />} />
            <Route path="/vehicles/create" element={<VehicleCreate />} />
            <Route path="/vehicles/edit" element={<VehicleEdit />} />
            <Route path="/vehicles/detail/:id" element={<VehicleDetail />} />
          </Route>

          {/* Financials & Promos */}
          <Route element={<ProtectedRoute module="Fare Management" />}>
            <Route path="/fare-management" element={<FareManagement />} />
          </Route>
          <Route element={<ProtectedRoute module="Commission Management" />}>
            <Route path="/commission-management" element={<CommissionManagement />} />
          </Route>
          <Route element={<ProtectedRoute module="Promo code Management" />}>
            <Route path="/promo-management" element={<PromoManagement />} />
          </Route>
          <Route element={<ProtectedRoute module="Payment Management" />}>
            <Route path="/payout-management" element={<PayoutManagement />} />
          </Route>

          {/* Support & Reports */}
          <Route element={<ProtectedRoute module="Support Ticket" />}>
            <Route path="/support" element={<SupportTicket />} />
            <Route path="/support/report" element={<SupportTicket />} />
          </Route>
          <Route element={<ProtectedRoute module="Report Management" />}>
            <Route path="/report-management" element={<ReportManagement />} />
          </Route>

          {/* Others */}
          <Route element={<ProtectedRoute module="Notifications" />}>
            <Route path="/alerts" element={<ManageNotifications />} />
          </Route>
          <Route element={<ProtectedRoute module="CMS management" />}>
            <Route path="/cms-management" element={<CMSManagement />} />
          </Route>
          <Route element={<ProtectedRoute module="Reviews & Ratings" />}>
            <Route path="/reviews" element={<ReviewManagement />} />
          </Route>

        </Routes>
      </Router>
    </ToastProvider >
  );
}

export default App;
