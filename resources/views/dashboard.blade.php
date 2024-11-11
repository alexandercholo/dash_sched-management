<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --sidebar-width: 280px;
            --header-height: 70px;
            --border-color: #e5e7eb;
            --bg-color: #f9fafb;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: white;
            border-right: 1px solid var(--border-color);
            transform: translateX(-100%);
            transition: var(--transition);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-logo {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-left: 0.75rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #374151;
            text-decoration: none;
            transition: var(--transition);
        }

        .menu-item:hover {
            background-color: #f3f4f6;
            color: var(--primary-color);
        }

        .menu-item i {
            width: 1.5rem;
            margin-right: 0.75rem;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 999;
        }

        .menu-trigger {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #374151;
            cursor: pointer;
            padding: 0.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .datetime {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Main Content */
        .main-content {
            padding: calc(var(--header-height) + 2rem) 1.5rem 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 400px;
        }
/* Base Modal Styles */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(4px);
    display: none;
    z-index: 1001;
}

.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.95);
    background: white;
    border-radius: 0.75rem;
    padding: 2rem;
    width: 95%;
    max-width: 800px;
    max-height: 85vh;
    overflow-y: auto;
    z-index: 1002;
    display: none;
    opacity: 0;
    transition: transform 0.3s ease, opacity 0.3s ease;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal.active {
    display: block;
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

.modal-overlay.active {
    display: block;
}

/* Modal Header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #E5E7EB;
}

.modal-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #111827;
    line-height: 1.2;
}

.close-modal {
    background: none;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B7280;
    transition: all 0.2s ease;
    cursor: pointer;
}

.close-modal:hover {
    background-color: #F3F4F6;
    color: #4F46E5;
}

/* Form Elements */
.form-group {
    margin-bottom: 1.25rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
}

.required {
    color: #EF4444;
    margin-left: 0.25rem;
}

.form-control {
    width: 100%;
    padding: 0.625rem 0.875rem;
    border: 1px solid #E5E7EB;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    color: #1F2937;
    background-color: #F9FAFB;
    transition: all 0.2s ease;
}

.form-control:focus {
    outline: none;
    border-color: #4F46E5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    background-color: white;
}

/* Select Styling */
select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem;
    padding-right: 2.5rem;
}

/* Textarea Styling */
textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

/* File Upload Styling */
.file-upload-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

input[type="file"] {
    padding: 0.5rem;
    background-color: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    cursor: pointer;
}

.text-muted {
    color: #6B7280;
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Submit Button */
.submit-btn {
    width: 100%;
    padding: 0.75rem 1.5rem;
    background-color: #4F46E5;
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.submit-btn:hover {
    background-color: #4338CA;
}

.submit-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.5);
}

/* Responsive Adjustments */
@media (max-width: 640px) {
    .modal {
        padding: 1.5rem;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .modal-header h2 {
        font-size: 1.25rem;
    }
}

/* Scrollbar Styling */
.modal::-webkit-scrollbar {
    width: 8px;
}

.modal::-webkit-scrollbar-track {
    background: #F3F4F6;
    border-radius: 4px;
}

.modal::-webkit-scrollbar-thumb {
    background: #D1D5DB;
    border-radius: 4px;
}

.modal::-webkit-scrollbar-thumb:hover {
    background: #9CA3AF;
}
/* Previous modal and form styles remain the same */

/* File Upload Styling */
.file-upload-container {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

input[type="file"] {
    padding: 0.375rem;
    background-color: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    cursor: pointer;
}

input[type="file"]:hover {
    background-color: #F3F4F6;
}

/* Signature specific styling */
.signature-upload-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.signature-preview {
    margin-top: 0.5rem;
    min-height: 60px;
    max-height: 100px;
    border: 1px dashed #E5E7EB;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.signature-preview img {
    max-width: 100%;
    max-height: 100px;
    object-fit: contain;
}

/* Additional helper text styling */
.text-muted {
    color: #6B7280;
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Hover states for better UX */
input[type="file"]:focus {
    outline: none;
    border-color: #4F46E5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}
    </style>
</head>
<body>
  @include('sidebar') <!-- Include the sidebar here -->
<header class="header">
        <button class="menu-trigger" id="menuTrigger">
            <i class="fas fa-bars"></i>
        </button>
        <div class="user-info">
            <div class="datetime" id="datetime"></div>
            <i class="fas fa-user-circle"></i>
        </div>
    </header>

    <main class="main-content">
        <div class="card">
            <!-- Card 1 Content -->
        </div>
        <div class="card">
            <!-- Card 2 Content -->
        </div>
    </main>

    <div class="modal-overlay" id="modalOverlay"></div>
<div class="modal" id="createRequestModal">
    <div class="modal-header">
        <h2>Create Schedule Request</h2>
        <button class="close-modal">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <form id="requestForm" method="POST" action="{{ route('schedule.store') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Event Title<span class="required">*</span></label>
            <input type="text" name="event_title" class="form-control" placeholder="Enter event title" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Date<span class="required">*</span></label>
                <input type="date" name="event_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Location<span class="required">*</span></label>
                <input type="text" name="location" class="form-control" placeholder="Enter location" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Start Time<span class="required">*</span></label>
                <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">End Time<span class="required">*</span></label>
                <input type="time" name="end_time" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Program<span class="required">*</span></label>
            <select name="program" class="form-control" required>
                <option value="">Select a program</option>
                <option value="bpa">Bachelor of Performing Arts</option>
                <option value="bpa-admin">Bachelor of Public Administration</option>
                <option value="bsb">Bachelor of Science in Biology</option>
                <option value="bses">Bachelor of Science in Environmental Science</option>
                <option value="bsess">Bachelor of Science in Exercise Sports and Sciences</option>
                <option value="bsm">Bachelor of Science in Mathematics</option>
                <option value="bssw">Bachelor of Science in Social Work</option>
                <option value="lap">Liberal Arts Program</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Email<span class="required">*</span></label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Enter event description" rows="4"></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit Request</button>
    </form>
</div>

<!-- Add this right after your existing modal div -->
<div class="modal" id="createAnnouncementModal">
    <div class="modal-header">
        <h2>Create Announcement</h2>
        <button class="close-modal">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <form id="announcementForm">
    <!-- First row -->
    <div class="form-group">
        <label class="form-label">Requester Name<span class="required">*</span></label>
        <input type="text" name="requester_name" class="form-control" placeholder="Enter your full name" required>
    </div>

    <div class="form-group">
        <label class="form-label">Email<span class="required">*</span></label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
    </div>

    <div class="form-group">
        <label class="form-label">Department<span class="required">*</span></label>
        <select name="department" class="form-control" required>
            <option value="">Select a program</option>
            <option value="bpa">Bachelor of Performing Arts</option>
            <option value="bpa-admin">Bachelor of Public Administration</option>
            <option value="bsb">Bachelor of Science in Biology</option>
            <option value="bses">Bachelor of Science in Environmental Science</option>
            <option value="bsess">Bachelor of Science in Exercise Sports and Sciences</option>
            <option value="bsm">Bachelor of Science in Mathematics</option>
            <option value="bssw">Bachelor of Science in Social Work</option>
            <option value="lap">Liberal Arts Program</option>
        </select>
    </div>

    <!-- Second row -->
    <div class="form-group two-columns">
        <label class="form-label">Announcement Title<span class="required">*</span></label>
        <input type="text" name="title" class="form-control" placeholder="Enter announcement title" required>
    </div>

    <div class="form-group">
        <label class="form-label">Priority Level<span class="required">*</span></label>
        <select name="priority" class="form-control" required>
            <option value="">Select priority</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>

    <!-- Third row -->
    <div class="form-group full-width">
        <label class="form-label">Announcement Content<span class="required">*</span></label>
        <textarea name="content" class="form-control" placeholder="Enter your announcement content" required></textarea>
    </div>

    <!-- Fourth row -->
    <div class="form-group">
        <label class="form-label">Images</label>
        <div class="file-upload-container">
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            <small class="text-muted">Accepted: JPG, PNG, GIF (Max: 5MB each)</small>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Video</label>
        <div class="file-upload-container">
            <input type="file" name="video" class="form-control" accept="video/*">
            <small class="text-muted">Accepted: MP4, WebM (Max: 100MB)</small>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Target Date<span class="required">*</span></label>
        <input type="date" name="target_date" class="form-control" required>
    </div>

    <!-- Last row -->
    <div class="form-group full-width">
        <label class="form-label">Digital Signature<span class="required">*</span></label>
        <div class="signature-upload-container">
            <input type="file" name="signature" class="form-control" accept="image/png,image/jpeg" required>
            <small class="text-muted">Upload your signature image (JPG, PNG only, Max: 2MB)</small>
            <div id="signature-preview" class="signature-preview"></div>
        </div>
    </div>

    <!-- Submit button -->
    <div class="submit-container">
        <button type="submit" class="submit-btn">Submit Announcement</button>
    </div>
</form>
</div>

    <script>
        // Fixed JavaScript code
        document.addEventListener('DOMContentLoaded', function() {
            // Element references
            const menuTrigger = document.getElementById('menuTrigger');
            const sidebar = document.querySelector('.sidebar');
            const modalOverlay = document.getElementById('modalOverlay');
            const createRequestModal = document.getElementById('createRequestModal');
            const createRequestBtn = document.getElementById('createRequestBtn');
            const closeModalBtn = document.querySelector('.close-modal');
            const requestForm = document.getElementById('requestForm');


            function closeModal() {
        modalOverlay.classList.remove('active');
        createRequestModal.classList.remove('active');
        requestForm.reset();
    }

    requestForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Create loading state
        const submitBtn = this.querySelector('.submit-btn');
        const originalBtnText = submitBtn.textContent;
        submitBtn.textContent = 'Submitting...';
        submitBtn.disabled = true;

        try {
            const formData = new FormData(this);
            
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                // Success
                alert('Schedule request submitted successfully!');
                closeModal();
                
                // Optional: Refresh the page or update the UI
                // window.location.reload();
            } else {
                // Handle validation errors
                if (data.errors) {
                    const errorMessages = Object.values(data.errors).flat().join('\n');
                    alert('Please correct the following errors:\n' + errorMessages);
                } else {
                    throw new Error(data.message || 'Something went wrong');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error submitting request: ' + error.message);
        } finally {
            // Reset button state
            submitBtn.textContent = originalBtnText;
            submitBtn.disabled = false;
        }
    });

            // Toggle sidebar
            menuTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', (e) => {
                if (sidebar.classList.contains('active') && 
                    !sidebar.contains(e.target) && 
                    !menuTrigger.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            });

            // Update datetime
            function updateDateTime() {
                const now = new Date();
                const time = now.toLocaleTimeString('en-GB');
                const date = now.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                document.getElementById('datetime').textContent = `${time} | ${date}`;
            }

            setInterval(updateDateTime, 1000);
            updateDateTime();

            // Modal functionality
            function openModal() {
                modalOverlay.classList.add('active');
                createRequestModal.classList.add('active');
            }

            function closeModal() {
                modalOverlay.classList.remove('active');
                createRequestModal.classList.remove('active');
                requestForm.reset();
            }

            // Event listeners for modal
            if (createRequestBtn) {
                createRequestBtn.addEventListener('click', openModal);
            }
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }
            if (modalOverlay) {
                modalOverlay.addEventListener('click', closeModal);
            }

            // Form submission
            if (requestForm) {
                requestForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    try {
                        const formData = new FormData(requestForm);
                        const response = await fetch('/schedule/store', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (response.ok) {
                            alert('Schedule request submitted successfully!');
                            closeModal();
                            requestForm.reset();
                        } else {
                            throw new Error('Failed to submit request');
                        }
                    } catch (error) {
                        alert('Error submitting request: ' + error.message);
                    }
                });
            }
        });



       // Add this to your existing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Get modal elements
    const createAnnouncementModal = document.getElementById('createAnnouncementModal');
    const announcementForm = document.getElementById('announcementForm');
    const modalOverlay = document.getElementById('modalOverlay');
    
    // Add announcement button listeners
    const createAnnouncementBtns = document.querySelectorAll('a[href="announcement_request.html"]');
    createAnnouncementBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            openAnnouncementModal();
        });
    });

    // Modal functions
    function openAnnouncementModal() {
        modalOverlay.classList.add('active');
        createAnnouncementModal.classList.add('active');
    }

    function closeAnnouncementModal() {
        modalOverlay.classList.remove('active');
        createAnnouncementModal.classList.remove('active');
        announcementForm.reset();
    }

    // Close modal when clicking close button or overlay
    const closeModalBtns = createAnnouncementModal.querySelectorAll('.close-modal');
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', closeAnnouncementModal);
    });

    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) {
            closeAnnouncementModal();
        }
    });

    // Form submission handler
    if (announcementForm) {
        announcementForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('.submit-btn');
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;

            try {
                // For demonstration, we'll just log the form data
                const formData = new FormData(this);
                const formDataObj = {};
                formData.forEach((value, key) => {
                    // Handle file inputs separately
                    if (key === 'images[]') {
                        if (!formDataObj[key]) {
                            formDataObj[key] = Array.from(this.querySelector('input[name="images[]"]').files);
                        }
                    } else {
                        formDataObj[key] = value;
                    }
                });

                console.log('Form Data:', formDataObj);

                // Simulate successful submission
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                alert('Announcement submitted successfully!');
                closeAnnouncementModal();
            } catch (error) {
                console.error('Error:', error);
                alert('Error submitting announcement: ' + error.message);
            } finally {
                submitBtn.textContent = originalBtnText;
                submitBtn.disabled = false;
            }
        });
    }
});


// Add this to your existing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const signatureInput = document.querySelector('input[name="signature"]');
    const signaturePreview = document.getElementById('signature-preview');

    if (signatureInput && signaturePreview) {
        signatureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Signature file size must be less than 2MB');
                    this.value = '';
                    signaturePreview.innerHTML = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image/png') && !file.type.match('image/jpeg')) {
                    alert('Please upload a PNG or JPG image file');
                    this.value = '';
                    signaturePreview.innerHTML = '';
                    return;
                }

                // Preview the signature
                const reader = new FileReader();
                reader.onload = function(e) {
                    signaturePreview.innerHTML = `<img src="${e.target.result}" alt="Signature preview">`;
                };
                reader.readAsDataURL(file);
            } else {
                signaturePreview.innerHTML = '';
            }
        });
    }

    // Add file size validation for other uploads
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const files = Array.from(this.files);
            
            files.forEach(file => {
                if (this.name === 'video' && file.size > 100 * 1024 * 1024) {
                    alert('Video file size must be less than 100MB');
                    this.value = '';
                } else if (this.name === 'images[]' && file.size > 5 * 1024 * 1024) {
                    alert('Image file size must be less than 5MB');
                    this.value = '';
                }
            });
        });
    });
});
    </script>
</body>
</html>