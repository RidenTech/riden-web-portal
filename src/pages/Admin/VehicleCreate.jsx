import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link, useNavigate } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button, useToast } from '@/components/UI';

export default function VehicleCreate() {
    const { showToast } = useToast();
    const navigate = useNavigate();

    const handleSave = () => {
        showToast("New vehicle has been registered successfully", "success");
        navigate('/vehicles');
    };

    return (
        <AdminLayout title="Vehicle Management">
            <div className="mx-auto mb-4">
                <div className="bg-white p-8 rounded-[30px] shadow-sm border border-[#E5E7EB]">
                    {/* Header Title */}
                    <div className="mb-4 flex items-center gap-2 pb-6">
                        <Link to="/vehicles" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 leading-tight">Add New Vehicle</h1>
                            <p className="text-sm text-gray-500 font-medium">Fill in the specifications of the new vehicle</p>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        {/* Section 1: Vehicle Identification */}
                        <div className="space-y-6">
                            <div className="flex items-center gap-2 mb-4">
                                <div className="w-[3px] h-5 bg-[#D10000] rounded-full"></div>
                                <h2 className="text-[17px] font-black text-gray-900 uppercase">Vehicle Identification</h2>
                            </div>

                            <div className="space-y-4">
                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Assign Driver</Label>
                                    <InputWrapper className="bg-white">
                                        <Select className="text-gray-400 font-medium">
                                            <option value="" disabled selected>Select a Driver</option>
                                            <option>Sergio Morsis</option>
                                            <option>Ralph Edwards</option>
                                        </Select>
                                        <i className="bi bi-chevron-down text-gray-300"></i>
                                    </InputWrapper>
                                </div>

                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Car Model Name</Label>
                                    <InputWrapper className="bg-white">
                                        <Input placeholder="e.g. Toyota Corolla" className="font-medium" />
                                    </InputWrapper>
                                </div>

                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Plate No</Label>
                                    <InputWrapper className="bg-white">
                                        <Input placeholder="e.g. ABC-123" className="font-medium" />
                                    </InputWrapper>
                                </div>
                            </div>
                        </div>

                        {/* Section 2: Vehicle Specifications */}
                        <div className="space-y-6">
                            <div className="flex items-center gap-2 mb-4">
                                <div className="w-[3px] h-5 bg-[#D10000] rounded-full"></div>
                                <h2 className="text-[17px] font-black text-gray-900 uppercase">Vehicle Specifications</h2>
                            </div>

                            <div className="space-y-4">
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Year</Label>
                                        <InputWrapper className="bg-white">
                                            <Input placeholder="2023" className="font-medium" />
                                        </InputWrapper>
                                    </div>
                                    <div>
                                        <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Color</Label>
                                        <InputWrapper className="bg-white">
                                            <Input placeholder="White" className="font-medium" />
                                        </InputWrapper>
                                    </div>
                                </div>

                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Category</Label>
                                    <InputWrapper className="bg-white">
                                        <Select className="text-gray-500 font-medium">
                                            <option>Sedan</option>
                                            <option>Premium</option>
                                            <option>SUV</option>
                                        </Select>
                                        <i className="bi bi-chevron-down text-gray-300"></i>
                                    </InputWrapper>
                                </div>

                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Number of Seats</Label>
                                    <InputWrapper className="bg-white">
                                        <Input placeholder="4" className="font-medium" />
                                    </InputWrapper>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Section 3: Vehicle Media */}
                    <div className="space-y-6 border-t border-gray-100 pt-8">
                        <div className="flex items-center gap-2 mb-4">
                            <div className="w-[3px] h-5 bg-[#D10000] rounded-full"></div>
                            <h2 className="text-[17px] font-black text-gray-900 uppercase">Vehicle Media</h2>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <Label className="text-[14px] font-[700] text-gray-400 mb-2 normal-case tracking-normal">Front View Image</Label>
                                <div className="relative border-2 border-dashed border-gray-100 rounded-xl p-8 flex flex-col items-center justify-center bg-gray-50/30 mb-3">
                                    <i className="bi bi-camera text-2xl text-gray-300"></i>
                                </div>
                                <div className="flex items-center border border-gray-200 rounded-lg overflow-hidden h-11">
                                    <button className="h-full px-4 bg-gray-100 text-[13px] font-bold text-gray-600 border-r border-gray-200 hover:bg-gray-200 transition-colors uppercase font-outfit">Choose file</button>
                                    <span className="px-4 text-[13px] text-gray-400 font-medium">No file chosen</span>
                                </div>
                            </div>

                            <div>
                                <Label className="text-[14px] font-[700] text-gray-400 mb-2 normal-case tracking-normal">Back View Image</Label>
                                <div className="relative border-2 border-dashed border-gray-100 rounded-xl p-8 flex flex-col items-center justify-center bg-gray-50/30 mb-3">
                                    <i className="bi bi-camera text-2xl text-gray-300"></i>
                                </div>
                                <div className="flex items-center border border-gray-200 rounded-lg overflow-hidden h-11">
                                    <button className="h-full px-4 bg-gray-100 text-[13px] font-bold text-gray-600 border-r border-gray-200 hover:bg-gray-200 transition-colors uppercase font-outfit">Choose file</button>
                                    <span className="px-4 text-[13px] text-gray-400 font-medium">No file chosen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="mt-4 flex justify-end pt-4">
                        <button
                            onClick={handleSave}
                            className="bg-[#D10000] hover:bg-[#b00000] text-white text-sm font-semibold px-12 py-3 rounded-xl transition-all shadow-[0_4px_14px_0_rgba(209,0,0,0.39)] flex items-center gap-2"
                        >
                            Save Vehicle
                        </button>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
