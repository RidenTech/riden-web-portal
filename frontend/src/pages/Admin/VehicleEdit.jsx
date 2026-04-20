import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Label, InputWrapper, Select, Button } from '@/components/UI';

export default function VehicleEdit() {
    // Mock data for the vehicle being edited
    const vehicle = {
        name: 'Suzuki Alto',
        registration: 'BKG-220',
        color: 'Black',
        type: 'Standard',
        driver: 'Theresa Webb'
    };

    return (
        <AdminLayout title="Edit Vehicle">
            <div className="max-w-4xl mx-auto">
                <div className="flex items-center gap-4 mb-8">
                    <Link to="/vehicles" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                        <i className="bi bi-chevron-left text-sm"></i>
                    </Link>
                    <h2 className="text-xl font-bold text-gray-900 tracking-tight">Edit Vehicle: {vehicle.name}</h2>
                </div>

                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] p-10">
                    <div className="text-[14px] font-black italic text-[#D10000] uppercase tracking-widest mb-8 flex items-center gap-2">
                        <div className="w-2 h-2 bg-[#D10000] rounded-sm rotate-45"></div>
                        Vehicle Details
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <Label>Vehicle Model</Label>
                            <InputWrapper icon="bi bi-car-front">
                                <input className="w-full bg-transparent outline-none text-[14px] font-[600]" defaultValue={vehicle.name} />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Registration Number</Label>
                            <InputWrapper icon="bi bi-card-text">
                                <input className="w-full bg-transparent outline-none text-[14px] font-[600]" defaultValue={vehicle.registration} />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Vehicle Color</Label>
                            <InputWrapper icon="bi bi-palette">
                                <input className="w-full bg-transparent outline-none text-[14px] font-[600]" defaultValue={vehicle.color} />
                            </InputWrapper>
                        </div>
                        <div>
                            <Label>Vehicle Type</Label>
                            <InputWrapper icon="bi bi-truck">
                                <Select defaultValue={vehicle.type}>
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
                                <Select defaultValue={vehicle.driver}>
                                    <option>Theresa Webb</option>
                                    <option>Ralph Edwards</option>
                                    <option>Dianne Russell</option>
                                </Select>
                            </InputWrapper>
                        </div>
                    </div>

                    <div className="mt-12 text-[14px] font-black italic text-[#D10000] uppercase tracking-widest mb-8 flex items-center gap-2">
                        <div className="w-2 h-2 bg-[#D10000] rounded-sm rotate-45"></div>
                        Update Vehicle Media
                    </div>

                    <div className="relative group rounded-[25px] overflow-hidden border border-gray-100 shadow-sm mb-6">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=800" className="w-full h-64 object-cover" />
                        <div className="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button className="px-6 py-3 bg-white text-gray-900 rounded-xl text-xs font-black uppercase tracking-widest italic shadow-xl">
                                Replace Image
                            </button>
                        </div>
                    </div>

                    <div className="flex justify-end gap-3 mt-12 pt-8 border-t border-gray-100">
                        <Button className="px-14 py-4 italic font-black uppercase tracking-widest shadow-xl shadow-red-100">Save Changes</Button>
                        <Link to="/vehicles">
                            <Button variant="outline" className="px-14 py-4 italic font-black uppercase tracking-widest text-gray-500 border-gray-200 hover:bg-gray-50">Discard</Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
