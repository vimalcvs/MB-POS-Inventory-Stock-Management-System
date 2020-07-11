<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.categories}}</h6>
                        <a href="javascript:void(0)" @click="showCreateCategoryDrawer" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{lang.create_category}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="5%">{{lang.sl}}</th>
                                    <th>{{lang.category_name}}</th>
                                    <th width="7%">{{lang.action}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(category, index) in categories">
                                    <td>{{index + 1}}</td>
                                    <td>{{category.title}}</td>
                                    <td class="font-14">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" class="" @click="editCategory(category.id)"><i class="fa fa-edit"></i> </a>
                                            <a href="javascript:void(0);" class="pl-3" @click="deleteCategory(category.id, index)"><i class="fa fa-trash text-danger"></i></a>
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

        <div class="drawer shadow right responsive-drawer" v-if="createCategory">
            <button class="btn btn-primary btn-close" @click="createCategory = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.create_category}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.category_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newCategory.title" :placeholder="lang.category_name" class="form-control">
                                <span class="error" v-if="errors['category.title']">{{errors['category.title'][0]}}</span>
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

        <div class="drawer shadow right" v-if="editCategoryDrower" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="editCategoryDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.update_category}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.category_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newCategory.title = category.title" :placeholder="lang.category_name" class="form-control">
                                <span class="error" v-if="errors['category.title']">{{errors['category.title'][0]}}</span>
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
                    title: '',
                },
                createCategory: false,
                editCategoryDrower: false,
            }
        },

        methods: {
            showCreateCategoryDrawer: function(){
                this.errors = [];
                this.createCategory = true;
            },
            storeCategory: function () {
                axios.post('category', {category: JSON.parse(JSON.stringify(this.newCategory))}).then((response) => {
                    this.newCategory.title = '';
                    this.createCategory = false;
                    this.categories.unshift(response.data);
                    toastr["success"]("Category successfully added");
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
                this.errors = [];
                this.editCategoryDrower = true;
            },

            updateCategory: function () {
                axios.patch('category/' + this.category.id , {category: JSON.parse(JSON.stringify(this.newCategory))}).then((response) => {
                    this.newCategory.title = '';
                    this.editCategoryDrower = false;
                    this.category = {};
                    toastr["success"]("Category successfully updated");
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
                        axios.delete('category/' + id).then((response) => {
                            this.categories.splice(index, 1);
                            toastr["error"]("Category has been deleted");
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
