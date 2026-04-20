import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Button, SearchBar, DeleteModal, Pagination, DateRangePicker, DatePickerStyles } from '@/components/UI';
import { Link } from 'react-router-dom';
import { startOfWeek } from 'date-fns';

export default function AdminRoles() {
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
    const [selectedAdmin, setSelectedAdmin] = useState(null);



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
            <DatePickerStyles />
            {/* Header Controls */}
            <div className="flex flex-col gap-6 mb-4">
                <div className="flex flex-wrap items-center justify-between gap-4">
                    <SearchBar
                        placeholder="Search admins..."
                        className="w-full md:w-80"
                    />

                    <Link to="/admin-roles/create">
                        <Button className="px-8 py-3 rounded-full  font-black uppercase tracking-widest shadow-xl shadow-red-100">
                            <i className="bi bi-plus-lg mr-2"></i> Add Admin
                        </Button>
                    </Link>

                </div>


            </div>

            <Table headers={['Admin Name', 'Email Address', 'Module Permissions', 'Actions']} headerBg="bg-[#FFF1F2]">
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
