import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, SearchBar, Tabs } from '@/components/UI';

export default function BookingManagement() {
    const [type, setType] = useState('ongoing');

    const ongoingBookings = [
        { id: '#34567', driver: 'Theresa Webb', passenger: 'Wade Warren', fare: '$45.00', status: 'online' },
        { id: '#34568', driver: 'Ralph Edwards', passenger: 'Wade Warren', fare: '$45.00', status: 'online' },
    ];

    const previousBookings = [
        { id: '#34572', driver: 'Wade Warren', passenger: 'Theresa Webb', fare: '$45.00', status: 'success' },
        { id: '#34573', driver: 'Jacob Jones', passenger: 'Ralph Edwards', fare: '$45.00', status: 'danger' },
    ];

    const bookings = type === 'ongoing' ? ongoingBookings : previousBookings;

    return (
        <AdminLayout title="Booking Management">
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                <SearchBar
                    placeholder="Search by ID, passenger or driver"
                    className="w-full lg:w-[400px]"
                />

                <div className="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <button className="flex items-center gap-2 px-6 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all">
                        <i className="bi bi-file-earmark-excel-fill text-[#1D7E4D]"></i> Download
                    </button>
                    <div className="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#6B7280]">
                        <i className="bi bi-calendar3"></i>
                        <span>23/04/2025 - 23/04/2025</span>
                    </div>
                </div>
            </div>

            {/* Tabs */}
            <Tabs
                activeTab={type}
                onTabChange={setType}
                options={[
                    { id: 'ongoing', label: 'Ongoing Bookings' },
                    { id: 'previous', label: 'Previous Bookings' }
                ]}
            />

            {/* Table */}
            <Table headers={['Booking ID', 'Driver', 'Passenger', 'Fare', 'Status']}>
                {bookings.map((booking) => (
                    <tr
                        key={booking.id}
                        className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                        onClick={() => window.location.href = '/bookings/detail'}
                    >
                        <td className="py-[18px] px-[30px]">
                            <span className="text-[13px] font-[800] text-[#D10000] bg-red-50 px-3 py-1.5 rounded-[10px] italic tracking-tight">
                                {booking.id}
                            </span>
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#111]">{booking.driver}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#111]">{booking.passenger}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000]">{booking.fare}</td>
                        <td className="py-[18px] px-[30px]">
                            <Badge variant={booking.status}>{booking.status === 'online' ? 'Ongoing' : booking.status === 'danger' ? 'Cancelled' : 'Completed'}</Badge>
                        </td>
                    </tr>
                ))}
            </Table>
        </AdminLayout>
    );
}
