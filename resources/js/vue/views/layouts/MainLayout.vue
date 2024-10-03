<template>
    <div class="page">
        <LHeader />
        <LSidebar />
        <div class="page-wrapper">
            <div class="page-body m-0">
                <div class="container-xl">
                    <div class="row g-0 m-0">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
            <div class="row text-center align-items-center ">
            </div>
        </div>
    </footer>
</template>

<script>
import LHeader from '../components/LHeader.vue';
import LSidebar from '../components/LSidebar.vue';

export default {
    name: 'MainLayout',
    components: {
        LHeader,
        LSidebar
    }
}
</script>