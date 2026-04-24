import React, { useState, useEffect } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Button, Badge } from '@/components/UI';
import { getAdminProfile } from '../../api/auth'

export default function AdminProfile() {
    const [admin, setAdmin] = useState(null);
    const modules = [
        'Dashboard', 'Reviews & Ratings', 'Passenger Management',
        'Analytics/Stats', 'Promo Code Management', 'Advertising Management'
    ];
    useEffect(() => {
        const fetchProfile = async () => {
            try {
                const res = await getAdminProfile();
                setAdmin(res.data);
            }
            catch (error) {
                console.log("Error fetching profile", error);

            }
        }
        fetchProfile();
    }, [])
    return (
        <AdminLayout title="Profile">
            <div className="bg-white rounded-[30px] shadow-riden border border-[#E5E7EB] overflow-hidden">
                {/* Header Section */}
                <div className="p-10 pb-0 flex items-center gap-6 mb-12">
                    <button className="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 text-[#111] hover:bg-gray-50 transition-colors">
                        <i className="bi bi-chevron-left"></i>
                    </button>
                    <div className="relative">
                        <img src="https://i.pravatar.cc/100?img=5" className="w-[80px] h-[80px] rounded-full border-4 border-white shadow-xl" alt="Admin" />
                        <div className="absolute top-1 left-1 w-4 h-4 bg-[#10B981] border-2 border-white rounded-full"></div>
                    </div>
                    <div className="flex-1">
                        <h2 className="text-2xl font-[800] text-gray-900">{admin?.name || 'Loading...'}</h2>
                        <span className="text-[14px] font-[800] text-[#D10000]">{admin?.role || 'Admininistrator'}</span>
                    </div>

                </div>

                <div className="px-10 pb-10">
                    {/* Personal Details */}
                    <div className="mb-12">
                        <h3 className="text-[11px] font-[800] text-gray-400 uppercase tracking-widest mb-6 border-b border-[#f1f1f1] pb-4">Personal Details</h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div className="flex items-center gap-4 p-5 bg-[#fdfdfd] border border-gray-100 rounded-[20px] shadow-sm">
                                <div className="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#D10000] text-xl shadow-sm border border-gray-50">
                                    <i className="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <p className="text-[10px] font-[800] text-gray-400 uppercase tracking-wider mb-0">Email</p>
                                    <p className="text-sm font-[800] text-gray-900">{admin?.email || 'Loading...'}</p>
                                </div>
                            </div>
                            <div className="flex items-center gap-4 p-5 bg-[#fdfdfd] border border-gray-100 rounded-[20px] shadow-sm">
                                <div className="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#D10000] text-xl shadow-sm border border-gray-50">
                                    <i className="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <p className="text-[10px] font-[800] text-gray-400 uppercase tracking-wider mb-0">Phone Number</p>
                                    <p className="text-sm font-[800] text-gray-900">{admin?.phone || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Access Modules */}
                    <div className="mb-12">
                        <h3 className="text-[11px] font-[800] text-gray-400 uppercase tracking-widest mb-6 border-b border-[#f1f1f1] pb-4">Access Modules</h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {modules.map((m, i) => (
                                <div key={i} className="flex items-center gap-3 p-4 bg-white border border-gray-100 rounded-[15px] hover:bg-gray-50 transition-colors shadow-sm">
                                    <i className="bi bi-check-circle-fill text-[#10B981]"></i>
                                    <span className="text-[14px] font-[800] text-gray-700">{m}</span>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Password Section */}
                    <div className="mb-12">
                        <h3 className="text-[11px] font-[800] text-gray-400 uppercase tracking-widest mb-6 border-b border-[#f1f1f1] pb-4">Password</h3>
                        <div className="p-5 bg-[#fdfdfd] border border-gray-100 rounded-[20px] flex justify-between items-center shadow-sm">
                            <div className="flex items-center gap-4">
                                <div className="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#D10000] text-xl shadow-sm border border-gray-50">
                                    <i className="bi bi-lock"></i>
                                </div>
                                <div>
                                    <p className="text-[10px] font-[800] text-gray-400 uppercase tracking-wider mb-0">Password</p>
                                    <div className="flex items-center gap-2">
                                        <span className="text-sm font-[800] text-gray-900"></span>
                                        <i className="bi bi-eye text-gray-400 cursor-pointer hover:text-gray-900 transition-colors"></i>
                                    </div>
                                </div>
                            </div>
                            <p className="text-[11px] text-gray-400 font-medium">Last Updated on 24 Dec, 2024</p>
                        </div>
                    </div>

                    <div className="flex justify-end">
                        <Button className="px-12 py-3">
                            Update Password
                        </Button>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
