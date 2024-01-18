<div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Adding or Updating Payments</h2>
            <form method="post">
                <div>
                    <label for="name">Tenant:</label>
                    <input type="text" id="name">
                </div>
                <div>
                    <label for="amount">Amount:</label>
                    <input type="amount" id="amount">
                </div>
                <div>
                    <button type="button" onclick="saveChanges()">Save Changes</button>
                    <button type="button" onclick="closeModal()">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("paymentModal");

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function saveChanges() {
            // Add your save changes logic here
            console.log("Changes saved");
        }

        // Close the modal when clicking outside the content
        window.onclick = function (event) {
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>