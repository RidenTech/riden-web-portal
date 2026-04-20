import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Badge, Button } from '@/components/UI';

export default function VehicleDetail() {
    const vehicle = {
        name: 'Suzuki Alto',
        registration: 'BKG-220',
        color: 'Metallic Black',
        type: 'Standard',
        driver: 'Theresa Webb',
        status: 'Active',
        image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=800',
        registered_on: 'Oct 12, 2023',
        total_rides: 456,
        fuel_type: 'Petrol'
    };

    return (
        <AdminLayout title="Vehicle Details">
            <div className="max-w-5xl mx-auto">
                <div className="flex items-center justify-between mb-8">
                    <div className="flex items-center gap-4">
                        <Link to="/vehicles" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors bg-white">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <h2 className="text-2xl font-black text-gray-900 tracking-tight uppercase italic">{vehicle.name} ({vehicle.registration})</h2>
                    </div>
                    <Badge variant="active">{vehicle.status}</Badge>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    {/* Left: Media & Stats */}
                    <div className="lg:col-span-12">
                        <div className="bg-white rounded-[35px] border border-[#E5E7EB] overflow-hidden shadow-sm flex flex-col md:flex-row">
                            <div className="md:w-1/2 h-80 md:h-auto relative">
                                <img src={vehicle.image} className="w-full h-full object-cover" />
                                <div className="absolute inset-0 bg-gradient-to-r from-transparent to-white/10"></div>
                            </div>
                            <div className="md:w-1/2 p-10 flex flex-col justify-between">
                                <div>
                                    <label className="block text-[10px] uppercase tracking-[0.2em] font-black text-[#D10000] mb-4">Core Specifications</label>
                                    <div className="grid grid-cols-2 gap-y-10">
                                        {[
                                            { label: 'Manufacturer', value: 'Suzuki' },
                                            { label: 'Year', value: '2023' },
                                            { label: 'Type', value: vehicle.type },
                                            { label: 'Fuel', value: vehicle.fuel_type },
                                            { label: 'Color', value: vehicle.color },
                                            { label: 'Plates', value: vehicle.registration },
                                        ].map((item, i) => (
                                            <div key={i}>
                                                <p className="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">{item.label}</p>
                                                <p className="text-[15px] font-black text-gray-900 uppercase italic tracking-tighter">{item.value}</p>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                                <div className="pt-10 mt-10 border-t border-gray-50 flex items-center justify-between">
                                    <div className="flex items-center gap-3">
                                        <div className="w-12 h-12 rounded-2xl bg-[#FFF1F2] flex items-center justify-center text-[#D10000] text-xl">
                                            <i className="bi bi-person-badge-fill"></i>
                                        </div>
                                        <div>
                                            <p className="text-[10px] text-gray-400 font-black uppercase tracking-widest">Driver Assigned</p>
                                            <p className="text-[14px] font-black text-gray-900">{vehicle.driver}</p>
                                        </div>
                                    </div>
                                    <div className="text-right">
                                        <p className="text-[10px] text-gray-400 font-black uppercase tracking-widest">Total Rides</p>
                                        <p className="text-[20px] font-black text-[#D10000] italic">{vehicle.total_rides}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Bottom Actions */}
                    <div className="lg:col-span-12 flex justify-end gap-3 mt-4">
                        <Link to="/vehicles/edit">
                            <Button className="px-12 py-3.5 italic font-black uppercase tracking-widest shadow-xl shadow-red-100">
                                <i className="bi bi-pencil-square mr-2"></i> Edit Heritage
                            </Button>
                        </Link>
                        <Button variant="outline" className="px-12 py-3.5 italic font-black uppercase tracking-widest text-red-600 border-red-100 hover:bg-red-50">
                            Decommission
                        </Button>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
