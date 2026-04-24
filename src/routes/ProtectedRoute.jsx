import { Navigate, Outlet } from 'react-router-dom';

export default function ProtectedRoute({ module }) {
    const token = localStorage.getItem('token');
    const adminStr = localStorage.getItem('admin');
    const admin = adminStr ? JSON.parse(adminStr) : null;

    if (!token) {
        return <Navigate to='/auth/login' replace />;
    }

    if (module && admin) {
        const hasPermission = admin.is_super || (admin.modules && admin.modules.includes(module));
        if (!hasPermission) {
            return <Navigate to='/unauthorized' replace />;
        }
    }

    return <Outlet />;
}