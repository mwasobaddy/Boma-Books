<x-layouts.store>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">SweetAlert2 Demo</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Toast Notifications -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Toast Notifications</h2>
                
                <div class="space-y-4">
                    <button onclick="showSuccessToast()" class="w-full py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        Success Toast (4s)
                    </button>
                    
                    <button onclick="showInfoToast()" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Info Toast (2.5s)
                    </button>
                    
                    <button onclick="showWarningToast()" class="w-full py-2 px-4 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                        Warning Toast (3s)
                    </button>
                    
                    <button onclick="showErrorToast()" class="w-full py-2 px-4 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        Error Toast (5s)
                    </button>
                </div>
            </div>
            
            <!-- Standard Alerts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Standard Alerts</h2>
                
                <div class="space-y-4">
                    <button onclick="showSuccessAlert()" class="w-full py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        Success Alert
                    </button>
                    
                    <button onclick="showInfoAlert()" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Info Alert
                    </button>
                    
                    <button onclick="showWarningAlert()" class="w-full py-2 px-4 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                        Warning Alert
                    </button>
                    
                    <button onclick="showErrorAlert()" class="w-full py-2 px-4 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        Error Alert
                    </button>
                </div>
            </div>
            
            <!-- Cart Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Cart Actions</h2>
                
                <div class="space-y-4">
                    <button onclick="showAddedToCartToast()" class="w-full py-2 px-4 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition-colors">
                        Added to Cart (4.5s)
                    </button>
                    
                    <button onclick="showRemovedFromCartToast()" class="w-full py-2 px-4 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        Removed from Cart (3.5s)
                    </button>
                    
                    <button onclick="showQuantityUpdatedToast()" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Quantity Updated (2s)
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Toast notifications with custom timers
        function showSuccessToast() {
            Toast.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Operation completed successfully',
                timer: 4000,
                timerProgressBar: true
            });
        }
        
        function showInfoToast() {
            Toast.fire({
                icon: 'info',
                title: 'Information',
                text: 'Here is some important information',
                timer: 2500,
                timerProgressBar: true
            });
        }
        
        function showWarningToast() {
            Toast.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'This action may have consequences',
                timer: 3000,
                timerProgressBar: true
            });
        }
        
        function showErrorToast() {
            Toast.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong',
                timer: 5000,
                timerProgressBar: true
            });
        }
        
        // Standard alerts
        function showSuccessAlert() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Operation completed successfully',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
        
        function showInfoAlert() {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Here is some important information',
                showConfirmButton: true
            });
        }
        
        function showWarningAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'This action may have consequences',
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                cancelButtonText: 'Cancel'
            });
        }
        
        function showErrorAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong',
                footer: '<a href="#">Need help?</a>'
            });
        }
        
        // Cart action toasts
        function showAddedToCartToast() {
            Toast.fire({
                icon: 'success',
                title: 'Added to Cart!',
                text: '1 × Sample Book has been added to your cart.',
                timer: 4500,
                timerProgressBar: true
            });
        }
        
        function showRemovedFromCartToast() {
            Toast.fire({
                icon: 'success',
                title: 'Removed from Cart!',
                text: 'Sample Book has been removed from your cart.',
                timer: 3500,
                timerProgressBar: true
            });
        }
        
        function showQuantityUpdatedToast() {
            Toast.fire({
                icon: 'info',
                title: 'Quantity updated to 2',
                timer: 2000,
                timerProgressBar: true
            });
        }
    </script>
</x-layouts.store>