import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button } from '@/components/UI';

export default function DriverEdit() {
    const [activeTab, setActiveTab] = useState('personal');

    // Mock data for the driver being edited
    const driver = {
        firstName: 'Alex',
        lastName: 'Johnson',
        email: 'alex.j@example.com',
        phone: '+1 234 567 890',
        gender: 'Male',
        vehicleModel: 'Suzuki Alto',
        vehicleYear: '2023',
        vehicleColor: 'Metallic Black',
        licensePlate: 'BKG-220',
        vehicleType: 'Sedan'
    };

    return (
        <AdminLayout title="Edit Driver">
            <div className="max-w-5xl mx-auto">
                {/* Profile Header */}
                <div className="flex items-center justify-between bg-white p-6 rounded-[20px] shadow-sm border border-[#E5E7EB] mb-6">
                    <div className="flex items-center gap-4">
                        <Link to="/drivers" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="w-16 h-16 rounded-full border-4 border-[#D10000]/10 overflow-hidden shadow-sm">
                            <img src={`https://ui-avatars.com/api/?name=${driver.firstName}+${driver.lastName}&background=random`} className="w-full h-full object-cover" alt="" />
                        </div>
                        <div>
                            <h4 className="text-xl font-bold text-gray-900">Edit Driver: {driver.firstName} {driver.lastName}</h4>
                            <p className="text-sm text-gray-500 font-medium">Update driver credentials and vehicle information</p>
                        </div>
                    </div>
                    <div className="text-sm font-semibold text-gray-400">
                        Last Updated: {new Date().toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })}
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    {/* Navigation Sidebar */}
                    <div className="lg:col-span-4">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] p-2 overflow-hidden mb-6">
                            {[
                                { id: 'personal', label: 'Personal Information', icon: 'bi bi-person-fill' },
                                { id: 'vehicle', label: 'Vehicle Information', icon: 'bi bi-truck' },
                                { id: 'documents', label: 'Stored Documents', icon: 'bi bi-file-earmark-text-fill' },
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
                            <Button className="w-full py-4 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-red-100 italic font-black">
                                <i className="bi bi-save-fill uppercase"></i> Save Changes
                            </Button>
                            <Link to="/drivers" className="block">
                                <Button variant="outline" className="w-full py-4 rounded-xl flex items-center justify-center gap-2 border-red-100 text-[#D10000] hover:bg-red-50 italic font-black">
                                    Discard Changes
                                </Button>
                            </Link>
                        </div>
                    </div>

                    {/* Form Content */}
                    <div className="lg:col-span-8">
                        <div className="bg-white rounded-[20px] shadow-sm border border-[#E5E7EB] overflow-hidden min-h-[500px]">
                            <div className="bg-[#D10000] px-6 py-4 flex items-center gap-3">
                                <i className={`text-white text-lg ${activeTab === 'personal' ? 'bi bi-person-fill' : activeTab === 'vehicle' ? 'bi bi-truck' : 'bi bi-file-earmark-text-fill'}`}></i>
                                <h5 className="text-white font-bold text-base uppercase italic tracking-widest">
                                    {activeTab === 'personal' ? 'Update Personal Details' : activeTab === 'vehicle' ? 'Modify Vehicle Specs' : 'Review Documents'}
                                </h5>
                            </div>

                            <div className="p-8">
                                {activeTab === 'personal' && (
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div className="md:col-span-2">
                                            <Label>Profile Image</Label>
                                            <div className="flex items-center gap-4">
                                                <div className="w-16 h-16 rounded-xl border border-gray-100 overflow-hidden">
                                                    <img src={`https://ui-avatars.com/api/?name=${driver.firstName}+${driver.lastName}&background=random`} className="w-full h-full object-cover" />
                                                </div>
                                                <InputWrapper icon="bi bi-image" className="flex-1" style={{ borderStyle: 'dashed' }}>
                                                    <Input type="file" accept="image/*" />
                                                </InputWrapper>
                                            </div>
                                        </div>
                                        <div>
                                            <Label>First Name</Label>
                                            <InputWrapper icon="bi bi-person">
                                                <Input defaultValue={driver.firstName} />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Last Name</Label>
                                            <InputWrapper icon="bi bi-person">
                                                <Input defaultValue={driver.lastName} />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Email Address</Label>
                                            <InputWrapper icon="bi bi-envelope">
                                                <Input type="email" defaultValue={driver.email} />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Phone Number</Label>
                                            <InputWrapper icon="bi bi-telephone">
                                                <Input defaultValue={driver.phone} />
                                            </InputWrapper>
                                        </div>
                                        <div className="md:col-span-2">
                                            <Label>Gender</Label>
                                            <InputWrapper icon="bi bi-gender-ambiguous">
                                                <Select defaultValue={driver.gender}>
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
                                                <Input defaultValue={driver.vehicleModel} />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Vehicle Year</Label>
                                            <InputWrapper icon="bi bi-calendar-event">
                                                <Input defaultValue={driver.vehicleYear} />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>Vehicle Color</Label>
                                            <InputWrapper icon="bi bi-palette">
                                                <Input defaultValue={driver.vehicleColor} />
                                            </InputWrapper>
                                        </div>
                                        <div>
                                            <Label>License Plate</Label>
                                            <InputWrapper icon="bi bi-card-text">
                                                <Input defaultValue={driver.licensePlate} />
                                            </InputWrapper>
                                        </div>
                                        <div className="md:col-span-2">
                                            <Label>Vehicle Type</Label>
                                            <InputWrapper icon="bi bi-truck">
                                                <Select defaultValue={driver.vehicleType}>
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
                                    <div className="space-y-4">
                                        {[
                                            { name: 'Driving License', status: 'Verified', color: 'text-green-600' },
                                            { name: 'National ID Card', status: 'Pending Review', color: 'text-amber-600' },
                                            { name: 'Insurance Document', status: 'Verified', color: 'text-green-600' },
                                        ].map((doc, i) => (
                                            <div key={i} className="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-xl group hover:border-[#D10000]/20 transition-all">
                                                <div className="flex items-center gap-4">
                                                    <div className="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-[#D10000] border border-gray-100 shadow-sm">
                                                        <i className="bi bi-file-earmark-medical-fill"></i>
                                                    </div>
                                                    <div>
                                                        <h6 className="text-[13px] font-bold text-gray-900 leading-tight mb-0.5">{doc.name}</h6>
                                                        <span className={`text-[10px] font-black uppercase tracking-widest ${doc.color}`}>{doc.status}</span>
                                                    </div>
                                                </div>
                                                <div className="flex gap-2">
                                                    <button className="px-4 py-2 bg-white text-gray-700 border border-gray-100 rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-gray-50 flex items-center gap-2">
                                                        <i className="bi bi-eye"></i> View
                                                    </button>
                                                    <button className="px-4 py-2 bg-[#D10000] text-white rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-black flex items-center gap-2">
                                                        <i className="bi bi-pencil"></i> Update
                                                    </button>
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
