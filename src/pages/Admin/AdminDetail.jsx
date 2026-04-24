import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input } from '@/components/UI';

export default function AdminDetail() {
    const modules = [
        'Dashboard', 'Analytics/Stats', 'Admin Roles', 'Driver Management',
        'Vehicles Management', 'Booking Management', 'Reviews & Ratings',
        'Promo code Management', 'Fare Management', 'Commission Management',
        'Payment Management', 'Report Management', 'Passenger Management',
        'Advertising Management', 'Support Ticket', 'Notifications',
        'CMS management', 'Settings'
    ];

    // Dummy data for frontend check
    const admin = {
        name: 'Jerome Bell',
        email: 'jeromebell445@gmail.com',
        phone: '123 456 7890',
        country_code: '+1',
        is_super: false,
        assigned_modules: [
            'Dashboard', 'Reviews & Ratings', 'Passenger Management',
            'Analytics/Stats', 'Promo code Management', 'Advertising Management'
        ]
    };

    return (
        <AdminLayout title="Admin Roles">
            <div className="mx-auto">
                <div className="riden-addadmin-head flex items-center gap-4 mb-4">
                    <Link to="/admin-roles" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                        <i className="bi bi-chevron-left text-sm"></i>
                    </Link>
                    <h2 className="text-xl font-bold text-gray-900 tracking-tight">Admin Profile Details</h2>
                </div>

                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] p-6">
                    {/* Admin Details Section */}
                    <div className="bg-[#d10000] rounded-full p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                        Admin Details
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 mb-8">
                        <div>
                            <Label className="text-gray-500 font-bold">Name</Label>
                            <InputWrapper icon="bi bi-person" className="bg-gray-50 border-transparent">
                                <div className="py-2.5 px-1 text-sm font-bold text-gray-900">{admin.name}</div>
                            </InputWrapper>
                        </div>

                        <div>
                            <Label className="text-gray-500 font-bold">Email</Label>
                            <InputWrapper icon="bi bi-envelope" className="bg-gray-50 border-transparent">
                                <div className="py-2.5 px-1 text-sm font-bold text-gray-900">{admin.email}</div>
                            </InputWrapper>
                        </div>

                        <div>
                            <Label className="text-gray-500 font-bold">Phone Number</Label>
                            <InputWrapper className="flex items-center gap-4 bg-gray-50 border-transparent">
                                <div className="flex items-center gap-2 py-1">
                                    <img src="https://flagcdn.com/w40/ca.png" alt="CA" className="w-5" />
                                    <span className="text-[14px] font-bold text-gray-900">{admin.country_code}</span>
                                </div>
                                <div className="flex-grow py-2.5 text-sm font-bold text-gray-900">
                                    {admin.phone}
                                </div>
                            </InputWrapper>
                        </div>

                        <div className="mt-4">
                            <Label className="text-gray-500 font-bold mb-2">Role Status</Label>
                            <div className="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div className={`w-5 h-5 rounded-md border-2 flex items-center justify-center ${admin.is_super ? 'bg-[#D10000] border-[#D10000]' : 'bg-white border-gray-300'}`}>
                                    {admin.is_super && <i className="bi bi-check text-white text-xs"></i>}
                                </div>
                                <div>
                                    <span className="text-[14px] font-bold text-gray-900">Super Admin</span>
                                    <p className="text-xs text-gray-500">{admin.is_super ? 'Has full system access' : 'Restricted access based on modules'}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Access Module Section */}
                    <div className="bg-[#d10000] mt-4 rounded-full p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                        Assigned Access Modules
                    </div>

                    <div className="grid grid-cols-2 md:grid-cols-3 gap-y-5 gap-x-4 px-4 mb-4">
                        {modules.map((module, i) => {
                            const isAssigned = admin.assigned_modules.includes(module);
                            return (
                                <div key={i} className="flex items-center gap-3 group opacity-90">
                                    <div className={`w-5 h-5 border-2 rounded-md flex items-center justify-center transition-all ${isAssigned ? 'bg-[#D10000] border-[#D10000]' : 'bg-gray-100 border-gray-200'}`}>
                                        {isAssigned && <i className="bi bi-check text-white text-xs"></i>}
                                    </div>
                                    <span className={`text-[13px] font-bold uppercase tracking-tight ${isAssigned ? 'text-gray-900' : 'text-gray-400'}`}>
                                        {module}
                                    </span>
                                </div>
                            );
                        })}
                    </div>

                    {!admin.is_super && admin.assigned_modules.length === 0 && (
                        <p className="text-yellow-600 text-xs mt-2 px-4 italic">
                            <i className="bi bi-info-circle mr-1"></i>
                            No permissions have been granted to this admin profile.
                        </p>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}
