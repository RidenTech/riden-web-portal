import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, Button, SearchBar, Tabs, DateRangePicker, DatePickerStyles } from '@/components/UI';
import { Link, useNavigate } from 'react-router-dom';
import { startOfWeek } from 'date-fns';

export default function DriverManagement() {
    const navigate = useNavigate();
    const [activeTab, setActiveTab] = useState('active');
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());

    const drivers = [
        { id: 1, name: 'Robert Fox', uid: '#34567', phone: '+123456789', status: 'online', avatar: '11' },
        { id: 2, name: 'Guy Hawkins', uid: '#34567', phone: '+987654321', status: 'offline', avatar: '12' },
        { id: 3, name: 'Jenny Wilson', uid: '#45678', phone: '+112233445', status: 'suspended', avatar: '13' },
        { id: 4, name: 'Robert Fox', uid: '#34567', phone: '+123456789', status: 'blocked', avatar: '14' },
    ];

    return (
        <AdminLayout title="Driver Management">
            <DatePickerStyles />
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                <SearchBar
                    placeholder="Search by name, email, phone number"
                    className="w-full lg:w-[360px]"
                />

                <div className="flex items-center gap-2 w-full lg:w-auto">
                    <Button variant="pill" className="flex-1 lg:flex-none">
                        <i className="bi bi-person-plus-fill mr-2"></i> Add Driver
                    </Button>

                    <DateRangePicker
                        startDate={startDate}
                        endDate={endDate}
                        onStartDateChange={setStartDate}
                        onEndDateChange={setEndDate}

                    />
                    <button className="flex rounded-full items-center gap-1 px-6 py-3 bg-white border border-[#E5E7EB] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all">
                        <i className="bi bi-file-earmark-excel-fill text-[#1D7E4D]"></i> Download
                    </button>
                </div>
            </div>

            {/* Tabs */}
            <Tabs
                activeTab={activeTab}
                onTabChange={setActiveTab}
                options={[
                    { id: 'active', label: 'Active Drivers' },
                    { id: 'requested', label: 'Requested', count: 14 }
                ]}
            />

            {/* Table */}
            <Table headers={['Name', 'Unique ID', 'Phone Number', 'Status']}>
                {drivers.map((d) => (
                    <tr
                        key={d.id}
                        onClick={() => navigate('/drivers/detail')}
                        className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                    >
                        <td className="py-[18px] px-[30px]">
                            <div className="flex items-center gap-3">
                                <div className="w-[44px] h-[44px] rounded-full overflow-hidden border-2 border-white shadow-sm">
                                    <img src={`https://i.pravatar.cc/100?img=${d.avatar}`} className="w-full h-full object-cover" alt="" />
                                </div>
                                <span className="font-[700] text-[#111]">{d.name}</span>
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px] text-[#6B7280] font-[700] italic tracking-tight">{d.uid}</td>
                        <td className="py-[18px] px-[30px] text-[#111] font-[700]">{d.phone}</td>
                        <td className="py-[18px] px-[30px]">
                            <Badge variant={d.status}>{d.status}</Badge>
                        </td>
                    </tr>
                ))}
            </Table>
        </AdminLayout>
    );
}
