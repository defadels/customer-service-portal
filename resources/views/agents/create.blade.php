@extends('layouts.app')

@section('title', 'Create Agent - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-plus text-green-600 mr-3"></i>
                    Create New Agent
                </h2>
                <p class="text-gray-600">Add a new customer service agent to your team.</p>
            </div>
            <a href="{{ route('agents.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to List
            </a>
        </div>
    </div>

    <!-- Agent Form -->
    <div class="bg-white shadow rounded-lg p-6">
        <form id="agent-form" class="space-y-6">
            @csrf
            
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
                            placeholder="Enter agent full name"
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
                            placeholder="agent@corisindo.com"
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
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department *</label>
                        <select 
                            id="department" 
                            name="department" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Department</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Sales">Sales</option>
                            <option value="Billing">Billing</option>
                            <option value="Quality Assurance">Quality Assurance</option>
                            <option value="Training">Training</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Skills and Expertise -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Skills and Expertise</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="skill_cs" name="skills[]" value="Customer Service" class="mr-2">
                                <label for="skill_cs">Customer Service</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="skill_tech" name="skills[]" value="Technical Support" class="mr-2">
                                <label for="skill_tech">Technical Support</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="skill_sales" name="skills[]" value="Sales" class="mr-2">
                                <label for="skill_sales">Sales</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="skill_billing" name="skills[]" value="Billing" class="mr-2">
                                <label for="skill_billing">Billing</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="skill_qa" name="skills[]" value="Quality Assurance" class="mr-2">
                                <label for="skill_qa">Quality Assurance</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="skill_training" name="skills[]" value="Training" class="mr-2">
                                <label for="skill_training">Training</label>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="expertise_level" class="block text-sm font-medium text-gray-700 mb-2">Expertise Level *</label>
                        <select 
                            id="expertise_level" 
                            name="expertise_level" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Level</option>
                            <option value="Junior">Junior (0-2 years)</option>
                            <option value="Intermediate">Intermediate (2-5 years)</option>
                            <option value="Senior">Senior (5-10 years)</option>
                            <option value="Expert">Expert (10+ years)</option>
                        </select>
                        
                        <label for="languages" class="block text-sm font-medium text-gray-700 mb-2 mt-4">Languages</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="lang_id" name="languages[]" value="Indonesian" class="mr-2">
                                <label for="lang_id">Indonesian</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="lang_en" name="languages[]" value="English" class="mr-2">
                                <label for="lang_en">English</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="lang_ja" name="languages[]" value="Japanese" class="mr-2">
                                <label for="lang_ja">Japanese</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="lang_cn" name="languages[]" value="Chinese" class="mr-2">
                                <label for="lang_cn">Chinese</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Settings -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Performance Settings</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="max_tickets" class="block text-sm font-medium text-gray-700 mb-2">Max Concurrent Tickets</label>
                        <input 
                            type="number" 
                            id="max_tickets" 
                            name="max_tickets" 
                            min="1" 
                            max="20"
                            value="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <p class="text-sm text-gray-500 mt-1">Maximum tickets an agent can handle simultaneously</p>
                    </div>
                    
                    <div>
                        <label for="sla_target" class="block text-sm font-medium text-gray-700 mb-2">SLA Target (hours)</label>
                        <input 
                            type="number" 
                            id="sla_target" 
                            name="sla_target" 
                            min="1" 
                            max="72"
                            value="24"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <p class="text-sm text-gray-500 mt-1">Target time to resolve tickets</p>
                    </div>
                    
                    <div>
                        <label for="availability" class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
                        <select 
                            id="availability" 
                            name="availability" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="Full-time">Full-time (40 hours/week)</option>
                            <option value="Part-time">Part-time (20 hours/week)</option>
                            <option value="Flexible">Flexible</option>
                            <option value="On-call">On-call</option>
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
                            <option value="Training">Training</option>
                            <option value="On Leave">On Leave</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="window.location.href='{{ route('agents.index') }}'"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors"
                >
                    <i class="fas fa-plus mr-2"></i>
                    Create Agent
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('agent-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        createAgent();
    });
});

function createAgent() {
    const form = document.getElementById('agent-form');
    const formData = new FormData(form);
    
    // Collect checkbox values
    const skills = Array.from(form.querySelectorAll('input[name="skills[]"]:checked')).map(cb => cb.value);
    const languages = Array.from(form.querySelectorAll('input[name="languages[]"]:checked')).map(cb => cb.value);
    
    const data = {
        name: formData.get('name'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        department: formData.get('department'),
        skills: skills,
        expertise_level: formData.get('expertise_level'),
        languages: languages,
        max_tickets: formData.get('max_tickets'),
        sla_target: formData.get('sla_target'),
        availability: formData.get('availability'),
        status: formData.get('status')
    };
    
    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
    submitBtn.disabled = true;
    
    fetch('/api/agents', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.message) {
            showNotification('Agent created successfully!', 'success');
            
            // Redirect to agent list
            setTimeout(() => {
                window.location.href = '/agents';
            }, 1500);
        } else {
            throw new Error('Failed to create agent');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to create agent. Please try again.', 'error');
        
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
