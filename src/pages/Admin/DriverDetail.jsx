import React, { useState, useEffect, useCallback } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link, useParams, useNavigate } from 'react-router-dom';
import { InputWrapper, Input, useToast } from '@/components/UI';
import { getDriverById, updateDriver, toggleDriverStatus, deleteDriver } from '../../api/driverApi';
import { STORAGE_URL } from '@/api/api';

export default function DriverDetail() {
    const { id } = useParams();
    const navigate = useNavigate();
    const { showToast } = useToast();
    const [activeTab, setActiveTab] = useState('personal');
    const [openDocIndex, setOpenDocIndex] = useState(null);
    const [modalType, setModalType] = useState(null);
    const [showAllRides, setShowAllRides] = useState(false);
    const [driverStatus, setDriverStatus] = useState('active'); // 'active', 'blocked', 'suspended'
    const [isEditing, setIsEditing] = useState(false);
    const [loading, setLoading] = useState(true);

    const [driver, setDriver] = useState(null);

    const fetchDriverDetail = useCallback(async () => {
        try {
            setLoading(true);
            const response = await getDriverById(id);
            const driverData = response.data || response;

            if (!driverData) {
                setDriver(null);
                return;
            }

            setDriver({
                ...driverData,
                id: driverData.id,
                unique_id: driverData.unique_id,
                name: driverData.name || `${driverData.first_name || ''} ${driverData.last_name || ''}`.trim() || 'N/A',
                since: driverData.created_at ? `Since ${new Date(driverData.created_at).toLocaleDateString()}` : 'N/A',
                rating: driverData.rating || 5,
                reviews_count: driverData.reviews_count || 0,
                stats: {
                    total_rides: driverData.total_rides || driverData.stats?.total_rides || 0,
                    completed_rides: driverData.completed_rides || driverData.stats?.completed_rides || 0,
                    revenue: driverData.revenue || driverData.stats?.revenue || '$0.00'
                },
                vehicle: driverData.vehicle ? {
                    ...driverData.vehicle,
                    license_plate: driverData.vehicle.license_plate || 'N/A',
                    type: driverData.vehicle.type || 'N/A'
                } : {
                    model: driverData.vehicle_model || 'N/A',
                    year: driverData.vehicle_year || 'N/A',
                    color: driverData.vehicle_color || 'N/A',
                    license_plate: driverData.license_plate || 'N/A',
                    type: driverData.vehicle_type || 'N/A'
                },
                gender: driverData.gender || 'N/A',
                phone: driverData.phone || 'N/A',
                email: driverData.email || 'N/A',
                avatar: driverData.avatar || driverData.profile_image || null,
                documents: driverData.documents || [],
                payments: driverData.payments || {
                    p1: 'N/A', p2: 'N/A', p3: 'N/A',
                    o1: 'N/A', o2: 'N/A'
                }
            });
            setDriverStatus(driverData.status?.toLowerCase() || 'active');
        } catch (error) {
            console.error("Error fetching driver:", error);
            showToast("Failed to load driver details", "error");
        } finally {
            setLoading(false);
        }
    }, [id]);

    useEffect(() => {
        fetchDriverDetail();
    }, [fetchDriverDetail]);

    const handleEditToggle = async () => {
        if (isEditing) {
            try {
                // Split name back into first and last
                const nameParts = driver.name.split(' ');
                const updateData = {
                    first_name: nameParts[0],
                    last_name: nameParts.slice(1).join(' '),
                    email: driver.email,
                    phone: driver.phone,
                    gender: driver.gender,
                    password: driver.password,
                    password_confirmation: driver.password_confirmation,
                };
                await updateDriver(driver.id, updateData);
                showToast("Driver updated successfully", "success");
            } catch (error) {
                showToast("Update failed", "error");
                return;
            }
        }
        setIsEditing(!isEditing);
    };

    const tabs = [
        { id: 'personal', label: 'Personal Information', icon: 'bi bi-person-fill' },
        { id: 'documents', label: 'Documents', icon: 'bi bi-file-text-fill' },
        { id: 'vehicle', label: 'Vehicle Information', icon: 'bi bi-car-front-fill' },
        { id: 'rides', label: 'All Rides', icon: 'bi bi-truck-front-fill' },
        { id: 'payments', label: 'Payment Methods', icon: 'bi bi-wallet-fill' }
    ];

    if (loading) {
        return (
            <AdminLayout title="Driver Details">
                <div className="flex items-center justify-center min-h-[400px]">
                    <div className="animate-spin inline-block w-8 h-8 border-4 border-red-600 rounded-full border-t-transparent"></div>
                </div>
            </AdminLayout>
        );
    }

    if (!driver) {
        return (
            <AdminLayout title="Driver Details">
                <div className="text-center py-20">
                    <h3 className="text-xl font-bold text-gray-800">Driver not found</h3>
                    <Link to="/drivers" className="text-red-600 hover:underline mt-4 inline-block font-semibold">Back to Drivers</Link>
                </div>
            </AdminLayout>
        );
    }

    return (
        <AdminLayout title="Driver Details">
            <div className="max-w-6xl mx-auto mb-4">

                {/* Header */}
                <div className="flex items-center justify-between mb-4">
                    <div className="flex items-center gap-4">
                        <Link to="/drivers" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="relative">
                            <div className="w-14 h-14 rounded-full overflow-hidden shrink-0 bg-gray-200">
                                <img src={driver.avatar ? `${STORAGE_URL}/${driver.avatar}` : `https://ui-avatars.com/api/?name=${driver.name}&background=random`} className="w-full h-full object-cover" alt="" />
                            </div>
                            <div className="absolute top-0 -left-1 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                        <div>
                            <h2 className="text-xl font-bold text-black">{driver.name}</h2>
                            <div className="flex items-center gap-1 mt-0.5 text-xs font-semibold text-gray-500">
                                <div className="flex gap-0.5 text-[#FBBF24]">
                                    {[1, 2, 3, 4, 5].map(s => <i key={s} className="bi bi-star-fill text-[12px]"></i>)}
                                </div>
                                <span className="ml-1">({driver.reviews_count})</span>
                            </div>
                        </div>
                    </div>
                    <div className="text-sm font-bold text-black">
                        {driver.since}
                    </div>
                </div>

                {/* Stats Banner */}
                <div className="bg-[#FFEAEA] rounded-[16px] py-6 px-10 mb-8 flex flex-col md:flex-row justify-between items-center gap-6 shadow-sm">
                    {/* Total Rides */}
                    <div className="flex items-center gap-4 flex-1">
                        <div className="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#D10000] shadow-sm shrink-0">
                            <i className="bi bi-car-front-fill text-xl"></i>
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xs font-semibold text-gray-800 mb-0.5">Total Rides</span>
                            <span className="text-2xl font-bold text-black leading-none">{driver.stats.total_rides}</span>
                        </div>
                    </div>

                    <div className="hidden md:block w-0.5 h-12 bg-[#D10000]"></div>

                    {/* Completed Rides */}
                    <div className="flex items-center gap-4 flex-1 justify-center">
                        <div className="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#D10000] shadow-sm shrink-0">
                            <i className="bi bi-check-circle-fill text-xl"></i>
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xs font-semibold text-gray-800 mb-0.5">Completed Rides</span>
                            <span className="text-2xl font-bold text-black leading-none">{driver.stats.completed_rides}</span>
                        </div>
                    </div>

                    <div className="hidden md:block w-0.5 h-12 bg-[#D10000]"></div>

                    {/* Cancelled Rides */}
                    <div className="flex items-center gap-4 flex-1 justify-center">
                        <div className="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#D10000] shadow-sm shrink-0">
                            <i className="bi bi-x-circle-fill text-xl"></i>
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xs font-semibold text-gray-800 mb-0.5">Cancelled Rides</span>
                            <span className="text-2xl font-bold text-black leading-none"> 0</span>
                        </div>
                    </div>

                    <div className="hidden md:block w-0.5 h-12 bg-[#D10000]"></div>

                    {/* Revenue */}
                    <div className="flex items-center gap-4 flex-1 justify-end">
                        <div className="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#D10000] shadow-sm shrink-0">
                            <i className="bi bi-bar-chart-line-fill text-xl"></i>
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xs font-semibold text-gray-800 mb-0.5">Revenue</span>
                            <span className="text-2xl font-bold text-black leading-none">{driver.stats.revenue}</span>
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-4">
                    {/* Left Sidebar */}
                    <div className="lg:col-span-4 flex flex-col gap-6">
                        <div className="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden py-4">
                            {tabs.map((tab) => {
                                const isActive = activeTab === tab.id;
                                return (
                                    <button
                                        key={tab.id}
                                        onClick={() => setActiveTab(tab.id)}
                                        className="w-full relative flex items-center gap-4 py-4 px-8 text-sm font-semibold transition-colors hover:bg-gray-50"
                                    >
                                        {isActive && (
                                            <div className="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-12 bg-[#D10000] rounded-r-md"></div>
                                        )}
                                        <div className={`w-10 h-10 rounded-full flex items-center justify-center transition-colors shrink-0 ${isActive ? 'bg-[#FFEAEA] text-[#D10000]' : 'bg-gray-100 text-black'}`}>
                                            <i className={`${tab.icon} text-lg`}></i>
                                        </div>
                                        <span className={`${isActive ? 'text-black font-bold' : 'text-gray-600'}`}>
                                            {tab.label}
                                        </span>
                                    </button>
                                );
                            })}
                        </div>

                        <div className="flex flex-col gap-3">
                            {driverStatus === 'blocked' ? (
                                <button onClick={() => setModalType('unblock')} className="w-full py-3.5 rounded-full bg-white border border-[#D10000] text-[#D10000] font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 transition-colors shadow-sm">
                                    <i className="bi bi-slash-circle font-bold"></i> unblock Driver
                                </button>
                            ) : (
                                <button onClick={() => setModalType('block')} className="w-full py-3.5 rounded-full bg-[#D10000] text-white font-bold text-sm flex items-center justify-center gap-2 hover:bg-[#b00000] transition-colors shadow-sm">
                                    <i className="bi bi-slash-circle font-bold"></i> Block Driver
                                </button>
                            )}

                            <button onClick={() => setModalType('suspend')} className="w-full py-3.5 rounded-full bg-white border border-[#D10000] text-[#D10000] font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 transition-colors">
                                <i className="bi bi-pause-circle-fill"></i> Suspend Driver
                            </button>
                            <button onClick={() => setModalType('delete')} className="w-full py-3.5 rounded-full bg-white border border-[#D10000] text-[#D10000] font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 transition-colors">
                                <i className="bi bi-trash-fill"></i> Delete Driver
                            </button>
                        </div>
                    </div>

                    {/* Right Main Content */}
                    <div className="lg:col-span-8">
                        <div className="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                            {/* Active Tab Header */}
                            <div className="bg-[#D10000] px-8 py-5 flex items-center gap-3">
                                <i className={`text-white text-xl ${tabs.find(t => t.id === activeTab)?.icon}`}></i>
                                <h3 className="text-white font-bold text-base">
                                    {tabs.find(t => t.id === activeTab)?.label}
                                </h3>
                                {['personal', 'documents', 'vehicle', 'payments'].includes(activeTab) && (
                                    <button
                                        onClick={handleEditToggle}
                                        className="ml-auto text-white text-sm font-bold cursor-pointer transition-colors hover:text-gray-200"
                                    >
                                        <i className={`bi ${isEditing ? 'bi-check2' : 'bi-pencil-fill'} mr-2`}></i>
                                        {isEditing ? 'Update' : 'Edit'}
                                    </button>
                                )}
                            </div>

                            {/* Content Body */}
                            <div className="p-6 ">
                                {activeTab === 'personal' && (
                                    <div className="flex flex-col">
                                        <div className="flex items-center justify-between py-2 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Profile Image</span>
                                            <div className="w-2/3 flex items-center gap-4">
                                                <div className="w-12 h-12 rounded-full overflow-hidden shrink-0 bg-gray-200">
                                                    <img src={`https://ui-avatars.com/api/?name=${driver.name}&background=random`} className="w-full h-full object-cover" alt="" />
                                                </div>
                                                <label className="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-lg cursor-pointer transition-colors shadow-sm">
                                                    Change Image
                                                    <input type="file" className="hidden" accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Full Name</span>
                                            {isEditing ? (
                                                <div className="w-2/3">
                                                    <InputWrapper icon="bi bi-person" className="h-10 mb-0">
                                                        <Input
                                                            value={driver.name}
                                                            onChange={e => setDriver({ ...driver, name: e.target.value })}
                                                        />
                                                    </InputWrapper>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-gray-900 w-2/3">{driver.name}</span>
                                            )}
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Email</span>
                                            {isEditing ? (
                                                <div className="w-2/3">
                                                    <InputWrapper icon="bi bi-envelope" className="h-10 mb-0">
                                                        <Input
                                                            value={driver.email}
                                                            onChange={e => setDriver({ ...driver, email: e.target.value })}
                                                        />
                                                    </InputWrapper>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-[#D10000] w-2/3">{driver.email}</span>
                                            )}
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Phone Number</span>
                                            <div className="w-2/3 flex items-center gap-2">
                                                {isEditing ? (
                                                    <div className="w-full">
                                                        <InputWrapper icon="bi bi-telephone" className="h-10 mb-0">
                                                            <Input
                                                                value={driver.phone}
                                                                onChange={e => setDriver({ ...driver, phone: e.target.value })}
                                                            />
                                                        </InputWrapper>
                                                    </div>
                                                ) : (
                                                    <span className="text-sm font-bold text-[#D10000]">{driver.phone}</span>
                                                )}
                                            </div>
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Gender</span>
                                            {isEditing ? (
                                                <div className="w-2/3">
                                                    <select
                                                        className="w-full h-10 border border-gray-200 rounded-xl px-4 text-sm outline-none focus:border-[#D10000]"
                                                        value={driver.gender}
                                                        onChange={e => setDriver({ ...driver, gender: e.target.value })}
                                                    >
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-gray-900 w-2/3">{driver.gender}</span>
                                            )}
                                        </div>

                                        {isEditing && (
                                            <>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <span className="text-sm font-semibold text-gray-500 w-1/3">New Password</span>
                                                    <div className="w-2/3">
                                                        <InputWrapper icon="bi bi-lock" className="h-10 mb-0">
                                                            <Input
                                                                type="password"
                                                                placeholder="Leave blank to keep current"
                                                                value={driver.password || ''}
                                                                onChange={e => setDriver({ ...driver, password: e.target.value })}
                                                            />
                                                        </InputWrapper>
                                                    </div>
                                                </div>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <span className="text-sm font-semibold text-gray-500 w-1/3">Confirm Password</span>
                                                    <div className="w-2/3">
                                                        <InputWrapper icon="bi bi-lock-fill" className="h-10 mb-0">
                                                            <Input
                                                                type="password"
                                                                placeholder="Confirm new password"
                                                                value={driver.password_confirmation || ''}
                                                                onChange={e => setDriver({ ...driver, password_confirmation: e.target.value })}
                                                            />
                                                        </InputWrapper>
                                                    </div>
                                                </div>
                                            </>
                                        )}
                                    </div>
                                )}

                                {activeTab === 'documents' && (
                                    <div className="flex flex-col">
                                        {[
                                            { name: 'Proof of work Eligibility', status: 'Pending' },
                                            { name: 'Profile Photo', status: 'Pending' },
                                            { name: 'Class 1, 2 or 4 Driver\'s Licence', status: 'Pending' },
                                            { name: 'ICBC Commercial driving record', status: 'Pending' },
                                            { name: 'Owner\'s certificate of insurance and vehicle registration', status: 'Pending' },
                                            { name: 'Vehicle Inspection', status: 'Pending' },
                                            { name: 'Legal Agreements', status: 'Pending' },
                                        ].map((doc, idx) => {
                                            const isOpen = openDocIndex === idx;
                                            return (
                                                <div key={idx} className="flex flex-col border-b border-gray-100">
                                                    <div
                                                        className={`flex items-center justify-between py-5 px-4 cursor-pointer hover:bg-gray-50 transition-colors ${isOpen ? 'bg-gray-50' : ''}`}
                                                        onClick={(e) => {
                                                            if (e.target.tagName !== 'SELECT' && e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL') {
                                                                setOpenDocIndex(isOpen ? null : idx);
                                                            }
                                                        }}
                                                    >
                                                        <div className="flex items-center gap-3">
                                                            <span className="text-sm font-bold text-gray-900">{doc.name}</span>
                                                            {isEditing ? (
                                                                <select className="border border-gray-300 rounded text-xs px-2 py-1.5 text-gray-700 outline-none focus:border-[#D10000]" defaultValue={doc.status}>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Approved">Approved</option>
                                                                    <option value="Rejected">Rejected</option>
                                                                </select>
                                                            ) : (
                                                                <span className="text-sm text-[#FF4B4B] font-medium">({doc.status})</span>
                                                            )}
                                                        </div>
                                                        <div className="flex items-center gap-3">
                                                            {isEditing && (
                                                                <label className="text-xs bg-white border border-gray-300 px-3 py-1.5 rounded-lg cursor-pointer hover:bg-gray-50 font-bold transition-colors">
                                                                    Upload New
                                                                    <input type="file" className="hidden" />
                                                                </label>
                                                            )}
                                                            <i className={`bi bi-chevron-${isOpen ? 'down' : 'right'} text-gray-800 font-bold transition-transform`}></i>
                                                        </div>
                                                    </div>
                                                    {isOpen && (
                                                        <div className="px-4 pb-6">
                                                            <div className="w-full py-10 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center text-gray-500 bg-white">
                                                                <i className="bi bi-folder-x text-4xl mb-3 text-gray-300"></i>
                                                                <h4 className="text-base font-bold text-gray-900 mb-1">No Document Found</h4>
                                                                <p className="text-sm text-gray-400">This document is missing or still pending review.</p>
                                                            </div>
                                                        </div>
                                                    )}
                                                </div>
                                            );
                                        })}
                                    </div>
                                )}

                                {activeTab === 'vehicle' && (
                                    <div className="flex flex-col">
                                        <div className="relative w-full h-[300px] rounded-2xl overflow-hidden mb-6 mt-2">
                                            <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=1000" className="w-full h-full object-cover" alt="Vehicle" />
                                            <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                            <div className="absolute bottom-6 left-6 text-white">
                                                <h3 className="text-2xl font-bold">{driver.vehicle.color} {driver.vehicle.model}, ({driver.vehicle.license_plate})</h3>
                                            </div>
                                        </div>
                                        <div className="flex flex-col border border-white">
                                            <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                <span className="text-sm font-semibold text-gray-500 w-1/3">Vehicle Model</span>
                                                {isEditing ? (
                                                    <div className="w-2/3"><InputWrapper icon="bi bi-truck" className="h-10 mb-0"><Input value={driver.vehicle.model} onChange={e => setDriver({ ...driver, vehicle: { ...driver.vehicle, model: e.target.value } })} /></InputWrapper></div>
                                                ) : <span className="text-sm font-bold text-gray-900 w-2/3">{driver.vehicle.model}</span>}
                                            </div>
                                            <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                <span className="text-sm font-semibold text-gray-500 w-1/3">Vehicle Year</span>
                                                {isEditing ? (
                                                    <div className="w-2/3"><InputWrapper icon="bi bi-calendar-event" className="h-10 mb-0"><Input value={driver.vehicle.year} onChange={e => setDriver({ ...driver, vehicle: { ...driver.vehicle, year: e.target.value } })} /></InputWrapper></div>
                                                ) : <span className="text-sm font-bold text-gray-900 w-2/3">{driver.vehicle.year}</span>}
                                            </div>
                                            <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                <span className="text-sm font-semibold text-gray-500 w-1/3">Vehicle Color</span>
                                                {isEditing ? (
                                                    <div className="w-2/3"><InputWrapper icon="bi bi-palette" className="h-10 mb-0"><Input value={driver.vehicle.color} onChange={e => setDriver({ ...driver, vehicle: { ...driver.vehicle, color: e.target.value } })} /></InputWrapper></div>
                                                ) : <span className="text-sm font-bold text-gray-900 w-2/3">{driver.vehicle.color}</span>}
                                            </div>
                                            <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                <span className="text-sm font-semibold text-gray-500 w-1/3">License Plate</span>
                                                {isEditing ? (
                                                    <div className="w-2/3"><InputWrapper icon="bi bi-card-text" className="h-10 mb-0"><Input value={driver.vehicle.license_plate} onChange={e => setDriver({ ...driver, vehicle: { ...driver.vehicle, license_plate: e.target.value } })} /></InputWrapper></div>
                                                ) : <span className="text-sm font-bold text-[#D10000] tracking-wider w-2/3">{driver.vehicle.license_plate}</span>}
                                            </div>
                                            <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                <span className="text-sm font-semibold text-gray-500 w-1/3">Vehicle Type</span>
                                                {isEditing ? (
                                                    <div className="w-2/3 flex items-center gap-2">
                                                        <div className="w-10 h-10 rounded-full flex items-center justify-center text-[#D10000] bg-red-50 shrink-0"><i className="bi bi-car-front-fill text-sm"></i></div>
                                                        <InputWrapper icon="bi bi-truck" className="h-10 mb-0 w-full"><Input value={driver.vehicle.type} onChange={e => setDriver({ ...driver, vehicle: { ...driver.vehicle, type: e.target.value } })} /></InputWrapper>
                                                    </div>
                                                ) : (
                                                    <div className="w-2/3 flex items-center gap-2">
                                                        <div className="w-8 h-8 rounded-full flex items-center justify-center text-[#D10000] bg-red-50"><i className="bi bi-car-front-fill text-sm"></i></div>
                                                        <span className="text-sm font-bold text-gray-900">{driver.vehicle.type}</span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                )}

                                {activeTab === 'rides' && (
                                    <div className="flex flex-col">
                                        <div className="overflow-x-auto ">
                                            {!driver.rides || driver.rides.length === 0 ? (
                                                <div className="text-center py-20 bg-gray-50 rounded-2xl">
                                                    <i className="bi bi-car-front text-4xl text-gray-300 mb-3 block"></i>
                                                    <p className="text-gray-500 font-medium">No rides found for this driver</p>
                                                </div>
                                            ) : (
                                                <table className="w-full text-left border-collapse">
                                                    <thead>
                                                        <tr className="bg-[#FFEAEA] text-xs font-bold text-gray-900 border-none">
                                                            <th className="py-4 px-6 rounded-l-xl">Date</th>
                                                            <th className="py-4 px-6">Booking ID</th>
                                                            <th className="py-4 px-6">Customer</th>
                                                            <th className="py-4 px-6 rounded-r-xl">Pickup</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody className="text-sm">
                                                        {(showAllRides ? driver.rides : driver.rides.slice(0, 5)).map((ride, idx) => (
                                                            <tr key={idx} className="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors">
                                                                <td className="py-4 px-6 text-gray-800 font-medium whitespace-nowrap">{new Date(ride.created_at).toLocaleDateString()}</td>
                                                                <td className="py-4 px-6 text-gray-800 font-bold whitespace-nowrap">{ride.unique_id}</td>
                                                                <td className="py-4 px-6 text-gray-600 font-medium whitespace-nowrap">{ride.passenger_name}</td>
                                                                <td className="py-4 px-6 text-gray-600 font-medium">{ride.pickup_address}</td>
                                                            </tr>
                                                        ))}
                                                    </tbody>
                                                </table>
                                            )}
                                        </div>
                                        {driver.rides && driver.rides.length > 5 && (
                                            <div className="mt-6 mb-2 px-6">
                                                <button
                                                    onClick={() => setShowAllRides(!showAllRides)}
                                                    className="text-[#D10000] text-xs font-bold hover:underline transition-all"
                                                >
                                                    {showAllRides ? 'Show Less' : 'View All'}
                                                </button>
                                            </div>
                                        )}
                                    </div>
                                )}

                                {activeTab === 'payments' && (
                                    <div className="flex flex-col gap-8 mt-4">
                                        {/* Primary Methods */}
                                        <div className="flex flex-col">
                                            <h4 className="text-[#D10000] font-bold text-sm mb-4">Primary Methods</h4>
                                            <div className="flex flex-col">
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <span className="text-sm font-bold text-gray-900 w-1/3">Royal Bank of Canada</span>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={driver.payments.p1} onChange={e => setDriver({ ...driver, payments: { ...driver.payments, p1: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{driver.payments.p1}</span>}
                                                </div>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <div className="flex items-center gap-3 w-1/3">
                                                        <div className="w-9 h-5 bg-blue-700 rounded text-white flex items-center justify-center text-[8px] font-bold italic tracking-wider">VISA</div>
                                                        <span className="text-sm font-bold text-gray-900">Visa</span>
                                                    </div>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={driver.payments.p2} onChange={e => setDriver({ ...driver, payments: { ...driver.payments, p2: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{driver.payments.p2}</span>}
                                                </div>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <div className="flex items-center gap-2 w-1/3">
                                                        <div className="h-6 px-2 border border-gray-300 rounded flex items-center justify-center text-gray-800 text-[10px] font-bold"><i className="bi bi-apple mr-0.5 mt-[-2px]"></i> Pay</div>
                                                        <span className="text-sm font-bold text-gray-900">Apple Pay</span>
                                                    </div>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={driver.payments.p3} onChange={e => setDriver({ ...driver, payments: { ...driver.payments, p3: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{driver.payments.p3}</span>}
                                                </div>
                                            </div>
                                        </div>

                                        {/* Other Methods */}
                                        <div className="flex flex-col border border-white mb-2">
                                            <h4 className="text-[#D10000] font-bold text-sm mb-4">Other Methods</h4>
                                            <div className="flex flex-col">
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <span className="text-sm font-bold text-gray-900 w-1/3">Canadian Western Bank</span>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={driver.payments.o1} onChange={e => setDriver({ ...driver, payments: { ...driver.payments, o1: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{driver.payments.o1}</span>}
                                                </div>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <div className="flex items-center gap-3 w-1/3">
                                                        <div className="flex -space-x-2">
                                                            <div className="w-5 h-5 rounded-full bg-red-500 opacity-80 mix-blend-multiply"></div>
                                                            <div className="w-5 h-5 rounded-full bg-yellow-500 opacity-80 mix-blend-multiply"></div>
                                                        </div>
                                                        <span className="text-sm font-bold text-gray-900">Mastercard</span>
                                                    </div>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={driver.payments.o2} onChange={e => setDriver({ ...driver, payments: { ...driver.payments, o2: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{driver.payments.o2}</span>}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Modals Overlay */}
                {['block', 'unblock', 'delete'].includes(modalType) && (
                    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px]">
                        <div className="bg-white rounded-[32px] p-8 w-[90%] max-w-sm flex flex-col items-center text-center shadow-2xl">
                            <div className="mb-4">
                                <i className={`text-[40px] text-[#EE1B24] ${modalType === 'delete' ? 'bi bi-trash-fill' : 'bi bi-slash-circle font-bold'}`}></i>
                            </div>

                            <h3 className="text-xl font-bold text-gray-900 mb-3">
                                {modalType === 'block' ? 'Block Driver' : modalType === 'unblock' ? 'unblock Driver' : 'Delete Driver'}
                            </h3>

                            <p className="text-xs font-semibold text-gray-600 mb-8 max-w-[250px] mx-auto">
                                {modalType === 'delete' ? (
                                    <>Are you sure to Delete the <span className="text-[#EE1B24]">{driver.name}</span> Driver. This action can't be undone.</>
                                ) : (
                                    <>Are you sure to Block the <span className="text-[#EE1B24]">{driver.name}</span> Driver</>
                                )}
                            </p>

                            <div className="flex items-center gap-3 w-full">
                                <button className="flex-1 py-3 bg-[#EE1B24] text-white rounded-[12px] font-bold text-sm hover:bg-[#d01019] transition-colors" onClick={async () => {
                                    try {
                                        if (modalType === 'block' || modalType === 'unblock') {
                                            await toggleDriverStatus(driver.id);
                                            setDriverStatus(modalType === 'block' ? 'blocked' : 'active');
                                            showToast(`Driver ${modalType === 'block' ? 'blocked' : 'unblocked'} successfully`, "success");
                                        }
                                        if (modalType === 'delete') {
                                            await deleteDriver(driver.id);
                                            showToast("Driver deleted successfully", "success");
                                            navigate('/drivers');
                                        }
                                    } catch (error) {
                                        showToast("Action failed", "error");
                                    }
                                    setModalType(null);
                                }}>
                                    Confirm
                                </button>
                                <button className="flex-1 py-3 bg-white text-gray-900 border border-gray-900 rounded-[12px] font-bold text-sm hover:bg-gray-50 transition-colors" onClick={() => setModalType(null)}>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                )}

                {modalType === 'suspend' && (
                    <div className="fixed top-16 inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px]">
                        <div className="bg-white rounded-[30px] p-2 w-[90%] max-w-[360px] flex flex-col shadow-2xl overflow-hidden ">
                            <div className="bg-[#EE1B24] py-3 px-4 rounded-full shadow-sm text-center">
                                <h3 className="text-white font-bold text-[15px]">Temporarily Suspend Driver</h3>
                            </div>

                            <div className="p-6">
                                <p className="text-[13px] font-medium text-gray-800 mb-6 font-semibold">Driver : {driver.name} (ID: {driver.id})</p>

                                <div className="mb-5">
                                    <p className="text-[15px] font-bold text-gray-900 mb-3">Duration Type</p>
                                    <div className="flex items-center gap-12">
                                        <label className="flex items-center gap-2 cursor-pointer text-sm text-gray-800">
                                            <div className="relative flex items-center justify-center">
                                                <input type="radio" name="durationType" className="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-[#EE1B24]" defaultChecked />
                                                <div className="absolute w-2.5 h-2.5 bg-[#EE1B24] rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                            Minutes
                                        </label>
                                        <label className="flex items-center gap-2 cursor-pointer text-sm text-gray-800">
                                            <div className="relative flex items-center justify-center">
                                                <input type="radio" name="durationType" className="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-[#EE1B24]" />
                                                <div className="absolute w-2.5 h-2.5 bg-[#EE1B24] rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                            Hours
                                        </label>
                                    </div>
                                </div>

                                <div className="mb-5">
                                    <p className="text-[15px] font-bold text-gray-900 mb-2">Duration</p>
                                    <input type="number" placeholder="Enter Minutes" className="w-full border border-gray-400 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#EE1B24] font-medium placeholder:text-gray-400" />
                                </div>

                                <div className="mb-8">
                                    <p className="text-[15px] font-bold text-gray-900 mb-2">Reason<span className="text-gray-600 font-medium">(Optional)</span></p>
                                    <textarea placeholder="Write Reason..." rows={4} className="w-full border border-gray-400 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#EE1B24] resize-none font-medium placeholder:text-gray-400"></textarea>
                                </div>

                                <div className="flex items-center gap-3 w-full">
                                    <button className="flex-1 py-3 bg-[#EE1B24] text-white rounded-xl font-bold text-base hover:bg-[#d01019] transition-colors shadow-sm" onClick={() => setModalType('suspend_success')}>
                                        Suspend
                                    </button>
                                    <button className="flex-[0.8] py-3 bg-white text-gray-900 border-[1.5px] border-black rounded-xl font-bold text-base hover:bg-gray-50 transition-colors" onClick={() => setModalType(null)}>
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                {modalType === 'suspend_success' && (
                    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px]">
                        <div className="bg-white rounded-[32px] p-8 w-[90%] max-w-sm flex flex-col items-center text-center shadow-2xl pb-10 pt-10">
                            <div className="mb-4 text-[#16A34A]">
                                <i className="bi bi-patch-check-fill text-[75px]"></i>
                            </div>
                            <p className="text-[15px] font-medium text-gray-900 my-4 leading-relaxed px-2">
                                Your Driver <span className="text-[#EE1B24]">{driver.name}</span> is successfully suspended for 35 mintues
                            </p>
                            <div className="w-full px-4 mt-2">
                                <button className="w-full py-3.5 bg-[#EE1B24] text-white rounded-[14px] font-bold text-[17px] hover:bg-[#d01019] transition-colors" onClick={() => { setDriverStatus('suspended'); setModalType(null); }}>
                                    Okay
                                </button>
                            </div>
                        </div>
                    </div>
                )}

            </div>
        </AdminLayout>
    );
}
