import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Button, Badge, Table, Label, InputWrapper, Input, SearchBar } from '@/components/UI';
import { Link } from 'react-router-dom';

export default function PromoManagement() {
    const [view, setView] = useState('list');
    const promos = [
        { code: '43562783', discount: '20%', start: 'March 24, 2024', end: 'July 24, 2024', status: 'active' },
        { code: '43562784', discount: '15%', start: 'April 01, 2024', end: 'June 01, 2024', status: 'inactive' },
    ];

    return (
        <AdminLayout title="Promo Code Management">
            {view === 'list' && (
                <>
                    {/* Header Row */}
                    <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                        <SearchBar
                            placeholder="Search by code or date"
                            className="w-full lg:w-[400px]"
                        />

                        <div className="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                            <Button variant="pill" onClick={() => setView('add')} className="flex-1 lg:flex-none">
                                <i className="bi bi-plus-circle-fill mr-2"></i> Add New Code
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

                    <Table headers={['Code', 'Discount %', 'Starting Date', 'End Date', 'Status', 'Actions']}>
                        {promos.map((p, i) => (
                            <tr key={i} className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]">
                                <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111]">{p.code}</td>
                                <td className="py-[18px] px-[30px] text-[14px] font-[900] text-[#D10000] tracking-tight">{p.discount}</td>
                                <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#6B7280]">{p.start}</td>
                                <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#6B7280]">{p.end}</td>
                                <td className="py-[18px] px-[30px]">
                                    <Badge variant={p.status}>{p.status}</Badge>
                                </td>
                                <td className="py-[18px] px-[30px] text-right">
                                    <div className="flex justify-end gap-3">
                                        <button onClick={() => setView('edit')} className="w-8 h-8 rounded-lg bg-[#EBFFD5]/30 text-[#10B981] flex items-center justify-center hover:bg-[#10B981] hover:text-white transition-all"><i className="bi bi-pencil-square"></i></button>
                                        <button className="w-8 h-8 rounded-lg bg-[#FEF2F2] text-[#EF4444] flex items-center justify-center hover:bg-[#EF4444] hover:text-white transition-all"><i className="bi bi-trash3-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </Table>
                </>
            )}

            {(view === 'add' || view === 'edit') && (
                <div className="max-w-4xl mx-auto space-y-6">
                    <div className="flex items-center gap-4">
                        <button onClick={() => setView('list')} className="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left"></i>
                        </button>
                        <h2 className="text-xl font-bold text-gray-900 tracking-tight">{view === 'add' ? 'Add New Promo Code' : 'Edit Promo Code'}</h2>
                    </div>

                    <div className="bg-white p-10 rounded-[30px] shadow-sm border border-[#E5E7EB]">
                        <div className="bg-[#D10000] text-white px-8 py-3.5 rounded-[14px] text-sm font-bold mb-10 inline-block uppercase tracking-wider italic">
                            Code Details
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                            <div>
                                <Label>Code</Label>
                                <InputWrapper icon="bi bi-tag">
                                    <Input placeholder="Enter Code" defaultValue={view === 'edit' ? '43562783' : ''} />
                                </InputWrapper>
                            </div>
                            <div>
                                <Label>Discount Percentage</Label>
                                <InputWrapper icon="bi bi-percent">
                                    <Input placeholder="Enter Discount Percentage" defaultValue={view === 'edit' ? '20%' : ''} />
                                </InputWrapper>
                            </div>
                            <div className="md:col-span-2">
                                <Label>Upto Discount</Label>
                                <InputWrapper icon="bi bi-cash">
                                    <Input placeholder="e.g. 30%" defaultValue={view === 'edit' ? '50%' : ''} />
                                </InputWrapper>
                            </div>
                        </div>

                        <div className="bg-[#D10000] text-white px-8 py-3.5 rounded-[14px] text-sm font-bold mb-10 inline-block uppercase tracking-wider italic">
                            Date Management
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                            <div>
                                <Label>Starting Date</Label>
                                <InputWrapper icon="bi bi-calendar-event">
                                    <Input placeholder="22/04/2024" defaultValue={view === 'edit' ? '2024-03-24' : ''} />
                                </InputWrapper>
                            </div>
                            <div>
                                <Label>End Date</Label>
                                <InputWrapper icon="bi bi-calendar-check">
                                    <Input placeholder="22/05/2025" defaultValue={view === 'edit' ? '2024-07-24' : ''} />
                                </InputWrapper>
                            </div>
                        </div>

                        <div className="flex justify-end gap-3 pt-8 border-t border-gray-50">
                            <Button onClick={() => setView('list')} className="px-12 py-3.5 italic font-black uppercase tracking-widest shadow-xl shadow-red-100">{view === 'add' ? 'Save Code' : 'Update Code'}</Button>
                            <Button onClick={() => setView('list')} variant="outline" className="px-12 py-3.5 border-gray-200 text-gray-400 italic font-black uppercase tracking-widest">Cancel</Button>
                        </div>
                    </div>
                </div>
            )}
        </AdminLayout>
    );
}
