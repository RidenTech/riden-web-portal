import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button } from '@/components/UI';

export default function PassengerCreate() {
    const [activeTab, setActiveTab] = useState('personal');

    return (
        <AdminLayout title="Add New Passenger">
            <div className="max-w-5xl mx-auto">
                {/* Profile Header */}
                <div className="flex items-center justify-between bg-white p-6 rounded-[20px] shadow-sm border border-[#E5E7EB] mb-6">
                    <div className="flex items-center gap-4">
                        <Link to="/passenger" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="w-16 h-16 rounded-full bg-red-50 border-4 border-red-100 flex items-center justify-center text-[#D10000]">
                            <i className="bi bi-person-plus-fill text-2xl"></i>
                        </div>
                        <div>
                            <h4 className="text-xl font-bold text-gray-900">Add New Passenger</h4>
                            <p className="text-sm text-gray-500 font-medium">Fill in the details to register a new passenger</p>
                        </div>
                    </div>
                    <div className="text-sm font-semibold text-gray-400">
                        {new Date().toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })}
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    {/* Navigation Sidebar */}
                    <div className="lg:col-span-4">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] p-2 overflow-hidden mb-6">
                            {[
                                { id: 'personal', label: 'Personal Information', icon: 'bi bi-person-fill' },
                                { id: 'security', label: 'Account Security', icon: 'bi bi-shield-lock-fill' },
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
                                <i className="bi bi-check-circle-fill"></i> Complete Registration
                            </Button>
                            <Link to="/passenger" className="block">
                                <Button variant="outline" className="w-full py-4 rounded-xl flex items-center justify-center gap-2 border-red-100 text-[#D10000] hover:bg-red-50">
                                    Cancel and Return
                                </Button>
                            </Link>
                        </div>
                    </div>

                    {/* Form Content */}
                    <div className="lg:col-span-8">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] overflow-hidden">
                            <div className="bg-[#D10000] px-6 py-4 flex items-center gap-3">
                                <i className={`text-white text-lg ${activeTab === 'personal' ? 'bi bi-person-fill' : 'bi bi-shield-lock-fill'}`}></i>
                                <h5 className="text-white font-bold text-base">
                                    {activeTab === 'personal' ? 'Personal Details' : 'Account Security'}
                                </h5>
                            </div>

                            <div className="p-8">
                                {activeTab === 'personal' ? (
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div className="md:col-span-2">
                                            <Label>Profile Image</Label>
                                            <InputWrapper icon="bi bi-image" style={{ borderStyle: 'dashed' }}>
                                                <Input type="file" accept="image/*" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>First Name</Label>
                                            <InputWrapper icon="bi bi-person">
                                                <Input placeholder="e.g. John" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Last Name</Label>
                                            <InputWrapper icon="bi bi-person">
                                                <Input placeholder="e.g. Doe" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Email Address</Label>
                                            <InputWrapper icon="bi bi-envelope">
                                                <Input type="email" placeholder="john.doe@example.com" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Phone Number</Label>
                                            <InputWrapper icon="bi bi-telephone">
                                                <Input placeholder="+1 234 567 890" />
                                            </InputWrapper>
                                        </div>
                                        <div className="md:col-span-2">
                                            <Label>Gender</Label>
                                            <InputWrapper icon="bi bi-gender-ambiguous">
                                                <Select>
                                                    <option value="" disabled selected>Select gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </Select>
                                            </InputWrapper>
                                        </div>
                                    </div>
                                ) : (
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <Label>Password</Label>
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
                                        <div className="md:col-span-2">
                                            <div className="bg-blue-50/50 p-4 rounded-xl flex items-start gap-3 border border-blue-50">
                                                <i className="bi bi-info-circle-fill text-blue-500 mt-0.5"></i>
                                                <p className="text-xs text-gray-500 font-medium">
                                                    Password must be at least 8 characters long and include confirmation.
                                                </p>
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
