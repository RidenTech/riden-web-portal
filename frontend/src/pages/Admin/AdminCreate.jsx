import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input, Button } from '@/components/UI';

export default function AdminCreate() {
    const modules = [
        'Dashboard', 'Analytics/Stats', 'Admin Roles', 'Driver Management',
        'Vehicles Management', 'Booking Management', 'Reviews & Ratings',
        'Promo code Management', 'Fare Management', 'Commission Management',
        'Payment Management', 'Report Management', 'Passenger Management',
        'Advertising Management', 'Support Ticket', 'Notifications',
        'CMS management', 'Settings'
    ];

    return (
        <AdminLayout title="Admin Roles">
            <div className="mx-auto">
                <div className="riden-addadmin-head flex items-center gap-4 mb-4">
                    <Link to="/admin-roles" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                        <i className="bi bi-chevron-left text-sm"></i>
                    </Link>
                    <h2 className="text-xl font-bold text-gray-900 tracking-tight">Add New Admin</h2>
                </div>

                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] p-6">
                    <div className=" bg-[#d10000]  rounded-full  p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">

                        Admin Details
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                        <div>
                            <Label>Name</Label>
                            <InputWrapper icon="bi bi-person">
                                <Input placeholder="Enter Admin Name" />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Email</Label>
                            <InputWrapper icon="bi bi-envelope">
                                <Input type="email" placeholder="Enter email address" />
                            </InputWrapper>
                        </div>
                        <div className="md:col-span-1">
                            <Label>Phone Number</Label>
                            <InputWrapper className="flex items-center gap-4">
                                <div className="flex items-center gap-2 py-1">
                                    <img src="https://flagcdn.com/w40/ca.png" alt="CA" className="w-5" />
                                    <span className="text-[14px] font-bold text-gray-900">+1</span>
                                </div>
                                <div className="flex-grow">
                                    <Input placeholder="000 000 0000" />
                                </div>
                            </InputWrapper>
                        </div>
                    </div>

                    <div className="bg-[#d10000] mt-4 rounded-full  p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">

                        Access Module
                    </div>
                    <div className="grid grid-cols-2 md:grid-cols-3 gap-y-5 gap-x-4 px-4">
                        {modules.map((m, i) => (
                            <label key={i} className="flex items-center gap-3 cursor-pointer group">
                                <div className="relative flex items-center">
                                    <input type="checkbox" className="peer w-5 h-5 border-2 border-gray-200 rounded-md checked:bg-[#D10000] checked:border-[#D10000] appearance-none transition-all cursor-pointer" />
                                    <i className="bi bi-check absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                                </div>
                                <span className="text-[14px] font-semibold text-gray-600 group-hover:text-gray-900 transition-colors uppercase tracking-tight">{m}</span>
                            </label>
                        ))}
                    </div>

                    <div className="bg-[#d10000] mt-4  rounded-full  p-4 text-[14px] font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">

                        Make Password
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <Label>Password</Label>
                            <InputWrapper icon="bi bi-lock">
                                <Input type="password" placeholder="Make Password" />
                                <i className="bi bi-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"></i>
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Confirm Password</Label>
                            <InputWrapper icon="bi bi-shield-lock">
                                <Input type="password" placeholder="Confirm Password" />
                                <i className="bi bi-eye-slash absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"></i>
                            </InputWrapper>
                        </div>
                    </div>

                    <div className="flex justify-end gap-3 mt-8  border-t border-gray-100">
                        <Button className="px-12 py-3 shadow-lg shadow-red-100  font-black">Invite</Button>
                        <Link to="/admin-roles">
                            <Button variant="outline" className="px-12 py-3 border-gray-200 text-gray-700 hover:bg-gray-50  font-black">Cancel</Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
