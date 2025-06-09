// booking_slots.js
// Dynamically populate and filter booking slots for pool and court forms
window.addEventListener('DOMContentLoaded', function() {
    // Pool Slots
    if (window.poolSlotsData) {
        const slotSelect = document.getElementById('slot_id');
        const dateInput = document.getElementById('date');
        const userBookings = window.userPoolBookings || [];
        function filterSlots() {
            const selectedDate = dateInput.value;
            slotSelect.innerHTML = '<option value="">Select Pool Slot</option>';
            window.poolSlotsData.forEach(slot => {
                const alreadyBooked = userBookings.some(b => b.session_name === slot.name && b.date === selectedDate);
                if (!alreadyBooked) {
                    const opt = document.createElement('option');
                    opt.value = slot.id;
                    opt.textContent = `${slot.name} (${slot.start_time.slice(0,5)} - ${slot.end_time.slice(0,5)}, $${parseFloat(slot.price).toFixed(2)})`;
                    opt.dataset.start = slot.start_time;
                    opt.dataset.end = slot.end_time;
                    opt.dataset.price = slot.price;
                    opt.dataset.name = slot.name;
                    slotSelect.appendChild(opt);
                }
            });
        }
        dateInput.addEventListener('change', filterSlots);
        filterSlots();
    }
    // Court Slots
    if (window.courtSlotsData) {
        const slotSelect = document.getElementById('court_slot_id');
        const dateInput = document.getElementById('court_date');
        const userBookings = window.userCourtBookings || [];
        function filterSlots() {
            const selectedDate = dateInput.value;
            slotSelect.innerHTML = '<option value="">Select Court</option>';
            window.courtSlotsData.forEach(slot => {
                const alreadyBooked = userBookings.some(b => b.court_name === slot.name && b.date === selectedDate && b.start_time === slot.start_time && b.end_time === slot.end_time);
                if (!alreadyBooked) {
                    const opt = document.createElement('option');
                    opt.value = slot.id;
                    opt.textContent = `${slot.name} (${slot.start_time ? slot.start_time.slice(0,5) + '-' + slot.end_time.slice(0,5) + ', ' : ''}$${parseFloat(slot.price).toFixed(2)})`;
                    opt.dataset.price = slot.price;
                    opt.dataset.name = slot.name;
                    opt.dataset.start = slot.start_time;
                    opt.dataset.end = slot.end_time;
                    slotSelect.appendChild(opt);
                }
            });
        }
        dateInput.addEventListener('change', filterSlots);
        filterSlots();
    }
    // Slot details (for both forms)
    function setupSlotDetails(selectId, detailsId) {
        const select = document.getElementById(selectId);
        const details = document.getElementById(detailsId);
        if (select && details) {
            select.addEventListener('change', function() {
                const selected = select.options[select.selectedIndex];
                if (selected && selected.value) {
                    let info = `<span class='text-uni-red font-semibold'>${selected.dataset.name}</span>`;
                    if (selected.dataset.start && selected.dataset.end) {
                        info += ` | Time: <span>${selected.dataset.start} - ${selected.dataset.end}</span>`;
                    }
                    info += ` | Price: <span>$${parseFloat(selected.dataset.price).toFixed(2)}</span>`;
                    details.innerHTML = info;
                } else {
                    details.innerHTML = '';
                }
            });
        }
    }
    setupSlotDetails('slot_id', 'slotDetails');
    setupSlotDetails('court_slot_id', 'courtSlotDetails');
});
