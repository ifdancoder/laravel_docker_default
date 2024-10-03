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
            <div class="d-lg-none col-6">
                <div class="nav-item dropdown">
                    <a class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <div class="row">
                            <div class="col">
                                <div class="small text-secondary text-center text-wrap">
                                    Иванов Иван
                                </div>
                                <div class="text-center text-wrap">
                                    ivanovivan@example.com
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            &nbspПрофиль
                        </a>
                        <form method="POST" action="">
                            <button type="submit" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-door-exit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M13 12v.01" />
                                    <path d="M3 21h18" />
                                    <path d="M5 21v-16a2 2 0 0 1 2 -2h7.5m2.5 10.5v7.5" />
                                    <path d="M14 7h7m-3 -3l3 3l-3 3" />
                                </svg>
                                &nbspВыйти
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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