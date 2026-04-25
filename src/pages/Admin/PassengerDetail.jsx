import React, { useState, useEffect, useCallback } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link, useParams } from 'react-router-dom';
import { InputWrapper, Input, useToast } from '@/components/UI';
import { getPassengerById } from '@/api/passengerApi';
import { STORAGE_URL } from '@/api/api';

export default function PassengerDetail() {
    const [activeTab, setActiveTab] = useState('personal');
    const [modalType, setModalType] = useState(null);
    const [showAllRides, setShowAllRides] = useState(false);
    const [passengerStatus, setPassengerStatus] = useState('active'); // 'active', 'blocked', 'suspended'
    const [isEditing, setIsEditing] = useState(false);
    const [showToast, setShowToast] = useState(false);

    const { id } = useParams();
    const { showToast: uiShowToast } = useToast();
    const [loading, setLoading] = useState(true);
    const [passenger, setPassenger] = useState(null);

    const fetchPassengerDetail = useCallback(async () => {
        try {
            setLoading(true);
            const response = await getPassengerById(id);
            const data = response.data || response;

            if (!data) {
                setPassenger(null);
                return;
            }

            setPassenger({
                ...data,
                name: data.name || `${data.first_name || ''} ${data.last_name || ''}`.trim() || 'N/A',
                since: data.created_at ? `Since ${new Date(data.created_at).toLocaleDateString()}` : (data.since || 'N/A'),
                rating: data.rating || 5.0,
                id: data.id || id,
                stats: {
                    total_rides: data.total_rides || data.stats?.total_rides || 0,
                    completed_rides: data.completed_rides || data.stats?.completed_rides || 0,
                    cancelled_rides: data.cancelled_rides || data.stats?.cancelled_rides || 0
                },
                payments: data.payments || {
                    p1: 'N/A', p2: 'N/A', p3: 'N/A',
                    o1: 'N/A', o2: 'N/A'
                }
            });
            setPassengerStatus(data.status?.toLowerCase() || 'active');
        } catch (error) {
            console.error("Error fetching passenger:", error);
            uiShowToast("Failed to load passenger details", "error");
        } finally {
            setLoading(false);
        }
    }, [id]);

    useEffect(() => {
        fetchPassengerDetail();
    }, [fetchPassengerDetail]);

    const handleEditToggle = () => {
        if (isEditing) {
            setShowToast(true);
            setTimeout(() => setShowToast(false), 3000);
        }
        setIsEditing(!isEditing);
    };

    const tabs = [
        { id: 'personal', label: 'Personal Information', icon: 'bi bi-person-fill' },
        { id: 'rides', label: 'All Rides', icon: 'bi bi-truck-front-fill' },
        { id: 'payments', label: 'Payment Methods', icon: 'bi bi-wallet-fill' }
    ];

    if (loading) {
        return (
            <AdminLayout title="Passenger Profile">
                <div className="flex justify-center items-center h-[600px]">
                    <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#D10000]"></div>
                </div>
            </AdminLayout>
        );
    }

    if (!passenger) {
        return (
            <AdminLayout title="Passenger Profile">
                <div className="flex flex-col items-center justify-center h-[600px] text-center px-4">
                    <div className="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-6">
                        <i className="bi bi-person-x-fill text-4xl text-[#D10000]"></i>
                    </div>
                    <h3 className="text-xl font-bold text-gray-800 mb-2">Passenger not found</h3>
                    <p className="text-gray-500 mb-8 max-w-sm">We couldn't find the passenger you're looking for. They may have been deleted or the ID is incorrect.</p>
                    <Link to="/passenger" className="bg-[#D10000] text-white px-8 py-3 rounded-full font-bold hover:bg-[#b00000] transition-colors">
                        Back to Passengers
                    </Link>
                </div>
            </AdminLayout>
        );
    }

    return (
        <AdminLayout title="Passenger Profile">
            <div className="max-w-6xl mx-auto mb-4">

                {/* Header */}
                <div className="flex items-center justify-between mb-4">
                    <div className="flex items-center gap-4">
                        <Link to="/passenger" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="relative">
                            <div className="w-14 h-14 rounded-full overflow-hidden shrink-0 bg-gray-200">
                                <img
                                    src={passenger.avatar ? `${STORAGE_URL}/${passenger.avatar}` : `https://ui-avatars.com/api/?name=${passenger.name}&background=random`}
                                    className="w-full h-full object-cover"
                                    alt=""
                                />
                            </div>
                            <div className={`absolute top-0 -left-1 w-3.5 h-3.5 border-2 border-white rounded-full ${passengerStatus === 'active' ? 'bg-green-500' : 'bg-gray-400'}`}></div>
                        </div>
                        <div>
                            <h2 className="text-xl font-bold text-black">{passenger.name}</h2>
                            <div className="flex items-center gap-1 mt-0.5 text-xs font-semibold text-gray-500">
                                <div className="flex gap-0.5 text-[#FBBF24]">
                                    {[1, 2, 3, 4].map(s => <i key={s} className="bi bi-star-fill text-[12px]"></i>)}
                                    <i className="bi bi-star-fill text-[12px] opacity-30"></i>
                                </div>
                                <span className="ml-1">({passenger.rating})</span>
                            </div>
                        </div>
                    </div>
                    <div className="text-sm font-bold text-black">
                        {passenger.since}
                    </div>
                </div>

                {/* Stats Banner */}
                <div className="bg-[#FFEAEA] rounded-[16px] py-6 px-10 mb-8 flex flex-col md:flex-row justify-between items-center gap-6 shadow-sm">
                    {/* Total Rides */}
                    <div className="flex items-center gap-4 flex-1 justify-center">
                        <div className="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#D10000] shadow-sm shrink-0">
                            <i className="bi bi-truck text-xl"></i>
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xs font-semibold text-gray-800 mb-0.5">Total Rides</span>
                            <span className="text-2xl font-bold text-black leading-none">{passenger.stats.total_rides}</span>
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
                            <span className="text-2xl font-bold text-black leading-none">{passenger.stats.completed_rides}</span>
                        </div>
                    </div>

                    <div className="hidden md:block w-0.5 h-12 bg-[#D10000]"></div>

                    {/* Cancelled Rides */}
                    <div className="flex items-center gap-4 flex-1 justify-center">
                        <div className="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#D10000] shadow-sm shrink-0">
                            <i className="bi bi-slash-circle-fill text-xl"></i>
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xs font-semibold text-gray-800 mb-0.5">Cancelled Rides</span>
                            <span className="text-2xl font-bold text-black leading-none">{passenger.stats.cancelled_rides}</span>
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
                            {passengerStatus === 'blocked' ? (
                                <button onClick={() => setModalType('unblock')} className="w-full py-3.5 rounded-full bg-white border border-[#D10000] text-[#D10000] font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 transition-colors shadow-sm">
                                    <i className="bi bi-slash-circle font-bold"></i> unblock Passenger
                                </button>
                            ) : (
                                <button onClick={() => setModalType('block')} className="w-full py-3.5 rounded-full bg-[#D10000] text-white font-bold text-sm flex items-center justify-center gap-2 hover:bg-[#b00000] transition-colors shadow-sm">
                                    <i className="bi bi-slash-circle font-bold"></i> Block Passenger
                                </button>
                            )}

                            <button onClick={() => setModalType('suspend')} className="w-full py-3.5 rounded-full bg-white border border-[#D10000] text-[#D10000] font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 transition-colors">
                                <i className="bi bi-pause-circle-fill"></i> Suspend Passenger
                            </button>
                            <button onClick={() => setModalType('delete')} className="w-full py-3.5 rounded-full bg-white border border-[#D10000] text-[#D10000] font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 transition-colors">
                                <i className="bi bi-trash-fill"></i> Delete Passenger
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
                                {['personal', 'payments'].includes(activeTab) && (
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
                                                    <img src={passenger.avatar ? `${STORAGE_URL}/${passenger.avatar}` : `https://ui-avatars.com/api/?name=${passenger.name}&background=random`} className="w-full h-full object-cover" alt="" />
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
                                                            value={passenger.name}
                                                            onChange={e => setPassenger({ ...passenger, name: e.target.value })}
                                                        />
                                                    </InputWrapper>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-gray-900 w-2/3">{passenger.name}</span>
                                            )}
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Email Address</span>
                                            {isEditing ? (
                                                <div className="w-2/3">
                                                    <InputWrapper icon="bi bi-envelope" className="h-10 mb-0">
                                                        <Input
                                                            value={passenger.email}
                                                            onChange={e => setPassenger({ ...passenger, email: e.target.value })}
                                                        />
                                                    </InputWrapper>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-[#D10000] w-2/3">{passenger.email}</span>
                                            )}
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Phone Number</span>
                                            <div className="w-2/3 flex items-center gap-2">
                                                {!isEditing && <i className="bi bi-flag-fill text-[#D10000] text-lg"></i>}
                                                {isEditing ? (
                                                    <div className="w-full">
                                                        <InputWrapper icon="bi bi-telephone" className="h-10 mb-0">
                                                            <Input
                                                                value={passenger.phone}
                                                                onChange={e => setPassenger({ ...passenger, phone: e.target.value })}
                                                            />
                                                        </InputWrapper>
                                                    </div>
                                                ) : (
                                                    <span className="text-sm font-bold text-[#D10000]">{passenger.phone}</span>
                                                )}
                                            </div>
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">ID</span>
                                            {isEditing ? (
                                                <div className="w-2/3">
                                                    <InputWrapper icon="bi bi-card-text" className="h-10 mb-0">
                                                        <Input
                                                            value={passenger.id}
                                                            onChange={e => setPassenger({ ...passenger, id: e.target.value })}
                                                        />
                                                    </InputWrapper>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-[#D10000] w-2/3 tracking-wider">#{passenger.id}</span>
                                            )}
                                        </div>

                                        <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                            <span className="text-sm font-semibold text-gray-500 w-1/3">Gender</span>
                                            {isEditing ? (
                                                <div className="w-2/3">
                                                    <InputWrapper icon="bi bi-gender-ambiguous" className="h-10 mb-0">
                                                        <Input
                                                            value={passenger.gender}
                                                            onChange={e => setPassenger({ ...passenger, gender: e.target.value })}
                                                        />
                                                    </InputWrapper>
                                                </div>
                                            ) : (
                                                <span className="text-sm font-bold text-gray-900 w-2/3">{passenger.gender}</span>
                                            )}
                                        </div>
                                    </div>
                                )}

                                {activeTab === 'rides' && (
                                    <div className="flex flex-col">
                                        <div className="overflow-x-auto ">
                                            {!passenger.rides || passenger.rides.length === 0 ? (
                                                <div className="text-center py-20 bg-gray-50 rounded-2xl">
                                                    <i className="bi bi-car-front text-4xl text-gray-300 mb-3 block"></i>
                                                    <p className="text-gray-500 font-medium">No rides found for this passenger</p>
                                                </div>
                                            ) : (
                                                <table className="w-full text-left border-collapse">
                                                    <thead>
                                                        <tr className="bg-[#FFEAEA] text-xs font-bold text-gray-900 border-none">
                                                            <th className="py-4 px-6 rounded-l-xl">Date</th>
                                                            <th className="py-4 px-6">Booking ID</th>
                                                            <th className="py-4 px-6">Driver</th>
                                                            <th className="py-4 px-6 rounded-r-xl">Pickup / Dropoff</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody className="text-sm">
                                                        {(showAllRides ? passenger.rides : passenger.rides.slice(0, 5)).map((ride, idx) => (
                                                            <tr key={idx} className="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors">
                                                                <td className="py-4 px-6 text-gray-800 font-medium whitespace-nowrap">{new Date(ride.created_at).toLocaleDateString()}</td>
                                                                <td className="py-4 px-6 text-gray-800 font-bold whitespace-nowrap">{ride.unique_id}</td>
                                                                <td className="py-4 px-6 text-gray-600 font-medium whitespace-nowrap">{ride.driver?.first_name ? `${ride.driver.first_name} ${ride.driver.last_name || ''}` : 'N/A'}</td>
                                                                <td className="py-4 px-6 text-gray-600 font-medium">
                                                                    {ride.pickup_address || 'N/A'} <br />
                                                                    <i className="bi bi-arrow-down text-gray-400 text-[10px]"></i><br />
                                                                    {ride.dropoff_address || 'N/A'}
                                                                </td>
                                                            </tr>
                                                        ))}
                                                    </tbody>
                                                </table>
                                            )}
                                        </div>
                                        {passenger.rides && passenger.rides.length > 5 && (
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
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={passenger.payments.p1} onChange={e => setPassenger({ ...passenger, payments: { ...passenger.payments, p1: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{passenger.payments.p1}</span>}
                                                </div>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <div className="flex items-center gap-3 w-1/3">
                                                        <div className="w-9 h-5 bg-blue-700 rounded text-white flex items-center justify-center text-[8px] font-bold italic tracking-wider">VISA</div>
                                                        <span className="text-sm font-bold text-gray-900">Visa</span>
                                                    </div>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={passenger.payments.p2} onChange={e => setPassenger({ ...passenger, payments: { ...passenger.payments, p2: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{passenger.payments.p2}</span>}
                                                </div>
                                                <div className="flex items-center justify-between py-6 border-b border-gray-100">
                                                    <div className="flex items-center gap-2 w-1/3">
                                                        <div className="h-6 px-2 border border-gray-300 rounded flex items-center justify-center text-gray-800 text-[10px] font-bold"><i className="bi bi-apple mr-0.5 mt-[-2px]"></i> Pay</div>
                                                        <span className="text-sm font-bold text-gray-900">Apple Pay</span>
                                                    </div>
                                                    {isEditing ? (
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={passenger.payments.p3} onChange={e => setPassenger({ ...passenger, payments: { ...passenger.payments, p3: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{passenger.payments.p3}</span>}
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
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={passenger.payments.o1} onChange={e => setPassenger({ ...passenger, payments: { ...passenger.payments, o1: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{passenger.payments.o1}</span>}
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
                                                        <div className="w-2/3"><InputWrapper icon="bi bi-credit-card" className="h-10 mb-0"><Input value={passenger.payments.o2} onChange={e => setPassenger({ ...passenger, payments: { ...passenger.payments, o2: e.target.value } })} /></InputWrapper></div>
                                                    ) : <span className="text-sm font-semibold text-gray-600 w-2/3">{passenger.payments.o2}</span>}
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
                                {modalType === 'block' ? 'Block Passenger' : modalType === 'unblock' ? 'unblock Passenger' : 'Delete Passenger'}
                            </h3>

                            <p className="text-xs font-semibold text-gray-600 mb-8 max-w-[250px] mx-auto">
                                {modalType === 'delete' ? (
                                    <>Are you sure to Delete the <span className="text-[#EE1B24]">{passenger.name}</span> Passenger. This action can't be undone.</>
                                ) : (
                                    <>Are you sure to Block the <span className="text-[#EE1B24]">{passenger.name}</span> Passenger</>
                                )}
                            </p>

                            <div className="flex items-center gap-3 w-full">
                                <button className="flex-1 py-3 bg-[#EE1B24] text-white rounded-[12px] font-bold text-sm hover:bg-[#d01019] transition-colors" onClick={() => {
                                    if (modalType === 'block') setPassengerStatus('blocked');
                                    if (modalType === 'unblock') setPassengerStatus('active');
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
                                <h3 className="text-white font-bold text-[15px]">Temporarily Suspend Passenger</h3>
                            </div>

                            <div className="p-6">
                                <p className="text-[13px] font-medium text-gray-800 mb-6 font-semibold">Passenger : {passenger.name} (ID: {passenger.id})</p>

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
                                passenger <span className="text-[#EE1B24]">{passenger.name}</span> is successfully suspended for 35 mintues
                            </p>
                            <div className="w-full px-4 mt-2">
                                <button className="w-full py-3.5 bg-[#EE1B24] text-white rounded-[14px] font-bold text-[17px] hover:bg-[#d01019] transition-colors" onClick={() => { setPassengerStatus('suspended'); setModalType(null); }}>
                                    Okay
                                </button>
                            </div>
                        </div>
                    </div>
                )}

                {/* Toast Notification */}
                <div
                    className={`fixed bottom-8 right-8 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 z-50 transform transition-all duration-300 ${showToast ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0 pointer-events-none'}`}
                >
                    <i className="bi bi-check-circle-fill text-xl"></i>
                    <span className="font-bold text-sm">Successfully updated passenger details!</span>
                </div>

            </div>
        </AdminLayout>
    );
}
