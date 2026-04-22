import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, Button, SearchBar, Pagination } from '@/components/UI';
import { Link, useNavigate } from 'react-router-dom';

export default function VehicleManagement() {
    const navigate = useNavigate();
    const vehicles = [
        {
            id: '1',
            driverId: '#19976',
            name: 'alto',
            model: '2000',
            plateNo: 'faa 3124',
            category: 'Sedan',
            seats: '4 Seats',
            image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=200'
        },
        {
            id: '2',
            driverId: '#19977',
            name: 'civic',
            model: '2022',
            plateNo: 'lea 5678',
            category: 'Premium',
            seats: '4 Seats',
            image: 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?q=80&w=200'
        },
    ];

    return (
        <AdminLayout title="Vehicle Management">
            {/* Search & Actions */}
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <SearchBar
                    placeholder="Search by name, email, phone number"
                    className="w-full md:w-96"
                />
                <div className="flex gap-4 w-full md:w-auto">

                    <Button variant="pill" className="flex-1 lg:flex-none" onClick={() => navigate('/vehicles/create')}>
                        <i className="bi bi-person-plus-fill"></i> Add Vehicle
                    </Button>
                </div>
            </div>

            {/* Table View */}
            <Table headers={['Car Image', 'Driver ID', 'Car Name', 'Model No', 'Plate No', 'Category', 'No of Seats']}>
                {vehicles.map((v) => (
                    <tr
                        key={v.id}
                        onClick={() => navigate(`/vehicles/detail/${v.id}`)}
                        className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                    >
                        <td className="py-[18px] px-[30px]">
                            <div className="w-16 h-12 bg-gray-50 border border-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                {v.image ? (
                                    <img src={v.image} className="w-full h-full object-cover" alt={v.name} />
                                ) : (
                                    <span className="text-[10px] font-bold text-gray-300 uppercase text-center">No Image</span>
                                )}
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px]">
                            <span className="text-[14px] font-[800] text-[#111] border-b-2 border-dashed border-gray-200 pb-0.5">
                                {v.driverId}
                            </span>
                        </td>
                        <td className="py-[18px] px-[30px] text-[15px] font-[800] text-[#111] lowercase">
                            {v.name}
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-gray-400">
                            {v.model}
                        </td>
                        <td className="py-[18px] px-[30px] whitespace-nowrap">
                            <span className="bg-red-50 text-[#D10000] px-4 py-1.5 rounded-full text-[13px] font-[800] border border-red-50 italic">
                                {v.plateNo}
                            </span>
                        </td>
                        <td className="py-[18px] px-[30px]">
                            <div className="px-5 py-2 bg-gray-50 border border-gray-100 rounded-lg text-[13px] font-[800] text-gray-600 inline-block">
                                {v.category}
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px]">
                            <div className="flex items-center gap-2 text-[14px] font-[700] text-[#111]/80">
                                <i className="bi bi-people-fill text-gray-400"></i>
                                {v.seats}
                            </div>
                        </td>

                    </tr>
                ))}
            </Table>

            <div className="mt-8">
                <Pagination totalItems={vehicles.length} />
            </div>
        </AdminLayout>
    );
}

