import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Badge, Button } from '@/components/UI';

export default function DriverDetail() {
    const [activeTab, setActiveTab] = useState('personal');

    const driver = {
        name: 'Alex Johnson',
        email: 'alex.j@example.com',
        phone: '+1 234 567 890',
        gender: 'Male',
        unique_id: 'RID-DRIV-8821',
        status: 'Active',
        registered: 'Mar 15, 2024',
        rating: 4.8,
        total_rides: 124,
        revenue: '$12,450'
    };

    return (
        <AdminLayout title="Driver Profile">
            <div className="max-w-5xl mx-auto">
                {/* Profile Header */}
                <div className="flex flex-wrap items-center justify-between bg-white p-6 rounded-[20px] shadow-sm border border-[#E5E7EB] mb-6 gap-6">
                    <div className="flex items-center gap-5">
                        <Link to="/drivers" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="w-20 h-20 rounded-full border-4 border-[#D10000]/10 overflow-hidden shadow-sm">
                            <img src={`https://ui-avatars.com/api/?name=${driver.name}&background=random`} className="w-full h-full object-cover" alt="" />
                        </div>
                        <div>
                            <h4 className="text-2xl font-black text-gray-900 tracking-tight">{driver.name}</h4>
                            <div className="flex items-center gap-3 mt-1.5">
                                <div className="flex gap-0.5 text-[#FBBF24]">
                                    {[1, 2, 3, 4].map(s => <i key={s} className="bi bi-star-fill text-[13px]"></i>)}
                                    <i className="bi bi-star-fill text-[13px] opacity-30"></i>
                                </div>
                                <span className="text-sm font-bold text-gray-700 italic">4.8</span>
                                <Badge variant="active">{driver.status}</Badge>
                            </div>
                        </div>
                    </div>
                    <div className="text-[12px] font-bold text-gray-400 uppercase tracking-widest">
                        Registered: {driver.registered}
                    </div>
                </div>

                {/* Stats Banner */}
                <div className="grid grid-cols-1 md:grid-cols-3 bg-white p-8 rounded-[25px] shadow-sm border border-[#E5E7EB] mb-6 relative overflow-hidden">
                    <div className="absolute top-0 right-0 w-32 h-32 bg-[#D10000]/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>

                    {[
                        { label: 'Total Rides', value: driver.total_rides, icon: 'bi bi-truck', color: '#3B82F6' },
                        { label: 'Completed', value: '118', icon: 'bi bi-check-circle-fill', color: '#10B981' },
                        { label: 'Total Revenue', value: driver.revenue, icon: 'bi bi-currency-dollar', color: '#D10000' },
                    ].map((stat, i) => (
                        <div key={i} className={`flex flex-col items-center justify-center gap-3 ${i < 2 ? 'md:border-r border-gray-100' : ''}`}>
                            <div className="w-12 h-12 rounded-[14px] bg-gray-50 flex items-center justify-center text-gray-400 relative group transition-all duration-300">
                                <div className="absolute inset-0 bg-gray-100 rounded-[14px] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <i className={`${stat.icon} text-xl relative`}></i>
                            </div>
                            <div className="text-center">
                                <label className="block text-[10px] uppercase tracking-[0.2em] font-black text-gray-400 mb-1">{stat.label}</label>
                                <div className="text-2xl font-black text-gray-900 tracking-tight">{stat.value}</div>
                            </div>
                        </div>
                    ))}
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    {/* Navigation Sidebar */}
                    <div className="lg:col-span-4">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] p-2 overflow-hidden mb-6">
                            {[
                                { id: 'personal', label: 'Personal Information', icon: 'bi bi-person-fill' },
                                { id: 'vehicle', label: 'Vehicle Information', icon: 'bi bi-truck' },
                                { id: 'documents', label: 'Stored Documents', icon: 'bi bi-file-earmark-text-fill' },
                                { id: 'rides', label: 'Recent Rides', icon: 'bi bi-map-fill' },
                            ].map((tab) => (
                                <button
                                    key={tab.id}
                                    onClick={() => setActiveTab(tab.id)}
                                    className={`w-full flex items-center gap-3 py-3.5 px-5 rounded-xl text-sm font-bold transition-all duration-400 ${activeTab === tab.id
                                        ? 'bg-[#D10000] text-white shadow-xl shadow-red-100/50 translate-x-1'
                                        : 'text-gray-500 hover:bg-gray-50 hover:text-[#D10000]'
                                        }`}
                                >
                                    <div className={`w-8 h-8 rounded-lg flex items-center justify-center ${activeTab === tab.id ? 'bg-white/20' : 'bg-gray-100'}`}>
                                        <i className={tab.icon}></i>
                                    </div>
                                    {tab.label}
                                </button>
                            ))}
                        </div>

                        {/* Action Buttons */}
                        <div className="space-y-3">
                            <Button className="w-full py-4 rounded-xl flex items-center justify-center gap-2 group">
                                <i className="bi bi-slash-circle-fill group-hover:rotate-45 transition-transform"></i> Block Driver
                            </Button>
                            <Button variant="outline" className="w-full py-4 rounded-xl flex items-center justify-center gap-2 border-red-100 text-[#D10000] hover:bg-red-50">
                                <i className="bi bi-trash-fill"></i> Delete Driver
                            </Button>
                        </div>
                    </div>

                    {/* Content Area */}
                    <div className="lg:col-span-8">
                        <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] overflow-hidden min-h-[450px]">
                            <div className="bg-[#D10000] px-8 py-4 flex items-center justify-between">
                                <div className="flex items-center gap-3">
                                    <i className="text-white text-lg bi bi-collection-fill"></i>
                                    <h5 className="text-white font-black text-base uppercase tracking-wider">
                                        {activeTab === 'personal' ? 'Personal Details' : activeTab === 'vehicle' ? 'Vehicle Specs' : activeTab === 'documents' ? 'Compliance Docs' : 'Ride Logs'}
                                    </h5>
                                </div>
                            </div>

                            <div className="p-10">
                                {activeTab === 'personal' && (
                                    <div className="grid grid-cols-2 gap-y-10 gap-x-8">
                                        {[
                                            { label: 'Full Name', value: driver.name },
                                            { label: 'Email Address', value: driver.email },
                                            { label: 'Phone Number', value: driver.phone },
                                            { label: 'Gender', value: driver.gender },
                                            { label: 'Unique ID', value: driver.unique_id, isRed: true },
                                        ].map((info, i) => (
                                            <div key={i} className="group">
                                                <label className="block text-[11px] uppercase tracking-[0.2em] font-black text-gray-400 mb-2 group-hover:text-[#D10000] transition-colors">{info.label}</label>
                                                <p className={`text-base font-bold ${info.isRed ? 'text-[#D10000]' : 'text-gray-900'} tracking-tight`}>{info.value}</p>
                                            </div>
                                        ))}
                                    </div>
                                )}

                                {activeTab === 'vehicle' && (
                                    <div className="grid grid-cols-2 gap-y-10 gap-x-8">
                                        {[
                                            { label: 'Model', value: 'Suzuki Alto' },
                                            { label: 'Year', value: '2023' },
                                            { label: 'Color', value: 'Metalic Black' },
                                            { label: 'License Plate', value: 'BKG-220' },
                                            { label: 'Vehicle Type', value: 'Sedan' },
                                        ].map((info, i) => (
                                            <div key={i}>
                                                <label className="block text-[11px] uppercase tracking-[0.2em] font-black text-gray-400 mb-2">{info.label}</label>
                                                <p className="text-base font-bold text-gray-900 tracking-tight">{info.value}</p>
                                            </div>
                                        ))}
                                    </div>
                                )}

                                {activeTab === 'documents' && (
                                    <div className="grid grid-cols-1 gap-4">
                                        {[
                                            { name: 'Driving License', status: 'Verified', date: 'Mar 10, 2024' },
                                            { name: 'National ID', status: 'Verified', date: 'Mar 10, 2024' },
                                            { name: 'Vehicle Registration', status: 'Pending Review', date: 'Mar 15, 2024', isWarning: true },
                                        ].map((doc, i) => (
                                            <div key={i} className="flex items-center justify-between p-5 bg-[#F9FAFB] border border-[#E5E7EB] rounded-[20px] hover:border-[#D10000]/30 transition-all group">
                                                <div className="flex items-center gap-4">
                                                    <div className="w-12 h-12 rounded-2xl bg-white border border-[#E5E7EB] flex items-center justify-center text-[#D10000]">
                                                        <i className="bi bi-file-earmark-medical-fill text-xl"></i>
                                                    </div>
                                                    <div>
                                                        <h6 className="text-sm font-bold text-gray-900 mb-1">{doc.name}</h6>
                                                        <div className="flex items-center gap-2">
                                                            <span className={`text-[10px] font-bold uppercase ${doc.isWarning ? 'text-amber-600' : 'text-[#10B981]'}`}>{doc.status}</span>
                                                            <span className="text-[10px] text-gray-400">• {doc.date}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button className="px-5 py-2.5 bg-white text-gray-900 border border-[#E5E7EB] rounded-xl text-xs font-bold hover:bg-gray-900 hover:text-white transition-all shadow-sm">
                                                    View File
                                                </button>
                                            </div>
                                        ))}
                                    </div>
                                )}

                                {activeTab === 'rides' && (
                                    <div className="py-16 flex flex-col items-center justify-center text-center">
                                        <div className="w-40 h-40 bg-gray-50 rounded-full flex items-center justify-center mb-6 opacity-30">
                                            <i className="bi bi-car-front-fill text-6xl text-gray-300"></i>
                                        </div>
                                        <h6 className="text-base font-bold text-gray-900 mb-1">No Activity Yet</h6>
                                        <p className="text-sm font-medium text-gray-400">All ride logs for this driver will appear here.</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
