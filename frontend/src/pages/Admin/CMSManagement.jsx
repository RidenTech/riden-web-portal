import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Button, Input, InputWrapper, Label } from '@/components/UI';

export default function CMSManagement() {
    const [page, setPage] = useState('Legal');

    return (
        <AdminLayout title="CMS Management">
            {/* Top Actions */}
            <div className="flex justify-between items-center mb-10">
                <div className="w-80">
                    <Label>Select Page to Edit</Label>
                    <div className="relative mt-2">
                        <select
                            value={page}
                            onChange={(e) => setPage(e.target.value)}
                            className="w-full bg-[#fdfdfd] border-[1.5px] border-[#E5E7EB] px-8 py-[14px] rounded-[16px] text-[15px] font-[800] text-[#111] outline-none focus:border-[#D10000] focus:ring-[5px] focus:ring-[#e13437]/10 transition-all cursor-pointer appearance-none shadow-sm"
                        >
                            <option>Legal</option>
                            <option>Help</option>
                            <option>FAQ's</option>
                        </select>
                        <i className="bi bi-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-[#D10000] pointer-events-none text-lg"></i>
                    </div>
                </div>
            </div>

            {/* Page Title Input */}
            <div className="mb-10">
                <Label>Page Title</Label>
                <div className="mt-2">
                    <InputWrapper icon="bi bi-window-sidebar">
                        <Input
                            value={page}
                            onChange={(e) => setPage(e.target.value)}
                            className="h-[64px] text-[20px] font-[900]"
                        />
                    </InputWrapper>
                </div>
            </div>

            {/* Editor Toolbar Simulator */}
            <div className="mb-8">
                <div className="border-[1.5px] border-[#E5E7EB] rounded-[24px] overflow-hidden shadow-sm">
                    <div className="bg-gray-50/80 p-5 border-b-[1.5px] border-[#E5E7EB] flex flex-wrap justify-between items-center gap-4">
                        <div className="flex items-center gap-3">
                            <select className="bg-white border border-gray-200 px-4 py-1.5 text-xs font-bold rounded-[8px] outline-none focus:border-[#D10000]">
                                <option>Paragraph</option>
                                <option>Heading 1</option>
                                <option>Heading 2</option>
                            </select>
                            <div className="flex items-center gap-1 border-l border-gray-200 ps-4">
                                <button className="w-9 h-9 rounded-lg hover:bg-white flex items-center justify-center font-bold text-gray-700 hover:text-[#D10000] border border-transparent hover:border-[#D10000]/10 transition-all">B</button>
                                <button className="w-9 h-9 rounded-lg hover:bg-white flex items-center justify-center italic text-gray-700 hover:text-[#D10000] border border-transparent hover:border-[#D10000]/10 transition-all">I</button>
                                <button className="w-9 h-9 rounded-lg hover:bg-white flex items-center justify-center text-gray-700 hover:text-[#D10000] border border-transparent hover:border-[#D10000]/10 transition-all"><i className="bi bi-list-ul text-lg"></i></button>
                                <button className="w-9 h-9 rounded-lg hover:bg-white flex items-center justify-center text-gray-700 hover:text-[#D10000] border border-transparent hover:border-[#D10000]/10 transition-all"><i className="bi bi-link-45deg text-xl"></i></button>
                            </div>
                        </div>
                        <button className="text-[13px] font-[800] text-[#D10000] hover:text-[#111] transition-colors uppercase italic tracking-wider">
                            <i className="bi bi-code-slash mr-1.5"></i> Edit HTML Code
                        </button>
                    </div>

                    <div className="p-10 min-h-[450px] outline-none prose prose-red max-w-none text-[16px] leading-[1.8] font-[500] text-[#4B5563] bg-white" contentEditable>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>

            <div className="pt-2 pb-12 flex justify-end gap-4 relative z-10">
                <Button variant="outline" className="px-14 h-[56px] rounded-[16px] border-[#E5E7EB] font-bold">Discard</Button>
                <Button className="px-14 h-[56px] rounded-[16px] italic font-black uppercase tracking-widest shadow-lg shadow-red-100">Save Page Content</Button>
            </div>
        </AdminLayout>
    );
}
