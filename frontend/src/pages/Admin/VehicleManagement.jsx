import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Badge, Button, SearchBar, Pagination } from '@/components/UI';

export default function VehicleManagement() {
    const vehicles = [
        { id: '1', name: 'Suzuki Alto', registration: 'BKG-220', color: 'Black', type: 'Standard', driver: 'Theresa Webb', status: 'Active', image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=300' },
        { id: '2', name: 'Honda Civic', registration: 'KCD-123', color: 'White', type: 'Premium', driver: 'Ralph Edwards', status: 'Active', image: 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?q=80&w=300' },
        { id: '3', name: 'Toyota Aqua', registration: 'ABC-456', color: 'Silver', type: 'Standard', driver: 'Dianne Russell', status: 'Pending', image: 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=300' },
        { id: '4', name: 'Nissan Dayz', registration: 'DEF-789', color: 'Blue', type: 'Budget', driver: 'Esther Howard', status: 'Active', image: 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?q=80&w=300' },
    ];

    return (
        <AdminLayout title="Vehicle Management">
            {/* Search & Actions */}
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <SearchBar
                    placeholder="Search by registration or model..."
                    className="w-full md:w-96"
                />
                <div className="flex gap-4 w-full md:w-auto">
                    <Button variant="outline" className="flex-1 md:flex-none uppercase italic tracking-widest font-bold">
                        <i className="bi bi-filter text-lg text-[#D10000]"></i>
                        Filters
                    </Button>
                    <Link to="/vehicles/create" className="flex-1 md:flex-none">
                        <Button className="w-full md:w-auto px-10 uppercase italic tracking-widest font-black shadow-lg shadow-red-100 h-[52px]">
                            <i className="bi bi-plus-lg mr-2"></i>
                            Add New Vehicle
                        </Button>
                    </Link>
                </div>
            </div>

            {/* Grid View */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                {vehicles.map((v) => (
                    <Link key={v.id} to="/vehicles/detail" className="group border border-[#E5E7EB] rounded-[30px] overflow-hidden hover:shadow-2xl hover:shadow-red-50/50 transition-all duration-500 bg-white block">
                        <div className="relative h-56 overflow-hidden">
                            <img src={v.image} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                            <div className="absolute top-4 right-4">
                                <Badge variant={v.status === 'Active' ? 'active' : 'warning'}>{v.status}</Badge>
                            </div>
                            <div className="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/90 to-transparent">
                                <h4 className="text-white text-[18px] font-[900] uppercase italic tracking-tight">{v.name}</h4>
                                <p className="text-white/70 text-[12px] font-[800] uppercase tracking-widest mt-0.5">{v.registration}</p>
                            </div>
                        </div>
                        <div className="p-6 space-y-6">
                            <div className="grid grid-cols-2 gap-4">
                                <div>
                                    <p className="text-[10px] text-[#9CA3AF] font-[900] uppercase tracking-widest mb-1.5">Car Type</p>
                                    <div className="flex items-center gap-2 text-[14px] font-[900] text-[#111] uppercase italic">
                                        <i className="bi bi-car-front text-[#D10000]"></i>
                                        {v.type}
                                    </div>
                                </div>
                                <div>
                                    <p className="text-[10px] text-[#9CA3AF] font-[900] uppercase tracking-widest mb-1.5">Color</p>
                                    <div className="flex items-center gap-2 text-[14px] font-[900] text-[#111] uppercase italic">
                                        <i className="bi bi-palette text-[#D10000]"></i>
                                        {v.color}
                                    </div>
                                </div>
                            </div>
                            <div className="pt-5 border-t border-[#F3F4F6]">
                                <p className="text-[10px] text-[#9CA3AF] font-[900] uppercase tracking-widest mb-3">Assigned Driver</p>
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 rounded-full bg-[#FFF1F2] border border-[#D10000]/10 flex items-center justify-center font-[900] text-[14px] text-[#D10000] italic">
                                        {v.driver.charAt(0)}
                                    </div>
                                    <span className="text-[14px] font-[800] text-[#111]">{v.driver}</span>
                                </div>
                            </div>
                        </div>
                    </Link>
                ))}
            </div>

            <Pagination totalItems={vehicles.length} />
        </AdminLayout>
    );
}
