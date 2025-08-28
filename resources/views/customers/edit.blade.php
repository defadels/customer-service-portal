@extends('layouts.app')

@section('title', 'Edit Customer - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-user-edit text-blue-600 mr-3"></i>
                    Edit Customer
                </h2>
                <p class="text-gray-600">Update customer information.</p>
            </div>
            <a href="{{ route('customers.show', $id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Details
            </a>
        </div>
    </div>

    <!-- Customer Edit Form -->
    <div class="bg-white shadow rounded-lg p-6">
        <form id="customer-edit-form" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter customer full name"
                        >
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="customer@example.com"
                        >
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="081234567890"
                        >
                    </div>
                    
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                        <input 
                            type="date" 
                            id="date_of_birth" 
                            name="date_of_birth" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                    
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select 
                            id="gender" 
                            name="gender" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="customer_type" class="block text-sm font-medium text-gray-700 mb-2">Customer Type *</label>
                        <select 
                            id="customer_type" 
                            name="customer_type" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Customer Type</option>
                            <option value="New">New</option>
                            <option value="Regular">Regular</option>
                            <option value="VIP">VIP</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Full Address</label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter complete address"
                        ></textarea>
                    </div>
                    
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input 
                            type="text" 
                            id="city" 
                            name="city" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Jakarta"
                        >
                    </div>
                    
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                        <input 
                            type="text" 
                            id="state" 
                            name="state" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="DKI Jakarta"
                        >
                    </div>
                    
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                        <input 
                            type="text" 
                            id="postal_code" 
                            name="postal_code" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="12345"
                        >
                    </div>
                    
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input 
                            type="text" 
                            id="country" 
                            name="country" 
                            value="Indonesia"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Preferences</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="communication_preference" class="block text-sm font-medium text-gray-700 mb-2">Communication Preference</label>
                        <select 
                            id="communication_preference" 
                            name="communication_preference" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Preference</option>
                            <option value="Email">Email</option>
                            <option value="SMS">SMS</option>
                            <option value="Phone">Phone</option>
                            <option value="WhatsApp">WhatsApp</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="language_preference" class="block text-sm font-medium text-gray-700 mb-2">Language Preference</label>
                        <select 
                            id="language_preference" 
                            name="language_preference" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Language</option>
                            <option value="Indonesian">Indonesian</option>
                            <option value="English">English</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                        <select 
                            id="timezone" 
                            name="timezone" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Timezone</option>
                            <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
                            <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                            <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select 
                            id="status" 
                            name="status" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="window.location.href='{{ route('customers.show', $id) }}'"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                >
                    <i class="fas fa-save mr-2"></i>
                    Update Customer
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCustomerData();
    
    const form = document.getElementById('customer-edit-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        updateCustomer();
    });
});

function loadCustomerData() {
    const customerId = window.location.pathname.split('/')[2]; // Get ID from URL
    
    fetch(`/api/customers/${customerId}`)
        .then(response => response.json())
        .then(customer => {
            // Populate form fields
            document.getElementById('name').value = customer.name || '';
            document.getElementById('email').value = customer.email || '';
            document.getElementById('phone').value = customer.phone || '';
            document.getElementById('date_of_birth').value = customer.date_of_birth || '';
            document.getElementById('gender').value = customer.gender || '';
            document.getElementById('customer_type').value = customer.customer_type || '';
            document.getElementById('address').value = customer.address || '';
            document.getElementById('city').value = customer.city || '';
            document.getElementById('state').value = customer.state || '';
            document.getElementById('postal_code').value = customer.postal_code || '';
            document.getElementById('country').value = customer.country || '';
            document.getElementById('communication_preference').value = customer.communication_preference || '';
            document.getElementById('language_preference').value = customer.language_preference || '';
            document.getElementById('timezone').value = customer.timezone || '';
            document.getElementById('status').value = customer.status || '';
        })
        .catch(error => {
            console.error('Error loading customer data:', error);
            showNotification('Failed to load customer data. Please try again.', 'error');
        });
}

function updateCustomer() {
    const customerId = window.location.pathname.split('/')[2];
    const form = document.getElementById('customer-edit-form');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    
    // Remove empty values
    Object.keys(data).forEach(key => {
        if (data[key] === '') {
            delete data[key];
        }
    });
    
    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
    submitBtn.disabled = true;
    
    fetch(`/api/customers/${customerId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.message) {
            showNotification('Customer updated successfully!', 'success');
            
            // Redirect to customer details
            setTimeout(() => {
                window.location.href = `/customers/${customerId}`;
            }, 1500);
        } else {
            throw new Error('Failed to update customer');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to update customer. Please try again.', 'error');
        
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endpush
@endsection
