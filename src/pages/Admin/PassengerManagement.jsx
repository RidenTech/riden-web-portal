import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, Button, SearchBar, DateRangePicker, DatePickerStyles, Pagination } from '@/components/UI';
import { startOfWeek } from 'date-fns';

export default function PassengerManagement() {
    const navigate = useNavigate();
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [exportOpen, setExportOpen] = useState(false);

    const passengers = [
        { id: 1, name: 'John Doe', uid: '#34567', phone: '+123456789', status: 'online', joined: '2024-03-10', avatar: '21' },
        { id: 2, name: 'Jane Smith', uid: '#34567', phone: '+987654321', status: 'offline', joined: '2024-03-12', avatar: '24' },
        { id: 3, name: 'Michael Brown', uid: '#45678', phone: '+112233445', status: 'online', joined: '2024-03-15', avatar: '22' },
    ];

    return (
        <AdminLayout title="Passenger Management">
            <DatePickerStyles />
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
                <SearchBar
                    placeholder="Search by name, email, phone number"
                    className="w-full lg:w-[350px]"
                />

                <div className="flex flex-wrap items-center gap-1 w-full lg:w-auto">
                    <Button variant="pill" className="flex-1 lg:flex-none" onClick={() => navigate('/passenger/create')}>
                        <i className="bi bi-person-plus-fill"></i> Add Passenger
                    </Button>

                    <DateRangePicker
                        startDate={startDate}
                        endDate={endDate}
                        onStartDateChange={setStartDate}
                        onEndDateChange={setEndDate}
                    />

                    <div className="relative">
                        <button
                            onClick={() => setExportOpen(!exportOpen)}
                            className="flex rounded-full items-center gap-1 px-4 py-3 bg-white border border-[#E5E7EB] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all"
                        >
                            <i className="bi bi-file-earmark-excel-fill text-[#1D7E4D]"></i> Export
                            <i className={`bi bi-chevron-down text-[#1D7E4D] text-sm transition-all ${exportOpen ? 'rotate-180' : ''}`}></i>
                        </button>
                        {exportOpen && (
                            <div className="absolute right-0 mt-2 w-44 bg-white border border-[#E5E7EB] rounded-2xl shadow-lg overflow-hidden py-1 z-10">
                                <button
                                    className="w-full text-left px-4 py-2 hover:bg-gray-50 text-[13px] font-[600] text-[#111] border-b border-[#F3F4F6] transition-colors"
                                    onClick={() => setExportOpen(false)}
                                >
                                    <i className="bi bi-filetype-csv mr-2 text-[#1D7E4D]"></i> CSV Format
                                </button>
                                <button
                                    className="w-full text-left px-4 py-2 hover:bg-gray-50 text-[13px] font-[600] text-[#111] transition-colors"
                                    onClick={() => setExportOpen(false)}
                                >
                                    <i className="bi bi-filetype-pdf mr-2 text-[#E72929]"></i> PDF Format
                                </button>
                                <button
                                    className="w-full text-left px-4 py-2 hover:bg-gray-50 text-[13px] font-[600] text-[#111] transition-colors border-t border-[#F3F4F6]"
                                    onClick={() => setExportOpen(false)}
                                >
                                    <i className="bi bi-file-earmark-excel-fill mr-2 text-[#1D7E4D]"></i> Excel Format
                                </button>
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {/* Table */}
            <Table headers={['Name', 'Unique ID', 'Phone Number', 'Joined', 'Status']}>
                {passengers.map((p) => (
                    <tr
                        key={p.id}
                        onClick={() => navigate('/passenger/detail')}
                        className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                    >
                        <td className="py-[18px] px-[30px]">
                            <div className="flex items-center gap-3">
                                <div className="w-[44px] h-[44px] rounded-full overflow-hidden border-2 border-white shadow-sm">
                                    <img src={`https://i.pravatar.cc/100?img=${p.avatar}`} className="w-full h-full object-cover" alt="" />
                                </div>
                                <span className="font-[700] text-[#111]">{p.name}</span>
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px] text-[#6B7280] font-[700] italic tracking-tight">{p.uid}</td>
                        <td className="py-[18px] px-[30px] text-[#111] font-[700]">{p.phone}</td>
                        <td className="py-[18px] px-[30px] text-[#6B7280] font-[700]">{p.joined}</td>
                        <td className="py-[18px] px-[30px]">
                            <Badge variant={p.status}>{p.status}</Badge>
                        </td>
                    </tr>
                ))}
            </Table>
            <Pagination totalItems={passengers.length} />
        </AdminLayout>
    );
}
