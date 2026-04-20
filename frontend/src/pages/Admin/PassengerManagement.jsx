import React from 'react';
import { Link } from 'react-router-dom';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, Button, SearchBar } from '@/components/UI';

export default function PassengerManagement() {
    const passengers = [
        { id: 1, name: 'John Doe', uid: '#34567', phone: '+123456789', status: 'online', joined: '2024-03-10' },
        { id: 2, name: 'Jane Smith', uid: '#34567', phone: '+987654321', status: 'offline', joined: '2024-03-12' },
        { id: 3, name: 'Michael Brown', uid: '#45678', phone: '+112233445', status: 'online', joined: '2024-03-15' },
    ];

    return (
        <AdminLayout title="Passenger Management">
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                <SearchBar
                    placeholder="Search by name, email, phone number"
                    className="w-full lg:w-[400px]"
                />

                <div className="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <Button variant="pill" className="flex-1 lg:flex-none">
                        <i className="bi bi-person-plus-fill mr-2"></i> Add New Passenger
                    </Button>
                    <button className="flex items-center gap-2 px-6 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all">
                        <i className="bi bi-file-earmark-excel-fill text-[#1D7E4D]"></i> Download
                    </button>
                    <div className="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#6B7280]">
                        <i className="bi bi-calendar3"></i>
                        <span>23/04/2025 - 23/04/2025</span>
                    </div>
                </div>
            </div>

            {/* Table */}
            <Table headers={['Name', 'Unique ID', 'Phone Number', 'Joined', 'Status']}>
                {passengers.map((p) => (
                    <tr key={p.id} className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]">
                        <td className="py-[18px] px-[30px] font-[700] text-[#111]">{p.name}</td>
                        <td className="py-[18px] px-[30px] text-[#6B7280] font-[700] italic tracking-tight">{p.uid}</td>
                        <td className="py-[18px] px-[30px] text-[#111] font-[700]">{p.phone}</td>
                        <td className="py-[18px] px-[30px] text-[#6B7280] font-[700]">{p.joined}</td>
                        <td className="py-[18px] px-[30px]">
                            <Badge variant={p.status}>{p.status}</Badge>
                        </td>
                    </tr>
                ))}
            </Table>
        </AdminLayout>
    );
}
