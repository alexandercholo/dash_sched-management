<!-- Modal HTML -->
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

<!-- CSS -->
<style>
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
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalOverlay = document.getElementById('modalOverlay');
    const createRequestModal = document.getElementById('createRequestModal');
    const closeModalBtn = document.querySelector('.close-modal');
    const requestForm = document.getElementById('requestForm');

    function closeModal() {
        modalOverlay.classList.remove('active');
        createRequestModal.classList.remove('active');
        requestForm.reset();
    }

    requestForm.addEventListener('submit', async function(e) {
        e.preventDefault();

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
                alert('Schedule request submitted successfully!');
                closeModal();
            } else {
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
            submitBtn.textContent = originalBtnText;
            submitBtn.disabled = false;
        }
    });

    // Event listeners for modal
    closeModalBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);
});
</script>