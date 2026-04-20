import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Button, SearchBar, DeleteModal, Pagination, PillTabs, PeriodFilter, DateRangePicker, DatePickerStyles } from '@/components/UI';
import { Link } from 'react-router-dom';
import { startOfWeek } from 'date-fns';

export default function AdminRoles() {
    const [tab, setTab] = useState('all');
    const [globalPeriod, setGlobalPeriod] = useState('This Week');
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
    const [selectedAdmin, setSelectedAdmin] = useState(null);

    const handleGlobalPeriodChange = (e) => {
        const val = e.target.value;
        setGlobalPeriod(val);
        // Simplified logic for now, matching Analytics.jsx's behavior
    };

    const admins = [
        { name: 'Wade Warren', email: 'example@gmail.com', phone: '+123456372893' },
        { name: 'Jacob Jones', email: 'example@gmail.com', phone: '+123456372893' },
        { name: 'Bessie Cooper', email: 'example@gmail.com', phone: '+123456372893' },
        { name: 'Theresa Webb', email: 'example@gmail.com', phone: '+123456372893' },
    ];

    const handleDeleteClick = (admin) => {
        setSelectedAdmin(admin);
        setIsDeleteModalOpen(true);
    };

    const confirmDelete = () => {
        console.log('Deleting admin:', selectedAdmin);
        setIsDeleteModalOpen(false);
        // Add actual deletion logic here
    };

    return (
        <AdminLayout title="Admin Roles">
            {/* Header Actions */}
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-4">
                <SearchBar
                    placeholder="Search Roles"
                    className="w-full md:w-100"
                />
                <Link to="/admin-roles/create" className="w-full md:w-auto">
                    <Button className="w-full rounded-full md:w-auto px-8 uppercase italic tracking-wider font-bold h-[48px]">
                        <i className="bi bi-plus-circle-fill text-lg"></i>
                        Add  Admin
                    </Button>
                </Link>
            </div>

            <Table headers={['Name', 'Email', 'Phone Number', 'Action']} headerBg="bg-[#FFF1F2]">
                {admins.map((r, i) => (
                    <tr key={i} className="group hover:bg-black/[0.03] transition-colors border-b border-[#F3F4F6]">
                        <td className="py-[18px] px-[30px] text-[15px] font-[600] text-[#111]   tracking-tight">
                            <Link to="/admin-roles/detail" className="hover:text-[#D10000] transition-colors">{r.name}</Link>
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[600] text-[#4B5563]">{r.email}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#9CA3AF] font-mono">{r.phone}</td>
                        <td className="py-[18px] px-[30px] text-right">
                            <div className="flex  gap-3 ">
                                <Link to="/admin-roles/edit" className="w-10 h-10 text-green-500 flex items-center justify-start hover:text-green-600 transition-all"><i className="bi bi-pencil-square text-lg"></i></Link>
                                <button
                                    onClick={() => handleDeleteClick(r)}
                                    className="w-10 h-10 text-red-500 flex items-center justify-start hover:text-red-600 transition-all"
                                >
                                    <i className="bi bi-trash3-fill text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                ))}
            </Table>

            <Pagination totalItems={admins.length} />

            <DeleteModal
                isOpen={isDeleteModalOpen}
                onClose={() => setIsDeleteModalOpen(false)}
                onConfirm={confirmDelete}
                itemName={selectedAdmin?.name}
            />
        </AdminLayout>
    );
}
