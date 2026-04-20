import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button } from '@/components/UI';

export default function DriverCreate() {
    const [activeTab, setActiveTab] = useState('personal');

    return (
        <AdminLayout title="Add New Driver">
            <div className="max-w-5xl mx-auto">
                {/* Profile Header */}
                <div className="flex items-center justify-between bg-white p-6 rounded-[20px] shadow-sm border border-[#E5E7EB] mb-6">
                    <div className="flex items-center gap-4">
                        <Link to="/drivers" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="w-16 h-16 rounded-full bg-red-50 border-4 border-red-100 flex items-center justify-center text-[#D10000]">
                            <i className="bi bi-person-plus-fill text-2xl"></i>
                        </div>
                        <div>
                            <h4 className="text-xl font-bold text-gray-900">Add New Driver</h4>
                            <p className="text-sm text-gray-500 font-medium">Fill in the details to register a new driver</p>
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
                                { id: 'vehicle', label: 'Vehicle Information', icon: 'bi bi-truck' },
                                { id: 'documents', label: 'Driver Documents', icon: 'bi bi-file-earmark-text-fill' },
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
                            <Button className="w-full py-4 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-red-100">
                                <i className="bi bi-check-circle-fill"></i> Complete Registration
                            </Button>
                            <Link to="/drivers" className="block">
                                <Button variant="outline" className="w-full py-4 rounded-xl flex items-center justify-center gap-2 border-red-100 text-[#D10000] hover:bg-red-50">
                                    Cancel and Return
                                </Button>
                            </Link>
                        </div>
                    </div>

                    {/* Form Content */}
                    <div className="lg:col-span-8">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] overflow-hidden min-h-[500px]">
                            <div className="bg-[#D10000] px-6 py-4 flex items-center gap-3">
                                <i className={`text-white text-lg ${activeTab === 'personal' ? 'bi bi-person-fill' : activeTab === 'vehicle' ? 'bi bi-truck' : 'bi bi-file-earmark-text-fill'}`}></i>
                                <h5 className="text-white font-bold text-base">
                                    {activeTab === 'personal' ? 'Personal Details' : activeTab === 'vehicle' ? 'Vehicle Specifications' : 'Upload Required Documents'}
                                </h5>
                            </div>

                            <div className="p-8">
                                {activeTab === 'personal' && (
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
                                )}

                                {activeTab === 'vehicle' && (
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <Label>Vehicle Model</Label>
                                            <InputWrapper icon="bi bi-truck">
                                                <Input placeholder="e.g. Toyota Camry" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Vehicle Year</Label>
                                            <InputWrapper icon="bi bi-calendar-event">
                                                <Input placeholder="e.g. 2023" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Vehicle Color</Label>
                                            <InputWrapper icon="bi bi-palette">
                                                <Input placeholder="e.g. Metallic Black" />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>License Plate</Label>
                                            <InputWrapper icon="bi bi-card-text">
                                                <Input placeholder="e.g. ABC-1234" />
                                            </InputWrapper>
                                        </div>
                                        <div className="md:col-span-2">
                                            <Label>Vehicle Type</Label>
                                            <InputWrapper icon="bi bi-truck">
                                                <Select>
                                                    <option value="Sedan">Sedan</option>
                                                    <option value="SUV">SUV</option>
                                                    <option value="Luxury">Luxury</option>
                                                    <option value="Bike">Bike</option>
                                                </Select>
                                            </InputWrapper>
                                        </div>
                                    </div>
                                )}

                                {activeTab === 'documents' && (
                                    <div className="space-y-6">
                                        {[
                                            { name: 'Driving License', placeholder: 'Upload driving license' },
                                            { name: 'ID Card (Front)', placeholder: 'Upload ID card front' },
                                            { name: 'Vehicle Insurance', placeholder: 'Upload insurance document' },
                                        ].map((doc, i) => (
                                            <div key={i} className="group p-5 bg-white border-2 border-dashed border-gray-200 rounded-2xl hover:border-[#D10000] hover:bg-red-50/30 transition-all duration-300">
                                                <div className="flex flex-wrap items-center justify-between gap-4">
                                                    <div className="flex items-center gap-4">
                                                        <div className="w-12 h-12 rounded-xl bg-gray-100 group-hover:bg-[#D10000]/10 flex items-center justify-center text-gray-400 group-hover:text-[#D10000] transition-colors">
                                                            <i className="bi bi-file-earmark-text text-xl"></i>
                                                        </div>
                                                        <div>
                                                            <h6 className="text-[14px] font-bold text-gray-900">{doc.name}</h6>
                                                            <p className="text-[11px] text-gray-500 font-medium">Required for activation</p>
                                                        </div>
                                                    </div>
                                                    <input type="file" className="hidden" id={`doc-${i}`} />
                                                    <label htmlFor={`doc-${i}`} className="px-5 py-2.5 bg-gray-900 text-white rounded-xl text-xs font-bold cursor-pointer hover:bg-black transition-colors">
                                                        Upload File
                                                    </label>
                                                </div>
                                            </div>
                                        ))}
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
