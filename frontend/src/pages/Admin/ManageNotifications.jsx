import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Badge, Button, Table, Label, InputWrapper, Input, SearchBar, Pagination } from '@/components/UI';

export default function ManageNotifications() {
    const [view, setView] = useState('list');
    const alerts = [
        { date: '22 March 2025', title: 'App Update', message: 'Update your app for new features...', status: 'Sent' },
        { date: '22 March 2025', title: 'Maintenance', message: 'Scheduled maintenance tonight at...', status: 'Sent' },
        { date: '22 March 2025', title: 'New Driver', message: 'Welcome our newest driver to the...', status: 'Sent' },
        { date: '22 March 2025', title: 'System Alert', message: 'Server optimization process started...', status: 'Sent' },
    ];

    return (
        <AdminLayout title="Manage Notifications">
            {view === 'list' ? (
                <>
                    {/* Header Actions */}
                    <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                        <SearchBar
                            placeholder="Search alerts..."
                            className="w-full md:w-80"
                        />
                        <div className="flex flex-wrap gap-4">
                            <Button onClick={() => setView('add')} className="px-8 flex items-center gap-2 uppercase italic tracking-wider font-bold h-[52px]">
                                <i className="bi bi-plus-square-fill text-lg"></i> Send Alert
                            </Button>
                            <div className="flex items-center gap-3 px-5 py-[12px] bg-[#fdfdfd] border-[1.5px] border-[#E5E7EB] rounded-[14px] text-[14px] text-[#4B5563] font-[600] whitespace-nowrap shadow-sm h-[52px]">
                                <i className="bi bi-calendar3 text-[#D10000]"></i>
                                <span>23/04/2025 - 23/04/2025</span>
                            </div>
                        </div>
                    </div>

                    {/* Table */}
                    <Table headers={['Date', 'Title', 'Message', 'Status']} headerBg="bg-[#FFEEEE]">
                        {alerts.map((a, i) => (
                            <tr key={i} className="hover:bg-black/[0.03] transition-colors border-b border-[#F3F4F6]">
                                <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#4B5563]">{a.date}</td>
                                <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111] uppercase italic tracking-tight">{a.title}</td>
                                <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#6B7280]">{a.message}</td>
                                <td className="py-[18px] px-[30px]">
                                    <Badge variant="active">{a.status}</Badge>
                                </td>
                            </tr>
                        ))}
                    </Table>

                    <Pagination totalItems={alerts.length} />
                </>
            ) : (
                <div className="max-w-4xl mx-auto space-y-6">
                    <div className="flex items-center gap-4">
                        <button onClick={() => setView('list')} className="w-10 h-10 rounded-xl border border-gray-100 flex items-center justify-center hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left"></i>
                        </button>
                        <h2 className="text-xl font-bold text-gray-900 tracking-tight">Create Notification</h2>
                    </div>

                    <div className="bg-white p-10 rounded-[30px] shadow-sm border border-[#E5E7EB]">
                        <div className="space-y-8 mb-12">
                            <div>
                                <Label>Select Audience</Label>
                                <div className="flex gap-4 pt-2">
                                    <button className="px-6 py-2.5 rounded-[12px] bg-[#D10000] text-white font-[800]">All Users</button>
                                    <button className="px-6 py-2.5 rounded-[12px] bg-gray-50 text-[#111] font-[800] hover:bg-gray-100 transition-all">Drivers Only</button>
                                    <button className="px-6 py-2.5 rounded-[12px] bg-gray-50 text-[#111] font-[800] hover:bg-gray-100 transition-all">Passengers Only</button>
                                </div>
                            </div>
                            <div>
                                <Label>Title</Label>
                                <InputWrapper icon="bi bi-type">
                                    <Input placeholder="Enter Alert Title" />
                                </InputWrapper>
                            </div>
                            <div>
                                <Label>Message</Label>
                                <textarea
                                    placeholder="Type your message here..."
                                    className="w-full min-h-[160px] p-6 bg-[#fdfdfd] border-[1.5px] border-[#E5E7EB] rounded-[20px] text-[15px] font-[600] text-[#111] outline-none focus:border-[#D10000] focus:ring-[5px] focus:ring-[#e13437]/10 transition-all shadow-sm"
                                ></textarea>
                            </div>
                        </div>

                        <div className="flex justify-end gap-3 pt-8 border-t border-gray-50">
                            <Button onClick={() => setView('list')} className="px-12 py-3.5 italic font-black uppercase tracking-wider">Send Notification</Button>
                            <Button onClick={() => setView('list')} variant="outline" className="px-12 py-3.5 border-gray-200">Cancel</Button>
                        </div>
                    </div>
                </div>
            )}
        </AdminLayout>
    );
}
