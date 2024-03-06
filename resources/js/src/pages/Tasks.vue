<template>
    <div class="input-group mb-3">
        <input type="text" id="titleCreate" class="form-control" v-model="titleCreate" placeholder="Новая задача">
        <button @click.prevent="addTask" class="btn btn-primary d-flex">Добавить</button>
    </div>

    <table class="table" v-if="items.length">
        <thead class="table-dark">
            <tr>
                <td>Задача</td>
                <td><a href="#" @click.prevent="sortColumn('status')" class="text-white text-decoration-none">Статус
                    <i :class="sortColumnStatus === 'asc' ? 'bx bx-sort-up' : 'bx bx-sort-down'" ></i></a></td>
                <td><a href="#" @click.prevent="sortColumn('created_at')" class="text-white text-decoration-none">Добавлена
                    <i :class="sortColumnCreatedAt === 'asc' ? 'bx bx-sort-up' : 'bx bx-sort-down'" ></i></a></td>
                <td>Действия</td>
            </tr>
        </thead>
        <template v-for="item in items" :key="item.id">
            <tr :class="isEdit(item.id) ? 'd-none' : ''">
                <td>{{ item.title }}</td>
                <td>{{ statuses[item.status] }}</td>
                <td>{{ item.created_at }}</td>
                <td>
                    <a href="#" @click.prevent="changeEditTask(item)">Редактировать</a>
                    <a href="#" @click.prevent="deleteTask(item.id)">Удалить</a>
                </td>
            </tr>
            <tr :class="isEdit(item.id) ? '' : 'd-none'">
                <td>
                    <input type="text" v-model="title" class="form-control">
                </td>
                <td>
                    <select v-model="status" id="status">
                        <option :value="key" v-for="(status, key) in statuses" :selected="key === item.status">{{ status }}</option>
                    </select>
                </td>
                <td>{{ item.created_at }}</td>
                <td>
                    <a href="#" @click.prevent="updateTask(item.id)">Сохранить</a>
                    <a href="#" @click.prevent="changeEditTask(null)">Отменить</a>
                </td>
            </tr>
        </template>
    </table>
    <p v-if="!items.length">
        Задачи не добавлены
    </p>
</template>

<script>
import instance from "@/src/api/instance";
import statuses from "@/src/status/status";

export default {
    name: "Tasks",

    data() {
        return {
            items: [],
            editTaskId: 0,
            titleCreate: '',
            title: '',
            status: 0,
            sortColumnStatus: 'asc',
            sortColumnCreatedAt: 'asc',
            sortCol: '',
            sortOrder: '',
            statuses
        }
    },

    mounted() {
        this.getTasks()
    },

    methods: {
        getTasks() {
            const url = (this.sortCol && this.sortOrder ? `task/${this.sortCol}/${this.sortOrder}` : 'task/');
            instance.get(url)
                .then(({data}) => {
                    this.items = data;
                })
        },

        changeEditTask(task) {
            if (task === null) {
                this.editTaskId = 0;
                this.title = null;
                return;
            }

            this.editTaskId = task.id;
            this.title = task.title;
            this.status = task.status;
        },

        isEdit(id) {
            return this.editTaskId === id
        },

        updateTask(id) {
            instance.patch(`task/${id}`, {
                title: this.title,
                status: this.status
            })
                .then(({data}) => {
                    this.changeEditTask(null);
                    this.getTasks();
                })
        },

        deleteTask(id) {
            instance.delete(`task/${id}`)
                .then(({data}) => {
                    this.getTasks();
                })
        },

        addTask() {
            instance.post(`task`, {
                title: this.titleCreate
            })
                .then(({data}) => {
                    this.titleCreate = '';
                    this.getTasks();
                })
        },

        sortColumn(column) {
            if (column === 'status') {
                this.sortColumnStatus = this.sortColumnStatus === 'asc' ? 'desc' : 'asc';
                this.sortColumnCreatedAt = 'asc';
                this.sortCol = 'status';
                this.sortOrder = this.sortColumnStatus;
            } else if (column === 'created_at') {
                this.sortColumnCreatedAt = this.sortColumnCreatedAt === 'asc' ? 'desc' : 'asc';
                this.sortColumnStatus = 'asc';
                this.sortCol = 'created_at';
                this.sortOrder = this.sortColumnCreatedAt;
            }

            this.getTasks();
        },

    },

}
</script>
<style>
td {
    padding: 10px;
}
</style>
