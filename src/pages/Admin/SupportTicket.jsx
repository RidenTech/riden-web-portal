import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, SearchBar, Tabs, Pagination } from '@/components/UI';

export default function SupportTicket() {
    const [tab, setTab] = useState('driver');

    const complaints = {
        driver: [
            { date: '22 March 2025 9:00pm', id: '#34567', booking: '#34567', name: 'Theresa Webb', type: 'Type 1', status: 'Resolved' },
            { date: '22 March 2025 9:00pm', id: '#34568', booking: '#34568', name: 'Ralph Edwards', type: 'Type 2', status: 'Pending' },
            { date: '22 March 2025 9:00pm', id: '#34569', booking: '#34569', name: 'Dianne Russell', type: 'Type 3', status: 'Resolved' },
            { date: '22 March 2025 9:00pm', id: '#34570', booking: '#34570', name: 'Esther Howard', type: 'Type 1', status: 'Pending' },
            { date: '22 March 2025 9:00pm', id: '#34571', booking: '#34571', name: 'Cody Fisher', type: 'Type 3', status: 'Pending' },
        ],
        passenger: [
            { date: '22 March 2025 9:00pm', id: '#44567', booking: '#44567', name: 'John Doe', type: 'Unfair behavior', status: 'Resolved' },
            { date: '22 March 2025 9:00pm', id: '#44568', booking: '#44568', name: 'Jane Smith', type: 'Car condition', status: 'Pending' },
        ]
    };

    const currentComplaints = complaints[tab];

    return (
        <AdminLayout title="Support Tickets">
            {/* Header & Tabs */}
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <Tabs
                    activeTab={tab}
                    onTabChange={setTab}
                    options={[
                        { id: 'driver', label: 'Driver Complaints' },
                        { id: 'passenger', label: 'Passenger Complaints' }
                    ]}
                    className="mb-0 border-none"
                />
                <SearchBar
                    placeholder="Search tickets..."
                    className="w-full md:w-80"
                />
            </div>

            {/* Table */}
            <Table headers={['Date & Time', 'Ticket ID', 'Booking ID', `${tab === 'driver' ? 'Driver' : 'Passenger'} Name`, 'Type', 'Status']} headerBg="bg-[#FFEEEE]">
                {currentComplaints.map((c, i) => (
                    <tr key={i} className="group hover:bg-black/[0.03] transition-colors cursor-pointer border-b border-[#F3F4F6]" onClick={() => { }}>
                        <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#4B5563]">{c.date}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000]">{c.id}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#4B5563] font-mono">{c.booking}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111]">{c.name}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#4B5563]">{c.type}</td>
                        <td className="py-[18px] px-[30px]">
                            <Badge variant={c.status === 'Resolved' ? 'active' : 'danger'}>{c.status}</Badge>
                        </td>
                    </tr>
                ))}
            </Table>

            <Pagination totalItems={currentComplaints.length} />
        </AdminLayout>
    );
}
