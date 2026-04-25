import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input, Button } from '@/components/UI';

export default function AdminEdit() {
    const modules = [
        'Dashboard', 'Analytics/Stats', 'User Management', 'Driver Management',
        'Vehicles Management', 'Booking Management', 'Reviews & Ratings',
        'Promo code Management', 'Fare Management', 'Commission Management',
        'Payment Management', 'Report Management', 'Passenger Management',
        'Advertising Management', 'Support Ticket', 'Notifications',
        'CMS management', 'Settings'
    ];

    // Mock data for the admin role being edited
    const admin = {
        name: 'Esther Howard',
        email: 'esther.h@example.com',
        phone: '123456789',
        activeModules: ['Dashboard', 'Reviews & Ratings', 'Passenger Management', 'Analytics/Stats', 'Promo code Management']
    };

    return (
        <AdminLayout title="User Management">
            <div className="mx-auto">
                <div className="flex items-center gap-4 mb-4">
                    <Link to="/users" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                        <i className="bi bi-chevron-left text-sm"></i>
                    </Link>
                    <h2 className="text-xl font-bold text-gray-900 tracking-tight">Edit Admin

                    </h2>
                </div>

                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] p-6">
                    <div className="bg-[#d10000]  rounded-full  p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">

                        Update Admin Credentials
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                        <div>
                            <Label>Full Name</Label>
                            <InputWrapper icon="bi bi-person">
                                <Input defaultValue={admin.name} />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Email Address</Label>
                            <InputWrapper icon="bi bi-envelope">
                                <Input type="email" defaultValue={admin.email} />
                            </InputWrapper>
                        </div>

                        <div>
                            <Label>Phone Number</Label>
                            <InputWrapper className="flex items-center gap-4">
                                <div className="flex items-center gap-2 py-1">
                                    <img src="https://flagcdn.com/w40/ca.png" alt="CA" className="w-5" />
                                    <span className="text-[14px] font-bold text-gray-900">+1</span>
                                </div>
                                <div className="flex-grow">
                                    <Input placeholder="000 000 0000" />
                                </div>
                            </InputWrapper></div>
                        <div className="px-4 mt-4">
                            <label className="flex items-center gap-3 cursor-pointer group p-3 bg-gray-50 rounded-lg">
                                <div className="relative flex items-center">
                                    <input
                                        type="checkbox"
                                        name="is_super"

                                        className="peer w-5 h-5 border-2 border-gray-300 rounded-md checked:bg-[#D10000] checked:border-[#D10000] appearance-none transition-all cursor-pointer"
                                    />
                                    <i className="bi bi-check absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                                </div>
                                <div>
                                    <span className="text-[14px] font-semibold text-gray-700">Super Admin</span>
                                    <p className="text-xs text-gray-500 mt-0.5">Has access to all modules and permissions</p>
                                </div>
                            </label>
                        </div>

                    </div>

                    <div className="bg-[#d10000] mt-4  rounded-full  p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                        Access Module Permissions
                    </div>
                    <div className="grid grid-cols-2 md:grid-cols-3 gap-y-6 gap-x-6 px-4">
                        {modules.map((m, i) => (
                            <label key={i} className="flex items-center gap-3 cursor-pointer group">
                                <div className="relative flex items-center">
                                    <input
                                        type="checkbox"
                                        defaultChecked={admin.activeModules.includes(m)}
                                        className="peer w-6 h-6 border-2 border-gray-200 rounded-lg checked:bg-[#D10000] checked:border-[#D10000] appearance-none transition-all cursor-pointer shadow-sm"
                                    />
                                    <i className="bi bi-check-lg absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                                </div>
                                <span className="text-[13px] font-black text-gray-700 group-hover:text-black transition-colors uppercase tracking-tighter italic">{m}</span>
                            </label>
                        ))}
                    </div>

                    <div className="bg-[#d10000] mt-4 rounded-full  p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                        Administrative Security
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8 px-4">
                        <div>
                            <Label>Reset Password</Label>
                            <InputWrapper icon="bi bi-lock">
                                <Input type="password" placeholder="••••••••" />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Confirm Password</Label>
                            <InputWrapper icon="bi bi-shield-lock">
                                <Input type="password" placeholder="••••••••" />
                            </InputWrapper>
                        </div>
                    </div>

                    <div className="flex justify-end gap-3 mt-8">
                        <Button className="px-14 py-4 shadow-xl shadow-red-100  font-black uppercase tracking-widest">Update Admin</Button>
                        <Link to="/users">
                            <Button variant="outline" className="px-14 py-4 border-gray-200 text-gray-500 hover:bg-gray-50  font-black uppercase tracking-widest">Cancel</Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AdminLayout >
    );
}
