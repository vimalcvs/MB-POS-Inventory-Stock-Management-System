<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.expense_categories}}</h6>
                        <a href="javascript:void(0)" @click="openCreateDrower" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{lang.create_expense_category}} </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="5%">{{lang.sl}}</th>
                                    <th>{{lang.category_name}}</th>
                                    <th width="8%">{{lang.action}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(category, index) in categories">
                                    <td>{{index + 1}}</td>
                                    <td>{{category.name}}</td>
                                    <td class="font-14">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" class="mr-2" @click="editCategory(category.id)"><i class="fa fa-edit text-primary"></i> </a>
                                            <a href="javascript:void(0);" class=""   @click="deleteCategory(category.id, index)"><i class="fa fa-trash text-danger"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right responsive-drawer" v-if="createDrower">
            <button class="btn btn-primary btn-close" @click="createDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.create_expense_category}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.category_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newCategory.name" :placeholder="lang.category_name" class="form-control">
                                <span class="error" v-if="errors['category.name']">{{errors['category.name'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" @click="storeCategory()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="editDrower" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="editDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.update_expense_categories}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.category_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newCategory.name = category.name" :placeholder="lang.category_name" class="form-control">
                                <span class="error" v-if="errors['category.name']">{{errors['category.name'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary btn-block" @click="updateCategory()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : {
            all_categories : Array,
        },

        data() {
            return {
                lang: [],
                errors: [],
                categories: this.all_categories,
                category: {},
                newCategory: {
                    name: '',
                },
                createDrower: false,
                editDrower: false,
            }
        },

        methods: {

            openCreateDrower:function(){
                this.newCategory.name = '',
                this.errors = [],
                this.createDrower = true
            },
            storeCategory: function () {
                axios.post('expense-category', {category: JSON.parse(JSON.stringify(this.newCategory))}).then((response) => {
                    this.newCategory.name = '';
                    this.createDrower= false;
                    this.categories.unshift(response.data);
                    toastr["success"]("Category Successfully Added");
                    this.errors = [];
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            editCategory: function (id) {
                this.categories.forEach((element) => {
                    if (element.id == id) {
                        this.category = element;
                    }
                });
                this.errors = [],
                this.editDrower = true;
            },

            updateCategory: function () {
                axios.patch('expense-category/' + this.category.id , {category: JSON.parse(JSON.stringify(this.newCategory))}).then((response) => {
                    this.newCategory.name = '';
                    this.editDrower = false;
                    this.designation = {};
                    toastr["success"]("Category Successfully Updated");
                    this.errors = [];
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            deleteCategory: function (id, index) {
                swal({
                    title: "Are you sure?",
                    text: "To deleted this Category",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        axios.delete('expense-category/' + id).then((response) => {
                            this.categories.splice(index, 1);
                            toastr["error"]("Category Deleted");
                        }).catch((error) =>{
                            console.error(error);
                        });
                    }
                });
            },
        },

        beforeMount() {
            axios.get('vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });
        }
    }
</script>
