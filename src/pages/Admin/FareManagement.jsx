import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Select, InputWrapper } from '@/components/UI';

export default function FareManagement() {
    const [fares, setFares] = useState([
        { day: 'Monday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
        { day: 'Tuesday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
        { day: 'Wednesday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
        { day: 'Thursday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
        { day: 'Friday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
        { day: 'Saturday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
        { day: 'Sunday', baseFare: '200.00', perKm: '15.00', waiting: '2 min / $3.00', nightTime: '10 PM - 6 AM', nightCharges: '50.00', peakCharges: '50.00' },
    ]);

    const [editingDay, setEditingDay] = useState(null);
    const [editValues, setEditValues] = useState({});
    const [isSelectOpen, setIsSelectOpen] = useState(false);
    const [selectedCarType, setSelectedCarType] = useState('Standard');
    const carTypes = ['All', 'Standard', 'SUV', 'Van', 'Premium', 'Wheelchair Accessible'];

    const startEditing = (fare) => {
        setEditingDay(fare.day);
        setEditValues({ ...fare });
    };

    const cancelEditing = () => {
        setEditingDay(null);
        setEditValues({});
    };

    const saveEditing = () => {
        setFares(prev => prev.map(f => f.day === editingDay ? { ...f, ...editValues } : f));
        setEditingDay(null);
        setEditValues({});
    };

    const handleChange = (field, value) => {
        setEditValues(prev => ({ ...prev, [field]: value }));
    };

    return (
        <AdminLayout title="Fare Management">
            {/* Header Row - only car type selector */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-2 mb-4">
                <div className="relative w-full md:w-72">
                    <div
                        onClick={() => setIsSelectOpen(!isSelectOpen)}
                        className={`group relative flex items-center bg-[#fdfdfd] border-[1.5px] rounded-[30px] px-[18px] py-[13px] cursor-pointer transition-all duration-200 ${isSelectOpen ? 'border-[#D10000] ring-[5px] ring-[#e13437]/10' : 'border-[#E5E7EB] hover:border-[#D10000]'}`}
                    >
                        <i className={`bi bi-truck mr-3 text-[18px] transition-colors ${isSelectOpen ? 'text-[#D10000]' : 'text-[#999]'}`}></i>
                        <span className="flex-1 text-[14px] font-[700] text-[#111]">{selectedCarType}</span>
                        <i className={`bi bi-chevron-down text-[#111] text-[12px] transition-transform duration-300 ${isSelectOpen ? 'rotate-180' : 'rotate-0'}`}></i>
                    </div>

                    {isSelectOpen && (
                        <>
                            <div className="fixed inset-0 z-40" onClick={() => setIsSelectOpen(false)}></div>
                            <div className="absolute top-full left-0 right-0 mt-3 bg-white border border-[#E5E7EB] rounded-[24px] shadow-[0_20px_50px_rgba(0,0,0,0.12)] z-50 overflow-hidden py-3 animate-scale-up-dropdown origin-top">
                                {carTypes.map((type) => (
                                    <div
                                        key={type}
                                        onClick={() => {
                                            setSelectedCarType(type);
                                            setIsSelectOpen(false);
                                        }}
                                        className={`px-4 py-2 text-xs font-[700] cursor-pointer transition-all duration-200 ${selectedCarType === type
                                            ? 'bg-[#D10000] text-white mx-2 rounded-full shadow-md'
                                            : 'text-[#111] hover:bg-gray-50'
                                            }`}
                                    >
                                        {type}
                                    </div>
                                ))}
                            </div>
                        </>
                    )}
                </div>
            </div>

            <style dangerouslySetInnerHTML={{
                __html: `
                @keyframes scale-up-dropdown {
                    from { opacity: 0; transform: scaleY(0.95) translateY(-5px); }
                    to { opacity: 1; transform: scaleY(1) translateY(0); }
                }
                .animate-scale-up-dropdown { animation: scale-up-dropdown 0.2s cubic-bezier(0.16, 1, 0.3, 1); }
            ` }} />

            <Table headers={['Days', 'Base Fare', 'Per KM Fare', 'Waiting', 'Night Time', 'Night Charges', 'Peak Charges', 'Actions']} tableClassName="table-fixed" headerAlign="text-center">
                {fares.map((fare) => {
                    const isEditing = editingDay === fare.day;

                    return (
                        <tr key={fare.day} className={`transition-colors border-b border-[#F3F4F6] ${isEditing ? 'bg-[#FFF8F8]' : 'hover:bg-black/[0.02]'}`}>
                            <td className="py-3 px-3 text-[14px] font-[600] text-[#111] text-center">{fare.day}</td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <input
                                        type="text"
                                        value={editValues.baseFare}
                                        onChange={(e) => handleChange('baseFare', e.target.value)}
                                        className="w-[90px] px-3 py-2 border border-[#D10000]/30 rounded-lg text-[14px] font-[700] text-[#111] text-center focus:outline-none focus:border-[#D10000] focus:ring-1 focus:ring-[#D10000]/20 bg-white"
                                    />
                                ) : (
                                    <span className="text-[14px] font-[700] text-[#111]">${fare.baseFare}</span>
                                )}
                            </td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <input
                                        type="text"
                                        value={editValues.perKm}
                                        onChange={(e) => handleChange('perKm', e.target.value)}
                                        className="w-[90px] px-3 py-2 border border-[#D10000]/30 rounded-lg text-[14px] font-[700] text-[#111] text-center focus:outline-none focus:border-[#D10000] focus:ring-1 focus:ring-[#D10000]/20 bg-white"
                                    />
                                ) : (
                                    <span className="text-[14px] font-[700] text-[#111]">${fare.perKm}</span>
                                )}
                            </td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <input
                                        type="text"
                                        value={editValues.waiting}
                                        onChange={(e) => handleChange('waiting', e.target.value)}
                                        className="w-[120px] px-3 py-2 border border-[#D10000]/30 rounded-lg text-[14px] font-[700] text-[#6B7280] text-center focus:outline-none focus:border-[#D10000] focus:ring-1 focus:ring-[#D10000]/20 bg-white"
                                    />
                                ) : (
                                    <span className="text-[14px] font-[700] text-[#6B7280]">{fare.waiting}</span>
                                )}
                            </td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <input
                                        type="text"
                                        value={editValues.nightTime}
                                        onChange={(e) => handleChange('nightTime', e.target.value)}
                                        className="w-[120px] px-3 py-2 border border-[#D10000]/30 rounded-lg text-[14px] font-[700] text-[#6B7280] text-center focus:outline-none focus:border-[#D10000] focus:ring-1 focus:ring-[#D10000]/20 bg-white"
                                    />
                                ) : (
                                    <span className="text-[14px] font-[700] text-[#6B7280]">{fare.nightTime}</span>
                                )}
                            </td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <input
                                        type="text"
                                        value={editValues.nightCharges}
                                        onChange={(e) => handleChange('nightCharges', e.target.value)}
                                        className="w-[90px] px-3 py-2 border border-[#D10000]/30 rounded-lg text-[14px] font-[600] text-[#D10000] text-center focus:outline-none focus:border-[#D10000] focus:ring-1 focus:ring-[#D10000]/20 bg-white"
                                    />
                                ) : (
                                    <span className="text-[14px] font-[600] text-[#D10000]">${fare.nightCharges}</span>
                                )}
                            </td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <input
                                        type="text"
                                        value={editValues.peakCharges}
                                        onChange={(e) => handleChange('peakCharges', e.target.value)}
                                        className="w-[90px] px-3 py-2 border border-[#D10000]/30 rounded-lg text-[14px] font-[600] text-[#D10000] text-center focus:outline-none focus:border-[#D10000] focus:ring-1 focus:ring-[#D10000]/20 bg-white"
                                    />
                                ) : (
                                    <span className="text-[14px] font-[600] text-[#D10000]">${fare.peakCharges}</span>
                                )}
                            </td>
                            <td className="py-3 px-3 text-center">
                                {isEditing ? (
                                    <div className="flex items-center justify-center gap-2">
                                        <button
                                            onClick={saveEditing}
                                            className="px-5 py-2 bg-[#12B76A] text-white text-[12px] font-[600] rounded-full hover:bg-[#039855] transition-all shadow-sm"
                                        >
                                            Update
                                        </button>

                                    </div>
                                ) : (
                                    <button
                                        onClick={() => startEditing(fare)}
                                        className="px-5 py-2 bg-white border border-[#E5E7EB] text-[#111] text-[12px] font-[700] rounded-full hover:bg-gray-50 transition-all flex items-center gap-1.5 mx-auto"
                                    >
                                        <i className="bi bi-pencil-square text-[#10B981]"></i> Edit
                                    </button>
                                )}
                            </td>
                        </tr>
                    );
                })}
            </Table>
        </AdminLayout>
    );
}
