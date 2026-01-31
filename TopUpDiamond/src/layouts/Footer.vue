<template>
    <div class="bg-black-alpha-90 mt-8 py-6">
        <div class="fix-container">
            <div class="grid">
                <!-- Publishers Section -->
                <div class="col-12 md:col-6 lg:col-3 mb-4">
                    <p class="text-white font-bold text-lg mb-3 border-bottom-2 border-primary pb-2 inline-block">សម្រាប់ Publisher</p>
                    <div class="flex flex-column gap-2">
                        <a href="" class="text-gray-300 no-underline hover:text-primary transition-colors transition-duration-300">
                            <i class="pi pi-angle-right mr-2"></i>
                            រាយចំណងជើងរបស់អ្នកនៅលើ Codashop
                        </a>
                        <a href="" class="text-gray-300 no-underline hover:text-primary transition-colors transition-duration-300">
                            <i class="pi pi-angle-right mr-2"></i>
                            ស្វែងយល់បន្ថែមអំពីពួកយើង
                        </a>
                    </div>
                </div>
                
                <!-- Help Section -->
                <div class="col-12 md:col-6 lg:col-3 mb-4">
                    <p class="text-white font-bold text-lg mb-3 border-bottom-2 border-primary pb-2 inline-block">ត្រូវការជំនួយមែនទេ?</p>
                    <div class="flex flex-column gap-2">
                        <a href="" class="text-gray-300 no-underline hover:text-primary transition-colors transition-duration-300">
                            <i class="pi pi-angle-right mr-2"></i>
                            មជ្ឈមណ្ឌលជំនួយ
                        </a>
                        <a href="" class="text-gray-300 no-underline hover:text-primary transition-colors transition-duration-300">
                            <i class="pi pi-angle-right mr-2"></i>
                            ទាក់ទងមកយើង
                        </a>
                    </div>
                </div>
                
                <!-- Country Section -->
                <div class="col-12 md:col-6 lg:col-3 mb-4">
                    <p class="text-white font-bold text-lg mb-3 border-bottom-2 border-primary pb-2 inline-block">ប្រទេស</p>
                    <div class="flex flex-column gap-2">
                        <a href="" class="text-gray-300 no-underline hover:text-primary transition-colors transition-duration-300">
                            <i class="pi pi-angle-right mr-2"></i>
                            កម្ពុជា
                        </a>
                        <a href="" class="text-gray-300 no-underline hover:text-primary transition-colors transition-duration-300">
                            <i class="pi pi-angle-right mr-2"></i>
                            ប្រទេសផ្សេងទៀត
                        </a>
                    </div>
                </div>
                
                <!-- Social Media Section -->
                <div class="col-12 md:col-6 lg:col-3 mb-4">
                    <p class="text-white font-bold text-lg mb-3 border-bottom-2 border-primary pb-2 inline-block">តាមដានយើង</p>
                    <p class="text-gray-400 text-sm mb-3">នៅជាមួយពួកយើង និងតាមដានជាបន្តបន្ទាប់</p>
                    <div class="flex gap-3 align-items-center">
                        <a href="" class="border-circle bg-gray-800 hover:bg-primary transition-colors transition-duration-300 flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="pi pi-facebook text-white" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="" class="border-circle bg-gray-800 hover:bg-primary transition-colors transition-duration-300 flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="fab fa-tiktok text-white" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="" class="border-circle bg-gray-800 hover:bg-primary transition-colors transition-duration-300 flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="pi pi-instagram text-white" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Section -->
            <div class="grid mt-5 pt-4 border-top-1 border-gray-800">
                <div class="col-12 md:col-6 mb-3 md:mb-0">
                    <p class="text-gray-400 text-sm m-0">© 2024 Codashop. All rights reserved.</p>
                </div>
                <div class="col-12 md:col-6 flex gap-4 justify-content-start md:justify-content-end">
                    <a href="" class="text-gray-400 text-sm no-underline hover:text-white transition-colors transition-duration-300">Privacy Policy</a>
                    <a href="" class="text-gray-400 text-sm no-underline hover:text-white transition-colors transition-duration-300">Terms of Service</a>
                    <a href="" class="text-gray-400 text-sm no-underline hover:text-white transition-colors transition-duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* Custom hover effects */
a:hover i.pi-angle-right {
    transform: translateX(5px);
    transition: transform 0.3s ease;
}
</style>