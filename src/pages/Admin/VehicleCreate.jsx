import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button } from '@/components/UI';

export default function VehicleCreate() {
    return (
        <AdminLayout title="Add New Vehicle">
            <div className="max-w-4xl mx-auto">
                <div className="flex items-center gap-4 mb-8">
                    <Link to="/vehicles" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                        <i className="bi bi-chevron-left text-sm"></i>
                    </Link>
                    <h2 className="text-xl font-bold text-gray-900 tracking-tight">Add New Vehicle</h2>
                </div>

                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] p-10">
                    <div className="text-[14px] font-black italic text-[#D10000] uppercase tracking-widest mb-8 flex items-center gap-2">
                        <div className="w-2 h-2 bg-[#D10000] rounded-sm rotate-45"></div>
                        Vehicle Information
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <Label>Vehicle Model</Label>
                            <InputWrapper icon="bi bi-car-front">
                                <input className="w-full bg-transparent outline-none text-[14px] font-[600]" placeholder="Example: Suzuki Alto" />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Registration Number</Label>
                            <InputWrapper icon="bi bi-card-text">
                                <input className="w-full bg-transparent outline-none text-[14px] font-[600]" placeholder="Example: BKG-220" />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Vehicle Color</Label>
                            <InputWrapper icon="bi bi-palette">
                                <input className="w-full bg-transparent outline-none text-[14px] font-[600]" placeholder="Example: Metallic Black" />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Vehicle Type</Label>
                            <InputWrapper icon="bi bi-truck">
                                <Select>
                                    <option>Standard</option>
                                    <option>Premium</option>
                                    <option>Van</option>
                                    <option>SUV</option>
                                </Select>
                            </InputWrapper>
                        </div>
                        <div className="md:col-span-2">
                            <Label>Assign Driver</Label>
                            <InputWrapper icon="bi bi-person">
                                <Select>
                                    <option disabled selected>Select Driver</option>
                                    <option>Theresa Webb</option>
                                    <option>Ralph Edwards</option>
                                    <option>Dianne Russell</option>
                                </Select>
                            </InputWrapper>
                        </div>
                    </div>

                    <div className="mt-12 text-[14px] font-black italic text-[#D10000] uppercase tracking-widest mb-8 flex items-center gap-2">
                        <div className="w-2 h-2 bg-[#D10000] rounded-sm rotate-45"></div>
                        Vehicle Media
                    </div>

                    <div className="p-12 border-2 border-dashed border-gray-100 rounded-[25px] flex flex-col items-center justify-center text-center group hover:border-[#D10000]/30 transition-all cursor-pointer">
                        <div className="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i className="bi bi-cloud-arrow-up text-3xl text-gray-300 group-hover:text-[#D10000]"></i>
                        </div>
                        <h6 className="text-[14px] font-black uppercase text-gray-900 mb-1">Upload Vehicle Image</h6>
                        <p className="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Supports JPG, PNG, WEBP (Max 5MB)</p>
                    </div>

                    <div className="flex justify-end gap-3 mt-12 pt-8 border-t border-gray-100">
                        <Button className="px-14 py-4 italic font-black uppercase tracking-widest shadow-xl shadow-red-100">Add Vehicle</Button>
                        <Link to="/vehicles">
                            <Button variant="outline" className="px-14 py-4 italic font-black uppercase tracking-widest text-gray-500 border-gray-200 hover:bg-gray-50">Cancel</Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
