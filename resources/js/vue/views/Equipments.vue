<template>
    <div class="m-3">
        <div class="container">
            <div class="row mb-4 justify-content-between">
                <div class="col-2 d-flex align-items-center">
                    <router-link :to="{ name: 'equipments_add' }" class="btn btn-primary">Перейти к
                        добавлению</router-link>
                </div>
                <div class="col-2">
                    <div class="form-label">Количество записей на странице</div>
                    <select v-model="perPage" @change="fetchEquipments" class="form-select">
                        <option value="2">2</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <h1 class="page-title">Оборудование</h1>
            </div>
            <div class="input-icon mb-2">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                        <path d="M21 21l-6 -6"></path>
                    </svg>
                </span>
                <input type="text" v-model="q" @input="fetchEquipments" class="form-control"
                    :class="{ 'is-invalid': errors.q }" placeholder="Введите серийный номер/примечание оборудования..."
                    aria-label="Search in website">
                <span v-if="errors.q" class="invalid-feedback" role="alert">
                    <strong>
                        {{ errors.q }}
                    </strong>
                </span>
            </div>

            <div class="card h-50">
                <div class="card-header border-0">
                    <div class="card-title">Результаты поиска</div>
                </div>
                <div class="card-table table-responsive" style="min-height: 50vh;">
                    <table class="table table-vcenter">
                        <thead v-if="equipments.length">
                            <tr>
                                <th>ID</th>
                                <th>Тип оборудования</th>
                                <th>Серийный номер</th>
                                <th>Примечания</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <thead class="mb-2" v-else>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-if="equipments.length">
                            <tr v-for="equipment in equipments" :key="equipment.id">
                                <td class="w-1">
                                    {{ equipment.id }}
                                </td>
                                <td class="td-truncate">
                                    {{ equipment.equipment_type.name + ' (ID: ' + equipment.equipment_type.id + ', маска: ' + equipment.equipment_type.mask + ')' }}
                                </td>
                                <td class="text-nowrap text-secondary">
                                    {{ equipment.serial_number }}
                                </td>
                                <td class="text-nowrap text-secondary">
                                    {{ equipment.description }}
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                                Действия
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="">
                                                    Редактировать
                                                </a>
                                                <button class="dropdown-item">
                                                    Удалить
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td class="w-1">
                                    Оборудование не найдено
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination v-if="equipments.length" :meta="meta" :links="links"
                    @fetchFromUrl="fetchEquipmentsByPage" />
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import apiClient from '../api';
import Pagination from './components/Pagination.vue'

export default {
    name: 'Equipments',
    data() {
        return {
            q: '',
            perPage: 2,
            equipments: [],
            meta: {},
            links: {},
            errors: {},
        };
    },
    components: {
        Pagination
    },
    methods: {
        async fetchEquipmentsByPage(url) {
            this.errors = {};
            let data = { params: { perPage:  this.perPage } };
            if (this.q) {
                data = { params: { q: this.q, perPage:  this.perPage } };
            }
            try {
                const response = await apiClient.get(url,
                    data
                ).then(
                    (response) => {
                        this.equipments = response.data.data;
                        this.meta = response.data.meta;
                        this.links = response.data.links;
                    }
                ).catch(
                    (error) => {
                        console.log("Ошибка была обработана: ", error);
                    }
                );
            } catch (error) {
                console.error("Ошибка при получении оборудования по ссылке:", error);
            }
        },
        async fetchEquipments() {
            this.errors = {};
            let data = { params: { perPage:  this.perPage } };
            if (this.q) {
                data = { params: { q: this.q, perPage:  this.perPage } };
            }
            try {
                const response = await apiClient.get(
                    '/equipment',
                    data,
                    { vueComponentInstance: ref(this) }
                ).then(
                    (response) => {
                        this.equipments = response.data.data;
                        this.meta = response.data.meta;
                        this.links = response.data.links;
                    }
                ).catch(
                    (error) => {
                        console.log("Ошибка была обработана: ", error);
                    }
                );
            } catch (error) {
                console.error("Ошибка при получении оборудования:", error);
            }
        },
        async deleteEquipment(id) {
            this.errors = {};
            try {
                const response = await apiClient.delete(
                    '/equipment/' + id,
                    { vueComponentInstance: ref(this) }
                ).then(
                    (response) => {
                        this.fetchEquipments();
                    }
                ).catch(
                    (error) => {
                        console.log("Ошибка была обработана: ", error);
                    }
                );
            } catch (error) {
                console.error("Ошибка при получении оборудования:", error);
            }
        }
    },
    mounted() {
        this.fetchEquipments();
    },
};
</script>