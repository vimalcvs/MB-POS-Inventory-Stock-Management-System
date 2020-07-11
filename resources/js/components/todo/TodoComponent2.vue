<template>
    <a class="nav-link dropdown-toggle">
        <div>
            <a href="javascript:void(0)" @click="openTodoDrawer">
                <img :src="'../backend/img/todo-list.png'"  class="h-26">
            </a>

            <div class="drawer shadow right responsive-drawer animated--fade-in" v-if="globalTodoDrawer">
                <button class="btn btn-primary btn-close" @click="globalTodoDrawer = false">x</button>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.todo}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 pr-0">
                                <div class="form-group">
                                    <input type="text" autofocus v-model="newTodo.title" v-on:keyup.enter="onEnterClick" :placeholder="lang.save_your_task" class="form-control">
                                    <span class="error" v-if="errors['todo.title']">{{errors['todo.title'][0]}}</span>
                                </div>
                            </div>


                            <div class="col-md-2 pl-0">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" @click="storeTodo()">{{lang.save}}</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6 class="text-warning">Pending Task ({{pending_todos.length}})</h6>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-between border-bottom mt-2" v-for="(pending_todo, index) in pending_todos">
                                    <div>
                                        <p class="text-dark"> <span class="mr-1">{{index+1}}. </span> {{pending_todo.title}}</p>
                                    </div>
                                    <div>
                                        <button @click="completeTask(pending_todo.id, index)">
                                            <i class="fas fa-check-square text-success"></i>
                                        </button>
                                        <button @click="deleteTask(pending_todo.id, index)">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
    export default {
        props : {
            //
        },
        data() {
            return {
                lang: [],
                pending_todos: [],
                errors: [],
                newTodo: {
                    title: '',
                },
                globalTodoDrawer: false
            }
        },

        methods: {
            openTodoDrawer: function(){
                this.errors = [];
                this.newTodo.title = '';
                this.globalTodoDrawer = true;
            },

            onEnterClick: function() {
                this.storeTodo();
            },

            storeTodo: function () {
                axios.post('../todo', {todo: JSON.parse(JSON.stringify(this.newTodo))}).then((response) => {
                    this.newTodo.title = '';
                    this.pending_todos.push(response.data);
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            deleteTask: function (id, index) {
                axios.get('../vue/api/delete-todo-task/' + id).then((response) => {
                    this.pending_todos.splice(index, 1);
                }).catch((error) =>{
                    console.error(error);
                });
            },

            completeTask: function (id, index) {
                axios.get('../vue/api/change-task-status-to-complete/' + id).then((response) => {
                    this.pending_todos.splice(index, 1);
                }).catch((error) =>{
                    console.error(error);
                });
            },
        },

        beforeMount() {
            axios.get('../vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });

            axios.get('../vue/api/pending-todos').then((response) => {
                this.pending_todos = response.data;
            });
        }
    }
</script>
