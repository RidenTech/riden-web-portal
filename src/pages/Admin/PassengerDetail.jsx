import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Badge, Button } from '@/components/UI';

export default function PassengerDetail() {
    const [activeTab, setActiveTab] = useState('personal');

    const passenger = {
        id: 1,
        first_name: 'John',
        last_name: 'Doe',
        email: 'john.doe@example.com',
        phone: '+1 234 567 890',
        gender: 'Male',
        unique_id: 'RID-PASS-10023',
        status: 'Active',
        created_at: '2024-03-10',
        avatar: null
    };

    const stats = [
        { label: 'Total Rides', value: '0', icon: 'bi bi-truck' },
        { label: 'Completed', value: '0', icon: 'bi bi-check-circle-fill' },
        { label: 'Cancelled', value: '0', icon: 'bi bi-slash-circle-fill' },
    ];

    return (
        <AdminLayout title="Passenger Profile">
            <div className="max-w-5xl mx-auto">
                {/* Profile Header */}
                <div className="flex items-center justify-between bg-white p-6 rounded-[20px] shadow-sm border border-[#E5E7EB] mb-6">
                    <div className="flex items-center gap-4">
                        <Link to="/passenger" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="w-20 h-20 rounded-full border-4 border-[#D10000]/10 overflow-hidden">
                            <img src={`https://ui-avatars.com/api/?name=${passenger.first_name}+${passenger.last_name}&background=random`} className="w-full h-full object-cover" alt="" />
                        </div>
                        <div>
                            <h4 className="text-2xl font-bold text-gray-900">{passenger.first_name} {passenger.last_name}</h4>
                            <div className="flex items-center gap-3 mt-1">
                                <div className="flex gap-1 text-warning">
                                    {[1, 2, 3, 4].map(s => <i key={s} className="bi bi-star-fill"></i>)}
                                    <i className="bi bi-star-fill opacity-30"></i>
                                </div>
                                <span className="text-sm font-semibold text-gray-700">(4.5)</span>
                                <Badge variant="success">{passenger.status}</Badge>
                            </div>
                        </div>
                    </div>
                    <div className="text-sm font-semibold text-gray-400">
                        Registered: {new Date(passenger.created_at).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })}
                    </div>
                </div>

                {/* Stats Banner */}
                <div className="grid grid-cols-3 bg-white p-6 rounded-[20px] shadow-sm border border-[#E5E7EB] mb-6 divide-x divide-gray-100">
                    {stats.map((stat, i) => (
                        <div key={i} className="flex flex-col items-center justify-center gap-2">
                            <div className="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                                <i className={stat.icon}></i>
                            </div>
                            <div className="text-center">
                                <label className="block text-[10px] uppercase tracking-wider font-bold text-gray-400">{stat.label}</label>
                                <div className="text-xl font-bold text-gray-900">{stat.value}</div>
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
                                { id: 'rides', label: 'All Rides', icon: 'bi bi-truck' },
                                { id: 'payment', label: 'Payment Methods', icon: 'bi bi-credit-card-fill' },
                            ].map((tab) => (
                                <button
                                    key={tab.id}
                                    onClick={() => setActiveTab(tab.id)}
                                    className={`w-full flex items-center gap-3 py-3 px-4 rounded-xl text-sm font-semibold transition-all duration-300 ${activeTab === tab.id
                                        ? 'bg-[#D10000] text-white shadow-lg shadow-red-100'
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
                            <Button className="w-full py-4 rounded-xl flex items-center justify-center gap-2">
                                <i className="bi bi-slash-circle-fill"></i> Block Passenger
                            </Button>
                            <Button variant="outline" className="w-full py-4 rounded-xl flex items-center justify-center gap-2 border-red-100 text-[#D10000] hover:bg-red-50">
                                <i className="bi bi-trash-fill"></i> Delete Passenger
                            </Button>
                        </div>
                    </div>

                    {/* Content Area */}
                    <div className="lg:col-span-8">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] overflow-hidden">
                            <div className="bg-[#D10000] px-6 py-4 flex items-center justify-between">
                                <div className="flex items-center gap-3">
                                    <i className="text-white text-lg bi bi-person-fill"></i>
                                    <h5 className="text-white font-bold text-base">
                                        {activeTab === 'personal' ? 'Personal Details' : activeTab === 'rides' ? 'Recent Ride History' : 'Payment Methods'}
                                    </h5>
                                </div>
                                {activeTab === 'personal' && (
                                    <button className="text-white/80 hover:text-white text-xs font-bold uppercase tracking-wider">
                                        <i className="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                )}
                            </div>

                            <div className="p-8">
                                {activeTab === 'personal' && (
                                    <div className="grid grid-cols-2 gap-y-8 gap-x-6">
                                        {[
                                            { label: 'Full Name', value: `${passenger.first_name} ${passenger.last_name}` },
                                            { label: 'Email Address', value: passenger.email },
                                            { label: 'Phone Number', value: passenger.phone },
                                            { label: 'Gender', value: passenger.gender },
                                            { label: 'Unique ID', value: passenger.unique_id, isRed: true },
                                        ].map((info, i) => (
                                            <div key={i}>
                                                <label className="block text-[11px] uppercase tracking-wider font-bold text-gray-400 mb-1">{info.label}</label>
                                                <p className={`text-base font-semibold ${info.isRed ? 'text-[#D10000]' : 'text-gray-900'}`}>{info.value}</p>
                                            </div>
                                        ))}
                                    </div>
                                )}

                                {activeTab === 'rides' && (
                                    <div className="py-12 flex flex-col items-center justify-center text-center">
                                        <div className="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mb-4 opacity-40">
                                            <i className="bi bi-car-front-fill text-5xl text-gray-300"></i>
                                        </div>
                                        <p className="text-sm font-medium text-gray-400">No ride data available yet.</p>
                                    </div>
                                )}

                                {activeTab === 'payment' && (
                                    <div className="space-y-8">
                                        <div>
                                            <h6 className="text-[13px] font-bold text-[#D10000] uppercase tracking-wider mb-6">Primary Methods</h6>
                                            <div className="space-y-4">
                                                <div className="flex items-center justify-between py-4 border-b border-gray-50">
                                                    <div className="flex items-center gap-4">
                                                        <div className="w-10 text-center"><img src="https://img.icons8.com/color/48/visa.png" className="w-8 mx-auto" /></div>
                                                        <span className="text-sm font-bold text-gray-900">Visa</span>
                                                    </div>
                                                    <span className="text-sm font-medium text-gray-400">********234</span>
                                                </div>
                                                <div className="flex items-center justify-between py-4">
                                                    <div className="flex items-center gap-4">
                                                        <div className="w-10 text-center"><img src="https://img.icons8.com/color/48/apple-pay.png" className="w-8 mx-auto" /></div>
                                                        <span className="text-sm font-bold text-gray-900">Apple Pay</span>
                                                    </div>
                                                    <span className="text-sm font-medium text-gray-400">********234</span>
                                                </div>
                                            </div>
                                        </div>
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
