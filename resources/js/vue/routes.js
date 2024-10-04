import { createRouter, createWebHistory } from 'vue-router';

import MainLayout from './views/layouts/MainLayout.vue';

import Equipments from './views/Equipments.vue';
import EquipmentTypes from './views/EquipmentTypes.vue';

import EquipmentTypeAdd from './views/EquipmentTypeAdd.vue';
import EquipmentsAdd from './views/EquipmentsAdd.vue';

import EquipmentsEdit from './views/EquipmentsEdit.vue';

const routes = [
    {
        path: '/',
        name: 'main_layout',
        component: MainLayout,
        children: [
            {
                path: 'equipments',
                name: 'equipments',
                component: Equipments
            },
            {
                path: 'equipment-types',
                name: 'equipment_types',
                component: EquipmentTypes,
            },
            {
                path: 'equipment-types/add',
                name: 'equipment_types_add',
                component: EquipmentTypeAdd
            },
            {
                path: 'equipments/add',
                name: 'equipments_add',
                component: EquipmentsAdd
            },
            {
                path: 'equipments/:id',
                name: 'equipments_edit',
                component: EquipmentsEdit
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;