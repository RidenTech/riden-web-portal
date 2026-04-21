import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { ToastProvider } from './components/UI';
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

function App() {
  return (
    <ToastProvider>
      <Router>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/auth/login" element={<Login />} />
          <Route path="/auth/forgot" element={<ForgotPassword />} />

          {/* Admin Protected Routes */}
          <Route path="/drivers" element={<DriverManagement />} />
          <Route path="/drivers/create" element={<DriverCreate />} />
          <Route path="/drivers/detail" element={<DriverDetail />} />
          <Route path="/drivers/requests" element={<DriverRequest />} />

          <Route path="/passenger" element={<PassengerManagement />} />
          <Route path="/passenger/create" element={<PassengerCreate />} />
          <Route path="/passenger/detail" element={<PassengerDetail />} />
          <Route path="/passenger/requests" element={<PassengerRequest />} />

          <Route path="/fare-management" element={<FareManagement />} />
          <Route path="/commission-management" element={<CommissionManagement />} />
          <Route path="/promo-management" element={<PromoManagement />} />
          <Route path="/payout-management" element={<PayoutManagement />} />

          <Route path="/bookings" element={<BookingManagement />} />
          <Route path="/bookings/detail" element={<BookingDetail />} />

          <Route path="/vehicles" element={<VehicleManagement />} />
          <Route path="/vehicles/create" element={<VehicleCreate />} />
          <Route path="/vehicles/edit" element={<VehicleEdit />} />
          <Route path="/vehicles/detail" element={<VehicleDetail />} />
          <Route path="/support" element={<SupportTicket />} />
          <Route path="/support/report" element={<SupportTicket />} />
          <Route path="/report-management" element={<ReportManagement />} />
          <Route path="/analytics" element={<Analytics />} />
          <Route path="/cms-management" element={<CMSManagement />} />
          <Route path="/profile" element={<AdminProfile />} />

          <Route path="/admin-roles" element={<AdminRoles />} />
          <Route path="/admin-roles/create" element={<AdminCreate />} />
          <Route path="/admin-roles/edit" element={<AdminEdit />} />
          <Route path="/admin-roles/detail" element={<AdminDetail />} />
          <Route path="/alerts" element={<ManageNotifications />} />
          <Route path="/reviews" element={<ReviewManagement />} />
        </Routes>
      </Router>
    </ToastProvider>
  );
}

export default App;
