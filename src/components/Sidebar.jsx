import React from 'react';
import { Link, useLocation, useNavigate } from 'react-router-dom';

export default function Sidebar({ isCollapsed, setIsCollapsed }) {
    const location = useLocation();
    const navigate = useNavigate();
    const url = location.pathname;

    const handleLogout = () => {
        localStorage.removeItem('token');
        navigate('/auth/login');
    };

    const menuItems = [
        { label: 'Dashboard', icon: 'bi bi-house-door', href: '/', permission: 'Dashboard' },
        { label: 'Analytics/Stats', icon: 'bi bi-bar-chart', href: '/analytics', permission: 'Analytics/Stats' },
        { label: 'Admin Roles', icon: 'bi bi-person', href: '/admin-roles', permission: 'Admin Roles' },
        { label: 'Driver Management', icon: 'bi bi-person-badge', href: '/drivers', permission: 'Driver Management' },
        { label: 'Passenger Management', icon: 'bi bi-people', href: '/passenger', permission: 'Passenger Management' },
        { label: 'Booking Management', icon: 'bi bi-calendar-check', href: '/bookings', permission: 'Booking Management' },
        { label: 'Vehicle Management', icon: 'bi bi-truck', href: '/vehicles', permission: 'Vehicles Management' },
        { label: 'Reviews & Ratings', icon: 'bi bi-star', href: '/reviews', permission: 'Reviews & Ratings' },
        { label: 'Promo code Management', icon: 'bi bi-tag', href: '/promo-management', permission: 'Promo code Management' },
        { label: 'Fare Management', icon: 'bi bi-cash-coin', href: '/fare-management', permission: 'Fare Management' },
        { label: 'Commission Management', icon: 'bi bi-percent', href: '/commission-management', permission: 'Commission Management' },
        { label: 'Payments', icon: 'bi bi-credit-card', href: '/payout-management', permission: 'Payment Management' },
        { label: 'Support Ticket', icon: 'bi bi-life-preserver', href: '/support', permission: 'Support Ticket' },
        { label: 'Manage Notifications', icon: 'bi bi-bell', href: '/alerts', permission: 'Notifications' },
        { label: 'CMS Management', icon: 'bi bi-window', href: '/cms-management', permission: 'CMS management' },
    ];

    return (
        <aside className={`fixed left-0 top-0 bottom-0 bg-[#D10000] text-white z-[1030] overflow-x-hidden flex flex-col transition-all duration-300 ${isCollapsed ? 'w-[60px]' : 'w-[260px]'}`}>
            <div className="h-full flex flex-col overflow-hidden relative w-full">
                {/* Header with Toggle Button */}
                <div className="relative flex items-center min-h-[72px] px-6">
                    <button
                        onClick={() => setIsCollapsed(!isCollapsed)}
                        className={`absolute ${isCollapsed ? 'left-1/2 -translate-x-1/2' : 'right-4'} top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-lg transition-all z-[110]`}
                        title={isCollapsed ? "Expand Sidebar" : "Collapse Sidebar"}
                    >
                        <i className="bi bi-list text-xl text-white"></i>
                    </button>

                    <div className={`transition-all duration-300 ${isCollapsed ? 'opacity-0 scale-50 overflow-hidden w-0' : 'opacity-100 scale-100'}`}>
                        <Link to="/" className="flex items-center font-['Audiowide'] text-[24px] tracking-wider text-white hover:text-white no-underline">
                            <span>RIDEN</span>
                        </Link>
                    </div>
                </div>

                <nav className="flex-1 flex flex-col gap-2 overflow-y-auto overflow-x-hidden px-0 riden-scrollbar pt-4">
                    {menuItems.map((item, index) => {
                        const isActive = item.href !== '#' && (url === item.href || url.startsWith(item.href + '/'));
                        return (
                            <Link
                                key={index}
                                to={item.href}
                                className={`flex items-center gap-2 py-4 px-3 rounded-r-full text-[13.5px] font-[700] transition-all duration-300 relative group overflow-hidden ${isActive
                                    ? 'bg-white text-[#D10000]'
                                    : 'text-white/90 hover:bg-white/10'
                                    }`}
                                title={isCollapsed ? item.label : ''}
                            >
                                <i className={`${item.icon} text-lg w-[24px] text-center shrink-0`} aria-hidden="true"></i>
                                {!isCollapsed && (
                                    <span className="whitespace-nowrap">
                                        {item.label}
                                    </span>
                                )}
                            </Link>
                        );
                    })}
                </nav>

                <div className="mt-auto p-2 border-t border-white/10">
                    <button
                        onClick={handleLogout}
                        className={`w-full flex items-center gap-4  py-2 px-3 rounded-full bg-white text-[#D10000] font-[800] text-[14px] transition-all duration-300 ${isCollapsed ? 'justify-center' : 'hover:bg-white/10'}`}
                        title="Logout"
                    >
                        <i className="bi bi-box-arrow-right text-lg w-[24px] text-center shrink-0" aria-hidden="true"></i>
                        {!isCollapsed && <span>Logout</span>}
                    </button>
                </div>
            </div>
        </aside>
    );
}
