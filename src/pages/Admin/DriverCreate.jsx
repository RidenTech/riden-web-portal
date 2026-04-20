import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link, useNavigate } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button } from '@/components/UI';

export default function DriverCreate() {
    const navigate = useNavigate();
    const [activeTab, setActiveTab] = useState('personal');
    const [completedSteps, setCompletedSteps] = useState({ personal: false, vehicle: false });

    // Form States
    const [personalInfo, setPersonalInfo] = useState({ firstName: '', lastName: '', email: '', phone: '', gender: '' });
    const [vehicleInfo, setVehicleInfo] = useState({ model: '', year: '', color: '', licensePlate: '', type: '' });
    const [errors, setErrors] = useState({});

    // Validation
    const validatePersonal = () => {
        const newErrors = {};
        if (!personalInfo.firstName) newErrors.firstName = 'First name is required';
        if (!personalInfo.lastName) newErrors.lastName = 'Last name is required';
        if (!personalInfo.email) newErrors.email = 'Email is required';
        else if (!/\S+@\S+\.\S+/.test(personalInfo.email)) newErrors.email = 'Email is invalid';
        if (!personalInfo.phone) newErrors.phone = 'Phone number is required';
        if (!personalInfo.gender) newErrors.gender = 'Gender is required';
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const validateVehicle = () => {
        const newErrors = {};
        if (!vehicleInfo.model) newErrors.model = 'Model is required';
        if (!vehicleInfo.year) newErrors.year = 'Year is required';
        if (!vehicleInfo.color) newErrors.color = 'Color is required';
        if (!vehicleInfo.licensePlate) newErrors.licensePlate = 'License plate is required';
        if (!vehicleInfo.type) newErrors.type = 'Vehicle type is required';
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const handleNext = () => {
        if (activeTab === 'personal') {
            if (validatePersonal()) {
                setCompletedSteps(prev => ({ ...prev, personal: true }));
                setActiveTab('vehicle');
                setErrors({});
            }
        } else if (activeTab === 'vehicle') {
            if (validateVehicle()) {
                setCompletedSteps(prev => ({ ...prev, vehicle: true }));
                setActiveTab('documents');
                setErrors({});
            }
        }
    };

    const handleBack = () => {
        if (activeTab === 'documents') setActiveTab('vehicle');
        else if (activeTab === 'vehicle') setActiveTab('personal');
    };

    const handleSubmit = () => {
        navigate('/drivers');
    };

    const steps = [
        { id: 'personal', label: 'Personal Info', title: 'PERSONAL INFORMATION', desc: 'Provide the necessary details to register a new driver with us.' },
        { id: 'vehicle', label: 'Vehicle Info', title: 'VEHICLE SPECIFICATIONS', desc: 'Provide the vehicle details associated with the driver.' },
        { id: 'documents', label: 'Documents', title: 'DRIVER DOCUMENTS', desc: 'Upload the required legal documents for verification.' },
    ];

    const currentStepIndex = steps.findIndex(s => s.id === activeTab);

    return (
        <AdminLayout title="Driver Management">
            <div className=" mx-auto mb-4">

                <div className="bg-white p-10 rounded-[20px] shadow-sm border border-[#E5E7EB]">

                    {/* Header Title */}
                    <div className=" mb-4 flex items-center gap-2">
                        <Link to="/drivers" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <h1 className="text-2xl font-bold text-gray-900">Add New Driver</h1>
                    </div>

                    {/* Horizontal Stepper */}
                    <div className="relative flex justify-between items-center mb-14 max-w-2xl mx-auto">
                        <div className="absolute left-0 top-1/2 -translate-y-1/2 w-full h-[2px] bg-gray-200 z-0"></div>

                        {steps.map((step, index) => {
                            const isCompleted = completedSteps[step.id] || index < currentStepIndex;
                            const isActive = activeTab === step.id;

                            return (
                                <div key={step.id} className="relative z-10 flex flex-col items-center">
                                    <div
                                        className={`w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 border-2 ${isActive
                                            ? 'bg-white border-[#D10000] text-[#D10000]'
                                            : isCompleted
                                                ? 'bg-[#D10000] border-[#D10000] text-white'
                                                : 'bg-white border-gray-300 text-gray-400'
                                            }`}
                                    >
                                        {isCompleted && !isActive ? <i className="bi bi-check-lg text-xl"></i> : index + 1}
                                    </div>
                                    <span className={`absolute -bottom-7 text-xs font-semibold whitespace-nowrap ${isActive || isCompleted ? 'text-gray-800' : 'text-gray-400'}`}>
                                        {step.label}
                                    </span>
                                </div>
                            );
                        })}

                        {/* Dynamic Progress Line Overlay */}
                        <div
                            className="absolute left-0 top-1/2 -translate-y-1/2 h-[2px] bg-[#D10000] z-0 transition-all duration-500 ease-in-out"
                            style={{ width: `${(currentStepIndex / (steps.length - 1)) * 100}%` }}
                        ></div>
                    </div>

                    {/* Step Title & Description */}
                    <div className="mb-8 border-b border-gray-100 pb-4">
                        <h3 className="text-base font-bold text-gray-800 tracking-wider mb-1 uppercase">{steps[currentStepIndex].title}</h3>
                        <p className="text-sm text-gray-500">{steps[currentStepIndex].desc}</p>
                    </div>

                    {/* Form Fields */}
                    <div className="min-h-[300px]">
                        {activeTab === 'personal' && (
                            <div className="space-y-6">
                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Profile Image</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-image" style={{ borderStyle: 'dashed' }}>
                                            <Input type="file" accept="image/*" />
                                        </InputWrapper>
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">First Name</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-person" className={errors.firstName ? 'border-red-500' : ''}>
                                            <Input placeholder="e.g. John" value={personalInfo.firstName} onChange={(e) => setPersonalInfo({ ...personalInfo, firstName: e.target.value })} />
                                        </InputWrapper>
                                        {errors.firstName && <span className="text-xs text-red-500 mt-1 block">{errors.firstName}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Last Name</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-person" className={errors.lastName ? 'border-red-500' : ''}>
                                            <Input placeholder="e.g. Doe" value={personalInfo.lastName} onChange={(e) => setPersonalInfo({ ...personalInfo, lastName: e.target.value })} />
                                        </InputWrapper>
                                        {errors.lastName && <span className="text-xs text-red-500 mt-1 block">{errors.lastName}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Email Address</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-envelope" className={errors.email ? 'border-red-500' : ''}>
                                            <Input type="email" placeholder="john.doe@example.com" value={personalInfo.email} onChange={(e) => setPersonalInfo({ ...personalInfo, email: e.target.value })} />
                                        </InputWrapper>
                                        {errors.email && <span className="text-xs text-red-500 mt-1 block">{errors.email}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Phone Number</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-telephone" className={errors.phone ? 'border-red-500' : ''}>
                                            <Input placeholder="+1 234 567 890" value={personalInfo.phone} onChange={(e) => setPersonalInfo({ ...personalInfo, phone: e.target.value })} />
                                        </InputWrapper>
                                        {errors.phone && <span className="text-xs text-red-500 mt-1 block">{errors.phone}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Gender</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-gender-ambiguous" className={errors.gender ? 'border-red-500' : ''}>
                                            <Select value={personalInfo.gender} onChange={(e) => setPersonalInfo({ ...personalInfo, gender: e.target.value })}>
                                                <option value="" disabled>Select gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </Select>
                                        </InputWrapper>
                                        {errors.gender && <span className="text-xs text-red-500 mt-1 block">{errors.gender}</span>}
                                    </div>
                                </div>
                            </div>
                        )}

                        {activeTab === 'vehicle' && (
                            <div className="space-y-6">
                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Vehicle Model</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-truck" className={errors.model ? 'border-red-500' : ''}>
                                            <Input placeholder="e.g. Toyota Camry" value={vehicleInfo.model} onChange={(e) => setVehicleInfo({ ...vehicleInfo, model: e.target.value })} />
                                        </InputWrapper>
                                        {errors.model && <span className="text-xs text-red-500 mt-1 block">{errors.model}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Vehicle Year</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-calendar-event" className={errors.year ? 'border-red-500' : ''}>
                                            <Input placeholder="e.g. 2023" value={vehicleInfo.year} onChange={(e) => setVehicleInfo({ ...vehicleInfo, year: e.target.value })} />
                                        </InputWrapper>
                                        {errors.year && <span className="text-xs text-red-500 mt-1 block">{errors.year}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Vehicle Color</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-palette" className={errors.color ? 'border-red-500' : ''}>
                                            <Input placeholder="e.g. Metallic Black" value={vehicleInfo.color} onChange={(e) => setVehicleInfo({ ...vehicleInfo, color: e.target.value })} />
                                        </InputWrapper>
                                        {errors.color && <span className="text-xs text-red-500 mt-1 block">{errors.color}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">License Plate</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-card-text" className={errors.licensePlate ? 'border-red-500' : ''}>
                                            <Input placeholder="e.g. ABC-1234" value={vehicleInfo.licensePlate} onChange={(e) => setVehicleInfo({ ...vehicleInfo, licensePlate: e.target.value })} />
                                        </InputWrapper>
                                        {errors.licensePlate && <span className="text-xs text-red-500 mt-1 block">{errors.licensePlate}</span>}
                                    </div>
                                </div>

                                <div className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                                    <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">Vehicle Type</Label>
                                    <div className="md:w-2/3">
                                        <InputWrapper icon="bi bi-truck" className={errors.type ? 'border-red-500' : ''}>
                                            <Select value={vehicleInfo.type} onChange={(e) => setVehicleInfo({ ...vehicleInfo, type: e.target.value })}>
                                                <option value="" disabled>Select type</option>
                                                <option value="Sedan">Sedan</option>
                                                <option value="SUV">SUV</option>
                                                <option value="Luxury">Luxury</option>
                                                <option value="Bike">Bike</option>
                                            </Select>
                                        </InputWrapper>
                                        {errors.type && <span className="text-xs text-red-500 mt-1 block">{errors.type}</span>}
                                    </div>
                                </div>
                            </div>
                        )}

                        {activeTab === 'documents' && (
                            <div className="space-y-6">
                                {[
                                    { name: 'Driving License', placeholder: 'Upload driving license' },
                                    { name: 'ID Card (Front)', placeholder: 'Upload ID card front' },
                                    { name: 'Vehicle Insurance', placeholder: 'Upload insurance document' },
                                ].map((doc, i) => (
                                    <div key={i} className="flex flex-col md:flex-row md:items-center gap-2 md:gap-8 w-full">
                                        <Label className="md:w-1/3 text-gray-700 font-semibold mb-0">{doc.name}</Label>
                                        <div className="md:w-2/3">
                                            <div className="group px-4 py-3 bg-white border-2 border-dashed border-gray-200 rounded-xl hover:border-[#D10000] hover:bg-red-50/30 transition-all duration-300">
                                                <div className="flex items-center justify-between">
                                                    <span className="text-sm text-gray-500">{doc.placeholder}</span>
                                                    <input type="file" className="hidden" id={`doc-${i}`} />
                                                    <label htmlFor={`doc-${i}`} className="px-4 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-bold cursor-pointer hover:bg-gray-200 transition-colors">
                                                        Browse
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>

                    {/* Footer Actions */}
                    <div className={`mt-12 flex items-center  pt-6 border-t border-gray-100 ${activeTab === 'personal' ? 'justify-end' : 'justify-between'}`}>
                        {activeTab === 'personal' ? " " : (
                            <button
                                onClick={handleBack}
                                className="text-sm font-semibold text-[#D10000] hover:text-[#b00000] transition-colors flex items-center gap-1"
                            >
                                <i className="bi bi-chevron-left mr-1"></i> Previous
                            </button>
                        )}

                        {activeTab !== 'documents' ? (
                            <button
                                onClick={handleNext}
                                className="bg-[#D10000] hover:bg-[#b00000] text-white text-sm font-semibold px-8 py-2.5 rounded-lg transition-colors flex items-center gap-1"
                            >
                                Next <i className="bi bi-chevron-right ml-1"></i>
                            </button>
                        ) : (
                            <button
                                onClick={handleSubmit}
                                className="bg-[#D10000] hover:bg-[#b00000] text-white text-sm font-semibold px-8 py-2.5 rounded-lg transition-colors flex items-center gap-1"
                            >
                                Submit <i className="bi bi-check2 ml-1"></i>
                            </button>
                        )}
                    </div>

                </div>
            </div>
        </AdminLayout>
    );
}
