<template>
    <div class="m-3">
        <div class="container">
            <div class="d-flex justify-content-center mb-4">
                <h2 class="page-title">Добавление оборудования</h2>
            </div>

            <button class="btn btn-outline-primary mb-3" @click="showForm = !showForm">
                Добавить оборудование
            </button>

            <div v-if="showForm" class="card mt-2">
                <form @submit.prevent="addEquipment">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Добавить оборудование</h2>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Примечание</label>
                            <div class="col-sm-9">
                                <textarea type="text" :class="{ 'is-invalid': errors.description }"
                                    v-model="equipment.description" class="form-control"
                                    placeholder="Описание"></textarea>
                                <span v-if="errors.description" class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ errors.description }}
                                    </strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Серийный номер</label>
                            <div class="col-sm-9">
                                <input type="text" :class="{ 'is-invalid': errors.serial_number }"
                                    v-model="equipment.serial_number" class="form-control" placeholder="Описание">
                                <span v-if="errors.serial_number" class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ errors.serial_number }}
                                    </strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="form-label">Тип оборудования</div>
                            <select :class="{ 'is-invalid': errors.equipment_type_id }"
                                v-model="equipment.equipment_type_id" class="form-select">
                                <option v-for="type in equipment_types" :key="type.id" :value="type.id">{{ type.name + ' (' + type.mask + ')' }}</option>
                            </select>
                            <span v-if="errors.equipment_type_id" class="invalid-feedback" role="alert">
                                <strong>
                                    {{ errors.equipment_type_id }}
                                </strong>
                            </span>
                        </div>
                        <div class="mb-1">
                            <button type="submit" class="btn btn-outline-primary w-100">Добавить в список</button>
                        </div>
                    </div>
                </form>
            </div>

            <div v-if="form.length" class="mt-4">

                <div class="d-flex justify-content-center mb-4">
                    <h2 class="page-title">Временный список оборудования</h2>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Описание</th>
                            <th>Тип оборудования</th>
                            <th>Серийный номер</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in form" :key="index">
                            <td>{{ index }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.equipment_type_id }}</td>
                            <td>{{ item.serial_number }}</td>
                            <td>
                                <button class="btn btn-danger" @click="removeEquipment(index)">Удалить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <button class="btn btn-success" @click="submitEquipments">Отправить список на сервер</button>
                </div>

                <div v-if="!!Object.keys(errors).length || !!Object.keys(success).length" class="card mt-4">
                    <div v-if="!!Object.keys(success).length" class="card mb-3">
                        <div class="card-header">Успешно добавленное оборудование</div>
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <div v-for="(index, key) in success" :key="index">
                                    {{ key + ': ' + success[key] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="!!Object.keys(errors).length" class="card">
                        <div class="card-header">Ошибки при добавлении</div>
                        <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                <div v-for="(index, key) in errors" :key="index">
                                    {{ key + ': ' + errors[key] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { ref } from 'vue';
import apiClient from '../api';

export default {
    name: 'EquipmentsAdd',
    data() {
        return {
            showForm: false,
            equipment: {
                equipment_type_id: 1,
                serial_number: '',
                description: ''
            },
            errors: {},
            success: {},
            form_errors: {},
            equipment_types: [],
            form: []
        };
    },
    methods: {
        addEquipment() {
            if (this.equipment.serial_number && this.equipment.equipment_type_id) {
                this.form.push({ ...this.equipment });
                this.equipment.description = '';
                this.equipment.equipment_type_id = this.equipment_types[0].id || 1;
                this.equipment.serial_number = '';
                this.showForm = false;
            }
            else {
                if (!this.equipment.equipment_type_id) {
                    this.form_errors.equipment_type_id = 'Обязательное поле';
                }
                if (!this.equipment.serial_number) {
                    this.form_errors.serial_number = 'Обязательное поле';
                }
            }
        },
        removeEquipment(index) {
            this.form.splice(index, 1);
        },
        async submitEquipments() {
            this.errors = {};
            this.success = {};
            try {
                const response = await apiClient.post(
                    '/equipment',
                    { equipments: this.form },
                    { vueComponentInstance: ref(this) }
                );
                this.form = [];
            } catch (error) {
                console.log('Ошибка при отправке списка на сервер:', error);
            }
        }
    },
    async mounted() {
        this.errors = {};
        this.success = {};
        try {
            const response = await apiClient.get(
                '/equipment-type',
                {},
                { vueComponentInstance: ref(this) }
            ).then(
                (response) => {
                    this.equipment_types = response.data.message;
                    this.equipment.equipment_type_id = this.equipment_types[0].id || 1;
                }
            ).catch(
                (error) => {
                    console.log("Ошибка была обработана: ", error);
                }
            );
        } catch (error) {
            console.error("Ошибка при получении типов оборудования:", error);
        }
    }
};
</script>
