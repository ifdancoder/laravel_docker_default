<template>
    <aside class="navbar navbar-vertical navbar-expand-lg " style="z-index:1; display: inline-table; height: 100%;"
        data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <div class="d-flex flex-col align-items-center">
                    Задание для
                    <router-link :to="{ name: 'equipments' }" class="m-3">
                        <img src="@img/logo.svg" alt="KTelecomTask">
                    </router-link>
                </div>
            </h1>
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav">
                    <li class="nav-item" :class="{ 'active': currentRouteName === 'equipments' }">
                        <router-link class="nav-link" :to="{ name: 'equipments' }" :class="{ 'active': currentRouteName === 'equipments' }">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 6l11 0" />
                                    <path d="M9 12l11 0" />
                                    <path d="M9 18l11 0" />
                                    <path d="M5 6l0 .01" />
                                    <path d="M5 12l0 .01" />
                                    <path d="M5 18l0 .01" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Оборудование
                            </span>
                        </router-link>
                    </li>
                    <li class="nav-item" :class="{ 'active': currentRouteName === 'equipment_types' }">
                        <router-link class="nav-link" :to="{ name: 'equipment_types' }" :class="{ 'active': currentRouteName === 'equipment_types' }">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                    <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                    <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                    <path d="M11 6l9 0" />
                                    <path d="M11 12l9 0" />
                                    <path d="M11 18l9 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Типы оборудования
                            </span>
                        </router-link>
                    </li>
                    <li class="nav-item" :class="{ 'active': currentRouteName === 'equipments_add' }">
                        <router-link class="nav-link" :to="{ name: 'equipments_add' }" :class="{ 'active': currentRouteName === 'equipments_add' }">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            </span>
                            <span class="nav-link-title">
                                Добавить оборудование
                            </span>
                        </router-link>
                    </li>
                    <li class="nav-item" :class="{ 'active': currentRouteName === 'equipment_types_add' }">
                        <router-link class="nav-link" :to="{ name: 'equipment_types_add' }" :class="{ 'active': currentRouteName === 'equipment_types_add' }">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-text-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 10h-14" /><path d="M5 6h14" /><path d="M14 14h-9" /><path d="M5 18h6" /><path d="M18 15v6" /><path d="M15 18h6" /></svg>
                            </span>
                            <span class="nav-link-title">
                                Добавить типы оборудования
                            </span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</template>

<script>
export default {
    name: 'LSidebar',
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    }
};
</script>