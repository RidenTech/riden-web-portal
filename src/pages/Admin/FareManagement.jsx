import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Button, Table, Select, InputWrapper, SearchBar } from '@/components/UI';

export default function FareManagement() {
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    return (
        <AdminLayout title="Fare Management">
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                <div className="flex flex-col md:flex-row gap-4 w-full lg:w-auto">
                    <div className="w-full md:w-64">
                        <InputWrapper icon="bi bi-truck">
                            <Select>
                                <option disabled selected>Select Car Type</option>
                                <option>SUV</option>
                                <option>Van</option>
                                <option>Premium</option>
                                <option>Wheelchair Accessible</option>
                            </Select>
                        </InputWrapper>
                    </div>
                    <SearchBar
                        placeholder="Search fare rules..."
                        className="w-full md:w-80"
                    />
                </div>

                <div className="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#6B7280]">
                    <i className="bi bi-calendar3"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
            </div>

            <Table headers={['Days', 'Base Fare', 'Per KM Fare', 'Waiting', 'Night Time', 'Night Charges', 'Peak Charges', 'Actions']}>
                {days.map((day) => (
                    <tr key={day} className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]">
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111] uppercase italic tracking-tight">{day}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#111] leading-none">$200.00</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#111] leading-none">$15.00</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#6B7280]">2 min / $3.00</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#6B7280]">10 PM - 6 AM</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000] leading-none">$50.00</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000] leading-none">$50.00</td>
                        <td className="py-[18px] px-[30px] text-right">
                            <button className="px-5 py-2 bg-[#D10000] text-white text-[12px] font-[800] rounded-[10px] hover:bg-black transition-all shadow-lg shadow-red-50 uppercase italic">
                                Update
                            </button>
                        </td>
                    </tr>
                ))}
            </Table>
        </AdminLayout>
    );
}
